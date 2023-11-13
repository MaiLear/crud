<?php

namespace Config;

use PDO;
use PDOException;

class Conexion
{
    public static  function conection($servidor, $usuario, $contrasenia)
    {
        try {
            $conexion = new PDO("mysql:host=$servidor; dbname=comida", $usuario, $contrasenia);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $error) {
            echo $error;
        }
    }
}
