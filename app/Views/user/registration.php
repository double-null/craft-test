<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
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

            <div class="row justify-content-md-center">
                <div class="col-md-5">
                    <form id="reg-form" class="px-5 py-3" method="POST">
                        <div class="row mt-3">
                            <div class="form-title text-center">Регистрация</div>
                            <div id="reg_status" style="display: none;"></div>
                        </div>
                        <div class="row mt-3">
                            <label>Имя</label>
                            <input type="text" name="User[name]">
                            <p id="name-error" class="error">
                                <? if ($formErrors['name']) : echo $formErrors['name']; endif; ?>
                            </p>
                        </div>
                        <div class="row mt-3">
                            <label>E-mail</label>
                            <input type="text" name="User[email]">
                            <p  id="email-error" class="error">
                                <? if ($formErrors['email']) : echo $formErrors['email']; endif; ?>
                            </p>
                        </div>
                        <div class="row mt-3">
                            <label>Пароль</label>
                            <input type="password" name="User[password]">
                            <p id="password-error" class="error">
                                <? if ($formErrors['password']) : echo $formErrors['password']; endif; ?>
                            </p>
                        </div>
                        <div class="row mt-3">
                            <label>Повторите пароль</label>
                            <input type="password" name="User[repswd]">
                        </div>
                        <div class="row mt-3">
                            <label>Проверочный код</label>
                            <input type="text" name="code">
                            <p id="code-error" class="error">
                                <?php if ($captchaError) : ?>Код введён не верно<? endif; ?>
                            </p>
                            <img class="mt-2" src="/captcha/">
                        </div>
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <div class="row mt-3">
                            <input class="form-btn" type="submit" value="Зарегистрироваться!">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="/themes/CraftTest/js/main.js"></script>
</body>
</html>