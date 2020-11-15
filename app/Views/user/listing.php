<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список пользователей</title>
    <link rel="stylesheet" href="/themes/CraftTest/css/bootstrap.min.css">
    <link rel="stylesheet" href="/themes/CraftTest/css/style.css">
    <script src="/themes/CraftTest/js/zepto.min.js"></script>
</head>
<body>
<div class="wrapper">
    <div class="container">

        <div id="header-line" class="row">
            <div class="col-12">
                <h2>Test App For Craft Group</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mt-4"><?php Flight::render('_inc/menu'); ?></div>
            <div class="col-md-8">
                <div class="row">
                    <h1> Список пользователей </h1>
                </div>
                <div class="row">
                    <div class="col-12">
                        Сортировать по
                        <a href="/user_listing/?sort=1">Имени</a>
                        |
                        <a href="/user_listing/?sort=2">E-mail</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Имя</th>
                                    <th scope="col">E-mail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach ($users as $user) : ?>
                                    <tr>
                                        <th scope="row"><?=$user['id'];?></th>
                                        <td><?=$user['name'];?></td>
                                        <td><?=$user['email'];?></td>
                                    </tr>
                                <? endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>