-- Adatbázis létrehozása
CREATE DATABASE IF NOT EXISTS nextit_db;
USE nextit_db;

-- Users tábla
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Authors tábla
CREATE TABLE IF NOT EXISTS authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(255) NOT NULL,
    avatar_path VARCHAR(255),
    bio TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Blog posts tábla
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    thumbnail_path VARCHAR(255),
    author_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES authors(id)
);

-- Newsletter subscribers tábla
CREATE TABLE IF NOT EXISTS newsletter_subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Minta adatok beszúrása

-- Minta felhasználó (jelszó: test123)
INSERT INTO users (email, password) VALUES 
('admin@nextit.com', '$2y$10$92ZkKBrEk6/DxWU.J4qI8OVtTlRQUPdALBxixnZRrLMcpD0n0LTXK');

-- Minta szerzők
INSERT INTO authors (user_id, name, avatar_path, bio) VALUES
(1, 'Nagy Éva', 'images/avatar.png', 'Senior szoftvermérnök több éves tapasztalattal az IT oktatás területén.'),
(NULL, 'Horváth Anna', 'images/avatar2-min.png', 'Frontend fejlesztő és UX specialista, aki szívesen osztja meg tudását másokkal.'),
(NULL, 'Kiss Tamás', 'images/Ellipse-min.png', 'Full-stack fejlesztő, aki szeretné megkönnyíteni az IT pályaválasztást.'),
(NULL, 'Szabó Péter', 'images/Ellipse2-min.png', 'IT oktató és mentor, aki segít eligazodni a technológiák világában.');

-- Minta blog posztok
INSERT INTO blog_posts (title, content, thumbnail_path, author_id) VALUES
('Hogyan kezdj el programozni?', 'A programozás tanulása első ránézésre ijesztőnek tűnhet, de megfelelő útmutatással bárki elsajátíthatja az alapokat. Ebben a cikkben végigvezetünk a kezdő lépéseken...', 'images/Group-19.jpg', 1),
('Frontend vagy Backend?', 'Az IT világában gyakran felmerülő kérdés: frontend vagy backend fejlesztéssel érdemes foglalkozni? Nézzük meg részletesen mindkét terület előnyeit és hátrányait...', 'images/photo-1-min.jpg', 2),
('Az IT képzések típusai', 'Napjainkban számtalan lehetőség közül választhatunk, ha IT képzést keresünk. Bootcampek, egyetemi képzések, online kurzusok - melyik a legjobb választás?...', 'images/photo-2-min.jpg', 3),
('Karrierváltás az IT felé', 'Egyre többen döntenek úgy, hogy IT területre váltanak. Ebben a cikkben praktikus tanácsokat adunk, hogyan kezdj neki a karrierváltásnak...', 'images/Group-19.jpg', 4);

-- Minta feliratkozók
INSERT INTO newsletter_subscribers (email) VALUES
('pelda@email.com'),
('teszt@nextit.com');
