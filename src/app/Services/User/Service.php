<?php

namespace App\Services\User;

use App\Models\IUserModel;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\Repository as UserRepository;
use Core\Exceptions\ClientException;

class Service implements IUserService
{
    protected IUserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public function find(int $id)
    {
        // TODO: Implement find() method.
    }

    public function findOrCreate(IUserModel $user_model)
    {
        $user = $this->userRepository->findBy($user_model->getEmail());
        
        if (!$user) {
            $user_id =$this->userRepository->create($user_model);
            return $user_id;
        } else if ($user['name'] !== $user_model->getName()) {
            throw new ClientException('Пользователь с таким email уже зарегистрирован');
        }

        return $user['id'];
    }
}