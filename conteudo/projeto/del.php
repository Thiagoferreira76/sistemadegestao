<?php
include('../../config/conexao.php');
if(isset($_GET['idDel'])){
    $id =$_GET['idDel'];
    $delete ="DELETE FROM tb_cadastro WHERE tb_id=:id";

    try{
        $resulta=$conect->prepare($delete);
        $resulta->bindValue(':id',$id, PDO::PARAM_INT);
        $resulta->execute();

        $contar=$resulta->rowCount();
        if($contar>0){
            header("Location:  cadastra.php");
        }else{
            header("Location:../../casa/home.php");
        }
    }catch(PDOException $e){
        echo "ERRO DE PDO ",$e->getMessage();
    }
}