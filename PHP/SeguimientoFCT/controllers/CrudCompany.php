<?php
require_once('./models/company/CompanyRepository.php');
require_once('./models/internship/InternshipRepository.php');

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'addCompany':
            // Mostrar el formulario de creación
            require_once('./views/company/createCompany.phtml');
            break;

        case 'saveCompany':
            // Guardar nueva empresa en la base de datos
            $name = $_POST['name'];
            $nif = $_POST['nif'];
            $tutor_name = $_POST['tutor_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];

            $company = CompanyRepository::registerCompany($name, $nif, $tutor_name, $phone, $email, $address);

            if ($company) {
                echo "<script>alert('Empresa añadida con éxito.'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Error al añadir la empresa.'); window.location.href='index.php';</script>";
            }
            break;

        case 'showDetail':
            // Mostrar detalle de una empresa
            $id = $_POST['id'];
            $company = CompanyRepository::getCompanyById($id);

            if ($company) {
                require_once('./views/company/detailCompany.phtml');
            } else {
                echo "<script>alert('Empresa no encontrada.'); window.location.href='index.php';</script>";
            }
            break;


        case 'assignStudent':
            // Obtener el nombre del tutor laboral
            $tutor_name = $_POST['tutor_name'];
            $company = CompanyRepository::getCompanyByTutorName($tutor_name);

            // Obtener alumnos no asignados
            $unassignedStudents = InternshipRepository::getUnassignedStudents();

            if ($company) {
                require_once('./views/company/assignStudent.phtml');
            } else {
                echo "<script>alert('Empresa no encontrada.'); window.location.href='index.php';</script>";
            }
            break;


        case 'saveAssignment':
            // Guardar la asignación
            $id_student = $_POST['id_student'];
            $tutor_name = $_POST['tutor_name']; // Almacenamos el nombre del tutor laboral
            $id_ed_tutor = $user_session->getId(); // El ID del profesor es el usuario de la sesión
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            $assignment = InternshipRepository::createAssignment($id_student, $tutor_name, $id_ed_tutor, $start_date, $end_date);

            if ($assignment) {
                echo "<script>alert('Alumno asignado con éxito.'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Error al asignar al alumno.'); window.location.href='index.php';</script>";
            }
            break;


        case 'removeStudent':
            $id_student = $_POST['id_student'];
            $tutor_name = $_POST['tutor_name'];

            $removed = InternshipRepository::removeStudentFromCompany($id_student, $tutor_name);

            if ($removed) {
                echo "<script>alert('Alumno dado de baja con éxito.'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Error al dar de baja al alumno.'); window.location.href='index.php';</script>";
            }
            break;


        case 'editAssignment':
            $id_student = $_POST['id_student'];
            $tutor_name = $_POST['tutor_name'];

            $assignment = InternshipRepository::getAssignmentByStudentAndTutor($id_student, $tutor_name);
            $unassignedStudents = InternshipRepository::getUnassignedStudents();

            if ($assignment) {
                require_once('./views/company/editAssignment.phtml');
            } else {
                echo "<script>alert('Asignación no encontrada.'); window.location.href='index.php';</script>";
            }
            break;


        case 'updateAssignment':
            $id_student = $_POST['id_student'];
            $new_student_id = $_POST['new_student'];
            $tutor_name = $_POST['tutor_name'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            $updated = InternshipRepository::updateAssignment($id_student, $new_student_id, $tutor_name, $start_date, $end_date);

            if ($updated) {
                echo "<script>alert('Asignación actualizada con éxito.'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Error al actualizar la asignación.'); window.location.href='index.php';</script>";
            }
            break;



        case 'edit':
            // Mostrar formulario para editar la empresa
            $id = $_POST['id'];
            $company = CompanyRepository::getCompanyById($id);

            if ($company) {
                require_once('./views/company/editCompany.phtml');
            } else {
                echo "<script>alert('Empresa no encontrada.'); window.location.href='index.php';</script>";
            }
            break;



        case 'delete':
            // Eliminar la empresa
            $id = $_POST['id'];
            $deleted = CompanyRepository::deleteCompany($id);

            if ($deleted) {
                echo "<script>alert('Empresa eliminada con éxito.'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Error al eliminar la empresa.'); window.location.href='index.php';</script>";
            }
            break;


        case 'update':
            // Eliminar la empresa
            $id = $_POST['id'];
            break;


        default:
            // Redirigir a la landing page si no hay acción válida
            require_once('./views/LandingPage.phtml');
            break;
    }
}
