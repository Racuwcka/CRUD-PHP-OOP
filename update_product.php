<?php
// get ID of the user to be edited
$id = $_GET['id'] ?? die('ERROR: missing ID.');

// include database and object files
include_once 'config/database.php';
include_once 'objects/city/City.php';
include_once 'objects/user/User.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects
$user = new User($db);
$city = new City($db);

// set ID property of user to be edited
$user->id = $id;

// read the details of user to be edited
$user->readOne();

// set page header
$page_title = "Update Product";
include_once "layout_header.php";

echo "<div class='right-button-margin'>
          <a href='index.php' class='btn btn-default pull-right'>Read Products</a>
     </div>";
?>
<?php
// if the form was submitted
if($_POST){

    // set user property values
    $user->name = $_POST['name'];
    $user->city_id = $_POST['city_id'];

    // update the user
    if($user->update()){
        echo "<div class='alert alert-success alert-dismissable'>
            Product was updated.
        </div>";
    }

    // if unable to update the user, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>
            Unable to update user.
        </div>";
    }
}
?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
        <table class='table table-hover table-responsive table-bordered'>

            <tr>
                <td>Name</td>
                <td><input type='text' name='name' value='<?php echo $user->name; ?>' class='form-control' /></td>
            </tr>

            <tr>
                <td>Category</td>
                <td>
                    <?php
                    $stmt = $city->read();

                    // put them in a select drop-down
                    echo "<select class='form-control' name='city_id'>";

                    echo "<option>Please select...</option>";
                    while ($row_city = $stmt->fetch()){
                        $city_id=$row_city['id'];
                        $city_name = $row_city['name'];

                        // current city of the user must be selected
                        if($user->city_id==$city_id){
                            echo "<option value='$city_id' selected>";
                        }else{
                            echo "<option value='$city_id'>";
                        }

                        echo "$city_name</option>";
                    }
                    echo "</select>";
                    ?>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary">Update</button>
                </td>
            </tr>

        </table>
    </form>
<?php
// set page footer
include_once "layout_footer.php";