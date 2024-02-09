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
    proprietaire integer FOREIGN KEY REFERENCES utilisateur(id), 
    addresse integer FOREIGN KEY REFERENCES addresse(id)
);

CREATE TABLE reservation(
    id serial PRIMARY KEY,
    date_debut DATE,
    date_fin DATE,
    proprietaire integer FOREIGN KEY REFERENCES utilisateur(id), 
    lieu integer FOREIGN KEY REFERENCES appartement(id)
);
