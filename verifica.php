<?php

    require_once './conexao/conexao.php';
    $pdo = conexao();

    if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
        require_once 'classes/CrudComponentes.class.php';
        $idUser = new Componente();
        $list = $idUser->logado($_SESSION['id']);

    } else {
        header("Location: index.php");
    }
?>