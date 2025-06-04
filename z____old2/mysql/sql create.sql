CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des sujets (topics)
CREATE TABLE IF NOT EXISTS topic (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    author INT NOT NULL,
    FOREIGN KEY (author) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exemple de données utilisateur (mot de passe = "secret123")
INSERT INTO users (email, firstname, lastname, password) VALUES
('jazz@bukowski.com', 'Charles', 'Bukowski', '$2y$10$T9uW0bkCsb.f3ROnd5oaTO6cy3bwCoReuChdWAVQY8YiHpNGwLnAW');

-- Exemple de sujets
INSERT INTO topic (title, content, author) VALUES
('Premier sujet du lounge', 'Bienvenue dans le forum jazz de Bukowski.', 1),
('Encore un verre ?', 'On discute ici de nos meilleurs morceaux.', 1);