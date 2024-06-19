<?php
class Admin {
    private $admin_id;
    private $username;
    private $password;

    public function getAdminId() {
        return $this->admin_id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setAdminId($admin_id) {
        $this->admin_id = $admin_id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
}