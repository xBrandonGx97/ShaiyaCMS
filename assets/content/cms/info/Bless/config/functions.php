<?php 
function mssql_escape_string($data)//SQL ANTI-INJECTION SECURITY!
  {
      if (!isset($data) or empty($data))
          return '';
      if (is_numeric($data))
          return $data;
      $non_displayables = array('/%0[0-8bcef]/', // url encoded 00-08, 11, 12, 14, 15
      '/%1[0-9a-f]/', 				   			 // url encoded 16-31
      '/[\x00-\x08]/', 							 // 00-08
      '/\x0b/', 								 // 11
      '/\x0c/', 								 // 12
      '/[\x0e-\x1f]/');							 // 14-31
      foreach ($non_displayables as $regex)
          $data = preg_replace($regex, '', $data);
      $data = str_replace("'", "''", $data);
      return $data;
  }
  
function crypt_password($password) {
    // On "sale" le mot de passe puis on le hash
    return sha1(md5('4Hdk$5'.$password.'9*f-F'));
}

function check_email($email) {
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
}

 ?>