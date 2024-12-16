<?php

namespace App\Controllers\Task;

use Core\Response\ErrorResponse;
use Core\Response\SuccessResponse;

class StoreController extends BaseController
{
    public function index()
    {        
        $text = $_POST['text'];
        $user_name = $_POST['name'];
        $user_email = $_POST['email'];

        try {
            $this->taskService->create($text, $user_name, $user_email);
        } catch (\Exception $e) {
            return new ErrorResponse('', 500, 'Что-то пошло не так');
        }
        return new SuccessResponse('Задача успешно создана!', 201);
    }
}