<?php
include 'Conexion.php';
//El nombre del archivo cambiara segun las necesidades (ejemplo: API_Usuarios.php para realizar peticiones a la tabla de usuarios)

//$_SERVER['REQUEST_METHOD'] = "HEAD"; //Esto es para cambiar el verbo 

//Creamos variables para escribir más rapido cada solicitud
$Tabla = ""; //Nombre de la tabla que se está consultando

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET': //Obtiene el recurso indicado cuando se pide el contenido de una página web.
        $req;
        $ID = "";

        if (isset($_GET['llave'])) { //Sí se envia un identificador para la busqueda, cambia la consulta
            $llave = $_GET['llave'];
            $req = "SELECT * FROM `$Tabla` WHERE $ID = $llave";
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

    
    case 'POST': //Añade datos al servidor. Siempre es un método de creación.
        echo "POST";
        break;

    case 'PUT': //Solicitud para actualizar la entidad suministrada en el URL indicado. 
        echo "PUT";
        break;

    case 'DELETE': //Elimina el recurso indicado.
        echo "DELETE";
        break;


        /*
    case 'HEAD': //Obtiene únicamente los metadatos de la cabecera.
        break;

    case 'TRACE':
        break;

    case 'OPTIONS':
        break;

    case 'CONNECT':
        break;

    case 'PATCH':
        break;*/
}
