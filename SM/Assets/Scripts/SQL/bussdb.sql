-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: bussdb
-- ------------------------------------------------------
-- Server version	5.6.23-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP DATABASE IF EXISTS `bussdb`;

CREATE DATABASE `bussdb`;

USE `bussdb`;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `nome` varchar(200) NOT NULL,
  PRIMARY KEY (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES ('Event'),('Film'),('Game'),('MusicGenre'),('Recreation'),('Science'),('Sports');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linha`
--

DROP TABLE IF EXISTS `linha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `linha` (
  `id` varchar(300) NOT NULL,
  `horarioIda` bigint(20) NOT NULL,
  `horarioVolta` bigint(20) NOT NULL,
  `diaDaSemana` varchar(100) NOT NULL,
  `origem` text NOT NULL,
  `destino` text NOT NULL,
  PRIMARY KEY (`id`,`horarioIda`,`horarioVolta`,`diaDaSemana`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linha`
--

LOCK TABLES `linha` WRITE;
/*!40000 ALTER TABLE `linha` DISABLE KEYS */;
INSERT INTO `linha` VALUES ('02',21600,24300,'WorkingDays','UFSCar ÁREA SUL','VILA PRADO'),('02',22500,24300,'WorkingDays','UFSCar ÁREA SUL','VILA PRADO'),('02',24300,26100,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO'),('02',26100,27900,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO  '),('02',29700,31500,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO'),('02',33300,35100,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO'),('02',36900,38700,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO'),('02',40500,42300,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO'),('02',44100,45900,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO'),('02',47700,49500,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO'),('02',51300,53100,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO'),('02',54900,56700,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO'),('02',58500,60300,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO'),('02',62100,63900,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO'),('02',65700,67500,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO'),('02',69300,71100,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO'),('02',72900,74700,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO'),('02',76500,78300,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO'),('02',80100,81900,'WorkingDays','UFSCar ÁREA NORTE','VILA PRADO'),('02',83700,22500,'WorkingDays','JÓQUEI CLUBE VIA UFSCar Á. NORTE','VILA PRADO'),('15',24600,26400,'WorkingDays','UFSCar ÁREA SUL','ESCOLA JOÃO PAULO II'),('15',28200,30000,'WorkingDays','UFSCar ÁREA SUL','ESCOLA JOÃO PAULO II'),('15',31800,33600,'WorkingDays','UFSCar ÁREA SUL','ESCOLA JOÃO PAULO II'),('15',35400,37200,'WorkingDays','UFSCar ÁREA SUL','ESCOLA JOÃO PAULO II'),('15',39000,40800,'WorkingDays','UFSCar ÁREA SUL','ESCOLA JOÃO PAULO II'),('15',42600,44400,'WorkingDays','UFSCar ÁREA SUL','ESCOLA JOÃO PAULO II'),('15',46200,48000,'WorkingDays','UFSCar ÁREA SUL','ESCOLA JOÃO PAULO II'),('15',49800,51600,'WorkingDays','UFSCar ÁREA SUL','ESCOLA JOÃO PAULO II'),('15',53400,55200,'WorkingDays','UFSCar ÁREA SUL','ESCOLA JOÃO PAULO II'),('15',57000,58800,'WorkingDays','UFSCar ÁREA SUL','ESCOLA JOÃO PAULO II'),('15',60600,62400,'WorkingDays','UFSCar ÁREA SUL','ESCOLA JOÃO PAULO II'),('15',64200,66000,'WorkingDays','UFSCar ÁREA SUL','ESCOLA JOÃO PAULO II'),('15',67800,69600,'WorkingDays','UFSCar ÁREA SUL','ESCOLA JOÃO PAULO II'),('19',24900,26700,'Saturday','UFSCar Á. NORTE VIA REDENÇÃO AEROP.','REDENÇÃO'),('19',24900,26700,'WorkingDays','UFSCar Á. NORTE VIA REDENÇÃO AEROP.','REDENÇÃO'),('19',28500,30300,'Saturday','UFSCar ÁREA NORTE','REDENÇÃO'),('19',28500,30300,'WorkingDays','UFSCar ÁREA NORTE','REDENÇÃO'),('19',32100,33900,'Saturday','UFSCar ÁREA NORTE','REDENÇÃO'),('19',35700,37500,'Saturday','UFSCar ÁREA NORTE','REDENÇÃO'),('19',39300,41100,'Saturday','UFSCar ÁREA NORTE','REDENÇÃO'),('19',42900,44700,'Saturday','UFSCar ÁREA NORTE','REDENÇÃO'),('19',46500,48300,'Saturday','UFSCar ÁREA NORTE','REDENÇÃO'),('19',50100,51900,'Saturday','UFSCar ÁREA NORTE','REDENÇÃO'),('19',71700,73500,'WorkingDays','UFSCar ÁREA SUL','REDENÇÃO'),('19',75300,77100,'WorkingDays','UFSCar ÁREA SUL','REDENÇÃO'),('19',78900,80700,'WorkingDays','UFSCar ÁREA NORTE','REDENÇÃO'),('19',82500,24900,'WorkingDays','UFSCar ÁREA NORTE','REDENÇÃO');
/*!40000 ALTER TABLE `linha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticia`
--

DROP TABLE IF EXISTS `noticia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticia` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(300) NOT NULL,
  `dataDaPostagem` varchar(10) NOT NULL,
  `horaDaPostagem` varchar(8) NOT NULL,
  `categoria` varchar(200) NOT NULL,
  `emailDoAutor` varchar(200) NOT NULL,
  `texto` text NOT NULL,
  `ilustracao` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria` (`categoria`),
  KEY `emailDoAutor` (`emailDoAutor`),
  CONSTRAINT `noticia_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`nome`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `noticia_ibfk_2` FOREIGN KEY (`emailDoAutor`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticia`
--

LOCK TABLES `noticia` WRITE;
/*!40000 ALTER TABLE `noticia` DISABLE KEYS */;
INSERT INTO `noticia` VALUES (5,'Agosto fecha com a maior temperatura registrada no ano','16/09/2016','17:14:54','Event','marcelo8g@gmail.com','teste','A0002.jpg'),(6,'Banda larga no Brasil melhora a qualidade de serviços','16/09/2016','17:15:59','Science','marcelo8g@gmail.com','teste','A0001.jpg'),(7,'Filmes de estudantes da UFSCar são escolhidos para mostra internacional','16/09/2016','20:01:34','Film','marcelo8g@gmail.com','Dois curtas produzidos por estudantes da Universidade Federal de São Carlos (UFSCar) foram selecionados para o 27º Festival Internacional de Curtas de São Paulo e serão exibidos no evento a partir desta quinta-feira (25). Confira a programação completa.\r\n\r\nGravados em 2015, \"Modorra\" e \"Salomé\" foram idealizados como trabalhos de conclusão de curso de alunos de Imagem e Som e foram possíveis através de campanhas de arrecadação de recursos. Os dois mesclam atores amadores e profissionais e poderão ser conferidos em espaços como o Centro Cultural São Paulo e o Museu da Imagem e do Som.\r\n','A004.jpg'),(8,'Fazenda se transforma em centro de pesquisas após parceria com UFSCar','16/09/2016','20:08:05','Event','marcelo8g@gmail.com','Uma parceria realizada entre o campus da Universidade Federal de São Carlos (UFSCar) de Buri e o proprietário de uma fazenda do município fez com que a área rural se transformasse em um centro de pesquisas e extensão para a instituição. A propriedade, localizada no bairro Capuavinha e que possui uma área de Mata Atlântica, vai servir como um espaço para pesquisas e receber estudantes de escolas da cidade, além de agircultores. A parceria foi denominada \"Associação Buriti\" e começou nesta quinta-feira (18).','A0005.png'),(9,'Edital apoiará pesquisas em infraestrutura para a Amazônia Legal','16/09/2016','20:32:51','Science','marcelo8g@gmail.com','Está aberta a  chamada pública de apoio à infraestrutura de projetos de pesquisa de Instituições Científicas e Tecnológicas (ICTs) da Amazônia Legal. Serão até R$ 20 milhões em recursos não reembolsáveis provenientes do Fundo Nacional de Desenvolvimento Científico e Tecnológico – FNDCT/Ação Transversal. O edital foi lançado pela Financiadora de Estudos e Projetos (Finep) nesta terça -feira (13).\r\n\r\nO Formulário de Apresentação de Projetos (FAP) eletrônico poderá ser enviado até o dia 10 de outubro. O edital visa melhorar a infraestrutura laboratorial e de equipamentos das instituições de pesquisa; fortalecer a capacidade de P&D das ICTs; capacitar pesquisadores de alto nível; e estimular a cooperação entre grupos de pesquisa da Amazônia Legal. \r\n\r\nA chamada dará prioridade aos seguintes temas:\r\nMelhoria da infraestrutura laboratorial básica em todas as áreas do conhecimento, permitindo apoio a projetos de natureza variada, sobretudo em áreas que permitam a preservação ambiental, o melhor conhecimento do bioma amazônico, o aproveitamento da biodiversidade, o monitoramento e controle do desmatamento e degradação florestal;\r\n\r\n \r\nEstabelecimento e manutenção de acervos de natureza histórica, geográfica e cultural; infraestrutura para promoção do uso sustentável dos biomas existentes na região;\r\n\r\n \r\nTecnologias inovadoras em sistemas de monitoramento para controle do desmatamento e degradação florestal; agregação de valor à produção local (alimentos, moveleira e do pescado); entre outros.\r\n \r\n\r\nPoderão concorrer instituições públicas e privadas sem fins lucrativos, incluindo organizações sociais, localizadas na região de abrangência da Amazônia Legal (Estados do Acre, Amapá, Amazonas, Mato Grosso, Pará, Rondônia, Roraima, Tocantins e a parte do Estado do Maranhão).  \r\n','A006.jpg'),(10,'Primeiro ônibus elétrico movido a energia solar entrará em operação em SC','16/09/2016','20:41:18','Science','marcelo8g@gmail.com','O primeiro ônibus elétrico movido a energia solar do Brasil vai entrar em operação daqui a três meses no campus da Universidade Federal de Santa Catarina (UFSC), em Florianópolis.\r\n\r\nCom apoio do Ministério da Ciência, Tecnologia, Inovações e Comunicações (MCTIC), o veículo fará o percurso de 50km entre o campus e o Centro de Pesquisa e Capacitação em Energia Solar Fotovoltaica, no Sapiens Parque, e reduzirá em um terço o tempo gasto para o deslocamento. O investimento  na tecnologia foi de R$ 1 milhão.\r\n\r\nInovação\r\n\r\nO ônibus fará o trajeto quatro vezes ao dia, com zero emissão de poluentes. Considerado puro, o veículo possui apenas tração elétrica. A eletricidade para o seu deslocamento é gerada por fonte limpa, renovável e silenciosa, conhecida por fotovoltaica.\r\n\r\nO professor do Grupo de Pesquisa Estratégica em Energia Solar da UFSC, Ricardo Ruther, destaca que quando o ônibus estiver parado no trânsito não haverá consumo de energia, como acontece com os veículos com motores à combustão. Já a tecnologia de frenagem regenerativa gera energia por meio das rodas, que é enviada para as baterias e reaproveitada.\r\n\r\n\"Contar com o apoio do MCTIC foi fundamental, pois os recursos do projeto foram integralmente financiados pelo ministério. Tivemos a doação das baterias e da estação de recarga da empresa japonesa Mitsubishi Heavy Industries, que também foi fundamental para viabilizar o projeto\", disse Ruther.\r\n\r\nEstrutura de pesquisa\r\n\r\nSegundo o professor, o MCTIC também financiou a implantação do laboratório do centro de pesquisa onde foi desenvolvida a nova tecnologia. Somente no laboratório, o governo federal investiu R$ 3,6 milhões.\r\n\r\n\"Em nosso laboratório, temos cerca de 100 Quilowatts (kW) de geração solar, dos quais somente 60 kW são necessários para atender a todo o consumo de eletricidade do laboratório, que são cerca de 700 m². Os outros 40 kW, injetamos hoje na rede elétrica para ser utilizado em nosso campus central da UFSC\", explicou o professor.\r\n\r\nO projeto do ônibus elétrico movido a energia solar se insere em um conjunto de ações do Programa Tecnologias para Cidades Sustentáveis da Secis, que tem o objetivo de fortalecer o domínio das tecnologias relacionadas à energia fotovoltaica no País e, com isso, ampliar sua utilização como alternativa aos combustíveis fósseis.\r\n','A0007.jpg'),(11,'Satélite que ampliará banda larga no País passa por fase final de testes','16/09/2016','20:42:57','Event','marcelo8g@gmail.com','O Satélite Geoestacionário de Defesa e Comunicações Estratégicas (SGDC) entrou em fase final de testes. Construído na França, o equipamento garantirá a comunicação segura ao governo e levará banda larga para todo o País. A previsão é que o satélite seja lançado em órbita no primeiro trimestre do ano que vem.\r\n\r\nCom investimentos de cerca de R$ 1,7 bilhão, o SGDC cobrirá todo o território nacional com uma banda larga de altíssima qualidade, com uma capacidade 60 vezes maior que a dos satélites atuais. Operado pela Telebrás, deve entregar entre 58 e 59 gigabytes por segundo. As condições dos equipamentos atuais levam o morador de localidades mais isoladas a pagar 10 a 15 vezes mais em comparação a grandes cidades.\r\n\r\n“Esse é o primeiro satélite que vai conseguir levar uma cobertura de alta capacidade para todos os cantos do País”, afirmou Artur Coimbra, diretor de Banda Larga do Ministério da Ciência, Tecnologia, Inovação e Comunicações.\r\n\r\nAlém de melhorar a cobertura da internet, o SGDC dará maior autonomia e segurança às comunicações das Forças Armadas. Hoje, a comunicação de operações militares é feita em equipamentos controlados por empresas estrangeiras. Outro benefício é o ganho de capacidade e qualidade na comunicação.\r\n\r\n“Esse satélite vai oferecer à Defesa um feixe de comunicação também móvel. Esse feixe permite uma cobertura dinâmica, contínua, para operações específicas em determinadas áreas do globo. Por exemplo, se a gente tem uma operação no sul do Oceano Atlântico, a gente consegue levar essa cobertura até lá”, disse Coimbra.\r\n','A0008.jpg'),(14,'Contra visão machista, grupo da UFSCar propõe vilã em filme de terror','12/10/2016','18:25:07','Film','marcelo8g@gmail.com','Um grupo de estudantes do curso de Imagem e Som da Universidade Federal de São Carlos (UFSCar) decidiu produzir um curta-metragem que foge dos clichês envolvendo a representação feminina nos filmes de terror.','ufscarfilmeterror12-10-2016.jpg'),(15,'Dica do especialista: calistenia, use o peso do corpo como um aliado','12/10/2016','18:31:29','Sports','marcelo8g@gmail.com','Apesar de ser pouco conhecida no Brasil, a calistenia começou a cair no gosto dos corredores como uma forma de fazer exercícios com o peso do próprio corpo. A técnica é uma modalidade de malhação que usa apenas a resistência natural do corpo por meio de exercícios como abdominais e flexões.\r\n\r\nBaseados na yoga e na ginástica olímpica como forma de promover a saúde e aptidão física, os exercícios da calistenia podem ser executados em parques, praias, locais abertos e até mesmo em casa.\r\n\r\nPor ser uma proposta desafiadora e uma maneira de realizar atividade física livre, ou seja, sem auxilio dos aparelhos guiados, a calistenia pode fazer parte da sua rotina diária de treinamentos por aumentar a sua resistência e desempenho físico.\r\n\r\nBenefícios\r\n Ajuda a aumentar a resistência corporal dos corredores, pois utiliza-se muito a  isometria (contração muscular sem movimento) e trabalha todos os membros inferiores de diversas maneiras, ocasionando em mobilidade articular e maior flexibilidade.\r\n','calistenia12-10-2016.jpg'),(16,'Nos 69 anos da abertura do Masp, cliques que contam a história do museu','12/10/2016','18:32:58','Recreation','marcelo8g@gmail.com','Considerado hoje o mais importante museu de arte do Hemisfério Sul pelo seu rico acervo de cerca de 8 mil peças – em sua maioria de arte ocidental, desde o século 4 a.C. aos dias de hoje – o Masp completa neste domingo 69 anos de sua inauguração, ainda na rua 7 de abril. Em 1968, o museu foi transferido para o prédio que conhecemos hoje na avenida Paulista, projetado por Lina Bo Bardi. Com uma uma média mensal de 37 mil visitantes por mês em 2016, o museu integra desde 2008, a convite do Musèe d’Orsay de Paris, o Clube dos 19, grupo dos 19 museus no mundo cujos acervos são considerados os mais representativos da arte européia do século 19, como o próprio Musèe d´Orsay, The Art Institute de Chicago e o Metropolitan de Nova York, entre outros.\r\n\r\nQue tal uma visita ao aniversariante do dia neste domingo? Abaixo, uma galeria de fotos com momentos icônicos, como a exposição da unidade da 7 de Abril, com expografia de Lina Bo Bardi, em 1950, e a inauguração do Masp na avenida Paulista, com a presença da rainha Elisabeth II, em 1968.\r\n','masp12-10-2016.jpg'),(17,'Amazon entra na disputa por mercado de música on-line','12/10/2016','18:34:51','MusicGenre','marcelo8g@gmail.com','A Amazon entrou em cheio nesta quarta-feira na disputa pela música on-line com um novo serviço que oferece um catálogo robusto com o qual pretende competir diretamente com Spotify, Deezer e Apple Music.\r\n\r\nO gigante da distribuição on-line já dava acesso a dois milhões de títulos para os assinantes de seu serviço Prime, que combina a entrega gratuita de pedidos em suas loja on-line com diversos conteúdos digitais, especialmente o vídeo em streaming.\r\n\r\nSeu novo serviço, chamado Amazon Music Unlimited, oferece agora americanos \"um catálogo de dezenas de milhões de músicas e milhares de listas de reprodução e de estações personalizadas selecionados com cuidado\", segundo um comunicado. \r\n\r\nO preço oficial do serviço é de 9,99 dólares mensais, um montante similar aos cobrados pelo Spotify Premium (a oferta sem publicidade do líder sueco do setor), Apple Music e Google Play. \r\n\r\nComo muitos outros atores das novas tecnologias, a Amazon também está tentando convencer seus clientes de associarem-se a todas as suas propostas, e para isso não duvidou em lançar-se à competição pelos preços. \r\n\r\nNos EUA, o custo do novo serviço de música será oferecido a um preço reduzido de 7,99 dólares por mês ou 79 dólares por ano para os assinantes do Prime.\r\n\r\nDespois dos Estados Unidos, a Amazon Music Unlimited também estará disponível no Reino Unido, na Alemanha e na Áustria antes do final do ano. \r\n','amazon12-10-2016.jpg'),(19,'Campus Party será em Brasília em 2017','12/10/2016','18:41:36','Game','marcelo8g@gmail.com','Evento de tecnologia, empreendimento e inovação mais abrangente do mundo, o Campus Party chega a Brasília em julho de 2017 e, para que o encontro seja realizado com sucesso, uma prévia foi marcada para o início do próximo mês no Centro de Convenções Ulysses Guimarães.\r\n\r\nCom uma proposta diferente das outras edições que ocorrem em outras cidades e países, o aquecimento para a primeira edição mais completa, chamado de Campus Day, terá apenas oito horas de duração e a entrada será gratuita. “Será uma versão pocket, porém com um intenso dia de programação, que não deixará de lado as experiências adquiridas no formato tradicional”, explicou o presidente do Instituto Campus Party, Francesco Farruggia.\r\n\r\nPara o governador do Distrito Federal, Rodrigo Rollemberg, a realização da Campus Party em Brasília vai contribuir para a criação de um ambiente de empreendedorismo e inovação fundamentais para moldar um novo modelo de desenvolvimento na capital. “Estamos implementando o Parque Tecnológico e desenvolvendo várias linhas de apoio a startups e a Campus Party contribui para lançar os olhares sobre Brasília e sobre essa vertente do desenvolvimento tecnológico em nossa cidade.” afirmou o governador.\r\n\r\nO Campus Day, que vai acontecer dia 5 de novembro, vai contar com grandes nomes da tecnologia mundial.\r\n','CPB12-10-2016.png');
/*!40000 ALTER TABLE `noticia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userprofile`
--

DROP TABLE IF EXISTS `userprofile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userprofile` (
  `abilityToSee` varchar(50) NOT NULL,
  `fontSize` varchar(50) NOT NULL,
  `graphicalElementSize` varchar(50) NOT NULL,
  `interest` text NOT NULL,
  `environmentGroupAddress` varchar(200) NOT NULL,
  `timeOfOccurrence` varchar(200) NOT NULL,
  PRIMARY KEY (`environmentGroupAddress`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userprofile`
--

LOCK TABLES `userprofile` WRITE;
/*!40000 ALTER TABLE `userprofile` DISABLE KEYS */;
INSERT INTO `userprofile` VALUES ('high','small','small','','BUSS','1476214960');
/*!40000 ALTER TABLE `userprofile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `email` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `sobrenome` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('marcelo8g@gmail.com','«`À(%†ì°÷ö#odàF','Marcelo','Barbosa','Olá, meu nome é Marcelo Barbosa. Sou aluno de graduação do curso de Bacharelado em Sistemas de Informação da Universidade Federal de São Carlos. Gosto de ler livros e artigos científicos e sou praticante de exercícios físicos.'),('tatidealencar@gmail.com','Í8}Mç·æÙ=B§wü','Tatiana','Silva de Alencar','');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-11 23:13:39
