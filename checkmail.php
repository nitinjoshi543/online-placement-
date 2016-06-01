<?session_start();
$Reference = getenv ("HTTP_REFERER");
if((strtoupper($_SESSION[imgcode])!=strtoupper($_POST[imgcode]))&&!empty($_SESSION[imgcode]))
{
	echo"Your Verification image code not correct please try again! To go back ";
	exit("<A HREF=".$Reference.">Click Here</A>.");
}
elseif(empty($_SESSION[imgcode]))
	exit("Your session has been expire! ");

//require_once("decodemail.php");
//$recepent = findEmail($_POST[recipient]);
$recepent = "divyjoshi.btech@gmail.com";
$IP = getenv("REMOTE_ADDR");
$agent = getenv ("HTTP_USER_AGENT");
$headers = "To: ".$_POST[org_name]."  <".$recepent.">\r\n";
$headers .= "From: ".$_POST[name]."<".$_POST[email].">\r\n";
$headers .= "Content-type: text/html\r\n";
$headers .= "Reply-To:".$_POST[name]."<".$_POST[email].">\r\n";
$headers .= "Return-path:".$recepent."\r\n";
$headers .= "Received:".$recepent."\r\n";
$headers .= "Subject: ".$_POST[emailsubject]."\r\n";
$message = "<br/>This email is generated from IP: ".$IP;

 
//$recepent = "kngahtori@gmail.com";
if(!empty($_POST[name]))
{
	$message .= "<br/><br/><b>Name:</b>".$_POST[name];
}
if(!empty($_POST[fname]))
{
	$message .= "<br/><br/><b>First Name:</b>".$_POST[fname];
}
if(!empty($_POST[lname]))
{
	$message .= "<br/><br/><b>Last Name:</b>".$_POST[lname];
}
if(!empty($_POST[telephone]))
{
	$message .= "<br/><br/><b>Telephone No:</b>".$_POST[telephone];
}
if(!empty($_POST[email]))
{
	$message .= "<br/><br/><b>Email:</b>".$_POST[email];
}
if(!empty($_POST[company]))
{
$message .= "<br/><br/><b>Company name:</b>	".$_POST[company];
}
if(!empty($_POST[subject]))
{
$message .= "<br/><br/><b>Subject:</b>	".$_POST[subject];
}
if(!empty($_POST[message]))
{
$message .= "<br/><br/><b>Message:</b>	".$_POST[message];
}
if(!empty($_POST[checkbox]))
{
$message .= "<br/><br/><b>bi-weekly Power Leadership Lesson Bytes:</b>	".$_POST[checkbox];
}

$message .= "<br/><br/><hr/>Reference:".$Reference."<br/><br/>Agent:".$agent."<br/><br/>";
//exit($recepent."-----");

mail($recepent,$_POST[emailsubject],$message,$headers,$_POST[org_name]);

$message=$headers."<br>".$message;
    if($_POST[redirect_subscribe]!="")
       header("Location: ".$_POST[redirect_subscribe]);
     else
        header("Location: ".$_POST[redirect_contact]);
 exit;


?>