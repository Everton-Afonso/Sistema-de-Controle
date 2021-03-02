<?php

    session_start();

    if((isset($_POST['user']) && !empty($_POST['user'])) && (isset($_POST['password']) && !empty($_POST['password']))){ //verificando se os campos não estão nulos
      
      require_once "classes/CrudComponentes.class.php"; //requerindo uma conexão com DB

        $class = new Componente(); //Instanciando um novo objeto da class Componentes

        $user = addslashes($_POST['user']); 
        $pass = addslashes($_POST['password']);

        if($class->login($user, $pass) == true){
            if(isset($_SESSION['id'])){
              header("Location: cadastro.php"); //leva o usuario para a pagina principal
            }else{
              $_SESSION['loginErro'] = "Usuário ou senha inválido";
            }
        }
    } else {
      $_SESSION['loginErro'] = "Usuário ou senha inválido";
      header("Location: index.php"); // retornando o usuario para a tela de login caso os campos estejam nulos
    }

?>