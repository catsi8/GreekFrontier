<html>
<head>
<title>Guestbook - Easy Admin</title>
<?php
if (file_exists("{$this->db->include_path}/lang/{$this->VARS['lang']}.php")) {
	$LANG_CODES = "{$this->db->include_path}/lang/{$this->VARS['lang']}.php";
} else {
	$LANG_CODES = "{$this->db->include_path}/lang/english.php";
}
include "$LANG_CODES";
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language=JavaScript>
<!--
function CheckValue() {
  if(!(document.FormMain.record.value >= 1)) {
    alert("Invalid record number!");
    document.FormMain.record.focus();
    return false;
  }
}
function gb_picture(Image,imgWidth,imgHeight) {
    var border = 24;
    var img = Image;
    var features;
    var w;
    var h;
    winWidth = (imgWidth<100) ? 100 : imgWidth+border;
    winHeight = (imgHeight<100) ? 100 : imgHeight+border;
    if (imgWidth+border > screen.width) {
        winWidth = screen.width-10;
        w = (screen.width - winWidth)/2;
        features = "scrollbars=yes";      
    } else {
        w = (screen.width - (imgWidth+border))/2;
    }
    if (imgHeight+border > screen.height) {
        winHeight = screen.height-60;
        h = 0;
        features = "scrollbars=yes";      
    } else {
        h = (screen.height - (imgHeight+border))/2 - 20;
    }
    winName = (img.indexOf("t_") == -1) ? img.substr(4,(img.length-8)) : img.substr(6,(img.length-10));
    features = features+',toolbar=no,width='+winWidth+',height='+winHeight+',top='+h+',left='+w;
    theURL = 'picture.php?img='+Image;
    popup = window.open(theURL,winName,features);
    popup.focus();  
}
//-->
</script>
<style type="text/css">
<!--
td {  font-family: Verdana, Arial, Helvetica, sans-serif}
body {  font-family: Verdana, Arial, Helvetica, sans-serif}
select {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt}
input {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt}
-->
</style>
</head>
<body bgcolor="#006699" link="#003399" vlink="#003399"><br>
<center>
<font size="2" face="Verdana, Arial" color="#FFFFFF"><b>E A S Y&nbsp;&nbsp;&nbsp;&nbsp;A D M I N</b></font><br><br>
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
<form method="post" action="<?php echo $this->SELF; ?>" name="FormMain" onsubmit="return CheckValue()">
  <table width="100%" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="#000000">
    <tr>
      <td>
        <input type="text" name="record" size="12">
        <input type="submit" value="Jump to record">
        <input type="hidden" name="action" value="show">
        <input type="hidden" name="session" value="<?php echo $this->session; ?>">
        <input type="hidden" name="uid" value="<?php echo $this->uid; ?>">
        <input type="hidden" name="tbl" value="<?php echo $tbl; ?>">
      </td>
      <td align="right">&nbsp;
<?php
echo "<a href=\"$this->SELF?action=show&amp;tbl=$tbl&amp;entry=0&amp;session=$this->session&amp;uid=$this->uid\"><font color=\"#FFFF00\" size=\"2\"><b>Goto Top</b></font></a>\n";
if ($prev_page >= 0) {
 echo "  &nbsp;&nbsp;<a href=\"$this->SELF?action=show&amp;tbl=$tbl&amp;entry=$prev_page&amp;session=$this->session&amp;uid=$this->uid\"><font color=\"#FFFF00\" size=\"2\"><b>Previous Page</b></font></a>\n";
}
if ($next_page < $total) {
 echo "  &nbsp;&nbsp;<a href=\"$this->SELF?action=show&amp;tbl=$tbl&amp;entry=$next_page&amp;session=$this->session&amp;uid=$this->uid\"><font color=\"#FFFF00\" size=\"2\"><b>Next Page</b></font></a>\n";
}

?> </td>
   </tr>
  </table>
  <table border="0" cellspacing="1" cellpadding="5" align="center" width="100%" bgcolor="#000000">
    <tr bgcolor="#BCBCDE">
      <td width="30%"><font size="2"><b>Name</b></font></td>
      <td width="60%"><font size="2"><b>Comments</b></font></td>
      <td width="10%">&nbsp;</td>
    </tr>

<?php

$id = $total-$entry;
$i=0;
while ($row = $this->db->fetch_array($result)) {

$name = $row['name'];
$date = date("D, F j, Y H:i",$row['date']);
$comment = nl2br($row['comment']);
$bgcolor = ($i % 2) ? "#F7F7F7" : "#DEDFDF";
$i++;

echo " <tr bgcolor=\"$bgcolor\">\n   <td width=\"30%\" valign=\"top\">
  <table border=0 cellspacing=0 cellpadding=2>\n    <tr>
     <td><font size=1>$id)</font></td>
     <td><font size=2><b>$name</b></font></td>\n    </tr>\n    <tr>\n";
if ($row['email']) {
  echo "     <td><font size=1><b>e-mail</b></font></td>
     <td><font size=1>$row[email]</font></td>\n    </tr>\n";
}
if ($row['url']) {
  echo "    <tr>\n     <td><b><font size=1>URL:</font></b></td>
     <td><font size=1>$row[url]</font></td>\n    </tr>\n";
}
if ($row['icq'] && $this->VARS["allow_icq"]==1) {
  echo "    <tr>\n     <td><b><font size=1>ICQ:</font></b></td>
     <td><font size=1>$row[icq]</font></td>\n    </tr>\n";
}
if ($row['aim'] && $this->VARS["allow_aim"]==1) {
  echo "    <tr>\n     <td><b><font size=1>Aim:</font></b></td>
     <td><font size=1>$row[aim]</font></td>\n    </tr>\n";
}
if ($this->VARS["allow_gender"]==1) {
  if ($row['gender']=="f") {
    echo "    <tr>\n     <td><b><font size=1>Gender:</font></b></td>
     <td><font size=1>female</font></td>\n    </tr>\n";
  } else {
    echo "    <tr>\n     <td><b><font size=1>Gender:</font></b></td>
     <td><font size=1>male</font></td>\n    </tr>\n";
  }
}
if ($row['location']) {
  echo "    <tr>\n     <td><b><font size=1>Location:</font></b></td>
     <td><font size=1>$row[location]</font></td>\n    </tr>\n";
}
$hostname = ( eregi("^[-a-z_]+", $row['host']) ) ? "Host" : "IP";
echo "  </table>\n   </td>\n   <td width=\"60%\" valign=\"top\"><font face=Arial size=1><b>$date $hostname: $row[host]</b></font>\n    <hr size=1>
    <font size=2>";
if ($row['p_filename'] && ereg("^img-",$row['p_filename'])) {
    $new_img_size = $img->get_img_size_format($row['width'], $row['height']);
    if (file_exists("./$GB_UPLOAD/t_$row[p_filename]")) {
        $row['p_filename'] = "t_$row[p_filename]";       
    }
    echo "<a href=\"javascript:gb_picture('$row[p_filename]',$row[width],$row[height])\"><img src=\"$GB_UPLOAD/$row[p_filename]\" align=\"left\" border=\"0\" $new_img_size[2]></a>";
}
echo "$comment</font>\n";
if ($tbl=="gb") {
    $this->db->query("select * from ".$this->table['com']." where id='$row[id]' order by com_id asc");
    while ($com = $this->db->fetch_array($this->db->result)) {
      $com["comments"] = nl2br($com["comments"]);
      echo "<table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n";
      echo "<tr><td colspan=2><hr size=\"1\"></td></tr>\n";
      echo "<tr><td valign=top><b><font size=\"1\" face=\"Arial, Helvetica, sans-serif\">".date("D, F j, Y H:i",$com['timestamp'])." Host: $com[host]</font></b></td>";
      echo "<td align=right><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"$this->SELF?action=del&amp;tbl=com&amp;id=$com[com_id]&amp;session=$this->session&amp;uid=$this->uid\">delete</a></font></td>";
      echo "<tr><td valign=top colspan=2><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">$com[name]:<br>\n";
      echo "$com[comments]</font></td></tr></table>";
    }
}
echo "   </td>
   <td width=\"10%\"><font size=1><b><a href=\"$this->SELF?action=edit&amp;tbl=$tbl&amp;id=$row[id]&amp;record=$id&amp;session=$this->session&amp;uid=$this->uid\">edit</a><br><br>
    <a href=\"$this->SELF?action=del&amp;tbl=$tbl&amp;id=$row[id]&amp;session=$this->session&amp;uid=$this->uid\">delete</a></b></font>
   </td>\n </tr>\n";
$id--;

}

?>
  </table>
  </form>

