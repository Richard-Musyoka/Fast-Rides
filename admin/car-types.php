<?php
    session_start();

    //Page Title
    $pageTitle = 'Car Types';

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
                <h1 class="h3 mb-0 text-gray-800">Car Types</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i>
                    Generate Report
                </a>
            </div>

            <!-- ADD NEW TYPE SUBMITTED -->
            <?php
                if (isset($_POST['add_type_sbmt']) && $_SERVER['REQUEST_METHOD'] === 'POST')
                {
                    $type_label = test_input($_POST['type_label']);
                    $type_description = test_input($_POST['type_description']);
                    $price_per_day = test_input($_POST['price_per_day']);
                     $type_image = rand(0,100000).'_'.$_FILES['brand_image']['name'];
                    move_uploaded_file($_FILES['brand_image']['tmp_name'],"Uploads/images//".$type_image);
                    try
                    {
                        $stmt = $con->prepare("insert into car_types(type_label,type_description,price_per_day,type_image) values(?,?,?,?) ");
                        $stmt->execute(array($type_label,$type_description,$price_per_day,$type_image));
                        echo "<div class = 'alert alert-success'>";
                            echo 'New Car Type has been inserted successfully';
                        echo "</div>";
                    }
                    catch(Exception $e)
                    {
                        echo "<div class = 'alert alert-danger'>";
                            echo 'Error occurred: ' .$e->getMessage();
                        echo "</div>";
                    }
                }
                if (isset($_POST['delete_type_sbmt']) && $_SERVER['REQUEST_METHOD'] === 'POST')
                {
                    $type_id = $_POST['type_id'];
                    try
                    {
                        $stmt = $con->prepare("DELETE FROM car_types where type_id = ?");
                        $stmt->execute(array($type_id));
                        echo "<div class = 'alert alert-success'>";
                            echo 'Car Type has been deleted successfully';
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

            <!-- Car Types Table -->
            <?php
                $stmt = $con->prepare("SELECT * FROM car_types");
                $stmt->execute();
                $rows_types = $stmt->fetchAll(); 
            ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Car Types</h6>
                </div>
                <div class="card-body">

                    <!-- ADD NEW TYPE BUTTON -->
                    <button class="btn btn-success btn-sm" style="margin-bottom: 10px;" type="button" data-toggle="modal" data-target="#add_new_type" data-placement="top">
                        <i class="fa fa-plus"></i> 
                        Add New Type
                    </button>

                    <!-- Add New Type Modal -->
                    <div class="modal fade" id="add_new_type" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Type</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="car-types.php" method = "POST" v-on:submit = "checkForm" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="type_label">Type Label</label>
                                            <input type="text" id="type_label" class="form-control" placeholder="Type Label" name="type_label" v-model = "type_label">
                                            <div class="invalid-feedback" style = "display:block" v-if="type_label === null">
                                                Type label is required
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="type_description">Type Description</label>
                                            <textarea id="type_description" class="form-control" name="type_description" v-model = "type_description"></textarea>
                                            <div class="invalid-feedback" style = "display:block" v-if="type_description === null">
                                                Type description is required
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="price_per_day">Price Per Day in Kshs.</label>
                                            <input type="text" id="price_per_day" class="form-control" name="price_per_day" v-model = "price_per_day">
                                            <div class="invalid-feedback" style = "display:block" v-if="price_per_day === null">
                                                Price Per Day is required
                                            </div>
                                        </div>
                                            <div class="form-group">
                                            <label for="brand_image">Type image</label>
                                            <input type="file" id="brand_image_input" class="form-control" name="brand_image" @change="onFileChange">
                                            <div class="invalid-feedback" style = "display:block" v-if="brand_image === null">
                                                Type image is required
                                            </div>
                                            <div id="preview">
                                                <img v-if="brand_image" :src="brand_image" style = "max-width: 100%;max-height: 500px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-info" name="add_type_sbmt">Add Type</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Types Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Type ID</th>
                                    <th>Type Label</th>
                                    <th>Type Description</th>
                                    <th>Price Per Day</th>
                                    <th>Image</th>
                                    <th>Manage</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <?php
                                foreach($rows_types as $type)
                                {
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $type['type_id'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $type['type_label'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $type['type_description'];
                                        echo "</td>";
                                         echo "<td>";
                                            echo $type['price_per_day'];
                                        echo "</td>";
                                         echo "<td style = 'width:30%'>";
                                            echo "<img src = Uploads/images/".$type['type_image']." alt = ".$type['type_label']." class = 'img-fluid img-thumbnail' >";
                                        echo "</td>";
                                        echo "<td>";
                                            $delete_data = "delete_".$type["type_id"];
                                            ?>
                                            <!-- DELETE BUTTON -->
                                            <ul>

                                                <li class="list-inline-item" data-toggle="tooltip" title="Delete">
                                                    <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal" data-target="#<?php echo $delete_data; ?>" data-placement="top"><i class="fa fa-trash"></i></button>
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="<?php echo $delete_data; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $delete_data; ?>" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="car-types.php" method = "POST">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Type</h5>
                                                                        <input type="hidden" value = "<?php echo $type['type_id']; ?>" name = "type_id">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete this type "<?php echo $type['type_label']; ?>"?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" name = "delete_type_sbmt" class="btn btn-danger">Delete</button>
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
    el: "#add_new_type",
    data: {
        type_label: '',
        type_description: '',
        brand_image:''
    },
    methods:{
        checkForm: function(event){
            if( this.type_label && this.type_description)
            {
                return true;
            }
            
            if (!this.type_label)
            {
                this.type_label = null;
            }

            if (!this.type_description)
            {
                this.type_description = null;
            }
              if (!this.brand_image)
            {
                this.brand_image = null;
            }
            
            event.preventDefault();
        },
    }
})


</script>