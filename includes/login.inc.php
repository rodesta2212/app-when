<?php
class Login {
    private $conn;
    private $table_user = "user";
    private $table_role1 = "dikdasmen";
    private $table_role2 = "guru";
    private $table_role3 = "penguji";

    public $user;
    public $username;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login() {
        $user = $this->checkCredentialsDikdasmen();
        if ($user) {
            $this->user = $user;
            session_start();
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['id_dikdasmen'] = $user['id_dikdasmen'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];
            return $user['nama'];
        }else {
            $user = $this->checkCredentialsGuru();
            if ($user) {
                $this->user = $user;
                session_start();
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['id_guru'] = $user['id_guru'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['role'] = $user['role'];
                return $user['nama'];
            }else {
                $user = $this->checkCredentialsPenguji();
                if ($user) {
                    $this->user = $user;
                    session_start();
                    $_SESSION['id_user'] = $user['id_user'];
                    $_SESSION['id_penguji'] = $user['id_penguji'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['password'] = $user['password'];
                    $_SESSION['nama'] = $user['nama'];
                    $_SESSION['role'] = $user['role'];
                    return $user['nama'];
                }else {
                    return false;
                }
            }
        }
        return false;
    }

    protected function checkCredentialsDikdasmen() {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_user.' LEFT JOIN '.$this->table_role1.' ON '.$this->table_user.'.id_user='.$this->table_role1.'.id_user WHERE username=? AND password=? AND role="dikdasmen" LIMIT 1');
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->password;
            if ($submitted_pass == $data['password']) return $data;
        }
        return false;
    }

    protected function checkCredentialsGuru() {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_user.' LEFT JOIN '.$this->table_role2.' ON '.$this->table_user.'.id_user='.$this->table_role2.'.id_user WHERE username=? AND password=? AND role="guru" LIMIT 1');
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->password;
            if ($submitted_pass == $data['password']) return $data;
        }
        return false;
    }
    
    protected function checkCredentialsPenguji() {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_user.' LEFT JOIN '.$this->table_role3.' ON '.$this->table_user.'.id_user='.$this->table_role3.'.id_user WHERE username=? AND password=? AND role="penguji" LIMIT 1');
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->password;
            if ($submitted_pass == $data['password']) return $data;
        }
        return false;
    }

    public function getUser() {
        return $this->user;
    }
}
