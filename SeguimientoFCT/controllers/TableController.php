<?php

require_once('./models/company/CompanyRepository.php'); //. NO SE PORQUÉ ES NECESARIO PARA LAS EMPRESAS PERO NO PARA USUARIOS 
class TableController
{
    public static function showTable($class)
    {
        
        $repositoryClass = $class . "Repository";
        $controllerClass = $class . "Controller";
        // Verificar si la clase del repositorio existe y tiene el método getModel y getAll
        if (!class_exists($repositoryClass)) {
            throw new Exception("La clase $repositoryClass no existe");
        }
        
        // Instancia del repositorio
        $repository = new $repositoryClass();

        // Verificar que el repositorio tenga el método estático getModel
        if (!method_exists($repository, 'getModel')) {
            throw new Exception("La clase $repositoryClass no tiene el método getModel");
        }

        $model = $repository::getModel();

        // Obtener headers, columns y rows del modelo
        $headers = $model->getHeaders();
        $columns = $model->getColumns();
        $rows = $repository::getAll();

        // Cargar la vista de la tabla
        require 'views/components/TableView.phtml';
    }
}
