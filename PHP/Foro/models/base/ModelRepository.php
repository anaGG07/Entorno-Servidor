<?php
require_once('Model.php');

class ModelRepository
{
    public static function getModel()
    {
        return new static();
    }


    public static function getAll()
    {
        $model = static::getModel();

        $connect = connection::connect();
        $q = "SELECT id, " . implode(", ", $model->getColumns()) . " FROM " . $model->getTableName();
        return $connect->query($q);
    }

    public static function delete($id)
    {
        $model = static::getModel();
        $connect = connection::connect();
        $q = "DELETE FROM " . $model->getTableName() . " WHERE id = $id";

        return $connect->query($q);
    }

    
}
