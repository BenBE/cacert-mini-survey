<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <?php /*<link rel="icon" href="../../favicon.ico">*/?>

    <title>CAcert mini survey</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"/>


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
          <a class="navbar-brand" href="#">CAcert Audit poll</a>
        </div>
        <?php /* <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
	  </div><!--/.navbar-collapse -->*/?>
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
if(time() < 1452625200){
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
       echo "<h1>Hello, world!</h1>";
       echo "<p>Here should be a text describing the exact matter that we want an opinion on.</p>";
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
      <!-- Example row of columns -->
    <?php /*  <div class="row">
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
       </div>
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
	</div>*/ ?>

      <hr>

      <footer>
        <p>2016 CAcert, Inc.</p>
      </footer>
    </div> <!-- /container -->


    <?php /*<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> */ ?>
  </body>
</html>
