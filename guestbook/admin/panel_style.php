<html>
<head>
<title>Guestbook - Style</title>
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
<font size="2" face="Verdana, Arial" color="#FFFFFF"><b>S T Y L E&nbsp;&nbsp;&nbsp;&nbsp;S E T T I N G S</b></font><br><br>
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
  <table border=0 width=100% bgcolor="#000000">
    <tr bgcolor="#000000"> 
      <td colspan=3 align=center height="25"><b><font size="2" face="Verdana, Arial" color="#FFFF00">Style 
        Settings</font></b></td>
    </tr>
    <tr bgcolor="#FCF0C0"> 
      <td colspan=3><font size="1" face="Verdana, Arial"><b>Please complete the 
        following fields, which provide information such as your guestbook's table 
        width, the color of the table and the font face and font size.</b></font> 
      </td>
    </tr>
    <tr bgcolor="#dedfdf"> 
      <td width=50%> <b><font size="2" face="Verdana, Arial">Page Background Color</font></b><br>
        <font size="1" face="Verdana, Arial">Format - #FFFFFF</font> </td>
      <td width=50% valign=top> 
        <input type="text" name="pbgcolor" value="<?php echo $this->VARS["pbgcolor"]; ?>" size=10 maxlength=7>
      </td>
      <td width=50%>
        <table width="70" border="1" cellspacing="0" cellpadding="1" bgcolor="<?php echo $this->VARS["pbgcolor"]; ?>" bordercolor="#000000">
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr bgcolor="#f7f7f7"> 
      <td width=50%> <b><font size="2" face="Verdana, Arial">Table Width</font></b><br>
        <font size="1" face="Verdana, Arial">You may use either exact pixels (recommended: 
        600) or a percentage (recommended: 95%)</font> </td>
      <td width=50% valign=top> 
        <input type="text" name="width" value="<?php echo $this->VARS["width"]; ?>" size=10 maxlength=6>
      </td>
      <td width=50% valign=top>&nbsp;</td>
    </tr>
    <tr bgcolor="#dedfdf"> 
      <td width=50%> <b><font size="2" face="Verdana, Arial">Font Face (e.g., 
        Verdana)</font><br>
        </b><font size="1" face="Verdana, Arial">You may use a backup font as 
        well. For example: to use Verdana as your first choice, with Arial as 
        a conditional font for those users that don't have Verdana as a font on 
        their system, you would type "Verdana, Arial") </font> </td>
      <td width=50% valign=top> 
        <input type="text" name="font_face" value="<?php echo $this->VARS["font_face"]; ?>" size=38 maxlength=70>
      </td>
      <td width=50% class="font">Font</td>
    </tr>
    <tr bgcolor="#f7f7f7"> 
      <td width=50%> <b><font size="2" face="Verdana, Arial">Link Color</font></b><br>
        <font size="1" face="Verdana, Arial">Guestbook link color. Format - #FFFFFF</font> 
      </td>
      <td width=50% valign=top> 
        <input type="text" name="link_color" value="<?php echo $this->VARS["link_color"]; ?>" size=10 maxlength=7>
      </td>
      <td width=50%> 
        <table width="70" border="1" cellspacing="0" cellpadding="1" bgcolor="<?php echo $this->VARS["link_color"]; ?>" bordercolor="#000000">
          <tr> 
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr bgcolor="#dedfdf"> 
      <td width=50%> <b><font size="2" face="Verdana, Arial">Text Color</font></b><br>
        <font size="1" face="Verdana, Arial">Guestbook text color. Format - #FFFFFF</font> 
      </td>
      <td width=50% valign=top> 
        <input type="text" name="text_color" value="<?php echo $this->VARS["text_color"]; ?>" size=10 maxlength=7>
      </td>
      <td width=50%> 
        <table width="70" border="1" cellspacing="0" cellpadding="1" bgcolor="<?php echo $this->VARS["text_color"]; ?>" bordercolor="#000000">
          <tr> 
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr bgcolor="#f7f7f7"> 
      <td width=50%> <b><font size="2" face="Verdana, Arial">Text Size 1</font></b><br>
        <font size="1" face="Verdana, Arial">The text font size.</font> </td>
      <td width=50% valign=top> 
        <input type="text" name="tb_font_1" value="<?php echo $this->VARS["tb_font_1"]; ?>" size=6 maxlength=6>
      </td>
      <td width=50% class="text_size1">Text Size 1</td>
    </tr>
    <tr bgcolor="#dedfdf"> 
      <td width=50%> <b><font size="2" face="Verdana, Arial">Text Size 2</font></b><br>
        <font size="1" face="Verdana, Arial">A smaller value is recommend here 
        ... but depending on your font face, you may want to alter this.</font> 
      </td>
      <td width=50% valign=top> 
        <input type="text" name="tb_font_2" value="<?php echo $this->VARS["tb_font_2"]; ?>"size=6 maxlength=6>
      </td>
      <td width=50% class="text_size2">Text Size 2</td>
    </tr>
    <tr bgcolor="#f7f7f7"> 
      <td width=50% valign=top> <font size="2" face="Verdana, Arial"><b>Table 
        Header Background Color</b></font><br>
        <font size="1" face="Verdana, Arial">Format - #FFFFFF</font></td>
      <td width=50% valign=top> 
        <input type="text" name="tb_hdr_color" value="<?php echo $this->VARS["tb_hdr_color"]; ?>" size="10" maxlength=7>
      </td>
      <td width=50%> 
        <table width="70" border="1" cellspacing="0" cellpadding="1" bgcolor="<?php echo $this->VARS["tb_hdr_color"]; ?>" bordercolor="#000000">
          <tr> 
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr bgcolor="#dedfdf"> 
      <td width=50% valign=top> <font size="2" face="Verdana, Arial"><b>Table 
        Background Color</b></font><br>
        <font size="1" face="Verdana, Arial">Format - #FFFFFF</font></td>
      <td width=50% valign=top> 
        <input type="text" name="tb_bg_color" value="<?php echo $this->VARS["tb_bg_color"]; ?>" size="10" maxlength=7>
      </td>
      <td width=50%> 
        <table width="70" border="1" cellspacing="0" cellpadding="1" bgcolor="<?php echo $this->VARS["tb_bg_color"]; ?>" bordercolor="#000000">
          <tr> 
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr bgcolor="#f7f7f7"> 
      <td width=50% valign=top> <font size="2" face="Verdana, Arial"><b>Table 
        Header Strip Text Color</b></font><br>
        <font size="1" face="Verdana, Arial">Format - #FFFFFF</font></td>
      <td width=50% valign=top> 
        <input type="text" name="tb_text" value="<?php echo $this->VARS["tb_text"]; ?>" size="10" maxlength=7>
      </td>
      <td width=50%> 
        <table width="70" border="1" cellspacing="0" cellpadding="1" bgcolor="<?php echo $this->VARS["tb_text"]; ?>" bordercolor="#000000">
          <tr> 
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr bgcolor="#dedfdf"> 
      <td width=50% valign=top> <b><font size="2" face="Verdana, Arial">First 
        Alternating Table Column Color</font></b><br>
        <font size="1" face="Verdana, Arial">Format - #FFFFFF</font></td>
      <td width=50% valign=top> 
        <input type="text" name="tb_color_1" value="<?php echo $this->VARS["tb_color_1"]; ?>" size=10 maxlength=7>
      </td>
      <td width=50%> 
        <table width="70" border="1" cellspacing="0" cellpadding="1" bgcolor="<?php echo $this->VARS["tb_color_1"]; ?>" bordercolor="#000000">
          <tr> 
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr bgcolor="#f7f7f7"> 
      <td width=50%> <b><font size="2" face="Verdana, Arial">Second Alternating 
        Table Column Color</font></b><br>
        <font size="1" face="Verdana, Arial">Format - #FFFFFF</font></td>
      <td width=50% valign=top> 
        <input type="text" name="tb_color_2" value="<?php echo $this->VARS["tb_color_2"]; ?>" size=10 maxlength=7>
      </td>
      <td width=50%> 
        <table width="70" border="1" cellspacing="0" cellpadding="1" bgcolor="<?php echo $this->VARS["tb_color_2"]; ?>" bordercolor="#000000">
          <tr> 
            <td>&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
<table border=0 width=100% bgcolor="#000000">
  <tr bgcolor="#000000">
    <td colspan=2 align=center height="25"><b><font size="2" face="Verdana, Arial" color="#FFFF00">Date/Time
      Display Options</font></b></td>
  </tr>
  <tr bgcolor="#FCF0C0">
    <td colspan=2><font size="1" face="Verdana, Arial">
      <b>This Guestbook can display dates and times in a number of different
        formats. Remember that the times listed are based on the location of
        your web server, which may be different than the time zone where you
        reside/work. You can change the time zone displayed by using the Time
        Zone Offset field. For instance, if you are on the East Coast of the
        US, but your server is on the West Coast of the US, you would have to
        offset the server time to reflect that (by typing a 3 in the Time Zone
        Offset field, reflecting the 3 hours difference). If the Time Zone
        difference is negative, use negative number (as in -2).</b>
      </font></td>
  </tr>
  <tr bgcolor="#f7f7f7">
    <td width=50%>
      <b><font size="2" face="Verdana, Arial">Server Time Zone Offset</font></b><font size="1" face="Verdana, Arial"><br>
        You can offset the time drawn from your web server. For instance,
        if your server time is EST (US), but you want all time to reflect Pacific
        Time (US), you would have to offset your server time by placing the
        time zone difference in this field (for this example, that would be
        -3. You would place -3 in this field). The default is for there to be
        no server time zone offset (0).</font>
    </td>
    <td width=50% valign=top><input type="text" name="offset" value="<?php echo $this->VARS["offset"]; ?>" size=3 maxlength=4></td>
  </tr>
  <tr bgcolor="#dedfdf">
    <td width=50%> <b><font size="2" face="Verdana, Arial">Date Format</font></b> <font size="1" face="Verdana, Arial"><br>
      European Format is DD-MM-YR, while US format is MM-DD-YR. Expanded formats
      include full month name.</font></td>
    <td width=50% valign=top> <font size="2" face="Verdana, Arial">
      <input type="RADIO" name="dformat" value="USx" <?php if ($this->VARS["dformat"] == "USx") {echo "checked";}?>>
      US Format (04-17-2000)<br>
      <input type="RADIO" name="dformat" value="US" <?php if ($this->VARS["dformat"] == "US") {echo "checked";}?>>
      Exp. US Format (Monday, April 25, 2000)<br>
      <input type="RADIO" name="dformat" value="Eurox" <?php if ($this->VARS["dformat"] == "Eurox") {echo "checked";}?>>
      European Format (17.04.2000)<br>
      <input type="RADIO" name="dformat" value="Euro" <?php if ($this->VARS["dformat"] == "Euro") {echo "checked";}?>>
      Exp. European Format (Monday, 25 April 2000) </font></td>
  </tr>
  <tr bgcolor="#f7f7f7">
    <td width=50%> <b><font size="2" face="Verdana, Arial">Time Format</font></b> <font size="1" face="Verdana, Arial"><br>
      You can have time displayed in AM/PM format, or in 24-hour format.</font></td>
    <td width=50% valign=top> <font size="2" face="Verdana, Arial">
      <input type="RADIO" name="tformat" value="AMPM" <?php if ($this->VARS["tformat"] == "AMPM") {echo "checked";}?>>
      Use AM/PM Time Format<br>
      <input type="RADIO" name="tformat" value="24hr" <?php if ($this->VARS["tformat"] == "24hr") {echo "checked";}?>>
      User 24-Hour Format Time (eg, 23:15) </font></td>
  </tr>
</table>
 <br>
  <center>
    <input type="submit" value="Submit Settings">
    <input type="reset" value="Reset">
    <input type="hidden" value="<?php echo $this->uid; ?>" name="uid">
    <input type="hidden" value="<?php echo $this->session; ?>" name="session">
    <input type="hidden" value="save" name="action">
    <input type="hidden" value="style" name="panel">
  </center>
</form>

