CREATE DATABASE IF NOT EXISTS seu_banco;
USE seu_banco;

CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(255) NOT NULL,
    quantidade_vendida INT NOT NULL,
    data_venda DATE NOT NULL
);