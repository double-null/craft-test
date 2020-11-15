<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание API-ключа</title>
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
                    <h1> Создание API-ключа </h1>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?php if($key) : ?>
                            Текущий ключ: <?php echo $key['token_key']; ?>
                            Истекает: <?php echo date('H:i:s d-m-Y', $key['period']); ?>
                        <?php else : ?>
                            Ключ не создан
                        <? endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="/key_gen/?create=1">Сгенерировать ключ!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>