<?php
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            // Mostrar la vista para crear una playlist
            require_once('views/playlist/CreatePlaylistView.phtml');
            break;

        case 'create':
            // Crear una nueva playlist
            $title = $_POST['title'] ?? null;
            $userId = $user_session->getId();

            if ($title && $userId) {
                $result = PlaylistRepository::create($userId, $title);

                if ($result) {
                    echo "<p class='success'>Playlist creada exitosamente.</p>";
                } else {
                    echo "<p class='error'>Error al crear la playlist. Inténtalo de nuevo.</p>";
                }
            } else {
                echo "<p class='error'>Falta el título o el usuario no está identificado.</p>";
            }
            break;

        case 'detail':
            // Mostrar detalles de una playlist
            require_once('views/playlist/playlistDetailView.phtml');
            break;

        case 'add_song':
            // Añadir una canción a una playlist
            $songId = $_POST['song_id'] ?? null;
            $playlistId = $_POST['playlist_id'] ?? null;

            if ($songId && $playlistId) {
                $result = PlaylistRepository::addSongToPlaylist($playlistId, $songId);

                if ($result) {
                    echo "<p class='success'>La canción ha sido añadida a la playlist exitosamente</p>";
                    echo '<button type="button" onclick="window.location.href=\'index.php\';">Volver</button>';

                } else {
                    echo "<p class='error'>Error al añadir la canción a la playlist. Inténtalo de nuevo</p>";
                }
            } else {
                echo "<p class='error'>Debes seleccionar una canción y una playlist</p>";
            }
            break;

        default:
            echo "<p class='error'>Acción no reconocida</p>";
            break;
    }
}
?>
