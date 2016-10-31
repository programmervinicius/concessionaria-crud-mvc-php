<?php
class carro
{
	// Atributos do objeto Carro
	private $pdo;
    public $idFornecedor;
    public $placaCarro;
    public $nomeCarro;
    public $precoCarro;
    public $descCarro;
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

	// Metodo Registrar, para inserir Carros ao banco de dados.
	public function Registrar(carro $carro)
	{
		// Tenta inserir o carro passado por parametro
		try
		{
			// Comando SQL para inserir um carro no Banco
			$sql = "INSERT INTO Carro (idFornecedor,placaCarro,marcaCarro,precoCarro,descCarro) VALUES (?, ?, ?, ?,?)";
			// Chamando o metodo para executar o comando SQL
			$this->pdo->prepare($sql)->execute(
					array(
                    	$carro->idFornecedor,
                    	$carro->placaCarro,
                    	$carro->marcaCarro,
                    	$carro->precoCarro,
                    	$carro->descCarro
                	)
				);
		// Se nao conseguir inserir, envia uma exception
		} catch (Exception $e)
		{
			// Exibe uma mensagem de Error
			die($e->getMessage());
		}
	}

	// Metodo ListarCarros, para listar todos os Carros do banco de dados.
	public function ListarCarros()
	{
		// Tenta listar os Carros
		try
		{
			$result = array();
			// Guardando o comando SQL para listar todos os Carros na variavel stm
			$stm = $this->pdo->prepare("SELECT * FROM Carro");
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

	// Metodo ListarCarro, para listar apenas 1 Carro (passado por parametro) do banco de dados.
	public function ListarCarro($placaCarro)
	{
		// Tenta listar o Carro cujo a placa seja igual a passada por parametro
		try
		{
			// Guardando o comando SQL para listar apenas um Carro na variavel stm
			$stm = $this->pdo->prepare("SELECT * FROM Carro WHERE placaCarro = ?");
			// Metodo para executar o comando SQL
			$stm->execute(array($placaCarro));
			// Devolvendo uma array com todas as rows do resultado
			return $stm->fetch(PDO::FETCH_OBJ);
		// Se nao conseguir listar, envia uma exception
		} catch (Exception $e)
		{
			// Exibe uma mensagem de Error
			die($e->getMessage());
		}
	}

	// Metodo Atualizar, para atualizar um Carro (passado por parametro) no banco de dados.
	public function Atualizar($carro)
	{
		// Tenta atualizar o Carro passado por parametro
		try
		{
			// Guardando o comando SQL para atualizar o Carro na variavel sql
			$sql = "UPDATE Carro SET idFornecedor = ?, marcaCarro = ?, precoCarro = ?, descCarro = ? WHERE placaCarro = ?";
			// Metodo para executar o comando SQL
			$this->pdo->prepare($sql)->execute(
				    array(
				    	$carro->idFornecedor,
                        $carro->marcaCarro,
                        $carro->precoCarro,
                        $carro->descCarro,
                        $carro->placaCarro
					)
				);
		// Se nao conseguir atualizar, envia uma exception
		} catch (Exception $e)
		{
			// Exibe uma mensagem de Error
			die($e->getMessage());
		}
	}

	// Metodo Deletar, para deletar um Carro (passado por parametro) do banco de dados.
	public function Deletar($placaCarro)
	{
		// Tenta deletar o Carro cujo a placa seja igual a passada por parametro
		try
		{
			// Guardando o comando SQL para atualizar o Carro na variavel stm
			$stm = $this->pdo->prepare("DELETE FROM Carro WHERE placaCarro = ?");
			// Metodo para executar o comando SQL
			$stm->execute(array($placaCarro));
		// Se nao conseguir atualizar, envia uma exception
		} catch (Exception $e)
		{
			// Exibe uma mensagem de Error
			die($e->getMessage());
		}
	}
}