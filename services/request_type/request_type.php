<?php
function get_request_type_name($id) {
	
   $conn = db_connect();
   $query = "select name from request_type where id = '".$conn->real_escape_string($id)."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $row = $result->fetch_object();
   return $row->name;
}

function insert_request_type($name) {
	$conn = db_connect();   
    $query = "select id from request_type where name='".$conn->real_escape_string($name)."'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows!=0)) {
        return false;
    }
	
	$query = "INSERT INTO `request_type` (`id`, `name`) VALUES (NULL, '".$conn->real_escape_string($name)."')";
    $result = $conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function get_request_types() {
   $conn = db_connect();
   $query = "select id, name from request_type";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function delete_request_type($id) {
	
	$conn = db_connect();   
    $query = "select request_type_id from request where request_type_id='".$conn->real_escape_string($id)."'";

    $result = @$conn->query($query);
    if ((!$result) || (@$result->num_rows > 0)) {
        return false;
    }

    $query = "delete from request_type where id='".$conn->real_escape_string($id)."'";
    $result = @$conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function update_request_type($id, $name) {
	
	$conn = db_connect();

    $query = "update request_type set name='".$conn->real_escape_string($name) ."' where id='".$conn->real_escape_string($id) ."'";
    $result = @$conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function get_request_status() {
   $conn = db_connect();
   $query = "select id, name from request_status";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}
?>
