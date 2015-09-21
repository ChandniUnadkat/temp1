<?php
error_reporting(0);
require_once('main_db_connection.php');			//After connection with database, comes third Party class with functions for importing data from .csv file to SQLite3 Database 
/**
 * this is main class for main_db_class
 */
class main_db_class									
	{
	 function displayMembers()
	 {
      	$db = new MYDB();
	    $sqlque = "SELECT * from record ";
		$res = $db->query($sqlque);
	    return $res;
	    $db->close();
      }
      function import_csv_to_sqlite()		//this imports the .csv file 
      {
			$db = new MYDB();
		    $csvfile_path = 'CSV/';
			$csv_file = $csvfile_path . basename($_FILES['csvdoc']['name']);
			echo '<pre>';
			if (move_uploaded_file($_FILES['csvdoc']['tmp_name'], $csv_file)) 
			{
			    $csvfile = fopen($csv_file, 'r');
				$theData = fgets($csvfile);
				$i = 0;
			    $res = null;
     			while (!feof($csvfile))
				{
				   $csvfile_data[] = fgets($csvfile, 1000);
				   $csv_array = explode(",", $csvfile_data[$i]);
				   $insert_csv = array();
				   if(!empty($csv_array[0])){
				   	          $olddate = str_replace('"', ' ', $csv_array[4]);             
                              $Work_Date = strtotime(str_replace('/', '-', $olddate));  	 
					                   $names = explode(" ", $csv_array[0]);        
	                                   $csv_FN['First_Name'] = str_replace('"', ' ',$names[0]);
									   $csv_MN['Middle_Name'] = str_replace('"', ' ',$names[1]);
									   $csv_FaN['Family_Name'] = str_replace('"', ' ',$names[2]);
									   $csv_PR['Payroll_Reference']= $csv_array[1];
									   $csv_THW['Total_Hours_Worked'] = $csv_array[2];
									   $csv_TP['Total_Pay'] = $csv_array[3];
									   $csv_WD['Work_Date'] = $Work_Date;
							    
									   $que = "INSERT INTO record (First_Name,Family_Name,Middle_Name,Payroll_Reference,Total_Hours_Worked,Total_Pay,Work_Date ) VALUES
									             ('".$csv_FN['First_Name']."',
									              '".$csv_FaN['Family_Name']."',
									              '".$csv_MN['Middle_Name']."',
									              ".$csv_PR['Payroll_Reference'].",
									              ".$csv_THW['Total_Hours_Worked'].",
									              ".$csv_TP['Total_Pay'].",
									              ".$csv_WD['Work_Date']."
									              )";
									   $res = $db->exec($que);
									   $i++;
				   }
				} 
				fclose($csvfile);
				$db->close();
				}
			}
}
?>
