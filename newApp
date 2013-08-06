<?php require_once('../Connections/connJCM.php'); ?>
<?php
// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="InvalidUsername.php";
  $loginUsername = $_POST['username'];
  $LoginRS__query = "SELECT username_prop FROM rep_proposal_prop WHERE username_prop='" . $loginUsername . "'";
  mysql_select_db($database_connJCM, $connJCM);
  $LoginRS=mysql_query($LoginRS__query, $connJCM) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

// *** Redirect if title exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect2="invalidtitle.php";
  $loginTitle = $_POST['title'];
  $LoginRS__query2 = "SELECT title_prop FROM rep_proposal_prop WHERE title_prop='" . $loginTitle . "'";
  mysql_select_db($database_connJCM, $connJCM);
  $LoginRS2=mysql_query($LoginRS__query2, $connJCM) or die(mysql_error());
  $loginFoundTitle = mysql_num_rows($LoginRS2);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundTitle){
    $MM_qsChar = "?";
    //append the title to the redirect page
    if (substr_count($MM_dupKeyRedirect2,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect2 = $MM_dupKeyRedirect2 . $MM_qsChar ."reqtitle=".$loginTitle;
    header ("Location: $MM_dupKeyRedirect2");
    exit;
  }
}


function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "TestNewApp")) {
  $insertSQL = sprintf("INSERT INTO rep_proposal_prop (title_prop, pw_prop, abstract, username_prop, email_prop) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
  				      GetSQLValueString($_POST['abstract'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['textfield'], "text"));

  mysql_select_db($database_connJCM, $connJCM);
  $Result1 = mysql_query($insertSQL, $connJCM) or die(mysql_error());

  $insertGoTo = "PartI.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php 
//trying to set a session variable called MM_Username equal to the username textbox for later use in the multipart form

session_start();

    //declare a session variable and assign it
    $GLOBALS['MM_Username'] = $loginUsername;
	
	//register the session variable
    session_register("MM_Username");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Texas State University-San Marcos | REP Online Application</title>
<style type="text/css">
<!--
.style5 {
	color: #333399;
	font-style: italic;
	font-weight: bold;
}
.style6 {
	font-family: Arial, Helvetica, sans-serif;
	color: #333399;
	font-weight: bold;
}
.style7 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #4d3319;
}
a.navbar:link {
	color: #4d3319;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
}
a.navbar:visited {
	color: #4d3319;
	text-decoration: none;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
a.navbar:hover {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	text-decoration: underline;
}
a.body:link {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #336699;
	text-decoration: underline;
}
a.body:visited {
	font-family: Arial, Helvetica, sans-serif;
	color: #4D3319;
	text-decoration: underline;
}
a.jcm:link{
font-family: Arial, Helvetica, sans-serif;
	color: #336699;
	text-decoration: none;

}
a.jcm:visited {
	font-family: Arial, Helvetica, sans-serif;
	color: #336699;
	text-decoration: none;
}
.style14 {color: #003399;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}

function validate(form) {
var e = form.elements, m = '';
if(!e['title'].value) {m += '- Title is required.\n';}
if(!e['username'].value) {m += '- Username is required.\n';}
if(!e['textfield'].value) {m += '- Email is required.\n';}
if(!/.+@[^.]+(\.[^.]+)+/.test(e['textfield'].value)) {
m += '- E-mail requires a valid e-mail address.\n';
}
if(!e['password2'].value) {m += '- Password confirm is required.\n';}
if(!e['password'].value) {m += '- Password is required.\n';}
if(e['password'].value != e['password2'].value) {
m += '- Your password and confirmation password do not match.\n';
}
if(m) {
alert('The following error(s) occurred:\n\n' + m);
return false;
}
return true;
}
//-->
</script>
</head>

<body>

<table width="650" border="1" align="center" cellpadding="5" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="650" height="150" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <!--DWLayoutTable-->
         <tr>
            <td rowspan="3" style="width: 96px; vertical-align: top;"><a
 href="http://www.txstate.edu"><img src="txstate_logo2.gif"
 alt="TxState" name="TxState" id="TxState" border="0"></a></td>
            <td rowspan="3" class="style6"
 style="width: 180px; vertical-align: middle;">&nbsp;</td>
            <td height="38" colspan="2">
              <div class="style14" align="right">Research Enhancement Program</div></td>
          </tr>
      
        <tr>
          <td width="72" height="18"></td>
          <td width="302" valign="top"><div align="right" class="style7"><a href="LogOut.php">Log Out </a></div></td>
        </tr>
        <tr>
          <td height="21" colspan="4" valign="top"><div align="center"></div></td>
        </tr>
        <tr>
          <td height="27" colspan="4" valign="top"><table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
              <!--DWLayoutTable-->
              <tr>
                <td width="77" height="0"></td>
                <td width="3"></td>
                <td width="108"></td>
                <td width="5"></td>
                <td width="58"></td>
                <td width="3"></td>
                <td width="76"></td>
                <td width="4"></td>
                <td width="103"></td>
                <td width="3"></td>
                <td width="39"></td>
                <td width="3"></td>
                <td width="64"></td>
              </tr>
          </table></td>
        </tr>
            </table></td>
  </tr>
  <tr>
    <td height="348" valign="top">      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <!--DWLayoutTable-->
        <tr>
          <td width="650" height="374"><form action="<?php echo $editFormAction; ?>" method="POST" name="TestNewApp" id="TestNewApp"  onsubmit="return validate(this);">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            
            
              <tr>
                <th class="style6 style8" scope="row">Begin a New Application </th>
              </tr>
              <tr>
                <th scope="row"><div align="left" class="style7 style8">Complete this form to create a new application in the REP Online Application System. If you have previously started an application in the system, DO NOT use this form. Instead <a href="LogIn.php">log in</a> with the username and password you created to access your application, or <a href="Retreive.php">retreive</a> your username and password (if you have forgotten it). </div></th>
              </tr>
              <tr>
                <th class="style7" scope="row"><div align="left"><br>Title of Proposal: </div></th>
              </tr>
			  
              <tr>
                <th class="style7" scope="row"><div align="left">
                  <input name="title" type="text" id="title" size="90">
                </div></th>
              </tr>
			  <tr>
                <th class="style7" scope="row"><div align="left">
                  <p><br>
                    Abstract of Proposal (250 words maximum. No pictures and diagrams. You may type directly into the text box area or cut and paste into the box.) <br>
                    <label>
                      <textarea name="abstract" cols="100" rows="10" id="abstract"></textarea>
                    </label>
                  </p>
                  </div></th>
              </tr>
              <tr>
                <th class="style7" scope="row"><div align="left"><br>Create a Username: </div></th>
              </tr>
              <tr>
                <th class="style7" scope="row"><div align="left">
                  <input name="username" type="text" id="username">
                </div></th>
              </tr>
              <tr>
                <th class="style7" scope="row"><div align="left" class="style8"><br>Only ONE username and password set is allowed per application. This will be the only username authorized to view or change your application; therefore, make sure that all those who have your permission to alter your application have this username. </div></th>
              </tr>
              <tr>
                <th class="style7" scope="row"><div align="left"><br>Create a Password:</div></th>
              </tr>
              <tr>
                <th class="style7" scope="row"><div align="left">
                  <input name="password" type="password" id="password">
                </div></th>
              </tr>

 <tr>
                    <th class="style7" scope="row">
                    <div align="left"><br>Confirm Password:</div>
                    </th>
                </tr>
                  <tr>
                  </tr>
                  <tr>
                    <th class="style7" scope="row">
                    <div align="left"> <input name="password2"
 id="password2" type="password"> </div>
                    </th>
                  </tr>


              <tr>
                <th class="style7" scope="row"><div align="left"><br>Contact Email: </div></th>
              </tr>
              <tr>
                <th class="style7" scope="row"><div align="left">
                  <input type="text" name="textfield">
                </div></th>
              </tr>
              <tr>
                <th scope="row"><div align="left" class="style7 style8"><br>
                REP will use this address to contact you with regard to this proposal. Your username and password will also be sent to this address in the the event that you forget them. </div></th>
              </tr>
              <tr>
                <th scope="row"><input type="submit" name="Submit" value="Submit"></th>
              </tr>
            </table>
              <input type="hidden" name="MM_insert" value="TestNewApp">
          </form></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td style="vertical-align: top; height: 60px;">
      <div align="center"><span class="style7">       Office of the Associate Vice President for Research<br>
For questions regarding application submission contact: Michael Blanda at <a
 href="mailto:mb29@txstate.edu">mb29@txstate.edu</a> , x 2314       </span>
    </div></td>
  </tr>
</table>
</body>
</html>
