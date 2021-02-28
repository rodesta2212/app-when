4<?php
class JadwalGuru {
	private $conn;
	private $table_jadwal_guru = 'jadwal_guru';
	private $table_jadwal_ujian = 'jadwal_ujian';
	private $table_ujian = 'ujian';
	private $table_penguji = 'penguji';
	private $table_guru = 'guru';

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
		$query = "SELECT A.id_jadwal_guru, A.id_guru, A.status, A.nilai, B.tgl_ujian, B.tempat, C.nama AS nama_ujian, D.nama AS nama_penguji, E.nama AS nama_guru
		FROM {$this->table_jadwal_guru} A LEFT JOIN {$this->table_jadwal_ujian} B ON A.id_jadwal_ujian=B.id_jadwal_ujian 
		LEFT JOIN {$this->table_ujian} C ON B.id_ujian=C.id_ujian
		LEFT JOIN {$this->table_penguji} D ON B.id_penguji=D.id_penguji 
		LEFT JOIN {$this->table_guru} E ON A.id_guru=E.id_guru 
		ORDER BY id_jadwal_guru DESC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readAllVerifikasi() {
		$query = "SELECT A.id_jadwal_guru, A.id_guru, A.status, A.nilai, B.tgl_ujian, B.tempat, C.nama AS nama_ujian, C.nilai_lulus, D.nama AS nama_penguji, E.nama AS nama_guru
		FROM {$this->table_jadwal_guru} A LEFT JOIN {$this->table_jadwal_ujian} B ON A.id_jadwal_ujian=B.id_jadwal_ujian 
		LEFT JOIN {$this->table_ujian} C ON B.id_ujian=C.id_ujian
		LEFT JOIN {$this->table_penguji} D ON B.id_penguji=D.id_penguji 
		LEFT JOIN {$this->table_guru} E ON A.id_guru=E.id_guru 
		WHERE A.status='verifikasi' && B.id_penguji=:id_penguji
		ORDER BY id_jadwal_guru DESC";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':id_penguji', $this->id_penguji);
		$stmt->execute();

		return $stmt;
	}

	function readAllPenguji() {
		$query = "SELECT A.id_jadwal_guru, A.id_guru, A.status, A.nilai, B.tgl_ujian, B.tempat, C.nama AS nama_ujian, C.nilai_lulus, D.nama AS nama_penguji, E.nama AS nama_guru
		FROM {$this->table_jadwal_guru} A LEFT JOIN {$this->table_jadwal_ujian} B ON A.id_jadwal_ujian=B.id_jadwal_ujian 
		LEFT JOIN {$this->table_ujian} C ON B.id_ujian=C.id_ujian
		LEFT JOIN {$this->table_penguji} D ON B.id_penguji=D.id_penguji 
		LEFT JOIN {$this->table_guru} E ON A.id_guru=E.id_guru 
		WHERE A.status='verifikasi' && B.id_penguji=:id_penguji
		GROUP BY B.tgl_ujian
		ORDER BY id_jadwal_guru DESC";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':id_penguji', $this->id_penguji);
		$stmt->execute();

		return $stmt;
	}

	function readAllHasilPenguji() {
		$query = "SELECT E.nama AS nama_guru, AVG(nilai) AS avg_nilai, AVG(nilai_lulus) AS avg_nilai_lulus, IF(AVG(nilai)>=AVG(nilai_lulus), 'Lulus', 'Tidak Lulus') AS keterangan
		FROM {$this->table_jadwal_guru} A LEFT JOIN {$this->table_jadwal_ujian} B ON A.id_jadwal_ujian=B.id_jadwal_ujian 
		LEFT JOIN {$this->table_ujian} C ON B.id_ujian=C.id_ujian
		LEFT JOIN {$this->table_penguji} D ON B.id_penguji=D.id_penguji 
		LEFT JOIN {$this->table_guru} E ON A.id_guru=E.id_guru 
		WHERE A.status='verifikasi' && B.id_penguji=:id_penguji
		GROUP BY nama_guru
		ORDER BY nama_guru ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':id_penguji', $this->id_penguji);
		$stmt->execute();

		return $stmt;
	}

	function readAllHasil() {
		$query = "SELECT E.nama AS nama_guru, AVG(nilai) AS avg_nilai, AVG(nilai_lulus) AS avg_nilai_lulus, IF(AVG(nilai)>=AVG(nilai_lulus), 'Lulus', 'Tidak Lulus') AS keterangan
		FROM {$this->table_jadwal_guru} A LEFT JOIN {$this->table_jadwal_ujian} B ON A.id_jadwal_ujian=B.id_jadwal_ujian 
		LEFT JOIN {$this->table_ujian} C ON B.id_ujian=C.id_ujian
		LEFT JOIN {$this->table_penguji} D ON B.id_penguji=D.id_penguji 
		LEFT JOIN {$this->table_guru} E ON A.id_guru=E.id_guru 
		WHERE A.status='verifikasi' 
		GROUP BY nama_guru
		ORDER BY nama_guru ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':id_penguji', $this->id_penguji);
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

	function readAllNilai() {
		$query = "SELECT A.id_jadwal_guru, A.id_guru, A.status, A.nilai, B.tgl_ujian, B.tempat, C.nama AS nama_ujian, C.nilai_lulus, D.nama AS nama_penguji, E.nama AS nama_guru
		FROM {$this->table_jadwal_guru} A LEFT JOIN {$this->table_jadwal_ujian} B ON A.id_jadwal_ujian=B.id_jadwal_ujian 
		LEFT JOIN {$this->table_ujian} C ON B.id_ujian=C.id_ujian
		LEFT JOIN {$this->table_penguji} D ON B.id_penguji=D.id_penguji 
		LEFT JOIN {$this->table_guru} E ON A.id_guru=E.id_guru 
		WHERE A.status='verifikasi' && A.id_guru=:id_guru
		ORDER BY id_jadwal_guru DESC";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(':id_guru', $this->id_guru);
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT A.id_jadwal_guru, A.id_guru, A.status, A.nilai, B.id_jadwal_ujian, B.tgl_ujian, B.tempat, C.id_ujian, D.id_penguji
		FROM {$this->table_jadwal_guru} A LEFT JOIN {$this->table_jadwal_ujian} B ON A.id_jadwal_ujian=B.id_jadwal_ujian 
		LEFT JOIN {$this->table_ujian} C ON B.id_ujian=C.id_ujian
		LEFT JOIN {$this->table_penguji} D ON B.id_penguji=D.id_penguji 
		WHERE id_jadwal_guru=:id_jadwal_guru LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_jadwal_guru', $this->id_jadwal_guru);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_jadwal_guru = $row['id_jadwal_guru'];
		$this->id_jadwal_ujian = $row['id_jadwal_ujian'];
		$this->id_ujian = $row['id_ujian'];
        $this->tgl_ujian = $row['tgl_ujian'];
        $this->id_penguji = $row['id_penguji'];
		$this->tempat = $row['tempat'];
		$this->status = $row['status'];
		$this->id_guru = $row['id_guru'];
	}

	function readOneNilai() {
		$query = "SELECT AVG(nilai) AS avg_nilai, AVG(nilai_lulus) AS avg_nilai_lulus
		FROM {$this->table_jadwal_guru} A LEFT JOIN {$this->table_jadwal_ujian} B ON A.id_jadwal_ujian=B.id_jadwal_ujian 
		LEFT JOIN {$this->table_ujian} C ON B.id_ujian=C.id_ujian
		LEFT JOIN {$this->table_penguji} D ON B.id_penguji=D.id_penguji 
		LEFT JOIN {$this->table_guru} E ON A.id_guru=E.id_guru 
		WHERE A.status='verifikasi' && A.id_guru=:id_guru
		ORDER BY id_jadwal_guru DESC";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_guru', $this->id_guru);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->avg_nilai = $row['avg_nilai'];
		$this->avg_nilai_lulus = $row['avg_nilai_lulus'];
	}

	function update() {
		$query = "UPDATE {$this->table_jadwal_guru}
			SET
                id_jadwal_ujian = :id_jadwal_ujian,
                id_guru = :id_guru,
				status = :status
			WHERE
				id_jadwal_guru = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_jadwal_ujian', $this->id_jadwal_ujian);
        $stmt->bindParam(':id_guru', $this->id_guru);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id', $this->id_jadwal_guru);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function updateNilai() {
		$query = "UPDATE {$this->table_jadwal_guru}
			SET
                id_jadwal_ujian = :id_jadwal_ujian,
                id_guru = :id_guru,
				status = :status,
				nilai = :nilai
			WHERE
				id_jadwal_guru = :id";
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id_jadwal_ujian', $this->id_jadwal_ujian);
        $stmt->bindParam(':id_guru', $this->id_guru);
        $stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':nilai', $this->nilai);
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
