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

public function getGroups() {
        $sql = "SELECT g.id, g.group_name, a.name AS agency_name 
                FROM groups g 
                JOIN agency a ON g.agency_id = a.id";
        $result = $this->conn->query($sql);

        $groups = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $groups[] = $row;
            }
        }
        return $groups;
    }

    public function addGruop($agency_id, $group_name) {
        $stmt = $this->conn->prepare("INSERT INTO groups (agency_id, group_name) VALUES (?, ?)");
        $stmt->bind_param("is", $agency_id, $group_name);
        return $stmt->execute();
    }

    public function updateGroup($id, $agency_id, $group_name) {
        $stmt = $this->conn->prepare("UPDATE groups SET agency_id = ?, group_name = ? WHERE id = ?");
        $stmt->bind_param("isi", $agency_id, $group_name, $id);
        return $stmt->execute();
    }

    public function deleteGroup($id) {
        $stmt = $this->conn->prepare("DELETE FROM groups WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function __destruct() {
        $this->conn->close();
    }
}