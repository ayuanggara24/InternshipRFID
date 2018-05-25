<?php
error_reporting(E_ALL ^ E_DEPRECATED);
function Conection(){
  // if (!($link=($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "evotekno_root", "pr3d4t0rz"))))  {
   if (!($link=($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", ""))))  {
      exit();
   }
   //if (!((bool)mysqli_query($link, "USE " . 'evotekno_enermon'))){
   if (!((bool)mysqli_query($link, "USE " . 'rfid_otp'))){
      exit();
   }
   return $link;
}
?>
