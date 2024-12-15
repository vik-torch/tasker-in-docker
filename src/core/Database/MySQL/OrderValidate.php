<?php

namespace Core\Database\MySQL;

trait OrderValidate
{
    /**
     * Валидирует значение сортировки $order.
     * Присваивает ему значение OrderEnum|null
     * @param mixed $order
     * @param mixed $sort_by
     * @return void
     */
    public static function validateOrder(&$order, $sort_by): void
    {
        if (!$sort_by) {
            $order = null;
            return;
        }
        
        if ($sort_by && !$order) {
            $order = OrderEnum::ASC;
            return;
        }

        $order = match (strtolower($order)) {
            'asc' => OrderEnum::ASC,
            'desc' => OrderEnum::DESC,
            default => null
        };
    }
}