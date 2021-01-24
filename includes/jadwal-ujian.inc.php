<?php
class JadwalUjian {
	private $conn;
	private $table_jadwal_ujian = 'jadwal_ujian';
	private $table_ujian = 'ujian';
	private $table_penguji = 'penguji';

    public $id_jadwal_ujian;
    public $id_ujian;
    public $tgl_ujian;
    public $id_penguji;
    public $tempat;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_jadwal_ujian} VALUES(?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_jadwal_ujian);
        $stmt->bindParam(2, $this->id_ujian);
        $stmt->bindParam(3, $this->tgl_ujian);
        $stmt->bindParam(4, $this->id_penguji);
        $stmt->bindParam(5, $this->tempat);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_jadwal_ujian) AS code FROM {$this->table_jadwal_ujian}";
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
		$query = "SELECT A.id_jadwal_ujian, A.tgl_ujian, A.tempat, B.nama AS nama_ujian, C.nama AS nama_penguji FROM {$this->table_jadwal_ujian} A LEFT JOIN {$this->table_ujian} B ON A.id_ujian=B.id_ujian LEFT JOIN {$this->table_penguji} C ON A.id_penguji=C.id_penguji ORDER BY id_jadwal_ujian ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_jadwal_ujian} WHERE id_jadwal_ujian=:id_jadwal_ujian LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_jadwal_ujian', $this->id_jadwal_ujian);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_jadwal_ujian = $row['id_jadwal_ujian'];
		$this->id_ujian = $row['id_ujian'];
        $this->tgl_ujian = $row['tgl_ujian'];
        $this->id_penguji = $row['id_penguji'];
        $this->tempat = $row['tempat'];
	}

	function update() {
		$query = "UPDATE {$this->table_jadwal_ujian}
			SET
                id_ujian = :id_ujian,
                tgl_ujian = :tgl_ujian,
                id_penguji = :id_penguji,
				tempat = :tempat
			WHERE
				id_jadwal_ujian = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_ujian', $this->id_ujian);
        $stmt->bindParam(':tgl_ujian', $this->tgl_ujian);
        $stmt->bindParam(':id_penguji', $this->id_penguji);
        $stmt->bindParam(':tempat', $this->tempat);
        $stmt->bindParam(':id', $this->id_jadwal_ujian);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_jadwal_ujian} WHERE id_jadwal_ujian = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_jadwal_ujian);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
