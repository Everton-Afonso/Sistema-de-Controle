<?php

    require_once 'verifica.php';
    require_once "classes/CrudComponentes.class.php";
    $componentes = new Componente();
    ob_start();
    if(session_status() !== PHP_SESSION_ACTIVE) { 
        session_start(); 
    } 

?>
<!DOCTYPE html>
<html lang="pr-BR">

    <head>
        <link rel="icon" type="image/png"
            href="https://info.mch.ifsuldeminas.edu.br/wp-content/uploads/2019/04/android-icon-48x48.png">
        <link rel="apple-touch-icon" sizes="76x76"
            href="https://info.mch.ifsuldeminas.edu.br/wp-content/uploads/2019/04/android-icon-48x48.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <meta property="og:url" content="https://info.mch.ifsuldeminas.edu.br/projetos">
        <meta property="og:type" content="webpage">
        <meta property="og:title" content="Projetos">
        <meta property="og:description" content="Conheça nossos Projetos, Laboratórios e Grupos de Estudos e Pesquisas">
        <meta property="og:image"
            content="https://info.mch.ifsuldeminas.edu.br/wp-content/uploads/2019/05/home-2910592_1920.jpg">

        <title>Cadastro</title>

        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
        <meta name="viewport" content="width=device-width">

        <link href="https://info.mch.ifsuldeminas.edu.br/wp-content/themes/informatica/assets/css/bootstrap.min.css"
            rel="stylesheet">
        <link href="https://info.mch.ifsuldeminas.edu.br/wp-content/themes/informatica/assets/css/style.css"
            rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>


        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,300,700" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

        <!--    jquery      -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>

    </head>

    <body class="off-canvas-menu">
        <!--    menu navbar     -->
        <nav class="navbar navbar-expand-lg fixed-top bg-danger navbar-transparent" color-on-scroll="40">
            <div class="container">
                <div class="navbar-translate">
                    <div class="row navbar-header">
                        <a class="navbar-brand">
                            <img src="https://info.mch.ifsuldeminas.edu.br/wp-content/uploads/2019/04/logo.png"> Bem vindo
                            <?php 
                                $idUser = (int)$_SESSION['id'];
                                echo $componentes->selectUser($idUser);
                            ?>
                        </a>
                    </div>
                    <button class="navbar-toggler navbar-burger" type="button" data-toggle="collapse"
                        data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar"></span>
                        <span class="navbar-toggler-bar"></span>
                        <span class="navbar-toggler-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="baixas.php"
                                data-scroll="true">Baixas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="estoque.php"
                                data-scroll="true">Estoque</a>
                        </li>
                        <form method="POST" class="form-inline my-2 my-lg-0" autocomplete="off">
                            <input class="form-control mr-sm-2" type="search" name="pesquisar">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit">Pesquisar</button>
                        </form>
                        <li class="nav-item">
                            <a class="btn btn-warning" href="logout.php">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--    fim menu navbar     -->
        <div class="page-header page-header-xs" data-parallax="true"
            style="background-image: url(&quot;https://info.mch.ifsuldeminas.edu.br/wp-content/uploads/2019/04/industry-3087398_1280.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
            <div class="filter"></div>
            <div class="content-end">
                <div class="motto">
                    <h1 class="title-uppercase text-center"><b>Tela de Cadastro</b></h1>
                    <h3 class="text-center"></h3>
                    <br>
                </div>
            </div>
        </div>
        <div class="wrapper">
             <div class="container">
                <div class="row">
                    <section id="right" class="pesqusar col-md-12">
                        <?php
                            if (isset($_POST['pesquisar'])){
                                $name = addslashes($_POST['pesquisar']);
                                if (!empty($name)) {
                                    $name = ucwords(strtolower($name));
                                    $pesquisar = $componentes->pesquisar($name);
                                    if(count($pesquisar) > 0){
                                    ?>
                                        <h4 class="title-uppercase text-center mt-4 mb-4">Itens encontrados</h4>
                                        <table>
                                            <tr id="title-register">
                                                <th id="title-register">Nome</th>
                                                <th id="title-register">Descrição</th>
                                                <th id="title-register">Editar</th>
                                            </tr>
                                    <?php  
                                        for ($i=0; $i < count($pesquisar); $i++) { 
                                            echo "<tr>";         
                                            foreach ($pesquisar[$i] as $key => $value) {
                                                if ($key != "idcomponentes" && $key != "usuario_idusuario") {
                                                    echo "<td>".$value."</td>";
                                                }
                                            }
                                        ?>           
                                            <td>
                                                <a href="cadastro.php?id_up=<?php echo $pesquisar[$i]["idcomponentes"];?>" id="to-edit">Editar</a>
                                            </td> 
                                        <?php 
                                            echo "</tr>";   
                                        }
                                        ?>
                                    </table>
                                    <div class="text-center mt-3">
                                        <a href="cadastro.php" class="btn btn-danger">Fechar</a>
                                    </div>
                                    <?php  
                                    }
                                        else {
                                        ?>
                                            <div class="title-uppercase text-center mt-4 mb-4">
                                                <p>O nome informado não consta em nossos registros.</p>
                                            </div>
                                        <?php
                                    }   
                                } else {
                                ?>
                                    <div class="title-uppercase text-center mt-4 mb-4">
                                        <p>O campo de pesquisa esta vazio.</p>
                                    </div>
                                <?php
                                }
                            }
                        ?>
                    </section>
                </div>
            </div>
            <div class="main">
                <div class="section section-gray">
                    <div class="container-fluid">
                        <section class="container-register row">
                            <?php
                                if (isset($_POST['name'])) {  //clicou no botão cadastrar ou atualizar.
                                    //verifica se é o botão atualizar que foi clicado.
                                    if (isset($_GET['id_up']) && !empty($_GET['id_up'])){

                                        $id_update = (int)$_GET['id_up'];
                                        $name = addslashes($_POST['name']);
                                        $description = addslashes($_POST['description']);
                                        

                                        if (!empty($name) && !empty($description)) {

                                            $name = ucwords(strtolower($name));
                                            $description = ucwords(strtolower($description));

                                            if($componentes->atualiza($name, $description, $id_update)){

                                                header("Location: cadastro.php");

                                            }else {
                                                ?>
                                                    <div class="alert-erro">
                                                        <span class="fa fa-thumbs-o-up"></span>
                                                        <span class="msg">Erro ao tentar atualizar o componente</span>
                                                        <span class="close-btn">
                                                            <span class="fa-time"></span>
                                                        </span>
                                                    </div>
                                                <?php                
                                            }
                                        } 

                                    } else { // caso contrario foi o botão cadastrar.

                                        $name = addslashes($_POST['name']);
                                        $description = addslashes($_POST['description']);
                                        $idUser = (int)$_SESSION['id'];

                                        if (!empty($name) && !empty($description)) {

                                            $name = ucwords(strtolower($name));
                                            $description = ucwords(strtolower($description));

                                            if(!$componentes->insertComponentes($name, $description, $idUser)){
                                                ?>
                                                    <div class="alert-erro">
                                                        <span class="fas fa-exclamation-triangle"></span>
                                                        <span class="msg">Componente já esta cadastrado</span>
                                                        <span class="close-btn">
                                                            <span class="fa-time"></span>
                                                        </span>
                                                    </div>
                                                <?php
                                            }else {
                                                ?>
                                                    <div class="alert-acerto">
                                                        <span class="fa fa-thumbs-o-up"></span>
                                                        <span class="msg">Componente cadastrado com sucesso</span>
                                                        <span class="close-btn">
                                                            <span class="fa-time"></span>
                                                        </span>
                                                    </div>
                                                <?php                
                                            }
                                        } else {
                                            ?>
                                                <div class="alert-erro">
                                                        <span class="fas fa-exclamation-triangle"></span>
                                                        <span class="msg"><?php echo "Preencha todos os dados"; ?></span>
                                                        <span class="close-btn">
                                                            <span class="fa-time"></span>
                                                        </span>
                                                </div>
                                            <?php
                                        }
                                    } 
                                }
                                //verificar se o usuraio clicou no botão editar, e retornara os dados selecionados pelo id
                                if (isset($_GET['id_up'])) {

                                    $id_update = addslashes($_GET['id_up']);
                                    $result = $componentes->selectId($id_update);

                                }
                            ?>
                            <section id="left" class="col-md-4">
                                <form method="POST" class="form-register" autocomplete="off">
                                    <h3>Cadastro de Componentes</h3>
                                    <div class="textboxregister">
                                        <label for="name">Nome</label>
                                        <input type="text" name="name" id="name" title="Informe o nome do componente" 
                                        value="<?php //verifica se a variavel $result possui dados, caso a mesma possua printara o resultado
                                                    if (isset($result)) {
                                                        echo $result['nome'];
                                                    }
                                                ?>">
                                        <span class="check-message-register hidden">Obrigatório</span>
                                    </div>
                                    <div class="textboxregister">
                                        <label for="description">Descrição</label>
                                        <input type="text" name="description" id="description" title="Deixe aqui uma breve descrição do componente"
                                        value="<?php //verifica se a variavel $result possui dados, caso a mesma possua printara o resultado
                                                    if (isset($result)) {
                                                        echo $result['descricao'];
                                                    }
                                                ?>">
                                        <span class="check-message-register hidden">Obrigatório</span>
                                    </div>
                                    <input type="submit" 
                                        value="<?php // trocara o botão de cadastrar pelo de atualizar
                                                    if (isset($result)) {
                                                        echo "Atualizar";
                                                    }else {
                                                        echo "Cadastrar";
                                                    }
                                                ?>" 
                                        name="login" id="login" class="register-btn" disabled>
                                </form>
                            </section>
                            <section id="right" class="col-md-8">
                                <table>
                                    <?php
                                        $dados = $componentes->selectComponentes();
                                        //defini o numero de paginas
                                        $limit = 10;
                                        //pagina atual
                                        $pagina = (!isset($_GET['pagina'])) ? 1 : $_GET['pagina'];
                                        $total = ceil((count($dados) / $limit));
                                        $inicio = ($limit * $pagina)-$limit;
                                        
                                        $selectLimit = $componentes->selectComponentesLimit($inicio, $limit);

                                        if(count($dados) > 0){
                                            ?>
                                                <tr id="title-register">
                                                    <th id="title-register">Nome</th>
                                                    <th id="title-register">Descrição</th>
                                                    <th id="title-register">Editar</th>
                                                </tr>
                                            <?php 
                                            for ($i=0; $i < count($selectLimit); $i++) {            
                                                echo "<tr>";
                                                foreach ($selectLimit[$i] as $key => $value) {
                                                    if ($key != "idcomponentes" && $key != "usuario_idusuario") {
                                                        echo "<td>".$value."</td>";
                                                    }
                                                }
                                                ?>           
                                                    <td>
                                                        <a href="cadastro.php?id_up=<?php echo $dados[$i]["idcomponentes"];?>" id="to-edit">Editar</a>
                                                    </td> 
                                                <?php     
                                                    echo "</tr>";  
                                            }
                                    ?>
                                </table>
                                <div class="pagina">
                                    <?php
                                            for ($i=1; $i <= $total; $i++){
                                                if ($i ==  $pagina) {
                                                    echo ' '.$i.' ';
                                                }else{
                                                    echo ' <a href="? pagina='.$i.'"> '.$i.' </a> ';
                                                }
                                            }
                                        }else { // DB vasio
                                            echo "<p class='text-center'>Ops !!! não exixte dados cadastrados.</p>";
                                        }
                                    ?>
                                </div>
                            </section>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <!-- inicio do footer -->
        <footer class="footer footer-big">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-sm-12 col-12 ml-auto mr-auto">
                        <div class="row justify-content-md-center">
                            <div class="col-md-2 col-sm-2 col-6">
                                <div class="links">
                                    <ul class="uppercase-links stacked-links">
                                        <li>
                                            <a href="https://info.mch.ifsuldeminas.edu.br/home#courses">
                                                Cursos </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-6">
                                <div class="links">
                                    <ul class="uppercase-links stacked-links">
                                        <li>
                                            <a href="https://info.mch.ifsuldeminas.edu.br/posts">
                                                Notícias </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-6">
                                <div class="links">
                                    <ul class="uppercase-links stacked-links">
                                        <li>
                                            <a href="projetos">
                                                Projetos </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-6">
                                <div class="links">
                                    <ul class="uppercase-links stacked-links">
                                        <li>
                                            <a href="https://info.mch.ifsuldeminas.edu.br/professores">
                                                Professores </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-6">
                                <div>
                                    <a href="https://www.facebook.com/informaticaifmachado" target="_blank"
                                        class="btn btn-just-icon btn-round btn-facebook">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="copyright">
                            <div>
                                &copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> | Informática</div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer fim -->
        <!-- srcipts da tela cadastro -->
        <script type="text/javascript">
            $(".textboxregister input").focusout(function () {
                if ($(this).val() == "") {
                    $(this).siblings().removeClass("hidden");
                } else {
                    $(this).siblings().addClass("hidden");
                }
            });
            $(".textboxregister input").keyup(function () {
                let inputs = $(".textboxregister input");
                if (inputs[0].value != "" && inputs[1].value) {
                    $(".register-btn").attr("disabled", false);
                    $(".register-btn").addClass("active");
                } else {
                    $(".register-btn").attr("disabled", true);
                    $(".register-btn").removeClass("active");
                }
            });
        </script>
        <!-- Core JS Files -->
        <script src="https://info.mch.ifsuldeminas.edu.br/wp-content/themes/informatica/assets/js/jquery-3.2.1.min.js"
            type="text/javascript"></script>
        <script
            src="https://info.mch.ifsuldeminas.edu.br/wp-content/themes/informatica/assets/js/jquery-ui-1.12.1.custom.min.js"
            type="text/javascript"></script>
        <script src="https://info.mch.ifsuldeminas.edu.br/wp-content/themes/informatica/assets/js/popper.js"
            type="text/javascript"></script>
        <script src="https://info.mch.ifsuldeminas.edu.br/wp-content/themes/informatica/assets/js/bootstrap.min.js"
            type="text/javascript"></script>
        <script
            src="https://info.mch.ifsuldeminas.edu.br/wp-content/themes/informatica/assets/js/paper-kit.js?v=2.1.0"></script>
    </body>

</html>
<?php
    ob_end_flush();
?>