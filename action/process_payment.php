<?php
require '../vendor/autoload.php';

use net\authorize\api\contract\v1\CustomerType;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

// Get input data
$json = file_get_contents('php://input');

// Decode the JSON data
$data = json_decode($json, true); // Set second parameter to true for associative array

// Validate and retrieve the payment data
$amount = isset($data['amount']) ? $data['amount'] : null;
$cardNumber = isset($data['cardNumber']) ? $data['cardNumber'] : null; // 16-digit example
$expMonth = isset($data['expMonth']) ? $data['expMonth'] : null;
$expYear = isset($data['expYear']) ? $data['expYear'] : null;
$cvv = isset($data['cvv']) ? $data['cvv'] : null;

// Validate and retrieve the customer data
$packageId = isset($data['packageId']) ? $data['packageId'] : null;
$package_name = isset($data['package_name']) ? $data['package_name'] : null;
$firstName = isset($data['firstName']) ? $data['firstName'] : null;
$lastName = isset($data['lastName']) ? $data['lastName'] : null;
$address = isset($data['address']) ? $data['address'] : null;
$zipCode = isset($data['zipCode']) ? $data['zipCode'] : null;
$city = isset($data['city']) ? $data['city'] : null;
$state = isset($data['state']) ? $data['state'] : null;
$phone = isset($data['phone']) ? $data['phone'] : null;
$email = isset($data['email']) ? $data['email'] : null;

$package_1_work_fee = isset($data['package_1_work_fee']) ? $data['package_1_work_fee'] : null;
$package_2_work_fee = isset($data['package_2_work_fee']) ? $data['package_2_work_fee'] : null;
$package_3_work_fee = isset($data['package_3_work_fee']) ? $data['package_3_work_fee'] : null;


if($packageId == 1){
    $first_fee = $package_1_work_fee;
    $pkg_price = $amount + $first_fee;
}elseif($packageId == 2){
    $first_fee = $package_2_work_fee;
    $pkg_price = $amount + $first_fee;
}elseif($packageId == 3){
    $first_fee = $package_3_work_fee;
    $pkg_price = $amount + $first_fee;
}





// Initialize an array to hold error messages
$errors = [];

// Validate payment fields
if (!is_numeric($amount) || $amount <= 0) {
    $errors[] = 'Amount must be a positive number.';
}
if (!is_numeric($cardNumber) || !preg_match('/^\d{13,19}$/', $cardNumber)) {
    $errors[] = 'Card number must be a valid 13 to 19 digit number.';
}
if (!is_numeric($expMonth) || $expMonth < 1 || $expMonth > 12) {
    $errors[] = 'Expiration month must be a number between 1 and 12.';
}
if (!is_numeric($expYear) || $expYear < date('Y')) {
    $errors[] = 'Expiration year must be a valid future year.';
}
if (!is_numeric($cvv) || !preg_match('/^\d{3,4}$/', $cvv)) {
    $errors[] = 'CVV must be a valid 3 or 4 digit number.';
}

// Validate customer fields
if (empty($firstName) || empty($lastName) || empty($address) || empty($city) || empty($state) || empty($zipCode) || empty($phone) || empty($email)) {
    $errors[] = 'All customer fields must be filled.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email format.';
}

// Check if there are any errors
if (!empty($errors)) {
    exit(json_encode(['success' => false, 'errors' => $errors]));
}

// Authorize.Net API credentials
$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
$merchantAuthentication->setName("5QTdgyy4P6S");  // Replace with your actual merchant login
$merchantAuthentication->setTransactionKey("5SXY7y5W3d38Zrk7");  // Replace with your actual transaction key

// Set up credit card information
$creditCard = new AnetAPI\CreditCardType();
$creditCard->setCardNumber($cardNumber);
$creditCard->setExpirationDate($expYear . "-" . str_pad($expMonth, 2, "0", STR_PAD_LEFT));
$creditCard->setCardCode($cvv);

$paymentOne = new AnetAPI\PaymentType();
$paymentOne->setCreditCard($creditCard);

// Set up customer billing information
$customerAddress = new AnetAPI\CustomerAddressType();
$customerAddress->setFirstName($firstName);
$customerAddress->setLastName($lastName);
$customerAddress->setAddress($address);
$customerAddress->setCity($city);
$customerAddress->setState($state);
$customerAddress->setZip($zipCode);
$customerAddress->setCountry("USA"); // Add country field

// Create customer data object
$customerData = new AnetAPI\CustomerDataType();
$customerData->setType("individual");
$customerData->setEmail($email);

// Create and set customer data object for ARB
$customerType = new AnetAPI\CustomerType();
$customerType->setEmail($email);
$customerType->setType("individual");

// Generate a unique invoice number
$invoiceNumber = "INV-" . uniqid();

// Create OrderType object for both subscription and transaction request
$order = new AnetAPI\OrderType();
$order->setInvoiceNumber($invoiceNumber); // Set unique invoice number
$order->setDescription("You have selected the $package_name package, which is priced at $$amount. The first entry fee is $$first_fee, bringing your total amount to $$pkg_price.");

// Create subscription
$subscription = new AnetAPI\ARBSubscriptionType();
$subscription->setName("My Subscription $invoiceNumber"); // Subscription name
$subscription->setPaymentSchedule(createPaymentSchedule()); // Create and set payment schedule
$subscription->setAmount($amount);
$subscription->setPayment($paymentOne);
$subscription->setBillTo($customerAddress);
$subscription->setCustomer($customerType); // Set customer data
$subscription->setOrder($order); // Attach the order details to the subscription

// Function to create a payment schedule
function createPaymentSchedule() {
    $paymentSchedule = new AnetAPI\PaymentScheduleType();

    $interval = new AnetAPI\PaymentScheduleType\IntervalAType();
    $interval->setLength(1); // Length of interval
    $interval->setUnit("months"); // Unit (e.g., months, days)

    $paymentSchedule->setInterval($interval);
    $paymentSchedule->setStartDate(new DateTime()); // Start date of subscription
    $paymentSchedule->setTotalOccurrences("120"); // Total number of occurrences (e.g., 12 for one year)

    return $paymentSchedule;
}

// Set up transaction request with the same order details
$transactionRequest = new AnetAPI\TransactionRequestType();
$transactionRequest->setTransactionType("authCaptureTransaction");
$transactionRequest->setAmount($pkg_price);
$transactionRequest->setPayment($paymentOne);
$transactionRequest->setBillTo($customerAddress); // Add billing info
$transactionRequest->setCustomer($customerData);  // Add customer info
$transactionRequest->setOrder($order); // Attach the same order details

// Set up request and execute transaction
$request = new AnetAPI\CreateTransactionRequest();
$request->setMerchantAuthentication($merchantAuthentication);
$request->setTransactionRequest($transactionRequest);

try {
    $controller = new AnetController\CreateTransactionController($request);
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

    if ($response != null) {
        if ($response->getMessages()->getResultCode() == "Ok") {
            $tresponse = $response->getTransactionResponse();
            if ($tresponse != null && $tresponse->getMessages() != null) {
                // If the transaction is successful, create ARB subscription
                $arbRequest = new AnetAPI\ARBCreateSubscriptionRequest();
                $arbRequest->setMerchantAuthentication($merchantAuthentication);
                $arbRequest->setSubscription($subscription);
                
                $arbController = new AnetController\ARBCreateSubscriptionController($arbRequest);
                $arbResponse = $arbController->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

                if ($arbResponse != null && $arbResponse->getMessages()->getResultCode() == "Ok") {
                    echo json_encode(['success' => true, 'transactionId' => $tresponse->getTransId(), 'subscriptionId' => $arbResponse->getSubscriptionId()]);
                } else {
                    echo json_encode(['success' => false, 'error' => "ARB subscription creation failed: " . $arbResponse->getMessages()->getMessage()[0]->getText()]);
                }
            } else {
                $errorText = $tresponse->getErrors()[0]->getErrorText();
                echo json_encode(['success' => false, 'error' => "Transaction failed: " . $errorText]);
            }
        } else {
            // Handling errors in transaction response
            $tresponse = $response->getTransactionResponse();
            if ($tresponse != null && $tresponse->getErrors() != null) {
                echo json_encode(['success' => false, 'error' => "Transaction failed: " . $tresponse->getErrors()[0]->getErrorText()]);
            } else {
                echo json_encode(['success' => false, 'error' => "Transaction failed: " . $response->getMessages()->getMessage()[0]->getText()]);
            }
        }
    } else {
        echo json_encode(['success' => false, 'error' => "No response from Authorize.Net!"]);
    }
} catch (Exception $e) {
    // Catch any exceptions and return the error message
    echo json_encode(['success' => false, 'error' => "Exception occurred: " . $e->getMessage()]);
}
?>
