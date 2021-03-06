<?php
    require_once 'verifica.php';
    require_once './classes/CrudEstoque.class.php';
    $estoque = new Estoque();
    
    if(session_status() !== PHP_SESSION_ACTIVE) { 
        session_start(); 
    } 
    ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

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
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light NavBarContainer">
                <a class="navbar-brand NavLogo" href="#">
                    <img src="./img/logoIf.png" alt="If">
                        <p>Bem Vindo
                            <?php 
                                $idUser = (int)$_SESSION['id'];
                                echo ucfirst($estoque->selectUser($idUser));
                            ?>
                        </p>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="menu">
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item NavItem">
                      <a class="nav-link active NavLink" href="baixas.php">Movimentação</a>
                    </li>
                    <li class="nav-item NavItem">
                        <a class="nav-link active NavLink" href="logout.php">Sair</a>
                      </li>
                  </ul>
                </div>
              </nav>
        </div>
    </header>
    <div class="banner"></div>
    <div class="containerTabela">
        <section class="container-register row">
            <?php
                if (isset($_POST['name'])) {  //clicou no botão cadastrar ou atualizar.
                    //verifica se é o botão atualizar que foi clicado.
                    if (isset($_GET['id_up']) && !empty($_GET['id_up'])){

                        $id_update = (int)$_GET['id_up'];
                        $name = addslashes($_POST['name']);
                        $description = addslashes($_POST['description']);
                        $quantidade = intval($_POST['amount']);
                        $observacao = addslashes($_POST['localization']);
                        

                        if (!empty($name) && !empty($description) && !empty($quantidade) && !empty($observacao)) {

                            $name = ucwords(strtolower($name));
                            $description = ucwords(strtolower($description));
                            $observacao = ucwords(strtolower($observacao));

                            if($estoque->atualiza($name, $description, $quantidade, $observacao, $id_update)){

                                header("Location: cadastro.php");

                            }else {
            ?>
                                <div class="alert-erro">
                                    <span class="msg">Erro ao tentar atualizar o componente</span>
                                </div>
            <?php                
                        }
                    } 

                } else { // caso contrario foi o botão cadastrar.

                        $idUser = (int)$_SESSION['id'];
                        $name = addslashes($_POST['name']);
                        $description = addslashes($_POST['description']);
                        $quantidade = intval($_POST['amount']);
                        $observacao = addslashes($_POST['localization']);

                    if (!empty($name) && !empty($description) && !empty($quantidade) && !empty($observacao)) {

                        $name = ucwords(strtolower($name));
                        $description = ucwords(strtolower($description));
                        $observacao = ucwords(strtolower($observacao));

                        if(!$estoque->insertEstoque($name, $description, $observacao, $quantidade, $idUser)){
            ?>                    
                            <div class="alert-erro">
                                <span class="msg">Componente já esta cadastrado</span>
                            </div>
            <?php
                        }else {
            ?>
                            <div class="alert-acerto">
                                <span class="msg">Componente cadastrado com sucesso</span>
                            </div>
            <?php                
                            }
                        } else {
            ?>
                            <div class="alert-erro">
                                    <span class="msg"><?php echo "Preencha todos os dados"; ?></span>
                            </div>
            <?php
                        }
                    } 
                }
                //verificar se o usuraio clicou no botão editar, e retornara os dados selecionados pelo id
                if (isset($_GET['id_up'])) {

                    $id_update = addslashes($_GET['id_up']);
                    $result = $estoque->selectId($id_update);

                }
            ?>
            <section id="left" class="col-md-4">
                <form method="POST" class="form-register">
                    <h3>Componentes</h3>
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
                        <input type="text" name="description" id="description" 
                            title="Deixe aqui uma breve descrição do componente"
                                value="<?php //verifica se a variavel $result possui dados, caso a mesma possua printara o resultado
                                            if (isset($result)) {
                                                echo $result['descricao'];
                                            }
                                        ?>">
                            <span class="check-message-register hidden">Obrigatório</span>
                    </div>
                    <div class="textboxregister">
                        <label for="amount">Quantidade</label>
                        <input type="text" name="amount" id="amount" 
                            title="Quantidade de componente"
                                value="<?php //verifica se a variavel $result possui dados, caso a mesma possua printara o resultado
                                            if (isset($result)) {
                                                echo $result['quantidade'];
                                            }
                                        ?>">
                            <span class="check-message-register hidden">Obrigatório</span>
                    </div>
                    <div class="textboxregister">
                        <label for="localization">Localização</label>
                        <input type="text" name="localization" id="localization" 
                            title="Localização do componente"
                            value="<?php //verifica se a variavel $result possui dados, caso a mesma possua printara o resultado
                                        if (isset($result)) {
                                            echo $result['localizacao'];
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
            <section id="right" class="col-md-8 Table">
                <table>
                <?php
                    $dados = $estoque->selectEstoque();
                    //defini o numero de paginas
                    $limit = 10;
                    //pagina atual
                    $pagina = (!isset($_GET['pagina'])) ? 1 : $_GET['pagina'];
                    $total = ceil((count($dados) / $limit));
                    $inicio = ($limit * $pagina)-$limit;
                    
                    $selectLimit = $estoque->selectEstuqueLimit($inicio, $limit);

                    if(count($dados) > 0){
                ?>
                        <tr id="title-register">
                            <th id="title-register">Nome</th>
                            <th id="title-register">Descrição</th> 
                            <th id="title-register">Quantidade</th> 
                            <th id="title-register">Localização</th> 
                            <th id="title-register">Funções</th> 
                        </tr>
                <?php 
                    for ($i=0; $i < count($selectLimit); $i++) {            
                        echo "<tr>";
                        foreach ($selectLimit[$i] as $key => $value) {
                            if ($key != "idestoque" && $key != "usuario_idusuario") {
                                echo "<td>".$value."</td>";
                            }
                        }
                ?> 
                        <td>
                            <a href="cadastro.php?id_up=<?php echo $dados[$i]["idestoque"];?>" id="to-edit">Editar</a>
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
                <div class="relatorio col-md-12">
                    <p>
                        Clique aqui para gerar o relátorio.
                        <a target="_brack" href="geradorPdf.php" class="fa fa-file-pdf-o" aria-hidden="true"></a>
                    </p>
                </div>
            </section>
        </section>
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
            if (inputs[0].value != "" && inputs[1].value && inputs[2].value && inputs[3].value) {
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