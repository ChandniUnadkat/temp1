<?php
error_reporting(0);
require_once('main_db_connection.php');
class main_class
	{
	 function displayMembers()
	 {
      	$db = new MyDB();
	    $sql = "SELECT * from record ";
		$ret = $db->query($sql);
	    return $ret;
	    $db->close();
      }
      function import_csv_to_sqlite()
      {
			$db = new MyDB();
		    $csv_path = 'CSV/';
			$csv_file = $csv_path . basename($_FILES['csvdoc']['name']);
			echo '<pre>';
			if (move_uploaded_file($_FILES['csvdoc']['tmp_name'], $csv_file)) {
			    $csvfile = fopen($csv_file, 'r');
				$theData = fgets($csvfile);
				$i = 0;
			    $ret = null;
     			while (!feof($csvfile))
				{
				   $csv_data[] = fgets($csvfile, 1000);
				   $csv_array = explode(",", $csv_data[$i]);
				   $insert_csv = array();
				   if(!empty($csv_array[0])){
				   	          $olddate = str_replace('"', ' ', $csv_array[4]);             
                              $Work_Date = strtotime(str_replace('/', '-', $olddate));  	 
					                   $names = explode(" ", $csv_array[0]);        
	                                   $insert_FN['First_Name'] = str_replace('"', ' ',$names[0]);
									   $insert_MN['Middle_Name'] = str_replace('"', ' ',$names[1]);
									   $insert_FaN['Family_Name'] = str_replace('"', ' ',$names[2]);
									   $insert_PR['Payroll_Reference']= $csv_array[1];
									   $insert_THW['Total_Hours_Worked'] = $csv_array[2];
									   $insert_TP['Total_Pay'] = $csv_array[3];
									   $insert_WD['Work_Date'] = $Work_Date;
							    
									   $query = "INSERT INTO record (First_Name,Family_Name,Middle_Name,Payroll_Reference,Total_Hours_Worked,Total_Pay,Work_Date ) VALUES
									             ('".$insert_FN['First_Name']."',
									              '".$insert_FaN['Family_Name']."',
									              '".$insert_MN['Middle_Name']."',
									              ".$insert_PR['Payroll_Reference'].",
									              ".$insert_THW['Total_Hours_Worked'].",
									              ".$insert_TP['Total_Pay'].",
									              ".$insert_WD['Work_Date']."
									              )";

									   $ret = $db->exec($query);
									   $i++;

				   }
				  
				  
				} 

				fclose($csvfile);
				
				if(!$ret){
				     header('Location: index.php');
				   } else {
				    header('Location: index.php');
				   }
				
					$db->close();// closing connection
				}
			}
}
  

?>