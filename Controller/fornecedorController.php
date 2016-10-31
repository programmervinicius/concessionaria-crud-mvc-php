<?php

require_once 'model/fornecedor.php';

class FornecedorController{

    // Criando uma variavel auxiliar
    private $modelo;

    // Metodo construtor, atribuindo um fornecedor a variavel modelo
    public function __CONSTRUCT(){
        $this->modelo = new fornecedor();
    }

    // Chama a view principal
    public function Index(){
        require_once 'view/header.phtml';
        require_once 'view/fornecedor/fornecedor.phtml';
        require_once 'view/footer.phtml';
    }

    // Metodo para criar um objeto fornecedor
    public function NewFornecedor(){
        $fornecedor = new fornecedor();
        // Chamando as dependencias
        require_once 'view/header.phtml';
        require_once 'view/fornecedor/create-fornecedor.phtml';
        require_once 'view/footer.phtml';
    }

    // Metodo create para registrar um Fornecedor no Banco de dados.
    public function Create(){
        $fornecedor = new fornecedor();
        // Adicionando os atributos do formulario ao objeto fornecedor
        $fornecedor->idFornecedor = $_REQUEST['idFornecedor'];
        $fornecedor->nomeFornecedor = $_REQUEST['nomeFornecedor'];
        $fornecedor->enderecoFornecedor = $_REQUEST['enderecoFornecedor'];
        $fornecedor->contatoFornecedor = $_REQUEST['contatoFornecedor'];
        // Chamando o metodo Registrar em model/fornecedor.php para inserir no banco
        $this->modelo->Registrar($fornecedor);
        // Redirecionando para index.php
        header('Location: index.php?c=fornecedor');
    }

    // Metodo select para listar um Fornecedor do Banco de dados.
    public function Select(){
        // Criando um objeto fornecedor
        $fornecedor = new fornecedor();
        // Verificando se o parametro passado foi o atributo idFornecedor
        if(isset($_REQUEST['idFornecedor'])){
            // Chamando o metodo ListarFornecedor, passando como parametro o idFornecedor
            $fornecedor = $this->modelo->ListarFornecedor($_REQUEST['idFornecedor']);
        }
        // Gerenciando dependencias
        require_once 'view/header.phtml';
        require_once 'view/fornecedor/update-fornecedor.phtml';
        require_once 'view/footer.phtml';
    }

    // Metodo update para atualizar um Fornecedor no Banco de dados.
    public function Update(){
        // Criando um objeto Carro e resgatando os valores do formulario
        $fornecedor = new fornecedor();
        // Adicionando os atributos ao objeto
        $fornecedor->idFornecedor = $_REQUEST['idFornecedor'];
        $fornecedor->nomeFornecedor = $_REQUEST['nomeFornecedor'];
        $fornecedor->enderecoFornecedor = $_REQUEST['enderecoFornecedor'];
        $fornecedor->contatoFornecedor = $_REQUEST['contatoFornecedor'];
        // Chamando o metodo Atualizar em model/fornecedor.php para atualizar no banco

        $this->modelo->Atualizar($fornecedor);
        // Redirecionando para index.php
        header('Location: index.php');
    }
    // Metodo delete para remover um Fornecedor no Banco de dados.
    public function Delete(){
        $this->modelo->Deletar($_REQUEST['idFornecedor']);
        // Redirecionando para a home
        header('Location: index.php');
    }
}