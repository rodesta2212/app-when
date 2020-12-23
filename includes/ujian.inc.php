<?php
class Ujian {
	private $conn;
    private $table_ujian = 'ujian';

    public $id_ujian;
    public $nama;
    public $nilai_lulus;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_ujian} VALUES(?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_ujian);
        $stmt->bindParam(2, $this->nama);
        $stmt->bindParam(3, $this->nilai_lulus);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_ujian) AS code FROM {$this->table_ujian}";
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
		$query = "SELECT id_ujian, nama, nilai_lulus FROM {$this->table_ujian} ORDER BY id_ujian ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_ujian} WHERE id_ujian=:id_ujian LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_ujian', $this->id_ujian);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_ujian = $row['id_ujian'];
        $this->nama = $row['nama'];
        $this->nilai_lulus = $row['nilai_lulus'];
        $this->telp = $row['telp'];
	}

	function update() {
		$query = "UPDATE {$this->table_ujian}
			SET
                id_ujian = :id_ujian,
                nama = :nama,
                nilai_lulus = :nilai_lulus,
				telp = :telp
			WHERE
				id_ujian = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_ujian', $this->id_ujian);
        $stmt->bindParam(':nama', $this->nama);
        $stmt->bindParam(':nilai_lulus', $this->nilai_lulus);
        $stmt->bindParam(':telp', $this->telp);
        $stmt->bindParam(':id', $this->id_ujian);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_ujian} WHERE id_ujian = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_ujian);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
