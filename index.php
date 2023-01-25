<?php

require 'flight/Flight.php';
require 'Datos.php';

/*Conexión a la base de datos*/
Flight::register('db', 'PDO', array('mysql:host=' . $Host . ';dbname=' . $Base . '', '' . $Usuario . '', '' . $Clave . ''));


class Ejemplo
{
    public $Tabla = "";

    public function Listar()
    {
        $Req = Flight::db()->prepare("SELECT * FROM `$this->Tabla`");
        $Req->execute();
        $Res = $Req->fetchAll();
        $json  = array();

        for ($i = 0; $i < count($Res); $i++) {
            $json[] = array('Dato1' => $Res[$i]['Dato1']);
        }
        Flight::json($json);
    }

    public function Buscar()
    {
        $Dato1 = (Flight::request()->query['Dato1']);
        $Req = Flight::db()->prepare("SELECT * FROM `$this->Tabla` WHERE Dato1 = $Dato1");
        $Req->execute();
        $Json = $Req->fetch();
        $json  = array();

        $json[] = array('Dato1' => $Json['Dato1'], 'Dato2' => $Json['Dato2']);


        Flight::json($json);
    }

    public function Agregar()
    {
        $Dato1 = (Flight::request()->query['Dato1']);

        $Req = Flight::db()->prepare("INSERT INTO `$this->Tabla` (`Dato1`) VALUES (NULL, '$Dato1')");
        $Req->execute();
    }

    public function Actualizar()
    {
        $Dato1 = (Flight::request()->query['Dato1']);
        $Dato2 = (Flight::request()->query['Dato2']);

        $Req = Flight::db()->prepare("UPDATE `$this->Tabla` SET `Dato1` = '$Dato1' WHERE `Dato2` = $Dato2");
        $Req->execute();
    }

    public function Eliminar()
    {
        $Dato2 = (Flight::request()->query['Dato2']);

        $Req = Flight::db()->prepare("DELETE FROM `$this->Tabla` WHERE `Dato2` = $Dato2");
        $Req->execute();
    }
}

Flight::route('GET /Listar', array(new Ejemplo(), 'Listar'));
Flight::route('GET /Buscar', array(new Ejemplo(), 'Buscar'));
Flight::route('POST /Agregar', array(new Ejemplo(), 'Agregar'));
Flight::route('POST /Actualizar', array(new Ejemplo(), 'Actualizar'));
Flight::route('POST /Eliminar', array(new Ejemplo(), 'Eliminar'));

Flight::start();
