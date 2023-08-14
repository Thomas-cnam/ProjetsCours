
\c postgres
DROP DATABASE IF EXISTS bd_hotel;
CREATE DATABASE bd_hotel;
\c bd_hotel

CREATE TABLE reservation (

    numero int,
    nom VARCHAR(10),
    datejour DATE,

    PRIMARY KEY (numero, datejour)

);

DROP USER IF EXISTS uti_hotel;
CREATE USER uti_hotel LOGIN PASSWORD 'slam';

GRANT ALL ON reservation TO uti_hotel;
