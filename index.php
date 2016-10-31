<?php
  // Configuracao do Banco de dados
  require_once 'model/database.php';

  $controller = 'carro';
  // Logica para o FrontController
  if(!isset($_REQUEST['c']))
  {
    // Chamando a home
    require_once "controller/{$controller}Controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    $controller->Index();
  }
  else
  {
    // Carrega o Controller
    $controller = strtolower($_REQUEST['c']);
    $action = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    // Instancia o Controller
    require_once "controller/{$controller}Controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    // Chama a Action
    call_user_func( array( $controller, $action ) );
  }