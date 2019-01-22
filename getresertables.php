<?php 

//Gauna rezervuotus staliukus pasirinktame lauke 


require_once('db_conn.php');
function getReservedTables($db){
    $sql = 'SELECT tablereservations.tableid FROM tablereservations
            INNER JOIN reservations ON reservations.id = tablereservations.reservationid
            WHERE  reservations.time = "'.$_GET['date'].'"
    ';
    $result = $db->query($sql);
    if($result->num_rows){
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
    }else{
        return '';
    }
    
}
$tableids = getReservedTables($db);
if ($tableids != ''){
    $idstring = implode(',', array_map(function($el){ return $el['tableid']; }, $tableids));
    echo $idstring;
} 
?>