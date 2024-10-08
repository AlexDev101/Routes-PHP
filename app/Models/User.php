<?php

namespace App\Models;
use App\Models\Connect;

class User extends Connect {
    protected $table = 'users';

    public function __construct() {
        parent::__construct(); // Llamar al constructor de Connect para inicializar la conexión
    }

    public function getUser($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->query($sql, [$id], 'i')->getOne(); // Usar la conexión heredada
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->getAll(); // Usar la conexión heredada
    }

    public function findUser($column, $value) {
        $sql = "SELECT * FROM {$this->table} WHERE {$column} = '{$value}'";
        return $this->query($sql)->getOne(); // Usar la conexión heredada
    }

    public function createUser($data) {
        $columns = array_keys($data);
        $columns = implode(',', $columns);

        $values = array_values($data);

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES (" . str_repeat('?, ', count($values) - 1) . "?)";
        $this->query($sql, $values); // Usar la conexión heredada
    }

    public function updateUser($id, $data) {

        $fields = [];
        
        foreach ($data as $key => $value) {
            $fields[] = "{$key} = ?";
        }

        $fields = implode(', ', $fields);

        // Ejecutar la actualización
        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = ?";

        $values = array_values($data);
        $values[] = $id;

       return $this->query($sql, $values); // Usar la conexión heredada

        // Obtener el usuario actualizado
        return $this->getUser($id); // Devolver el usuario actualizado
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $this->query($sql, [$id], 'i');
    }

    public function searchUser($column, $operator,  $value = null) {

        if ($value == null) {
            $value = $operator;
            $operator = "=";
        }

        $sql = "SELECT FROM {$this->table} WHERE {$column} {$operator} ?";
        $this->query($sql, [$value]);

        return $this;

    }

}

?>
