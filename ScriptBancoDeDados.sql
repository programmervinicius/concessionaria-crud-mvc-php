

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- Nome do banco: concessionaria

CREATE DATABASE IF NOT EXISTS `concessionaria` DEFAULT CHARACTER SET utf8;
USE `concessionaria`;

-- --------------------------------------------------------


-- Criando a table `Fornecedor`
DROP TABLE IF EXISTS `Fornecedor`;
CREATE TABLE `Fornecedor` (
  `idFornecedor` int(10) NOT NULL,
  `nomeFornecedor` varchar(100) NOT NULL,
  `enderecoFornecedor` varchar(100) NOT NULL,
  `contatoFornecedor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Criando table `Carro`
DROP TABLE IF EXISTS `Carro`;
CREATE TABLE `Carro` (
  `idFornecedor` int(10) NOT NULL,
  `placaCarro` varchar(20) NOT NULL,
  `marcaCarro` varchar(100) NOT NULL,
  `precoCarro` float NOT NULL,
  `descCarro` text
);

-- Inserir em `Carro` alguns valores de exemplo
TRUNCATE TABLE `Carro`;
INSERT INTO `Carro` (`idFornecedor`, `placaCarro`, `marcaCarro`, `precoCarro`, `descCarro`) VALUES
(1, 'HUR-2827', 'Fusca', 8900, 'Carro extremamente popular nas decadas de 80 e 90.'),
(2, 'MWD-1231', 'Ferrari', 240000, 'Carro de luxo.');

-- --------------------------------------------------------


-- Inserir alguns valores padroes em `Fornecedor`
TRUNCATE TABLE `Fornecedor`;
INSERT INTO `Fornecedor` (`idFornecedor`, `nomeFornecedor`, `enderecoFornecedor`, `contatoFornecedor`) VALUES
(1, 'Fusca Empresa', 'Avenida Godofredo Maciel - 2640, Maraponga.', '85900000000'),
(2, 'Ferrari Empresa', 'Rua Rubens Monte - 155, Maraponga.', '85911111111');

-- PK para table `Carro`
ALTER TABLE `Carro`
  ADD PRIMARY KEY (`placaCarro`),
  ADD KEY `Carro_FKIndex1` (`idFornecedor`);

-- PK para table `Fornecedor`
ALTER TABLE `Fornecedor`
  ADD PRIMARY KEY (`idFornecedor`);

-- FK para table Carro, referenciando Fornecedor
ALTER TABLE `Carro`
  ADD CONSTRAINT `carro_fornecedor_fk` FOREIGN KEY (`idFornecedor`) REFERENCES `Fornecedor` (`idFornecedor`) ON DELETE CASCADE ON UPDATE CASCADE;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;