<?php
require_once('models/base/Model.php');

class Internship extends Model
{
    // ** PROPIEDADES HEREDADAS DE MODEL **
    protected $entityName = "Práctica";
    protected $tableName = "internship";
    protected $headers = ["Estudiante", "Empresa (Tutor)", "Tutor Educativo", "Fecha Inicio", "Fecha Fin", "Estado"];
    protected $columns = ["id_student", "company_tutor_name", "id_ed_tutor", "start_date", "end_date", "state"];

    // ** PROPIEDADES PROPIAS **
    protected $id;
    private $id_student;
    private $company_tutor_name;
    private $id_ed_tutor;
    private $start_date;
    private $end_date;
    private $state;

    // ** CONSTRUCTOR **
    public function __construct($id = null, $id_student = null, $company_tutor_name = null, $id_ed_tutor = null, $start_date = null, $end_date = null, $state = 0)
    {
        $this->id = $id;
        $this->id_student = $id_student;
        $this->company_tutor_name = $company_tutor_name;
        $this->id_ed_tutor = $id_ed_tutor;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->state = $state;
    }

    // ***** GETTERS *****
    public function getId() { return $this->id; }
    public function getStudentId() { return $this->id_student; }
    public function getCompanyTutorName() { return $this->company_tutor_name; }
    public function getEducationalTutorId() { return $this->id_ed_tutor; }
    public function getStartDate() { return $this->start_date; }
    public function getEndDate() { return $this->end_date; }
    public function getState() { return $this->state; }

    // ***** SETTERS *****
    public function setStudentId($value) { $this->id_student = $value; }
    public function setCompanyTutorName($value) { $this->company_tutor_name = $value; }
    public function setEducationalTutorId($value) { $this->id_ed_tutor = $value; }
    public function setStartDate($value) { $this->start_date = $value; }
    public function setEndDate($value) { $this->end_date = $value; }
    public function setState($value) { $this->state = $value; }
}
