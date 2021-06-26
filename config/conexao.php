<?php
    try{
        DEFINE('HOST','localhost');
        DEFINE('BD','estoque');
        DEFINE('USER','root');
        DEFINE('PASS','');

        $conect = new PDO("mysql:host=".HOST.";dbname=".BD,USER,PASS);   //PDO é o método de conexão do php com o banco
        $conect ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//ATRIBUTO PRA MOSTRAR OS ERROR COM PRECISAO
        
    }catch(PDOException $erro){
        echo "houve um erro no código" .$erro ->getMessage();
    }
    ?>