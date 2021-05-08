<?php //include "excel/import.php"; ?>
<script type="text/javascript" src="page/programcourse/programcourse_script.js"></script>

<style type="text/css">
  .modal_sm .modal-dialog{
    max-width: 600px;
  }
</style>
<center>

<div style="width:50%;">
  <div style="width:32%; height:100px; float:left;">
    <button class="btn btn-primary" data-title="Add Program's Course" onclick="get_programcourse_form('insert')"><i class="fa fa-plus"></i> Add Program's Course</button>
  </div>
  <div style="width:23%; float:left;padding: 7px;">
    Select CSV file:
  </div>
  <div style="margin-left:50%; height:100px;padding: 7px;">
  <form action="import.php" method="post" name="upload_excel" enctype="multipart/form-data">
      <input type="file" name="file" id="file" class="input-large" />
      <button type="submit" style="float: right;margin-top: -29px;" id="submit" name="Importprogramcourse" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
  </form>
  </div>
</div>

</center>
<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead style="">
            <tr>
              <th><center>Program Name</center></th>
              <th><center>Course Code</center></th>
              <th><center>Course Name</center></th>
              <th><center>Credits</center></th>
              <th><center>Course Type</center></th>
              <th><center>Semester </center></th>
              <th><center>Course Order</center></th>
              <th><center>Regulation</center></th>
              <th><center>Action</center></th>
            </tr>
          </thead>
          <tbody>

<?php 
// print_r($course); exit;
foreach ($programcourse as $key => $value) {
  $pname=$value['pname'];
  $c_code=$value['c_code'];
  $cname=$value['cname'];
  $ccredits=$value['ccredits'];
  $ctype=$value['ctype'];
  $semester=$value['semester'];
  $c_sno=$value['c_sno'];
  //$r_id=$value['r_id'];
  $rname=$value['rname'];

  $p_c_id=$value['p_c_id'];
?>
            <tr>
              <!--<td style="width: 2px;"><center></center></td> -->
              <td><center><?php echo "$pname"; ?></center></td>
              <td><center><?php echo "$c_code"; ?></center></td>
              <td><center><?php echo "$cname"; ?></center></td>
              <td><center><?php echo "$ccredits"; ?></center></td>
              <td><center><?php echo "$ctype"; ?></center></td>
              <td><center><?php echo "$semester"; ?></center></td>
              <td><center><?php echo "$c_sno"; ?></center></td>
              <td><center><?php echo $rname; ?></center></td>  
            
                <td>
                  <div class="btn-toolbar list-toolbar">
                    <center>
                      <button class="btn btn-primary btn-xs" style="margin-right: 4px;" title="Update" data-title="Update" onclick="get_programcourse_form('update',<?php echo "$p_c_id"; ?>)" >
                        <span class="glyphicon glyphicon-pencil"></span>
                      </button>
                        <button class="btn btn-danger btn-xs" title="Delete" data-title="Delete" onclick="get_programcourse_form('delete',<?php echo "$p_c_id"; ?>)" ><span class="glyphicon glyphicon-trash"></span></button>
                      </center>
                    </div>
                  </td>
            </tr>
            <!-- end edit model -->

<?php } ?>
          </tbody>
        </table>

<!-- start Add model -->
