<html>
<head>
<title>Guestbook - Smilies</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.text_size1 {  font-family: <?php echo $this->VARS["font_face"]; ?>; font-size: <?php echo $this->VARS["tb_font_1"]; ?>}
.text_size2 {  font-family: <?php echo $this->VARS["font_face"]; ?>; font-size: <?php echo $this->VARS["tb_font_2"]; ?>}
.font {  font-family: <?php echo $this->VARS["font_face"]; ?>; }
-->
</style>
</head>
<body bgcolor="#006699" link="#FFFFFF" vlink="#FFFFFF"><br>
<center>
  <font size="2" face="Verdana, Arial" color="#FFFFFF"><b>G U E S T B O O K&nbsp;&nbsp;&nbsp;&nbsp;S M I L I E S</b></font><br>
  <br>
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
<form action="<?php echo $this->SELF; ?>" name="FormMain" method="post">
  <table bgcolor="#000000" border="0" cellspacing="1" cellpadding="7" align="center" width="100%">
        <tr bgcolor="#000000"> 
            <td colspan="6" align="center" height="25"><b><font size="2" face="Verdana, Arial" color="#FFFF00">Smilies</font></b></td>
        </tr>
        <tr bgcolor="#663333"> 
            <td height="25"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#FFFFFF"><b>Smilie</b></font></td>
            <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#FFFFFF"><b>Filename</b></font></td>
            <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#FFFFFF"><b>Code</b></font></td>
            <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#FFFFFF"><b>Emotion</b></font></td>
            <td colspan="2"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#FFFFFF"><b>Action</b></font></td>
          </tr>
<?php
if (isset($smilie_data)) {
    echo "
          <tr bgcolor=\"#f7f7f7\"> 
            <td><img src=\"img/smilies/$smilie_data[s_filename]\" width=\"$smilie_data[width]\" height=\"$smilie_data[height]\"></td>
            <td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\">$smilie_data[s_filename]</font></td>
            <td><input type=\"text\" name=\"s_code\" value=\"".htmlspecialchars($smilie_data['s_code'])."\" size=\"15\"></td>
            <td><input type=\"text\" name=\"s_emotion\" value=\"".htmlspecialchars($smilie_data['s_emotion'])."\" size=\"25\"><input type=\"hidden\" name=\"edit_smilie\" value=\"$smilie_data[id]\"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>\n";
} else {
    $this->db->query("SELECT * FROM ".$this->table['smile']." ORDER BY s_filename ASC");
    while ($this->db->fetch_array($this->db->result)) {
        echo "
          <tr bgcolor=\"#f7f7f7\"> 
            <td><img src=\"img/smilies/".$this->db->record['s_filename']."\" width=\"".$this->db->record['width']."\" height=\"".$this->db->record['height']."\"></td>
            <td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\">".$this->db->record['s_filename']."</font></td>
            <td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\">".$this->db->record['s_code']."</font></td>
            <td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\">".$this->db->record['s_emotion']."</font></td>
            <td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><a href=\"$this->SELF?action=smilies&amp;session=$this->session&amp;uid=$this->uid&amp;edit_smilie=".$this->db->record['id']."\"><font color=\"#000033\">edit</font></a></font></td>
            <td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><a href=\"$this->SELF?action=smilies&amp;session=$this->session&amp;uid=$this->uid&amp;del_smilie=".$this->db->record['id']."\"><font color=\"#000033\">delete</font></a></font></td>
          </tr>\n";
    }
}
if (isset($smilie_list)) {
    for(reset($smilie_list); $key=key($smilie_list); next($smilie_list)) {
        echo "
          <tr bgcolor=\"#f7f7f7\"> 
            <td>$smilie_list[$key]</td>
            <td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\">$key</font></td>
            <td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><input type=\"text\" name=\"new_smilie[$key]\" size=\"15\"></font></td>
            <td><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><input type=\"text\" name=\"new_emotion[$key]\" size=\"25\"></font></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>\n";
    }
}
?>
        </table>
        <div align="center"><br>
          <font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b><a href="<?php echo $this->SELF; ?>?action=smilies&amp;session=<?php echo $this->session; ?>&amp;uid=<?php echo $this->uid; ?>&amp;scan_dir=1">Scan directory (img/smilies)</a></b><br><br>
          </font></div>
  <br>
  <center>
    <input type="submit" value="Submit Settings">
    <input type="reset" value="Reset">
    <input type="hidden" name="uid" value="<?php echo $this->uid; ?>">
    <input type="hidden" name="session" value="<?php echo $this->session; ?>">
    <input type="hidden" name="action" value="smilies">
    <input type="hidden" name="add_smilies" value="1">
  </center>
</form>

