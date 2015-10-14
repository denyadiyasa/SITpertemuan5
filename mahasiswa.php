<html>
<head>
<?php
	$konek = mysql_connect("localhost", "root", "");
	$db = mysql_select_db("mahasiswa");

	if($konek){
		echo("sip <br>");
	}else{
		echo("ora sip <br>");
	}

	if($db){
		echo("database ADA <br>");
	}else{
		echo("ORA ONO <br>");
	}
	
	$query = "select * from mahasiswa";
		$hasil = mysql_query($query);

		$datamahasiswa = array();

		while ($data = mysql_fetch_array($hasil))
		{
			$datamahasiswa [] = array('nim' => $data['nim'], 
				'nama' => $data['nama'],
				'alamat' => $data['alamat'],
				'prodi' => $data['prodi']);
			//echo $data['nim'];
		}

		$document = new DOMDocument();
		$document->FormatOutput = true;
		$root = $document->createElement("data");
		$document->appendChild($root);
		foreach ($datamahasiswa as $mahasiswa)
		 {
		 	$block = $document->createElement("mahasiswa");

			$nim = $document->createElement("nim");
			$nim->appendChild($document->createTextNode($mahasiswa['nim']));
			$block->appendChild($nim);

			$nama = $document->createElement("nama");
			$nama->appendChild($document->createTextNode($mahasiswa['nama']));
			$block->appendChild($nama);

			$alamat = $document->createElement("alamat");
			$alamat->appendChild($document->createTextNode($mahasiswa['alamat']));
			$block->appendChild($alamat);

			$prodi = $document->createElement("prodi");
			$prodi ->appendChild($document->createTextNode($mahasiswa['prodi']));
			$block->appendChild($prodi);

			$root->appendChild($block);
		 }

		 $generateXML = $document->save("mahasiswa.xml");
		 if($generateXML)
		 {
		 	echo ("berhasil generate xml<br>");
		 }else{
		 	echo ("gagal <br>");
		 }
		 $url = "http://localhost/deny/mahasiswa.xml";
		 $client = curl_init($url);
		 curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
		 $response = curl_exec($client);
		 curl_close($client);

		 $datamahasiswaxml = simplexml_load_string($response);

		 //Print_r($datamahasiswaxml);
 
		 echo"<table border='1'>
		 <tr>
			<td>NIM</td>
			<td>Nama</td>
			<td>Alamat</td>
			<td>Prodi</td>
		 </tr>";
		 

		 foreach ($datamahasiswaxml->mahasiswa as $mahasiswa) {
		 	echo "
		 	<tr>
		 		<td>".$mahasiswa->nim."</td>
		 		<td>".$mahasiswa->nama."</td>
		 		<td>".$mahasiswa->alamat."</td>
		 		<td>".$mahasiswa->prodi."</td>
		 	</tr>";
		 
		 }
		 echo "</table>";		 
?>
</head>
</html>