<?php
session_start();

class User {
    public $Username;
    private $Password;
    public $Email;
    public $Role;

    public function __construct($username, $password, $email = "", $role = "user") {
        $this->Username = $username;
        $this->Password = password_hash($password, PASSWORD_DEFAULT);
        $this->Email = $email;
        $this->Role = $role;
    }

    public function ValidateLogin($email, $password) {
        return (
            $this->Email === $email &&
            password_verify($password, $this->Password)
        );
    }

    public function LoginUser() {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $this->Username;
        $_SESSION['email'] = $this->Email;
    }

    public function IsLoggedin() {
        return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    }

    public function Logout() {
        session_destroy();
        $_SESSION = [];
    }

    public function SetPassword($newPassword) {
        $this->Password = password_hash($newPassword, PASSWORD_DEFAULT);
    }

    public function GetPassword() {
        return $this->Password;
    }
}
?>