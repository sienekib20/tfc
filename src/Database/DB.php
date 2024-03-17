<?php

namespace Sienekib\Alquimist\Database;

class DB
{
    private static string $table;
    private static string $select = '*';
    private static string $query;
    private static array $where = [];

    public static function table(string $table)
    {
        self::$table = $table;

        return new static;
    }

    public static function select(string $fields)
    {
        self::$select = $fields;

        return new static;
    }

    public static function where(string $field, string $operand, string $value)
    {
        self::$where[] = [
            'type' => 'AND',
            'field' => $field,
            'operand' => $operand,
            'value' => $value
        ];

        return new static;
    }

    public static function orwhere(string $field, string $operand, string $value)
    {
        self::$where[] = [
            'type' => 'OR',
            'field' => $field,
            'operand' => $operand,
            'value' => $value
        ];

        return new static;
    }

    public function get()
    {
        $query = "SELECT " . self::$select;
        if (!empty(self::$where)) {
            $query .= "WHERE ";
            foreach (self::$where as $key => $where) {
                if ($key == 0) {
                    $query .= $where['type'];
                }
                $query .= "{$where['field']} {$where['operand']} ?";
            }
        }
        $bind = array_column(self::$where, 'value');
        dd($query);
    }


    public function insert(array $data)
    {
    }
    public function update(array $data)
    {
    }
}
