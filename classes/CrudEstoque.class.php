<?php

    require_once "conexao/conexao.php";

    Class Estoque{

        //seleciona todos od dados da tabela estoque 
        public function selectEstoque(){

            $pdo = conexao();
            $result = array();
            $select = $pdo->query("SELECT idestoque, nome, quantidade, descricaoEstoque 
            FROM componentes INNER JOIN estoque ON componentes.idcomponentes = 
            estoque.componentes_idcomponentes ORDER BY componentes.nome;");

            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }

        //insere dados na tabela estoque
        public function insertEstoque($observacao, $quantidade, $idcomponentes){

            $pdo = conexao();
            //verificando se o componente ja foi cadastrado
            $select = $pdo->prepare("SELECT nome FROM componentes INNER JOIN estoque ON componentes.idcomponentes = 
            estoque.componentes_idcomponentes WHERE componentes.idcomponentes = :idcomponentes");
            $select->bindValue('idcomponentes', $idcomponentes);
            $select->execute();

            if ($select->rowCount() > 0) { // componente já existe no DB
                return false;
            } else { // componente não existe no DB
                $insert = $pdo->prepare("INSERT INTO estoque(descricaoEstoque, quantidade, componentes_idcomponentes) 
                VALUES (:observacao, :quantidade, :idcomponentes)");

                $insert->bindValue('observacao', $observacao);
                $insert->bindValue('quantidade', $quantidade);
                $insert->bindValue('idcomponentes', $idcomponentes);
                $insert->execute();
                
                return true;
            }
        }

        //deleta um tederminado dados da tabela estoque
          public function deleteEstoque($idEstoque){

            $pdo = conexao();
            $delete = $pdo->prepare("DELETE FROM estoque WHERE idestoque = :idEstoq");
            $delete->bindValue('idEstoq', $idEstoque);
            $delete->execute();
        }
  }

?>