<?php
use Core\View\View;
?>
<!DOCTYPE html>
<html>

    <?=View::render('layouts/head')?>

    <body>

        <!-- Header -->
        <header>
            <?=View::render('layouts/header_menu')?>
        </header>
        <!-- Header End -->

        <div class="container mt-5">

        <form>
            <div class="form-group row">
                <label for="login" class="col-sm-2 col-form-label">Логин</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="login" value="email@example.com">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Пароль</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Войти</button>
                </div>
            </div>
        </form>

        </div>

    </body>

    <?=View::render('layouts/footer')?>

</html>