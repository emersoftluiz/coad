<?php
function get_request_details($id) {
	if ((!$id) || ($id=='')) {
		return false;
    }
    $conn = db_connect();
    $query = "select * from request where id='".$conn->real_escape_string($id)."'";
    $result = @$conn->query($query);
    if (!$result) {
        return false;
    }
    $result = @$result->fetch_assoc();
    return $result;
}

function insert_request($title, $request_type_id, $description, $client_name, $email, $phone, $request_status_id) {
	$conn = db_connect();  
	
	$query = "
	INSERT INTO `request` (`title`, `request_type_id`, `description`, `client_name`, `email`, `phone`, `request_status_id`)
	VALUES(
	'".$conn->real_escape_string($title)."',
	'".$conn->real_escape_string($request_type_id)."',
	'".$conn->real_escape_string($description)."',
	'".$conn->real_escape_string($client_name)."',
	'".$conn->real_escape_string($email)."',
	'".$conn->real_escape_string($phone)."',
	'".$conn->real_escape_string($request_status_id)."')";
	
	//print $query;
		
    $result = $conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function get_requests() {
	$conn = db_connect();
   
    $query = "
    SELECT request.id,
           request.title as title,
		   request.description as description,
		   request.request_data as request_data,
		   request.client_name as client_name,
		   request.email as email,
		   request.phone as phone,
           request_status.name as request_status,
		   request_type.name as request_type
    FROM request
    INNER JOIN request_status ON request_status.id = request.request_status_id
	INNER JOIN request_type ON request_type.id = request.request_type_id";
   
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

function delete_request($id) {
	
	$conn = db_connect(); 
    $query = "delete from request where id='".$conn->real_escape_string($id)."'";
    $result = @$conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function update_request($id, $title, $request_type_id, $description, $client_name, $email, $phone, $request_status_id) {
	
	$conn = db_connect();
		
	$query = "update request
			  set title = '".$conn->real_escape_string($title)."',
				  request_type_id = '".$conn->real_escape_string($request_type_id)."',
				  description = '".$conn->real_escape_string($description)."',
				  client_name = '".$conn->real_escape_string($client_name)."',
				  email = '".$conn->real_escape_string($email)."',
				  phone = '".$conn->real_escape_string($phone)."',
				  request_status_id = '".$conn->real_escape_string($request_status_id)."'
			  where id = '".$conn->real_escape_string($id)."'";
			  
	//var_dump($query);exit;

    $result = @$conn->query($query);
    if (!$result) {
        return false;
    } else {
        return true;
    }
}

function get_request_name($id) {
	
   $conn = db_connect();
   $query = "select name from request where id = '".$conn->real_escape_string($id)."'";
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
?>