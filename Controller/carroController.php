<?php

require_once 'model/carro.php';

class CarroController{

    // Criando uma variavel auxiliar
    private $modelo;

    // Metodo construtor
    public function __CONSTRUCT(){
        $this->modelo = new carro();
    }

    // Chama a view principal
    public function Index(){
        require_once 'view/header.phtml';
        require_once 'view/carro/carro.phtml';
        require_once 'view/footer.phtml';
    }

    // Metodo para criar um objeto carro
    public function NewCarro(){ 
        $carro = new carro();
        // Chamando as dependencias
        require_once 'view/header.phtml';
        require_once 'view/carro/create-carro.phtml';
        require_once 'view/footer.phtml';
    }

    // Metodo create para registrar um Carro no Banco de dados.
    public function Create(){
        $carro = new carro();
        // Adicionando os atributos do formulario ao objeto carro
        $carro->idFornecedor = $_REQUEST['idFornecedor'];
        $carro->placaCarro = $_REQUEST['placaCarro'];
        $carro->marcaCarro = $_REQUEST['marcaCarro'];
        $carro->precoCarro = $_REQUEST['precoCarro'];
        $carro->descCarro = $_REQUEST['descCarro'];
        // Chamando o metodo Registrar em model/carro.php para inserir no banco
        $this->modelo->Registrar($carro);
        // Redirecionando para index.php?c=carro
        header('Location: index.php?c=carro');
    }

    // Metodo select para listar um Carro do Banco de dados.
    public function Select(){
        // Criando um objeto Carro
        $carro = new carro();
        // Verificando se o parametro passado foi o atributo placaCarro
        if(isset($_REQUEST['placaCarro'])){
        // Chamando o metodo ListarCarro, passando como parametro placaCarro
            $carro = $this->modelo->ListarCarro($_REQUEST['placaCarro']);
        }
        // Gerenciando dependencias
        require_once 'view/header.phtml';
        require_once 'view/carro/update-carro.phtml';
        require_once 'view/footer.phtml';
    }

    // Metodo update para atualizar um Carro no Banco de dados.
    public function Update(){
        // Criando um objeto Carro
        $carro = new carro();
        // Adicionando os atributos ao objeto
        $carro->idFornecedor = $_REQUEST['idFornecedor'];
        $carro->placaCarro = $_REQUEST['placaCarro'];
        $carro->marcaCarro = $_REQUEST['marcaCarro'];
        $carro->precoCarro = $_REQUEST['precoCarro'];
        $carro->descCarro = $_REQUEST['descCarro'];
        
        // Chamando o metodo Atualizar em model/carro.php para atualizar no banco
        $this->modelo->Atualizar($carro);
        // Redirecionando para index.php?c=carro
        header('Location: index.php?c=carro');
    }

    // Metodo delete para remover um Carro no Banco de dados.
    public function Delete(){
        // Chamando o metodo Deletar em model/carro.php para deletar no banco
        $this->modelo->Deletar($_REQUEST['placaCarro']);
        // Redirecionando para a home
        header('Location: index.php');
    }
}