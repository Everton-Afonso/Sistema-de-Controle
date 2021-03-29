<?php

    require_once "conexao/conexao.php"; 
    if(session_status() !== PHP_SESSION_ACTIVE) { 
        session_start(); 
    } 

    Class Estoque{

        //verifica se o usuário efetuou o login com sucesso 
        public function login($user, $pass){
          $pdo = conexao();

          $select = $pdo->prepare("SELECT pass FROM usuario");
          $select->execute();
          $result = $select->fetch(PDO::FETCH_ASSOC);

          foreach ($result as $key => $value){
              if(password_verify($pass, $value)){
                  $dados = $pdo->prepare("SELECT * FROM usuario WHERE user = :user AND pass = :pass");
                  $dados->bindValue("user", $user);
                  $dados->bindValue("pass", $value);
                  $dados->execute();
      
                  if($dados->rowCount() > 0){
                      var_dump("Entrou");
                      $id = $dados->fetch();
                      $_SESSION['id'] = $id['idusuario'];
                      return true;
                  }else{
                      return false;
                      exit();
                  }        
              }else{
                  $_SESSION['loginErro'] = "Usuário ou senha inválido";
                  header("Location: index.php"); // retornando o usuario para a tela de login caso os campos estejam nulos;
              }
          }
      }

      //verificando se o usuário esta logado no sistema
      public function logado($idUser){

          $pdo = conexao();
          $result = array();
          $dados = $pdo->prepare("SELECT user FROM usuario WHERE idusuario = :idUser");
          $dados->bindValue('idUser', $idUser);
          $dados->execute();

          if ($dados->rowCount() > 0) {
              $result  = $dados->fetch(PDO::FETCH_ASSOC);
          }
          return $result;
      }
      
      // logout do sistema destrói a seção do usuário
      public function exit(){
          session_destroy();
          header('location: index.php');
      }

      //select usuario
      public function selectUser($idUser){

          $pdo = conexao();
          $result = array();
          $select = $pdo->prepare("SELECT user FROM usuario WHERE idusuario = :idUser");
          $select->bindValue('idUser', $idUser);
          $select->execute();
          $result = $select->fetch(PDO::FETCH_ASSOC);
          return $result['user'];
      }

        //select estoque
        public function selectEstoque(){

            $pdo = conexao();
            $result = array();
            $select = $pdo->query("SELECT idestoque, nome, descricao, quantidade, localizacao
            FROM estoque ORDER BY nome");

            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        //select por id
        public function selectId($id){

          $pdo = conexao();
          $result = array();
          $select = $pdo->prepare("SELECT * FROM estoque WHERE idestoque = :id");
          $select->bindValue('id', $id);
          $select->execute();
          $result = $select->fetch(PDO::FETCH_ASSOC);

          return $result;

      }
      // update
      public function atualiza($name, $description, $quantidade, $observacao, $id_update){

          $pdo = conexao();

          $select = $pdo->query("SELECT quantidade FROM estoque WHERE idestoque = $id_update");

          foreach ($select as $key => $value) {
              $result = intval($value['quantidade']) + $quantidade;
          }

          $update = $pdo->prepare("UPDATE estoque SET nome = :nome, localizacao = :observacao, descricao = :descricao, quantidade = :quantidade
          WHERE idestoque = :id");
          $update->bindValue('nome', $name);
          $update->bindValue('descricao', $description);
          $update->bindValue('observacao', $observacao);
          $update->bindValue('quantidade', $result);
          $update->bindValue('id', $id_update);
          $update->execute();

          return true;

      }
        //insert
        public function insertEstoque($name, $description, $observacao, $quantidade, $idUser){

            $pdo = conexao();
            //verificando se o componente ja foi cadastrado
            $select = $pdo->prepare("SELECT idestoque FROM estoque WHERE nome = :nome");
            $select->bindValue('nome', $name);
            $select->execute();

            if ($select->rowCount() > 0) { // componente já existe no DB
                return false;
            } else { // componente não existe no DB

                $insert = $pdo->prepare("INSERT INTO estoque(nome, localizacao, descricao, quantidade, usuario_idusuario) 
                VALUES (:nome, :localizacao, :descricao, :quantidade, :usuario_idusuario)");
                $insert->bindValue('nome', $name);
                $insert->bindValue('localizacao', $description);
                $insert->bindValue('descricao', $observacao);
                $insert->bindValue('quantidade', $quantidade);
                $insert->bindValue('usuario_idusuario', $idUser);
                $insert->execute();

                return true;
            }
        }
    }

?>