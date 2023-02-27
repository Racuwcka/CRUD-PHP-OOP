<?php
// page given in URL parameter, default page is one
$page = $_GET['page'] ?? 1;

// set number of records per page
$records_per_page = 5;

// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// include database and object files
include_once 'config/database.php';
include_once 'objects/city/City.php';
include_once 'objects/user/User.php';

// instantiate database and objects
$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$city = new City($db);

// query products
$stmt = $user->readAll($from_record_num, $records_per_page);
$stmt->store_result();
$stmt->bind_result($id, $name, $city_id);
$num_rows = $stmt->num_rows;

$num = ($page - 1) * $records_per_page;

$page_title = 'Добавление пользователя';
include_once "layout_header.php";
?>
    <div class='mb-3'>
        <a href="create_user.php" class="btn btn-success mb-3">Добавить пользователя</a>
    </div>
    <?php if($num_rows > 0): ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Имя</th>
            <th scope="col">Город</th>
            <th colspan="3" class="text-center">Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php while($stmt->fetch()): ?>
            <tr>
                <th scope="row"><?= ++$num ?></th>
                <td><?= $name ?></td>
                <td><?php $city->id = $city_id;
                          $city->readName();
                          echo $city->name; ?></td>
                <td class="text-center"><a href="#"><i class="fas fa-eye"></i></a></td>
                <td class="text-center">
                    <a href="read_one.php?id={$id}">
                        <i class="fas fa-pen text-success" role="button"></i>
                    </a>
                    <!--<form action="./crud/edit.php" method="Post">
                        <input type="hidden" name="id" value="<?/*= $id */?>">
                        <button type="submit" class="border-0 bg-transparent">

                        </button>
                    </form>-->
                </td>
                <td class="text-center">
                    <form action="./crud/delete.php" method="Post">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <button type="submit" class="border-0 bg-transparent">
                            <i class="fas fa-trash text-danger" role="button"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endwhile ?>
        </tbody>
    </table>
    <?php
    // the page where this paging is used
    $page_url = "index.php?";

    // count all products in the database to calculate total pages
    $total_rows = $user->countAll();

    // paging buttons here
    include_once 'paging.php';
    ?>
    <?php endif ?>
<?php include_once "layout_footer.php"; ?>