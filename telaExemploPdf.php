<?php
    require_once 'verifica.php';
    require_once './classes/CrudEstoque.class.php';
    require_once './classes/CrudBaixas.class.php';

    $estoque = new Estoque();
    $baixas = new Baixas();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relátorio</title>
    <!-- css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        /* telaExemploPdf.php*/
        .banner img{
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: 100px;
        }
        #text-banner {
            background: rgba(0, 0, 0, 0.5);
            padding-bottom: 15px;
        }
        .relatorio{
            padding-top: 20px;
        }
        .relatorio h3{
            text-align: center;
            padding-bottom:35px;
        }
        #title-register {
            font-weight: bold;
            width: 169px;
            border: 1px solid rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        table {
            padding-top: 20px;
        }
        td {
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <section class="banner">
        <div id="text-banner"></div>  
        <img src="images/autobots.jpg" alt="">  
        <div id="text-banner"></div> 
        <?php   
        var_dump($_GET["idBaixasPdf"]);
                if (isset($_GET["idBaixasPdf"])) {
            ?>
                    <div class="relatorio">
                        <h3>Autobots IF Machado</h3>
                        <h4>Relátorio de baixas dos componentes</h4>
                        <p>Data de retirada do relatorio: 
                            <?php 
                            date_default_timezone_set('America/Sao_Paulo');
                            echo date('d/m/Y H:i:s'); 
                            ?>
                        </p>
                    </div>
                    <div class="registros">
                        <table>
            <?php
                            $dados = $baixas->selectBaixas();
                            if(count($dados) > 0){
            ?>
                                    <tr id="title-register">
                                        <th id="title-register">Nome</th>
                                        <th id="title-register">Baixas</th> 
                                        <th id="title-register">Motivo</th> 
                                        <th id="title-register">Data</th> 
                                    </tr>
            <?php        
                                    for ($i=0; $i < count($dados); $i++) { 
                                        $data = implode("/",array_reverse(explode("-",$dados[$i]['data'])));
                                        
                                        echo "<tr>";
                                            echo "<td>".$dados[$i]['nome']."</td>";
                                            echo "<td>".$dados[$i]['quantidade']."</td>";
                                            echo "<td>".$dados[$i]['motivo']."</td>";
                                            echo "<td>".$data."</td>";
                                        echo "</tr>";
                                }
                            } else { // DB vasio
                                echo "<p class='text-center'>Não exixte dados cadastrados.</p>";
                            }
            ?>
                        </table>
                    </div>
            <?php
                }else{
            ?>
                    <div class="relatorio">
                        <h3>Autobots IF Machado</h3>
                        <h4>Relátorio de componentes cadastros no estoque</h4>
                        <p>Data de retirada do relatorio: 
                            <?php 
                            date_default_timezone_set('America/Sao_Paulo');
                            echo date('d/m/Y H:i:s'); 
                            ?>
                        </p>
                    </div>
                    <div class="registros">
                        <table>
            <?php
                            $dados = $estoque->selectEstoque();
                            if(count($dados) > 0){
                                ?>
                                    <tr id="title-register">
                                        <td id="title-register">Nome</td>
                                        <td id="title-register">Descrição</td> 
                                        <td id="title-register">Quantidade</td> 
                                        <td id="title-register">Localização</td>  
                                    </tr>
                                <?php 
                                    for ($i=0; $i < count($dados); $i++) { 
                                        echo "<tr>";
                                        foreach ($dados[$i] as $key => $value) {
                                            if ($key != "idestoque") {
                                                echo "<td>".$value."</td>";
                                            }
                                        }
                                        echo "</tr>";
                                    }
                                } else { // DB vasio
                                    echo "<p class='text-center'>Não exixte dados cadastrados.</p>";
                                }
                ?>
                        </table>
                    </div>
                <?php
                }
            ?>
    </section>
    <!-- javaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
