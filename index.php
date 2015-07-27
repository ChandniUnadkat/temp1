<?php

	$database = new SQLitedatabase('myDatabase.db');

 if(isset($_POST['submit1']))
 	{
	 	echo"<br>First Name =".$_FILES["file1"]["name"];
		echo"<br>Temporary File Name =".$_FILES["file1"]["tmp_name"];
		echo"<br>File Size =".$_FILES["file1"]["size"];
		move_uploaded_file($_FILES["file1"]["tmp_name"],"upload//".$_FILES["file1"]["name"]);
	}
?>

<script>
function validateForm1() 
	{
    	var a = document.forms["myForm"]["file1"].value;
    	if (a == null || a == "")
		{
        	alert("Can't upload without file attachment !!");
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
                alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}	
</script>

<!DOCTYPE html>
<html>
<head>
	<title>First Task</title>
</head>
<body>
	<center>
		<h2>First Task </h2>
			<form name="myForm" action="index.php" method="post" onsubmit="return validateForm1()" enctype="multipart/form-data">
			<table border="3" >
			<tr>
			<td>
				Select CSV File to Upload : </td>
					<td><input type="file" name="file1" onchange="ValidateSingleInput(this);"/> </td></tr>

					<tr><td><td><input type="submit" name="submit1" value="Upload" />
			</td></td>
			</tr>
			</table>		
			</form>
	</center>
</body>
</html>