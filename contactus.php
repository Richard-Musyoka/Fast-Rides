<?php
	session_start();
    include "connect.php";
    include "Includes/templates/header.php";
    include "Includes/templates/navbar.php";
	include "Includes/functions/functions.php";

	if (isset($_POST['reserve_car']) && $_SERVER['REQUEST_METHOD'] === 'POST')
	{
		$_SESSION['pickup_location'] = test_input($_POST['pickup_location']);
		$_SESSION['return_location'] = test_input($_POST['return_location']);
		$_SESSION['pickup_date'] = test_input($_POST['pickup_date']);
		$_SESSION['return_date'] = test_input($_POST['return_date']);
	}
?>

<!-- BANNER SECTION -->
<div class = "reserve-banner-section">
	<h2>
		Reserve your car
	</h2>
</div>
 
<!-- CONTACT SECTION -->

<section class="contact-section" id="contact-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 sm-padding">
                <div class="contact-info">
                    <h2>
                        Get in touch with us & 
                        <br>send us message today!
                    </h2>
                    <p>
                        Getting dressed up and traveling with good friends makes for a shared, unforgettable experience.
                    </p>
                    <h3>
                        Fast Rides Yard
                        <br>
                        Uhuru Highway ,Nairobi
                    </h3>
                    <ul>
                        <li>
                            <span style = "font-weight: bold">Email:</span> 
                            info@fastridecars.com
                        </li>
                        <li>
                            <span style = "font-weight: bold">Phone:</span> 
                            +254 740 458 319
                        </li>
                        <li>
                            <span style = "font-weight: bold">Fax:</span> 
                           +254 740 458 319
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 sm-padding">
                <div class="contact-form">
                    <div id="contact_ajax_form" class="contactForm">
                        <div class="form-group colum-row row">
                            <div class="col-sm-6">
                                <input type="text" id="contact_name" name="name" class="form-control" placeholder="Name">
                            </div>
                            <div class="col-sm-6">
                                <input type="email" id="contact_email" name="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" id="contact_subject" name="subject" class="form-control" placeholder="Subject">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea id="contact_message" name="message" cols="30" rows="5" class="form-control message" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button id="contact_send" class="contact_send_btn">Send Message</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>