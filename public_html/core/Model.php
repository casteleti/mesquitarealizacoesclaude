<?php

declare(strict_types=1);

abstract class Model
{
    protected static string $table = '';
    protected static string $primaryKey = 'id';

    protected static function db(): PDO
    {
        return Database::getInstance();
    }

    protected static function query(string $sql, array $params = []): PDOStatement
    {
        return Database::query($sql, $params);
    }

    public static function find(int $id): ?array
    {
        $stmt = static::query(
            'SELECT * FROM `' . static::$table . '` WHERE `' . static::$primaryKey . '` = ? LIMIT 1',
            [$id]
        );
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function findAll(string $where = '', array $params = [], string $order = ''): array
    {
        $sql = 'SELECT * FROM `' . static::$table . '`';
        if ($where) {
            $sql .= ' WHERE ' . $where;
        }
        if ($order) {
            $sql .= ' ORDER BY ' . $order;
        }
        return static::query($sql, $params)->fetchAll();
    }

    public static function count(string $where = '', array $params = []): int
    {
        $sql = 'SELECT COUNT(*) FROM `' . static::$table . '`';
        if ($where) {
            $sql .= ' WHERE ' . $where;
        }
        return (int) static::query($sql, $params)->fetchColumn();
    }

    public static function insert(array $data): int
    {
        $cols   = implode(', ', array_map(fn($k) => "`$k`", array_keys($data)));
        $places = implode(', ', array_fill(0, count($data), '?'));
        static::query(
            "INSERT INTO `" . static::$table . "` ($cols) VALUES ($places)",
            array_values($data)
        );
        return (int) static::db()->lastInsertId();
    }

    public static function update(int $id, array $data): void
    {
        $set = implode(', ', array_map(fn($k) => "`$k` = ?", array_keys($data)));
        $params = array_values($data);
        $params[] = $id;
        static::query(
            "UPDATE `" . static::$table . "` SET $set WHERE `" . static::$primaryKey . "` = ?",
            $params
        );
    }

    public static function delete(int $id): void
    {
        static::query(
            "DELETE FROM `" . static::$table . "` WHERE `" . static::$primaryKey . "` = ?",
            [$id]
        );
    }

    public static function paginate(int $page, int $perPage, string $where = '', array $params = [], string $order = ''): array
    {
        $total  = static::count($where, $params);
        $offset = ($page - 1) * $perPage;

        $sql = 'SELECT * FROM `' . static::$table . '`';
        if ($where) {
            $sql .= ' WHERE ' . $where;
        }
        if ($order) {
            $sql .= ' ORDER BY ' . $order;
        }
        $sql .= ' LIMIT ? OFFSET ?';
        $rows = static::query($sql, array_merge($params, [$perPage, $offset]))->fetchAll();

        return [
            'data'        => $rows,
            'total'       => $total,
            'per_page'    => $perPage,
            'current_page'=> $page,
            'last_page'   => (int) ceil($total / $perPage),
        ];
    }
}
