<?php
session_start();
require_once('header.php');
if(isset($_SESSION['auth'])): ?>
<?php
 require_once('db_conn.php');

// Rezervacijos sukurimo funkcija 

	if(!empty($_POST['save'])){
		if(!empty($_POST['timedate'])){
			$timedate = $_POST['timedate'];
		}else{
			$timedate = '';
		}
		if(!empty($_POST['name'])){
			$name = $_POST['name'];
		}else{
			$name = '';
		}
        if(!empty($_POST['people'])){
			$people = $_POST['people'];
		}else{
			$people = '';
		}
        if(!empty($_POST['phone'])){
			$phone = $_POST['phone'];
		}else{
			$phone = '';
		}
        if(!empty($_POST['comment'])){
			$comment = $_POST['comment'];
		}else{
			$comment = '';
		}
        
        if(!empty($timedate) && !empty($name) && !empty($people) && !empty($phone) && !empty($comment)){
			$sql = 'INSERT INTO reservations (time, name, phone, persons, comment, userid) VALUES(
					"'.$timedate.'",
					"'.$name.'",
                    '.$phone.',
                    '.$people.',
                    "'.$comment.'",
                    '.$_SESSION['userid'].'); 
			';
			$result = $db->query($sql);
			if($result){
                if (!empty($_POST['table'])){
                    $id = $db->query('SELECT id FROM reservations ORDER BY id DESC LIMIT 1')->fetch_assoc();
                    $test = '';
                    
                    foreach($_POST['table'] as $table_id){
                        $sql2 = 'INSERT INTO tablereservations (reservationid, tableid) VALUES('.intval(implode("|",$id)).', '.intval($table_id).')';
                        $result = $db->query($sql2);
                    }
                     
                }
				$message = "Reservation creation successful";
			}else{
				$message = "Reservation creation failed";
			}
        }else{
            $message = "All fields are required";
        }
    }
?>

<!--Rezervaciju kurimo lentele -->


 <form method="POST" class="reservation-form" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div class="form-container">
                <h3>Available tables</h3>
                <?php require_once('tablereservation.php')?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="reserv-form-container">
                <h3 style="color: white"><?php echo isset($message) ? $message : ""; ?></h3>
                <fieldset class="form-group">
                    <label for="timedate">Time and Date</label>
                    <input type="datetime-local" id="timedate" name="timedate" class="form-control" value="" placeholder="Enter time and date">
                </fieldset>
                <fieldset class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="" placeholder="Enter name">
                </fieldset>
                <fieldset class="form-group">
                    <label for="people">Peoples</label>
                    <input type="text" id="people" name="people" class="form-control" value="" placeholder="Enter people count">
                </fieldset>
                <fieldset class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" class="form-control" value="" placeholder="Enter phone">
                </fieldset>
                <fieldset class="form-group">
                    <label for="comment">Comment</label>
                    <input type="text" id="comment" name="comment" class="form-control" value="" placeholder="Comment">
                </fieldset>
                <input type="submit" name="save" class="btn btn-default custom-btn" value="Save">
            </div>
        </div>     
     </div>
</form>     


<?php else: ?>

    <h2>Access denied</h2>

<?php endif; ?>
 
<!--Sukurtu staliuku prijungimas prie rezervacijos lauko -->

<script type="text/javascript">
    $(document).ready(function(){
       $('#timedate').change(function(){
           let tableIds = [];
           showTables($('#timedate').val());
       }); 
    });
    function showTables(datevalue) {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
//                document.getElementById("txtHint").innerHTML = this.responseText;
                let ids = this.responseText != '' ? this.responseText.split(',') : '';
                disableCheckBoxes(ids);
            }
        };
        xmlhttp.open("GET","getresertables.php?date="+datevalue,true);
        xmlhttp.send();
}
    
// Disable staliukus kurie yra uzimti ta valanda kuria buvo sukurta rezervacija 
    
function disableCheckBoxes(ids){
    if(ids != ''){
        ids.forEach(function(element) {
            document.getElementById("table_" + element).disabled = true;
        });
    }else{
        let tables = document.querySelectorAll('.table');
        tables.forEach(function(element) {
            element.disabled = false;
        });
    }
} 
</script>    
<?php require_once('footer.php') ?>    