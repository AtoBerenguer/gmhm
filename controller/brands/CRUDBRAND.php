<?php
include_once '../db.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST': //CREAR NUEVA MARCA
        $nombre_marca = $_POST['nombre_marca'];
        $sql = "INSERT INTO marcas (nombre_marca) VALUES ('$nombre_marca')";

        if ($conexion) {
            $resultado = mysqli_query($conexion, $sql);
            echo "Marca creado con éxito.";
        } else {
            echo "Error al crear la marca: " . mysqli_error($conexion);
        }
        break;


    case 'GET': //OBTENER LA MARCA POR ID
        $id = $_GET['id_marca'];
        $id = mysqli_real_escape_string($conexion, $id);
        $sql = "SELECT * FROM marcas WHERE id_marca = $id";

        if ($resultado = mysqli_query($conexion, $sql)) {
            $marca = mysqli_fetch_assoc($resultado);
            header('Content-Type: application/json');
            echo json_encode($marca);
        } else {
            echo "Error en la petición". mysqli_error($conexion);
        }   
        break;


    case 'DELETE': // ELIMINAR MARCA POR ID
        $id = $_GET['id_marca'];
        $id = mysqli_real_escape_string($conexion, $id);

        $sql_check = "SELECT id_marca FROM marcas WHERE id_marca = $id";
        $resultado = mysqli_query($conexion, $sql_check);

        if (mysqli_num_rows($resultado) > 0) { // En caso de que la marca exista habra un resultado > 0
            
            $sql_delete = "DELETE FROM marcas WHERE id_marca = $id";
            if (mysqli_query($conexion, $sql_delete)) {
                echo "Marca eliminado con éxito. ID $id";
            } else {
                echo "Error al eliminar la marca: " . mysqli_error($conexion);
            }
        } else {
            // La marca no existe
            echo "La marca con ID $id no existe.";
        }
        break;


    default:
        echo "Método no permitido";
        break;
}

mysqli_close($conexion);
 ?>