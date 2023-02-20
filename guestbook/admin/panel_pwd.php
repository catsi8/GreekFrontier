<html>
<head>
<title>Guestbook - Password Settings</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript">
<!--
function checkForm() {
  if (document.FormPwd.NEWadmin_pass.value != document.FormPwd.confirm.value) {
    alert("The passwords do not match!");
    return false;
  }
}
//-->
</script>
</head>
<body bgcolor="#006699" link="#FFFFFF" vlink="#FFFFFF"><br>
<center>
<font size="2" face="Verdana, Arial" color="#FFFFFF"><b>C H A N G E&nbsp;&nbsp;&nbsp;&nbsp;P A S S W O R D</b></font><br><br>
</center>
<font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b><a href="<?php echo $this->SELF; ?>?action=show&amp;tbl=priv&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#FFFFFF">Private 
Messages</font></a> | <a href="<?php echo $this->SELF; ?>?action=show&amp;tbl=gb&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#FFFFFF">Easy 
Admin</font></a> | <a href="<?php echo $this->SELF; ?>?action=settings&amp;panel=general&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#FFFFFF">General 
Settings</font></a> | <a href="<?php echo $this->SELF; ?>?action=settings&amp;panel=style&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#FFFFFF">Style</font></a> 
| <a href="<?php echo $this->SELF; ?>?action=template&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#FFFFFF">Templates</font></a> 
| <a href="<?php echo $this->SELF; ?>?action=smilies&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#FFFFFF">Smilies</font></a> 
| <a href="<?php echo $this->SELF; ?>?action=settings&amp;panel=pwd&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#FFFFFF">Password</font></a> 
| <a href="<?php echo $this->SELF; ?>?action=logout&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#FFFFFF">Logout</font></a></b></font><br>
<hr>
<b><font size="1" face="Verdana, Arial" color="#FFFFFF">To check your environmental variables, <a href="<?php echo $this->SELF; ?>?action=info&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>"><font color="#FFFFFF">click here.</font></a></font></b>
<form action="<?php echo $this->SELF; ?>" name="FormPwd" method="post">
  <table border=0 width=100% bgcolor="#000000">
    <tr bgcolor="#000000">
      <td colspan=2 align=center height="25"><b><font size="2" face="Verdana, Arial" color="#FFFF00">Guestbook Username/Password </font></b></td>
    </tr>
    <tr bgcolor="#FCF0C0">
      <td colspan=2><font size="1" face="Verdana, Arial"><b>Below are the username or password for the guestbook admin.</b></font></td>
    </tr>
    <tr bgcolor="#dedfdf">
      <td width=50% bgcolor="#dedfdf"><b><font size="2" face="Verdana, Arial">Your Current UserName </font></b></td>
      <td width=50% bgcolor="#dedfdf"><input type="text" name="NEWadmin_name" value="<?php echo $row["username"]; ?>" size="30"></td>
    </tr>
    <tr bgcolor="#f7f7f7">
      <td width=50% bgcolor="#f7f7f7"> <b><font size="2" face="Verdana, Arial">Your Current Password</font></b></td>
      <td width=50%><input type="password" name="NEWadmin_pass" value="*****" size="30"></td>
    </tr>
    <tr bgcolor="#dedfdf">
      <td width=50%><b><font size="2" face="Verdana, Arial">Confirm New Password </font></b></td>
      <td width=50%>
        <input type="password" name="confirm" size="30">
        <input type="hidden" value="password" name="panel">
      </td>
    </tr>
  </table>
  <table border=0 width=100% bgcolor="#000000">
    <tr bgcolor="#000000">
      <td colspan=2 align=center height="25"><b><font size="2" face="Verdana, Arial" color="#FFFF00">Database Settings</font></b></td>
    </tr>
    <tr bgcolor="#FCF0C0">
      <td colspan=2><font size="1" face="Verdana, Arial"><b>Below are database settings for your mySQL database.</b></font></td>
    </tr>
    <tr bgcolor="#dedfdf">
      <td width=50% bgcolor="#dedfdf"><b><font size="2" face="Verdana, Arial">Database Name </font></b></td>
      <td width=50% bgcolor="#dedfdf"><b><font size="2" face="Verdana, Arial"><?php echo $this->db->db['dbName']; ?></font></b></td>
    </tr>
    <tr bgcolor="#f7f7f7">
      <td width=50% bgcolor="#f7f7f7"><b><font size="2" face="Verdana, Arial">MySQL Hostname</font></b><br>
        <font size="1" face="Verdana, Arial">Default is 'localhost'.</font></td>
      <td width=50%><b><font size="2" face="Verdana, Arial"><?php echo $this->db->db['host']; ?></font></b></td>
    </tr>
    <tr bgcolor="#dedfdf">
      <td width=50%> <b><font size="2" face="Verdana, Arial">MySQL Username </font></b><br>
        <font size="1" face="Verdana, Arial">Your mySQL username for the database.</font></td>
      <td width=50%><b><font size="2" face="Verdana, Arial"><?php echo $this->db->db['user']; ?></font></b></td>
    </tr>
    <tr bgcolor="#f7f7f7">
      <td width="50%" valign="top"> <b><font size="2" face="Verdana, Arial">Tables </font></b><br>
        <font size="1" face="Verdana, Arial">The tables used by the guestbook.</font></td>
      <td width=50%><font size="2" face="Verdana, Arial">

<?php
for (reset($this->table); $key=key($this->table); next($this->table)) {
    echo "- ".$this->table[$key]."<br>\n";
}
?>
      </font></td>
    </tr>
  </table>
  <br>
  <center>
    <input type="submit" value="Submit Settings" onclick="return checkForm()">
    <input type="reset"  value="Reset">
    <input type="hidden" value="<?php echo $this->uid; ?>" name="uid">
    <input type="hidden" value="<?php echo $this->session; ?>" name="session">
    <input type="hidden" value="password" name="panel">
    <input type="hidden" value="save" name="action">
  </center>
</form>

