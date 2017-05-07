<?php
    session_start();
    $host='localhost'; 
    $dbname='ezxkneuk_ReviewApp';
    $user='ezxkneuk_Stephen';
    $pass='123Excalibur';
    try{
        $DBH=new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>