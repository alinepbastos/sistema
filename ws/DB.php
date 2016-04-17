<?php

class DB
{
    public static function query($sql)
    {
        try
        {
            $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD, 
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch ( PDOException $e )
        {
            echo 'Estamos passando por alguns problemas. Logo resolveremos.';
            exit;
        }  
        
        try
        {
            $result = $db->query($sql);
            
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) 
        {
            echo 'Estamos passando por alguns problemas. Logo resolveremos.';
            exit;
        }
            
    }
}