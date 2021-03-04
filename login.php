<?php

    if(session_status() !== PHP_SESSION_ACTIVE) { 
        session_start(); 
    } 
    ob_start();

    if((isset($_POST['user']) && !empty($_POST['user'])) && (isset($_POST['password']) && !empty($_POST['password']))){ //verificando se os campos não estão nulos
      
      require_once "classes/CrudEstoque.class.php"; //requerindo uma conexão com DB

        $class = new Estoque(); //Instanciando um novo objeto

        $user = addslashes($_POST['user']); 
        $pass = addslashes($_POST['password']);

        if($class->login($user, $pass) == true){
            if(isset($_SESSION['id'])){
              header("Location:cadastro.php"); //leva o usuario para a pagina principal
            }else{
              $_SESSION['loginErro'] = "Usuário ou senha inválido";
            }
        }
    } else {
      $_SESSION['loginErro'] = "Usuário ou senha inválido";
      header("Location:index.php"); // retornando o usuario para a tela de login caso os campos estejam nulos
    }
    
    ob_end_flush();

?>