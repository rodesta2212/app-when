<?php
class Guru {
    private $conn;
    private $table_user = 'user';
    private $table_guru = 'guru';

    public $id_guru;
    public $username;
    public $password;
    public $nama;
    public $tgl_lahir;
    public $jenis_kelamin;
    public $telp;
    public $email;
    public $tempat_kelahiran;
    public $role;
    public $id_user;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insertUser() {
        $query = "INSERT INTO {$this->table_user} (id_user, username, password, role) VALUES(:id_user, :username, :password, :role)";

        $stmt = $this->conn->prepare($query);
        // user
        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);

		if ($stmt->execute()) {
			return true;
		} else {
            // var_dump($this->jenis_kelamin);
			return false;
		}
    }
    
    function insertGuru() {
        $query = "INSERT INTO {$this->table_guru} (id_guru, id_user, nama, tgl_lahir, jenis_kelamin, telp, email, tempat_kelahiran) VALUES(:id_guru, :id_user, :nama, :tgl_lahir, :jenis_kelamin, :telp, :email, :tempat_kelahiran)";

        $stmt = $this->conn->prepare($query);
        // guru
        $stmt->bindParam(':id_guru', $this->id_guru);
        $stmt->bindParam(':id_user', $this->id_user);
		$stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':tgl_lahir', $this->tgl_lahir);
        $stmt->bindParam(':jenis_kelamin', $this->jenis_kelamin);
        $stmt->bindParam(':telp', $this->telp);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':tempat_kelahiran', $this->tempat_kelahiran);

		if ($stmt->execute()) {
			return true;
		} else {
            // var_dump($this->jenis_kelamin);
			return false;
		}
	}
	
	function getNewIdGuru() {
		$query = "SELECT MAX(id_guru) AS code FROM {$this->table_guru}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], '12', 8);
		} else {
			return $this->genCode($nomor_terakhir, '12', 8);
		}
    }
    
    function getNewIdUser() {
		$query = "SELECT MAX(id_user) AS code FROM {$this->table_user}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], '');
		} else {
			return $this->genCode($nomor_terakhir, '');
		}
	}

	function genCode($latest, $key, $chars = 0) {
    $new = intval(substr($latest, strlen($key))) + 1;
    $numb = str_pad($new, $chars, "0", STR_PAD_LEFT);
    return $key . $numb;
	}

	function genNextCode($start, $key, $chars = 0) {
    $new = str_pad($start, $chars, "0", STR_PAD_LEFT);
    return $key . $new;
	}

}
