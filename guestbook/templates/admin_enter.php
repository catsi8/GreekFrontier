<table border="0" cellspacing="0" cellpadding="2" align="center" width="$VARS[width]">
  <tr>
    <td height="45" width="55%"><b><font size="4" face="$VARS[font_face]" color="$VARS[text_color]">$LANG[FormSelect] - $LANG[BookMess5]</font></b></td>
    <td height="45" width="45%">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%" valign="bottom" class="font2">$LANG[FormEnter]</td>
    <td width="50%" align="right" valign="bottom" class="font2"> <b><img src="$GB_PG[base_url]/img/return.gif" width="10" height="10"> <a href="$GB_PG[index]">$LANG[BookMess4]</a>
     | <img src="$GB_PG[base_url]/img/sign.gif" width="9" height="12"> <a href="$GB_PG[addentry]">$LANG[BookMess3]</a></b></td>
  </tr>
</table>
<form method="post" action="$GB_PG[admin]">
  <table bgcolor="$VARS[tb_bg_color]" border="0" cellspacing="1" cellpadding="5" align="center" width="$VARS[width]">
    <tr bgcolor="$VARS[tb_hdr_color]">
      <td colspan="2"><font size="2" face="$VARS[font_face]" color="$VARS[tb_text]"><b>$message</b></font></td>
    </tr>
    <tr bgcolor="$VARS[tb_color_1]">
      <td width="30%" class="font1">$LANG[FormUser]:</td>
      <td width="70%"><input type="text" name="username" size="30"></td>
    </tr>
    <tr bgcolor="$VARS[tb_color_1]">
      <td width="30%" class="font1">$LANG[FormPass]:</td>
      <td width="70%"><input type="password" name="password" size="30">
        <input type="hidden" name="enter" value="1">
      </td>
    </tr>
    <tr bgcolor="$VARS[tb_color_1]">
      <td width="30%">&nbsp;</td>
      <td width="70%"><input type="submit" value="$LANG[FormSubmit]" class="input"></td>
    </tr>
  </table>
</form>

