<?php

    if(session_status() !== PHP_SESSION_ACTIVE) { 
        session_start(); 
    } 
    ob_start();

    function conexao(){

        try {
            $pdo = new PDO("mysql:dbname=mydb;host=localhost", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro com banco de dados: ".$e->getMessage();
            exit;
        } catch (PDOException $e) {
            echo "Erro generico: ".$e->getMessage();
            exit;
        }
        return $pdo;
        
    }
    
    ob_end_flush();
?>