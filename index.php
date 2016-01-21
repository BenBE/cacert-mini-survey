<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="static/favicon.ico">

    <title>CAcert mini survey</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="static/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"/>

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">CAcert Re-Signing  survey</a>
        </div>
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
<?php
   function randomString() {
     $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
     $randstring = '';
     for ($i = 0; $i < 16; $i++) {
       $randstring .= $characters[rand(0, strlen($characters))];
     }
     return $randstring;
   }
   function isToken($v){
     return isset($v['token']) && preg_match("/^[a-zA-Z0-9]+$/", $v['token']) === 1 && file_exists("tokens/".$v['token']);
   }
function summary($dir, $name){
       $y = 0;
       echo "<p>$name: <ul>";
       if ($handle = opendir($dir)) {
	 while (false !== ($entry = readdir($handle))) {
	   if ($entry != "." && $entry != "..") {
	     echo "<li>$entry</li>\n";
	     $y++;
	   }
	 }
	 closedir($handle);
       }
       echo "</ul> Count: $y</p>";
}
if(time() < 1453939200){
     if( isToken($_POST) ) {
       if( isset($_POST['n']) && !isset($_POST['y'])) {
	 echo "<h1>Vote NO counted!</h1>";
	 echo "<p>";
	 $token = randomString();
	 if( rename("tokens/".$_POST['token'], "no/$token") ) {
	   echo "Your vote: \"NO\" was counted with token \"$token\". You should keep this token to verify that your vote was counted.";
	 }else{
	   echo "An error occured.";
	 }
	 echo "</p>";
       } else if(isset($_POST['y'])) {
	 echo "<h1>Vote YES counted!</h1>";
	 echo "<p>";
	 $token = randomString();
	 if( rename("tokens/".$_POST['token'], "yes/$token") ) {
	   echo "Your vote: \"YES\" was counted with token \"$token\". You should keep this token to verify that your vote was counted.";
	 }else{
	   echo "An error occured.";
	 }
	 echo "</p>";
       }else{
	 echo "<h1>Invalid vote was not counted!</h1>";
	 echo "<p>Invalid vote. Please try again.</p>";	 
       }
     } else if( isToken($_GET) ) {
       echo "<h1>Dear CAcert Inc. member!</h1>";
       echo "<p>Please give your vote until 2016-01-28 00:00 UTC.</p>";
       echo "<p>Should CAcert perform the Root Re-sign Procedure?</p>";
       echo "<p><form method='POST' action='?'><input type='hidden' name='token' value='{$_GET['token']}'>";
       echo "  <input class='btn btn-primary btn-lg' style='margin-right: 10px' role='button' type='submit' name='y' value='YES'>";
       echo "  <input type='submit' name='n' value='NO' class='btn btn-primary btn-lg'>";
       echo "</form></p>";
     } else {
       echo "<p>Token for voting not found or used!</p>";
     }
   } else {
       echo "<h1>Results:</h1>";
       summary("yes", "YES");
       summary("no", "NO");
   }
   ?>
      </div>
    </div>

    <div class="container">
       <hr>

      <footer>
        <p>2016 CAcert, Inc.</p>
      </footer>
    </div> <!-- /container -->
  </body>
</html>
