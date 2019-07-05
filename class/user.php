<?php
/**
 *
 */
class User
{
  private $db;

function __construct($db){


  $this->_db = $db;
}

public function is_logged_in(){
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    return true;
  }
}

private function password_verify($password,$user) {
  try {

    $stmt = $this->_db->query('SELECT * FROM user WHERE password = "'.$password.'" and id ="'.$user.'"');
    //$stmt->execute();
    $row = $stmt->fetchArray();
    return $row['id'];

  } catch(PDOException $e) {
      echo '<p class="error">'.$e->getMessage().'</p>';
  }
}
private function get_user($username){

  try {

    $stmt = $this->_db->query('SELECT * FROM user WHERE user_name = "'.$username.'"');
    //$stmt->execute();

    return $stmt->fetchArray();

  } catch(PDOException $e) {
      echo '<p class="error">'.$e->getMessage().'</p>';
  }
}


public function login($username,$password,$persist){

  $user = $this->get_user($username);

	if(!is_null($this->password_verify($password,$user['id'])) && $this->password_verify($password,$user['id']) === $user['id']){

if ($persist) {
  //  $hash = crypt($username.$_SERVER['REMOTE_ADDR']);
    //  setcookie('dr_assistant', $username.'#~#'.$hash, time() + 3600 * 24 * 7, '/', '', false, true);

      $_SESSION['loggedin'] = true;
      $_SESSION['id'] = $user['id'];
      $_SESSION['username'] = $user['user_name'];
      $_SESSION['name'] = $user['full_name'];
      $_SESSION['info'] = $user['info'];

    }else {
      $_SESSION['loggedin'] = true;
      $_SESSION['id'] = $user['id'];
      $_SESSION['username'] = $user['user_name'];
      $_SESSION['name'] = $user['full_name'];
      $_SESSION['info'] = $user['info'];

    }

      return true;
  }

}


public function logout(){

  session_destroy();
  // We also unset the cookie
  if( isset($_COOKIE['dr_assistant']) )
  {
      setcookie('dr_assistant', '', time() - 3600, '/', '', false, true);
  }
}

}



 ?>
