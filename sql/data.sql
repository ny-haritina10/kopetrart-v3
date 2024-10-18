-- DONNÉES FIXES
-- !IMPORTANT afaka soloina le label fa le ordre important (mety manimba vue):  1: variable, 2: fixe
INSERT INTO nature(label) VALUES('Variable');
INSERT INTO nature(label) VALUES('Fixe'    );

-- !IMPORTANT afaka soloina le label fa le ordre important (mety manimba vue):  1: incorporable, 2: non incorporable, 3: suppletiveC
INSERT INTO incorporation(label) VALUES('Incorporable'    );
INSERT INTO incorporation(label) VALUES('Non Incorporable');
INSERT INTO incorporation(label) VALUES('Supplétive'      );

-- !IMPORTANT afaka soloina le label fa le ordre important (mety manimba vue):  1: centre de structure, 2: centre operationel
INSERT INTO center_type(label) VALUES('Structure');
INSERT INTO center_type(label) VALUES('Actif?');


-- DONNÉES DE TEST
-- EXERCICE
INSERT INTO exercice_year(label) VALUES('Exercice Comptable Test');

-- -- CHARGES
-- INSERT INTO unit(label) VALUES('KG'                   );
INSERT INTO unit(label) VALUES('NB'                   );
INSERT INTO unit(label) VALUES('Cons periodique'      );
INSERT INTO unit(label) VALUES('KW'                   );
INSERT INTO unit(label) VALUES('LITRES'               );
INSERT INTO unit(label) VALUES('Loyer mensuel'        );
INSERT INTO unit(label) VALUES('Heure de travail (HT)');
INSERT INTO unit(label) VALUES('Sal mens ou HT'       );
INSERT INTO unit(label) VALUES('m2'                   );
INSERT INTO unit(label) VALUES('m'                    );
INSERT INTO unit(label) VALUES('Unité'                );

INSERT INTO center(label, id_center_type) VALUES('Artisanat', 2);
INSERT INTO center(label, id_center_type) VALUES('Adm/Dist' , 1);

-- Product 
INSERT INTO product(label, quantity, id_unit) VALUES('Sac à main', 338000.0, 1);
INSERT INTO product(label, quantity, id_unit) VALUES('Sac à main en cuir', 150000.0, 1);
INSERT INTO product(label, quantity, id_unit) VALUES('Sac à main en toile', 120000.0, 1);
INSERT INTO product(label, quantity, id_unit) VALUES('Sac à main de soirée', 80000.0, 1);
INSERT INTO product(label, quantity, id_unit) VALUES('Sac à main vintage', 95000.0, 1);
INSERT INTO product(label, quantity, id_unit) VALUES('Sac à main en daim', 110000.0, 1);

-- Loyer
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('613', 'Loyer', 6, 2, 2);

-- Amortissement
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('6811', 'Amortissement', 3, 2, 2);

-- Cuir
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('601', 'Cuir', 1, 1, 1);

-- Salaire Admin
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('6411', 'Salaire Admin', 8, 2, 2);

-- Assurances
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('616', 'Assurances', 3, 2, 2);

-- Charges supplétives
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('0000', 'Charges supplétives', 3, 2, 3);

-- Fils
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('601', 'Fils', 10, 1, 1);

-- Fermois
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('601', 'Fermois', 1, 1, 1);

-- Accessoires
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('606', 'Accessoires', 10, 1, 1);

-- Main d’œuvre directe
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('6411', 'Main d''oeuvre directe', 7, 1, 1);

-- Eau et électricité
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('6061', 'Eau et électricité', 4, 2, 2);

-- Entretien de communication
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('6155', 'Entretien de communication', 3, 2, 2);

-- Impôts et taxes
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('635', 'Impôts et taxes', 3, 2, 2);

-- Charges personnels
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('6411', 'Charges personnels', 8, 2, 2);

-- CNAPS et OSTIE
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('645', 'CNAPS et OSTIE', 8, 2, 2);

-- Frais de transport
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('6241', 'Frais de transport', 3, 1, 1);

-- Emballage
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('6026', 'Emballage', 10, 1, 1);

-- Frais de communication
INSERT INTO section(no_account, label, id_unit, id_nature, id_incorporation) 
VALUES ('626', 'Frais de communication', 3, 2, 2);




--Loyer 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('613', 1, 'Loyer', 0, 600000, '2024-09-30'); 

--Amortissement 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('6811', 1, 'Amortissement', 0, 200000, '2024-09-30'); 

--Cuir 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('601', 1, 'Cuir', 0, 1200000, '2024-09-30'); 

--Salaire Admin 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('6411', 1, 'Salaire Admin', 0, 1000000, '2024-09-30'); 

--Assurances 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('616', 1, 'Assurances', 0, 200000, '2024-09-30'); 

--Charges supplétives 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('0000', 1, 'Charges supplétives', 0, 200000, '2024-09-30'); 

--Fils 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('601', 1, 'Fils', 0, 300000, '2024-09-30'); 

--Fermois 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('601', 1, 'Fermois', 0, 400000, '2024-09-30'); 

--Accessoires 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('606', 1, 'Accessoires', 0, 200000, '2024-09-30'); 

--Main d'œuvre directe 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('6411', 1, 'Main d''oeuvre directe', 0, 1500000, '2024-09-30'); 

--Eau et électricité 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('6061', 1, 'Eau et électricité', 0, 100000, '2024-09-30'); 

--Entretien de communication 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('6155', 1, 'Entretien de communication', 0, 100000, '2024-09-30'); 

--Impôts et taxes 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('635', 1, 'Impôts et taxes', 0, 300000, '2024-09-30'); 

--Charges personnels 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('6411', 1, 'Charges personnels', 0, 200000, '2024-09-30'); 

--CNAPS et OSTIE 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('645', 1, 'CNAPS et OSTIE', 0, 100000, '2024-09-30'); 

--Frais de transport 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('6241', 1, 'Frais de transport', 0, 200000, '2024-09-30'); 

--Emballage 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('6026', 1, 'Emballage', 0, 100000, '2024-09-30'); 

--Frais de communication 
INSERT INTO exercice(no_account, id_exercice_year, label, credit, debit, date)  
VALUES ('626', 1, 'Frais de communication', 0, 100000, '2024-09-30');

-- expense
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES( 1,  1, 1,  1500000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES( 2,  2, 1,  3000000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES( 3,  3, 1,  5000000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES( 4,  4, 1,  2500000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES( 5,  5, 1,  1200000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES( 6,  6, 1,   500000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES( 7,  7, 1,  1000000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES( 8,  8, 1,   800000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES( 9,  9, 1,   600000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES(10, 10, 1,  4000000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES(11, 11, 1,  1200000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES(12, 12, 1,   300000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES(13, 13, 1,  1000000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES(14, 14, 1,  2500000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES(15, 15, 1,   800000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES(16, 16, 1,   700000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES(17, 17, 1,   400000.0, '2024-09-20');
INSERT INTO expense(id_section, id_exercice, quantity, price, date) VALUES(18, 18, 1,   500000.0, '2024-09-20');

INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 1, 1, 1.00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 2, 1,  .50);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 3, 1, 1.00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 4, 1, 1.00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 5, 1,  .00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 6, 1, 1.00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 7, 1, 1.00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 8, 1, 1.00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 9, 1, 1.00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(10, 1,  .50);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(11, 1,  .00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(12, 1,  .00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(13, 1,  .00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(14, 1,  .00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(15, 1,  .00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(16, 1, 1.00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(17, 1,  .00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(18, 1,  .00);

INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 1, 2,  .00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 2, 2,  .50);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 3, 2,  .00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 4, 2,  .00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 5, 2, 1.00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 6, 2,  .00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 7, 2,  .00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 8, 2,  .00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES( 9, 2,  .00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(10, 2,  .50);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(11, 2, 1.00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(12, 2, 1.00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(13, 2, 1.00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(14, 2, 1.00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(15, 2, 1.00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(16, 2,  .00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(17, 2, 1.00);
INSERT INTO expense_center(id_expense, id_center, percentage) VALUES(18, 2, 1.00);

-- suppliers
INSERT INTO suppliers (name, contact_info) VALUES 
('Supplier A', 'contact@supplierone.com'),
('Supplier B', 'support@suppliertwo.com'),
('Supplier C', 'info@supplierthree.com'),
('Supplier D', 'sales@supplierfour.com'),
('Supplier E', 'hello@supplierfive.com');

-- customers
INSERT INTO customers (name, email) VALUES 
('Alice Johnson', 'alice.johnson@example.com'),
('Bob Smith', 'bob.smith@example.com'),
('Charlie Brown', 'charlie.brown@example.com'),
('Diana Prince', 'diana.prince@example.com'),
('Ethan Hunt', 'ethan.hunt@example.com');