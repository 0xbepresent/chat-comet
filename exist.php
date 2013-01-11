<?php
$filename  = 'logChat/users.txt';
$nick = $_POST['nick'];
$existe = 0;
$data       = file_get_contents($filename);
$explode_data = explode("\n", $data);
$count_data = count($explode_data);
for ($i=0; $i < $count_data ; $i++){ 
    if($explode_data[$i] == $nick){
        $existe++;
    }
}
if($existe == 0){
    echo 0;
}else{
    echo 1;
}
?>