<?php
include_once 'conexion.php';
class Negocio {
    
    
//lista de articulos
    
 function lisArticulos($id){
   
   $sql="select art_nom ,art_uni_ ,art_pre, art_stk from articulos WHERE art_cod='$id'";
   $res= mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
   $vec=array();
  while($f= mysqli_fetch_array($res)){
      $vec[]=$f;
  }
  return $vec;
 }
 
 //lista de alumnos de compradores  
  function lisCompradores($id){
   
   $sql="select cli_nom,cli_tel,cli_cor from compradores
   where cli_cod='$id'";
   $res= mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
   $vec=array();
  while($f= mysqli_fetch_array($res)){
      $vec[]=$f;
  }
  return $vec;
 }  
 
  //lista de pagos
  function lisFactura($id){
  
   $sql="select fac_fec,fecha , cli_cod from fac_cabe
   where fac_num='$id'";
   $res= mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
   $vec=array();
  while($f= mysqli_fetch_array($res)){
      $vec[]=$f;
  }
  return $vec;
 }  


 
    
}

?>