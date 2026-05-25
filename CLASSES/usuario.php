<?php
    
    Class Usuario
    {
        private $pdo;

        public $msgErro = "";

        public function conectar($nome, $host, $usuario, $senha)
        {
            global $pdo;

            try{
                $pdo = new PDO("mysql:dbname=".$nome,$usuario,$senha);
            }
            catch(PDOException $erro){
                $msgErro = $erro->getMessage();
            }
        }

        public function cadastrarUsuario($nome, $email, $telefone, $senha)
        {
            global $pdo;

            $usuario = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e");
            $usuario->bindValue(":e", $email);
            $usuario->execute();
            if($usuario->rowCount() > 0){
                return False;
            }else{
                $usuario = $pdo->prepare("INSERT INTO usuario (nome, email, telefone, senha) VALUES (:n, :e, :t, :s)");
                $usuario->bindValue(":n", $nome);
                $usuario->bindValue(":e", $email);
                $usuario->bindValue(":t", $telefone);
                $usuario->bindValue(":s", $senha);
                $usuario->execute();
                return true;
            }
        }

        Public function buscarDados()
        {
            $res = array();
            global $pdo;

            $sql = $pdo->prepare("SELECT * FROM usuario ORDER BY nome");
            $sql->execute();
            // O prepare precisa do execute e o query não.
            
            $res = $sql->fetchAll(PDO::FETCH_ASSOC);

            return $res;
        }
        public function excluirUsuario($id_usuario)
        {
            global $pdo;
            $sql = $pdo->prepare("DELETE FROM usuario WHERE id_usuario = :id");
            $sql->bindValue(":id", $id_usuario);
            $sql->execute();
        }

        public function buscarDadosUsuario($id_usuario)
        {
            
            $dadosUsuario = array();

            global $pdo;

            $sql = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario = :id");
            $sql->bindValue(":id", $id_usuario);
            $sql->execute();
            
            $dadosUsuario = $sql->fetch(PDO::FETCH_ASSOC);

            return $dadosUsuario;
        }

        public function atualizarDadosUsuario($id_usuario, $nome, $email, $telefone)
        {
            global $pdo;
            $sql = $pdo->prepare("UPDATE usuario SET nome = :n, email = :e, telefone = :t WHERE id_usuario = :id");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":t", $telefone);
            $sql->bindValue(":id", $id_usuario);
            $sql->execute();
        }
    }

?>