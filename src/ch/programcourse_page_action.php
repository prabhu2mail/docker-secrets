<?php 

include "layout/header_script.php";

if(isset($_POST['insert_programcourse'])){
  $data=$_POST['insert_programcourse'];
  $info=$data;
  unset($info['id']);
  $db->sql_action("program_course","insert",$info);
}


else if(isset($_POST['update_programcourse'])){
  $info=$_POST['update_programcourse'];   
  $db->sql_action("program_course","update",$info);
}

if(isset($_POST['delete_programcourse'])){
  $info=$_POST['delete_programcourse'];    
  $db->sql_action("program_course","delete",$info);
}

if(isset($_POST['get_programcourse_form'])){
  ?>
 <div class="row">
    <div style="color: red;display:none;" class="col-xs-12 col-sm-12" id="error_div"></div>
    <div class="col-xs-12 col-sm-12">  
      <div class='form-group'>
        <label class='control-label' for='inputName'><b>Select Program</b></label>
        <div class='input-group'>
            <span class='input-group-addon'><i class='glyphicon glyphicon-exclamation-sign'></i></span> 
            <select class='form-control' id='p_id'>
              <option value="">Select Program</option>
              <?php echo $programcourse_ob->get_program_info();?>
            </select>
        </div>
      </div>  
      <div class='form-group'>
        <label class='control-label' for='inputName'><b>Select Course Code</b></label>
        <div class='input-group'>
            <span class='input-group-addon'><i class='glyphicon glyphicon-exclamation-sign'></i></span> 
            <select class='form-control' id='c_code' onchange="">
            <option value="">Select Course</option>
            <?php echo $programcourse_ob->get_course_list();?>
            </select>
        </div>
      </div>  
      <div class='form-group'>
        <label class='control-label' for='inputName'><b>Select Semester</b></label>
        <div class='input-group'>
              <span class='input-group-addon'><i class='glyphicon glyphicon-exclamation-sign'></i></span>     
              <select class='form-control' id='semester'>
                <option value='-1'>Select Semester</option>
                <?php 
                for($i=1; $i<=10; $i++) {
                    echo "<option value=".$i.">".$i."</option>";
                }?> 
              </select>
        </div>
      </div> 
     <div class='form-group'>
        <label class='control-label' for='inputName'><b>Select Course Order(Sl.No.)</b></label>
        <div class='input-group'>
              <span class='input-group-addon'><i class='glyphicon glyphicon-exclamation-sign'></i></span>     
              <select class='form-control' id='c_sno'>
                <option value='-1'>Select Course Order</option>
                <?php 
                for($i=1; $i<=12; $i++) {
                    echo "<option value=".$i.">".$i."</option>";
                }?> 
              </select>
        </div>
      </div>
      <div class='form-group'>
        <label class='control-label' for='inputName'><b>Select Regulation</b></label>
        <div class='input-group'>
          <span class='input-group-addon'><i class='glyphicon glyphicon-exclamation-sign'></i></span> 
          <select class='form-control' id='r_id'>
            <?php echo $programcourse_ob->get_regulation_info();?>
          </select>
        </div>
      </div>
        <button class="btn btn-lg btn-primary btn-block" name="insert" type="submit" onclick="programcourse_action('insert')"><span class="glyphicon glyphicon-floppy-save"></span> Save</button> 
  </div>
</div>
  <?php
}

if(isset($_POST['update_programcourse_form'])){
  $id=$_POST['update_programcourse_form'];
  $info=$programcourse[$id];
  $p_id=$info['p_id'];
  $c_code=$info['c_code'];
  $semester=$info['semester'];
  $c_sno=$info['c_sno'];
  $r_id=$info['r_id'];
  /*$select_type1=($c_type=="Theory")?"selected":"";
  $select_type2=($c_type=="Lab")?"selected":"";
  $select_type3=($c_type=="Online")?"selected":"";*/
?>

<div class="row">
  <div style="color: red;display:none;" class="col-xs-12 col-sm-12" id="error_div"></div>
  <div class="col-xs-12 col-sm-12">  
    <div class='form-group'>
      <label class='control-label' for='inputName'><b>Select Program</b></label>
      <div class='input-group'>
          <span class='input-group-addon'><i class='glyphicon glyphicon-exclamation-sign'></i></span> 
          <select class='form-control' id='p_id'>
            <?php echo $programcourse_ob->get_program_info($p_id);?>
          </select>
      </div>
    </div>  
    <div class='form-group'>
      <label class='control-label' for='inputName'><b>Select Course Code</b></label>
      <div class='input-group'>
          <span class='input-group-addon'><i class='glyphicon glyphicon-exclamation-sign'></i></span> 
          <select class='form-control' id='c_code' onchange="">
          <option value="">Select Course</option>
          <?php echo $programcourse_ob->get_course_list($p_id,$c_code);?>
          </select>
      </div>
    </div>
    <div class='form-group'>
        <label class='control-label' for='inputName'><b>Select Semester</b></label>
        <div class='input-group'>
              <span class='input-group-addon'><i class='glyphicon glyphicon-exclamation-sign'></i></span>     
              <select class='form-control' id='semester'>
                <option value='-1'>Select Semester</option>
                <?php 
                for($i=1; $i<=10; $i++) {
                    $selected = ($semester==$i) ? 'selected=""' : "";
                    echo "<option ".$selected." value=".$i.">".$i."</option>";
                }?> 
              </select>
        </div>
      </div> 
      <div class='form-group'>
        <label class='control-label' for='inputName'><b>Select Course Order(Sl.No.)</b></label>
        <div class='input-group'>
              <span class='input-group-addon'><i class='glyphicon glyphicon-exclamation-sign'></i></span>     
              <select class='form-control' id='c_sno'>
                <option value='-1'>Select Course Order</option>
                <?php 
                for($i=1; $i<=12; $i++) {
                  $selected = ($c_sno==$i) ? 'selected=""' : "";
                    echo "<option ".$selected." value=".$i.">".$i."</option>";
                }?> 
              </select>
        </div>
      </div>  
    <div class='form-group'>
      <label class='control-label' for='inputName'><b>Select Regulation</b></label>
      <div class='input-group'>
        <span class='input-group-addon'><i class='glyphicon glyphicon-exclamation-sign'></i></span> 
        <select class='form-control' id='r_id'>
          <?php echo $programcourse_ob->get_regulation_info($r_id);?>
        </select>
      </div>
    </div> 
    <button class="btn btn-lg btn-primary btn-block" name="insert" type="submit" onclick="programcourse_action('update',<?php echo "$id"; ?>)"><span class="glyphicon glyphicon-floppy-save"></span> Update</button>

    </div>
</div>
<?php
}

if(isset($_POST['delete_programcourse_form'])){
  $id=$_POST['delete_programcourse_form'];
  ?>

  <center>
    <h3>Are You Want To Delete This Course</h3><br/>
    <button class="btn btn-lg btn-primary btn-block" name="insert" type="submit" onclick="programcourse_action('delete',<?php echo "$id"; ?>)"><span class="glyphicon glyphicon-trash"></span> Delete</button>
  </center>

  <?php
}




?>