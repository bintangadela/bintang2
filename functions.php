<?php 
//koneksi ke database
 $conn = mysqli_connect("localhost","laras","laras","girlee");

function tambah ($data){
	global $conn;
	$kode=htmlspecialchars($data['kode']);
	$nama=htmlspecialchars($data['nama']);
	$jumlah=htmlspecialchars($data['jumlah']);
	$harga=htmlspecialchars($data['harga']);
	$foto=upload();
		if (!$foto){
			return false;
		}


	//query insert data
	$query = "INSERT INTO tblbarang (KodeBarang , NamaBarang , JumBarang , HargaBarang , FotoBarang) 
	VALUES ('$kode','$nama','$jumlah','$harga','$foto') ";
	mysqli_query($conn,$query);

	return mysqli_affected_rows($conn);
 
}

function upload(){
	$namafile=$_FILES['foto']['name'];
	$ukuranfile=$_FILES['foto']['size'];
	$error=$_FILES['foto']['error'];
	$namatempat=$_FILES['foto']['tmp_name'];

	//cek apakah tidak ada gambar yang diupload
	if($error=== 4){
	echo "<script>
		alert('pilih gambar terlebih dahulu!');
	</script>";
	return false;
	}

	//cek apakah yang diupload adalah gambar
	$ekstensivalid=['jpg','jpeg','png'];
	$ekstensi= explode ('.' ,$namafile);
	$ekstensi= strtolower(end($ekstensi));
	if (!in_array($ekstensi,$ekstensivalid)){
	echo "<script>  
		alert('yang anda upload bukan gambar!');
	</script>";
	return false;
}

	//cek jika ukurannya terlalu besar
	if($ukuranfile >1000000){
	echo "<script>
		alert('ukuran gambar terlau besar!');
	</script>";
	return false;
	}

	//gambar siap di upload
	move_uploaded_file($namatempat, 'img/' . $namafile);
	return $namafile;
}

function query($query){
	global $conn;  
	$result= mysqli_query($conn, $query);
	$rows=[];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}

function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM biodata WHERE ID= '$id'");

	return mysqli_affected_rows($conn);   
}




function ubah($data){
	global $conn;
	$id=$_GET['id'];
	$nama=htmlspecialchars($data['nama']);
	$tempat=htmlspecialchars($data['tempat']);
	$tanggal=htmlspecialchars($data['tanggal']);
	$alamat=htmlspecialchars($data['alamat']);
	$asal=htmlspecialchars($data['asal']);
	$tamat=htmlspecialchars($data['tamat']);
	$jurusan=htmlspecialchars($data['jurusan']);
	$jurusan1=htmlspecialchars($data['jurusan1']) ;
	$foto=upload();
	$ijazah=upload1();
	$kk=upload2();


	//query insert data
	$query = "UPDATE biodata SET Nama='$nama',TempatLahir='$tempat',TglLahir='$tanggal',Alamat='$alamat',SMA='$asal',ThnTamat='$tamat', JurusanSMA='$jurusan', jurusan='$jurusan1',foto='$foto',ijazah='$ijazah' , kk='$kk' WHERE ID='$id'";

	mysqli_query($conn,$query);

	return mysqli_affected_rows($conn);
}


