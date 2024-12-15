<?php

namespace App\Controllers\Task;

class StoreController extends BaseController
{
    public function index()
    {        
        $text = $_POST['text'];
        $user_name = $_POST['name'];
        $user_email = $_POST['email'];

        $this->taskService->create($text, $user_name, $user_email);
        
        // return '{"status":"201","message":"Успешное сохранение!"}';
        return json_encode([
            'status' => '201',
            'message' => 'Успешное сохранение!'
        ]);
    }
}