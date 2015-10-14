<html>
	<head>
	<title>Tambah Data</title>
	</head>
	<body>
		<?php
			include ("koneksi.php");
			if(isset($_POST['submit']))
			{
				$nim = $_POST['nim'];
				$nama = $_POST['nama'];
				$alamat = $_POST['alamat'];
				$prodi = $_POST['prodi'];
			 
				$sql = "INSERT INTO mahasiswa ".
					   "(nim,nama,alamat,prodi) ".
					   "VALUES('$nim','$nama','$alamat', '$prodi')";
			$tambahdata = mysql_query( $sql );
			if(! $tambahdata )
			{
				die('Gagal Tambah Data: ' . mysql_error());
			}
				header("location:tambah.php");
				echo "Berhasil tambah data\n";

			}
			else
			{
		?>

		<a href="view_mahasiswa.php">Lihat Mahasiswa</a>
		<form method="post" action="">
			<table width="500" border="0" cellspacing="1" cellpadding="2">
				<tr>
					<td>Nim</td>
					<td><input name="nim" type="text" id="nim"></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td><input name="nama" type="text" id="nama"></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><input name="alamat" type="text" id="alamat"></td>
				</tr>
				<tr>
					<td>Prodi </td>
					<td><input name="prodi" type="text" id="prodi"> </td>
				</tr>
				<tr>
					<td width="110"> </td>
					<td>
						<input name="submit" type="submit" id="submit" value="tambah">
					</td>
				</tr>
			</table>
		</form>
		<?php
			}
		?>
	</body>
</html>