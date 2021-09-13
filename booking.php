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
   $_SESSION['full_name'] = test_input($_POST['full_name']);
    $_SESSION['client_email'] = test_input($_POST['client_email']);
    $_SESSION['client_phone'] = test_input($_POST['client_phone']);
   $_SESSION['client_id_number'] = test_input($_POST['client_id_number']);
	}
?>

<!-- BANNER SECTION -->
<div class = "reserve-banner-section">
	<h2>
		Make a Booking Today with Us 
	</h2>
</div>



<!-- CAR RESERVATION SECTION -->
<section class="reservation_section" style = "padding:50px 0px; margin-top: 50px;" id = "reserve">
	<div class="container">
		<div class = "row">
			<div class = "col-md-5">
       
        <div class="container1">
            <div class="contactinfo">
                <div class="Box">
                    <div class="icon">
                        <i class="fa fa-map-marker" aria-hidden="true"></i> 
                    </div>
                    <div class="text">
                        <h3>Address</h3>
                        <p>110 Nairobi ,<br>ALong Uhuru Highway, <br>90131  ,<br> Nairobi <br>Kenya  </p>
                    </div>
                </div>

                <br>

                <div class="Box">
                    <div class="icon">
                        <i class="fa fa-phone" aria-hidden="true"></i> 
                    </div>
                    <div class="text">
                        <h3>Phone</h3>
                        <p>(+254)740 458 319/ (+254) 733 728 926</p>
                    </div>
                </div>
                
            <br>
             <br>
                   <br>
                     <br>
                       

            <div class="Box">
                    <div class="icon">
                        <i class="fa fa-envelope" aria-hidden="true"></i> 
                    </div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>info@fastridecars.com</p>
                    </div>
                </div>

            </div>
        </div>

            </div>
			<div class = "col-md-7">
				<form method="POST" action = "reserve.php" class = "car-reservation-form" id = "reservation_form" v-on:submit = "checkForm">
					<div class="text_header">
						<span>
							Find your car
						</span>
					</div>
					<div>
						<div class = "form-group">
							<label for="pickup_location">Select a Location and Enter it Below in the Element below </label><br>
              
           

                <input  type = "text" class = "form-control" list="pickup_branches" name = "pickup_location" placeholder = "34 Mainfield Road" v-model = 'pickup_location'/>
                <datalist id="pickup_branches">
                   <option> Fast Rides  Nairobi branch </option>
              <option> Fast Rides  Tala branch </option>
              <option> Fast Rides Kitui branch </option>
              <option> Fast Rides  Kisumu branch </option>
              <option> Fast Rides  Eldoret branch </option>
              <option> Fast Rides  Mombasa branch </option>
                </datalist>
             
							<div class="invalid-feedback" style = "display:block" v-if="pickup_location === null">
								Pickup location is required
							</div>
						</div>
						<div class = "form-group">
							<label for="return_location">Return Location</label><br>
							<input type = "text" class = "form-control" name = "return_location" placeholder = "34 Mainfield Road" list="return_branches" v-model = 'return_location'/>
              <datalist id="return_branches">
              <option> Fast Rides  Nairobi branch </option>
              <option> Fast Rides  Tala branch </option>
              <option> Fast Rides Kitui branch </option>
              <option> Fast Rides  Kisumu branch </option>
              <option> Fast Rides  Eldoret branch </option>
              <option> Fast Rides  Mombasa branch </option>
              
              </datalist>
							<div class="invalid-feedback" style = "display:block" v-if="return_location === null">
								Return location is required
							</div>
						</div>
						<div class = "form-group">
							<label for="pickup_date">Pickup Date</label>

							<input type = "date" min = "<?php echo date('Y-m-d', strtotime("+1 day"))?>" name = "pickup_date" class = "form-control" v-model = 'pickup_date'>
							<div class="invalid-feedback" style = "display:block" v-if="pickup_date === null">
								Pickup date is required
							</div>
						</div>
						<div class = "form-group">
							<label for="return_date">Return Date</label>
							<input type = "date" min = "<?php echo date('Y-m-d', strtotime("+2 day"))?>" name = "return_date"  class = "form-control" v-model = 'return_date'>
							<div class="invalid-feedback" style = "display:block" v-if="return_date === null">
								Return date is required
							</div>
						</div>
            <div class = "form-group">
              <label for="full_name">Full Name</label>
              <input type = "text" name = "full_name"  class = "form-control" v-model = 'full_name'>
              <div class="invalid-feedback" style = "display:block" v-if="full_name === null">
                Full Name is required
              </div>
            </div>

            <div class = "form-group">
              <label for="client_phone">Phone Number</label>
              <input type = "text" name = "client_phone"  class = "form-control" v-model = 'client_phone'>
              <div class="invalid-feedback" style = "display:block" v-if="client_phone === null">
                Phone Number is required
              </div>
            </div>
                <div class = "form-group">
              <label for="client_email">Client Email</label>
              <input type = "email " name = "client_email"  class = "form-control" v-model = 'client_email'>
              <div class="invalid-feedback" style = "display:block" v-if="client_email === null">
               Enter Email
              </div>
            </div>

            <div class = "form-group">
              <label for="client_id_number">ID Number/Passport Number</label>
              <input type = "number " name = "client_id_number"  class = "form-control" v-model = 'client_id_number'>
              <div class="invalid-feedback" style = "display:block" v-if="client_id_number === null">
               ID Number/Passport Number  is required
              </div>
            </div>

        
                  
                </div>
              </div>
						<!-- Submit Button -->
						<button style="margin-top: 10px;" type="submit" class="btn sbmt-bttn" name = "reserve_car">Book Instantly</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<!------------------- Facts Carousel ---------------------->
<section class="fun-facts-section" style=" margin-top: 50px;" >
  <div class="container div_zindex">
    <div class="row">
      <div class="col-lg-3 col-xs-6 col-sm-3" >
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-calendar" aria-hidden="true"></i>40+</h2>
            <p>Years In Business</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-car" aria-hidden="true"></i>1200+</h2>
            <p>New Cars For Sale</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-car" aria-hidden="true"></i>1000+</h2>
            <p>Used Cars For Sale</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell" >
            <h2 ><i class="fa fa-user-circle-o" aria-hidden="true"></i>600+</h2>
            <p>Satisfied Customers</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- BOTTOM FOOTER -->
<?php include "Includes/templates/footer.php"; ?>

<script>

new Vue({
    el: "#reservation_second_form",
    data: {
    selected_car : '',
        full_name: '',
        client_email: '',
        client_phonenumber: '',
    },
    methods:{
        checkForm: function(event){
            if( this.full_name && this.client_email && this.client_phonenumber)
            {
                return true;
            }
            
            if (!this.full_name)
            {
                this.full_name = null;
            }

            if (!this.client_email)
            {
                this.client_email = null;
            }

            if (!this.client_phone)
            {
                this.client_phone = null;
            }

      if (!this.selected_car)
            {
                this.selected_car = null;
            }
            
            event.preventDefault();
        },
    }
})


</script>


