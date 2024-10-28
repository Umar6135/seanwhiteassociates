<?php

$GLOBALS['title'] = "Sean White & Associates - Log In to Online Portal";
$GLOBALS['desc'] = "Sean White & Associates - Log In to Online Portal.";
$GLOBALS['keywords'] = "online portal, login, credit services";
include('header.php');
?>

<div class="packages-banner">
  <div class="container">
    <div class="packages-banner-content">
      <h1> <span class="line">Leading</span> the Industry in Credit Repair and Business Financing</h1>
      <p>We offer the most comprehensive service available in the industry today.</p>
    </div>
  </div>
</div>
<div class="container text-center">
  <iframe name=frame_login id=frame_login src="https://www.secureclientaccess.com/login/post" height="700" width="713" className="no-border" title="CRC" style="background:white"  ></iframe>
</div>
<?php include('reviews.php'); ?>



<!-- Callback Start -->
<section id="callback" class=" callback mb-5 py-5">
  <div class="container pt-5">
    <div class="row justify-content-center">
      <div class="col-lg-7">
        <div class="bg-white border rounded p-4 p-sm-5 wow fadeInUp" data-wow-delay="0.5s">
          <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Get In Touch
            </p>
            <h5 class="display-5 mb-5">Request A Call-Back</h5>
          </div>
          <div class="row g-3">
            <div class="col-sm-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="name" placeholder="Your Name">
                <label for="name">Your Name</label>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-floating">
                <input type="email" class="form-control" id="mail" placeholder="Your Email">
                <label for="mail">Your Email</label>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="mobile" placeholder="Your Mobile">
                <label for="mobile">Your Mobile</label>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="subject" placeholder="Subject">
                <label for="subject">Subject</label>
              </div>
            </div>
            <div class="col-12">
              <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a message here" id="message"
                  style="height: 100px"></textarea>
                <label for="message">Message</label>
              </div>
            </div>
            <div class="col-12 text-center">
              <button class="btn btn-primary w-100 py-3" type="submit">Submit Now</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Callback End -->
<?php include('footer.php'); ?>