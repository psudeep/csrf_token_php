<?php
session_start();
function CSRF(){
  $csrf = sha1(uniqid(rand(), true));
  return $csrf;
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Set the host and csrf token in session and put csrf token as hidden field in form
    $_SESSION['_host']= $_SERVER['HTTP_HOST'];
    $_SESSION['_csrf'] = CSRF();
}

// When the form is posted 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $parts = parse_url( $_SERVER["HTTP_REFERER"]);
  if($_SESSION['_csrf']==$_POST['_csrf'] && $_SESSION['_host']==$parts[ "host" ]){
    // Do the Stuffs to be done for POST
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CSRF Token Example</title>
  </head>  
  <body>
    <form role="form" method="post" action="">
      <input type="hidden" name="_csrf" value="<?php echo $_SESSION['_csrf'];?>">
    </form>  
  </body>
</html>  
