<?php
include_once "database.php";
include_once "paises.php";
include_once "tipo_dni.php";
include_once "estado_civil.php";
include_once "categoria.php";
include_once "observaciones.php";
include_once "direccion.php";

class usuario
{
    public function listar()
    {
        $db = new database();
        $db->conectar();

        $consulta = "SELECT * 
                     FROM bsd_usuario;";

        $resultado = mysqli_query($db->conexion, $consulta)
        or die ("No se pueden listar los usuarios.");

        $i=0;
        while($datos = mysqli_fetch_assoc($resultado))
        {
            if($datos["usuario"]!="Admin")
            {
                $usuarios[$i]=$datos;
                $i++;
            }
        }
        $db->close();

        return $usuarios;
    }

    public function buscar($id_colaborador)
    {
        $db = new database();
        $db->conectar();

        $consulta = "SELECT * 
                     FROM bsd_usuario
                     WHERE cod_usuario='$id_colaborador';";

        $resultado = mysqli_query($db->conexion, $consulta)
        or die ("No se pudo encontrar el colaborador.");

        $datos = mysqli_fetch_assoc($resultado);

        if($datos["usuario"]!="Admin")
        {
            $usuarios=$datos;
        }

        $db->close();
        return $usuarios;
    }

}


?>