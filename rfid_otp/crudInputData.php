<?php
	//Connection Database
	$con = mysqli_connect("localhost","root","","rfid_otp");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	switch ($_POST['type']) {

		//Tampilkan Data
		case "get":

			$SQL = mysqli_query($con, "SELECT * FROM data WHERE no='".$_POST['no']."'");
			$return = mysqli_fetch_array($SQL,MYSQLI_ASSOC);
			echo json_encode($return);
			break;

		//Tambah Data
		case "new":
			$SQL = mysqli_query($con,
									"INSERT INTO data SET
										no='".$_POST['no']."',
										id='".$_POST['id']."',
										nama='".$_POST['nama']."',
										otp='".$_POST['otp']."',
										jam_masuk='".$_POST['jam_masuk']."',
										jam_keluar='".$_POST['jam_keluar']."',
										pass='".$_POST['pass']."'
								");
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Edit Data
		case "edit":			
			$SQL = mysqli_query($con,
									"UPDATE data SET
									   no='".$_POST['no']."',
										id='".$_POST['id']."',
										nama='".$_POST['nama']."',
										otp='".$_POST['otp']."',
										jam_masuk='".$_POST['jam_masuk']."',
										jam_keluar='".$_POST['jam_keluar']."',
										pass='".$_POST['pass']."'
									WHERE no='".$_POST['no']."'
								");
			if($SQL){
				echo json_encode("OK");
			}
			break;

		//Hapus Data
		case "delete":

			$SQL = mysqli_query($con, "DELETE FROM data WHERE no='".$_POST['no']."'");
			if($SQL){
				echo json_encode("OK");
			}
			break;
	}
	
	function selectLocate(){
		
	}

?>