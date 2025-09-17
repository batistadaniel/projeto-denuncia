CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    senha VARCHAR(50) NOT NULL,
    tipo ENUM('normal', 'admin') NOT NULL DEFAULT 'normal'
);

-- Exemplo de inserções:
INSERT INTO usuarios (usuario, senha, tipo) VALUES ('joao', '1234', 'normal');
INSERT INTO usuarios (usuario, senha, tipo) VALUES ('admin', '1234', 'admin');
