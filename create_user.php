<?php
// include database and object files
include_once 'config/database.php';
include_once 'objects/city/City.php';
include_once 'objects/user/User.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects
$user = new User($db);
$city = new City($db);

$page_title = 'Добавление пользователя';
include_once "layout_header.php";
?>
    <div class='mb-3'>
        <a href='index.php' class='btn btn-outline-primary'>Список пользователей</a>
    </div>
<?php if ($_POST): ?>
    <?php
        $user->name = $_POST['name'];
        $user->city_id = $_POST['city_id'];
    ?>
    <!-- create the product -->
    <?php if ($user->create()): ?>
        <div class='alert alert-success w-25'>Пользователь добавлен.</div>
    <?php else: ?>
        <div class='alert alert-danger w-25'>Не удается добавить пользователя.</div>
    <?php endif ?>
<?php endif ?>
    <!-- HTML form for creating a product -->
    <div class="w-25">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Имя пользователя">
            </div>
            <!-- read the product categories from the database -->
            <?php
                $stmt = $city->read();
                $stmt->bind_result($id, $name);
            ?>
            <div class="mb-3">
                <select class='form-control' name='city_id'>
                    <?php while ($stmt->fetch()): ?>
                    <option value='<?= $id ?>'><?= $name ?></option>
                    <?php endwhile ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Добавить пользователя</button>
        </form>
    </div>
<?php include_once "layout_footer.php"; ?>