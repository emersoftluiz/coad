<?php

function login($username, $password) {
  $conn = db_connect();
  if (!$conn) {
    return 0;
  }
  
  $result = $conn->query("select * from admin
                         where username='". $conn->real_escape_string($username)."'
                         and password = sha1('". $conn->real_escape_string($password)."')");
  if (!$result) {
     return 0;
  }

  if ($result->num_rows>0) {
     return 1;
  } else {
     return 0;
  }
}

function check_admin_user(){
	
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
		session_unset();
        session_destroy();
    }
    $_SESSION['LAST_ACTIVITY'] = time(); 

    if(isset($_SESSION['admin_user'])){
        return true;
    } else {
        return false;
    }
}
?>
