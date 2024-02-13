

CREATE TABLE addresse (
    id serial PRIMARY KEY,
    lieu varchar(64)
);

CREATE TABLE utilisateur (
    id serial PRIMARY KEY,
    nom varchar(64),
    mdp varchar(64),
    status integer
);

CREATE TABLE appartement(
    id serial PRIMARY KEY,
    capacite integer,
    superficie integer,
    disponible boolean,
    prix integer,
    valide_admin boolean,
    valide_proprio boolean,
    CONSTRAINT proprietaire FOREIGN KEY(id) REFERENCES utilisateur(id),
    CONSTRAINT addresse FOREIGN KEY(id) REFERENCES addresse(id)
);

CREATE TABLE reservation(
    id serial PRIMARY KEY,
    date_debut DATE,
    date_fin DATE,
    CONSTRAINT proprietaire FOREIGN KEY(id) REFERENCES utilisateur(id), 
    CONSTRAINT lieu FOREIGN KEY(id) REFERENCES appartement(id)
);

-- 1 user pr statut
-- 1 appart propriétaire
-- tout à true

INSERT into utilisateur (nom, mdp, status) VALUES ('user1', 'password',1);
INSERT into utilisateur (nom, mdp, status) VALUES ('user2', 'password',2);
INSERT into utilisateur (nom, mdp, status) VALUES ('user3', 'password',3);

INSERT into addresse (lieu) VALUES ('Mars');

INSERT into appartement (capacite, superficie, disponible, prix, valide_admin, valide_proprio, proprietaire,addresse) VALUES (2,80,1,12000,1,1,2,1);