<?php
class FileHelper
{
    /**
     * Genera un nombre único para el archivo subido
     */
    public static function generateUniqueName($fileName)
    {
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        return uniqid() . '.' . $extension;
    }

    /**
     * Maneja la subida de archivos y los mueve al destino especificado
     */
    public static function fileHandler($origin, $destination)
    {
        // Validar que el archivo exista
        if (file_exists($origin)) {
            // Mover el archivo al destino
            if (move_uploaded_file($origin, $destination)) {
                return true;
            }
            return false;
        }
    }
}
