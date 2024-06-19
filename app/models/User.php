<?php
class User {
    private $user_id;
    private $username;
    private $email;
    private $password;
    private $reset_token_hash;
    private $reset_token_expires_at;

    public function getUserId() {
        return $this->user_id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getResetTokenHash() {
        return $this->reset_token_hash;
    }

    public function getResetTokenExpiresAt() {
        return $this->reset_token_expires_at;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setResetTokenHash($reset_token_hash) {
        $this->reset_token_hash = $reset_token_hash;
    }

    public function setResetTokenExpiresAt($reset_token_expires_at) {
        $this->reset_token_expires_at = $reset_token_expires_at;
    }
}

