-- CREATE DATABASE bd_sisacpa CHARACTER SET UTF8;
-- USE bd_sisHorario;
-- DROP DATABASE bd_sisHorario;
DROP TABLE IF EXISTS tb_serie;
DROP TABLE IF EXISTS tb_alocacao_professor;
DROP TABLE IF EXISTS tb_professor_serie;
DROP TABLE IF EXISTS tb_horario ;

DROP TABLE IF EXISTS tb_ano_letivo;

CREATE TABLE IF NOT EXISTS  tb_ano_letivo (
  id smallint NOT NULL AUTO_INCREMENT,
  ano varchar(4) NOT NULL,
  status char(1) DEFAULT 'A' COMMENT 'A-ATIVO; I-INATIVO',
  CONSTRAINT id_pk PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO tb_ano_letivo (id, ano, status) VALUES (1, '2021', 'A');

DROP TABLE IF EXISTS tb_professor_disciplina;
DROP TABLE IF EXISTS tb_disciplina;
CREATE TABLE IF NOT EXISTS tb_disciplina (
  id smallint NOT NULL AUTO_INCREMENT,
  descricao varchar(15) NOT NULL,
  CONSTRAINT id_pk PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO tb_disciplina (id, descricao) VALUES
(1, 'GEOGRAFIA'),
(2, 'MATEMATICA'),
(3, 'PORTUGUÊS'),
(4, 'HISTÓRIA'),
(5, 'CIÊNCIAS'),
(6, 'ED.FÍSICA');

DROP TABLE IF EXISTS tb_professor;
CREATE TABLE IF NOT EXISTS tb_professor (
  id int NOT NULL AUTO_INCREMENT,
  nome varchar(50) NOT NULL,
  qtde_aula smallint DEFAULT NULL,
  cor_destaque varchar(7) DEFAULT '#000' COMMENT 'Usuar padrao hexadecimal',
  status char(1) DEFAULT 'A' COMMENT 'A-ATIVO; I-INATIVO',
  CONSTRAINT id_pk PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO tb_professor (id, nome, qtde_aula, cor_destaque, status) VALUES
(1, 'TIBÉRIO MENDONÇA DE LIMA', 4, '#3C0BF3', 'A'),
(2, 'ARNALDO AUGUSTO NORA ANTUNES FILHO', 4, '#A00E2A', 'A'),
(3, 'JOAQUIM CLAUDIO CORREA DE MELO JUNIOR', 3, '#690EA0', 'A'),
(4, 'MICHELLI OBAMA', 6, '#0F0FE8', 'A'),
(5, 'ALEXANDRE O GRANDE', 3, '#B43019', 'A'),
(6, 'TESSÁLIA ZEFA', 10, '#11B9B1', 'A');


CREATE TABLE IF NOT EXISTS tb_professor_disciplina (
  id INT AUTO_INCREMENT,
  id_professor int NOT NULL,
  id_disciplina smallint NOT NULL,
  CONSTRAINT id_pk PRIMARY KEY (id),
  CONSTRAINT id_professor_fk FOREIGN KEY (id_professor) REFERENCES tb_professor (id) ON DELETE CASCADE,
  CONSTRAINT id_disciplina_fk FOREIGN KEY (id_disciplina) REFERENCES tb_disciplina (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO tb_professor_disciplina (id, id_professor, id_disciplina) VALUES
(null, 1, 1),
(null, 1, 2),
(null, 2, 1),
(null, 4, 5),
(null, 5, 6),
(null, 6, 3);

CREATE TABLE IF NOT EXISTS tb_serie (
  id smallint NOT NULL AUTO_INCREMENT,
  descricao varchar(2) NOT NULL,
  classificacao varchar(2) DEFAULT NULL,
  turno char(1) DEFAULT NULL COMMENT 'M-MANHA, T-TARDE, N-NOITE',
  id_ano_letivo smallint NOT NULL,
  CONSTRAINT id_pk PRIMARY KEY (id),
  CONSTRAINT id_ano_letivo_serie_fk FOREIGN KEY (id_ano_letivo) REFERENCES tb_ano_letivo (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO tb_serie (id, descricao, classificacao, turno, id_ano_letivo) VALUES
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


CREATE TABLE IF NOT EXISTS tb_professor_serie (
  id INT AUTO_INCREMENT,
  id_professor_disciplina int NOT NULL,
  id_serie smallint NOT NULL,
  CONSTRAINT id_pk PRIMARY KEY(id),
  CONSTRAINT id_professor_disciplina_serie_fk FOREIGN KEY (id_professor_disciplina) REFERENCES tb_professor_disciplina (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO tb_professor_serie (id, id_professor_disciplina, id_serie) VALUES
(null, 1, 1),
(null, 2, 2),
(null, 3, 1);


CREATE TABLE IF NOT EXISTS  tb_alocacao_professor (
  id int NOT NULL AUTO_INCREMENT,
  id_professor int NOT NULL,  
  dia_semana char(1) DEFAULT NULL COMMENT '2-SEGUNDA, 3-TERÇA, 4-QUARTA, 5-QUINTA, 6-SEXTA',
  posicao_aula smallint DEFAULT NULL,
  situacao char(1) DEFAULT NULL COMMENT 'L- LIVRE, O-OCUPADO',
  status char(1) DEFAULT 'A' COMMENT 'A-ATIVO; I-INATIVO',
  id_serie int NOT NULL,  
  CONSTRAINT id_pk PRIMARY KEY (id),
  CONSTRAINT id_professor_alocacao_fk FOREIGN KEY (id_professor) REFERENCES tb_professor_disciplina (id) ON DELETE CASCADE, 
  CONSTRAINT id_serie_alocacao_fk FOREIGN KEY (id_serie) REFERENCES tb_professor_serie (id) ON DELETE CASCADE  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO tb_alocacao_professor (id, id_professor, dia_semana, posicao_aula, situacao, status, id_serie) VALUES
(1, 1, '2', 1, 'L', 'A', 1),
(2, 1, '2', 2, 'L', 'A', 2),
(3, 2, '3', 1, 'L', 'A', 3);

CREATE TABLE IF NOT EXISTS tb_horario(
  id int NOT NULL,
  id_professor int NOT NULL,  
  dia_semana char(1) DEFAULT NULL COMMENT '2-SEGUNDA, 3-TERÇA, 4-QUARTA, 5-QUINTA, 6-SEXTA',
  posicao_aula smallint DEFAULT NULL,
  id_serie smallint NOT NULL,
  id_ano_letivo smallint NOT NULL,
  status char(1) DEFAULT 'A' COMMENT 'A-ATIVO; I-INATIVO',
  CONSTRAINT id_pk PRIMARY KEY (id),
  CONSTRAINT id_professor_horario_fk FOREIGN KEY (id_professor) REFERENCES tb_professor (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO tb_horario (id, id_professor,dia_semana, posicao_aula, id_serie, id_ano_letivo, status) VALUES
(1, 1, '2', 1, 1, 1, 'A');