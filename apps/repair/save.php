<?php
	include('config.php'); 
session_start();

$output_dir = "img/";/* Path for file upload */
	$RandomNum   = time();
	$ImageName      = str_replace(' ','-',strtolower($_FILES['image']['name'][0]));
	$ImageType      = $_FILES['image']['type'][0];
 
	$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
	$ImageExt       = str_replace('.','',$ImageExt);
	$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
	$NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
    $ret[$NewImageName]= $output_dir.$NewImageName;

	if (!file_exists($output_dir))
	{
		@mkdir($output_dir, 0777);
	}               
	move_uploaded_file($_FILES["image"]["tmp_name"][0],$output_dir."/".$NewImageName );


	


	for($i=0;$i<count($_POST["technician"]);$i++)
	{
		if($_POST["technician"][$i] != "")
		{
			$strSQL = "INSERT INTO repair (inventory_id,
			description,
			user_id,
			technician,
			image,
			call1,
			number,
			Address,
			Customer_name,
			date
			) 
			
			VALUES 
          
            (

                '".$_POST["inven"]."',
                '".$_POST["description"]."',
                 '".$_SESSION["USER_ID"]."',
                '".$_POST["technician"][$i]."',
				 '".$NewImageName."',
				'".$_POST["call1"]."',
			    '".$_POST["number"]."',
				'".$_POST["Address"]."',
			    '".$_POST["Customer_name"]."',
				'".$_POST["date"]."'
		
			)";
			$objQuery = mysqli_query($dbcon,$strSQL) or die ("Error Query [".$strSQL."]");		
				
		}
	}
    if($objQuery){
      
        header("location:../../index.php?page=repair");
        exit();
     
    }
     
	

	
?>
