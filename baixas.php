<?php
    require_once 'verifica.php';
    require_once './classes/CrudEstoque.class.php';
    require_once './classes/CrudBaixas.class.php';
    $estoque = new Estoque();
    $baixas = new Baixas();
    ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimentação</title>

    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
	<link
        rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous"
    />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Rajdhani:wght@600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light NavBarContainer">
            <a class="navbar-brand NavLogo" href="#">
                <img src="./img/logoIf.png" alt="If">
                    <p>Bem Vindo
                        <?php 
                            $idUser = (int)$_SESSION['id'];
                            echo $estoque->selectUser($idUser);
                        ?>
                    </p>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item NavItem">
                    <a class="nav-link active NavLink" href="cadastro.php">Cadastro</a>
                </li>
                <li class="nav-item NavItem">
                    <a class="nav-link active NavLink" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
            </nav>
    </header>
    <div class="banner"></div>
    <div class="flex-container">
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
        <div class="leftForm">
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
        </div>
        <div class="rightTable">
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
                        echo "<p class='text-center'>Ops !!! não existe dados cadastrados.</p>";
                    }
                ?>
            </div>
            <div class="relatorio">
                <p>
                    Clique aqui para gerar o relátorio.
                    <a target="_brack" href="geradorPdf.php" class="fa fa-file-pdf-o" aria-hidden="true"></a>
                </p>
            </div>
        </div>
    </div>
    <footer class="container-fluid Copy"> 
        <div class="row">
            <div class="col-md-12">
                <strong>
                    &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    | Autobots
                </strong>
            </div>
        </div>
    </footer>
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
    <script
        src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"
    ></script>
</body>
</html>
<?php
    ob_end_flush();
?>