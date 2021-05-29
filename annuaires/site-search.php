<?php
require_once("../config.php");
 
function get_site($con , $term){ 
 $query = "SELECT * FROM notes WHERE NOM LIKE '%".$term."%'";
 $result = mysqli_query($con, $query); 
 $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
 return $data; 
}
 
if (isset($_GET['term'])) {
 $getSite = get_site($con, $_GET['term']);
 $siteList = array();
 foreach($getSite as $site){
 $siteList[] = $site['NOM'];
 }
 echo json_encode($siteList);
}
?>