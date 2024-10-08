<?php

namespace App\Models;

use mysqli;

class Connect {

    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASS;
    protected $db_name = DB_NAME;

    protected $connection;
    protected $query;  // Variable de instancia para almacenar el resultado de la consulta
    protected $table;

    public function __construct() {
        $this->connect();  // Corregido el nombre de la función a "connect"
    }

    // Método para establecer la conexión a la base de datos
    public function connect() {
        $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if ($this->connection->connect_error) {
            die('Error en la conexión a la Base de Datos: ' . $this->connection->connect_error);
        }
    }

    // Método para realizar una consulta SQL
    public function query($sql, $data= [], $params = null) {
        
        if ($data) {

            if ($params == null) {
                $params = str_repeat('s', count($data));    
            }

            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param($params, ...$data);
            $stmt->execute();

            $this->query = $stmt->get_result();
        } else {
            $this->query = $this->connection->query($sql);
        }
        return $this;
    }

    // Método para obtener un solo registro
    public function getOne() {
        return $this->query ? $this->query->fetch_assoc() : null;  // Devolver un solo registro
    }

    // Método para obtener todos los registros
    public function getAll() {
        return $this->query ? $this->query->fetch_all(MYSQLI_ASSOC) : [];  // Devolver todos los registros
    }

}

?>
