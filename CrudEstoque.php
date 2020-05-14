<?php

    require_once './conexao/conexao.php';

    Class Estoque{

        //select 
        public function selectEstoque(){

            $pdo = conexao();
            $result = array();
            $select = $pdo->query("SELECT idestoque, nome, quantidade, descricaoEstoque 
            FROM componentes INNER JOIN estoque ON componentes.idcomponentes = 
            estoque.componentes_idcomponentes ORDER BY componentes.nome;");

            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        //delete
          public function deleteEstoque($idEstoque){

            $pdo = conexao();
            $delete = $pdo->prepare("DELETE FROM estoque WHERE idestoque = :idEstoq");
            $delete->bindValue('idEstoq', $idEstoque);
            $delete->execute();
        }
  }

?>