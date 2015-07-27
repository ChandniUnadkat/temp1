<?php 
   require('main_db_class.php'); 
   $obj = new main_class;
   $ret = $obj->displayMembers();
?>
<html>
    <title>First Task</title>
	<head>
		<script>
			function validateForm1() 
				{
					var a = document.forms["myForm"]["file1"].value;
					
					if (a == null || a == "")
					{
						alert("Warning : Can't upload without file attachment !!");
					return false;
					}
				}
				
			var _validFileExtensions = [".csv"];    
			
			function ValidateSingleInput(oInput) 
				{
				 if (oInput.type == "file") {
					var sFileName = oInput.value;
					 if (sFileName.length > 0)
					  {
						var blnValid = false;
						for (var j = 0; j < _validFileExtensions.length; j++)
						 {
							var sCurExtension = _validFileExtensions[j];
							if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) 
							{
								blnValid = true;
								break;
							}
						}
						 
						if (!blnValid)
						 {
							alert("Sorry, " + sFileName + " is invalid. Allowed extensions are: " + _validFileExtensions.join(", ") + " only !");
							oInput.value = "";
							return false;
						}
					}
				}
				return true;
			}	
			</script>
 	</head>
    <body>
		<center><h4>First Task</h4>
         <form name="myForm" action="index.php" method="post" enctype="multipart/form-data" onSubmit="return validateForm1()">
		 	<table border="2">
				<thead>Upload CSV File</thead>
					<tr>
						<td><input type="file" name="file1" onChange="ValidateSingleInput(this)"></td>
						<td><input type="submit" value="Upload File" name="submit"></td>
					</tr>
			</table>
			</form>
			<br /><br />
			<table border="2">
       			<thead>
					<tr>
						<th>Staff Member Name</th>
						<th>Payroll Reference</th>
						<th>Total Hours Worked</th>
						<th>Total Pay</th>
						<th>Work Date</th>  
					</tr>
        		</thead>
       		 <tbody align="center">
				<?php
				while($row = $ret->fetchArray() )
				{
				?>
					<tr>
						<td><?php echo $row['First_Name'].' '.$row['Family_Name'].' '.$row['Middle_Name'] ?></td>
						<td><?php echo $row['Payroll_Reference'];?></td>
						<td><?php echo $row['Total_Hours_Worked'];?></td>
						<td><?php echo $row['Total_Pay'];?></td>
						<td><?php echo date('dS F Y',$row['Work_Date']);?>
						</td>
					</tr>
					 
			   <?php        
				}
			   ?>
       		</tbody>
		</table>
     </body></center>
</html>
