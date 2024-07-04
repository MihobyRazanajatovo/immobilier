CREATE DATABASE bibliotheque;
\c bibliotheque

CREATE SEQUENCE author_seq START WITH 1 INCREMENT BY 1;

CREATE TABLE author
(
    id  VARCHAR PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE SEQUENCE collection_seq START WITH 1 INCREMENT BY 1;

CREATE TABLE collection
(
    id          VARCHAR PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE SEQUENCE theme_seq START WITH 1 INCREMENT BY 1;

CREATE TABLE theme
(
    id          VARCHAR PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE SEQUENCE category_seq START WITH 1 INCREMENT BY 1;

CREATE TABLE category
(
    id          VARCHAR PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE SEQUENCE  editor_seq START WITH 1 INCREMENT BY 1;

CREATE TABLE  editor 
(
    id VARCHAR PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE SEQUENCE  language_seq START WITH 1 INCREMENT BY 1;

CREATE TABLE language
(
    code VARCHAR(3) PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE SEQUENCE member_type_seq START WITH 1 INCREMENT BY 1;

CREATE TABLE member_type
(
    id           VARCHAR PRIMARY KEY,
    name  VARCHAR(50) NOT NULL,
    late_coefficient INT NOT NULL
);

CREATE SEQUENCE member_seq START WITH 1 INCREMENT BY 1;

CREATE TABLE member
(
    id             VARCHAR PRIMARY KEY,
    last_name      VARCHAR(50) NOT NULL,
    first_name     VARCHAR(50) NOT NULL,
    email          VARCHAR(50),
    birth_date     DATE        NOT NULL,
    member_type    VARCHAR     NOT NULL,
    FOREIGN KEY (member_type) REFERENCES member_type (id),
    password       VARCHAR
);

CREATE SEQUENCE book_seq START WITH 1 INCREMENT BY 1;

CREATE TABLE book
(
    id           VARCHAR PRIMARY KEY,
    title        VARCHAR        NOT NULL,
    author       VARCHAR        NOT NULL,
    FOREIGN KEY (author) REFERENCES author (id),
    isbn         VARCHAR UNIQUE NOT NULL,
    shelf_number VARCHAR UNIQUE NOT NULL,
    editor     VARCHAR        NOT NULL,
    FOREIGN KEY ( editor ) REFERENCES  editor  (id),
    publishing_date DATE       NOT NULL,
    tome       INT,
    collection   VARCHAR,
    FOREIGN KEY (collection) REFERENCES collection (id),
    language     VARCHAR        NOT NULL,
    FOREIGN KEY (language) REFERENCES language (code),
    pages_count  INT            NOT NULL,
    summary      TEXT
);

CREATE SEQUENCE book_theme_seq START WITH 1 INCREMENT BY 1;

CREATE TABLE book_theme
(
    book  VARCHAR NOT NULL,
    FOREIGN KEY (book) REFERENCES book (id),
    theme VARCHAR NOT NULL,
    FOREIGN KEY (theme) REFERENCES theme (id),
    PRIMARY KEY (book, theme)
);

CREATE SEQUENCE copy_seq START WITH 1 INCREMENT BY 1;

CREATE TABLE copy
(
    id         VARCHAR PRIMARY KEY,
    book       VARCHAR              NOT NULL,
    FOREIGN KEY (book) REFERENCES book (id),
    available  BOOLEAN DEFAULT TRUE NOT NULL
);

CREATE SEQUENCE loan_seq START WITH 1 INCREMENT BY 1;

CREATE TABLE loan
(
    id            VARCHAR PRIMARY KEY,
    copy          VARCHAR NOT NULL,
    FOREIGN KEY (copy) REFERENCES copy (id),
    member        VARCHAR NOT NULL,
    FOREIGN KEY (member) REFERENCES member (id),
    loan_date     DATE    NOT NULL,
    due_date      DATE    NOT NULL,
    return_date   DATE
);

CREATE SEQUENCE loan_rule_seq START WITH 1 INCREMENT BY 1;

CREATE TABLE loan_rule
(
    id                  VARCHAR PRIMARY KEY,
    book                VARCHAR NOT NULL,
    FOREIGN KEY (book) REFERENCES book (id),
    member_type         VARCHAR NOT NULL,
    FOREIGN KEY (member_type) REFERENCES member_type (id),
    can_borrow          BOOLEAN NOT NULL,
    can_take_home       BOOLEAN NOT NULL,
    age_limit           INT     NOT NULL,
    late_fee_limit      INT     NOT NULL
);

CREATE SEQUENCE admin_seq START WITH 1 INCREMENT BY 1;

CREATE TABLE admin
(
    id       VARCHAR PRIMARY KEY,
    email    VARCHAR NOT NULL,
    password VARCHAR NOT NULL
);

CREATE SEQUENCE penalty_seq START WITH 1 INCREMENT BY 1;

CREATE TABLE penalty
(
    id       VARCHAR PRIMARY KEY,
    member   VARCHAR NOT NULL,
    FOREIGN KEY (member) REFERENCES member (id),
    start_date DATE NOT NULL,
    end_date   DATE NOT NULL
);

-- insert ADMIN
INSERT INTO admin (id, email, password)
VALUES (CONCAT('ADM', LPAD(CAST(NEXTVAL('admin_seq') AS TEXT), 3, '0')), 'admin@gmail.com', 'admin');

-- insert author
INSERT INTO author (id, name)
VALUES (CONCAT('AUT', LPAD(CAST(NEXTVAL('author_seq') AS TEXT), 3, '0')), 'Isaac Asimov'),
       (CONCAT('AUT', LPAD(CAST(NEXTVAL('author_seq') AS TEXT), 3, '0')), 'Arthur Conan Doyle'),
       (CONCAT('AUT', LPAD(CAST(NEXTVAL('author_seq') AS TEXT), 3, '0')), 'Agatha Christie'),
       (CONCAT('AUT', LPAD(CAST(NEXTVAL('author_seq') AS TEXT), 3, '0')), 'Virginia Woolf'),
       (CONCAT('AUT', LPAD(CAST(NEXTVAL('author_seq') AS TEXT), 3, '0')), 'H.G. Wells'),
       (CONCAT('AUT', LPAD(CAST(NEXTVAL('author_seq') AS TEXT), 3, '0')), 'J.R.R. Tolkien'),
       (CONCAT('AUT', LPAD(CAST(NEXTVAL('author_seq') AS TEXT), 3, '0')), 'J.K. Rowling');
INSERT INTO author (id, name) 
VALUES  ('AUT011', 'Isaac Asimov'),
        ('AUT012', 'Arthur Conan Doyle'),
        ('AUT013', 'Agatha Christie'),
        ('AUT014', 'Virginia Woolf'),
        ('AUT015', 'H.G. Wells'),
        ('AUT016', 'J.R.R. Tolkien'),
        ('AUT017', 'J.K. Rowling');

-- Insert additional  editor
INSERT INTO  editor (id, name)
VALUES (CONCAT('ED', LPAD(CAST(NEXTVAL(' editor_seq') AS TEXT), 3, '0')), 'Penguin Books'),
       (CONCAT('ED', LPAD(CAST(NEXTVAL(' editor_seq') AS TEXT), 3, '0')), 'HarperCollins'),
       (CONCAT('ED', LPAD(CAST(NEXTVAL(' editor_seq') AS TEXT), 3, '0')), 'Random House');
INSERT INTO editor (id, name) VALUES 
('PUB005', 'Penguin Books'),
('PUB006', 'HarperCollins'),
('PUB007', 'Bloomsbury');

-- Insert additional COLLECTIONS
INSERT INTO collection (id, name)
VALUES (CONCAT('COL', LPAD(CAST(NEXTVAL('collection_seq') AS TEXT), 3, '0')), 'Foundation Series'),
       (CONCAT('COL', LPAD(CAST(NEXTVAL('collection_seq') AS TEXT), 3, '0')), 'Sherlock Holmes'),
       (CONCAT('COL', LPAD(CAST(NEXTVAL('collection_seq') AS TEXT), 3, '0')), 'Hercule Poirot'),
       (CONCAT('COL', LPAD(CAST(NEXTVAL('collection_seq') AS TEXT), 3, '0')), 'The Lord of the Rings'),
       (CONCAT('COL', LPAD(CAST(NEXTVAL('collection_seq') AS TEXT), 3, '0')), 'Harry Potter');
INSERT INTO collection (id, name) VALUES 
('COL006', 'Sherlock Holmes'),
('COL007', 'Hercule Poirot'),
('COL008', 'The Lord of the Rings'),
('COL009', 'Harry Potter');

-- Insert additional LANGUAGES
INSERT INTO language (code, name)
VALUES ('EN', 'English'),
        ('FR', 'Français');

-- Insert additional BOOKS
INSERT INTO book (id, title, author, isbn, shelf_number, editor, publishing_date, tome, collection, language, pages_count, summary, image)
VALUES 
(CONCAT('BOK', LPAD(CAST(NEXTVAL('book_seq') AS TEXT), 3, '0')), 'Foundation', 'AUT011', '9780553293357', 'C5-001', 'PUB005', '1951-06-01', 1, 'COL005', 'EN', 255, 'The first book in the Foundation series.', 'foundation.jpg'),
(CONCAT('BOK', LPAD(CAST(NEXTVAL('book_seq') AS TEXT), 3, '0')), 'The Hound of the Baskervilles', 'AUT012', '9780141032435', 'C6-001', 'PUB006', '1902-04-01', NULL, 'COL006', 'EN', 256, 'A Sherlock Holmes novel.', 'hound_of_the_baskervilles.jpg'),
(CONCAT('BOK', LPAD(CAST(NEXTVAL('book_seq') AS TEXT), 3, '0')), 'Murder on the Orient Express', 'AUT013', '9780007119318', 'C7-001', 'PUB007', '1934-01-01', NULL, 'COL007', 'EN', 256, 'A Hercule Poirot mystery novel.', 'murder_on_the_orient_express.jpg'),
(CONCAT('BOK', LPAD(CAST(NEXTVAL('book_seq') AS TEXT), 3, '0')), 'To the Lighthouse', 'AUT014', '9780156907392', 'C8-001', 'PUB005', '1927-05-05', NULL, NULL, 'EN', 209, 'A novel by Virginia Woolf.', 'to_the_lighthouse.jpg'),
(CONCAT('BOK', LPAD(CAST(NEXTVAL('book_seq') AS TEXT), 3, '0')), 'The War of the Worlds', 'AUT015', '9780141441030', 'C9-001', 'PUB007', '1898-01-01', NULL, NULL, 'EN', 192, 'A science fiction novel by H.G. Wells.', 'the_war_of_the_worlds.jpg'),
(CONCAT('BOK', LPAD(CAST(NEXTVAL('book_seq') AS TEXT), 3, '0')), 'The Fellowship of the Ring', 'AUT016', '9780618574940', 'C10-001', 'PUB005', '1954-07-29', 1, 'COL008', 'EN', 423, 'The first book of The Lord of the Rings trilogy.', 'the_fellowship_of_the_ring.jpg'),
(CONCAT('BOK', LPAD(CAST(NEXTVAL('book_seq') AS TEXT), 3, '0')), 'The Two Towers', 'AUT016', '9780618574957', 'C10-002', 'PUB005', '1954-11-11', 2, 'COL008', 'EN', 352, 'The second book of The Lord of the Rings trilogy.', 'the_two_towers.jpg'),
(CONCAT('BOK', LPAD(CAST(NEXTVAL('book_seq') AS TEXT), 3, '0')), 'The Return of the King', 'AUT016', '9780618574971', 'C10-003', 'PUB005', '1955-10-20', 3, 'COL008', 'EN', 416, 'The third book of The Lord of the Rings trilogy.', 'the_return_of_the_king.jpg'),
(CONCAT('BOK', LPAD(CAST(NEXTVAL('book_seq') AS TEXT), 3, '0')), 'Harry Potter and the Philosopher\s Stone', 'AUT017', '9780747532699', 'C11-001', 'PUB007', '1997-06-26', 1, 'COL009', 'EN', 223, 'The first book in the Harry Potter series.', 'harry_potter_and_the_philosophers_stone.jpg'),
(CONCAT('BOK', LPAD(CAST(NEXTVAL('book_seq') AS TEXT), 3, '0')), 'Harry Potter and the Chamber of Secrets', 'AUT017', '9780747538493', 'C11-002', 'PUB007', '1998-07-02', 2, 'COL009', 'EN', 251, 'The second book in the Harry Potter series.', 'harry_potter_and_the_chamber_of_secrets.jpg'),
(CONCAT('BOK', LPAD(CAST(NEXTVAL('book_seq') AS TEXT), 3, '0')), 'Harry Potter and the Prisoner of Azkaban', 'AUT017', '9780747542155', 'C11-003', 'PUB007', '1999-07-08', 3, 'COL009', 'EN', 317, 'The third book in the Harry Potter series.', 'harry_potter_and_the_prisoner_of_azkaban.jpg'),
(CONCAT('BOK', LPAD(CAST(NEXTVAL('book_seq') AS TEXT), 3, '0')), 'Harry Potter and the Goblet of Fire', 'AUT017', '9780747546245', 'C11-004', 'PUB007', '2000-07-08', 4, 'COL009', 'EN', 636, 'The fourth book in the Harry Potter series.', 'harry_potter_and_the_goblet_of_fire.jpg'),
(CONCAT('BOK', LPAD(CAST(NEXTVAL('book_seq') AS TEXT), 3, '0')), 'Harry Potter and the Order of the Phoenix', 'AUT017', '9780747551003', 'C11-005', 'PUB007', '2003-06-21', 5, 'COL009', 'EN', 766, 'The fifth book in the Harry Potter series.', 'harry_potter_and_the_order_of_the_phoenix.jpg'),
(CONCAT('BOK', LPAD(CAST(NEXTVAL('book_seq') AS TEXT), 3, '0')), 'Harry Potter and the Half-Blood Prince', 'AUT017', '9780747581086', 'C11-006', 'PUB007', '2005-07-16', 6, 'COL009', 'EN', 607, 'The sixth book in the Harry Potter series.', 'harry_potter_and_the_half_blood_prince.jpg'),
(CONCAT('BOK', LPAD(CAST(NEXTVAL('book_seq') AS TEXT), 3, '0')), 'Harry Potter and the Deathly Hallows', 'AUT017', '9780747591054', 'C11-007', 'PUB007', '2007-07-21', 7, 'COL009', 'EN', 607, 'The seventh and final book in the Harry Potter series.', 'harry_potter_and_the_deathly_hallows.jpg');

-- insert TYPE MEMBRE
INSERT INTO member_type (id, name, late_coefficient)
VALUES ('TME001', 'professional', 1),
       ('TME002', 'professor', 2),
       ('TME003', 'student', 3),
       ('TME004', 'simple', 4);

-- insert MEMBRE
INSERT INTO member (id, last_name, first_name, email, birth_date, member_type, password)
VALUES (CONCAT('MBR', LPAD(CAST(NEXTVAL('member_seq') AS TEXT), 3, '0')), 'Dupont', 'Jean', 'jean.dupont@example.com', '1980-01-15', 'TME002', '1234'),
       (CONCAT('MBR', LPAD(CAST(NEXTVAL('member_seq') AS TEXT), 3, '0')), 'Martin', 'Sophie', 'sophie.martin@example.com', '1992-05-23', 'TME003', '1234'),
       (CONCAT('MBR', LPAD(CAST(NEXTVAL('member_seq') AS TEXT), 3, '0')), 'Bernard', 'Luc', 'luc.bernard@example.com', '1985-03-30', 'TME004', '1234'),
       (CONCAT('MBR', LPAD(CAST(NEXTVAL('member_seq') AS TEXT), 3, '0')), 'Petit', 'Marie', 'marie.petit@example.com', '1990-07-19', 'TME001', '1234'),
       (CONCAT('MBR', LPAD(CAST(NEXTVAL('member_seq') AS TEXT), 3, '0')), 'Leroy', 'Paul', 'paul.leroy@example.com', '1983-11-22', 'TME003', '1234'),
       (CONCAT('MBR', LPAD(CAST(NEXTVAL('member_seq') AS TEXT), 3, '0')), 'Moreau', 'Claire', 'claire.moreau@example.com', '1987-02-13', 'TME004', '1234'),
       (CONCAT('MBR', LPAD(CAST(NEXTVAL('member_seq') AS TEXT), 3, '0')), 'Fournier', 'Julien', 'julien.fournier@example.com', '1995-08-08', 'TME002', '1234'),
       (CONCAT('MBR', LPAD(CAST(NEXTVAL('member_seq') AS TEXT), 3, '0')), 'Girard', 'Emma', 'emmauthor.girard@example.com', '1993-06-17', 'TME001', '1234'),
       (CONCAT('MBR', LPAD(CAST(NEXTVAL('member_seq') AS TEXT), 3, '0')), 'Durand', 'Nicolas', 'nicolas.durand@example.com', '1989-12-05', 'TME004', '1234'),
       (CONCAT('MBR', LPAD(CAST(NEXTVAL('member_seq') AS TEXT), 3, '0')), 'Lefevre', 'Alice', 'alice.lefevre@example.com', '1991-09-27', 'TME002', '1234');

-- Insertions dans la table copy
INSERT INTO copy (id, book, available)
VALUES 
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK061', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK061', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK061', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK062', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK062', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK062', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK063', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK063', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK063', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK064', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK064', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK064', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK065', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK065', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK065', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK066', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK066', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK066', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK067', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK067', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK067', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK068', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK068', true),
    (CONCAT('CPY', LPAD(CAST(NEXTVAL('copy_seq') AS TEXT), 3, '0')), 'BOK068', true);


-- Insertions dans la table loan_rule
INSERT INTO loan_rule (id, book, member_type, can_borrow, can_take_home, age_limit, late_fee_limit)
VALUES (CONCAT('LR', LPAD(CAST(NEXTVAL('loan_rule_seq') AS TEXT), 3, '0')), 'BOK061', 'TME001', true, true, 0, 10),
       (CONCAT('LR', LPAD(CAST(NEXTVAL('loan_rule_seq') AS TEXT), 3, '0')), 'BOK061', 'TME002', true, true, 0, 7),
       (CONCAT('LR', LPAD(CAST(NEXTVAL('loan_rule_seq') AS TEXT), 3, '0')), 'BOK061', 'TME003', true, false, 12, 5),
       (CONCAT('LR', LPAD(CAST(NEXTVAL('loan_rule_seq') AS TEXT), 3, '0')), 'BOK061', 'TME004', true, false, 12, 3);

CREATE OR REPLACE VIEW v_penalty AS
SELECT DISTINCT ON (member)
    id,
    member,
    start_date,
    end_date,
    CURRENT_DATE BETWEEN start_date AND end_date AS estPenalise
FROM penalty
ORDER BY member, start_date DESC;

CREATE OR REPLACE VIEW v_usage AS
SELECT c.id,
       c.book,
       c.available,
       COUNT(l.id) AS usage
FROM 
    copy c
LEFT JOIN 
    loan l 
ON 
    c.id = l.copy
GROUP BY 
    c.id;

CREATE OR REPLACE VIEW bookUsage AS
SELECT
    book.id,
    book.title,
    book.author,
    author.name AS author_nom,
    book.isbn,
    book.shelf_number,
    book.editor,
    book.collection,
    editor.name AS editor_name,
    book.publishing_date,
    book.tome,
    collection.name AS collection_name,
    book.language,
    language.name AS language_name,
    book.pages_count AS pages_count,
    book.summary AS resume
FROM
    book 
JOIN 
    author ON book.author = author.id
JOIN  
    editor ON book.editor  = editor.id
LEFT JOIN 
    collection ON book.collection = collection.id
JOIN 
    language ON book.language = language.code;


