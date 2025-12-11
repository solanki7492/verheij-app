<?php

try{
       $db = new PDO('mysql:host=localhost;dbname=vanooapps_whd', 'vanooapps_whd', 'A0XbvaS7jtEUk');
    }catch(PDOException $e){
 	   print_r($e->getMessage());
        echo 'no_database_available';
        //exit;
    }

    $sth = $db->prepare('SELECT * FROM products');
    $sth->execute();
    $data = $sth->fetchAll();

    echo json_encode($data);

    ?>
	
	
