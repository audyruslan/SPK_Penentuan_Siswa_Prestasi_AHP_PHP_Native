<?php
class Alternatif
{
	private $conn;
	private $table_name = "data_alternatif";

	public $id;
	public $id_kelas;
	public $nis;
	public $nama;
	public $tempat_lahir;
	public $tanggal_lahir;
	public $kelamin;
	public $alamat;
	public $hasil_akhir;
	public $skor_alternatif;

	public $periode;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	function readAll()
	{
		$query = "SELECT * FROM {$this->table_name} ORDER BY id_alternatif ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function readByFilter()
	{
		$query = "SELECT * FROM {$this->table_name} a JOIN nilai_awal b ON a.id_alternatif=b.id_alternatif WHERE b.keterangan='B'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function countByFilter()
	{
		$query = "SELECT * FROM {$this->table_name} a JOIN nilai_awal b ON a.id_alternatif=b.id_alternatif WHERE b.keterangan='B' ";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readAllWithNilai()
	{
		$query = "SELECT *, b.nilai, b.keterangan
				FROM {$this->table_name} a
					JOIN nilai_awal b ON a.id_alternatif=b.id_alternatif
				WHERE a.id_alternatif IN (SELECT id_alternatif FROM nilai_awal)
				ORDER BY a.id_alternatif";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function readByRank()
	{
		$query = "SELECT *
				FROM {$this->table_name} a
					JOIN nilai_awal b ON a.id_alternatif=b.id_alternatif
				WHERE b.keterangan='B'
				ORDER BY hasil_akhir DESC
				LIMIT 10";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->periode);
		$stmt->execute();

		return $stmt;
	}

	function countAll()
	{
		$query = "SELECT * FROM {$this->table_name} ORDER BY id_alternatif ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readOne()
	{
		$query = "SELECT * FROM {$this->table_name} WHERE id_alternatif=? LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row["id_alternatif"];
		$this->id_kelas = $row["id_kelas"];
		$this->nis = $row["nis"];
		$this->nama = $row["nama"];
		$this->tempat_lahir = $row["tempat_lahir"];
		$this->tanggal_lahir = $row["tanggal_lahir"];
		$this->kelamin = $row["kelamin"];
		$this->alamat = $row["alamat"];
		$this->hasil_akhir = $row["hasil_akhir"];
		// $this->skor_alternatif = $row['skor_alternatif'];
	}

	function getNamaKelas($id)
	{
		$query = "SELECT nama_kelas FROM kelas WHERE id_kelas={$id} LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		return $row["nama_kelas"];
	}

	function readOneByNik()
	{
		$query = "SELECT * FROM {$this->table_name} WHERE nik=? LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->nik);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row["id_alternatif"];
		$this->nik = $row["nik"];
		$this->nama = $row["nama"];
		$this->tempat_lahir = $row["tempat_lahir"];
		$this->tanggal_lahir = $row["tanggal_lahir"];
		$this->kelamin = $row["kelamin"];
		$this->alamat = $row["alamat"];
		$this->jabatan = $row["jabatan"];
		$this->tanggal_masuk = $row["tanggal_masuk"];
		$this->pendidikan = $row["pendidikan"];
		$this->hasil_akhir = $row["hasil_akhir"];
		// $this->skor_alternatif = $row['skor_alternatif'];
	}

	function readSatu($a)
	{
		$query = "SELECT * FROM {$this->table_name} WHERE id_alternatif='$a' LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function getNewID()
	{
		$query = "SELECT MAX(id_alternatif) AS code FROM {$this->table_name}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], 'A', 3);
		} else {
			return $this->genCode($nomor_terakhir, 'A', 3);
		}
	}

	function genCode($latest, $key, $chars = 0)
	{
		$new = intval(substr($latest, strlen($key))) + 1;
		$numb = str_pad($new, $chars, "0", STR_PAD_LEFT);
		return $key . $numb;
	}

	function genNextCode($start, $key, $chars = 0)
	{
		$new = str_pad($start, $chars, "0", STR_PAD_LEFT);
		return $key . $new;
	}
}