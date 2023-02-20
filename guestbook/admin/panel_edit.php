<html>
<head>
<title>Guestbook - Edit Entry</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#006699" link="#FFFFFF" vlink="#FFFFFF"><br>
<center>
<font size="2" face="Verdana, Arial" color="#FFFFFF"><b>G U E S T B O O K&nbsp;&nbsp;&nbsp;&nbsp;A D M I N</b></font><br><br>
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
<br>
<form method="post" action="<?php echo $this->SELF; ?>">
  <table border="0" cellspacing="1" cellpadding="4" width="100%" align="center" bgcolor="#000000">
    <tr bgcolor="#000000">
      <td colspan="2" height="25"><b><font size="2" color="#FFFF00" face="Verdana, Arial, Helvetica, sans-serif">Edit the guestbook entry:</font></b></td>
    </tr>
    <tr bgcolor="#EFEFEF">
      <td width="25%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Name:</font></td>
      <td><input type="text" name="name" size="55" maxlength="50" value="<?php echo $row['name']; ?>"></td>
    </tr>
    <tr bgcolor="#EFEFEF">
      <td width="25%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">E-mail:</font></td>
      <td><input type="text" name="email" size="55" maxlength="100" value="<?php echo $row['email']; ?>"></td>
    </tr>
    <tr bgcolor="#EFEFEF">
      <td width="25%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Location:</font></td>
      <td><input type="text" name="location" size="55" maxlength="100" value="<?php echo $row['location']; ?>"></td>
    </tr>
    <tr bgcolor="#EFEFEF">
      <td width="25%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Homepage:</font></td>
      <td><input type="text" name="url" size="55" maxlength="60" value="<?php echo $row['url']; ?>"></td>
    </tr>
    <tr bgcolor="#EFEFEF">
      <td width="25%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">ICQ:</font></td>
      <td><input type="text" name="icq" size="55" maxlength="20" value="<?php if ($row['icq']!=0) {echo $row['icq'];} ?>"></td>
    </tr>
    <tr bgcolor="#EFEFEF">
      <td width="25%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Aim:</font></td>
      <td><input type="text" name="aim" size="55" maxlength="60" value="<?php echo $row['aim']; ?>"></td>
    </tr>
    <tr bgcolor="#EFEFEF">
      <td width="25%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Gender:</font></td>
      <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><input type="radio" name="gender" value="m" <?php if (!$row['gender'] || $row['gender']=="m") {echo "checked";} ?>>male
        <input type="radio" name="gender" value="f" <?php if ($row['gender']=="f") {echo "checked";} ?>>female</font></td>
    </tr>
    <tr bgcolor="#EFEFEF">
      <td width="25%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Host:</font></td>
      <td><input type="text" name="host" size="55" maxlength="255" value="<?php echo $row['host']; ?>"></td>
    </tr>
    <tr bgcolor="#EFEFEF">
      <td width="25%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Browser:</font></td>
      <td><input type="text" name="browser" size="55" value="<?php echo $row['browser']; ?>"></td>
    </tr>
    <tr bgcolor="#EFEFEF">
      <td width="25%" valign="top"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Your Message:</font></td>
      <td>
        <textarea name="comment" cols="41" rows="10" wrap="VIRTUAL"><?PHP echo $row['comment']; ?></textarea>
      </td>
    </tr>
    <tr bgcolor="#EFEFEF">
      <td width="25%">&nbsp;</td>
      <td>
        <input type="submit" value="Save Changes">
        <input type="reset"  value="Reset">
        <input type="button" value="Go Back" onclick="javascript:history.go(-1)">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="record" value="<? echo $record; ?>">
        <input type="hidden" name="id" value="<? echo $row['id']; ?>">
        <input type="hidden" name="session" value="<?php echo $this->session; ?>">
        <input type="hidden" name="uid" value="<?php echo $this->uid; ?>">
        <input type="hidden" name="tbl" value="<?php echo $tbl; ?>">
      </td>
    </tr>
  </table>
</form>

