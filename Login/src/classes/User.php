<?php
// Functie: classdefinitie User 
// Auteur: Studentnaam

class User {

    // Eigenschappen 
    public string $username = "";
    public string $email = "";
    private string $password = "";
    public string $role = "user";

    // -----------------------
    // Database connectie
    // -----------------------
    private function dbConnect() {
        $host = 'localhost';      // Servernaam (vaak localhost)
        $dbname = 'Login';        // Database naam
        $user = 'root';           // Database gebruiker
        $pass = '';               // Wachtwoord (vaak leeg bij XAMPP)

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // -----------------------
    // Setters / Getters
    // -----------------------
    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    // -----------------------
    // Toon user (debug)
    // -----------------------
    public function showUser() {
        echo "<br>Username: $this->username<br>";
        echo "Password: $this->password<br>";
        echo "Email: $this->email<br>";
        echo "Role: $this->role<br>";
    }

    // -----------------------
    // Validatie invoer
    // -----------------------
    public function validateUser() {
        $errors = [];

        if (empty($this->username)) {
            array_push($errors, "Invalid username");
        } else if (strlen($this->username) < 3 || strlen($this->username) > 50) {
            array_push($errors, "Username moet tussen 3 en 50 tekens zijn");
        }

        if (empty($this->password)) {
            array_push($errors, "Invalid password");
        }

        return $errors;
    }

    // -----------------------
    // Registreren nieuwe user
    // -----------------------
    public function registerUser(): array {
        $errors = [];

        try {
            $pdo = $this->dbConnect();

            // Check of username al bestaat
            $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
            $stmt->execute(['username' => $this->username]);

            if ($stmt->rowCount() > 0) {
                array_push($errors, "Username bestaat al.");
            } else {
                // Hash het wachtwoord
                $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

                // Voeg nieuwe user toe
                $stmt = $pdo->prepare("
                    INSERT INTO user (username, password, email, role)
                    VALUES (:username, :password, :email, :role)
                ");
                $stmt->execute([
                    'username' => $this->username,
                    'password' => $hashedPassword,
                    'email' => $this->email,
                    'role' => $this->role
                ]);
            }
        } catch (PDOException $e) {
            array_push($errors, "Database error: " . $e->getMessage());
        }

        return $errors;
    }

    // -----------------------
    // Inloggen bestaande user
    // -----------------------
    public function loginUser(): bool {
        try {
            $pdo = $this->dbConnect();

            $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
            $stmt->execute(['username' => $this->username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($this->password, $user['password'])) {
                session_start();
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    // -----------------------
    // Check of iemand is ingelogd
    // -----------------------
    public function isLoggedin(): bool {
        session_start();
        return isset($_SESSION['username']);
    }

    // -----------------------
    // Ophalen user uit database
    // -----------------------
    public function getUser(string $username): bool {
        try {
            $pdo = $this->dbConnect();
            $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $this->username = $user['username'];
                $this->email = $user['email'];
                $this->role = $user['role'];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    // -----------------------
    // Uitloggen
    // -----------------------
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
    }

}
?>
