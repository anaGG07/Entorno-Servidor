<?php

  // Manejo de búsqueda global
if (isset($_POST['action']) && $_POST['action'] === 'search') {
    $query = $_POST['query'];

    // Buscar en empresas, profesores y alumnos
    $companies = CompanyRepository::search($query);
    $teachers = UserRepository::searchTeachers($query);
    $students = UserRepository::searchStudents($query);

    // Mostrar los resultados en una vista
    require_once('./views/searchResult.phtml');
    exit;
}
?>