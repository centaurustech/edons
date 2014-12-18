<?php
$id_connect=mysql_connect('localhost','xxxxx','xxxxxxx');
$test=mysql_select_db('xxxxx',$id_connect);
if($test==FALSE)
echo "Connexion au serveur echouée";
?>
