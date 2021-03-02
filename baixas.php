<?php

    require_once 'verifica.php';
    require_once './classes/CrudEstoque.class.php';
    require_once './classes/CrudComponentes.class.php';
    require_once './classes/CrudBaixas.class.php';
    ob_start();
    $estoque = new Estoque();
    $componentes = new Componente();
    $baixas = new Baixas();

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
    <meta property="og:image" content="https://info.mch.ifsuldeminas.edu.br/wp-content/uploads/2019/05/home-2910592_1920.jpg">
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
    <nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
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
                        <a class="nav-link" href="cadastro.php"
                            data-scroll="true">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="estoque.php"
                            data-scroll="true">Estoque</a>
                    </li>
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
                <h1 class="title-uppercase text-center"><b>Movimentação</b></h1>
                <h3 class="text-center"></h3>
                <br>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="main">
            <div class="section section-gray">
                <div class="container-fluid">
                    <section class="container-register row">
                        <?php
                            if (isset($_POST['idestoque']) || isset($_POST['quantidade']) || isset($_POST['observacao'])) {//clicou no botão cadastrar ou atualizar.
                                //verifica se é o botão atualizar que foi clicado.
                                if (isset($_GET['id_up']) && !empty($_GET['id_up'])){

                                    $id_update = (int)$_GET['id_up'];
                                    $quantidade = intval($_POST['quantidade']);
                                    $observacao = addslashes($_POST['observacao']);

                                    date_default_timezone_set('America/Sao_Paulo');
                                    $data = implode("-",array_reverse(explode("/",date('d/m/Y'))));

                                    if (!empty($quantidade) && !empty($observacao)) {

                                        $observacao = ucwords(strtolower($observacao));
                                        
                                        if($baixas->atualiza($observacao, $data, $quantidade, $id_update)){
                                        
                                            header("Location: baixas.php");

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

                                    $idestoque = intval($_POST['idestoque']);
                                    $quantidade = (int)$_POST['quantidade'];
                                    $observacao = addslashes($_POST['observacao']);

                                    date_default_timezone_set('America/Sao_Paulo');
                                    $data = implode("-",array_reverse(explode("/",date('d/m/Y'))));

                                    if (!empty($quantidade) && !empty($observacao)){

                                        $observacao = ucwords(strtolower($observacao));
                                        
                                        if(!$baixas->insertBaixas($observacao, $data, $quantidade, $idestoque)){
                        ?>
                                            <div class="alert-erro">
                                                <span class="fas fa-exclamation-triangle"></span>
                                                <span class="msg">Não foi posivel cadastrar a baixa</span>
                                                <span class="close-btn">
                                                    <span class="fa-time"></span>
                                                </span>
                                            </div>
                        <?php
                                        }else {
                        ?>
                                                <div class="alert-acerto">
                                                    <span class="fa fa-thumbs-o-up"></span>
                                                    <span class="msg">Baixa realizada com sucesso</span>
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
                                $result = $baixas->selectId($id_update);

                            }
                        ?>
                        <section id="left" class="col-md-4">
                            <form method="POST" class="form-register">
                                <h3>Movimentação</h3>
                                <div class="textboxregister">
                                    <label for="name">Nome</label>
                                    <?php
                                        if(empty($_GET['id_up'])){
                                    ?>
                                            <select name="idestoque" id="idestoque" title="Selecione o nome do componente">
                                    <?php   
                                                $dados = $estoque->selectEstoque();
                                                    
                                                foreach ($dados as  $value){          
                                    ?>  
                                                    <option value="<?php echo $value['idestoque']?>">
                                                            <?php
                                                                echo $value['nome']." (quantitade: ".$value['quantidade'].")";
                                                            ?>
                                                    </option>
                                    <?php
                                                }
                                    ?>
                                            </select>  
                                    <?php           
                                        } else {
                                    ?>
                                            <input type="text" name="name" id="name" title="O Nome do componente não pode ser alterado"
                                                value="<?php //verifica se a variavel $result possui dados, caso a mesma possua printara o resultado
                                                    if (isset($result)) {
                                                        echo $result['nome'];
                                                    }
                                                ?>" disabled>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="textboxregister">
                                    <label for="quantidade">Quantidade Removida</label>
                                    <input type="number" name="quantidade" id="quantidade" title="Informe a quantidade de componentes a ser removida">
                                    <span class="check-message-register hidden">Obrigatório</span>
                                </div>
                                <div class="textboxregister">
                                    <label for="observacao">Observação</label>
                                    <input type="text" name="observacao" id="observacao" title="Informe o motivo da baixa">
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
                                    $dados = $baixas->selectBaixas();
                                    //defini o numero de paginas
                                    $limit = 10;
                                    //pagina atual
                                    $pagina = (!isset($_GET['pagina'])) ? 1 : $_GET['pagina'];
                                    $total = ceil((count($dados) / $limit));
                                    $inicio = ($limit * $pagina)-$limit;
                                    
                                    $selectLimit = $baixas->selectBaixasLimit($inicio, $limit);
                                    

                                    if(count($dados) > 0){
                                ?>
                                        <tr id="title-register">
                                            <th id="title-register">Nome</th>
                                            <th id="title-register">Quantidade</th> 
                                            <th id="title-register">Motivo</th> 
                                            <th id="title-register">Data</th> 
                                            <th id="title-register">Funções</th>
                                        </tr>
                                <?php        
                                        for ($i=0; $i < count($selectLimit); $i++) { 
                                            $data = implode("/",array_reverse(explode("-",$selectLimit[$i]['data'])));
                                            
                                            echo "<tr>";
                                                echo "<td>".$selectLimit[$i]['nome']."</td>";
                                                echo "<td>".$selectLimit[$i]['quantidade']."</td>";
                                                echo "<td>".$selectLimit[$i]['motivo']."</td>";
                                                echo "<td>".$data."</td>";
                                ?>
                                            <td>
                                                <a href="baixas.php?id_up=<?php echo $dados[$i]["idbaixas"];?>" id="to-edit">Editar</a>
                                                <a data-toggle="modal" data-target="#myModal" id="delete" <?php $_SESSION["idbaixas"] = $dados[$i]["idbaixas"];?>>Excluir</a> <!-- pegando idestoque para poder exclui-lo -->
                                            </td>
                                <?php
                                            echo "</tr>";
                                        }
                                ?>
                            </table>
                            <!-- Modal -->
                            <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tem certeza de que deseja excluir os dados ?</h5>
                                    </div>
                                    <div class="text-center mt-3">
                                        <?php

                                            $dados = $baixas->selectId((int)$_SESSION["idbaixas"]);

                                            if(count($dados) > 0){
                                                
                                                echo "<h5> Nome: ".$dados['nome']."</h5>";
                                                
                                            }
                                        ?>
                                    </div>  
                                    <div class="modal-body">
                                        <p>Caso os dados sejam excluidos, não sera possível desfazer essa ação!!.</p>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <a href="#" class="btn btn-danger" data-dismiss="modal">Não</a>
                                        <a href="baixas.php?id=<?php echo $_SESSION["idbaixas"];?>" class="btn btn-success">Sim</a>
                                        <?php
                                            // vefificando se o iditen foi pego corretamente, caso ele tenha sido pego a função deleteItens irá exclui-lo
                                            if (isset($_GET["id"])) {
                                                $idbaixas = addslashes($_GET["id"]);
                                                $baixas->deleteBaixas($idbaixas);
                                                header("Location: baixas.php");
                                            }
                                        ?>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Final Modal -->
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
                        <div class="relatorio col-md-12">
                            <p>
                                Clique aqui para gerar o relátorio de Baixas.
                                <a target="_brack" href="geradorPdf.php?idBaixasPdf=<?php echo "1";?>" class="fa fa-file-pdf-o" aria-hidden="true"></a>
                            </p>
                        </div>
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
    <!-- srcipts da tela logio -->
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