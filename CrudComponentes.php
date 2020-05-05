<?php

    require_once './conexao/conexao.php'; 

    Class Componentes{

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
                        $id = $dados->fetch();
            
                        $_SESSION['id'] = $id['idusuario'];
                        return true;
                    }else{
                        return flase;
                    }        
                }else{
                    echo "Erro";
                }
            }
        }

        //verificando se o usuário esta logado
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
        
      // exit destrói a seção do usuário
        public function exit(){
            session_start();
            session_destroy();
            header('location: index.php');
        }
    }

?>