# ¿Que tiene un foro?

- ### Usuarios
- ### Temas
- ### Preguntas
- ### Respuestas




## Ejemplo de tabla:

```
------------------------------
|Op0   |    Op1    |   Op2   |
|----------------------------|
| 1    |     x     |    x    |
| 2    |     x     |    x    |
| 3    |     x     |    x    |
| 4    |     x     |    x    |
------------------------------
```

## Base de datos
```sql
    CREATE DATABASE seguimientofct;
```

## TABLAS

### Usuarios:
```sql
    CREATE TABLE user (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(20) NOT NULL UNIQUE,
        email VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(50) NOT NULL, -- --> encriptar
        avatar VARCHAR(255),
        bio VARCHAR(255),
        isAdmin TINYINT DEFAULT 0 -- 1 -> admin, 0 -> profesor, -1 --> alumno 
    ) ENGINE=InnoDB;
```

### Company:
```sql
    CREATE TABLE company (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL UNIQUE,
        nif VARCHAR(255) NOT NULL,
        tutor_name VARCHAR(255) NOT NULL,
        phone VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        address VARCHAR(255)
    ) ENGINE=InnoDB;
```

### Relación entre profesor-company-alumno:

```sql
 -- Asegurarse de que tutor_name sea único en company
ALTER TABLE company ADD UNIQUE (tutor_name);

-- Crear la tabla internship
CREATE TABLE internship (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_student BIGINT NOT NULL,
    company_tutor_name VARCHAR(255) NOT NULL,
    id_ed_tutor BIGINT NOT NULL,
    start_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    end_date DATETIME DEFAULT NULL,
    state SMALLINT DEFAULT 0, -- 1 -> en practicas, 0 -> esperando, -1 -> terminadas las practicas
    CONSTRAINT fk_student FOREIGN KEY (id_student) REFERENCES user(id) ON DELETE CASCADE,
    CONSTRAINT fk_tutor_name FOREIGN KEY (company_tutor_name) REFERENCES company(tutor_name) ON DELETE CASCADE,
    CONSTRAINT fk_tutor FOREIGN KEY (id_ed_tutor) REFERENCES user(id) ON DELETE CASCADE
) ENGINE=InnoDB;

```

## INSERTAR DATOS

### User:


```sql

INSERT INTO user (id, username, email, password, avatar, bio, is_admin)
VALUES
(1, 'admin', 'admin@example.com', 'admin', 'https://picsum.photos/200/300', 'Aventurero de la vida', 1), -- Admin
(2, 'ana', 'ana@example.com', 'ana', 'https://picsum.photos/200/300', 'Amante de los libros', -1), -- Student
(3, 'nik123', 'nik@example.com', 'nik123', 'https://picsum.photos/200/300', 'Explorador de la tormenta', 0), -- Teacher
(4, 'john_doe', 'john@example.com', 'john123', 'https://picsum.photos/200/300', 'Amante de la tecnología', 0), -- Teacher
(5, 'sara', 'sara@example.com', 'sara', 'https://picsum.photos/200/300', 'Apasionada por la ciencia', -1), -- Student
(6, 'luis99', 'luis99@example.com', 'luis99', 'https://picsum.photos/200/300', 'Curioso por naturaleza', -1), -- Student
(7, 'marta', 'marta@example.com', 'marta', 'https://picsum.photos/200/300', 'Defensora del medio ambiente', 0), -- Teacher
(8, 'paul', 'paul@example.com', 'paulpass', 'https://picsum.photos/200/300', 'Programador en crecimiento', -1), -- Student
(9, 'emma', 'emma@example.com', 'emma2024', 'https://picsum.photos/200/300', 'Fanática de la astronomía', 0); -- Teacher



```


### INSERT COMPANY:

```sql
INSERT INTO company (id, name, nif, tutor_name, phone, email, address)
VALUES
(1, 'Tech Innovators', 'B12345678', 'Carlos Pérez', '600123456', 'contact@techinnovators.com', '123 Innovation Street'),
(2, 'Green Solutions', 'C87654321', 'María López', '700987654', 'info@greensolutions.com', '456 Eco Road'),
(3, 'Health Corp', 'A12398765', 'Laura García', '612345678', 'laura@healthcorp.com', '789 Health Ave'),
(4, 'EduWorld', 'D76543210', 'Javier Martínez', '698765432', 'javier@eduworld.com', '321 Learning Blvd'),
(5, 'EcoFuture', 'E56473829', 'Sofía Ramírez', '677345123', 'sofia@ecofuture.com', '654 Green Path');


```



### INSERT INTERSHIP:

```sql

INSERT INTO internship (id_student, company_tutor_name, id_ed_tutor, start_date, end_date, state)
VALUES
-- Sara realiza prácticas con Tech Innovators bajo la tutoría educativa de Marta
(2, 'Carlos Pérez', 4, '2024-01-10 09:00:00', NULL, 1),

-- Luis completó prácticas con Green Solutions bajo la tutoría educativa de John
(3, 'María López', 1, '2023-12-01 09:00:00', '2024-03-01 17:00:00', -1),

-- Paul está realizando prácticas actuales en Health Corp con Marta como tutora educativa
(5, 'Laura García', 4, '2024-02-01 09:00:00', NULL, 1),

-- Emma completó prácticas en EduWorld con John como tutor educativo
(6, 'Javier Martínez', 1, '2023-11-01 09:00:00', '2024-01-31 17:00:00', -1),

-- Sara está esperando para iniciar prácticas en EcoFuture con Marta como tutora educativa
(2, 'Sofía Ramírez', 4, '2024-03-01 09:00:00', NULL, 0);


```