SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

CREATE TABLE `cliente` (
  `codCliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `dataNascimento` date NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `codEndereco` int(11) NOT NULL,
  `codLogin` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
  `cliente` (
    `codCliente`,
    `nome`,
    `sobrenome`,
    `dataNascimento`,
    `cpf`,
    `telefone`,
    `codEndereco`,
    `codLogin`
  )
VALUES
  (
    1,
    'Cliente SP',
    'Benfeitor',
    '1977-03-19',
    '27596824803',
    '12983412777',
    6,
    6
  ),
  (
    2,
    'Cliente RJ',
    'Benfeitor',
    '1968-03-27',
    '13543879343',
    '1725381596',
    7,
    7
  );

CREATE TABLE `clienteproduto` (
  `codVenda` int(11) NOT NULL,
  `codCliente` int(11) NOT NULL,
  `codProduto` int(11) NOT NULL
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4;

INSERT INTO
  `clienteproduto` (`codVenda`, `codCliente`, `codProduto`)
VALUES
  (1, 1, 2),
  (2, 1, 3),
  (3, 1, 4),
  (4, 2, 5),
  (5, 2, 6),
  (6, 2, 7);

CREATE TABLE `empresa` (
  `codEmpresa` int(11) NOT NULL,
  `razaoSocial` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `ie` varchar(12) NOT NULL,
  `codEndereco` int(11) NOT NULL,
  `codLogin` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
  `empresa` (
    `codEmpresa`,
    `razaoSocial`,
    `telefone`,
    `cnpj`,
    `ie`,
    `codEndereco`,
    `codLogin`
  )
VALUES
  (
    1,
    'Empresa SP LTDA',
    '1925858029',
    '70769004000114',
    '378880943146',
    8,
    8
  ),
  (
    2,
    'Empresa RJ LTDA',
    '11989715545',
    '33858206000106',
    '424543114443',
    9,
    9
  );

CREATE TABLE `empresaproduto` (
  `codVenda` int(11) NOT NULL,
  `codProduto` int(11) NOT NULL,
  `codEmpresa` int(11) NOT NULL
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4;

INSERT INTO
  `empresaproduto` (`codVenda`, `codProduto`, `codEmpresa`)
VALUES
  (1, 2, 1),
  (3, 4, 1),
  (4, 5, 2),
  (5, 6, 2),
  (6, 7, 2);

CREATE TABLE `endereco` (
  `codEndereco` int(11) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
  `endereco` (
    `codEndereco`,
    `cep`,
    `endereco`,
    `numero`,
    `complemento`,
    `cidade`,
    `estado`
  )
VALUES
  (
    6,
    '12070030',
    'Rua Dom André Arcoverde',
    3,
    'Bloco 2',
    'Taubaté',
    'SP'
  ),
  (
    7,
    '15700070',
    'Rua 10',
    123,
    'Novo A',
    'Jales',
    'SP'
  ),
  (
    8,
    '13092035',
    'Rua Aly César Closel',
    1596,
    'Fabrica',
    'Campinas',
    'SP'
  ),
  (
    9,
    '13253583',
    'Rua João Generoso',
    312,
    'a',
    'Itatiba',
    'SP'
  );

CREATE TABLE `login` (
  `codLogin` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `tipo` enum('cliente', 'empresa') NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
  `login` (`codLogin`, `email`, `senha`, `tipo`)
VALUES
  (
    6,
    'clienteSP@gmail.com',
    '81dc9bdb52d04dc20036dbd8313ed055',
    'cliente'
  ),
  (
    7,
    'clienteRJ@gmail.com',
    '81dc9bdb52d04dc20036dbd8313ed055',
    'cliente'
  ),
  (
    8,
    'producao@empresaSP.com',
    '81dc9bdb52d04dc20036dbd8313ed055',
    'empresa'
  ),
  (
    9,
    'producao@empresaRJ.com',
    '81dc9bdb52d04dc20036dbd8313ed055',
    'empresa'
  );

CREATE TABLE `produto` (
  `codProduto` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `imagem` varchar(100) NOT NULL DEFAULT 'em progresso',
  `funcionando` varchar(50) NOT NULL,
  `tempoUso` varchar(50) NOT NULL,
  `especificacoes` varchar(255) NOT NULL,
  `codStatus` int(11) NOT NULL,
  `cashback` decimal(8, 2) NOT NULL DEFAULT 0.00,
  `alterado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4;

INSERT INTO
  `produto` (
    `codProduto`,
    `tipo`,
    `modelo`,
    `imagem`,
    `funcionando`,
    `tempoUso`,
    `especificacoes`,
    `codStatus`,
    `cashback`,
    `alterado`
  )
VALUES
  (
    2,
    'Celular',
    'Galaxy J1',
    'em progresso',
    'Não',
    '2 anos e meio',
    '',
    1,
    '0.00',
    '2022-05-29 02:04:12'
  ),
  (
    3,
    'Transformador',
    'Não identificado',
    'em progresso',
    'Sim',
    '3 anos',
    'Deixei de precisar após a mudança',
    2,
    '0.00',
    '2022-05-29 21:40:22'
  ),
  (
    4,
    'Roteador',
    'Huawei 9300h',
    'em progresso',
    'Sim',
    '3 anos',
    'Comprei um melhor',
    3,
    '0.00',
    '2022-05-29 21:43:25'
  ),
  (
    5,
    'Telefone sem fio',
    'Intelbras',
    'em progresso',
    'Não',
    '5 meses',
    'Parou de dar linha.',
    4,
    '0.00',
    '2022-05-29 21:44:13'
  ),
  (
    6,
    'Teclado',
    'Multilaser',
    'em progresso',
    'Não',
    '1 ano',
    'Depois de um rage jogando, algumas teclas foram perdidas',
    4,
    '0.00',
    '2022-05-29 21:45:21'
  ),
  (
    7,
    'Celular',
    'Moto G 3ªgen',
    'em progresso',
    'Sim',
    '7',
    'Tela rachada, mal contato no carregamento',
    5,
    '126.00',
    '2022-05-29 21:46:14'
  );

CREATE TABLE `produtostatus` (
  `codStatus` int(11) NOT NULL,
  `nomeStatus` varchar(50) NOT NULL
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4;

INSERT INTO
  `produtostatus` (`codStatus`, `nomeStatus`)
VALUES
  (1, 'Envio pendente'),
  (2, 'Aguardando recebimento'),
  (3, 'Recebido'),
  (4, 'Em avaliação'),
  (5, 'Cashback enviado');

ALTER TABLE
  `cliente`
ADD
  PRIMARY KEY (`codCliente`),
ADD
  KEY `FK_endereco_cliente` (`codEndereco`),
ADD
  KEY `FK_login_cliente` (`codLogin`);

ALTER TABLE
  `clienteproduto`
ADD
  PRIMARY KEY (`codVenda`);

ALTER TABLE
  `empresa`
ADD
  PRIMARY KEY (`codEmpresa`),
ADD
  KEY `FK_endereco_empresa` (`codEndereco`),
ADD
  KEY `FK_login_empresa` (`codLogin`);

ALTER TABLE
  `empresaproduto`
ADD
  PRIMARY KEY (`codVenda`);

ALTER TABLE
  `endereco`
ADD
  PRIMARY KEY (`codEndereco`);

ALTER TABLE
  `login`
ADD
  PRIMARY KEY (`codLogin`),
ADD
  KEY `email_fk` (`email`);

ALTER TABLE
  `produto`
ADD
  PRIMARY KEY (`codProduto`),
ADD
  KEY `cod_status_fk` (`codStatus`);

ALTER TABLE
  `produtostatus`
ADD
  PRIMARY KEY (`codStatus`);

ALTER TABLE
  `cliente`
MODIFY
  `codCliente` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;

ALTER TABLE
  `clienteproduto`
MODIFY
  `codVenda` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 7;

ALTER TABLE
  `empresa`
MODIFY
  `codEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;

ALTER TABLE
  `empresaproduto`
MODIFY
  `codVenda` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 7;

ALTER TABLE
  `endereco`
MODIFY
  `codEndereco` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 11;

ALTER TABLE
  `login`
MODIFY
  `codLogin` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 11;

ALTER TABLE
  `produto`
MODIFY
  `codProduto` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 10;

ALTER TABLE
  `produtostatus`
MODIFY
  `codStatus` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 6;

ALTER TABLE
  `cliente`
ADD
  CONSTRAINT `FK_endereco_cliente` FOREIGN KEY (`codEndereco`) REFERENCES `endereco` (`codEndereco`),
ADD
  CONSTRAINT `FK_login_cliente` FOREIGN KEY (`codLogin`) REFERENCES `login` (`codLogin`);

ALTER TABLE
  `empresa`
ADD
  CONSTRAINT `FK_endereco_empresa` FOREIGN KEY (`codEndereco`) REFERENCES `endereco` (`codEndereco`),
ADD
  CONSTRAINT `FK_login_empresa` FOREIGN KEY (`codLogin`) REFERENCES `login` (`codLogin`);

COMMIT;