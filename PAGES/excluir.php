<?php
    require "../CLASSES/usuario.php";
    $usuario = new Usuario();
    $usuario->conectar("cru543", "localhost", "root", "");

    if(isset($_GET['id_usuario']))
    {
        $id_usuario = addslashes($_GET['id_usuario']);

        $usuario->excluirUsuario($id_usuario);
    }
    header("location:listar.php");
?>