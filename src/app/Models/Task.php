<?php

namespace App\Models;

class Task implements ITaskModel
{
    private string $text;
    private int $user_id;
    private TaskStatus $status;
    private ?int $id;

    public function __construct(
        $text,
        $user_id,
        $status = TaskStatus::NEW,
        ?int $id = null,
    ) {
        $this->text = static::validateText($text);
        $this->user_id = $user_id;
        $this->status = $status;
        $this->id = $id;
    }

    public static function validateText($text): string
    {
        $text = trim($text);
        return htmlspecialchars($text);
    }

    public function getId(): int
    {
        return $this->id;
    }
    
    public function getText(): string
    {
        return $this->text;
    }
    
    public function getStatus(): string
    {
        return $this->status->value;
    }
    

    public function getUserId(): int
    {
        return $this->user_id;
    }
}