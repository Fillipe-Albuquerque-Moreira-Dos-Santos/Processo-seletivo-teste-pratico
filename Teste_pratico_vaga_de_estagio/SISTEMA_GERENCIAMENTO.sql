/*Usei o xammp para fazer todo o tratamento e acriação do banco*/

CREATE DATABASE SISTEMA_GERENCIAMENTO;

USE SISTEMA_GERENCIAMENTO;

CREATE TABLE pacientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    genero ENUM('M', 'F', 'N') NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    endereco VARCHAR(255) NOT NULL
);

/*Caso a equipe que estiver me avaliando queira inserir algum dado deixarei alguns prontos disponíveis*/
INSERT INTO pacientes (nome, data_nascimento, genero, telefone, endereco) VALUES
('Sara Raquel Muniz Ferreira', 'M', '1991-04-04', '(61) 9658-4813', 'Ceilandia Sul QMN 17'),
('Fillipe Albuquerque Moreira dos Santos', 'M', '2024-04-04', '(61) 99381-3636', 'quadra 15 conjunto A casa 32'),
('Lucas Albuquerque', 'M', '2024-04-17', '(45) 45745-4545', 'quadra 11 conjunto A casa 54'),
('Rafael Albuquerque Moreira dos Santos', 'F', '1960-11-16', '(61) 99381-3636', 'quadra 11 conjunto A casa 54'),
('Edilson Moreira dos Santos', 'M', '1965-06-09', '(99) 38136-3654', 'quadra 13 Conjunto B casa 12'),
('Joaquim da Silva', 'M', '1948-06-15', '(41) 99256-5552', 'Avenida paulista Sao Paulo');

