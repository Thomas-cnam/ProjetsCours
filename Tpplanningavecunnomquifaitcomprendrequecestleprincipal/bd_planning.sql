-- script généré automatiquement avec Looping
\c postgres
DROP DATABASE IF EXISTS bd_planning;
CREATE DATABASE bd_planning;

\c bd_planning


CREATE TABLE PATIENT(
   Id_PATIENT SERIAL,
   nom VARCHAR(50) ,
   prenom VARCHAR(50) ,
   PRIMARY KEY(Id_PATIENT)
);

CREATE TABLE RDV(
   jour DATE,
   creneau INTEGER,
   Id_PATIENT INTEGER NOT NULL,
   PRIMARY KEY(jour, creneau),
   FOREIGN KEY(Id_PATIENT) REFERENCES PATIENT(Id_PATIENT)
);

DROP user IF EXISTS uti_planning;
CREATE USER uti_planning LOGIN PASSWORD 'rT6a4g';

GRANT ALL ON patient, rdv, patient_id_patient_seq TO uti_planning;
