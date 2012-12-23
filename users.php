<?php

$filename  = 'logChat/users.txt';
$type = $_POST['type'];
$data       = file_get_contents($filename);
if ($type != ''){
    switch ($type) {
    case 'add':
        $num = $data + 1;
        file_put_contents($filename, $num);
        break;
    case 'delete':
        $num = $data-1;
        file_put_contents($filename, $num);
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
  $response["num_users"] = $data;
  $response['timestamp2'] = $currentmodif;
  echo json_encode($response);
  flush();
?>