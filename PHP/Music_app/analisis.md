
# Análisis del Proyecto: Aplicación Web de Listas de Reproducción

## Estructura de la Base de Datos
### 1. Crear la Base de Datos

```sql
CREATE DATABASE music_app;
USE music_app;
```


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

### Playlist:
```sql
    CREATE TABLE playlist (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_user BIGINT NOT NULL,
    title VARCHAR(100) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE
) ENGINE=InnoDB;
```

### Songs:
```sql
    CREATE TABLE song (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    author VARCHAR(100) NOT NULL,
    duration BIGINT NOT NULL,
    file_path VARCHAR(255),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;
```


### Playlist_songs:
```sql
    CREATE TABLE playlist_song (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_song BIGINT NOT NULL,
    id_playlist BIGINT NOT NULL,
    FOREIGN KEY (id_playlist) REFERENCES playlist(id) ON DELETE CASCADE,
    FOREIGN KEY (id_song) REFERENCES song(id) ON DELETE CASCADE
    ) ENGINE=InnoDB;
```


### Favoritos:
```sql
    CREATE TABLE playlist_user (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_user BIGINT NOT NULL,
    id_playlist BIGINT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (id_playlist) REFERENCES playlist(id) ON DELETE CASCADE
    ) ENGINE=InnoDB;
```