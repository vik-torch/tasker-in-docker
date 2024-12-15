<?php

namespace App\Controllers\Task;

use App\Middleware\Auth\Authorisation;
use Core\Response\ErrorResponse;
use Core\Response\SuccessResponse;

class UpdateController extends BaseController
{
    public function index()
    {
        if (!Authorisation::check_session()) {
            return new ErrorResponse(null, 403, 'Необходима авторизация!');
        }

        $id = $_POST['id'];
        $text = $_POST['text'];
        $status = $_POST['status'];

        $this->taskService->update($id, $text, $status);
        
        return new SuccessResponse('Успешное сохранение!', 201);
    }
}