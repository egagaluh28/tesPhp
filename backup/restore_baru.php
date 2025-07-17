<style>

.input-file{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border: 1px solid #C2C2C2;
    box-shadow: 1px 1px 4px #EBEBEB;
    -moz-box-shadow: 1px 1px 4px #EBEBEB;
    -webkit-box-shadow: 1px 1px 4px #EBEBEB;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    padding: 7px;
    outline: none;
	font-size: 16px;
	color:#666;
	font-family: "Montserrat", sans-serif;
}
</style>
<?php
if (! empty($response)) {
    ?>
<div class="response <?php echo $response["type"]; ?>
    ">
    <?php echo nl2br($response["message"]); ?>
</div>
<?php
}
?>
<form method="post" action="" enctype="multipart/form-data"
    id="frm-restore">
    <div class="form-row">
        <div>Choose Backup File</div>
        <div>
            <input type="file" name="backup_file" class="input-file" required />
        </div>
    </div>
    <div>
        <input type="submit" name="restore" value="Restore"
            class="btn-action" />
    </div>
</form>

<?php
//$conn = mysqli_connect("localhost", "root", "test", "php_examples");
mysql_connect("localhost","root","") or die("Koneksi gagal");
mysql_select_db("dblaplakgar2024") or die("Database tidak bisa dibuka");

$conn = "eror coy";

if (! empty($_FILES)) {
    // Validating SQL file type by extensions
    if (! in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array(
        "sql"
    ))) {
        $response = array(
            "type" => "error",
            "message" => "Invalid File Type"
        );
    } else {
        if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {
            move_uploaded_file($_FILES["backup_file"]["tmp_name"], $_FILES["backup_file"]["name"]);
            $response = restoreMysqlDB($_FILES["backup_file"]["name"], $conn);
        }
    }
}

function restoreMysqlDB($filePath, $conn)
{
    $sql = '';
    $error = '';
    
    if (file_exists($filePath)) {
        $lines = file($filePath);
        
        foreach ($lines as $line) {
            
            // Ignoring comments from the SQL script
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            
            $sql .= $line;
            
            if (substr(trim($line), - 1, 1) == ';') {
             //   $result = mysqli_query($conn, $sql);
			      $result = mysql_query($sql);
                if (! $result) {
                    $error .= mysql_error($conn) . "\n";
                }
                $sql = '';
            }
        } // end foreach
        
        if ($error) {
            $response = array(
                "type" => "error",
                "message" => $error
            );
        } else {
            $response = array(
                "type" => "success",
                "message" => "Database Restore Completed Successfully."
            );
        }
    } // end if file exists
    return $response;
}
?>