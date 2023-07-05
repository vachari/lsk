<?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "achari";
$dbPassword = "amma*123";
$dbName     = "gharadhaar";
// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
<?php
// Load the database configuration file
if(isset($_POST['importSubmit'])){
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
       
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
			$i=1;
            while(($line = fgetcsv($csvFile)) !== FALSE){
			//print_r($line);exit;
                // Get row data
                $group_code   = $line[0];
                $group_name  = $line[1];
				$cdate=date('Y-m-d H:i:s');
                 // Insert member data in the database
				$sql_qry="INSERT INTO ga_prod_groups_tbl(group_code, group_name,created_by,created_on) 
				VALUES ('$group_code','".addslashes($group_name)."',1,'$cdate')";
				$db->query($sql_qry) or die(mysqli_error($db));
				$i++;
			}
            
            // Close opened CSV file
            fclose($csvFile);
            
            echo $qstring = '?status=succ';
        }else{
            echo $qstring = '?status=err';
        }
    }
?>
<form method="post" action="" enctype="multipart/form-data">
File : <input type="file" name="file"/><br/><br/>
<input type="submit" name="importSubmit" value="Submit"/>
</form>