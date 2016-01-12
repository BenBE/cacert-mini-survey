<?php
include("config.php");
if(!isset($_GET["token"]) || $_GET["token"] != $key){
  exit;
}
function randomString() {
  $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $randstring = '';
  for ($i = 0; $i < 16; $i++) {
    $randstring .= $characters[rand(0, strlen($characters))];
  }
  return $randstring;
}
if(isset($_POST['mails'])){
  $mails = $_POST['mails'];
  $addrs = explode("\n", $mails);
  foreach($addrs as $mail){
    $mail = trim($mail);
    if($mail === "") continue;
    $token = randomString();
    touch("tokens/$token");
    $res = mail($mail, "Invitation to CAcert Inc. Poll",
		"Hi,\n\n"
		."This is a test mail to you to test this polling system.\n"
		."We hereby invite you as a member of CAcert Inc. (i.e. cacert-members@lists.cacert.org) to participate in ...\n"
		."Please give your opinion once using this link:\n"
		."https://felix.dogcraft.de/vote/?token=$token\n"
		."the link will invalidate after use.\n\n"
		."Polling will take place until 2016-01-12 19:00 UTC (which is 20:00 German Time).\n"
		."Afterwards the results are available here:\n"
		."https://felix.dogcraft.de/vote/\n\n"
		."To be as transparent as possible, the two php scripts to init the poll and to perform it are available here:\n"
		."https://github.com/felixdoerre/cacert-mini-survey\n\n"
		."Kind regards,...",
		"From: cacert-board@lists.cacert.org\r\n"
		."Reply-To: cacert-board@lists.cacert.org\r\n");
    if($res) {
      echo "$mail succeeded<br/>\n";
    } else {
      echo "$mail failed<br/>\n";
    }
  }
  exit;
}
?>
<form method="POST">
  <textarea name="mails" rows="20" cols="50"></textarea><br/>
  <input type="submit">
</form>
  