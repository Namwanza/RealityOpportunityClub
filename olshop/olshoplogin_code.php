<?php


###############################
#---------- Uncomment While Closing -----------------
#  header('Location:'."../memberlogin.php?cls");
#############################


if(isset($_GET['adm']))
{
	session_start();
	$_SESSION['olshplogin']=1;
	$_SESSION['olshplogin']=$_GET['u'];
	header('Location:'."home.php");

}

else 

{


session_start();
include("../connect/connect.php");
include ("../lib/function_lib.php");
$_SESSION['user']=$_POST['shopid'];
$uname=make_safe($_POST['shopid']);
$pwd=make_safe($_POST['password']);
if (empty($_SESSION['secretword']) || trim(strtolower($_POST['captcha'])) != $_SESSION['secretword']) 
	{
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'  'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd' >  <html xmlns='http://www.w3.org/1999/xhtml' >  <head>  <meta http-equiv='Content-Type'  content='text/html; charset=utf-8'  />  <title>Error !!</title>  <link href='css/screen.css'  rel='stylesheet'  type='text/css' >  <script>  function update()  {  history.go(-1);  }  var refresh=setInterval('update()',3000);  </script>  </head>  <body>  <table width=' 100%'  height=' 100%'  border=' 0'  cellspacing=' 0'  cellpadding=' 0' >    <tr>      <td align=' center'  valign=' middle' ><div class='errormsg' > <div><strong>Error Found </strong><br/>      Please wait for a while.....<br/>       You are being redirected! If not then click <a href=' javascript:update()'  style=' cursor:pointer;'  onclick=' update()' ><font face=' Verdana'  size=' 1'  color=' #3399FF' >here</font></a></div></div></td>    </tr>  </table>  </body>  </html> ";
}
else 
{
	$qry=mysql_query("select store_id from olshops where store_id='$uname' and pass='$pwd'");
	$fary=mysql_num_rows($qry);
	if($fary==1)
		{
			$_SESSION['ologin']=1;
			$_SESSION['olshplogin']=$uname;
			header('Location:'."home.php");
		}
	else
		{
			$_SESSION['ologin']=0;
			header('Location:'."index.php?fail");
		}

}


}
?>