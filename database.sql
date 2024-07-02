CREATE DATABASE immo;
USE immo;

CREATE TABLE admin (
  id_admin INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(50),
  mdp VARCHAR(30)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE proprietaire (
  id_proprietaire INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  tel VARCHAR(30)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE client (
  id_client INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(30)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE type_bien (
  id_type_bien INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(50),
  commission DECIMAL(5, 2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE bien (
  id_bien INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(30),
  description VARCHAR(200),
  region VARCHAR(200),
  loyer_mois INT,
  id_proprietaire INT,
  id_type_bien INT,
  reference VARCHAR(30),
  FOREIGN KEY (id_proprietaire) REFERENCES proprietaire(id_proprietaire),
  FOREIGN KEY (id_type_bien) REFERENCES type_bien(id_type_bien)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE photo (
  id_photo INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  id_bien INT,
  photo_url VARCHAR(100),
  FOREIGN KEY (id_bien) REFERENCES bien(id_bien)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE location (
  id_location INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  id_bien INT,
  id_client INT,
  date_debut DATE,
  date_fin_prevu DATE,
  date_fin_reelle DATE,
  duree_mois INT,
  disponibilite DATE,
  FOREIGN KEY (id_bien) REFERENCES bien(id_bien),
  FOREIGN KEY (id_client) REFERENCES client(id_client)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE VIEW v_date_fin_prevu AS
SELECT 
  id_location,
  id_bien,
  id_client,
  date_debut,
  DATE_ADD(date_debut, INTERVAL duree_mois MONTH) AS date_fin_prevu,
  date_fin_reelle,
  duree_mois
FROM 
  location;


CREATE TABLE paiement (
  id_paiement INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  id_location INT,
  date_paiement DATE,
  loyer_a_payer INT,
  loyer_paye INT,
  FOREIGN KEY (id_location) REFERENCES location(id_location)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE vente (
  id_vente INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  id_bien INT,
  id_client INT,
  date_vente DATE,
  montant INT,
  FOREIGN KEY (id_bien) REFERENCES bien(id_bien),
  FOREIGN KEY (id_client) REFERENCES client(id_client)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO admin (email, mdp) VALUES ('admin@example.com', 'mdp');

INSERT INTO proprietaire (tel) VALUES 
('0349829346'),
('0348526345');

INSERT INTO client (email) VALUES 
('client1@example.com'),
('client2@example.com');

INSERT INTO type_bien (nom, commission) VALUES 
('Maison', 5),
('Appartement', 3),
('Villa', 7),
('Immeuble', 4),
('Studio', 2),
('Bungalow', 6),
('Chalet', 8);

INSERT INTO bien (nom, description, region, loyer_mois, id_proprietaire, id_type_bien) VALUES 
('Maison de campagne', 'Belle maison de campagne avec jardin', 'Itasy', 1200, 1, 1),
('Appartement moderne', 'Appartement moderne au centre-ville', 'Antananarivo', 800, 2, 2),
('Villa luxueuse', 'Villa avec piscine et vue sur la mer', 'Nosy Be', 3000, 1, 3),
('Immeuble résidentiel', 'Immeuble avec plusieurs appartements', 'Fianarantsoa', 5000, 2, 4),
('Studio cosy', 'Petit studio idéal pour étudiant', 'Toamasina', 400, 1, 5),
('Bungalow charmant', 'Bungalow proche de la plage', 'Mahajanga', 1000, 2, 6),
('Chalet en montagne', 'Chalet confortable en montagne', 'Andringitra', 1500, 1, 7);

INSERT INTO photo (id_bien, photo_url) VALUES 
(1, 'assets/images/maison/maisoncampagne.jpg'),
(2, 'assets/images/maison/appartementmoderne.jpg'),
(3, 'assets/images/maison/villaluxueuse.jpg'),
(4, 'assets/images/maison/immeuble.jpg'),
(5, 'assets/images/maison/studiocosy.jpg'),
(6, 'assets/images/maison/bungalow.jpg'),
(7, 'assets/images/maison/chalet.jpg');

INSERT INTO photo (id_bien, photo_url) VALUES 
(1, 'assets/images/maison/maisoncampagne2.jpg')

 INSERT INTO location (id_bien, id_client, date_debut, date_fin_prevu, duree_mois) VALUES
    (1, 1, '2024-05-29', '2024-06-29', 1);

SELECT bien.*, photo.photo_url
FROM bien
LEFT JOIN photo ON bien.id_bien = photo.id_bien
WHERE bien.id_proprietaire = 1;

-- chiffre d'affaire admin tode izy mianakavy 
 SELECT
    DATE_FORMAT(l.date_debut, '%Y-%m') AS mois,
    SUM(b.loyer_mois * l.duree_mois) AS chiffre_affaires_mensuel
FROM
    location l
JOIN
    bien b ON l.id_bien = b.id_bien
WHERE
    l.date_debut >= '2024-06-29'
    AND l.date_fin_prevu <= '2024-08-29'
GROUP BY
    mois
ORDER BY
    mois;

-- chiffre d'affaire admin milahatra
SELECT
    DATE_FORMAT(l.date_fin_prevu, '%Y-%m') AS mois,
    SUM(b.loyer_mois * l.duree_mois) AS total_rent
FROM
    location l
JOIN
    bien b ON l.id_bien = b.id_bien
WHERE
    l.date_debut >= '2024-06-29'
    AND l.date_fin_prevu <= '2024-08-29'
GROUP BY
    mois
ORDER BY
    mois ASC;

-- chiffre d'affaire admin milahatra année mois fotsiny 
SELECT
    DATE_FORMAT(l.date_fin_prevu, '%Y-%m') AS mois,
    SUM(b.loyer_mois * l.duree_mois) AS total_rent
FROM
    location l
JOIN
    bien b ON l.id_bien = b.id_bien
WHERE
    DATE_FORMAT(l.date_debut, '%Y-%m') >= '2024-06'
    AND DATE_FORMAT(l.date_fin_prevu, '%Y-%m') <= '2024-08'
GROUP BY
    mois
ORDER BY
    mois ASC;

-- chiffre d'affaire et gain admin milahatra année mois fotsiny 
SELECT
    DATE_FORMAT(l.date_fin_prevu, '%Y-%m') AS mois,
    SUM(b.loyer_mois * l.duree_mois) AS total_rent,
    SUM(b.loyer_mois * l.duree_mois * tb.commission / 100) AS gain
FROM
    v_date_fin_prevu l
JOIN
    bien b ON l.id_bien = b.id_bien
JOIN
    type_bien tb ON b.id_type_bien = tb.id_type_bien
WHERE
    DATE_FORMAT(l.date_debut, '%Y-%m') >= '2024-03'
    AND DATE_FORMAT(l.date_fin_prevu, '%Y-%m') <= '2024-06'
GROUP BY
    mois
ORDER BY                   
    mois ASC;


SELECT 
  SUM(
    CASE 
      WHEN date_fin_reelle IS NOT NULL AND date_fin_reelle <= '2024-06-17' THEN 
        TIMESTAMPDIFF(MONTH, GREATEST(date_debut, '2024-03-13'), LEAST(date_fin_reelle, '2024-06-17')) * b.loyer_mois
      ELSE 
        TIMESTAMPDIFF(MONTH, GREATEST(date_debut, '2024-03-13'), LEAST(DATE_ADD(date_debut, INTERVAL duree_mois MONTH), '2024-06-17')) * b.loyer_mois
    END
  ) AS chiffre_affaire
FROM 
  location l
JOIN 
  bien b ON l.id_bien = b.id_bien
WHERE 
  date_debut <= '2024-06-17'
  AND (date_fin_reelle IS NULL OR date_fin_reelle >= '2024-03-13')
  AND date_debut <= '2024-06-17';

  SELECT 
  DATE_FORMAT(DATE(GREATEST(date_debut, '2024-03-13')), '%Y-%m') AS mois,
  SUM(
    CASE 
      WHEN date_fin_prevu IS NOT NULL AND date_fin_prevu <= '2024-06-17' THEN 
        TIMESTAMPDIFF(MONTH, GREATEST(date_debut, '2024-03-13'), LEAST(date_fin_prevu, '2024-06-17')) * b.loyer_mois
      ELSE 
        TIMESTAMPDIFF(MONTH, GREATEST(date_debut, '2024-03-13'), LEAST(DATE_ADD(date_debut, INTERVAL duree_mois MONTH), '2024-06-17')) * b.loyer_mois
    END
  ) AS chiffre_affaire
FROM 
  v_date_fin_prevu l
JOIN 
  bien b ON l.id_bien = b.id_bien
WHERE 
  date_debut <= '2024-06-17'
  AND (date_fin_prevu IS NULL OR date_fin_prevu >= '2024-03-13')
GROUP BY 
  mois
ORDER BY 
  mois;



-- chiffre d'affaire et gain admin milahatra année mois fotsiny 
SELECT
    DATE_FORMAT(l.date_fin_prevu, '%Y-%m-%d') AS mois,
    SUM(b.loyer_mois * l.duree_mois) AS total_rent,
    SUM(b.loyer_mois * l.duree_mois * tb.commission / 100) AS gain
FROM
    v_date_fin_prevu l
JOIN
    bien b ON l.id_bien = b.id_bien
JOIN
    type_bien tb ON b.id_type_bien = tb.id_type_bien
WHERE
    l.date_debut >= '2024-03-13'
    AND l.date_fin_prevu <= '2024-06-17'
GROUP BY
    date_fin_prevu
ORDER BY
    date_fin_prevu ASC;


-- chiffre d'affaire propriétaire
SELECT
    DATE_FORMAT(l.date_fin_prevu, '%Y-%m') AS mois,
    SUM(b.loyer_mois * l.duree_mois) AS chiffre_affaires
FROM
    location l
JOIN
    bien b ON l.id_bien = b.id_bien
JOIN
    type_bien tb ON b.id_type_bien = tb.id_type_bien
WHERE
    b.id_proprietaire = 1
    AND DATE_FORMAT(l.date_debut, '%Y-%m') >= '2024-06'
    AND DATE_FORMAT(l.date_fin_prevu, '%Y-%m') <= '2024-07'
GROUP BY
    mois
ORDER BY
    mois DESC;

-- loyer à payer et payé avec paiement
SELECT
    c.email,
    DATE_FORMAT(p.date_paiement, '%Y-%m') AS mois,
    p.loyer_a_payer,
    p.loyer_paye
FROM
    client c
JOIN
    location l ON c.id_client = l.id_client
JOIN
    bien b ON l.id_bien = b.id_bien
JOIN
    paiement p ON l.id_location = p.id_location
WHERE
    c.id_client = 1
    AND DATE_FORMAT(p.date_paiement, '%Y-%m') >= '2024-06'
    AND DATE_FORMAT(p.date_paiement, '%Y-%m') <= '2024-08'
ORDER BY
    mois ASC;

-- loyer à payé et payé sans paiement SELECT 
SELECT 
    b.nom AS property_name, 
    DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) AS datepaiement, 
    b.loyer_mois AS montant, 
    CASE 
        WHEN DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) <= CURRENT_DATE THEN 'paid'
        ELSE 'unpaid'
    END AS status
FROM 
    (SELECT 1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL 
     SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL 
     SELECT 11 UNION ALL SELECT 12) AS n
JOIN 
    location l ON n.n <= l.duree_mois
JOIN 
    bien b ON l.id_bien = b.id_bien
WHERE 
    l.id_client = 1
    AND DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) BETWEEN '2024-05-06' AND '2024-08-29'
ORDER BY 
    datepaiement ASC;

-- ilay fois 2
SELECT 
    b.nom AS property_name, 
    DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) AS datepaiement, 
    CASE 
        WHEN n.n = 1 THEN b.loyer_mois * 2
        ELSE b.loyer_mois
    END AS montant, 
    CASE 
        WHEN DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) <= CURRENT_DATE THEN 'paid'
        ELSE 'unpaid'
    END AS status,
    CASE 
        WHEN DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) <= CURRENT_DATE THEN 0
        ELSE CASE 
            WHEN n.n = 1 THEN b.loyer_mois * 2
            ELSE b.loyer_mois
        END
    END AS prix_a_payer_ou_restant
FROM 
    (SELECT 1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL 
     SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL 
     SELECT 11 UNION ALL SELECT 12) AS n
JOIN 
    location l ON n.n <= l.duree_mois
JOIN 
    bien b ON l.id_bien = b.id_bien
WHERE 
    l.id_client = 4
    AND DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) BETWEEN '2024-01-01' AND '2024-12-01'
ORDER BY 
    datepaiement ASC;


-- loyer à payer et payé sans paiement misy montant
SELECT 
    b.nom AS property_name, 
    DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) AS datepaiement, 
    b.loyer_mois AS montant, 
    CASE 
        WHEN DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) <= CURRENT_DATE THEN 'paid'
        ELSE 'unpaid'
    END AS status,
    CASE 
        WHEN DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) <= CURRENT_DATE THEN 0
        ELSE b.loyer_mois
    END AS montant_a_payer
FROM 
    (SELECT 1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL 
     SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL 
     SELECT 11 UNION ALL SELECT 12) AS n
JOIN 
    location l ON n.n <= l.duree_mois
JOIN 
    bien b ON l.id_bien = b.id_bien
WHERE 
    l.id_client = 1
    AND DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) BETWEEN '2024-05-06' AND '2024-08-29'
ORDER BY 
    datepaiement ASC;


-- loyer à payer et payé sans paiement misy montant sy le prix restant si c'est déjà payé 
SELECT 
    b.nom AS property_name, 
    DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) AS datepaiement, 
    b.loyer_mois AS montant, 
    CASE 
        WHEN DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) <= CURRENT_DATE THEN 'paid'
        ELSE 'unpaid'
    END AS status,
    CASE 
        WHEN DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) <= CURRENT_DATE THEN 0
        ELSE b.loyer_mois
    END AS prix_a_payer_ou_restant
FROM 
    (SELECT 1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL 
     SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL 
     SELECT 11 UNION ALL SELECT 12) AS n
JOIN 
    location l ON n.n <= l.duree_mois
JOIN 
    bien b ON l.id_bien = b.id_bien
WHERE 
    l.id_client = 1
    AND DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) BETWEEN '2024-05-06' AND '2024-08-29'
ORDER BY 
    datepaiement ASC;

-- loyer à payer et payé sans paiement misy montant sy le prix restant si c'est déjà payé sans définir le jour
SELECT 
    b.nom AS property_name, 
    DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) AS datepaiement, 
    b.loyer_mois AS montant, 
    CASE 
        WHEN DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) <= CURRENT_DATE THEN 'paid'
        ELSE 'unpaid'
    END AS status,
    CASE 
        WHEN DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) <= CURRENT_DATE THEN 0
        ELSE b.loyer_mois
    END AS prix_a_payer_ou_restant
FROM 
    (SELECT 1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL 
     SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL 
     SELECT 11 UNION ALL SELECT 12) AS n
JOIN 
    location l ON n.n <= l.duree_mois
JOIN 
    bien b ON l.id_bien = b.id_bien
WHERE 
    l.id_client = 1
    AND DATE_FORMAT(l.date_debut, '%Y-%m') <= '2024-08'
    AND DATE_FORMAT(l.date_fin_prevu, '%Y-%m') >= '2024-05'
ORDER BY 
    datepaiement ASC;


-- données de test
INSERT INTO type_bien (nom, commission) VALUES
('maison', 5),
('appartement', 10),
('batiment', 10),
('villa', 20);

INSERT INTO bien (nom, description, region, loyer_mois, id_proprietaire, id_type_bien) VALUES
('maison de vacances','Belle maison de campagne avec jardin', 'Mahajanga', 200000, 1, 1),
('maison de campagne', 'Belle maison de campagne avec jardin','Antananarivo', 150000, 1, 1),
('appart de lux', 'Belle maison de campagne avec jardin','Antananarivo', 400000, 2, 2),
('villa bleu', 'Belle maison de campagne avec jardin','Toamasina', 500000, 3, 4),
('batiment A', 'Belle maison de campagne avec jardin','Antananarivo', 700000, 2, 3);

INSERT INTO location (id_bien, id_client, date_debut, duree_mois) VALUES
(1, 1, '2024-02-10', 4),
(3, 3, '2024-05-15', 5),
(4, 1, '2024-05-01', 3),
(5, 2, '2024-06-30', 2),
(2, 2, '2024-03-07', 1),
(2, 3, '2024-05-07', 3);


CREATE TABLE dates (
    date DATE
);

-- Ajouter des dates à la table (par exemple, pour les années 2024-2025)
INSERT INTO dates (date)
SELECT DATE_ADD('2024-01-01', INTERVAL t4*1000 + t3*100 + t2*10 + t1 DAY) as date
FROM 
    (SELECT 0 t1 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t1,
    (SELECT 0 t2 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t2,
    (SELECT 0 t3 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t3,
    (SELECT 0 t4 UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t4
WHERE DATE_ADD('2024-01-01', INTERVAL t4*1000 + t3*100 + t2*10 + t1 DAY) <= '2025-12-31';

SELECT DATE_FORMAT(d.date, '%m/%Y') AS mois, 
       COALESCE(SUM(b.loyer_mois * l.duree_mois), 0) AS ca
FROM (SELECT DISTINCT DATE_FORMAT(date, '%Y-%m-01') as date
      FROM dates
      WHERE date BETWEEN '2024-03-13' AND '2024-06-17') d
LEFT JOIN location l ON DATE_FORMAT(l.date_debut, '%Y-%m-01') = d.date
LEFT JOIN bien b ON l.id_bien = b.id_bien
GROUP BY d.date
ORDER BY d.date;


-- requete marina tsy misy chiffre d'affaire 
SELECT
    l.id_location,
    l.id_bien,
    l.id_client,
    l.date_debut,
    l.duree_mois,
    b.loyer_mois,
    CASE 
        WHEN l.duree_mois = 1 THEN b.loyer_mois
        ELSE b.loyer_mois * l.duree_mois
    END AS total_rental_price,
    b.loyer_mois AS monthly_rental_price
FROM
    location l
JOIN
    bien b ON l.id_bien = b.id_bien;





-- Requête pour calculer le chiffre d'affaires par mois -- Créez une table de nombres pour générer les mois
CREATE TEMPORARY TABLE numbers (n INT);
INSERT INTO numbers (n) VALUES (0), (1), (2), (3), (4), (5), (6), (7), (8), (9), (10), (11);

SELECT
    DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') AS month,
    SUM(b.loyer_mois) AS chiffre_affaire
FROM
    location l
JOIN
    bien b ON l.id_bien = b.id_bien
JOIN
    numbers ON numbers.n < l.duree_mois
GROUP BY
    month
ORDER BY
    month;

 SELECT
    DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') AS month,
    SUM(b.loyer_mois) AS chiffre_affaire
FROM
    location l
JOIN
    bien b ON l.id_bien = b.id_bien
JOIN
    numbers ON numbers.n < l.duree_mois
GROUP BY
    month
ORDER BY
    month;

-- ohatrany ty no marina 
CREATE TEMPORARY TABLE numbers (n INT);
INSERT INTO numbers (n) VALUES (0), (1), (2), (3), (4), (5), (6), (7), (8), (9), (10), (11);

SELECT
    l.id_location,
    l.id_bien,
    l.id_client,
    l.date_debut,
    l.duree_mois,
    b.loyer_mois,
    b.loyer_mois * l.duree_mois AS total_rental_price,
    b.loyer_mois AS monthly_rental_price,
    DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') AS month,
    b.loyer_mois AS chiffre_affaire_mensuel
FROM
    location l
JOIN
    bien b ON l.id_bien = b.id_bien
JOIN
    numbers ON numbers.n < l.duree_mois
ORDER BY
    month;
+-------------+---------+-----------+------------+------------+------------+--------------------+----------------------+---------+-------------------------+
| id_location | id_bien | id_client | date_debut | duree_mois | loyer_mois | total_rental_price | monthly_rental_price | month   | chiffre_affaire_mensuel |
+-------------+---------+-----------+------------+------------+------------+--------------------+----------------------+---------+-------------------------+
|           1 |       1 |         1 | 2024-02-10 |          4 |     200000 |             800000 |               200000 | 2024-02 |                  200000 |
|           5 |       2 |         2 | 2024-03-07 |          1 |     150000 |             150000 |               150000 | 2024-03 |                  150000 |
|           1 |       1 |         1 | 2024-02-10 |          4 |     200000 |             800000 |               200000 | 2024-03 |                  200000 |
|           1 |       1 |         1 | 2024-02-10 |          4 |     200000 |             800000 |               200000 | 2024-04 |                  200000 |
|           6 |       2 |         3 | 2024-05-07 |          3 |     150000 |             450000 |               150000 | 2024-05 |                  150000 |
|           1 |       1 |         1 | 2024-02-10 |          4 |     200000 |             800000 |               200000 | 2024-05 |                  200000 |
|           2 |       3 |         3 | 2024-05-15 |          5 |     400000 |            2000000 |               400000 | 2024-05 |                  400000 |
|           3 |       4 |         1 | 2024-05-01 |          3 |     500000 |            1500000 |               500000 | 2024-05 |                  500000 |
|           4 |       5 |         2 | 2024-06-30 |          2 |     700000 |            1400000 |               700000 | 2024-06 |                  700000 |
|           3 |       4 |         1 | 2024-05-01 |          3 |     500000 |            1500000 |               500000 | 2024-06 |                  500000 |
|           6 |       2 |         3 | 2024-05-07 |          3 |     150000 |             450000 |               150000 | 2024-06 |                  150000 |
|           2 |       3 |         3 | 2024-05-15 |          5 |     400000 |            2000000 |               400000 | 2024-06 |                  400000 |
|           3 |       4 |         1 | 2024-05-01 |          3 |     500000 |            1500000 |               500000 | 2024-07 |                  500000 |
|           4 |       5 |         2 | 2024-06-30 |          2 |     700000 |            1400000 |               700000 | 2024-07 |                  700000 |
|           6 |       2 |         3 | 2024-05-07 |          3 |     150000 |             450000 |               150000 | 2024-07 |                  150000 |
|           2 |       3 |         3 | 2024-05-15 |          5 |     400000 |            2000000 |               400000 | 2024-07 |                  400000 |
|           2 |       3 |         3 | 2024-05-15 |          5 |     400000 |            2000000 |               400000 | 2024-08 |                  400000 |
|           2 |       3 |         3 | 2024-05-15 |          5 |     400000 |            2000000 |               400000 | 2024-09 |                  400000 |
+-------------+---------+-----------+------------+------------+------------+--------------------+----------------------+---------+-------------------------+
18 rows in set (0.01 sec)

SELECT
    DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') AS month,
    SUM(b.loyer_mois) AS chiffre_affaire_mensuel
FROM
    location l
JOIN
    bien b ON l.id_bien = b.id_bien
JOIN
    numbers ON numbers.n < l.duree_mois
GROUP BY
    month
ORDER BY
    month;
+---------+-------------------------+
| month   | chiffre_affaire_mensuel |
+---------+-------------------------+
| 2024-02 |                  200000 |
| 2024-03 |                  350000 |
| 2024-04 |                  200000 |
| 2024-05 |                 1250000 | 
| 2024-06 |                 1750000 |
| 2024-07 |                 1750000 |
| 2024-08 |                  400000 |
| 2024-09 |                  400000 |
+---------+-------------------------+
-- filtre chiffre d'affaire
SELECT
    DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') AS month,
    SUM(b.loyer_mois) AS chiffre_affaire_mensuel
FROM
    location l
JOIN
    bien b ON l.id_bien = b.id_bien
JOIN
    numbers ON numbers.n < l.duree_mois
WHERE
    DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') BETWEEN '2024-03' AND '2024-06'
GROUP BY
    month
ORDER BY
    month;

-- rank détails location par location 
SELECT
    l.id_location,
    l.id_client,
    b.nom,
    DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') AS month,
    b.loyer_mois
FROM
    location l
JOIN
    bien b ON l.id_bien = b.id_bien
JOIN
    numbers ON numbers.n < l.duree_mois
ORDER BY
    l.id_location,
    month;

+-------------+-----------+--------------------+---------+------------+
| id_location | id_client | nom                | month   | loyer_mois |
+-------------+-----------+--------------------+---------+------------+
|           1 |         1 | maison de vacances | 2024-02 |     200000 |
|           1 |         1 | maison de vacances | 2024-03 |     200000 |
|           1 |         1 | maison de vacances | 2024-04 |     200000 |
|           1 |         1 | maison de vacances | 2024-05 |     200000 |
|           2 |         3 | appart de lux      | 2024-05 |     400000 |
|           2 |         3 | appart de lux      | 2024-06 |     400000 |
|           2 |         3 | appart de lux      | 2024-07 |     400000 |
|           2 |         3 | appart de lux      | 2024-08 |     400000 |
|           2 |         3 | appart de lux      | 2024-09 |     400000 |
|           3 |         1 | villa bleu         | 2024-05 |     500000 |
|           3 |         1 | villa bleu         | 2024-06 |     500000 |
|           3 |         1 | villa bleu         | 2024-07 |     500000 |
|           4 |         2 | batiment A         | 2024-06 |     700000 |
|           4 |         2 | batiment A         | 2024-07 |     700000 |
|           5 |         2 | maison de campagne | 2024-03 |     150000 |
|           6 |         3 | maison de campagne | 2024-05 |     150000 |
|           6 |         3 | maison de campagne | 2024-06 |     150000 |
|           6 |         3 | maison de campagne | 2024-07 |     150000 |
+-------------+-----------+--------------------+---------+------------+


-- gain avec filtre 
 SELECT
    l.id_location,
    l.id_client,
    b.nom AS bien_nom,
    DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') AS month,
    b.loyer_mois,
    IF(numbers.n = 0, b.loyer_mois, b.loyer_mois * (tb.commission / 100)) AS gain
FROM
    location l
JOIN
    bien b ON l.id_bien = b.id_bien
JOIN
    type_bien tb ON b.id_type_bien = tb.id_type_bien
JOIN
    numbers ON numbers.n < l.duree_mois
WHERE
    DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') BETWEEN '2024-03' AND '2024-06'
ORDER BY
    l.id_location,
    month;

+-------------+-----------+--------------------+---------+------------+---------------+
| id_location | id_client | bien_nom           | month   | loyer_mois | gain          |
+-------------+-----------+--------------------+---------+------------+---------------+
|           1 |         1 | maison de vacances | 2024-02 |     200000 | 200000.000000 |
|           1 |         1 | maison de vacances | 2024-03 |     200000 |  10000.000000 |
|           1 |         1 | maison de vacances | 2024-04 |     200000 |  10000.000000 |
|           1 |         1 | maison de vacances | 2024-05 |     200000 |  10000.000000 |
|           2 |         3 | appart de lux      | 2024-05 |     400000 | 400000.000000 |
|           2 |         3 | appart de lux      | 2024-06 |     400000 |  40000.000000 |
|           2 |         3 | appart de lux      | 2024-07 |     400000 |  40000.000000 |
|           2 |         3 | appart de lux      | 2024-08 |     400000 |  40000.000000 |
|           2 |         3 | appart de lux      | 2024-09 |     400000 |  40000.000000 |
|           3 |         1 | villa bleu         | 2024-05 |     500000 | 500000.000000 |
|           3 |         1 | villa bleu         | 2024-06 |     500000 | 100000.000000 |
|           3 |         1 | villa bleu         | 2024-07 |     500000 | 100000.000000 |
|           4 |         2 | batiment A         | 2024-06 |     700000 | 700000.000000 |
|           4 |         2 | batiment A         | 2024-07 |     700000 |  70000.000000 |
|           5 |         2 | maison de campagne | 2024-03 |     150000 | 150000.000000 |
|           6 |         3 | maison de campagne | 2024-05 |     150000 | 150000.000000 |
|           6 |         3 | maison de campagne | 2024-06 |     150000 |   7500.000000 |
|           6 |         3 | maison de campagne | 2024-07 |     150000 |   7500.000000 |
+-------------+-----------+--------------------+---------+------------+---------------+

-- chiffre d'affaire et gain admin vrai
SELECT
    DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') AS month,
    SUM(IF(numbers.n = 0, b.loyer_mois, b.loyer_mois * (tb.commission / 100))) AS total_gain,
    SUM(b.loyer_mois) AS total_loyer_mensuel
FROM
    location l
JOIN
    bien b ON l.id_bien = b.id_bien
JOIN
    type_bien tb ON b.id_type_bien = tb.id_type_bien
JOIN
    (SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4
     UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
     UNION ALL SELECT 10 UNION ALL SELECT 11) numbers ON numbers.n < l.duree_mois
WHERE
    DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') BETWEEN '2024-03' AND '2024-06'
GROUP BY
    month
ORDER BY
    month;


-- filtre chiffre d'affaire proprio et gain proprio vrai
SELECT
    p.id_proprietaire,
    DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') AS month,
    SUM(IF(numbers.n = 0, b.loyer_mois, b.loyer_mois * (1 - tb.commission / 100))) AS total_gain,
    SUM(b.loyer_mois) AS chiffre_affaire_mensuel
FROM
    location l
JOIN
    bien b ON l.id_bien = b.id_bien
JOIN
    type_bien tb ON b.id_type_bien = tb.id_type_bien
JOIN
    proprietaire p ON b.id_proprietaire = p.id_proprietaire
JOIN
    (SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11) numbers
    ON numbers.n < l.duree_mois
WHERE
    p.id_proprietaire = 1 AND
    DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') BETWEEN '2024-03' AND '2024-06'
GROUP BY
    p.id_proprietaire,
    month
ORDER BY
    month;

-- filtre chiffre affaire  vrai
SELECT
    p.id_proprietaire,
    DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') AS month,
    SUM(b.loyer_mois) AS chiffre_affaire_mensuel
FROM
    location l
JOIN
    bien b ON l.id_bien = b.id_bien
JOIN
    proprietaire p ON b.id_proprietaire = p.id_proprietaire
JOIN
    (SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11) numbers
    ON numbers.n < l.duree_mois
WHERE
    p.id_proprietaire = 1 AND
    DATE_FORMAT(DATE_ADD(l.date_debut, INTERVAL numbers.n MONTH), '%Y-%m') BETWEEN '2024-03' AND '2024-06'
GROUP BY
    p.id_proprietaire,
    month
ORDER BY
    month;

-- vérification import bien
SELECT b.reference, b.nom, b.description, tb.nom AS type, b.region, b.loyer_mois, p.tel AS proprietaire
FROM bien b
JOIN type_bien tb ON b.id_type_bien = tb.id_type_bien
JOIN proprietaire p ON b.id_proprietaire = p.id_proprietaire
WHERE b.reference IN ('V110', 'V130', 'M340', 'I003');
-- vérification import location
SELECT 
    l.id_location,
    l.date_debut,
    l.duree_mois,
    l.date_fin_prevu,
    c.email AS client_email,
    b.reference AS bien_reference
FROM 
    location l
JOIN 
    client c ON l.id_client = c.id_client
JOIN 
    bien b ON l.id_bien = b.id_bien;


-- mitady disponibilité tode colonne be dia be amin'izay hita hoe tena marina
 SELECT
b.id_bien,
b.nom,
b.description,
b.region,
b.loyer_mois,
b.id_proprietaire,
b.id_type_bien,
l.date_debut,
l.date_fin_prevu,
l.duree_mois,
l.disponibilite
FROM
bien b
LEFT JOIN
location l ON b.id_bien = l.id_bien
WHERE
l.disponibilite IS NOT NULL;
+---------+---------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+--------+------------+-----------------+--------------+------------+----------------+------------+---------------+
| id_bien | nom                       | description                                                                                                                                                                             | region | loyer_mois | id_proprietaire | id_type_bien | date_debut | date_fin_prevu | duree_mois | disponibilite |
+---------+---------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+--------+------------+-----------------+--------------+------------+----------------+------------+---------------+
|       1 | Villa luxe en bord de mer | Magnifique villa de 250 m² avec vue imprenable sur la mer. Elle comprend 5 chambres, un grand séjour, une cuisine haut de gamme, et une piscine à débordement. Accès direct à la plage. | Boeny  |    1890000 |               1 |            1 | 2024-01-01 | 2024-04-01     |          3 | 2024-04-02    |
+---------+---------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+--------+------------+-----------------+--------------+------------+----------------+------------+---------------+

-- anaovana liste des biens miaraka disponibilité 
SELECT
  b.id_bien,
  b.nom AS nom_bien,
  b.description,
  b.region,
  b.loyer_mois,
  p.tel AS tel_proprietaire,
  t.nom AS type_bien,
  COALESCE(l.disponibilite, 'Disponible') AS disponibilite,
  ph.photo_url
FROM
  bien b
LEFT JOIN
  location l ON b.id_bien = l.id_bien
LEFT JOIN
  proprietaire p ON b.id_proprietaire = p.id_proprietaire
LEFT JOIN
  type_bien t ON b.id_type_bien = t.id_type_bien
LEFT JOIN
  photo ph ON b.id_bien = ph.id_bien
ORDER BY
  b.id_bien;

-- details location
SELECT 
    b.nom AS designation, 
    b.loyer_mois, 
    DATE_ADD(l.date_debut, INTERVAL (n.n - 1) MONTH) AS mois, 
    CASE 
        WHEN n.n = 1 THEN '100%'
        ELSE CONCAT(t.commission, '%')
    END AS commission,
    n.n AS num_mois_location,
    CASE 
        WHEN n.n = 1 THEN b.loyer_mois
        ELSE b.loyer_mois * t.commission / 100
    END AS valeur_commission,
    CASE 
        WHEN n.n = 1 THEN b.loyer_mois * 2
        ELSE b.loyer_mois
    END AS loyer_du_mois
FROM 
    (SELECT 1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL 
     SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL 
     SELECT 11 UNION ALL SELECT 12) AS n
JOIN 
    location l ON n.n <= l.duree_mois
JOIN 
    bien b ON l.id_bien = b.id_bien
JOIN
    type_bien t ON b.id_type_bien = t.id_type_bien
ORDER BY 
    l.id_location, mois ASC;

-- requete mi calcul fin mois ho tode farany iny
UPDATE location
SET date_fin_prevu = DATE_FORMAT(LAST_DAY(DATE_ADD(date_debut, INTERVAL duree_mois - 1 MONTH)), '%Y-%m-%d');

-- disponibilité proprio vrai
SELECT 
    b.id_bien, 
    b.nom, 
    b.description, 
    b.region, 
    b.loyer_mois, 
    MAX(l.date_fin_prevu) AS date_fin_prevu, 
    DATE_ADD(MAX(l.date_fin_prevu), INTERVAL 1 DAY) AS disponibilite
FROM 
    bien b
LEFT JOIN 
    location l ON b.id_bien = l.id_bien
WHERE 
    b.id_proprietaire = 1
GROUP BY 
    b.id_bien, 
    b.nom, 
    b.description, 
    b.region, 
    b.loyer_mois
ORDER BY 
    b.nom;


