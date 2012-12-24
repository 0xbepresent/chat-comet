<?php

$filename  = 'logChat/users.txt';
$type = $_POST['type'];
$data       = file_get_contents($filename);
if ($type != ''){
    $nick = $_POST['nick'];
    switch ($type) {
    case 'add':
        file_put_contents($filename, $nick."\n", FILE_APPEND);
        break;
    case 'delete':
        $borrar = $nick;
        $cadena = file($filename);
        $cadena = str_replace($borrar."\n", "", $cadena);
        file_put_contents($filename,$cadena);
        break;
    }
    die();
 }
  $lastmodif    = isset($_POST['timestamp2']) ? $_POST['timestamp2'] : 0;
  $currentmodif = filemtime($filename);
  while ($currentmodif <= $lastmodif)   {
    usleep(10000); // sleep 10ms to unload the CPU
    clearstatcache();
    $currentmodif = filemtime($filename);
  }
 
  $response = array();
  $data       = file_get_contents($filename);
  $explode_data = explode("\n", $data);
  $count_data = count($explode_data);
  $response["num_users"] = $count_data-1;
  $response['timestamp2'] = $currentmodif;
  
  for ($i=0; $i < $count_data ; $i++) { 
    $list_users .= $explode_data[$i]."<br>";
  }
  
  $response["list_users"] = $list_users;
  echo json_encode($response);
  flush();
?>