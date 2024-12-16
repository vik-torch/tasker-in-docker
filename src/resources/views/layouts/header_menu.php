<?php

use App\Middleware\Auth\Authorisation;
?>
<nav class="navbar navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="/tasks">Задачник</a>

    <?php if (Authorisation::check_session()): ?>
        <a class="btn btn-info d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="/logout">Выход</a>
    <?php else: ?>
        <a class="btn btn-info d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="/login">Войти</a>
    <?php endif; ?>
</nav>