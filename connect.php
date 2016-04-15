<?php
/**
 * Created by PhpStorm.
 * User: session2
 * Date: 4/6/16
 * Time: 4:34 PM
 */

        $hostname = 'localhost';
        $dbname = 'Uproar';
        $username = 'root';
        $password = 'root';

        $conn = Null;

        try{

            $conn = new PDO('mysql: host= '. $hostname . '; dbname='. $dbname , $username , $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch(PDOException $error){

            echo 'Connection error '.$error->getMessage();

        }

        return $conn;




