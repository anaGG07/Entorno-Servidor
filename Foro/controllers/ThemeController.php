<?php

if (isset($_POST['action']) && $_POST['action'] === 'add') {
    // Crear un nuevo tema utilizando los datos enviados por el formulario
    $theme = new Theme(
        null, // ID (se generará automáticamente en la base de datos)
        $_POST['title'], // Título
        $_POST['description'], // Descripción
        $_POST['icon'] // Ícono (ruta o nombre del archivo)
    );

    $result = ThemeRepository::create($theme);

    if ($result) {
        echo mensaje("Tema creado exitosamente");
    } else {
        echo mensaje("Error al crear el tema");
    }
    exit;
} elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
    // Eliminar un tema utilizando su ID
    $result = ThemeRepository::delete($_POST['id']);

    if ($result) {
        echo mensaje("Tema eliminado exitosamente");
    } else {
        echo mensaje("Error al eliminar el tema");
    }
    exit;
} elseif (isset($_POST['action']) && $_POST['action'] === 'edit') {
    // Editar un tema existente
    $theme = ThemeRepository::getThemeById($_POST['id']);

    if ($theme) {
        // Actualizar los datos del tema
        $theme->setTitle($_POST['title']);
        $theme->setDescription($_POST['description']);
        $theme->setIcon($_POST['icon']);

        $result = ThemeRepository::update($theme);

        if ($result) {
            echo mensaje("Tema actualizado exitosamente");
        } else {
            echo mensaje("Error al actualizar el tema");
        }
    } else {
        echo mensaje("El tema no existe");
    }
    exit;
}
