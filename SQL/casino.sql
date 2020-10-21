CREATE DATABASE casino
	DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
CREATE USER 'aleix'@'localhost' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON * . * TO 'aleix'@'localhost';

CREATE TABLE socis(
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nick VARCHAR(256) NOT NULL UNIQUE,
    pass VARCHAR(256) NOT NULL,
    rang INT(11) NULL,
    saldo INT(11) NULL
)ENGINE=InnoDB;

INSERT INTO socis (id,nick,pass,rang,saldo)
	VALUES(DEFAULT,'peski','polaina',1,100);
SELECT * FROM socis where nick='peski';

SELECT * FROM socis;

