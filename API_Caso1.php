<?php
//El nombre del archivo cambiara segun las necesidades (ejemplo: API_Usuarios.php para realizar peticiones a la tabla de usuarios)

$_SERVER['REQUEST_METHOD'] = "HEAD";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET': //Obtiene el recurso indicado cuando se pide el contenido de una página web.
        echo "GET";
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

    case 'HEAD': //Obtiene únicamente los metadatos de la cabecera.
        echo "HEAD";
        break;

        /*case 'TRACE':
    break;

    case 'OPTIONS':
        break;

    case 'CONNECT':
        break;

    case 'PATCH':
        break;*/
}
