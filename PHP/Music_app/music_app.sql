-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2024 a las 18:38:37
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `music_app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playlist`
--

CREATE TABLE `playlist` (
  `id` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `playlist`
--

INSERT INTO `playlist` (`id`, `id_user`, `title`, `timestamp`) VALUES
(1, 1, 'Rock Clásico', '2024-12-01 18:30:58'),
(2, 2, 'Jazz para relajarse', '2024-12-01 18:30:58'),
(3, 3, 'Hits de los 90s', '2024-12-01 18:30:58'),
(4, 4, 'Playlist de Freestyle', '2024-12-01 18:30:58'),
(5, 5, 'Indie Love', '2024-12-01 18:30:58'),
(6, 6, 'Música Electrónica', '2024-12-01 18:30:58'),
(7, 7, 'Canciones de la Infancia', '2024-12-01 18:30:58'),
(8, 8, 'Pop Hits', '2024-12-01 18:30:58'),
(9, 9, 'Punk y Rock', '2024-12-01 18:30:58'),
(10, 10, 'Música Clásica Favorita', '2024-12-01 18:30:58'),
(11, 11, 'Favoritos Acústicos', '2024-12-01 18:30:58'),
(12, 12, 'Ritmos del Caribe', '2024-12-01 18:30:58'),
(13, 13, 'Baladas Románticas', '2024-12-01 18:30:58'),
(14, 14, 'Top 2023', '2024-12-01 18:30:58'),
(15, 15, 'Lo Mejor de EDM', '2024-12-01 18:30:58'),
(16, 16, 'Rock en Español', '2024-12-01 18:30:58'),
(17, 17, 'Blues & Soul', '2024-12-01 18:30:58'),
(18, 18, 'Mix Relax', '2024-12-01 18:30:58'),
(19, 19, 'Fiesta Latina', '2024-12-01 18:30:58'),
(20, 20, 'Éxitos del Año', '2024-12-01 18:30:58'),
(21, 2, 'Mi playlist chuchuchulii', '2024-12-01 20:11:23'),
(22, 2, 'mi playlist', '2024-12-02 10:58:12'),
(23, 1, 'mi plailist', '2024-12-02 11:57:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playlist_song`
--

CREATE TABLE `playlist_song` (
  `id` bigint(20) NOT NULL,
  `id_song` bigint(20) NOT NULL,
  `id_playlist` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `playlist_song`
--

INSERT INTO `playlist_song` (`id`, `id_song`, `id_playlist`) VALUES
(1, 1, 1),
(2, 13, 1),
(3, 2, 2),
(4, 17, 2),
(5, 3, 3),
(6, 8, 3),
(7, 6, 4),
(8, 11, 4),
(9, 5, 5),
(10, 14, 5),
(11, 12, 6),
(12, 18, 6),
(13, 7, 7),
(14, 16, 7),
(15, 10, 8),
(16, 19, 8),
(17, 9, 9),
(18, 15, 9),
(19, 4, 10),
(20, 20, 10),
(21, 18, 21),
(22, 14, 21),
(23, 19, 21),
(24, 19, 21),
(25, 19, 21),
(26, 19, 21),
(27, 19, 22),
(28, 1, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playlist_user`
--

CREATE TABLE `playlist_user` (
  `id` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_playlist` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `playlist_user`
--

INSERT INTO `playlist_user` (`id`, `id_user`, `id_playlist`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 1),
(4, 2, 5),
(5, 3, 4),
(6, 3, 6),
(7, 4, 7),
(8, 4, 8),
(9, 5, 9),
(10, 5, 10),
(11, 6, 11),
(12, 6, 12),
(13, 7, 13),
(14, 7, 14),
(15, 8, 15),
(16, 8, 16),
(17, 9, 17),
(18, 9, 18),
(19, 10, 19),
(20, 10, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `song`
--

CREATE TABLE `song` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `duration` bigint(20) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `song`
--

INSERT INTO `song` (`id`, `title`, `author`, `duration`, `file_path`, `timestamp`) VALUES
(1, 'Bohemian Rhapsody', 'Queen', 354, 'uploads/bohemian.mp3', '2024-12-01 18:31:18'),
(2, 'Hotel California', 'Eagles', 390, 'uploads/hotel_california.mp3', '2024-12-01 18:31:18'),
(3, 'Imagine', 'John Lennon', 183, 'uploads/imagine.mp3', '2024-12-01 18:31:18'),
(4, 'Shape of You', 'Ed Sheeran', 240, 'uploads/shape_of_you.mp3', '2024-12-01 18:31:18'),
(5, 'Rolling in the Deep', 'Adele', 228, 'uploads/rolling_in_the_deep.mp3', '2024-12-01 18:31:18'),
(6, 'Smells Like Teen Spirit', 'Nirvana', 301, 'uploads/smells_like_teen_spirit.mp3', '2024-12-01 18:31:18'),
(7, 'Back to Black', 'Amy Winehouse', 257, 'uploads/back_to_black.mp3', '2024-12-01 18:31:18'),
(8, 'Hey Jude', 'The Beatles', 431, 'uploads/hey_jude.mp3', '2024-12-01 18:31:18'),
(9, 'Wonderwall', 'Oasis', 258, 'uploads/wonderwall.mp3', '2024-12-01 18:31:18'),
(10, 'Perfect', 'Ed Sheeran', 263, 'uploads/perfect.mp3', '2024-12-01 18:31:18'),
(11, 'Blinding Lights', 'The Weeknd', 200, 'uploads/blinding_lights.mp3', '2024-12-01 18:31:18'),
(12, 'Shallow', 'Lady Gaga', 214, 'uploads/shallow.mp3', '2024-12-01 18:31:18'),
(13, 'Thunderstruck', 'AC/DC', 292, 'uploads/thunderstruck.mp3', '2024-12-01 18:31:18'),
(14, 'Billie Jean', 'Michael Jackson', 294, 'uploads/billie_jean.mp3', '2024-12-01 18:31:18'),
(15, 'Rolling Stones', 'Satisfaction', 190, 'uploads/satisfaction.mp3', '2024-12-01 18:31:18'),
(16, 'Hallelujah', 'Leonard Cohen', 360, 'uploads/hallelujah.mp3', '2024-12-01 18:31:18'),
(17, 'Let It Be', 'The Beatles', 243, 'uploads/let_it_be.mp3', '2024-12-01 18:31:18'),
(18, 'Despacito', 'Luis Fonsi', 229, 'uploads/despacito.mp3', '2024-12-01 18:31:18'),
(19, 'Livin’ on a Prayer', 'Bon Jovi', 248, 'uploads/livin_on_a_prayer.mp3', '2024-12-01 18:31:18'),
(20, 'Sweet Child O’ Mine', 'Guns N’ Roses', 356, 'uploads/sweet_child_o_mine.mp3', '2024-12-01 18:31:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `avatar` varchar(255) DEFAULT 'https://picsum.photos/200/300',
  `bio` varchar(255) DEFAULT NULL,
  `state` smallint(6) DEFAULT 0,
  `isAdmin` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `avatar`, `bio`, `state`, `isAdmin`) VALUES
(1, 'admin', 'admin@example.com', 'admin', 'https://picsum.photos/200/300', 'DJ profesional', 1, 1),
(2, 'ana', 'ana@example.com', 'ana', 'https://picsum.photos/200/300', 'Amante de la música!', 1, 0),
(3, 'john_doe', 'john_doe@example.com', 'password123', 'https://picsum.photos/200/300', 'Amante de la música', 1, 0),
(4, 'jane_smith', 'jane_smith@example.com', 'securepass', 'https://picsum.photos/200/300', 'Cantante aficionada', 1, 0),
(5, 'music_lover', 'music_lover@example.com', 'melody2023', 'https://picsum.photos/200/300', 'Disfrutando de playlists', 1, 0),
(6, 'dj_bob', 'dj_bob@example.com', 'turntables', 'https://picsum.photos/200/300', 'DJ profesional', 1, 0),
(7, 'melody_maker', 'melody_maker@example.com', 'songwriter', 'https://picsum.photos/200/300', 'Creador de canciones', 1, 0),
(8, 'sarah_connor', 'sarah_connor@example.com', 'future2023', 'https://picsum.photos/200/300', 'Explorando ritmos', 1, 0),
(9, 'beat_fanatic', 'beat_fanatic@example.com', 'rhythm123', 'https://picsum.photos/200/300', 'Fan de los beats', 1, 0),
(10, 'alex_music', 'alex_music@example.com', 'noteitdown', 'https://picsum.photos/200/300', 'Entusiasta de la guitarra', 1, 0),
(11, 'emma_tunes', 'emma_tunes@example.com', 'singalong', 'https://picsum.photos/200/300', 'Cantante de ducha', 1, 0),
(12, 'rockstar_99', 'rockstar_99@example.com', 'rockon2023', 'https://picsum.photos/200/300', 'Amante del rock clásico', 1, 0),
(13, 'jazz_cat', 'jazz_cat@example.com', 'smoothjazz', 'https://picsum.photos/200/300', 'Adicto al jazz', 1, 0),
(14, 'hiphop_head', 'hiphop_head@example.com', 'beats2023', 'https://picsum.photos/200/300', 'Freestyler aficionado', 1, 0),
(15, 'pop_fan', 'pop_fan@example.com', 'poplife', 'https://picsum.photos/200/300', 'Seguidor de tendencias pop', 1, 0),
(16, 'classical_ear', 'classical_ear@example.com', 'mozart123', 'https://picsum.photos/200/300', 'Amante de la música clásica', 1, 0),
(17, 'indie_heart', 'indie_heart@example.com', 'indie2023', 'https://picsum.photos/200/300', 'Explorador de bandas indie', 1, 0),
(18, 'punk_vibes', 'punk_vibes@example.com', 'punkrock', 'https://picsum.photos/200/300', 'Fan del punk de los 90s', 1, 0),
(19, 'electro_geek', 'electro_geek@example.com', 'edm2023', 'https://picsum.photos/200/300', 'Enamorado de los sintetizadores', 1, 0),
(20, 'folk_story', 'folk_story@example.com', 'acoustic', 'https://picsum.photos/200/300', 'Historias contadas con guitarra', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `playlist_song`
--
ALTER TABLE `playlist_song`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_playlist` (`id_playlist`),
  ADD KEY `id_song` (`id_song`);

--
-- Indices de la tabla `playlist_user`
--
ALTER TABLE `playlist_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_playlist` (`id_playlist`);

--
-- Indices de la tabla `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `playlist_song`
--
ALTER TABLE `playlist_song`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `playlist_user`
--
ALTER TABLE `playlist_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `song`
--
ALTER TABLE `song`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `playlist_song`
--
ALTER TABLE `playlist_song`
  ADD CONSTRAINT `playlist_song_ibfk_1` FOREIGN KEY (`id_playlist`) REFERENCES `playlist` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `playlist_song_ibfk_2` FOREIGN KEY (`id_song`) REFERENCES `song` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `playlist_user`
--
ALTER TABLE `playlist_user`
  ADD CONSTRAINT `playlist_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `playlist_user_ibfk_2` FOREIGN KEY (`id_playlist`) REFERENCES `playlist` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
