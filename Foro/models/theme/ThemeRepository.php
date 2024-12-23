<?php

require_once('models/base/ModelRepository.php');
require_once('models/theme/Theme.php');


class ThemeRepository extends ModelRepository
{


    public static function getModel()
    {
        return new Theme();
    }


    public static function getThemeById($id)
    {
        $connect = connection::connect();
        $q = "SELECT * FROM theme WHERE id = '$id'";
        $result = $connect->query($q);

        if ($theme = $result->fetch_assoc()) {
            return new Theme($theme['id'], $theme['title'], $theme['description'], $theme['icon']);
        }
        return false;
    }


    public static function getAllThemes()
    {
        $connect = connection::connect();
        $q = "SELECT * FROM theme";
        $result = $connect->query($q);

        $themes = [];

        while ($row = $result->fetch_assoc()) {
            $theme = new Theme(

                $row['id'],
                $row['title'],
                $row['description'],
                $row['icon'],

            );

            $themes[] = $theme;
        }

        return $themes;
    }

    public static function create($theme)
    {
        $connect = connection::connect();
        $q = "INSERT INTO theme VALUES (" . $theme->getTitle() . "," . $theme->getDescription() . "," . $theme->getIcon() . ")";

        if ($connect->query($q)) {
            return ThemeRepository::getThemeById($connect->insert_id);
        }

        return false;
    }

    public static function update($theme)
{
    $connect = connection::connect();

    // Consulta SQL para actualizar el tema
    $q = "UPDATE theme 
          SET title = '{$theme->getTitle()}', 
              description = '{$theme->getDescription()}', 
              icon = '{$theme->getIcon()}' 
          WHERE id = '{$theme->getId()}'";

   
    if ($connect->query($q)) {
        
        return $theme;
    }

    
    return false;
}



    
}
