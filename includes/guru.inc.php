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
		$query = "SELECT A.id_guru, A.nama, A.alamat, A.telp, B.id_user, B.username, B.password, A.status  FROM {$this->table_guru} A LEFT JOIN {$this->table_user} B ON A.id_user=B.id_user ORDER BY id_guru ASC";
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
		$this->id_user = $row['id_user'];
        $this->nama = $row['nama'];
		$this->tgl_lahir = $row['tgl_lahir'];
		$this->jenis_kelamin = $row['jenis_kelamin'];
		$this->telp = $row['telp'];
		$this->email = $row['email'];
		$this->tempat_kelahiran = $row['tempat_kelahiran'];
		$this->agama = $row['agama'];
		$this->pendidikan = $row['pendidikan'];
		$this->nama_lembaga = $row['nama_lembaga'];
		$this->tahun_ijazah = $row['tahun_ijazah'];
		$this->jumlah_program_study = $row['jumlah_program_study'];
		$this->alamat = $row['alamat'];
		$this->fc_ijazah = $row['fc_ijazah'];
		$this->status_perkawinan = $row['status_perkawinan'];
		$this->tanggal_mulai_bertugas = $row['tanggal_mulai_bertugas'];
		$this->fc_sk_sekolah = $row['fc_sk_sekolah'];
		$this->fc_sk_gtt = $row['fc_sk_gtt'];
		$this->fc_kartu_anggota_muhammadiyah = $row['fc_kartu_anggota_muhammadiyah'];
		$this->fc_kartu_keluarga = $row['fc_kartu_keluarga'];
		$this->sk_membaca_alquran = $row['sk_membaca_alquran'];
		$this->sk_lulus_tes_muhammadiyah = $row['sk_lulus_tes_muhammadiyah'];
		$this->sk_aktif_kegiatan_muhammadiyah = $row['sk_aktif_kegiatan_muhammadiyah'];
		$this->sk_pernyataan_ketentuan_dikdasmen = $row['sk_pernyataan_ketentuan_dikdasmen'];
		$this->status = $row['status'];
		$this->tingkatan = $row['tingkatan'];
		
	}

	function update() {
		$query = "UPDATE {$this->table_guru}
			SET
                nama = :nama,
				tgl_lahir = :tgl_lahir,
				jenis_kelamin = :jenis_kelamin,
				telp = :telp,
				email = :email,
				tempat_kelahiran = :tempat_kelahiran,
				agama = :agama,
				pendidikan = :pendidikan,
				nama_lembaga = :nama_lembaga,
				tahun_ijazah = :tahun_ijazah,
				jumlah_program_study = :jumlah_program_study,
				alamat = :alamat,
				fc_ijazah = :fc_ijazah,
				status_perkawinan = :status_perkawinan,
				tanggal_mulai_bertugas = :tanggal_mulai_bertugas,
				fc_sk_sekolah = :fc_sk_sekolah,
				fc_sk_gtt = :fc_sk_gtt,
				fc_kartu_anggota_muhammadiyah = :fc_kartu_anggota_muhammadiyah,
				fc_kartu_keluarga = :fc_kartu_keluarga,
				sk_membaca_alquran = :sk_membaca_alquran,
				sk_lulus_tes_muhammadiyah = :sk_lulus_tes_muhammadiyah,
				sk_aktif_kegiatan_muhammadiyah = :sk_aktif_kegiatan_muhammadiyah,
				sk_pernyataan_ketentuan_dikdasmen = :sk_pernyataan_ketentuan_dikdasmen,
				tingkatan = :tingkatan
			WHERE
				id_guru = :id";

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(':nama', $this->nama); 
			$stmt->bindParam(':tgl_lahir', $this->tgl_lahir); 
			$stmt->bindParam(':jenis_kelamin', $this->jenis_kelamin);
			$stmt->bindParam(':telp', $this->telp); 
			$stmt->bindParam(':email', $this->email); 
			$stmt->bindParam(':tempat_kelahiran', $this->tempat_kelahiran); 
			$stmt->bindParam(':agama', $this->agama); 
			$stmt->bindParam(':pendidikan', $this->pendidikan); 
			$stmt->bindParam(':nama_lembaga', $this->nama_lembaga); 
			$stmt->bindParam(':tahun_ijazah', $this->tahun_ijazah); 
			$stmt->bindParam(':jumlah_program_study', $this->jumlah_program_study);
			$stmt->bindParam(':alamat', $this->alamat); 
			$stmt->bindParam(':fc_ijazah', $this->fc_ijazah);
			$stmt->bindParam(':status_perkawinan', $this->status_perkawinan);
			$stmt->bindParam(':tanggal_mulai_bertugas', $this->tanggal_mulai_bertugas);
			$stmt->bindParam(':fc_sk_sekolah', $this->fc_sk_sekolah);
			$stmt->bindParam(':fc_sk_gtt', $this->fc_sk_gtt);
			$stmt->bindParam(':fc_kartu_anggota_muhammadiyah', $this->fc_kartu_anggota_muhammadiyah);
			$stmt->bindParam(':fc_kartu_keluarga', $this->fc_kartu_keluarga);
			$stmt->bindParam(':sk_membaca_alquran', $this->sk_membaca_alquran);
			$stmt->bindParam(':sk_lulus_tes_muhammadiyah', $this->sk_lulus_tes_muhammadiyah);
			$stmt->bindParam(':sk_aktif_kegiatan_muhammadiyah', $this->sk_aktif_kegiatan_muhammadiyah);
			$stmt->bindParam(':sk_pernyataan_ketentuan_dikdasmen', $this->sk_pernyataan_ketentuan_dikdasmen);
			$stmt->bindParam(':tingkatan', $this->tingkatan);
			$stmt->bindParam(':id', $this->id_guru);

		if ($stmt->execute()) {
			return true;
		} else {
	    var_dump($this->jenis_kelamin);
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
