<?php require_once('../Connections/connJCM.php'); ?>
<?php
session_start();
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "Unauthorized.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "ExpensesPurchases")) {
  $insertSQL = sprintf("INSERT INTO rep_capitalpurchases_cap (name_capexp, cost_capexp, idprop_capexp, type_capexp) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['cost'], "double"),
                       GetSQLValueString($_POST['hiddenField'], "int"),
                       GetSQLValueString($_POST['type'], "int"));

  mysql_select_db($database_connJCM, $connJCM);
  $Result1 = mysql_query($insertSQL, $connJCM) or die(mysql_error());

  $insertGoTo = "PartV.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_rsProposal = "1";
if (isset($_SESSION['MM_Username'])) {
  $colname_rsProposal = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
mysql_select_db($database_connJCM, $connJCM);
$query_rsProposal = sprintf("SELECT * FROM rep_proposal_prop WHERE username_prop = '%s'", $colname_rsProposal);
$rsProposal = mysql_query($query_rsProposal, $connJCM) or die(mysql_error());
$row_rsProposal = mysql_fetch_assoc($rsProposal);
$totalRows_rsProposal = mysql_num_rows($rsProposal);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>Texas State University-San Marcos | Research Enhancement Program Online Application</title>
<style type="text/css">
<!--
.style4 {
  font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 40px;
	color: #333399;
}
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
.style12 {color: #4d3319; }
-->
</style>

<style type="text/css">
<!--
.style9 {color: #4d3319}
.style15 {color: #003399;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
.style15 {font-weight: bold; color: #333399;}
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
//-->
</script>
</head>

<body>

<table width="650" border="1" align="center" cellpadding="5" cellspacing="0" >
  <!--DWLayoutTable-->
  <tr>
    <td width="650" height="150" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <!--DWLayoutTable-->
         <tr>
          <td rowspan="3" valign="top"><a href="http://www.txstate.edu"><img src="txstate_logo2.gif" alt="TxState" name="TxState" border="0" id="TxState"></a></td>
          <td width="180" rowspan="3" valign="top" class="style4"></td>
          <td width="72" height="38">&nbsp;</td>
           <td width="302" valign="top"><div align="right"><span class="style5"><a href="index.php" class="jcm"><font color = "#336699"></a></span><span class="style15"><span class="style15">Research Enhancement Program</span></span></div></td>        </tr>
    
        <tr>
          <td height="18"></td>
          <td valign="top"><div align="right" class="style7"><a href="LogOut.php">Log Out </a></div></td>
        </tr>
        <tr>
          <td height="21" colspan="4" valign="top"><div align="center"></div></td>
        </tr>
        <tr>
          <td height="27" colspan="4" valign="top"><table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" >
              <!--DWLayoutTable-->
              <tr align="left" >
                <td width="77" height="27" valign="middle"><div align="center"><a href="PartI.php" class="navbar style12">PI Information </a></div></td>
                
                <td width="5" valign="top"><span class="style12">|</span></td>
                <td width="58" valign="middle"><a href="PartIII.php" class="navbar style12">IRB/IACUC/Travel</a></td>
                <td width="3" valign="top"><span class="style12">|</span></td>
                <td width="76" valign="middle"><a href="PartIV.php" class="navbar style12">Wages/Salaries</a></td>
                <td width="4" valign="top"><span class="style12">|</span></td>
                <td width="103" align="center" valign="middle"><a href="PartV.php" class="navbar style12">Expenses/Purchases</a></td>
                <td width="3" valign="top"><span class="style12">|</span></td>
                <td width="39" align="center" valign="middle"><div align="center" class="style12"><a href="PartVI.php" class="navbar">Upload Narrative/Vita </a></div></td>
                <td width="3" valign="top"><span class="style12">|</span></td>
                <td width="64" align="center" valign="middle"><div align="center" class="style12"><a href="Review.php" class="navbar">View App </a></div></td>
              </tr>
              <tr>
                <td height="0"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
          </table></td>
        </tr>
            </table></td>
  </tr>
  <tr>
    <td height="348" valign="top">      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <!--DWLayoutTable-->
        <tr>
          <td width="650" height="374"><form action="<?php echo $editFormAction; ?>" method="POST" name="ExpensesPurchases" id="ExpensesPurchases" onSubmit="MM_validateForm('name','','R','cost','','RisNum');return document.MM_returnValue">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th class="style6 style8" scope="row">Maintenance Operating Expenses and/or Capital Purchases for <?php echo $row_rsProposal['title_prop']; ?><br> <br></th>
             </tr>
              <tr>
                <th scope="row"><div align="left" class="style7"><span class="style8 style9">Complete this form once for each maintenance operating expense and/or capital purchase requested. After saving the last set of expense/purchase information, click on the &quot;Upload Narrative/Vita,&quot; link in the blue navigation bar above to upload your narritave/vita file.</span></div></th>
              </tr>
              <tr>
                <th scope="row"><div align="left" class="style7">Name/Description: 
                  <input name="name" type="text" id="name" size="80">
                </div></th>
              </tr>
              <tr>
                <th scope="row"><div align="left" class="style7">
                  <input name="type" type="radio" value="1">
                Maintenance Operating Expense 
                <input name="type" type="radio" value="2">
                Capital Purchase </div></th>
              </tr>
              <tr>
                <th scope="row"><div align="left" class="style7">Amount $
                  <input name="cost" type="text" id="cost" size="10"> 
                  <input name="hiddenField" type="hidden" value="<?php echo $row_rsProposal['id_prop']; ?>">
                </div></th>
              </tr>
              <tr>
                <th scope="row"><input type="submit" name="Submit" value="Save"></th>
              </tr>
              <tr>
                <th scope="row"><span class="style7"><span class="style8 style9">After saving the last set of expense/purchase information, click on the &quot;Upload Narrative/Vita,&quot; link in the blue navigation bar above to upload your narritave/vita file.</span></span></th>
              </tr>
            </table>
              <input type="hidden" name="MM_insert" value="ExpensesPurchases">
          </form></td>
        </tr>
    </table></td>
  </tr>
  <tr>
      <td height="60" valign="top"><div align="center"><span class="style7">Office of the Associate Vice President for Research<br>
For questions regarding application submission contact: Michael Blanda at <a
 href="mailto:mb29@txstate.edu">mb29@txstate.edu</a> , x 2314 
      </span>
    </div></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rsProposal);
?>
