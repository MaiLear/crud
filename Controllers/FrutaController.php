<?php

namespace Controllers;

use Config\Conexion;
use PDO;

spl_autoload_register(function ($class) {
    if (file_exists(str_replace('\\', '/', $class)) . '.php') {
        include_once str_replace('\\', '/', $class) . '.php';
    }
});

$url = isset($_GET['url']) ? $_GET['url'] : '';

class FrutaController
{

    public static function index()
    {
        $conection = Conexion::conection("localhost", "root", "");

        $sql = "SELECT * FROM `frutas`";
        $stmt = $conection->query($sql);

        if ($stmt) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Manejar errores en la consulta
            return $conection->errorInfo();
        }
    }

    public static  function store()
    {
        $conection = Conexion::conection("localhost", "root", "");
        if ($conection <> false) {
            $sql = "INSERT INTO `frutas` (`name`,`valor`,`color`) VALUES (:name,:valor,:color)";

            //Enlazar los parametros
            $stmt = $conection->prepare($sql);

            $stmt->bindParam(':name', $_REQUEST['name']);
            $stmt->bindParam(':valor', $_REQUEST['valor']);
            $stmt->bindParam(':color', $_REQUEST['color']);

            $stmt->execute();
            return true;
        } else {
            return false;
        }
    }

    public static function update()
    {
        $conection = Conexion::conection("localhost", "root", "");
        if ($conection <> false) {
            $sql = "UPDATE frutas SET name = :name, valor = :valor, color = :color WHERE id = :id";

            $stmt = $conection->prepare($sql);

            $stmt->bindParam(':id', $_REQUEST['id']);
            $stmt->bindParam(':name', $_REQUEST['name']);
            $stmt->bindParam(':valor', $_REQUEST['valor']);
            $stmt->bindParam(':color', $_REQUEST['color']);

            $stmt->execute();

            return true;
        }
        return false;
    }


    public static  function destroy()
    {
        $conection = Conexion::conection("localhost", "root", "");
        if ($conection <> false) {
            $sql = "DELETE FROM frutas WHERE id = :id";
            $stmt = $conection->prepare($sql);

            $stmt->bindParam(':id', $_REQUEST['id-eliminar']);

            $stmt->execute();
            return true;
        } else {
            return false;
        }
    }
}
