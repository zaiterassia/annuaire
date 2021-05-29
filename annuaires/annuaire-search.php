<?php
require_once("../config.php");
 
function get_annuaire($con , $term){ 
 $query = "SELECT * FROM annuaire WHERE site LIKE '%".$term."%' ORDER BY site ASC";
 $result = mysqli_query($con, $query); 
 $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
 return $data; 
}
 
if (isset($_GET['term'])) {
 $getAnnuaire = get_annuaire($con, $_GET['term']);
 $annuaireList = array();
 foreach($getAnnuaire as $annuaire){
 $annuaireList[] = $annuaire['site'];
 }
 echo json_encode($annuaireList);
}
?>