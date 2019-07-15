DROP TABLE IF EXISTS discount_folder_person, article_tag, discount, tag, comment, paragraph, title, article, commentator, author, person, blg_status, folder;

CREATE TABLE folder (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    parent_id INT DEFAULT NULL,
    FOREIGN KEY(parent_id) REFERENCES folder(id) ON DELETE SET NULL
);

CREATE TABLE blg_status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    color VARCHAR(255) NOT NULL
);

CREATE TABLE person (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME(6) NOT NULL
);

CREATE TABLE author (
    id INT PRIMARY KEY,
    is_admin TINYINT NOT NULL,
    FOREIGN KEY(id) REFERENCES person(id) ON DELETE RESTRICT
);

CREATE TABLE commentator (
    id INT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    FOREIGN KEY(id) REFERENCES person(id) ON DELETE CASCADE
);

CREATE TABLE article (
    id INT AUTO_INCREMENT PRIMARY KEY,
    status INT NOT NULL,
    categories SET('sport', 'technology', 'business', 'entertainment') NOT NULL,
    author_id INT NOT NULL,
    folder_id INT NOT NULL,
    created_at DATETIME(6) NOT NULL,
    FOREIGN KEY(status) REFERENCES blg_status(id) ON DELETE RESTRICT,
    FOREIGN KEY(author_id) REFERENCES author(id) ON DELETE RESTRICT,
    FOREIGN KEY(folder_id) REFERENCES folder(id) ON DELETE RESTRICT
);

CREATE TABLE title (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT DEFAULT NULL,
    article_id INT DEFAULT NULL,
    FOREIGN KEY(article_id) REFERENCES article(id) ON DELETE RESTRICT
);

CREATE TABLE paragraph (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    position INT NOT NULL,
    article_id INT NOT NULL,
    FOREIGN KEY(article_id) REFERENCES article(id) ON DELETE RESTRICT
);

CREATE TABLE comment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    article_id INT DEFAULT NULL,
    person_id INT NOT NULL,
    created_at DATETIME(6) NOT NULL,
    FOREIGN KEY(article_id) REFERENCES article(id) ON DELETE RESTRICT,
    FOREIGN KEY(person_id) REFERENCES person(id) ON DELETE RESTRICT
);

CREATE TABLE tag (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL
);

CREATE TABLE discount (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code_name VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL
);

CREATE TABLE article_tag (
    article_id INT NOT NULL,
    tag_id INT NOT NULL,
    created_at DATETIME(6) NOT NULL,
    PRIMARY KEY(article_id, tag_id),
    FOREIGN KEY(article_id) REFERENCES article(id) ON DELETE CASCADE,
    FOREIGN KEY(tag_id) REFERENCES tag(id) ON DELETE CASCADE
);

CREATE TABLE discount_folder_person (
    discount_id INT NOT NULL,
    folder_id INT NOT NULL,
    person_id INT NOT NULL,
    created_at DATETIME(6) NOT NULL,
    PRIMARY KEY(discount_id, folder_id, person_id),
    FOREIGN KEY(discount_id) REFERENCES discount(id) ON DELETE CASCADE,
    FOREIGN KEY(folder_id) REFERENCES folder(id) ON DELETE CASCADE,
    FOREIGN KEY(person_id) REFERENCES person(id) ON DELETE CASCADE
);

INSERT INTO folder (name) VALUES
    ('folder 1');
INSERT INTO folder (name) VALUES
    ('folder 2');
INSERT INTO folder (name) VALUES
    ('folder 3');

INSERT INTO folder (name, parent_id) VALUES
    ('folder 1-1', 1);
INSERT INTO folder (name, parent_id) VALUES
    ('folder 1-2', 1);

INSERT INTO folder (name, parent_id) VALUES
    ('folder 1-1-1', 4);

INSERT INTO folder (name, parent_id) VALUES
    ('folder 3-1', 3);

INSERT INTO blg_status (name, color) VALUES
    ('draft', 'red'),
    ('online', 'green'),
    ('archived', 'blue');

INSERT INTO person (username, password, created_at) VALUES
    ('Vince', 'Vince123', NOW());

INSERT INTO author (id, is_admin) VALUES
    (1, 1);

INSERT INTO article (status, categories, author_id, folder_id, created_at) VALUES
    (3, 'technology,entertainment', 1, 1, '2019-01-25 15:08:56');

INSERT INTO article (status, categories, author_id, folder_id, created_at) VALUES
    (1, 'business', 1, 1, '2019-01-28 17:02:08');

INSERT INTO article (status, categories, author_id, folder_id, created_at) VALUES
    (1, 'sport,entertainment', 1, 5, '2019-02-16 16:34:28.123');

INSERT INTO article (status, categories, author_id, folder_id, created_at) VALUES
    (2, 'technology,business', 1, 6, '2019-03-11 18:23:02');

INSERT INTO title (content, article_id) VALUES
    ('The content of: article 1 - title', 1);

INSERT INTO paragraph (content, position, article_id) VALUES
    ('The content of: article 1 - paragraph 1', 1, 1);

INSERT INTO paragraph (content, position, article_id) VALUES
    ('The content of: article 1 - paragraph 2', 2, 1);

INSERT INTO title (content, article_id) VALUES
    ('The content of: article 2 - title', 2);

INSERT INTO paragraph (content, position, article_id) VALUES
    ('The content of: article 2 - paragraph 1', 1, 2);

INSERT INTO title (content, article_id) VALUES
    ('The content of: article 3 - title', 3);

INSERT INTO paragraph (content, position, article_id) VALUES
    ('The content of: article 3 - paragraph 1', 1, 3);

INSERT INTO paragraph (content, position, article_id) VALUES
    ('The content of: article 3 - paragraph 2', 2, 3);

INSERT INTO title (content, article_id) VALUES
    ('The content of: article 4 - title', 4);

INSERT INTO paragraph (content, position, article_id) VALUES
    ('The content of: article 4 - paragraph 1', 1, 4);

INSERT INTO comment (content, article_id, person_id, created_at) VALUES
    ('The content of: comment 1', 1, 1, NOW());

INSERT INTO comment (content, article_id, person_id, created_at) VALUES
    ('The content of: comment 2', 1, 1, NOW());

INSERT INTO comment (content, article_id, person_id, created_at) VALUES
    ('The content of: comment 3', 2, 1, NOW());

INSERT INTO comment (content, article_id, person_id, created_at) VALUES
    ('The content of: comment 4', 3, 1, NOW());

INSERT INTO comment (content, article_id, person_id, created_at) VALUES
    ('The content of: comment 5', 4, 1, NOW());

INSERT INTO comment (content, article_id, person_id, created_at) VALUES
    ('The content of: comment 6', 4, 1, NOW());

INSERT INTO tag (content) VALUES
    ('tag_1');

INSERT INTO tag (content) VALUES
    ('tag_2');

INSERT INTO discount (code_name, start_date, end_date) VALUES
    ('WINTER2019', '2018-12-01', '2019-02-28');

INSERT INTO discount (code_name, start_date, end_date) VALUES
    ('SUMMER2019', '2019-07-01', '2019-09-30');

INSERT INTO article_tag (article_id, tag_id, created_at) VALUES
    (1, 1, NOW());

INSERT INTO article_tag (article_id, tag_id, created_at) VALUES
    (1, 2, NOW());

INSERT INTO discount_folder_person (discount_id, folder_id, person_id, created_at) VALUES
    (1, 3, 1, NOW());

INSERT INTO discount_folder_person (discount_id, folder_id, person_id, created_at) VALUES
    (2, 6, 1, NOW());
