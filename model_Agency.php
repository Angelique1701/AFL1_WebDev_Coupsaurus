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
        $sql = "SELECT * FROM agency";
        $result = $this->conn->query($sql);

        $agencies = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $agencies[] = $row;
            }
        }
        return $agencies;
    }

    public function addAgency($name, $address, $phone) {
        $stmt = $this->conn->prepare("INSERT INTO agency (name, address, phone) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $address, $phone);
        return $stmt->execute();
    }

    public function updateAgency($id, $name, $address, $phone) {
        $stmt = $this->conn->prepare("UPDATE agency SET name = ?, address = ?, phone = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $address, $phone, $id);
        return $stmt->execute();
    }

    public function deleteAgency($id) {
        $stmt = $this->conn->prepare("DELETE FROM agency WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

}