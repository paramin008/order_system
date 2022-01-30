<?php 
include ("config.php");
error_reporting(0);
$id = $_REQUEST['id'];

$strSQL = "SELECT * FROM repair where id = '$id'";

$objQuery = mysqli_query($dbcon,$strSQL) or die ("Error Query [".$strSQL."]");

$objResult = mysqli_fetch_array($objQuery);

$id = $objResult['id'];





function DateThai($strDate)
{
$strYear = date("Y",strtotime($strDate))+543;
$strMonth= date("n",strtotime($strDate));
$strDay= date("j",strtotime($strDate));
$strHour= date("H",strtotime($strDate));
$strMinute= date("i",strtotime($strDate));
$strSeconds= date("s",strtotime($strDate));
$strMonthCut = Array("","มกราคม" , "กุมภาพันธ์" , "มีนาคม" , "เมษายน" , "พฤษภาคม" , "มิถุนายน" , "กรกฏาคม" , "สิงหาคม" , "กันยายน" , "ตุลาคม" ,"พฤศจิกายน" , "ธันวาคม" );


$strMonthThai=$strMonthCut[$strMonth];
return "$strDay $strMonthThai $strYear ";
//return "$strMonthThai $strYear";
}
$strDate2 = $date1;
$strDate = $objResult["date"]; // เปลี่ยน วันที่ ให้เป็นตัวแปล จากฐานข้อมูล มาก็ได้

?> 



 
<?php

$date1 = date('d-m-Y ');

?>

<!-- Main content -->
<!DOCTYPE html>
			<html>
			<head>
			  <meta charset="utf-8">
			  <meta http-equiv="X-UA-Compatible" content="IE=edge">
			  <title>ใบเบิก</title>
			  <!-- Tell the browser to be responsive to screen width -->
			  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			  <!-- Bootstrap 3.3.7 -->
			  <link rel="stylesheet" href="bootstrap.min.css">
			  <!-- Font Awesome -->
              <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
			  <link rel="stylesheet" href="font-awesome.min.css">
			  <link rel="stylesheet" href="adminlte.min.css">
              <style>
table, th, td {
  border: 0px solid black;
  border-collapse: collapse;
}

table.center {
  margin-left: auto; 
  margin-right: auto;
}
</style>

			</head>
         <center><b> <h2>ใบสั่งงาน</h2> </center>
			<body onload="window.print();">
			<div class="wrapper">
			  <section class="invoice">
			    <!-- title row -->
			    <div class="row">
			      <div class="col-xs-12">
			        <h4 class="page-header">
                <table class=" center">
			          <thead>
			          <tr>
			            <th><h3> <img src="../../dist/img/logo.png" alt="User Image" width="150" height="150"></h3> <br /></th>
					
			          </tr>
			          </thead>
			        
			        </table>
   </h4>
                      <table >
			          <thead>
			          <tr>
                  <h3> 
				  	ชื่องาน :&nbsp<?php echo $objResult["inventory_id"];?>  <br />
				 	ใบผลิตหมายเลข :&nbsp<?php echo  $objResult["number"];?> <br>
					 <?php echo "วันที่สั่งงาน : ".DateThai($date1);?> <br>
				<?php echo "วันที่ส่งงาน : ".DateThai($strDate);?> <br>
					ชื่อลูกค้า :&nbsp<?php echo $objResult["Customer_name"];?>  <br />
			        เบอร์โทร :&nbsp<?php echo $objResult["call1"];?> <br>
					ที่อยู่ :&nbsp<?php echo $objResult["Address"];?> <br>
					สถานะ :&nbsp<?php echo $objResult["status"];?> <br>
				
			     </h3>
			          </tr>
			          </thead>
			          <tbody></tbody>
			        </table>
			      </div>
				 <!-- /.col -->
			    </div>
			    <!-- info row -->
			  
			    <div class="row " >
			      <div class="col-xs-12 table-responsive center">
			        <table class=" center">
			          <thead>
			          <tr>
			            <th><h2>รายละเอียดงาน</h2> <br /></th>
			    
			          </tr>
			          </thead>
			          <tbody></tbody>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div><br /><br />
             <h3>  <?php echo $objResult["description"];?>
			 
			
			
			</h3> 
			 <br><br><br><br>
			 <div class="row " >
			      <div class="col-xs-12 table-responsive center">
			        <table class=" center">
			          <thead>
			          <tr>
			            <th><h2>รูปภาพ</h2> <br /><br /><br /><br /></th>
			    
			          </tr>
			          </thead>
			          <tbody></tbody>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>

<?php

$strSQL1= "SELECT repair.id, images.file_name
FROM repair
INNER JOIN images
ON repair.id = images.repair_id";

$objQuery1 = mysqli_query($dbcon,$strSQL1) or die ("Error Query [".$strSQL1."]");

while ($objResult1 = mysqli_fetch_array($objQuery1))

{
	$file_name = $objResult1['file_name'];





?>

<div class="img-block">
        <img src="img/<?php echo $file_name; ?>" width="30%"  class="img-responsive" />
       
        </div>

        <?php
        }
    ?>








		
		
			  </section>
			
			  <!-- /.content -->
			</div>
			
		</body>
	</html>

	