<?php

namespace App\Repositories\Task;

use App\Models\ITaskModel;
use App\Models\TaskStatus;
use Core\Database\MySQL\Repository as MySQLRepository;
use Core\Database\MySQL\OrderEnum;
use Throwable;

class Repository extends MySQLRepository implements ITaskRepository
{
    public const LIMIT = 3;

    public function create(ITaskModel $taskData)
    {
        $sth = $this->dbh->prepare(
            'INSERT INTO `tasks`
                (`text`, `user_id`)
                VALUES (:text, :user_id)'
            );
        $sth->execute([
            ':text' => $taskData->getText(),
            ':user_id' => $taskData->getUserId(),
        ]);

        return $this->dbh->lastInsertId();
    }

    public function findAll(
        int $page_num = 1,
        ?string $sort_by = null,
        ?OrderEnum $order = null
    ) {
        $offset = ($page_num - 1) * self::LIMIT;
        $query = 'SELECT 
                t.id,
                t.text,
                t.status,
                t.is_edit,
                u.name,
                u.email
                FROM `tasks` t
                JOIN `users` u ON t.user_id = u.id
                LIMIT :limit OFFSET :offset';

        $replace_params = [
            ':limit' => self::LIMIT,
            ':offset' => $offset
        ];

        if ($sort_by) {
            $query =str_replace('LIMIT', 'ORDER BY ' . $sort_by . ' ' . $order->value . ' LIMIT', $query);
        }

        $response = static::tryExecute(function () use ($query, $replace_params) {
            $sth = $this->dbh->prepare($query);

            $sth->execute($replace_params);
            return $sth->fetchAll();
        });

        return $response;
    }

    public function update(int $id, string $text, ?TaskStatus $status) {
        $query = 'UPDATE `tasks` SET %params%, `is_edit` = 1 WHERE `id` = :id';

        // TODO: будем считать, что такая запись есть

        $replace_params = [
            ':id' => $id,
        ];
        $matches = [];
        switch (true) {
            case ($text !== null):
                $matches[] = '`text` = :text';
                $replace_params[':text'] = $text;
            case ($status !== null):
                $matches[] = '`status` = :status';
                $replace_params[':status'] = $status->value;
        }
        $update_params_str = implode(', ', $matches);
        $query = str_replace('%params%', $update_params_str, $query);
        
        $response = static::tryExecute(function () use ($query, $replace_params) {
            $sth = $this->dbh->prepare($query);
            return $sth->execute($replace_params);
        });
        
        return $response;
    }

    public function getTotalCount(): int
    {
        $stmt = $this->dbh->query('SELECT COUNT(*) FROM `tasks`');
        return (int) $stmt->fetchColumn();
    }

    private static function tryExecute(callable $callback)
    {
        try {
            $response = $callback();
        } catch (Throwable $e) {
            // throw new ServerException();
            throw $e;
        }
        
        return $response;
    }
}