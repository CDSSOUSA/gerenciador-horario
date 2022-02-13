-- CREATE DATABASE bd_sisacpa CHARACTER SET UTF8;
-- USE bd_sisHorario;
-- DROP DATABASE bd_sisHorario;

DROP TABLE IF EXISTS tb_alocacao_professor;
DROP TABLE IF EXISTS tb_professor_disciplina;
CREATE TABLE IF NOT EXISTS  `tb_alocacao_professor` (
  `id` int NOT NULL,
  `id_professor` int NOT NULL,
  `nome` varchar(50) NOT NULL,
  `dia_semana` char(1) DEFAULT NULL COMMENT '2-SEGUNDA, 3-TERÇA, 4-QUARTA, 5-QUINTA, 6-SEXTA',
  `posicao_aula` smallint DEFAULT NULL,
  `situacao` char(1) DEFAULT NULL COMMENT 'L- LIVRE, O-OCUPADO',
  `status` char(1) DEFAULT 'A' COMMENT 'A-ATIVO; I-INATIVO',
  `id_serie` smallint NOT NULL,
  id_disciplina INT,
  CONSTRAINT id_disciplina_fk FOREIGN KEY (id_disciplina) REFERENCES tb_professor_disciplina (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tb_alocacao_professor` (`id`, `id_professor`, `nome`, `dia_semana`, `posicao_aula`, `situacao`, `status`, `id_serie`, id_disciplina) VALUES
(1, 1, 'TIBERIO', '2', 1, 'L', 'A', 1,1),
(2, 1, 'TIBERIO', '2', 2, 'L', 'A', 1,2),
(3, 2, 'ARNALDO', '3', 1, 'L', 'A', 1,3),
(4, 4, 'MICHELLI', '2', 1, 'L', 'A', 1,4),
(5, 5, 'ALEXANDRE', '2', 4, 'O', 'A', 1,5),
(6, 6, 'TESSÁLIA', '2', 5, 'O', 'A', 1,6);


DROP TABLE IF EXISTS tb_horario; 
DROP TABLE IF EXISTS tb_professor_serie;
DROP TABLE IF EXISTS tb_serie;

DROP TABLE IF EXISTS tb_ano_letivo;

CREATE TABLE IF NOT EXISTS  `tb_ano_letivo` (
  `id` smallint NOT NULL,
  `ano` varchar(4) NOT NULL,
  `status` char(1) DEFAULT 'A' COMMENT 'A-ATIVO; I-INATIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tb_ano_letivo` (`id`, `ano`, `status`) VALUES (1, '2021', 'A');

 

DROP TABLE IF EXISTS tb_disciplina;
CREATE TABLE IF NOT EXISTS `tb_disciplina` (
  `id` smallint NOT NULL,
  `descricao` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tb_disciplina` (`id`, `descricao`) VALUES
(1, 'GEOGRAFIA'),
(2, 'MATEMATICA'),
(3, 'PORTUGUÊS'),
(4, 'HISTÓRIA'),
(5, 'CIÊNCIAS'),
(6, 'ED.FÍSICA');

CREATE TABLE IF NOT EXISTS `tb_horario`(
  `id` int NOT NULL,
  `id_professor` int NOT NULL,
  `nome` varchar(50) NOT NULL,
  `dia_semana` char(1) DEFAULT NULL COMMENT '2-SEGUNDA, 3-TERÇA, 4-QUARTA, 5-QUINTA, 6-SEXTA',
  `posicao_aula` smallint DEFAULT NULL,
  `id_serie` smallint NOT NULL,
  `id_ano_letivo` smallint NOT NULL,
  `status` char(1) DEFAULT 'A' COMMENT 'A-ATIVO; I-INATIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tb_horario` (`id`, `id_professor`, `nome`, `dia_semana`, `posicao_aula`, `id_serie`, `id_ano_letivo`, `status`) VALUES
(1, 4, 'MICHELLI', '2', 1, 1, 1, 'A'),
(2, 4, 'MICHELLI', '2', 2, 1, 1, 'A'),
(3, 4, 'MICHELLI', '2', 5, 2, 1, 'A'),
(4, 4, 'MICHELLI', '2', 6, 2, 1, 'A'),
(5, 4, 'MICHELLI', '2', 4, 3, 1, 'A'),
(6, 4, 'MICHELLI', '2', 3, 3, 1, 'A'),
(7, 5, 'ALEXANDRE', '2', 1, 2, 1, 'A'),
(8, 5, 'ALEXANDRE', '2', 2, 3, 1, 'A'),
(9, 5, 'ALEXANDRE', '2', 3, 1, 1, 'A'),
(10, 6, 'TESSÁLIA', '3', 3, 1, 1, 'A'),
(11, 6, 'TESSÁLIA', '5', 4, 2, 1, 'A'),
(12, 6, 'TESSÁLIA', '2', 5, 1, 1, 'A'),
(13, 6, 'TESSÁLIA', '2', 6, 1, 1, 'A'),
(14, 5, 'ALEXANDRE', '2', 4, 1, 1, 'A');

DROP TABLE IF EXISTS tb_professor;
CREATE TABLE IF NOT EXISTS `tb_professor` (
  `id` int NOT NULL,
  `nome` varchar(50) NOT NULL,
  `qtde_aula` smallint DEFAULT NULL,
  `cor_destaque` varchar(7) DEFAULT '#000' COMMENT 'Usuar padrao hexadecimal',
  `status` char(1) DEFAULT 'A' COMMENT 'A-ATIVO; I-INATIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tb_professor` (`id`, `nome`, `qtde_aula`, `cor_destaque`, `status`) VALUES
(1, 'TIBÉRIO MENDONÇA DE LIMA', 4, '#3C0BF3', 'A'),
(2, 'ARNALDO AUGUSTO NORA ANTUNES FILHO', 4, '#A00E2A', 'A'),
(3, 'JOAQUIM CLAUDIO CORREA DE MELO JUNIOR', 3, '#690EA0', 'A'),
(4, 'MICHELLI OBAMA', 6, '#0F0FE8', 'A'),
(5, 'ALEXANDRE O GRANDE', 3, '#B43019', 'A'),
(6, 'TESSÁLIA ZEFA', 10, '#11B9B1', 'A'),
(7, 'JOSE', 4, '#045d13', 'A'),
(8, 'JOSE', 4, '#000000', 'A'),
(9, 'JOSE', 4, '#000000', 'A'),
(10, 'JOSE', 4, '#045d13', 'A'),
(11, 'JOSE', 4, '#045d13', 'A'),
(12, 'JOSE', 4, '#045d13', 'A'),
(13, 'KATIA ABREU', 4, '#157f2a', 'A'),
(14, 'HENRIQUE', 45, '#6a8627', 'A'),
(15, 'HENRIQUE', 5, '#000000', 'A'),
(16, 'MARIA', 5, '#000000', 'A'),
(17, 'MARIA MARTA', 5, '#000000', 'A'),
(18, 'GABIELA ', 6, '#000000', 'A'),
(19, 'HENRIQUE', 5, '#000000', 'A'),
(20, 'JOSE DA SILVA SOUSA', 67, '#000000', 'A'),
(21, 'CARLOS MANCIN', 32767, '#000000', 'A'),
(22, 'JUAN MARCOS', 4, '#000000', 'A'),
(23, 'CASER', 4, '#000000', 'A'),
(24, 'FRTR', 5, '#000000', 'A'),
(25, 'SADFEFQ', 4, '#000000', 'A'),
(26, 'ERERQRQ', 3, '#000000', 'A'),
(27, 'HENRIQUE', 5, '#000000', 'A'),
(28, 'JOSE CARLOS ', 6, '#000000', 'A'),
(29, 'TALITA CAMOS', 12, '#ce0d0d', 'A'),
(30, 'KARLA MARINS', 6, '#000000', 'A');


CREATE TABLE IF NOT EXISTS `tb_professor_disciplina` (
  id INT AUTO_INCREMENT,
  id_professor int NOT NULL,
  id_disciplina smallint NOT NULL,
  CONSTRAINT id_pk PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `tb_professor_disciplina` (id, id_professor, id_disciplina) VALUES
(null, 1, 1),
(null, 1, 2),
(null, 2, 1),
(null, 4, 5),
(null, 5, 6),
(null, 6, 3);


CREATE TABLE IF NOT EXISTS `tb_professor_serie` (
  `id_professor` int NOT NULL,
  `id_serie` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `tb_professor_serie` (`id_professor`, `id_serie`) VALUES
(1, 1),
(1, 2),
(2, 1),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(6, 2),
(6, 4),
(6, 6),
(6, 7);


CREATE TABLE IF NOT EXISTS `tb_serie` (
  `id` smallint NOT NULL,
  `descricao` varchar(2) NOT NULL,
  `classificacao` varchar(2) DEFAULT NULL,
  `turno` char(1) DEFAULT NULL COMMENT 'M-MANHA, T-TARDE, N-NOITE',
  `id_ano_letivo` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `tb_serie` (`id`, `descricao`, `classificacao`, `turno`, `id_ano_letivo`) VALUES
(1, '6', 'A', 'M', 1),
(2, '6', 'B', 'M', 1),
(3, '6', 'C', 'M', 1),
(4, '7', 'A', 'M', 1),
(5, '7', 'B', 'M', 1),
(6, '7', 'C', 'M', 1),
(7, '9', 'A', 'M', 1),
(8, '9', 'B', 'M', 1),
(9, '9', 'C', 'M', 1),
(10, '6', 'D', 'M', 1),
(11, '7', 'D', 'M', 1);

ALTER TABLE `tb_alocacao_professor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_professor_alocacao_fk` (`id_professor`),
  ADD KEY `id__serie_alocacao_professor_fk` (`id_serie`);

 ALTER TABLE `tb_ano_letivo`
  ADD PRIMARY KEY (`id`);
 
 ALTER TABLE `tb_disciplina`
  ADD PRIMARY KEY (`id`);

 ALTER TABLE `tb_horario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_professor_horario_fk` (`id_professor`),
  ADD KEY `id__serie_horario_fk` (`id_serie`),
  ADD KEY `id_ano_horario` (`id_ano_letivo`);

 ALTER TABLE `tb_professor`
  ADD PRIMARY KEY (`id`);
 
 ALTER TABLE `tb_professor_disciplina`
  ADD KEY `id_professor_disciplina_fk` (`id_professor`),
  ADD KEY `id__disciplina_professor_fk` (`id_disciplina`);
 
 ALTER TABLE `tb_professor_serie`
  ADD KEY `id_professor_serie_fk` (`id_professor`),
  ADD KEY `id__serie_professor_fk` (`id_serie`);
 
 ALTER TABLE `tb_serie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ano_serie` (`id_ano_letivo`);
 
 ALTER TABLE `tb_alocacao_professor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
 
 ALTER TABLE `tb_ano_letivo`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_disciplina`
--
ALTER TABLE `tb_disciplina`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tb_horario`
--
ALTER TABLE `tb_horario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `tb_professor`
--
ALTER TABLE `tb_professor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `tb_serie`
--
ALTER TABLE `tb_serie`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
 
 ALTER TABLE `tb_alocacao_professor`
  ADD CONSTRAINT `id__serie_alocacao_professor_fk` FOREIGN KEY (`id_serie`) REFERENCES `tb_serie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_professor_alocacao_fk` FOREIGN KEY (`id_professor`) REFERENCES `tb_professor` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `tb_horario`
--
ALTER TABLE `tb_horario`
  ADD CONSTRAINT `id__serie_horario_fk` FOREIGN KEY (`id_serie`) REFERENCES `tb_serie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_ano_horario` FOREIGN KEY (`id_ano_letivo`) REFERENCES `tb_ano_letivo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_professor_horario_fk` FOREIGN KEY (`id_professor`) REFERENCES `tb_professor` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `tb_professor_disciplina`
--
ALTER TABLE `tb_professor_disciplina`
  ADD CONSTRAINT `id__disciplina_professor_fk` FOREIGN KEY (`id_disciplina`) REFERENCES `tb_disciplina` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_professor_disciplina_fk` FOREIGN KEY (`id_professor`) REFERENCES `tb_professor` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `tb_professor_serie`
--
ALTER TABLE `tb_professor_serie`
  ADD CONSTRAINT `id__serie_professor_fk` FOREIGN KEY (`id_serie`) REFERENCES `tb_serie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_professor_serie_fk` FOREIGN KEY (`id_professor`) REFERENCES `tb_professor` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `tb_serie`
--
ALTER TABLE `tb_serie`
  ADD CONSTRAINT `id_ano_serie` FOREIGN KEY (`id_ano_letivo`) REFERENCES `tb_ano_letivo` (`id`) ON DELETE CASCADE;
COMMIT;
