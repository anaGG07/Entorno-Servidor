<?php
require_once('models/base/ModelRepository.php');
require_once('Company.php');

class CompanyRepository extends ModelRepository
{
    public static function getModel()
    {
        return new Company();
    }



    public static function getCompanyById($id)
    {
        $connect = connection::connect();
        $q = "SELECT id, name, nif, tutor_name, phone, email, address FROM company WHERE id = '$id'";
        $result = $connect->query($q);

        if ($company = $result->fetch_assoc()) {
            return new Company(
                $company['id'],
                $company['name'],
                $company['nif'],
                $company['tutor_name'],
                $company['phone'],
                $company['email'],
                $company['address']
            );
        }
        return false;
    }


    public static function getAllCompanies()
    {
        $connect = connection::connect();
        $q = "SELECT * FROM company";
        $result = $connect->query($q);

        $companies = [];
        while ($row = $result->fetch_assoc()) {
            $companies[] = new Company(
                $row['id'],
                $row['name'],
                $row['nif'],
                $row['tutor_name'],
                $row['phone'],
                $row['email'],
                $row['address']
            );
        }

        return $companies;
    }

    public static function registerCompany($name, $nif, $tutor_name, $phone, $email, $address)
    {
        $connect = connection::connect();
        $q = "INSERT INTO company (name, nif, tutor_name, phone, email, address) 
              VALUES ('$name', '$nif', '$tutor_name', '$phone', '$email', '$address')";
        $result = $connect->query($q);

        if ($result) {
            return CompanyRepository::getCompanyById($connect->insert_id);
        }
        return false;
    }



    public static function deleteCompany($id)
    {
        $connect = connection::connect();
        $q = "UPDATE company SET visibility = 0 WHERE id = '$id'";
        return $connect->query($q);
    }


    public static function getCompanyByTutorName($tutor_name)
    {
        $connect = connection::connect();
        $q = "SELECT * FROM company WHERE tutor_name = '$tutor_name'";
        $result = $connect->query($q);

        if ($company = $result->fetch_assoc()) {
            return new Company(
                $company['id'],
                $company['name'],
                $company['nif'],
                $company['tutor_name'],
                $company['phone'],
                $company['email'],
                $company['address']
            );
        }
        return false;
    }

    public static function getAllVisibleCompanies()
    {
        $connect = connection::connect();
        $q = "SELECT * FROM company WHERE visibility = 1";
        $result = $connect->query($q);

        $companies = [];
        while ($row = $result->fetch_assoc()) {
            $companies[] = new Company(
                $row['id'],
                $row['name'],
                $row['nif'],
                $row['tutor_name'],
                $row['phone'],
                $row['email'],
                $row['address']
            );
        }

        return $companies;
    }

    public static function updateCompany($company)
    {
        $connect = connection::connect();

        $id = $company->getId();
        $name = $company->getName();
        $nif = $company->getNif();
        $tutor_name = $company->getTutorName();
        $phone = $company->getPhone();
        $email = $company->getEmail();
        $address = $company->getAddress();
        $visibility = $company->getVisibility();

        $q = "UPDATE company 
          SET name = '$name', 
              nif = '$nif', 
              tutor_name = '$tutor_name', 
              phone = '$phone', 
              email = '$email', 
              address = '$address', 
              visibility = '$visibility'
          WHERE id = '$id'";
        return $connect->query($q);
    }

    public static function search($query)
{
    $connect = connection::connect();
    $query = $connect->real_escape_string($query);

    $q = "SELECT * FROM company 
          WHERE name LIKE '%$query%' 
          OR tutor_name LIKE '%$query%'";
    $result = $connect->query($q);

    $companies = [];
    while ($row = $result->fetch_assoc()) {
        $companies[] = new Company(
            $row['id'],
            $row['name'],
            $row['nif'],
            $row['tutor_name'],
            $row['phone'],
            $row['email'],
            $row['address']
        );
    }

    return $companies;
}

}
