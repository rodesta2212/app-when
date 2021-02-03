<?php
class JadwalGuru {
	private $conn;
	private $table_jadwal_guru = 'jadwal_guru';
	private $table_jadwal_ujian = 'jadwal_ujian';
	private $table_ujian = 'ujian';
	private $table_penguji = 'penguji';

    public $id_jadwal_guru;
    public $id_jadwal_ujian;
    public $id_guru;
	public $status;
	public $nilai;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_jadwal_guru} VALUES(?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_jadwal_guru);
        $stmt->bindParam(2, $this->id_jadwal_ujian);
        $stmt->bindParam(3, $this->id_guru);
        $stmt->bindParam(4, $this->status);
        $stmt->bindParam(5, $this->nilai);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_jadwal_guru) AS code FROM {$this->table_jadwal_guru}";
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
		$query = "SELECT A.id_jadwal_guru, A.id_guru, A.status, A.nilai, B.tgl_ujian, B.tempat, C.nama AS nama_ujian, D.nama AS nama_penguji
		FROM {$this->table_jadwal_guru} A LEFT JOIN {$this->table_jadwal_ujian} B ON A.id_jadwal_ujian=B.id_jadwal_ujian 
		LEFT JOIN {$this->table_ujian} C ON B.id_ujian=C.id_ujian
		LEFT JOIN {$this->table_penguji} D ON B.id_penguji=D.id_penguji 
		ORDER BY id_jadwal_guru DESC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readAllGuru() {
		$query = "SELECT A.id_jadwal_guru, A.id_guru, A.status, A.nilai, B.tgl_ujian, B.tempat, C.nama AS nama_ujian, D.nama AS nama_penguji
		FROM {$this->table_jadwal_guru} A LEFT JOIN {$this->table_jadwal_ujian} B ON A.id_jadwal_ujian=B.id_jadwal_ujian 
		LEFT JOIN {$this->table_ujian} C ON B.id_ujian=C.id_ujian
		LEFT JOIN {$this->table_penguji} D ON B.id_penguji=D.id_penguji 
		WHERE A.id_guru=:id_guru ORDER BY id_jadwal_guru DESC";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':id_guru', $this->id_guru);
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM {$this->table_jadwal_guru} WHERE id_jadwal_guru=:id_jadwal_guru LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_jadwal_guru', $this->id_jadwal_guru);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_jadwal_guru = $row['id_jadwal_guru'];
		$this->id_ujian = $row['id_ujian'];
        $this->tgl_ujian = $row['tgl_ujian'];
        $this->id_penguji = $row['id_penguji'];
        $this->tempat = $row['tempat'];
	}

	function update() {
		$query = "UPDATE {$this->table_jadwal_guru}
			SET
                id_ujian = :id_ujian,
                tgl_ujian = :tgl_ujian,
                id_penguji = :id_penguji,
				tempat = :tempat
			WHERE
				id_jadwal_guru = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_ujian', $this->id_ujian);
        $stmt->bindParam(':tgl_ujian', $this->tgl_ujian);
        $stmt->bindParam(':id_penguji', $this->id_penguji);
        $stmt->bindParam(':tempat', $this->tempat);
        $stmt->bindParam(':id', $this->id_jadwal_guru);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM {$this->table_jadwal_guru} WHERE id_jadwal_guru = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_jadwal_guru);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
