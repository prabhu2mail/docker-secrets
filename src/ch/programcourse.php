<?php

/**
*
*/
//include 'script/regulation/regulation.php';
class programcourse
{
	
 // public $regulation=array();
  public $batch=array();
	 public function __construct(){
     
     $this->db=new database();
     $this->conn=$this->db->conn;
     //$this->batch=$this->batch->batch_info();
  
     //  $this->regulation=new regulation();
    // $this->regulation=$this->regulation->regulation_info();
  
 }

 public function select($query){
   return $this->result=$this->db->select($query);
  }


/*  public function in_regulation($in){
    $info=array();
         foreach ($in as $key => $in) {
           $id=$in;
           foreach ($this->regulation as $key => $regulation) {
             $id1=$regulation['id'];
             if($id1==$id){
               $info[$id]=$regulation;
             }
           }
         }
         return $info;
  }*/ 

  public function num_array($st){
    $num=explode(',', $st);
    return $num;
  } 

  public function convert_arr($arr){
    //convert arr to string ex:a[2]={1,2} output: st="1,2";
      $st="";
      $c=0;
      $si=sizeof($arr);
      foreach ($arr as $key => $value) {
         $c++;
         $s=$value['r_name'];
         $st=$st.$s;
        if($si!=$c) $st=$st.' , ';
      }
   return $st;
    }
  
    public function program_course_exists_or_not($pc_id,$p_id, $c_code, $r_id){
      $course="";
      $sql="SELECT count(*) as cnt"
        ." FROM"
        ." course"
        ." LEFT JOIN program_course ON program_course.c_code = course.c_code"
        ." WHERE program_course.p_id=".$p_id." AND program_course.c_code='".$c_code."' AND program_course.r_id=".$r_id;
      if($pc_id!=0)  
        $sql .= " AND program_course.id !=".$pc_id;
      // echo $sql;
      $result=$this->select($sql);
      if(mysqli_num_rows($result)){
        $row = mysqli_fetch_array($result);
        $count = $row['cnt'];
        return $count;
      }
    }
  public function get_course_list($p_id="", $c_code="", $r_id=""){
    $course="";
    echo $sql="SELECT id,c_name,c_code FROM course ORDER BY id ASC";
    $res=$this->select($sql);
    while ($row=mysqli_fetch_array($res)) {
      if(isset($c_code) && $c_code==$row['c_code'])
        $selected ='selected=""';
      else
        $selected="";
      $course .="<option ".$selected." value=".$row['c_code'].">".$row['c_code']."</option>";
    }
    return $course;
  }
  public function get_programcourse_info(){
      $info=array();
      $crs=array();
    // $sql="select c.id as course_id,r.id as reg_id,r_name, c_code, c_name, c_category, c_credits, c_type, r_name " 
      //    ."from course c LEFT JOIN regulation r on r.id=c.r_id ORDER BY c.id DESC";
     $sql="SELECT program_course.id as p_c_id, program_course.p_id, program_course.r_id, program.p_name as pname, program_course.c_code,"
           ."course.c_name as cname,course.c_credits as ccredits, course.c_type as ctype, program_course.semester,"
           ."program_course.c_sno, regulation.r_name as rname FROM program_course "
           ."LEFT JOIN course ON program_course.c_code = course.c_code "
           ."LEFT JOIN program ON program_course.p_id = program.id "
           ."LEFT JOIN regulation ON program_course.r_id = regulation.id";

     $res=$this->select($sql);
     while ($row=mysqli_fetch_array($res)) {
      // print_r($row);
     	$id=$row['p_c_id'];
      $pcrs['p_c_id']=$id;
      $pcrs["p_id"]=$row['p_id'];
     	$pcrs["pname"]=$row['pname'];
      $pcrs["c_code"]=$row['c_code'];
      $pcrs["cname"]=$row['cname'];
      $pcrs["ccredits"]=$row['ccredits'];
      $pcrs["ctype"]=$row['ctype'];
      $pcrs["semester"]=$row['semester'];
      $pcrs["c_sno"]=$row['c_sno'];
      $pcrs["r_id"]=$row['r_id'];
      $pcrs["rname"]=$row['rname'];

    //  $sub['regulation']=$this->in_regulation($this->num_array($row['r_id']));
    //  $sub['regulation_string']=$this->convert_arr($sub['regulation']);
      $info[$id]=$pcrs;
    }
    // print_r($info); exit;
	  return $info;
  }

  public function get_program_info($p_id=""){
    $info=array();
    $reg="";
    $sql="select * from program";
    $res=$this->select($sql);
    while ($row=mysqli_fetch_array($res)) {
      if(isset($p_id) && (int)$p_id==$row['id'])
        $selected ='selected=""';
      else
        $selected="";
      $reg .="<option ".$selected." value=".$row['id'].">".$row['p_name']."</option>";
    }
    return $reg;
  }
  
  public function get_regulation_info($r_id=""){
    $info=array();
    $reg="";
    $sql="select * from regulation ORDER BY id DESC";
    $res=$this->select($sql);
    while ($row=mysqli_fetch_array($res)) {
      if(isset($r_id) && (int)$r_id==$row['id'])
        $selected ='selected=""';
      else
        $selected="";
      $reg .="<option ".$selected." value=".$row['id'].">".$row['r_name']."</option>";
    }
    return $reg;
  }


 public function get_new_course_id(){
    $info=$this->get_course_info();
    $sub_id=array();
    array_push($sub_id, 0);
  foreach ($info as $key => $value) {
    $id=$value['id'];
    array_push($sub_id, $id);
  }
  rsort($sub_id);
  return $sub_id[0]+1;
  }

  public function select_regulation($cou_id=-1){
       
    $regulation=$this->regulation;
    $info=$this->get_course_info();
  
   $mark=array();
   foreach ($regulation as $key => $value) {
       $id=$value['id'];
       $mark[$id]=0;
   }

  if($cou_id!=-1){
      foreach ($info[$cou_id]['regulation'] as $key => $value) {
          $id=$value['id'];
          $mark[$id]=1;
      }
  }
     foreach ($regulation as $key => $value) {
      $id=$value['id'];
      $name=$value['r_name']; 
      if($mark[$id]==0){
        echo "<input type='checkbox' name='regulation[]' value='$id'> $name <br>";
    }
    else{
     echo "<input type='checkbox' name='regulation[]' value='$id' checked> $name <br>";
    }
 }
}

 
}

?>