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
    $res = mail($mail, "Invitation to CAcert Inc. opinon survey",
		"Dear Members of CAcert Inc.,\n\n"
    
		."today we ask you to give your voice.\n\n"
    
		."What happened?\n"
		."Several teams worked hard on the root re-sign procedure, which is an issue for \n"
		."CAcert for several years now. We agreed to a date on the eve of FOSDEM.\n"
		."To our surprise Bas send out an email and postponed this procedure.\n" 
		."(Reason: Understaffing, but 'As long as the calm and peace has not been returned\n" 
		."within CAcert, we are not able to facilitate the re-sign procedure.',\n" 
		."so 'postponed indefinitely').\n\n"

		."The root re-sign was discussed and agreed by motions m20100117.3, m20110515.2,\n" 
		."m20130710.5, m20141104.1 and m20150628.1 which led to the final and successful\n" 
		."test during FROSCON in August 2015. (You see, more than 5 years went by). It's\n" 
		."really time to close this issue now.\n"
		."The Community is awaiting the execution of this procedure, please see this\n" 
		."current tweet, https://mobile.twitter.com/1smar/status/685888483961995264\n\n"

		."What is to do?\n\n"
    
		."The current board wants to perform the root re-signing procedure.\n"
		."If you agree and want to support it then please vote YES. Your support may help\n" 
		."us getting this topic finally done.\n\n"
    		
		."We want you to give a YES.\n\n"    		

		."REMARK:\n"
		."This voting is indeed an opinion survey.\n"
		."The technical part is easy to understand. You receive an email with a link to\n" 
		."the voting system. Your voice is recorded in such a way that no one can link\n" 
		."your name to your voice.\n"
		."One software assessor checked the code. Nobody can vote multiple times.\n" 
		."Your first vote is your last vote! \n\n"
        
		."The voting is possible during the coming 6 days deadline 2016-01-28 00:00 UTC.\n" 
		."Please support us.\n\n"
            
		."The longer story can be read in our wiki, see\n" 
		."https://wiki.cacert.org/CAcertInc/OpinionSurveyRe-SigningRoot\n\n"
    		
		."Please give your opinion once using this link:\n"
		."https://cacert.eu/survey/audit/?token=$token\n"
		."the link will invalidate after you cast your vote.\n\n"
		."Polling will take place until 2016-01-28 00:00 UTC.\n"
		."Afterwards the results are available here:\n"
		."https://cacert.eu/survey/audit/\n\n"
		."To be as transparent as possible, the two php scripts to init the poll and to perform it are available here:\n"
		."https://github.com/BenBE/cacert-mini-survey\n\n"
		."Kind regards,\n"
    	."Reinhard Mutz in the name of CAcert Inc. board",
		"From: cacert-board-private@lists.cacert.org\r\n"
		."Reply-To: cacert-members@lists.cacert.org\r\n");
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
  