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
		$_SESSION['client_phone'] = test_input($_POST['client_phone']);
		$_SESSION['client_email'] = test_input($_POST['client_email']);
		$_SESSION['client_id_number'] = test_input($_POST['client_id_number']);
	}
?>

  
<!-- BANNER SECTION -->
<div class = "reserve-banner-section">
	<h2>
		Reserve your car
	</h2>
</div>

<!-- CAR RESERVATION SECTION -->
<section class="car_reservation_section">
	<div class="container">
		<?php
			if(isset($_POST['submit_reservation']) && $_SERVER['REQUEST_METHOD'] === 'POST')
			{
				$selected_car = $_POST['selected_car'];
				$full_name =$_SESSION['full_name'];
				$client_email =$_SESSION['client_email'];
				$client_id_number =$_SESSION['client_id_number'];
				$client_phone = $_SESSION['client_phone'];
				$pickup_location = $_SESSION['pickup_location'];
				$return_location = $_SESSION['return_location'];
				$pickup_date = $_SESSION['pickup_date'];
				$return_date = $_SESSION['return_date'];
				
				$con->beginTransaction();
				try

             {
					//Getting Client Table Current ID
					$stmtgetCurrentClientID = $con->prepare("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'car_rental' AND TABLE_NAME = 'clients'");
            
					$stmtgetCurrentClientID->execute();
					$client_id = $stmtgetCurrentClientID->fetch();
					
					//Inserting Client Details
					$stmtClient = $con->prepare("insert into clients(full_name,client_email,client_id_number,client_phone) 
									values(?,?,?,?)");
					$stmtClient->execute(array($full_name,$client_email,$client_id_number,$client_phone));

					//Inserting Reservation Details
					$stmt_appointment = $con->prepare("insert into reservations(client_id, car_id, pickup_date, return_date, pickup_location, return_location ) values(?, ?, ?, ?, ?, ?)");
                    $stmt_appointment->execute(array($client_id[0],$selected_car,$pickup_date,$return_date,$pickup_location,$return_location));
					
					echo "<div class = 'alert alert-success'>";
                        echo "Great! Your reservation has been created successfully.";
                    echo "</div>";

					$con->commit();
                }
                catch(Exception $e)
                {
                    $con->rollBack();
                    echo "<div class = 'alert alert-danger'>"; 
                        echo $e->getMessage();
                    echo "</div>";
                }
            }
			elseif (isset($_SESSION['pickup_date']) && isset($_SESSION['return_date']))
			{
				$pickup_location = $_SESSION['pickup_location'];
				$return_location = $_SESSION['return_location'];
				$pickup_date = $_SESSION['pickup_date'];
				$return_date = $_SESSION['return_date'];
				$full_name=$_SESSION['full_name'];
				$client_phone=$_SESSION['client_phone'];
				$client_id_number=$_SESSION['client_id_number'];
				$client_email=$_SESSION['client_email'];


				$stmt = $con->prepare("SELECT *
				from car_types
				where car_types.type_id not in (select car_id 
									 from reservations
									 where (? between pickup_date and return_date 
										 or ? BETWEEN pickup_date and return_date )
										 and canceled = 0
									 )");
                $stmt->execute(array($pickup_date, $return_date));
                $available_cars = $stmt->fetchAll();
				?>
			
					<form action = "reserve.php" method = "POST" id="reservation_second_form">
						<div class = "row" style = "margin-bottom: 20px;">
							<div class = "reservation_cards">
								<p>
									<i class="fas fa-calendar-alt"></i>
									<span>Pickup Date : </span><?php echo $_SESSION['pickup_date']; ?>
								</p>
							</div>
							<div class = "col-md-3 reservation_cards">
								<p>
									<i class="fas fa-calendar-alt"></i>
									<span>Return Date : </span><?php echo $_SESSION['return_date']; ?>
								</p>
							</div>
							<div class = "col-md-3 reservation_cards">
								<p>
									<i class="fas fa-map-marked-alt"></i>
									<span>Pickup Location : </span><?php echo $_SESSION['pickup_location']; ?>
								</p>
							</div>
								<div class = "col-md-3 reservation_cards">
								<p>
									<i class="fas fa-user"></i>
									<span>Client Name : </span><?php echo $_SESSION['full_name']; ?>
								</p>
							</div>
							
								<div class = "col-md-3 reservation_cards">
								<p>
									<i class="fas fa-phone-alt"></i>
									<span>Phone Number: </span><?php echo $_SESSION['client_phone']; ?>
								</p>
							</div>
								<div class = "col-md-3 reservation_cards">
								<p>
									<i class="fas fa-phone-alt"></i>
									<span>Email: </span><?php echo $_SESSION['client_email']; ?>
								</p>
							</div>
									<div class = "col-md-3 reservation_cards">
								<p>
									<i class="fas fa-info-circle"></i>
									<span>Id/Passport Number: </span><?php echo $_SESSION['client_id_number']; ?>
								</p>
							</div>
							<div class = " col-md-3 reservation_cards">
								<p>
									<i class="fas fa-map-marked-alt"></i>
									<span>Return Location : </span><?php echo $_SESSION['return_location']; ?>
								</p>
							</div>
						</div>
            
                            
           
						<div class = "row">
							<div class = "col-md-12">
								<div class="btn-group-toggle" data-toggle="buttons">
									<center>
									<div class="invalid-feedback" style = "display:block;margin: 10px 0px;font-size: 12px;font-family: cursive;" v-if="selected_car === null">
										<h3 style="color:purple;">Failure to return The Car on Agreed period will Incur you a Penalty of SH 1000 per every Extra Day</h3>
									</div>
								</center>
								<div class="invalid-feedback" style = "display:block;margin: 10px 0px;font-size: 15px;" v-if="selected_car === null">
										<h4 style="color:lawngreen;">Select your car</h4>
									</div>
									<div  class="items_tab">
										<?php

											foreach($available_cars as $car)
											{
												
												    
												echo "<div class='itemListElement'>";
												 echo "<td>";
													echo "<div class = 'item_details'>";

														echo "<div  style='padding-left:20px;text-style-type:bold;font-size:16px;'>";
															echo $car['type_label'];
														echo "</div>";
														
														echo "<div  style='padding-left:20px;'>";
															echo $car['type_description'];
														echo "</div>";
														 
														echo "<div  style='padding-left:20px;'>";
															echo $car['price_per_day'];
														echo "</div>";
													
														echo "<div style='padding-left:20px;width:300px; height:300px;'>";
															echo "<img   src = admin/Uploads/images/".$car['type_image']." alt = ".$car['type_label']." class = 'img-fluid img-thumbnail' >";
														echo "</div>";
														

														echo "<div class = 'item_select_part'>";
													?>
															<div class="select_item_bttn">
																<label class="item_label btn btn-secondary active">
																	<input type="radio" class="radio_car_select" name="selected_car" v-model = 'selected_car'>Select
																</label>	
															</div>
													<?php
														echo "</div>";
													echo "</div>";
												echo "</div>";
											}
										?>
				
                </div>
            </div>
        </div>

									</div>
							<button type="submit" class="btn sbmt-bttn" name = "submit_reservation">Book Instantly</button>

								</div> 
						</div>
						
					</form>

			<?php
			}
			else
			{
				?>
					<div style = "max-width:500px; margin:auto;">
						<div class = "alert alert-warning">
							Please, select first pickup and return date.
						</div>
						<button class = "btn btn-info" style = "display:block;margin:auto">
							<a href="./#reserve" style = "color:white">Homepage</a>
						</button>
					</div>
				<?php
			}
		?>

</div>
</section>


<!-- FOOTER BOTTOM -->

<?php include "Includes/templates/footer.php"; ?>


<script>

// new Vue({
//     el: "#reservation_second_form",
//     data: {
// 		selected_car : '',
//         full_name: '',
//         client_email: '',
//         client_id_number:'',
//         client_phone: '',
//     },
//     methods:{
//         checkForm: function(event){
//             if( this.full_name && this.client_email && this.client_phone && this.client_id_number)
//             {
//                 return true;
//             }
            
//             if (!this.full_name)
//             {
//                 this.full_name = null;
//             }

//             if (!this.client_email)
//             {
//                 this.client_email = null;
//             }

//             if (!this.client_phone)
//             {
//                 this.client_phone = null;
//             }
//                  if (!this.client_id_number
//                  	)
//             {
//                 this.client_id_number = null;
//             }

// 			if (!this.selected_car)
//             {
//                 this.selected_car = null;
//             }
            
//             event.preventDefault();
//         },
//     }
// })


</script>






