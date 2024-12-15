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

            <!-- Sort -->
            <div id="tasks_sort" class="d-none">
                <div class="dropdown d-flex justify-content-end">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Выберите сортировку
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="javascript:void(0);" data-name="name" data-sort="ASC">По имени пользователя <i class="bi bi-sort-numeric-up-alt"></i></a>
                        <a class="dropdown-item" href="javascript:void(0);" data-name="name" data-sort="DESC">По имени пользователя <i class="bi bi-sort-numeric-down"></i></a>
                        <a class="dropdown-item" href="javascript:void(0);" data-name="email" data-sort="ASC">По email <i class="bi bi-sort-numeric-up-alt"></i></a>
                        <a class="dropdown-item" href="javascript:void(0);" data-name="email" data-sort="DESC">По email <i class="bi bi-sort-numeric-down"></i></a>
                        <!-- <a class="dropdown-item active" href="javascript:void(0);" data-name="date" data-sort="ASC">По дате <i class="bi bi-sort-numeric-up-alt"></i></a> -->
                        <a class="dropdown-item" href="javascript:void(0);" data-name="status" data-sort="ASC">По статусу <i class="bi bi-sort-numeric-up-alt"></i></a>
                        <a class="dropdown-item" href="javascript:void(0);" data-name="status" data-sort="DESC">По статусу <i class="bi bi-sort-numeric-down"></i></a>
                    </div>
                </div>
            </div>
            <!-- Sort End -->

            <div id="tasks_list" class="comments_list__wr my-5"></div>
            <h3 class="empty_list_msg d-none my-5">Комментариев пока что нет, будьте первым!</h3>

            <!-- Pagination -->
            <nav id="task_pagination" aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                </ul>
            </nav>
            <!-- Pagination End -->


            
            <!-- Task_create form -->
            <div class="comments_form__wr my-4">
                <h3 class="mb-4">Создать задачу</h3>
                <form id="task_form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Имя пользователя</label>
                        <input type="text" class="form-control" id="name" placeholder="Имя пользователя" required>
                    </div>
                    <div class="form-group">
                        <label for="text">Текст</label>
                        <textarea class="form-control" id="text" rows="3" placeholder="Текст задачи" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
            <!-- Task_create form End -->

        </div>

        <!-- Task pattern -->
        <div id="card_pattern" class="d-none">
            <div class="task-card mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <div class="email"></div>
                            <div class="user_name"></div>
                        </div>

                        <div class="ml-auto">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input status" id="task_status" data-val="" disabled>
                                <label class="form-check-label" for="exampleCheck1">Статус задачи</label>
                            </div>
                            <a class="task-change d-none" href="javascript:void(0);">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="mb-0">
                            <p class="text">Текст</p>
                        </div>
                    </div>
                    <div class="card-footer d-none">
                        <a class="ml-auto" href="javascript:void(0);">Сохранить</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Task pattern End -->
    </body>

    <?=View::render('layouts/footer')?>

</html>