<?php
class fornecedor
{
	// Atributos do objeto Fornecedor
	private $pdo;
    public $idFornecedor;
    public $nomeFornecedor;
    public $enderecoFornecedor;
    public $contatoFornecedor;
	// Construtor, criando a conexao com o banco

	public function __CONSTRUCT()
	{
		// Tenta conectar no Banco de Dados
		try
		{
			$this->pdo = Database::Conectar();
		}
		// Caso contrario, chama uma excecao
		catch(Exception $e)
		{
			// Exibe uma mensagem de Error
			die($e->getMessage());
		}
	}
	
	// Metodo Registrar, para inserir Fornecedor ao banco de dados.
	public function Registrar(fornecedor $fornecedor)
	{
		try
		{
			// Comando SQL para inserir um carro no Banco
			$sql = "INSERT INTO Fornecedor (idFornecedor,nomeFornecedor,enderecoFornecedor,contatoFornecedor) VALUES (?, ?, ?, ?)";
			// Chamando o metodo para executar o comando SQL
			$this->pdo->prepare($sql)->execute(
				array(
                    $fornecedor->idFornecedor,
                    $fornecedor->nomeFornecedor,
                    $fornecedor->enderecoFornecedor,
                    $fornecedor->contatoFornecedor,
                )
			);
		// Se nao conseguir inserir, envia uma exception
		} catch (Exception $e)
		{
			// Exibe uma mensagem de Error
			die($e->getMessage());
		}
	}

	// Metodo ListarFornecedores, para listar todos os Fornecedores do banco de dados.
	public function ListarFornecedores()
	{
		// Tenta listar os Fornecedores
		try
		{
			$result = array();
			// Guardando o comando SQL para listar todos os Fornecedores na variavel stm
			$stm = $this->pdo->prepare("SELECT * FROM Fornecedor");
			// Metodo para executar o comando SQL
			$stm->execute();
			// Devolvendo uma array com todas as rows do resultado
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		// Se nao conseguir listar, envia uma exception
		catch(Exception $e)
		{
			// Exibe uma mensagem de Error
			die($e->getMessage());
		}
	}
	// Metodo ListarCarro, para listar apenas 1 Fornecedor (passado por parametro) do banco de dados.
	public function ListarFornecedor($idFornecedor)
	{
		// Tenta listar os Fornecedores
		try
		{
			// Guardando o comando SQL para listar apenas um Fornecedor na variavel stm
			$stm = $this->pdo->prepare("SELECT * FROM Fornecedor WHERE idFornecedor = ?");
			// Metodo para executar o comando SQL
			$stm->execute(array($idFornecedor));
			// Devolvendo uma array com todas as rows do resultado
			return $stm->fetch(PDO::FETCH_OBJ);
		// Se nao conseguir listar, envia uma exception
		} catch (Exception $e)
		{
			// Exibe uma mensagem de Error
			die($e->getMessage());
		}
	}

	// Metodo Atualizar, para atualizar um Fornecedor (passado por parametro) no banco de dados.
	public function Atualizar($fornecedor)
	{
		// Tenta atualizar o Fornecedor passado por parametro
		try
		{
			// Guardando o comando SQL para atualizar o Fornecedor na variavel sql
			$sql = "UPDATE Fornecedor SET nomeFornecedor = ?, enderecoFornecedor = ?, contatoFornecedor = ? WHERE idFornecedor = ?";
			// Metodo para executar o comando SQL
			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $fornecedor->nomeFornecedor,
                        $fornecedor->enderecoFornecedor,
                        $fornecedor->contatoFornecedor,
                        $fornecedor->idFornecedor
					)
				);
		// Se nao conseguir atualizar, envia uma exception
		} catch (Exception $e)
		{
			// Exibe uma mensagem de Error
			die($e->getMessage());
		}
	}
	
	// Metodo Deletar, para deletar um Fornecedor (passado por parametro) do banco de dados.
	public function Deletar($idFornecedor)
	{
		// Tenta deletar o Fornecedor cujo a placa seja igual a passada por parametro
		try
		{
			// Guardando o comando SQL para atualizar o Fornecedor na variavel stm
			$stm = $this->pdo->prepare("DELETE FROM Fornecedor WHERE idFornecedor = ?");
			// Metodo para executar o comando SQL
			$stm->execute(array($idFornecedor));
		// Se nao conseguir atualizar, envia uma exception
		} catch (Exception $e)
		{
			// Exibe uma mensagem de Error
			die($e->getMessage());
		}
	}
}