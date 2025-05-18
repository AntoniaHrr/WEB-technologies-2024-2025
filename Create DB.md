# Създаване на БД
Първа стъпка за създаването на база е да идем на 

    localhost/phpmyadmin
Този път води до dashboard-a ни, където се намират всички БД
Отиваме в DATABASES и създаваме първата си БД, която в случая ще кръстим:

    myfirstdatabase
В създадената база отиваме на създаването на нова таблица и от там на STRUCTURE:

    CREATE TABLE users( id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL, pwd VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIME,
    PRIMARY KEY (id)
    );
Когато сме готови кликаме GO
Вече имаме успешно създадена таблица users. За да я популираме с данни, отново я отваряме и отиваме на STRUCTURE:

    INSERT INTO users (username, pwd, email) VALUES ('antonia', 'tony1234', 'antonia1235@abv.bg');
