CREATE TABLE exercice_year(
    id SERIAL PRIMARY KEY,
    label VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE exercice(
    id SERIAL PRIMARY KEY,
    no_account VARCHAR(20) NOT NULL,
    id_exercice_year INT NOT NULL REFERENCES exercice_year(id) ON DELETE CASCADE,
    label VARCHAR(100) NOT NULL,
    debit NUMERIC(18, 2) NOT NULL DEFAULT 0,
    credit NUMERIC(18, 2) NOT NULL DEFAULT 0,
    date DATE NOT NULL
);

-- unité
CREATE TABLE unit(
    id SERIAL PRIMARY KEY,
    label VARCHAR(50) NOT NULL UNIQUE
);

-- nature
CREATE TABLE nature(
    id SERIAL PRIMARY KEY,
    label VARCHAR(8) NOT NULL UNIQUE
);

-- incorporation / incorporabilité
CREATE TABLE incorporation(
    id SERIAL PRIMARY KEY,
    label VARCHAR(16) NOT NULL UNIQUE
);

-- rubrique
CREATE TABLE section(
    id SERIAL PRIMARY KEY,
    no_account VARCHAR(20) NOT NULL,
    label VARCHAR(100) NOT NULL UNIQUE,
    id_unit INTEGER NOT NULL REFERENCES unit(id)  ON DELETE CASCADE,
    id_nature INTEGER NOT NULL REFERENCES nature(id)  ON DELETE CASCADE,
    id_incorporation INTEGER NOT NULL REFERENCES incorporation(id)  ON DELETE CASCADE
);

-- type centre: structure na le ray fa tsy tadidiko
CREATE TABLE center_type(
    id SERIAL PRIMARY KEY,
    label VARCHAR(20) NOT NULL UNIQUE
);

-- centre
-- ze centre andalovana vôlou ambany ID am ze andalovana manaraka aadaana manao an le coût général
CREATE TABLE center(
    id SERIAL PRIMARY KEY,
    label VARCHAR(100) NOT NULL UNIQUE,
    id_center_type INTEGER REFERENCES center_type(id)  ON DELETE CASCADE
);


-- charge
CREATE TABLE expense(
    id SERIAL PRIMARY KEY,
    id_section INTEGER NOT NULL REFERENCES section(id)  ON DELETE CASCADE,
    id_exercice INTEGER NOT NULL REFERENCES exercice(id) ON DELETE CASCADE,
    quantity DECIMAL(16, 2) NOT NULL DEFAULT 1,
    price DECIMAL(16, 2) NOT NULL,
    date DATE NOT NULL,
    check(quantity > 0),
    check(price > 0)
);

-- expense center
CREATE TABLE expense_center(
    id SERIAL PRIMARY KEY,
    id_expense INTEGER NOT NULL REFERENCES expense(id)  ON DELETE CASCADE,
    id_center INTEGER NOT NULL REFERENCES center(id)  ON DELETE CASCADE,
    percentage DECIMAL(5, 4) NOT NULL,
    CHECK(percentage >= 0 AND percentage <= 1)
);

-- produit
-- tokana le produit fa azo updaténa
CREATE TABLE product(
    id SERIAL PRIMARY KEY,
    label VARCHAR(100) NOT NULL UNIQUE,
    id_unit INTEGER NOT NULL REFERENCES unit(id)  ON DELETE CASCADE,
    quantity INTEGER NOT NULL,
    CHECK(quantity > 0)
);

-- Role
CREATE TABLE Role (
    id SERIAL PRIMARY KEY,
    label VARCHAR(100) NOT NULL
);

-- Login
CREATE TABLE Login (
    
);