<?php
    require '../CLASSES/usuario.php';
    $usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    
    <h2 class="titulo-pagina">CADASTRO DE USUÁRIO</h2>

    <form method="post">
        <input type="text" name="nome" class="input-form" placeholder="Digite seu nome.">
        <input type="email" name="email" class="input-form" placeholder="Digite seu email.">
        <input type="tel" name="telefone" class="input-form" placeholder="Digite seu telefone.">
        <input type="password" name="senha" class="input-form" placeholder="Digite sua senha.">
        <input type="password" name="confSenha" class="input-form" placeholder="Confirme sua senha.">
        <input type="submit" value="CADASTRAR">
        <p>Já é cadastrado? Clique <a href="login.php">aqui</a> para acessar.</p>

    </form>

    <?php
        if(isset($_POST['nome'])){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $senha = $_POST['senha'];
            $confSenha = addslashes($_POST['confSenha']);

            if(!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha) && !empty($confSenha)){

                $usuario-> conectar("cru543", "localhost", "root", "");
                if($usuario->msgErro == ""){
                    if($senha == $confSenha)
                    {
                        if($usuario->cadastrarUsuario($nome, $email, $telefone, $senha)){
                            ?>
                                <div class="msg-sucesso">
                                    <p>Usuário Cadastrado com Sucesso</p>
                                </div>
                            <?php
                        }
                    }
                    else{
                        ?>
                            <div class="msg-sucesso">
                                <p>Usuário Já Cadastrado!</p>
                            </div>
                        <?php
                    }
                }
                else{
                    ?>
                        <div class="msg-sucesso">
                            <p>Senha e Confirmar Senha Não Conferem.</p>
                        </div>
                    <?php
                }
            }
            else{
                ?>
                    <div class="msg-sucesso">
                        <?php
                            echo "Erro:".$usuario->msgErro;
                        ?>
                    </div>
                <?php
            }
        }
        else{
            ?>
                <div class="msg-sucesso">
                    <p>Preencha Todos os Campos.</p>
                </div>
            <?php
        }
    ?>

</body>
</html>