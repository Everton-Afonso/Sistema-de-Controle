<?php

    require_once './conexao/conexao.php';

    Class Itens{

        //select 
        public function selectItens(){

            $pdo = conexao();
            $result = array();
            $select = $pdo->query("SELECT iditens, nome, quantidade FROM componentes INNER JOIN itens ON 
            componentes.idcomponentes = itens.componentes_iditens ORDER BY componentes.nome;");
            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        //delete
          public function deleteItens($idIten){

            $pdo = conexao();
            $delete = $pdo->prepare("DELETE FROM itens WHERE iditens = :idIten");
            $delete->bindValue('idIten', $idIten);
            $delete->execute();
        }
  }

?>