<?php
    // Faz o usuario sair da aplicação
    require_once './classes/CrudEstoque.class.php';
    $componentes = new Estoque();
    $componentes->exit();

?>