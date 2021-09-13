.<?php
    session_start();
     require('fpdf16/fpdf.php'); 

    //Page Title
    $pageTitle = 'Payments';

    //Includes
    include 'connect.php';
    include 'Includes/functions/functions.php'; 
    include 'Includes/templates/header.php';

    //Check If user is already logged in
    if(isset($_SESSION['username_yahya_car_rental']) && isset($_SESSION['password_yahya_car_rental']))
    {
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
    
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Payments</h1>
                <a href="generate_report.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i>
                    Generate Report
                </a>
            </div>
            <!-- Add new Payment SUBMITTED -->
            <?php
                if (isset($_POST['add_payment_sbmt']) && $_SERVER['REQUEST_METHOD'] === 'POST')
                {
                    $payment_name = test_input($_POST['payment_name']);
                  $amount = test_input($_POST['amount']);
                      $payment_date = test_input($_POST['payment_date']);
                   
                    try
                    {
                        $stmt = $con->prepare("insert into payments(payment_name,amount,payment_date) values(?,?,?) ");
                        $stmt->execute(array($payment_name,$amount,$payment_date));
                        echo "<div class = 'alert alert-success'>";
                            echo 'New Payments has been inserted successfully';
                        echo "</div>";
                    }
                    catch(Exception $e)
                    {
                        echo "<div class = 'alert alert-danger'>";
                            echo 'Error occurred: ' .$e->getMessage();
                        echo "</div>";
                    }
                }
                if (isset($_POST['delete_payment_sbmt']) && $_SERVER['REQUEST_METHOD'] === 'POST')
                {
                    $payment_id = $_POST['payment_id'];
                    try
                    {
                        $stmt = $con->prepare("DELETE FROM payments where payments_id = ?");
                        $stmt->execute(array($payments_id));
                        echo "<div class = 'alert alert-success'>";
                            echo 'Payment has been deleted successfully';
                        echo "</div>";
                    }
                    catch(Exception $e)
                    {
                        echo "<div class = 'alert alert-danger'>";
                            echo 'Error occurred: ' .$e->getMessage();
                        echo "</div>";
                    }
                }
            ?>
            <!-- Car Brands Table -->
            <?php
                $stmt = $con->prepare("SELECT * FROM payments");
                $stmt->execute();
                $rows_payment = $stmt->fetchAll();
            ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Payments</h6>
                </div>
                <div class="card-body">

                    <!-- Add new Payment BUTTON -->
                    <button class="btn btn-success btn-sm" style="margin-bottom: 10px;" type="button" data-toggle="modal" data-target="#add_new_payment" data-placement="top">
                        <i class="fa fa-plus"></i> 
                        Add new Payment
                    </button>

                    <!-- Add new Payment Modal -->
                    <div class="modal fade" id="add_new_payment" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add new Payment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="payments.php" method = "POST" @submit="checkForm"  enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="payment_name">Payers NAme</label>
                                            <input type="text" id="payment_name_input" class="form-control" placeholder="PAyer's name" name="payment_name" v-model="payment_name">
                                            <div class="invalid-feedback" style = "display:block" v-if="payment_name === null">
                                                Payers Name is required
                                            </div>
                                        </div>
                                          <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="text" id="amount_input" class="form-control" placeholder="amount" name="amount" v-model="amount">
                                            <div class="invalid-feedback" style = "display:block" v-if="amount === null">
                                               Amount Paid is required
                                            </div>
                                        </div>
                                       
                                         <div class="form-group">
                                            <label for="payment_date">Date</label>
                                            <input type="text" id="payment_date_input" class="form-control" placeholder="Date" name="payment_date" v-model="payment_date">
                                            <div class="invalid-feedback" style = "display:block" v-if="payment_date === null">
                                                Payers Date is required
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-info" name = "add_payment_sbmt">Add Payment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Payments Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Payment ID</th>
                                    <th>Payers Name</th>
                                    <th>Amount paid</th>
                                    <th>date</th>
                                    <th>Manage</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <?php
                                foreach($rows_payment as $payment)
                                {
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $payment['payment_id'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $payment['payment_name'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $payment['amount'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $payment['payment_date'];
                                        echo "</td>";
                                        
                                        echo "<td>";
                                            $delete_data = "delete_".$payment["payment_id"];
                                            ?>
                                            <!-- DELETE BUTTON -->
                                            <ul>
                                                 <li class="list-inline-item" data-toggle="tooltip" title="Edit">
                                                    <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="modal" ><i class="fa fa-edit"></i></button>
                                                </li>
                                                <li class="list-inline-item" data-toggle="tooltip" title="Delete">
                                                    <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal" data-target="#<?php echo $delete_data; ?>" data-placement="top"><i class="fa fa-trash"></i></button>
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="<?php echo $delete_data; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $delete_data; ?>" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="payments.php" method = "POST">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Payment</h5>
                                                                        <input type="hidden" value = "<?php echo $payment['payment_id']; ?>" name = "payment_id">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete this Payment "<?php echo $payment['payment_name']; ?>"?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" name = "delete_payment_sbmt" class="btn btn-danger">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <?php
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
  
<?php 
        
        //Include Footer
        include 'Includes/templates/footer.php';
    }
    else
    {
        header('Location: index.php');
        exit();
    }

?>


<script>

new Vue({
    el: "#add_new_payment",
    data: {
        errors: [],
        payment_name: '',
        amount: ''
    },
    methods:{
        checkForm: function(event){
            if( this.payment_name && this.amount)
            {
                return true;
            }

            this.errors = [];

            if( !this.payment_name)
            {
                this.errors.push("Payers name is required");
                this.payment_name = null;
            }
            if( !this.amount)
            {
                this.errors.push("Amount is required");
                this.amount = null;
            }
            
            

            event.preventDefault();
        },
        onFileChange(e) {
            const file = e.target.files[0];
            this.amount = URL.createObjectURL(file);
        }
    }
})


</script>