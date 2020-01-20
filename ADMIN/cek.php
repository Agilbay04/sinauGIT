<?php 
session_start();
require 'connection.php';

$id = $_GET['id'];
$sql = mysqli_query($conn, "UPDATE transaksi SET STATUS_TRANSAKSI=2 WHERE ID_TRANSAKSI='".$id."'");
if($sql = true){
  header("Location: data_transaksi.php");
} else {
  
}?>