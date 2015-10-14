<?php
	ini_set('display_errors',false);
	header('Content-Type:text/xml; charset=ISO-8869-1');
	include "koneksi.php";

	$path=$_SERVER[PATH_INFO];
	if($path != null){
		$path_params=spliti("/",$path);
	}

	if($_SERVER['REQUEST_METHOD']=='GET'){
		if($path_params[1]!=null){
			$query="select nim,nama,alamat,prodi from mahasiswa where nim=$path_params[1]";
		}else{
			$query="select nim,nama,alamat,prodi from mahasiswa";
		}
		$result=mysql_query($query) or die('Query failed: '.mysql_error());

		echo"<data>";
		while($line=mysql_fetch_array($result,MYSQL_ASSOC)){
			echo "<mahasiswa>";
			foreach ($line as $key => $col_value) {
				echo "<$key>$col_value</$key>";
			}
			echo "</mahasiswa>";
		}
		echo "</data>";
		mysql_free_result($result);
	}
	
	else if($_SERVER['REQUEST_METHOD']=='POST'){
		$input=file_get_contents("php:/input");
		$xml=simplexml_load_string($input);
		foreach($xml->mahasiswa as $mahasiswa){
			$querycek="select * from mahasiswa where nim='$mahasiswa->nim'";
			$num_rows=mysql_num_rows($querycek);
			if($num_rows==0){
				$query="insert into mahasiswa (nim,nama,alamat,prodi) values ('$mahasiswa->nim','$mahasiswa->nama','$mahasiswa->alamat','$mahasiswa->prodi')";
			}else if($num_rows==1){
				$query="update mahasiswa set 
					nim='$mahasiswa->nim',
					nama='$mahasiswa->nama',
					alamat='$mahasiswa->alamat',
					prodi='$mahasiswa->prodi'
					where nim='$mahasiswa->nim'";
			}
			$result=mysql_query($query) or die('Query failed: '.mysql_error());
		}
	}
mysql_close($link);
?>