<?php

require_once 'dao.php';

class Users {
    private $connection = null;
    
    public function __construct() {
        $this->connection = Connection::getConn();
    }

    public function setup() {
        $sql = "CREATE TABLE IF NOT EXISTS usuarios 
        (id INTEGER PRIMARY KEY AUTOINCREMENT, email TEXT, 
        estado TEXT, password TEXT, nombre TEXT, avatar TEXT,
        fchIngreso TEXT)";
        $this->connection->exec($sql);
    }

    public function insert( $email, $estado, $password, $nombre, $avatar, $fchIngreso) {
        $sql = "INSERT INTO usuarios (nombre, email, estado, password, avatar,
         fchIngreso) VALUES ('$nombre', '$email', '$estado',
          '$password', '$avatar', '$fchIngreso')";
        $this->connection->exec($sql);
    }

    public function getAll() {
        $sql = "SELECT * FROM usuarios";
        $result = $this->connection->query($sql);
        $users = array();
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $users[] = $row;
        }
        return $users;
    }

    public function getById($ID)
    {
        $sql = "SELECT * FROM usuarios where id=$ID";
        $result = $this->connection->query($sql);
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            return $row;
        }
        return array();
    }

    public function update($email, $estado, $password, $nombre, $avatar, $fchIngreso, $id) {
        $sql = "UPDATE usuarios SET email = '$email', estado = '$estado',
            password = '$password', nombre = '$nombre', avatar = '$avatar',
             fchIngreso = '$fchIngreso' WHERE id = $id";
        $this->connection->exec($sql);
    }

    public function delete( $id ) {
        $sql = "DELETE FROM usuarios WHERE id = $id";
        $this->connection->exec($sql);
    }
}
?>