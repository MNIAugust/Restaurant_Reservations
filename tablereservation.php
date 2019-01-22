<?php 

//Funkcija atspauzdina sukurtus staliukus 

    if(!empty($_POST['save'])){
        
    }
    $sql = 'SELECT *
            FROM tables    
    ';
    $result = $db->query($sql); 
?>

<?php if($result->num_rows): ?>

<?php $tables =  mysqli_fetch_all($result,MYSQLI_ASSOC); ?>

<?php foreach($tables as $table): ?>
 <div class="checkbox">
    <label>
        <?php echo $table['tablename']; ?>
        <input type="checkbox" class="table" id="table_<?php echo $table['id']; ?>" name="table[]" value="<?php echo $table['id']; ?>">
    </label>
</div>
<?php endforeach; ?>

<?php else: ?>

    <div>No tables found</div>

<?php endif; ?>
