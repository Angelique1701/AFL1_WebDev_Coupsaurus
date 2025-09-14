<?php
class model {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "agency");

        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function getAgency() {
        $sql = "SELECT * FROM companies";
        $result = $this->conn->query($sql);

        $agencies = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $agencies[] = $row;
            }
        }
        return $agencies;
    }

    public function addAgency($company_name, $location, $ceo_name, $founding_year) {
        $stmt = $this->conn->prepare("INSERT INTO companies (company_name, location, ceo_name, founding_year) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $company_name, $location, $ceo_name, $founding_year);
        return $stmt->execute();
    }

    public function updateAgency($company_id, $company_name, $location, $ceo_name, $founding_year) {
        $stmt = $this->conn->prepare("UPDATE companies SET company_name = ?, location = ?, ceo_name = ?, founding_year = ? WHERE company_id = ?");
        $stmt->bind_param("sssii", $company_name, $location, $ceo_name, $founding_year, $company_id);
        return $stmt->execute();
    }

    public function deleteAgency($company_id) {
        $stmt = $this->conn->prepare("DELETE FROM companies WHERE company_id = ?");
        $stmt->bind_param("i", $company_id);
        return $stmt->execute();
    }
}
