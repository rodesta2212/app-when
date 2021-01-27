<?php
class Penguji {
	private $conn;
    private $table_penguji = 'penguji';
    private $table_user = 'user';

    public $id_penguji;
    public $id_user;
    public $nama;
    public $alamat;
    public $telp;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_penguji} VALUES(?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_penguji);
        $stmt->bindParam(2, $this->id_user);
        $stmt->bindParam(3, $this->nama);
        $stmt->bindParam(4, $this->alamat);
        $stmt->bindParam(5, $this->telp);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_penguji) AS code FROM {$this->table_penguji}";
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

	function readAll() {
		$query = "SELECT A.id_penguji, A.id_user, A.nama, A.alamat, A.telp, B.username, B.password  FROM {$this->table_penguji} A LEFT JOIN {$this->table_user} B ON A.id_user=B.id_user ORDER BY id_penguji ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_penguji} WHERE id_penguji=:id_penguji LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_penguji', $this->id_penguji);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_penguji = $row['id_penguji'];
        $this->nama = $row['nama'];
        $this->alamat = $row['alamat'];
        $this->telp = $row['telp'];
	}

	function update() {
		$query = "UPDATE {$this->table_penguji}
			SET
                id_penguji = :id_penguji,
                nama = :nama,
                alamat = :alamat,
				telp = :telp
			WHERE
				id_penguji = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_penguji', $this->id_penguji);
        $stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':alamat', $this->alamat);
        $stmt->bindParam(':telp', $this->telp);
        $stmt->bindParam(':id', $this->id_penguji);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_penguji} WHERE id_penguji = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_penguji);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
