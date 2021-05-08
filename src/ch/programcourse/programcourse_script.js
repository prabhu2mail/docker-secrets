url = "programcourse_action.php";
modal_body = "modal_sm_body";
modal = "sm";

var action_data = {
  url: url,
  div: modal_body,
  load: 0,
};

function get_programcourse_form(type, id = 0) {
  var data= {};
  if (type == "insert") {
    header = "Add Course";
    data_key = "get_programcourse_form";
    val = 1;
  } else if (type == "update") {
    header = "Update Program Course";
    data_key = "update_programcourse_form";
    val = id;
  } else {
    header = "Delete Program Course";
    data_key = "delete_programcourse_form";
    val = id;
  }

  modal_open(modal, header);
  loader(modal_body);

  var data = {
    [data_key]: val,
  };

  get_ajax(action_data, data);
}

function programcourse_action(type, id = 0) {
  delete_type = 0;
  if (type == "insert") {
    data_key = "insert_programcourse";
  } else if (type == "update") {
    data_key = "update_programcourse";
  } else {
    data_key = "delete_programcourse";
    delete_type = 1;
  }
  
  $.ajax({
    url: "select_program_course_action.php",
    type: "POST",
    data: { id: id,p_id: get_value("p_id"),c_code:  get_value("c_code"),r_id: get_value("r_id") },
    success: function (response) {
      // console.log($.trim(response));
      if($.trim(response)==1) {
        error = 1;
        $("#error_div").show();
        $("#error_div").html("Selected Course has been already addded");
        alert('Selected Course has been already addded');
      }
      else {  
        if (delete_type == 0) {
          //must be given for input
          var data_val = {
            id: id,
            p_id: get_value("p_id"),
            c_code: get_value("c_code"),
            semester: get_value("semester"),
            c_sno: get_value("c_sno"),
            r_id: get_value("r_id"),
          };
          error = filter_data(data_val);
        } else {
          var data_val = {
            id: id,
          };
          error = 0;
        }

        var data = {
          [data_key]: data_val,
        };

        if (error == 0) {
          action_data["load"] = 1;
          loader(modal_body);
          console.log(action_data)
          console.log("data",data)
          get_ajax(action_data, data);
        }
      }
    },
  });
}

function filter_data(data) {
  id = data["id"];
  p_id = data["p_id"];
  c_code = data["c_code"];
  semester = data["semester"];
  c_sno = data["c_sno"];
  r_id = data["r_id"];
  error = 0;
  // var status = check_entry(p_id,c_code,r_id);
  console.log(status);
  if (p_id == "") {
    alert("Enter Program ID");
    error = 1;
  } else if (c_code == "") {
    alert("Enter Course Code");
    error = 1;
  } else if (semester == "") {
    alert("Enter Semester");
    error = 1;
  } else if (c_sno == "") {
    alert("Enter Course Order(Sl.No.)");
    error = 1;
  } else if (r_id == "") {
    alert("Enter Regulation");
    error = 1;
  }

  return error;
}


