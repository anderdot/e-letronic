
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `cliente` (
  `codCliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `dataNascimento` date NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `codEndereco` int(11) NOT NULL,
  `codLogin` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


CREATE TABLE `clienteproduto` (
  `codVenda` int(11) NOT NULL,
  `codCliente` int(11) NOT NULL,
  `codProduto` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `empresa` (
  `codEmpresa` int(11) NOT NULL,
  `razaoSocial` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `ie` varchar(12) NOT NULL,
  `codEndereco` int(11) NOT NULL,
  `codLogin` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


CREATE TABLE `empresaproduto` (
  `codVenda` int(11) NOT NULL,
  `codProduto` int(11) NOT NULL,
  `codEmpresa` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `endereco` (
  `codEndereco` int(11) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


CREATE TABLE `login` (
  `codLogin` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `tipo` enum('cliente','empresa') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `produto` (
  `codProduto` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `imagem` varchar(100) NOT NULL DEFAULT 'em progresso',
  `funcionando` varchar(50) NOT NULL,
  `tempoUso` varchar(50) NOT NULL,
  `especificacoes` varchar(255) NOT NULL,
  `local` varchar(50) NOT NULL,
  `codStatus` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `produtostatus` (
  `codStatus` int(11) NOT NULL,
  `nomeStatus` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codCliente`),
  ADD KEY `FK_endereco_cliente` (`codEndereco`),
  ADD KEY `FK_login_cliente` (`codLogin`);


ALTER TABLE `clienteproduto`
  ADD PRIMARY KEY (`codVenda`);


ALTER TABLE `empresa`
  ADD PRIMARY KEY (`codEmpresa`),
  ADD KEY `FK_endereco_empresa` (`codEndereco`),
  ADD KEY `FK_login_empresa` (`codLogin`);


ALTER TABLE `empresaproduto`
  ADD PRIMARY KEY (`codVenda`);


ALTER TABLE `endereco`
  ADD PRIMARY KEY (`codEndereco`);


ALTER TABLE `login`
  ADD PRIMARY KEY (`codLogin`),
  ADD KEY `email_fk` (`email`);


ALTER TABLE `produto`
  ADD PRIMARY KEY (`codProduto`),
  ADD KEY `cod_status_fk` (`codStatus`);


ALTER TABLE `produtostatus`
  ADD PRIMARY KEY (`codStatus`);


ALTER TABLE `cliente`
  MODIFY `codCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `clienteproduto`
  MODIFY `codVenda` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `empresa`
  MODIFY `codEmpresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `empresaproduto`
  MODIFY `codVenda` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `endereco`
  MODIFY `codEndereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `login`
  MODIFY `codLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `produto`
  MODIFY `codProduto` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `produtostatus`
  MODIFY `codStatus` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `cliente`
  ADD CONSTRAINT `FK_endereco_cliente` FOREIGN KEY (`codEndereco`) REFERENCES `endereco` (`codEndereco`),
  ADD CONSTRAINT `FK_login_cliente` FOREIGN KEY (`codLogin`) REFERENCES `login` (`codLogin`);

ALTER TABLE `empresa`
  ADD CONSTRAINT `FK_endereco_empresa` FOREIGN KEY (`codEndereco`) REFERENCES `endereco` (`codEndereco`),
  ADD CONSTRAINT `FK_login_empresa` FOREIGN KEY (`codLogin`) REFERENCES `login` (`codLogin`);
COMMIT;
