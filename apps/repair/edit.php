<?php
Defined('APPS') or exit('No direct script access allowed');
$fields = "*";
$table = "repair";
$req = array(
    "repair_id" => $_GET["repair_id"],
);
$value = " WHERE `id` = :repair_id ";
$repair = fetch_all($fields, $table, $value, $req);
if (!empty($repair)) {
    $repair = $repair[0];
} else {
    header("location:./?page=repair");
    exit();
}

$fields = "*";
$table = "repair_detail";
$conditions = " WHERE `repair_id` = '" . $repair["id"] . "' ";
$repair_details = fetch_all($fields, $table, $conditions);

$fields = "*";
$table = "users";
$conditions = "WHERE  position = '6' OR '3' ";
$users = fetch_all($fields, $table, $conditions);

$disabled = "";
if ($_SESSION["POSITION"] == "3" || $_SESSION["POSITION"] == "5" || $_SESSION["POSITION"] == "6") {
    $disabled = "disabled";
}

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php lang("Order");?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./"><?php lang("Home");?></a></li>
            <li class="breadcrumb-item"><a href="?page=repair"><?php lang("Order list");?></a></li>
            <li class="breadcrumb-item active"><?php echo $repair["id"]; ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <!-- /.col -->
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="info">
                  <form id="forminfo" class="form-horizontal" action="apps/repair/do_repair.php?action=update_repair"
                    method="POST" autocomplete="off">
                    <input type="hidden" id="repair_id" name="repair_id" value="<?php echo $repair["id"]; ?>">



                    <div class="form-group row">
                  <label for="number" class="col-sm-2 col-form-label"><?php lang("number");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                  <input name="number" id="number" type="text"  class="form-control"   value="<?php echo $repair["number"]; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="call" class="col-sm-2 col-form-label"><?php lang("Phone Number");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                  <input name="call1" id="call" type="text" class="form-control"  value="<?php echo $repair["call1"]; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inven" class="col-sm-2 col-form-label"><?php lang("Topic");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">

                      <input name="inven" id="inven" type="text" class="form-control"  value="<?php echo $repair["inventory_id"]; ?>">
                  </div>
                </div>


                <div class="form-group row">
                  <label for="Address" class="col-sm-2 col-form-label"><?php lang("Address");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                  <input name="Address" id="Address" type="text"  class="form-control" value="<?php echo $repair["Address"]; ?>">
                  </div>
                </div>


                <div class="form-group row">
                  <label for="Customer_name" class="col-sm-2 col-form-label"><?php lang("Customer name");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                  <input name="Customer_name" id="Customer_name" type="text" class="form-control"  value="<?php echo $repair["Customer_name"]; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="date" class="col-2 col-form-label"><?php lang("Delivery date");?></label>
                  <div class="col-10">
                  <input class="form-control" name="date" type="date"  value="<?php echo $repair["date"]; ?>" id="date">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="Description" class="col-sm-2 col-form-label"><?php lang("Detail");?> <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <textarea name="description" id="Description"rows="5" class="form-control" ><?php echo $repair["description"]; ?></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="technician" class="col-sm-2 col-form-label"><?php lang("responsible man");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <select name="technician" id="technician" class="form-control">
                    <?php
foreach ($users as $v) {
    ?>
                        <option value="<?php echo $v["id"]; ?>" <?php if ($v["id"] == $repair["technician"]) {echo "selected";}?>><?php echo $v["first_name"] . " " . $v["last_name"]; ?></option>
                       <?php }?>
                      </select>
                  </div>
                </div>


                <div class="form-group row">
                  <label for="Description" class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">

                  </div>
                </div>


                <div class="form-group row">
                  <label for="status" class="col-sm-2 col-form-label"><?php lang("Status");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <select name="status" id="status" class="form-control">
                        <option value="">-- <?php lang("Status");?> --</option>
                        <option value="ส่งงาน">ส่งงาน</option>
                        <option value="ยังไม่ส่ง">ยังไม่ส่ง</option>
                        <option value="กำลังดำเนินการ">กำลังดำเนินการ</option>
                        <option value="ยกเลิก">ยกเลิก</option>
                      </select>
                  </div>
                </div>

                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">

                        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> <?php lang("Save");?></button>
                      </div>
                    </div>
                  </form>

                  <?php

if (isset($_POST['submit'])) {
    // Include the database configuration file
    include_once 'config.php';
    //  $repair_id = $_POST["repair_id"];
    // File upload configuration
    $targetDir = "apps/repair/img";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    $fileNames = array_filter($_FILES['files']['name']);
    if (!empty($fileNames)) {
        foreach ($_FILES['files']['name'] as $key => $val) {
            // File upload path
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;

            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    // Image db insert sql
                    $insertValuesSQL .= "('" . $fileName . "', NOW(), '" . $repair["id"] . "')";
                } else {
                    $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                }
            } else {
                $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
            }
        }
        //'".$_POST["inven"]."'
        if (!empty($insertValuesSQL)) {
            $insertValuesSQL = trim($insertValuesSQL, ',');

            // Insert image file name into database
            $insert = $conn->query("INSERT INTO images (file_name, uploaded_on,repair_id) VALUES $insertValuesSQL
            ");
            if ($insert) {
                $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
                $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
                $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;
                $statusMsg = "อัปโหลดรูปภาพเรียบร้อย" . $errorMsg;
            } else {
                $statusMsg = "ไม่สามารถอัปโหลดรูปได้";
            }
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }

    // Display status message
    echo $statusMsg;

}

?>


<form action="" method="post" enctype="multipart/form-data">
                  <div class="col-md-12">
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                    <input type="file" class="custom-file-input" name="files[]" multiple  id="image">
                    <label class="custom-file-label"  for="image">เลือกรูป</label>
                    </div>
                    </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" name="submit" class="btn btn-success">อัปโหลดรูปภาพ</button>
                      </div>
                    </div>
</form>
      <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
            <div class="card-footer">
              <?php echo $repair["updated_at"]; ?>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel"><?php lang("Detail");?></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <form action="apps/repair/do_repair.php?action=created_detail" method="POST">

      <div class="modal-body">

                          <input type="hidden" name="repair_id" value="<?php echo $repair["id"]; ?>">

          <div class="form-group">

            <label for="note" name="note" class="col-form-label"><?php lang("Note");?>:</label>

            <textarea class="form-control" id="note" name="note"></textarea>

          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php lang("Close");?></button>
        <button type="submit" class="btn btn-primary"><?php lang("Add");?></button>
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  var msg = "<?php echo isset($_SESSION["MSG"]) ? $_SESSION["MSG"] : "" ?>";

  var status = "<?php echo isset($_SESSION["STATUS"]) ? $_SESSION["STATUS"] : "" ?>";

  var language = "<?php echo isset($_SESSION["LANGUAGE"]) ? $_SESSION["LANGUAGE"] : "en" ?>";

  var no_result = "<?php lang("No results found");?>";

  var msg_invent =  "<?php lang("Please Select Inventory");?>";

        var msg_problem = "<?php lang("Please Select Problem");?>";

       var msg_description =  "<?php lang("Please Enter Description");?>";

        var msg_technician =  "<?php lang("Please Select Technician");?>";

</script>

<?php unset($_SESSION["STATUS"], $_SESSION["MSG"]);?>