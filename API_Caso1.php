<?php
include 'Conexion.php';
//El nombre del archivo cambiara segun las necesidades (ejemplo: API_Usuarios.php para realizar peticiones a la tabla de usuarios)

//$_SERVER['REQUEST_METHOD'] = "HEAD"; //Esto es para cambiar el verbo 

//Creamos variables para escribir más rapido cada solicitud
$Tabla = ""; //Nombre de la tabla que se está consultando
$IDG = ""; //Nombre del identificador principal

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET': //Obtiene el recurso indicado cuando se pide el contenido de una página web.
        $req;

        if (isset($_GET['llave'])) { //Sí se envia un identificador para la busqueda, cambia la consulta
            $llave = $_GET['llave'];
            $req = "SELECT * FROM `$Tabla` WHERE $IDG = $llave";
        } else { //Sí no se envia un identificador para la busqueda, cambia la consulta
            $req = "SELECT * FROM `$Tabla`"; //Se realiza la consulta
        }

        $res = mysqli_query($conn, $req);
        $json = array(); //Creamos un arreglo que contendra toda la información

        while ($row = mysqli_fetch_array($res)) { //Recorremos cada una de las filas que retorna la base
            $Dato1 = $row['id']; //Creamos una variable por cada valor (que se quiera) de la fila respectivo a la columna nombrada
            $json[] = array('Dato1' => $Dato1); //Agregamos el dato al array
        }

        mysqli_close($conn); //Cerramos la conexion con la base
        echo json_encode($json); //Imprimimos el arreglo en formato JSON
        break;

    case 'POST': //Añade datos al servidor.
        $Method = $_POST['Method']; //Ya que no estamos creando los verbos como se deberia, recibiremos un parametro con el valor del verbo que se deberia ejecutar

        switch ($Method) {
            case 'POST':
                $Columna1 = "";
                $Dato1 = $_POST['Dato1'];
                $sql = "INSERT INTO `$Tabla` (`$Columna1`) VALUES ('$Dato1')"; //Sintaxis para ingresar datos
                echo respuestas(mysqli_query($conn, $sql));
                mysqli_close($conn); //Cerramos la conexion con la base
                break;

            case 'PUT':
                $Columna = "";
                $ID = $_POST['ID'];
                $Dato1 = $_POST['Dato1'];
                $sql = "UPDATE `$Tabla` SET `$Columna` = '$Dato1' WHERE `$Tabla`.`$IDG` = $ID;"; //Sintaxis para ingresar datos
                echo respuestas(mysqli_query($conn, $sql));
                mysqli_close($conn); //Cerramos la conexion con la base
                break;

            case 'PATCH':
                $Columna = "";
                $ID = $_POST['ID'];
                $Dato1 = $_POST['Dato1'];
                $sql = "UPDATE `$Tabla` SET `$Columna` = '$Dato1' WHERE `$Tabla`.`$IDG` = $ID;"; //Sintaxis para ingresar dato
                echo respuestas(mysqli_query($conn, $sql));
                mysqli_close($conn); //Cerramos la conexion con la base
                break;

            case 'DELETE':
                $ID = $_POST['ID'];
                $sql = "DELETE FROM `$Tabla` WHERE `$Tabla`.`$IDG` = $ID"; //Sintaxis para eliminar dato
                echo respuestas(mysqli_query($conn, $sql));
                mysqli_close($conn); //Cerramos la conexion con la base
                break;
        }
        break;
}

function respuestas($request)
{
    if ($request) {
        return 201;
    }
}
