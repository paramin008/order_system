<?php
defined('APPS') or exit('No direct script access allowed');

$fields = "*";
$table = "users";
$conditions = "WHERE  position ";
$users = fetch_all($fields, $table, $conditions);
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
            <?php if ($_SESSION["POSITION"] != 2) {?>
            <li class="breadcrumb-item"><a href="?page=repair"><?php lang("Order list");?></a></li>
            <?php }?>
            <li class="breadcrumb-item active"><?php lang("Order");?></li>
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
              <form id="forminfo" class="form-horizontal"  enctype="multipart/form-data" action="apps/repair/save.php"
                method="POST" autocomplete="off">




                <div class="form-group row">
                  <label for="number" class="col-sm-2 col-form-label"><?php lang("number");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                  <input name="number" id="number" type="text" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="call" class="col-sm-2 col-form-label"><?php lang("Phone Number");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                  <input name="call1" id="call" type="text" class="form-control">
                  </div>
                </div>


                <div class="form-group row">
                  <label for="problem" class="col-sm-2 col-form-label"><?php lang("Topic");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                  <input name="inven" id="inven" type="text" class="form-control">
                  </div>
                </div>


                <div class="form-group row">
                  <label for="Address" class="col-sm-2 col-form-label"><?php lang("Address");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                  <input name="Address" id="Address" type="text" class="form-control">
                  </div>
                </div>


                <div class="form-group row">
                  <label for="Customer_name" class="col-sm-2 col-form-label"><?php lang("Customer name");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                  <input name="Customer_name" id="Customer_name" type="text" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="date" class="col-2 col-form-label"><?php lang("Delivery date");?></label>
                  <div class="col-10">
                  <input class="form-control" name="date" type="date" value="" id="date">
                  </div>
                </div>



                <div class="form-group row">
                  <label for="Description" class="col-sm-2 col-form-label"><?php lang("detail");?> <span
                      class="text-danger">*</span></label>
                  <div class="col-sm-10">
                    <textarea name="description" id="Description"rows="5" class="form-control"></textarea>
                  </div>
                </div>

                <?php if ($_SESSION["POSITION"] == "1" || $_SESSION["POSITION"] == "4") {?>
                <div class="form-group row">
                  <label for="technician" class="col-sm-2 col-form-label"><?php lang("responsible man");?> <span class="text-danger">*</span></label>
                  <div class="col-sm-10">




                    <select  multiple onchange="changeSelection(this.value)" name="technician[]" id="technician" class="form-control">
                        <option value="">-- <?php lang("responsible man");?> --</option>
                        <?php
foreach ($users as $v) {
    ?>
                          <option name='technician[]' value="<?php echo $v["id"]; ?>"><?php echo $v["first_name"] . " " . $v["last_name"]; ?></option>
                        <?php }?>
                      </select>

                  </div>
                </div>
                <?php }?>

               <div class="col-md-12">
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                    <input type="file" class="custom-file-input" name="image[]"  id="image">
                    <label class="custom-file-label"  for="image">เลือกรูป</label>
                    </div>
                  </div>
                </div>


                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-upload"><i class="fas fa-check-circle"></i>
                    <?php lang("Save");?></button>
                  </div>
                </div>
              </form>
            </div><!-- /.card-body -->
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

<script language="javascript">
      function changeSelection(value){

      var length = document.getElementById("technician").options.length;

      if(value == 0){
      for(var i = 1;i<length;i++)
        document.getElementById("technician").options[i].selected = "selected";

      document.getElementById("technician").options[0].selected = "";
      }

  }
</script>


<script>
var arr_inven = <?php echo json_encode($inventorys); ?>;
var language = "<?php echo isset($_SESSION["LANGUAGE"]) ? $_SESSION["LANGUAGE"] : "en" ?>";
  var no_result = "<?php lang("No results found");?>";

  var msg_invent =  "<?php lang("Please Select Inventory");?>";
        var msg_problem = "<?php lang("Please Select Problem");?>";
       var msg_description =  "<?php lang("Please Enter Description");?>";
        var msg_technician =  "<?php lang("Please Select Technician");?>";
</script>