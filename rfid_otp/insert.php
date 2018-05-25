<?php
// Nama : Program memasukkan data ke database.
// Dibuat tanggal : 12 Desember 2018
// Pemilik : Evoteknologi.com
// -- Dilarang menggandakan program ini ke siapapun tanpa seijin evoteknologi.com semua data milik evoteknologi terhubung ke server evoteknologi--
// Terima kasih

//--------------Header library--------------------------------------------------
   include("conec.php");
   include_once 'db_connect.php';
   //------------------------------------------------------------------------------
   $link=Conection();
   //------------------------------------------------------------------------------
   date_default_timezone_set('Asia/Jakarta');
   //------------------------------------------------------------------------------
   //--------------------Deklarasi variabel----------------------------------------
   $tanggal = date("d");
   $bulan = date("m");
   $tahun = date("y");
   $jam = date("h");
   $ampm = date("a");
   $duaribu = 20;
   $tahun = $duaribu.$tahun; 
   $check = $_GET["check"];
   $otpget = $_GET["otp"];
   $otpdatabase;
   $nama;

   //----------------Memasukkan nilai dari sensor------------------------------------
   $queryMaxNomor="SELECT max(no) AS 'maxno' FROM `data` WHERE 1";    
   mysqli_query($link, $queryMaxNomor);
   
   $HasilMax = $link->query($queryMaxNomor);

   if ($HasilMax->num_rows > 0) {
    // output data of each row
    while($row = $HasilMax->fetch_assoc()) {
	 $maxno= $row["maxno"];
     $no = $maxno+1;   
    }
   } 
   else {
    echo "0 results";
   } 
    if($jam>=7 && $ampm=="pm"){
   // if($jam<=9 && $ampm=="am"){
    
        $querycheckid="SELECT id,nama FROM `data` WHERE id='".$_GET["id"]."'";    
        mysqli_query($link, $querycheckid);

        $queryUpdate="UPDATE `data` SET otp = '".$_GET["otp"]."' WHERE id='".$_GET["id"]."'";
        mysqli_query($link, $queryUpdate);	

        $queryUpdate="UPDATE `data` SET jam_masuk = NOW() WHERE id='".$_GET["id"]."'";
        mysqli_query($link, $queryUpdate);	
        
        $result = $link->query($querycheckid);
     
        if ($result->num_rows > 0) {
          //  while($row = $result->fetch_assoc()) {
            while($row = $result->fetch_assoc()) {
                $nama = $row["nama"];
                echo "statuscheck=in";
                echo "nama="; // Menampilkan nama dari database dengan OTP yang cocok
                echo $nama;
                echo "end"; // Jika OTP di database sama dengan otp yang dikirim arduino
                $queryCekid="update `data` set otp='".$_GET["otp"]."' where id='".$_GET["id"]."'";  
                mysqli_query($link, $queryCekid);
         //   }
            }
        } 
        else {
            echo "statuscheck=no";
        } 
        //--------------------------------------------------------------------------------
    }
    if($jam<=8 && $ampm=="am"){
    //if($jam>=7 && $ampm=="pm"){
        if($check=="0"){
            echo "statuscheck=ot";
        }
        if($check=="1"){
            $querycheck="SELECT id,nama,otp FROM `data` WHERE id='".$_GET["id"]."'";    
            mysqli_query($link, $querycheck);
            
            $result = $link->query($querycheck);
         
            if ($result->num_rows > 0) {
             // output data of each row
             while($row = $result->fetch_assoc()) {
                 $otpdatabase = $row["otp"];
                 $nama = $row["nama"];
                 if($otpget == $otpdatabase){
                    echo "statuscheck=ye"; // Jika OTP di database sama dengan otp yang dikirim arduino
                    $queryUpdate="UPDATE `data` SET jam_keluar = NOW() WHERE id='".$_GET["id"]."'";
                    mysqli_query($link, $queryUpdate);	
                   // echo "nama="; // Menampilkan nama dari database dengan OTP yang cocok
                    //echo $nama;
                   // echo "end"; // Jika OTP di database sama dengan otp yang dikirim arduino
                 }
                 if($otpget != $otpdatabase){
                    echo "statuscheck=fa"; // Jika OTP di database tidak sama dengan otp yang dikirim arduino
                 }
             }
            } 
            else {
             echo "statuscheck=no";
            } 
        }
        //--------------------------------------------------------------------------------
    }
   
   //-----------------Akhiri sambungan ke database---------------------
   $link->close();
   //------------------------------------------------------------------
?>