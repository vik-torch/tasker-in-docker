<?php

namespace App\Services\Task;

use App\DTO\TaskDTO;
use App\DTO\TasksDTO;
use App\Repositories\Task\Repository as TaskRepository;
use App\Repositories\Task\ITaskRepository;
use App\Models\Task as TaskModel;
use App\Models\TaskStatus;
use App\Models\User;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\Repository as UserRepository;
use App\Services\User\IUserService;
use Core\Database\MySQL\OrderValidate;
use App\Services\User\Service as UserService;
use Core\Exceptions\ClientException;

class Service implements ITaskService
{
    use OrderValidate;

    private ITaskRepository $taskRepository;
    private IUserRepository $userRepository;
    private IUserService $userService;

    public function __construct()
    {
        $this->taskRepository = new TaskRepository();
        $this->userRepository = new UserRepository();
        $this->userService = new UserService();
    }

    public function create($text, $user_name, $user_email)
    {
        try {
            $this->taskRepository->beginTransaction();

            $user_model = new User($user_name, $user_email);

            $user_id = $this->userService->findOrCreate($user_model);
            
            $task_model = new TaskModel($text, $user_id);
            $this->taskRepository->create($task_model);

            $this->taskRepository->commit();
        } catch (\Throwable $e) {
            $this->taskRepository->rollBack();
            throw $e;
        }
    }

    /**
     * Возвращает список задач
     * @param int $page_num - номер страницы
     * @return TaskDTO[]
     */
    public function getAll(int $page_num, $sort_by = null, $order = null): TasksDTO
    {
        // TODO: продумать логику кеширования
        $tasks = [];

        $sort_by = match ($sort_by) {
            'status' => 't.status',
            'name' => 'u.name',
            'email' => 'u.email',
            default => null
        };

        static::validateOrder($order, $sort_by);

        $response = $this->taskRepository->findAll($page_num, $sort_by, $order);
        foreach ($response as $raw_task) {
            $task = new TaskDTO(
                $raw_task['id'],
                $raw_task['text'],
                $raw_task['status'],
                $raw_task['name'],
                $raw_task['email'],
                $raw_task['is_edit']
            );
            $tasks[] = $task;
        };

        return new TasksDTO($tasks, $this->getTotalPages(), $page_num);
    }

    public function update($raw_id, $text, $status)
    {
        $id = (int)$raw_id;
        if ($id != $raw_id) {
            throw new ClientException();
        }
        
        $text = TaskModel::validateText($text);
        $status = TaskStatus::from($status);

        $this->taskRepository->update($id, $text, $status);
    }

    public function getTotalCount(): int
    {
        // TODO: продумать логику кеширования
        return $this->taskRepository->getTotalCount();
    }

    public function getTotalPages(): int
    {
        return ceil($this->getTotalCount() / TaskRepository::LIMIT);
    }
}