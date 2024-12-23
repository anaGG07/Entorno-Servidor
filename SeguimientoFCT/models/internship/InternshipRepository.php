<?php
require_once('models/base/ModelRepository.php');
require_once('Internship.php');

class InternshipRepository extends ModelRepository
{
    public static function getModel()
    {
        return new Internship();
    }

    public static function getInternshipById($id)
    {
        $connect = connection::connect();
        $q = "SELECT * FROM internship WHERE id = '$id'";
        $result = $connect->query($q);

        if ($internship = $result->fetch_assoc()) {
            return new Internship(
                $internship['id'],
                $internship['id_student'],
                $internship['company_tutor_name'],
                $internship['id_ed_tutor'],
                $internship['start_date'],
                $internship['end_date'],
                $internship['state']
            );
        }
        return false;
    }

    public static function getAllInternships()
    {
        $connect = connection::connect();
        $q = "SELECT * FROM internship";
        $result = $connect->query($q);

        $internships = [];
        while ($row = $result->fetch_assoc()) {
            $internship = new Internship(
                $row['id'],
                $row['id_student'],
                $row['company_tutor_name'],
                $row['id_ed_tutor'],
                $row['start_date'],
                $row['end_date'],
                $row['state']
            );
            $internships[] = $internship;
        }
        return $internships;
    }

    public static function registerInternship($id_student, $company_tutor_name, $id_ed_tutor, $start_date, $end_date, $state)
    {
        $connect = connection::connect();
        $q = "INSERT INTO internship (id_student, company_tutor_name, id_ed_tutor, start_date, end_date, state) 
              VALUES ('$id_student', '$company_tutor_name', '$id_ed_tutor', '$start_date', '$end_date', '$state')";
        $result = $connect->query($q);

        if ($result) {
            return InternshipRepository::getInternshipById($connect->insert_id);
        }
        return false;
    }

    public static function deleteInternship($id)
    {
        $connect = connection::connect();
        $q = "DELETE FROM internship WHERE id = '$id'";
        return $connect->query($q);
    }

    public static function getStudentsCountByCompanyTutorName($tutor_name) {
        $connect = connection::connect();
        $q = "SELECT COUNT(*) as student_count FROM internship WHERE company_tutor_name = '$tutor_name'";
        $result = $connect->query($q);

        if ($row = $result->fetch_assoc()) {
            return $row['student_count'];
        }

        return 0;
    }

    public static function getUnassignedStudents()
    {
        $connect = connection::connect();
        $q = "SELECT * 
              FROM user 
              WHERE isAdmin = -1 
              AND id NOT IN (
                  SELECT id_student 
                  FROM internship 
                  WHERE state = 1
              )";
        $result = $connect->query($q);

        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = new User(
                $row['id'],
                $row['username'],
                $row['email'],
                $row['avatar'],
                $row['bio'],
                $row['isAdmin'],
                $row['visibility']
            );
        }

        return $students;
    }



    public static function createAssignment($id_student, $tutor_name, $id_ed_tutor, $start_date, $end_date)
    {
        $connect = connection::connect();
        $q = "INSERT INTO internship (id_student, company_tutor_name, id_ed_tutor, start_date, end_date, state) 
              VALUES ('$id_student', '$tutor_name', '$id_ed_tutor', '$start_date', '$end_date', 1)";
        return $connect->query($q);
    }


    public static function getStudentsByTutorName($tutor_name) {
        $connect = connection::connect();
        $q = "SELECT u.*, i.state FROM user u
              INNER JOIN internship i ON u.id = i.id_student
              WHERE i.company_tutor_name = '$tutor_name'";
        $result = $connect->query($q);

        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = [
                'user' => new User(
                    $row['id'],
                    $row['username'],
                    $row['email'],
                    $row['avatar'],
                    $row['bio'],
                    $row['isAdmin'],
                    $row['visibility']
                ),
                'state' => $row['state']
            ];
        }

        return $students;
    }



    public static function removeStudentFromCompany($id_student, $tutor_name)
    {
        $connect = connection::connect();
        $q = "DELETE FROM internship 
          WHERE id_student = '$id_student' 
          AND company_tutor_name = '$tutor_name'";
        return $connect->query($q);
    }



    public static function getAssignmentByStudentAndTutor($id_student, $tutor_name)
    {
        $connect = connection::connect();
        $q = "SELECT * 
          FROM internship 
          WHERE id_student = '$id_student' 
          AND company_tutor_name = '$tutor_name'";
        $result = $connect->query($q);

        return $result->fetch_assoc();
    }


     public static function getAssignmentState($id_student) {
        $connect = connection::connect();
        $q = "SELECT state FROM internship WHERE id_student = $id_student";
        $result = $connect->query($q);

        if ($row = $result->fetch_assoc()) {
            return $row['state'];
        }

        return null; 
    }


    public static function updateAssignment($id_student, $new_student_id, $tutor_name, $start_date, $end_date) {
        $connect = connection::connect();
    
        
        $q_update = "UPDATE internship 
                     SET id_student = '$new_student_id', 
                         start_date = '$start_date', 
                         end_date = '$end_date' 
                     WHERE id_student = '$id_student' AND company_tutor_name = '$tutor_name'";
    
        $result = $connect->query($q_update);
    
        
        if ($result) {
            return true;
        } else {
            error_log("Error actualizando asignación: " . $connect->error);
            return false;
        }
    }
    
    

    public static function getAssignmentByStudentId($id_student)
{
    $connect = connection::connect();
    $q = "SELECT * 
          FROM internship 
          WHERE id_student = '$id_student'";
    $result = $connect->query($q);

    if ($row = $result->fetch_assoc()) {
        return [
            'id_student' => $row['id_student'],
            'company_tutor_name' => $row['company_tutor_name'],
            'start_date' => $row['start_date'],
            'end_date' => $row['end_date'],
            'state' => $row['state']
        ];
    }

    return null; 
}

}
