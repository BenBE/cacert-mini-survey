<?php
if(!isset($_GET["token"]) || $_GET["token"] != "secretpasswordhere!!"){
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
		."This is a test mail to you to test this voting system.em"
		."We hereby invite you as a member of CAcert Inc. (i.e. cacert-members@lists.cacert.org) to participate in ...\n"
		."Please give your opinion using this link:\n"
		."https://felix.dogcraft.de/vote/?token=$token\n\n"
		."Polling will take place until 2016-01-12 19:00 UTC (which is 20:00 German Time).\n"
		."Afterwards the results are available here:\n"
		."https://felix.dogcraft.de/vote/\n\n\n"
		."To be as transparent as possible, the two php scripts to init the poll and to perform it are available here:\n\n"
		."https://github.com/felixdoerre/cacert-mini-survey\n\n\n\n"
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
  