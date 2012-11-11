 <?php
$filename  = 'logChat/data.txt';
$msg = isset($_POST['msg']) ? $_POST['msg'] : '';
  if ($msg != '')
  {   
    file_put_contents($filename,$msg);
    die();
  }
 
  $lastmodif    = isset($_POST['timestamp']) ? $_POST['timestamp'] : 0;
  $currentmodif = filemtime($filename);
  while ($currentmodif <= $lastmodif)   {
    usleep(10000); // sleep 10ms to unload the CPU
    clearstatcache();
    $currentmodif = filemtime($filename);
  }
 
  $response = array();
  $data       = file_get_contents($filename);
  $response["msg"] = $data."<br>";
  $response['timestamp'] = $currentmodif;
  echo json_encode($response);
  flush();
  ?>