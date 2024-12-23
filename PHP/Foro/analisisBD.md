# ¿Que tiene un foro?

- ### Usuarios
- ### Temas
- ### Preguntas
- ### Respuestas




## Ejemplo de tabla "Publicaciones":

```
id      responde      texto
 1        null        me recomiendas un restaurante?
 2        1           te recomiendo las alpujarras
 3        1           te recomiendo el bk
 4        3           no me gusta el bk
```

## Base de datos
```sql
    CREATE DATABASE agoraForum;
```

## TABLAS

### Usuarios:
```sql
    CREATE TABLE user (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(20) NOT NULL UNIQUE,
        email VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(50) NOT NULL,
        avatar VARCHAR(255),
        bio VARCHAR(255),
        state SMALLINT DEFAULT 0, -- 1 -> activo, 0 -> inactivo, -1 -> baneado
        isAdmin TINYINT DEFAULT 0 -- 1 -> admin, 0 -> no admin
    ) ENGINE=InnoDB;
```

### Temas:
```sql
    CREATE TABLE theme (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(50) NOT NULL UNIQUE,
        description VARCHAR(255) NOT NULL,
        icon VARCHAR(255)
    ) ENGINE=InnoDB;
```

### Publicaciones:

```sql
    CREATE TABLE post (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_user BIGINT NOT NULL,
    id_post BIGINT DEFAULT NULL, -- Si el campo es nulo, "post" es una pregunta.
    id_theme BIGINT DEFAULT 0, -- 0 -> Varios/Otros
    title VARCHAR(255),
    text TEXT NOT NULL,
    image VARCHAR(255),
    timestamp DATETIME DEFAULT NOW(),
    scope TINYINT DEFAULT 0, -- 0 -> público, 1 -> privado, -1 -> oculto/baneado
    CONSTRAINT fk_user_post FOREIGN KEY (id_user) REFERENCES user(id),
    CONSTRAINT fk_answer_post FOREIGN KEY (id_post) REFERENCES post(id),
    CONSTRAINT fk_theme_post FOREIGN KEY (id_theme) REFERENCES theme(id)
) ENGINE=InnoDB;
```

## INSERTAR DATOS

### User:


```sql

INSERT INTO user (username, email, password, avatar, bio, state, isAdmin)
VALUES
('admin', 'admin@example.com', 'admin', 'https://picsum.photos/200/300', 'Aventurero de la vida', 1, 1),
('ana', 'ana@example.com', 'ana', 'https://picsum.photos/200/300', 'Amante de los libros', 1, 0),
('nik123', 'nik@example.com', 'nik123', 'https://picsum.photos/200/300', 'Explorador de la tormenta', -1, 0);

```

### Theme:

```sql
INSERT INTO theme (title, description, icon)
VALUES
('Tecnología', 'Discute temas relacionados con tecnología e innovación', 'https://picsum.photos/200/300'),
('Viajes', 'Comparte experiencias y consejos sobre viajes', 'https://picsum.photos/200/300'),
('Cine', 'Habla de tus películas y series favoritas', 'https://picsum.photos/200/300');

```


### Post:

```sql
INSERT INTO post (id_user, id_post, id_theme, title, text, image, timestamp, scope)
VALUES
(1, NULL, 1, 'La inteligencia artificial en 2024', '¿Qué opinan sobre los avances en IA este año?', NULL, '2024-11-27 14:30:00', 0),
(2, NULL, 2, 'Los mejores destinos para 2025', 'Estoy planeando un viaje para el próximo año, ¿alguna recomendación?', 'https://picsum.photos/200/300', '2024-11-27 15:00:00', 0),
(3, 1, 1, NULL, 'Totalmente de acuerdo con lo dicho sobre la IA, los avances han sido impresionantes', NULL, '2024-11-27 16:00:00', 0);
```

## Establecer niveles de publicaciones
```sql
INSERT INTO post (id_user, id_post, id_theme, title, text, image, timestamp, scope)
VALUES
-- Nivel 1: Preguntas principales (5 registros)
(2, NULL, 1, '¿Cómo será el futuro de la inteligencia artificial?', '¿Qué opinan sobre los avances de la IA en el futuro cercano?', NULL, '2024-11-28 10:00:00', 0),
(3, NULL, 5, '¿Qué países recomiendan visitar en Europa?', 'Estoy planeando un viaje y me gustaría escuchar sugerencias.', 'https://picsum.photos/200/300', '2024-11-28 10:30:00', 0),
(4, NULL, 10, '¿Cuál es tu libro favorito?', 'Busco recomendaciones de libros que realmente te hayan impactado.', NULL, '2024-11-28 11:00:00', 0),
(5, NULL, 15, '¿Qué piensan sobre el cambio climático?', '¿Creen que estamos a tiempo de revertir el daño ambiental?', NULL, '2024-11-28 11:30:00', 0),
(6, NULL, 20, '¿Cuál es el mejor auto eléctrico?', 'Quiero comprar un auto eléctrico y busco recomendaciones.', NULL, '2024-11-28 12:00:00', 0),

-- Nivel 2: Respuestas directas a las preguntas (6 registros)
(7, 1, 1, NULL, 'Pienso que la IA tendrá un impacto positivo si se regula correctamente.', NULL, '2024-11-28 12:30:00', 0),
(8, 1, 1, NULL, 'Creo que la IA revolucionará la educación, especialmente en países en desarrollo.', NULL, '2024-11-28 12:45:00', 0),
(9, 2, 5, NULL, 'Francia es un destino increíble para disfrutar de cultura y gastronomía.', 'https://picsum.photos/200/300', '2024-11-28 13:00:00', 0),
(10, 3, 10, NULL, 'Mi libro favorito es "Cien años de soledad", es una obra maestra.', NULL, '2024-11-28 13:30:00', 0),
(11, 4, 15, NULL, 'El cambio climático es un tema serio, necesitamos más acción inmediata.', NULL, '2024-11-28 14:00:00', 0),
(12, 5, 20, NULL, 'Tesla es una gran opción por su tecnología avanzada y autonomía.', NULL, '2024-11-28 14:30:00', 0),

-- Nivel 3: Respuestas a respuestas (5 registros)
(6, 7, 1, NULL, 'Totalmente de acuerdo, la regulación es clave para evitar abusos.', NULL, '2024-11-28 15:00:00', 0),
(7, 8, 1, NULL, 'La educación personalizada será revolucionaria gracias a la IA.', NULL, '2024-11-28 15:15:00', 0),
(8, 9, 5, NULL, 'Además de Francia, Italia es un destino espectacular por su historia.', 'https://picsum.photos/200/300', '2024-11-28 15:30:00', 0),
(9, 10, 10, NULL, 'También recomiendo "1984" de George Orwell, un clásico distópico.', NULL, '2024-11-28 15:45:00', 0),
(10, 11, 15, NULL, 'Es importante reducir las emisiones y apostar por energías renovables.', NULL, '2024-11-28 16:00:00', 0),

-- Nivel 4: Respuestas a las respuestas anteriores (4 registros)
(11, 6, 1, NULL, 'Exacto, y también necesitamos educación sobre IA para el público en general.', NULL, '2024-11-28 16:30:00', 0),
(12, 8, 5, NULL, 'Italia tiene una cultura impresionante, Roma y Venecia son imperdibles.', 'https://picsum.photos/200/300', '2024-11-28 17:00:00', 0),
(13, 9, 10, NULL, 'Gracias por la recomendación, añadiré "1984" a mi lista de lectura.', NULL, '2024-11-28 17:30:00', 0),
(14, 10, 15, NULL, 'La transición energética es crucial para combatir el cambio climático.', NULL, '2024-11-28 18:00:00', 0),

-- Nivel 5: Respuestas finales (4 registros)
(15, 11, 1, NULL, 'Sin duda, la educación es clave para un futuro mejor con IA.', NULL, '2024-11-28 18:30:00', 0),
(16, 12, 5, NULL, 'Gracias por las sugerencias, ¡ya estoy planeando mi itinerario!', 'https://picsum.photos/200/300', '2024-11-28 19:00:00', 0),
(17, 13, 10, NULL, 'Espero que disfrutes "1984", es una obra que da mucho para reflexionar.', NULL, '2024-11-28 19:30:00', 0),
(18, 14, 15, NULL, 'Es un desafío global, pero con esfuerzos conjuntos, podemos lograrlo.', NULL, '2024-11-28 20:00:00', 0);
```