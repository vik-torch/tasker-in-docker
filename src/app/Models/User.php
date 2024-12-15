<?php

namespace App\Models;

class User implements IUserModel
{
    private string $name;
    private string $email;
    private ?int $id = null;
    
    public function __construct(
        $name,
        $email,
        ?int $id = null,
    ) {
        $this->name = static::validateName($name);
        $this->email = static::validateEmail($email);
        $this->id = $id;
    }

    private static function validateEmail($email): string
    {
        $email = trim($email);
        $email = htmlspecialchars($email);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email) {
            throw new \Exception('Некорректный email');
        }
        
        return $email;
    }

    private static function validateName($name): string
    {
        $name = trim($name);
        if (!is_string($name) || strlen($name) < 2) {
            throw new \Exception('Некорректное имя');
        }
        return htmlspecialchars($name);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}