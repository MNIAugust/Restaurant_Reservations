<?php
require_once('db_conn.php');

$sql = 'SELECT * FROM reservations WHERE userid = '.$_SESSION['userid'].'';
$result = $db->query($sql);

?>

<!--Sukurtu rezervaciju lentele -->

<?php if($result->num_rows): ?>
<?php $reservations = mysqli_fetch_all($result,MYSQLI_ASSOC); ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="form-container">
            <h3>Reservations</h3>
            <table id="reservations" class="table table-bordered ">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Persons</th>
                        <th>Comment</th>
                        <th>Tables</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($reservations as $reservation): ?>
                    <?php $sql = 'SELECT tables.tablename as tablename FROM tables
                            INNER JOIN tablereservations ON tables.id = tablereservations.tableid
                            WHERE tablereservations.reservationid = '.$reservation['id'].'';
                        $result = $db->query($sql);
                        $tables = mysqli_fetch_all($result,MYSQLI_ASSOC);
                    ?>
                    <tr>
                        <td><?php echo $reservation['time']; ?></td>
                        <td><?php echo $reservation['name']; ?></td>
                        <td><?php echo $reservation['phone']; ?></td>
                        <td><?php echo $reservation['persons']; ?></td>
                        <td><?php echo $reservation['comment']; ?></td>
                        <td><?php  echo $idstring = implode(',', array_map(function($el){ return $el['tablename']; }, $tables)) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>    
            </table>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>    
<?php else: ?>
<p>No reservations</p>
<?php endif; ?>
