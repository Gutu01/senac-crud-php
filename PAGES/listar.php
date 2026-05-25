<?php
    require "../CLASSES/usuario.php";
    $usuario = new Usuario();
    $usuario->conectar("cru543","localhost","root","");

    $dados = $usuario->buscarDados();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuários</title>
</head>
<body>
    
    <h2 class="titulo-pagina">USUÁRIOS CADASTRADOS</h2>

    <table border="1" cellpading="10">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php
            foreach($dados as $pessoa)
                {
        ?>
        <tbody>
            <tr>
                <td>
                    <?php echo $pessoa['id_usuario'] ?>
                </td>
                <td>
                    <?php echo $pessoa['nome'] ?>
                </td>
                <td>
                    <?php echo $pessoa['email'] ?>
                </td>
                <td>
                    <?php echo $pessoa['telefone'] ?>
                </td>
                <td>
                    <a href="editar.php?id_usuario=<?php echo $pessoa ['id_usuario']; ?>">Editar</a>
                    <a href="excluir.php?id_usuario=<?php echo $pessoa ['id_usuario']; ?>">Excluir</a>
                </td>
            </tr>
        </tbody>
        <?php
                }
        ?>
    </table>
</body>
</html>