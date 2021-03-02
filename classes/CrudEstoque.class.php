<?php

    require_once "conexao/conexao.php";

    Class Estoque{

        //select estoque
        public function selectEstoque(){

            $pdo = conexao();
            $result = array();
            $select = $pdo->query("SELECT idestoque, nome, descricao, quantidade, descricaoEstoque 
            FROM componentes INNER JOIN estoque ON idcomponentes = 
            componentes_idcomponentes ORDER BY nome");

            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
<<<<<<< HEAD
        //select limit
        public function selectEstuqueLimit($inicio, $limit){

          $pdo = conexao();
          $result = array();
          $select = $pdo->query("SELECT idestoque, nome, descricao, quantidade, descricaoEstoque 
          FROM componentes INNER JOIN estoque ON idcomponentes = componentes_idcomponentes 
          ORDER BY nome LIMIT $inicio, $limit");
          $result = $select->fetchAll(PDO::FETCH_ASSOC);
          return $result;

      }
        //select por id
        public function selectId($id){

          $pdo = conexao();
          $result = array();
          $select = $pdo->prepare("SELECT * FROM estoque INNER JOIN componentes ON 
          idcomponentes = componentes_idcomponentes AND idestoque = :id");
          $select->bindValue('id', $id);
          $select->execute();
          $result = $select->fetch(PDO::FETCH_ASSOC);

          return $result;

      }
      // update
      public function atualiza($observacao, $quantidade, $id_update){

          $pdo = conexao();

          $select = $pdo->query("SELECT quantidade FROM estoque WHERE idestoque = $id_update");

          foreach ($select as $key => $value) {
              $result = intval($value['quantidade']) + $quantidade;
          }

          $update = $pdo->prepare("UPDATE estoque SET descricaoEstoque = :observacao, quantidade = :quantidade 
          WHERE idestoque = :id");
          $update->bindValue('observacao', $observacao);
          $update->bindValue('quantidade', $result);
          $update->bindValue('id', $id_update);
          $update->execute();

          return true;

      }
        //insert
        public function insertEstoque($observacao, $quantidade, $idcomponentes){

          $pdo = conexao();
          //verificando se o componente ja foi cadastrado
          $select = $pdo->prepare("SELECT nome FROM componentes INNER JOIN estoque ON idcomponentes = 
          componentes_idcomponentes WHERE idcomponentes = :idcomponentes");
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
        //delete
          public function deleteEstoque($idEstoque){
=======
        //pesquisa o nome desejado
        public function pesquisar($name){

            $pdo = conexao();
            $result = array();
            $select = $pdo->query("SELECT idestoque, nome, descricao, quantidade, descricaoEstoque FROM componentes 
            INNER JOIN estoque ON idcomponentes = componentes_idcomponentes WHERE nome LIKE '".$name."%'");
            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        //select limit
        public function selectEstuqueLimit($inicio, $limit){

            $pdo = conexao();
            $result = array();
            $select = $pdo->query("SELECT idestoque, nome, descricao, quantidade, descricaoEstoque 
            FROM componentes INNER JOIN estoque ON idcomponentes = componentes_idcomponentes 
            ORDER BY nome LIMIT $inicio, $limit");
            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            return $result;
  
        }
        //select por id
        public function selectId($id){

            $pdo = conexao();
            $result = array();
            $select = $pdo->prepare("SELECT * FROM estoque INNER JOIN componentes ON 
            idcomponentes = componentes_idcomponentes AND idestoque = :id");
            $select->bindValue('id', $id);
            $select->execute();
            $result = $select->fetch(PDO::FETCH_ASSOC);
  
            return $result;
  
        }
         // update
        public function atualiza($observacao, $quantidade, $id_update){

            $pdo = conexao();

            $select = $pdo->query("SELECT quantidade FROM estoque WHERE idestoque = $id_update");

            foreach ($select as $key => $value) {
                $result = intval($value['quantidade']) + $quantidade;
            }

            $update = $pdo->prepare("UPDATE estoque SET descricaoEstoque = :observacao, quantidade = :quantidade 
            WHERE idestoque = :id");
            $update->bindValue('observacao', $observacao);
            $update->bindValue('quantidade', $result);
            $update->bindValue('id', $id_update);
            $update->execute();

            return true;

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
>>>>>>> 4e0bcbb0817270f2b5131c412c4c12a9a3d1e42c

            $pdo = conexao();
            $delete = $pdo->prepare("DELETE FROM estoque WHERE idestoque = :idestoque");
            $delete->bindValue('idestoque', $idEstoque);
            $delete->execute();

        }
  }

?>