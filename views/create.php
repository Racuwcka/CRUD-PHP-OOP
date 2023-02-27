<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./../fontawesome-free/css/all.min.css">
    <title>CRUD</title>
</head>
<body>
<div class="container">
    <div class="row">
        <form action="./../crud/create.php" method="Post" class="mt-3 w-50 m-auto">
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Имя пользователя">
            </div>
            <div class="mb-3">
<!--                <select id="disabledSelect" class="form-select">-->
<!--                    <option></option>-->
<!--                </select>-->
                <input type="text" name="city_id" class="form-control" placeholder="Город">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
