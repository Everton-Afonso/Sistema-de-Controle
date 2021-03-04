<?php

session_start(); 
    require_once './conexao/conexao.php';
    $pdo = conexao();

    if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
        require_once './classes/CrudEstoque.class.php';
        $idUser = new Estoque();
        $list = $idUser->logado($_SESSION['id']);

    } else {
        header("Location: index.php");
    }
?>