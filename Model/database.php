<?php
class Database
{
    // Essa classe contem a funcao de conexao com o banco de dados..
    public static function Conectar()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=concessionaria;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }   
}