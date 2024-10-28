<?php

include './db/db_connect.php';

$GLOBALS['title'] = "Sean White & Associates - Choose a Package";
$GLOBALS['desc'] = "Sean White & Associates offers the most comprehensive service available in the industry today.";
$GLOBALS['keywords'] = "credit repair, financial services, packages";
include('header.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <title>Multi-Step Form</title>
  <style>
    body {
      background-color: #f8f9fa;
    }

    .form-container {
      background-color: white;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      font-size: 24px;
      font-weight: bold;
      color: #ff6f20;
      margin-bottom: 20px;
    }

    .form-text {
      margin-bottom: 20px;
    }

    .step {
      display: none;
    }

    .step.active {
      display: block;
    }

    .btn-container {
      margin-top: 20px;
      display: flex;
      justify-content: space-between;
    }

    .step-indicator {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .step-indicator div {
      flex-grow: 1;
      text-align: center;
      padding: 10px;
      border: 1px solid #ddd;
      background-color: #f1f1f1;
      color: #6c757d;
    }

    .step-indicator div.active {
      background-color: #ff6f20;
      color: white;
    }

    .pricing-card {
      transition: transform 0.3s;
    }

    .pricing-card:hover {
      transform: scale(1.05);
    }
  </style>
  <style>
    .pricing-card {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 20px;
      margin: 15px;
      transition: transform 0.3s;
      cursor: pointer;
    }

    .pricing-card:hover {
      transform: scale(1.05);
    }

    .pricing-radio {
      display: none;
      /* Hide the actual radio button */
    }

    .card-header {
      text-align: center;
    }

    .price-section {
      display: flex;
      justify-content: center;
      align-items: baseline;
    }

    .card-features {
      list-style: none;
      padding: 0;
    }

    .card-features li {
      margin: 5px 0;
    }
  </style>
  <style>
    .step-indicator {
      display: flex;
      justify-content: space-between;
      /* Distribute space evenly */
      flex-wrap: wrap;
      /* Allow items to wrap */
      margin: 20px 0;
      /* Space around the indicator */
    }

    .step-indicator-item {
      flex: 1 1 150px;
      /* Flex-grow, flex-shrink, and base width */
      text-align: center;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin: 5px;
      /* Space between items */
      transition: background-color 0.3s;
    }

    .step-indicator-item.active {
      background-color: #007bff;
      /* Active step background */
      color: white;
    }

    .step-indicator-item:hover {
      background-color: #e9ecef;
      /* Hover effect */
    }

    /* Responsive adjustments */
    @media (max-width: 600px) {
      .step-indicator-item {
        flex: 1 1 100%;
        /* Full width on small screens */
      }
    }

    .invoice-container {
      background-color: #f8f9fa;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .total {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <form id="paymentForm" method="POST">
    <input type="hidden" name="package_id" id="package_id">
    <input type="hidden" name="package_price" id="package_price">

    <div class="container mt-5">
      <div class="form-container">
        <div class="step-indicator">
          <div class="step-indicator-item active">1. CONTACT INFORMATION</div>
          <div class="step-indicator-item">2. SELECT YOUR SERVICE LEVEL</div>
          <div class="step-indicator-item">3. Payment information</div>
          <div class="step-indicator-item">4. AGREEMENT</div>
          <div class="step-indicator-item">5. FINISH</div>
        </div>
        <!-- Step 1: Contact Information -->
        <div class="step active">
          <h2 class="header">CONTACT INFORMATION</h2>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="firstName">First Name</label>
              <input type="text" class="form-control" id="firstName" name="f_name" required>
            </div>
            <div class="form-group col-md-6">
              <label for="lastName">Last Name</label>
              <input type="text" class="form-control" id="lastName" name="l_name" required>
            </div>
          </div>
          <div class="form-group">
            <label for="address">Home Address</label>
            <input type="text" class="form-control" id="address" name="home_address" required>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="zipCode">Zip Code</label>
              <input type="number" class="form-control" id="zipCode" name="zipCode" required>
            </div>
            <div class="form-group col-md-4">
              <label for="city">City</label>
              <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="form-group col-md-4">
              <label for="state">State</label>
              <select id="state" name="state" class="form-control" required>
                <option selected>-- Select --</option>
                <option>State 1</option>
                <option>State 2</option>
                <option>State 3</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="phone">Phone</label>
              <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group col-md-6">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
              <small id="emailFeedback" class="text-danger d-none">Email already exists</small>
            </div>
          </div>
        </div>

        <!-- Step 2: Select Service Level -->
        <div class="step">
          <h2 class="header">SELECT YOUR SERVICE LEVEL</h2>
          <div class="row">
            <div class="col-lg-4" onclick="showForm('https://eform.pandadoc.com/?eform=16be99c5-ec8f-4062-96fe-6dac53a6d3a9')">
              <div class="pricing-card" onclick="selectCard('premium', 'package_1')">
                <div class="card-header">
                  <h2 class="card-title">Premium Package</h2>
                  <p class="card-aggressiveness">AGGRESSIVENESS: VERY HIGH</p>
                  <div class="price-section">
                    <h1 class="price">$249.99</h1>
                    <p class="per-month">/ month</p>
                  </div>
                  <p class="working-fee">First Work Fee: $195.00</p>
                </div>
                <input type="hidden" id="package_1" value="1" data-price="249.99" data-name="Premium Package">
                <input type="hidden" id="package_1_work_fee" value="195">
                <ul class="card-features">
                  <li>Challenges to the 3 Credit Bureaus</li>
                  <li>Score Analysis</li>
                  <li>Creditor Intervention Letters</li>
                  <li>Score Tracker</li>
                  <li>Inquiry Targeting</li>
                  <li>Personalized Guide to Building Credit</li>
                  <li>Access to Educational Content</li>
                  <li>Real-Time Account Sync</li>
                  <li>Three-Bureau Reports and Scores</li>
                  <li>90-day Money-Back Guarantee</li>
                  <li><strong>0% interest-free business funding</strong></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-4" onclick="showForm('https://eform.pandadoc.com/?eform=64391287-9984-417c-ae7c-91229f69f779')">
              <div class="pricing-card" onclick="selectCard('clean-slate', 'package_2')">
                <input type="hidden" id="package_2" value="2" data-price="134.99" data-name="Clean Slate">
                <input type="hidden" id="package_2_work_fee" value="195">
                <div class="card-header">
                  <h2 class="card-title">Clean Slate</h2>
                  <p class="card-aggressiveness">Aggressiveness: High</p>
                  <div class="price-section">
                    <h1 class="price">$134.99</h1>
                    <p class="per-month">/ month</p>
                  </div>
                  <p class="working-fee">First Work Fee: $195.00</p>
                </div>
                <ul class="card-features">
                  <li>Challenges to the 3 Credit Bureaus</li>
                  <li>Score Analysis</li>
                  <li>Creditor Intervention Letters</li>
                  <li>Score Tracker</li>
                  <li>Inquiry Targeting</li>
                  <li>Personalized Guide to Building Credit</li>
                  <li>Access to Educational Content</li>
                  <li>One-Bureau Report and Scores</li>
                  <li>Real-Time Account Sync</li>
                  <li>90-day Money-Back Guarantee</li>
                </ul>
              </div>
            </div>
            <div class="col-lg-4" onclick="showForm('https://eform.pandadoc.com/?eform=a4f7ce2b-e070-43f1-95fa-e1697935e4bc')">
              <div class="pricing-card" onclick="selectCard('credit-remodel', 'package_3')">
                <input type="hidden" id="package_3" value="3" data-price="109.99" data-name="Credit Remodel">
                <input type="hidden" id="package_3_work_fee" value="195">
                <div class="card-header">
                  <h2 class="card-title">Credit Remodel</h2>
                  <p class="card-aggressiveness">Aggressiveness: Moderate</p>
                  <div class="price-section">
                    <h1 class="price">$69.99</h1>
                    <p class="per-month">/ month</p>
                  </div>
                  <p class="working-fee">First Work Fee: $195.00</p>
                </div>
                <ul class="card-features">
                  <li>Challenges to the 3 Credit Bureaus</li>
                  <li>Score Analysis</li>
                  <li>Score Tracker</li>
                  <li>Inquiry Targeting</li>
                  <li>Access to Educational Content</li>
                  <li>Real-Time Account Sync</li>
                  <li>30-day Money-Back Guarantee</li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Billing Information -->
          <div class="row my-5">
            <div class="col-md-4">
              <h5 class="header">Billing Address</h5>
              <div class="form-group">
                <label for="userDetails">User Information</label>
                <div id="userDetails"></div>
              </div>
            </div>
            <div class="col-md-4">
              <h5 class="header">Selected Package Details</h5>
              <div id="packageDetails" class="package-details">
                <p id="packageMessage" class="text-danger"><strong>Please select a package.</strong></p>
                <p class="text-dark"><strong>Package Name:</strong> <span id="display_package_name">None</span></p>
                <p class="text-dark"><strong>Package Price:</strong> <span id="display_package_price">None</span></p>
                <input type="hidden" id="package_id">
                <input type="hidden" id="package_name">
                <input type="hidden" id="package_price">
              </div>
            </div>

            <div class="col-md-4">
              <h5 class="header">Billing Information</h5>
              <div class="form-group">
                <label for="cardNumber">Card Number:</label>
                <input type="text" class="form-control" name="cardNumber" id="cardNumber" required>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <label for="expMonth">Expiry Month:</label>
                    <input type="text" class="form-control" name="expMonth" id="expMonth" required>
                  </div>
                  <div class="col-md-6">
                    <label for="expYear">Expiry Year:</label>
                    <input type="text" class="form-control" name="expYear" id="expYear" required>
                  </div>
                </div>

                <div class="form-group mt-3">
                  <label for="cvv">CVV:</label>
                  <input type="text" class="form-control" name="cvv" id="cvv" required>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Other Steps -->
        <div class="step">
          <h2 class="header">Payment information</h2>
          <div class="container mt-5">
            <div class="invoice-container">
              <img src="http://localhost/terms-of-service/assets/img/logo.png" alt="" style="display:block;margin:auto;">
              <div class="d-flex justify-content-between mt-4">
                <span id="display_package_name"></span>
                <span id="display_package_price"></span>
              </div>
              <div class="d-flex justify-content-between mt-4">
                <span id="">Entry Fee</span>
                <span id="entry_fee"></span>
              </div>
              <hr class="mt-4">
              <div class="d-flex justify-content-between mt-4">
                <span id="">Total</span>
                <span id="total_fee"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="step">
          <h2 class="header">AGREEMENT</h2>
          <div class="form-sections">
            <!-- Single Iframe to Display the Selected Form -->
            <div class="iframe-container" id="iframe-container">
              <iframe id="form-iframe" class="" frameborder="0" src="" height="700px" width="100%"></iframe>
            </div>
          </div>
        </div>
        <div class="step">
          <h2 class="header">FINISH</h2>
          <div class="terms">
            <input type="checkbox" id="termsCheckbox" name="terms" required>
            <label for="termsCheckbox">I agree to the <a href="terms-and-conditions.html" target="_blank">Terms and Conditions</a></label>
          </div>
        </div>
        <!-- Navigation buttons -->

        <button type="button" class="theme-btn   my-5" id="nextBtn" onclick="nextPrev(1)">Next</button>
        <button type="button" class="theme-btn d-none   my-5" id="payNowBtn">Pay Now</button>
        <button type="button" class="theme-btn d-none   my-5" id="submit">Submit</button>
      </div>
    </div>
  </form>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

  <script>
    let currentStep = 0; // Current step is set to the first step (0)

    // Show the first step when the page loads
    showStep(currentStep);

    function showStep(n) {
      let steps = document.getElementsByClassName("step");
      let indicators = document.getElementsByClassName("step-indicator-item");
      let nextBtn = document.getElementById("nextBtn");
      let payNowBtn = document.getElementById("payNowBtn");
      let submit = document.getElementById("submit");

      // Hide all steps initially
      for (let i = 0; i < steps.length; i++) {
        steps[i].classList.remove("active");
      }
      steps[n].classList.add("active");

      // Update indicators
      for (let i = 0; i < indicators.length; i++) {
        indicators[i].classList.remove("active");
      }
      indicators[n].classList.add("active");

      // Hide Back button on the first step

      // Add or remove d-none class based on the number of steps
      if (n == 1) {
        nextBtn.classList.add("d-none"); // Hide next button
        payNowBtn.classList.remove("d-none"); // Show pay now button
      } else if (n === 4) {
        submit.classList.remove("d-none"); // Show submit button
        nextBtn.classList.add("d-none"); // Hide next button
        payNowBtn.classList.add("d-none"); // Hide pay now button
      } else {
        nextBtn.classList.remove("d-none"); // Show next button
        payNowBtn.classList.add("d-none"); // Hide pay now button
      }
    }

    function nextPrev(n) {
      let steps = document.getElementsByClassName("step");

      // Validate and get user details only if moving to the next step
      if (n === 1) {
        if (!getUserDetails()) {
          return; // Stop navigation if validation fails
        }
      }

      // Hide current step and update current step index
      steps[currentStep].classList.remove("active");
      currentStep += n;

      // Submit form if at the last step
      if (currentStep >= steps.length) {
        document.getElementById("multiStepForm").submit();
        return false;
      }

      // Show the next or previous step
      showStep(currentStep);
    }

    function getUserDetails() {
      // Implement validation logic here
      // Return true if valid, false otherwise
      return true; // Placeholder - replace with actual validation logic
    }


    function selectCard(packageName, packageId) {
      // Get the hidden input field based on the packageId
      const selectedPackageInput = document.getElementById(packageId);
      const packageMessage = document.getElementById('packageMessage');

      // Check if a package input is selected
      if (selectedPackageInput) {
        const packageValue = selectedPackageInput.value;
        const packageNameValue = selectedPackageInput.getAttribute('data-name');
        const packagePrice = parseFloat(selectedPackageInput.getAttribute('data-price')); // Convert to number

        // Retrieve entry fee values
        let entry_fee_1 = document.getElementById('package_1_work_fee').value;
        let entry_fee_2 = document.getElementById('package_2_work_fee').value;
        let entry_fee_3 = document.getElementById('package_3_work_fee').value;

        // Initialize entry fee and total fee variables
        let entry_fee = 0;
        let total_fee = 0;
        if (packageId == 'package_1') {
          entry_fee = parseFloat(entry_fee_1); // Convert to float
        } else if (packageId == 'package_2') {
          entry_fee = parseFloat(entry_fee_2); // Convert to float
        } else if (packageId == 'package_3') {
          entry_fee = parseFloat(entry_fee_3); // Convert to float
        }

        total_fee = packagePrice + entry_fee; // Sum as numbers

        console.log(total_fee + ' = ' + packagePrice + ' + ' + entry_fee);
        console.log(packageId);
        // Set the hidden input fields with the selected values
        document.getElementById('package_id').value = packageValue;
        document.getElementById('package_name').value = packageNameValue;
        document.getElementById('package_price').value = packagePrice;

        // Update the displayed package details
        document.getElementById('display_package_name').innerText = packageNameValue;
        document.getElementById('display_package_price').innerText = packagePrice.toFixed(2);
        document.getElementById('entry_fee').innerText = entry_fee.toFixed(2);
        document.getElementById('total_fee').innerText = total_fee.toFixed(2);

        // Hide the "please select a package" message
        if (packageMessage) {
          packageMessage.style.display = "none";
        }

        // Check the radio button for the selected package
        const radioBtn = document.getElementById(packageNameValue);
        if (radioBtn) {
          radioBtn.checked = true;
        }

        // Update invoice container
        updateInvoice(packageNameValue, packagePrice, entry_fee, total_fee);
      }
    }

    // Function to update invoice container
    function updateInvoice(packageName, packagePrice, entryFee, totalFee) {
      // Add logic to update the invoice container with the selected package details
      document.getElementById('invoice_package_name').innerText = packageName;
      document.getElementById('invoice_package_price').innerText = packagePrice.toFixed(2);
      document.getElementById('invoice_entry_fee').innerText = entryFee.toFixed(2);
      document.getElementById('invoice_total_fee').innerText = totalFee.toFixed(2);
    }


    function updateInvoice(packageName, packagePrice) {
      const invoiceContainer = document.querySelector('.invoice-container');

      // Update package name and price in the invoice
      const packageDisplay = invoiceContainer.querySelector('.d-flex.justify-content-between:nth-of-type(1) span:first-child');
      const priceDisplay = invoiceContainer.querySelector('.d-flex.justify-content-between:nth-of-type(1) span:last-child');

      packageDisplay.innerText = packageName + ' x 1';
      priceDisplay.innerText = '$' + parseFloat(packagePrice).toFixed(2);

      // You can also calculate the total if needed
      const total = calculateTotal(packagePrice); // Assuming you have a function to calculate total
      const totalDisplay = invoiceContainer.querySelector('.total span:last-child');
      totalDisplay.innerText = '$' + total;
    }



    // Optional: Function to clear selection and show the message again
    function clearSelection() {
      document.getElementById('package_id').value = '';
      document.getElementById('package_name').value = '';
      document.getElementById('package_price').value = '';
      document.getElementById('display_package_name').innerText = 'None';
      document.getElementById('display_package_price').innerText = 'None';

      // Show the "please select a package" message again
      document.getElementById('packageMessage').style.display = "block";
    }

    function getUserDetails() {
      // Retrieve values from the input fields
      const firstNameField = document.getElementById('firstName');
      const lastNameField = document.getElementById('lastName');
      const addressField = document.getElementById('address');
      const zipCodeField = document.getElementById('zipCode');
      const cityField = document.getElementById('city');
      const stateField = document.getElementById('state');
      const phoneField = document.getElementById('phone');
      const emailField = document.getElementById('email');

      // Retrieve values
      const firstName = firstNameField.value;
      const lastName = lastNameField.value;
      const address = addressField.value;
      const zipCode = zipCodeField.value;
      const city = cityField.value;
      const state = stateField.value;
      const phone = phoneField.value;
      const email = emailField.value;

      // Reset all borders before validation
      resetBorders();

      // Validation: Check if all required fields are filled
      let isValid = true; // Flag to check if all fields are valid

      if (!firstName) {
        firstNameField.style.border = "2px solid red"; // Add red border
        isValid = false;
      }
      if (!lastName) {
        lastNameField.style.border = "2px solid red"; // Add red border
        isValid = false;
      }
      if (!address) {
        addressField.style.border = "2px solid red"; // Add red border
        isValid = false;
      }
      if (!zipCode) {
        zipCodeField.style.border = "2px solid red"; // Add red border
        isValid = false;
      }
      if (!city) {
        cityField.style.border = "2px solid red"; // Add red border
        isValid = false;
      }
      if (state === "-- Select --") {
        stateField.style.border = "2px solid red"; // Add red border
        isValid = false;
      }
      if (!phone) {
        phoneField.style.border = "2px solid red"; // Add red border
        isValid = false;
      }
      if (!email) {
        emailField.style.border = "2px solid red"; // Add red border
        isValid = false;
      }

      // Alert if any field is invalid
      if (!isValid) {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: "Please fill out all required fields.",
          toast: true,
          position: 'top-right',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
          }
        });
        return false; // Return false if validation fails
      }

      // Create a user details string to only show the address
      const userDetails = `
    <p style="color:#000"><strong>State:</strong> ${state}</p>
    <p style="color:#000"><strong>City:</strong> ${address}</p>
    <p style="color:#000"><strong>Address:</strong> ${address}</p>
  `;

      // Display the address in the userDetails div
      document.getElementById('userDetails').innerHTML = userDetails;

      return true; // Return true if validation passes
    }

    // Function to reset borders
    function resetBorders() {
      const fields = [
        'firstName',
        'lastName',
        'address',
        'zipCode',
        'city',
        'state',
        'phone',
        'email',
      ];

      fields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field) {
          field.style.border = ""; // Reset border to default
        }
      });
    }
  </script>
  <script>
    document.getElementById('payNowBtn').addEventListener('click', async (event) => {
      event.preventDefault(); // Prevent default form submission
      const packageId = document.getElementById('package_id').value;
      const packagePrice = document.getElementById('package_price').value;



      if (!packageId || packagePrice === '') {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: "Please select a package.",
          toast: true,
          position: 'top-right',
          timer: 3000,
          timerProgressBar: true
        });
        return;
      }


      // Collect data from the form
      const carddata = {
        amount: document.getElementById('package_price').value,
        cardNumber: document.getElementById('cardNumber').value,
        expMonth: document.getElementById('expMonth').value,
        expYear: document.getElementById('expYear').value,
        cvv: document.getElementById('cvv').value,

        // Include customer information
        packageId: document.getElementById('package_id').value,
        package_name: document.getElementById('package_name').value,
        firstName: document.getElementById('firstName').value,
        lastName: document.getElementById('lastName').value,
        address: document.getElementById('address').value,
        zipCode: document.getElementById('zipCode').value,
        city: document.getElementById('city').value,
        state: document.getElementById('state').value,
        phone: document.getElementById('phone').value,
        email: document.getElementById('email').value,

        package_1_work_fee: document.getElementById('package_1_work_fee').value,
        package_2_work_fee: document.getElementById('package_2_work_fee').value,
        package_3_work_fee: document.getElementById('package_3_work_fee').value

      };
      try {



        // Send the data to the server using fetch
        const response = await fetch('./action/process_payment.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(carddata)
        });

        // Parse the JSON response
        const result = await response.json();

        // Handle the response
        if (result.success) {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "Payment successful! Transaction ID: " + result.transactionId,
            toast: true,
            position: 'top-right',
            timer: 3000,
            timerProgressBar: true
          });
          let nextBtn = document.getElementById("nextBtn");
          let payNowBtn = document.getElementById("payNowBtn");
          nextBtn.classList.remove("d-none"); // Show Next button
          payNowBtn.classList.add("d-none"); // Hide Pay Now button
          const formData = new FormData(document.getElementById('paymentForm'));
          formData.append('transactionId', result.transactionId);
          fetch('./action/insert_user.php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.text())
            .then(data => {
              Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "Payment successful and data saved!",
                toast: true,
                position: 'top-right',
                timer: 3000,
                timerProgressBar: true
              });

            })
            .catch(error => {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "Failed to save user data.",
                toast: true,
                position: 'top-right',
                timer: 3000,
                timerProgressBar: true
              });
            });
              // Collect data from the form
       carddata = {
        amount: document.getElementById('package_price').value,
        // Include customer information
        packageId: document.getElementById('package_id').value,
        package_name: document.getElementById('package_name').value,
        firstName: document.getElementById('firstName').value,
        lastName: document.getElementById('lastName').value,
        address: document.getElementById('address').value,
        zipCode: document.getElementById('zipCode').value,
        city: document.getElementById('city').value,
        state: document.getElementById('state').value,
        phone: document.getElementById('phone').value,
        email: document.getElementById('email').value,

        entry_fee: entry_fee,
        transactionId: result.transactionId

      };
          fetch('./action/send_to_zapier.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(carddata)
            })
            .then(response => response.json())
            .then(responseData => {
              console.log('Success:', responseData);
            })
            .catch(error => {
              console.error('Error:', error);
            });
        } else {
          console.error("Payment failed: " + (result.error || "An error occurred during payment processing."));
          alert("Payment failed: " + (result.error || "An error occurred during payment processing."));
        }
      } catch (error) {
        console.error("Error:", error);
        alert("An error occurred while processing the payment.");
      }
    });
  </script>


  <script>
    const termsCheckbox = document.getElementById('termsCheckbox');

    // Check if the checkbox state is stored in localStorage
    if (localStorage.getItem('termsAccepted') === 'true') {
      termsCheckbox.checked = true;
    }

    // Handle checkbox state change and store it in localStorage
    termsCheckbox.addEventListener('change', function() {
      localStorage.setItem('termsAccepted', termsCheckbox.checked);
    });

    // Handle Submit Button Click
    document.getElementById('submit').addEventListener('click', function() {
      if (!termsCheckbox.checked) {
        // Display warning using SweetAlert if checkbox is not checked
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'You must agree to the Terms and Conditions before submitting.',
          toast: true,
          position: 'top-right',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
          }
        });
      } else {
        // Success logic here
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: 'Form submitted successfully!',
          toast: true,
          position: 'top-right',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
          }
        }).then(() => {
          // Set a 3-second delay after the SweetAlert notification
          setTimeout(() => {
            window.location.href = "https://seanwhiteassociates.com/"; // Redirect to the specified URL
          }, 500);

        });

        // You can submit the form or other actions
        // document.querySelector('form').submit(); // Uncomment to submit form
      }
    });
    // Get the button element
    let finishBtn = document.querySelector('.Button-cgzqex-0');

    // Check if the button text is 'Finish'
    if (finishBtn.textContent.trim() === 'Finish') {
      finishBtn.classList.add('d-none'); // Add the 'd-none' class to hide the button
    } else {
      console.log('Button text is not "Finish"'); // Button text is not 'Finish', do nothing
    }
    // Optionally, clear localStorage after form submission or page refresh if needed:
    // localStorage.removeItem('termsAccepted');
  </script>


  <script>
    // Add keyup event listener to the email input
    document.getElementById('email').addEventListener('keyup', function() {
      const email = this.value;

      // Regular expression for email validation
      const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

      const emailFeedback = document.getElementById('emailFeedback');
      const nextBtn = document.getElementById('nextBtn');

      // Check if the email is in the correct format
      if (email && emailPattern.test(email)) {
        // Send AJAX request to check if the email exists
        fetch('./action/check_email.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({
              email: email
            }),
          })
          .then(response => response.json())
          .then(data => {
            if (data.exists) {
              emailFeedback.classList.remove('d-none');
              emailFeedback.textContent = 'Email already exists';
              nextBtn.classList.add('d-none');
              nextBtn.disabled = true; // Disable the Next button if email exists
            } else {
              emailFeedback.classList.add('d-none');
              nextBtn.classList.remove('d-none');
              nextBtn.disabled = false; // Enable the Next button if email does not exist
            }
          })
          .catch(error => console.error('Error:', error));
      } else if (email) {
        // If the email is not in valid format
        emailFeedback.classList.remove('d-none');
        emailFeedback.textContent = 'Please enter a valid email address';
        nextBtn.classList.add('d-none');
        nextBtn.disabled = true; // Disable the Next button for invalid email format
      } else {
        // If the email field is empty, hide feedback and disable the Next button
        emailFeedback.classList.add('d-none');
        nextBtn.classList.add('d-none');
        nextBtn.disabled = true;
      }
    });

    function showForm(url) {
      const iframe = document.getElementById('form-iframe');
      iframe.src = url;

      // Optionally: Log to console or show alert for testing
      console.log(`Loading form: ${url}`);
    }

    // Wait for the iframe to fully load
    window.addEventListener('load', function() {
      const iframe = document.getElementById('form-iframe');

      iframe.onload = function() {
        // Access the document inside the iframe
        const iframeDocument = iframe.contentDocument || iframe.contentWindow.document;

        // Select all buttons inside the iframe document
        const buttons = iframeDocument.querySelectorAll("button");

        // Loop through all buttons and find the one with the text "Finish"
        buttons.forEach(button => {
          if (button.textContent.trim() === "Finish") {
            // Add a click event listener to the button
            button.addEventListener("click", function() {
              alert("Finish button clicked inside iframe!");
            });
          }
        });

      };
    });
  </script>
  <script src="assets/js/eform-manage.js"></script>
</body>

</html>