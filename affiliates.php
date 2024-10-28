<?php

$GLOBALS['title'] = "Credit Repair Affiliate Program ($100+ per!) | Sean White & Associates";
$GLOBALS['desc'] = "Learn more about the Sean White & Associates Affiliate program, here. Earn $100 for every successful signup you generate.";
$GLOBALS['keywords'] = "affiliate program, credit repair, earn money";
include('header.php');
?>



<section class="affiliates">
  <div class="container">
    <div class="affiliates-heading">
      <h1 class="section-heading">
        Credit Repair Affiliate Program ($100+)
      </h1>
      <p class="section-paragraph">
        Earn money while changing the world of credit, today!
      </p>
    </div>
    <ul class="affiliates-list">
      <li><img src="./assets/img/tick.svg" alt="">
        <p class="section-paragraph">Earn leading Credit Repair industry commission rates (up to $100).</p>
      </li>
      <li><img src="./assets/img/tick.svg" alt="">
        <p class="section-paragraph">Low cancellation rates (our customer satisfaction rate is over 98%).</p>
      </li>
      <li><img src="./assets/img/tick.svg" alt="">
        <p class="section-paragraph">A dedicated account manager to help you every step of the way.</p>
      </li>
      <li><img src="./assets/img/tick.svg" alt="">
        <p class="section-paragraph">High conversion rates.</p>
      </li>
      <li><img src="./assets/img/tick.svg" alt="">
        <p class="section-paragraph">Incredible customer service (M-F: 9am - 8pm, Weekends: 9am-5pm).</p>
      </li>
    </ul>
  </div>
  <div class="get-started">
    <form id="affiliatesForm">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="firstName" class="form-label">First Name</label>
          <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="lastName" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="phone" class="form-label">Phone</label>
          <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone" required>
        </div>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>

  </div>
</section>





<?php include('reviews.php'); ?>

<?php include('footer.php'); ?>
<script>
document.getElementById('affiliatesForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        
        // Create an object to hold form data
        const formData = {
            firstName: document.getElementById('firstName').value,
            lastName: document.getElementById('lastName').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value
        };
        
        // Send data as JSON
        fetch('./action/send_to_zapier.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            // Handle success
            console.log('Success:', data);
            alert('Form submitted successfully!');
        })
        .catch((error) => {
            // Handle error
            console.error('Error:', error);
            alert('There was an error submitting the form.');
        });
    });
</script>