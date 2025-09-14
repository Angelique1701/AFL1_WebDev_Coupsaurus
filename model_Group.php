<?php
class model {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "agency");

        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function getGroups() {
        $sql = "SELECT g.group_id, g.group_name, g.gdebut_date, g.status, 
                        c.company_name AS agency_name
                FROM groups g
                JOIN companies c ON g.company_id = c.company_id";
        $result = $this->conn->query($sql);

        $groups = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $groups[] = $row;
            }
        }
        return $groups;
    }

    public function addGroup($company_id, $group_name, $gdebut_date, $status) {
        $stmt = $this->conn->prepare("INSERT INTO groups (company_id, group_name, gdebut_date, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $company_id, $group_name, $gdebut_date, $status);
        return $stmt->execute();
    }

    public function updateGroup($group_id, $company_id, $group_name, $gdebut_date, $status) {
        $stmt = $this->conn->prepare("UPDATE groups 
                                    SET company_id = ?, group_name = ?, gdebut_date = ?, status = ? 
                                    WHERE group_id = ?");
        $stmt->bind_param("isssi", $company_id, $group_name, $gdebut_date, $status, $group_id);
        return $stmt->execute();
    }

    public function deleteGroup($group_id) {
        $stmt = $this->conn->prepare("DELETE FROM groups WHERE group_id = ?");
        $stmt->bind_param("i", $group_id);
        return $stmt->execute();
    }

    public function __destruct() {
        $this->conn->close();
    }
}
