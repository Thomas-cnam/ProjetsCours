\c postgres
DROP DATABASE IF EXISTS bd_velib;
CREATE DATABASE bd_velib;
\c bd_velib


CREATE TABLE utilisateur (
    id INT,
    nomUti VARCHAR(25),
    mdpUti VARCHAR(25),


    PRIMARY KEY(id)

);

CREATE TABLE station (
    id BIGINT,
    nomStation VARCHAR(150),
    nombreDeBornette INT,
    nombreVelos INT,
    velosElectrique INT,
    velosMecanique INT,
    latitude FLOAT,
    longitude FLOAT,
    velosLouable BOOLEAN,
    velosRecevable BOOLEAN,
    capacity INT,

    PRIMARY KEY(id)

);

CREATE TABLE stationFav (
    id BIGINT,
    nomStation VARCHAR(150),
    nombreDeBornette INT,
    nombreVelos INT,
    velosElectrique INT,
    velosMecanique INT,
    latitude FLOAT,
    longitude FLOAT,
    velosLouable BOOLEAN,
    velosRecevable BOOLEAN,
    capacity INT,

    PRIMARY KEY(id)

);

DROP USER IF EXISTS uti_velib;
CREATE USER uti_velib LOGIN PASSWORD 'slam';
GRANT SELECT, INSERT, UPDATE, DELETE ON TABLE utilisateur, station TO uti_velib;
DROP USER IF EXISTS Thomas;
CREATE USER Thomas LOGIN PASSWORD 'slam';
INSERT INTO utilisateur VALUES (1, 'Thomas', 'slam');
GRANT INSERT ON TABLE utilisateur TO Thomas;