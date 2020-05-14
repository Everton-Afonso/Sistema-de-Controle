<?php

    require_once 'verifica.php';
    require_once 'CrudComponentes.php';
    $componentes = new Componentes();

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
                        <img src="https://info.mch.ifsuldeminas.edu.br/wp-content/uploads/2019/04/logo.png"> Informática
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
                        <a class="nav-link" href="estoque.php"
                            data-scroll="true">Estoque</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-warning" href="logout.php">
                            <i class="nc-icon nc-email-85"></i>Sair
                        </a>
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
                <h1 class="title-uppercase text-center"><b>Projetos</b></h1>
                <h3 class="text-center">Conheça nossos Projetos, Laboratórios e Grupos de Estudos e Pesquisas</h3>
                <br>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="main">
            <div class="section section-gray">
                <div class="container-fluid">
                    <section class="container-register row">
                        <section id="left" class="col-md-4">
                            <form method="POST" class="form-register">
                                <h3>Cadastro de Componentes</h3>
                                <?php
                                    if (isset($_POST['name'])) { 
                                        $name = addslashes($_POST['name']);
                                        $description = addslashes($_POST['description']);
                                        $quantidade = addslashes($_POST['quantidade']);
                                        $idUser = addslashes($_SESSION['id']);

                                        if (!empty($name) && !empty($description) && !empty($quantidade)) {
                                            if(!$componentes->insertComponentes($name, $description, $quantidade, $idUser)){
                                ?>
                                                <p class="erro text-center">
                                                    <?php
                                                        echo "Componente já esta cadastrado";
                                                    ?> 
                                                </p>
                                <?php
                                            }
                                        } else {
                                ?>
                                            <p class="erro text-center">
                                                <?php
                                                    echo "Preencha todos os dados";
                                                ?>
                                            </p>
                                <?php
                                        }
                                    }
                                ?>
                                <div class="textboxregister">
                                    <label for="name">Nome</label>
                                    <input type="text" name="name" id="name">
                                    <span class="check-message-register hidden">Obrigatório</span>
                                </div>
                                <div class="textboxregister">
                                    <label for="description">Descrição</label>
                                    <input type="text" name="description" id="description">
                                    <span class="check-message-register hidden">Obrigatório</span>
                                </div>
                                <div class="textboxregister">
                                    <label for="quantidade">Quantidade</label>
                                    <input type="text" name="quantidade" id="quantidade">
                                    <span class="check-message-register hidden">Obrigatório</span>
                                </div>
                                <input type="submit" value="Cadastrar" name="login" id="login" class="register-btn" disabled>
                            </form>
                        </section>
                        <section id="right" class="col-md-8">
                        <table>
                                <tr id="title-register">
                                    <td id="title-register">Nome</td>
                                    <td id="title-register">Descrição</td>
                                    <td id="title-register">Quantidade</td>
                                    <td id="title-register">Editar</td>
                                </tr>
                            <?php
                                $dados = $componentes->selectComponentes();
                                if(count($dados) > 0){ // buscando dasdo no DB para exibilos
                                    for ($i=0; $i < count($dados); $i++) { 
                                        echo "<tr>";
                                        foreach ($dados[$i] as $key => $value) {
                                            if ($key != "idcomponentes" && $key != "usuario_idusuario") {
                                                echo "<td>".$value."</td>";
                                            }
                                        }
                            ?>
                                        <td>
                                            <a href="" id="to-edit">Editar</a>
                                        </td>
                            <?php
                                        echo "</tr>";
                                    }
                                } else { // DB vasio
                                    echo "<p class='text-center'>Não exixte dados cadastrados.</p>";
                                }
                            ?>
                            </table>
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
            if (inputs[0].value != "" && inputs[1].value && inputs[2].value) {
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
</body>

</html>