<?php

    require_once "conexao/conexao.php";
    if(session_status() !== PHP_SESSION_ACTIVE) { 
        session_start(); 
    } 
    Class Baixas{
        //select 
        public function selectBaixas(){

            $pdo = conexao();
            $result = array();
            $select = $pdo->query("SELECT * FROM baixas INNER JOIN estoque ON 
            estoque.idestoque = baixas.estoque_idestoque ORDER BY nome");
            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        //select por id
        public function selectId($id){

            $pdo = conexao();
            $result = array();
            $select = $pdo->prepare("SELECT * FROM baixas INNER JOIN estoque ON 
            estoque.idestoque = baixas.estoque_idestoque AND idbaixas = :id");
            $select->bindValue('id', $id);
            $select->execute();
            $result = $select->fetch(PDO::FETCH_ASSOC);
            return $result;
  
        }
        public function selectQuantidade($idestoque){

            $pdo = conexao();

            $select = $pdo->query("SELECT quantidade FROM estoque WHERE idestoque = $idestoque");
            $result = $select->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            
        }
        //ataliza a quantidade da tabela estoque
        public function atualizaQuantidade($result, $idestoque){

            $pdo = conexao();

            $update = $pdo->prepare("UPDATE estoque SET quantidade = :quantidade WHERE  idestoque = :idestoque");
            $update->bindValue('quantidade', $result);
            $update->bindValue('idestoque', $idestoque);
            $update->execute();

        }
        //insert
        public function insertBaixas($observacao, $data, $quantidade, $idestoque){

            $pdo = conexao();
            //verificando se o componente ja foi cadastrado    
            $select = $pdo->prepare("SELECT nome FROM estoque INNER JOIN baixas ON estoque.idestoque = baixas.estoque_idestoque 
            WHERE estoque.idestoque = :idestoque");
            $select->bindValue('idestoque', $idestoque);
            $select->execute();
  
            if ($select->rowCount() > 0) { // componente já existe no DB
                return false;
            } else { // componente não existe no DB

                //update
                $total = $this-> selectQuantidade($idestoque);

                foreach ($total as $key => $value) {
                    if ($quantidade > intval($value['quantidade'])) {

                        $this->atualizaQuantidade(intval($value['quantidade']), $idestoque);
                    } else {
                        $result = intval($value['quantidade']) - $quantidade;
                        $this->atualizaQuantidade($result, $idestoque);
                    }
                }
                
                //insert
                $insert = $pdo->prepare("INSERT INTO baixas(motivo, data, estoque_idestoque) 
                VALUES (:observacao, :data, :idestoque)");
                $insert->bindValue('observacao', $observacao);
                $insert->bindValue('data', $data);
                $insert->bindValue('idestoque', $idestoque);
                $insert->execute();
                
                return true;
            }
        }
        // update
        public function atualiza($observacao, $data, $quantidade, $id_update){

            $pdo = conexao();
            
            $select = $pdo->prepare("SELECT idestoque FROM estoque INNER JOIN baixas ON estoque.idestoque = baixas.estoque_idestoque WHERE idbaixas = :idbaixas");
            $select->bindValue('idbaixas', $id_update);
            $select->execute();
            $idselect = $select->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($idselect as $key => $value) {
                $id = intval($value['idestoque']);
                $total = $this-> selectQuantidade($id);
                foreach ($total as $key => $value) {
                    $result = intval($value['quantidade']) - $quantidade;
                    if($result >= 0){
                        $update = $pdo->prepare("UPDATE baixas INNER JOIN estoque ON idestoque = estoque_idestoque 
                        AND idbaixas = :id SET motivo = :observacao, data = :data, quantidade = :quantidade");
                        $update->bindValue('id', $id_update);
                        $update->bindValue('observacao', $observacao);
                        $update->bindValue('data', $data);
                        $update->bindValue('quantidade', $result);
                        $update->execute();
                    }else{
                        return false;
                    }
                }
            }
            return true;

        }
        //delete
        public function deleteBaixas($idBaixas){

            $pdo = conexao();
            $delete = $pdo->prepare("DELETE FROM baixas WHERE idbaixas = :idbaixas");
            $delete->bindValue('idbaixas', $idBaixas);
            $delete->execute();
        }
    }     
?>