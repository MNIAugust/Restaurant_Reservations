<?php
session_start();
require_once('header.php');
if(isset($_SESSION['auth'])): ?>
<?php
//Tables isaugojimo funkcija
//<------------------------
 require_once('db_conn.php');

	if(!empty($_POST['save'])){
		if(!empty($_POST['tablename'])){
			$tablename = $_POST['tablename'];
		}else{
			$tablename = '';
		}
		if(!empty($_POST['seatcount'])){
			$seatcount = $_POST['seatcount'];
		}else{
			$seatcount = '';
		}
        if(!empty($tablename) && !empty($seatcount)){
			$sql = 'INSERT INTO tables SET
					tablename = "'.$tablename.'",
					seatcount = "'.$seatcount.'"
			';
			$result = $db->query($sql);

			if($result){
				$message = "Table creation successful";
			}else{
				$message = "Table creation failed";
			}
        }else{
            $message = "All fields are required";
        }
    }
//---------------->
?>

<!--Tables lentele -->

<div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <div class="form-container">	
            <h3 style="color: white"><?php echo isset($message) ? $message : ""; ?></h3>
            <form method="POST" enctype="multipart/form-data">
                <fieldset class="form-group">
                    <label for="tablename">Table name</label>
                    <input type="text" id="tablename" name="tablename" class="form-control" value="" placeholder="Enter table name">
                </fieldset>
                <fieldset class="form-group">
                    <label for="seatcount">Seat count</label>
                    <input type="number" id="seatcount" name="seatcount" class="form-control" value="" placeholder="Enter seat count" min="1">
                </fieldset>
                <input type="submit" name="save" class="btn btn-default custom-btn" value="Save">
            </form>
        </div>
    </div>
</div>
<!--<------------------------------->

<?php else: ?>

    <h2>Access denied</h2>

<?php endif; ?>
<?php require_once('footer.php') ?>