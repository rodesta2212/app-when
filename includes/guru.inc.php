<?php
class Guru {
	private $conn;
    private $table_guru = 'guru';
    private $table_user = 'user';

    public $id_guru;
    public $id_user;
    public $nama;
    public $alamat;
    public $telp;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_guru} VALUES(?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_guru);
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
		$query = "SELECT MAX(id_guru) AS code FROM {$this->table_guru}";
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
		$query = "SELECT A.id_guru, A.nama, A.alamat, A.telp, B.id_user, B.username, B.password  FROM {$this->table_guru} A LEFT JOIN {$this->table_user} B ON A.id_user=B.id_user ORDER BY id_guru ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_guru} WHERE id_guru=:id_guru LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_guru', $this->id_guru);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_guru = $row['id_guru'];
        $this->nama = $row['nama'];
        $this->alamat = $row['alamat'];
        $this->telp = $row['telp'];
	}

	function update() {
		$query = "UPDATE {$this->table_guru}
			SET
                id_guru = :id_guru,
                nama = :nama,
                alamat = :alamat,
				telp = :telp
			WHERE
				id_guru = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_guru', $this->id_guru);
        $stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':alamat', $this->alamat);
        $stmt->bindParam(':telp', $this->telp);
        $stmt->bindParam(':id', $this->id_guru);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_guru} WHERE id_guru = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_guru);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
