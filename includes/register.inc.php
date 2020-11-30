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

	function insert() {
        $query = "INSERT INTO {$this->table_user} VALUES(?, ?, ?, ?)";
        // $query = "INSERT INTO {$this->table_guru} VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        // user
        $stmt->bindParam(1, $this->id_user);
        $stmt->bindParam(2, $this->username);
        $stmt->bindParam(3, $this->password);
        $stmt->bindParam(4, $this->role);

        // guru
        // $stmt->bindParam(1, $this->id_guru);
        // $stmt->bindParam(2, $this->id_user);
		// $stmt->bindParam(3, $this->nama);
        // $stmt->bindParam(4, $this->tgl_lahir);
        // $stmt->bindParam(5, $this->jenis_kelamin);
        // $stmt->bindParam(6, $this->telp);
        // $stmt->bindParam(7, $this->email);
        // $stmt->bindParam(8, $this->tempat_kelahiran);

		if ($stmt->execute()) {
			return true;
		} else {
            var_dump($this->tempat_kelahiran);
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
