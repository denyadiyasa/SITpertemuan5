<?php
$link = mysql_connect('localhost','root','')
or die('couldnot connect :' .mysql_error());
mysql_select_db('data_mahasiswa') or die('couldnot select databases');
?>