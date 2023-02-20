<form method="post" action="$GB_PG[index]">
 <table border="0" cellspacing="0" cellpadding="2" align="center" width="$VARS[width]">
  <tr>
    <td width="56%"><img src="$GB_PG[base_url]/img/gbook.gif" width="140" height="15"></td>
    <td width="44%" align="right" class="font2"><img src="$GB_PG[base_url]/img/signing.gif" width="90" height="30" border="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
      <img src="$GB_PG[base_url]/img/sign.gif" width="9" height="12"> <a href="$GB_PG[addentry]"><b>$LANG[BookMess3]</b></a>
      <b>| <img src="$GB_PG[base_url]/img/lock.gif" width="9" height="11"> <a href="$GB_PG[admin]">$LANG[BookMess5]</a></b>
    </td>
   </tr>
   <tr>
     <td width="56%" class="font2">$TPL[GB_TIME]<br>$LANG[BookMess6]</td>
     <td width="44%" valign="bottom" align="right">

<!--Start JumpMenu -->

$TPL[GB_JUMPMENU]

<!--End JumpMenu -->

      </td>
    </tr>
  </table>
  
<!--Start Top Navigation -->

  <table width="$VARS[width]" border="0" cellspacing="0" cellpadding="2" align="center">
    <tr valign="bottom">
      <td class="font2"><img src="$GB_PG[base_url]/img/point3.gif" width="9" height="9">$LANG[NavTotal]
       <b><font color="#DD0000">$TPL[GB_TOTAL]</font></b>&nbsp;&nbsp;&nbsp;$LANG[NavRecords] <b><font color="#DD0000">$VARS[entries_per_page]</font></b></td>
      <td align="right" class="font2">&nbsp;$TPL[GB_NAVIGATION]
      </td>
   </tr>
  </table>

<!--End Top Navigation -->


  <table border="0" cellspacing="1" cellpadding="5" align="center" width="$VARS[width]" bgcolor="$VARS[tb_bg_color]">
    <tr bgcolor="$VARS[tb_hdr_color]">
      <td width="32%"><font size="2" face="$VARS[font_face]" color="$VARS[tb_text]"><b>$LANG[FormName]</b></font></td>
      <td width="68%"><font size="2" face="$VARS[font_face]" color="$VARS[tb_text]"><b>$LANG[BookMess7]</b></font></td>
    </tr>

<!--Start Guestbook Entries -->

$TPL[GB_ENTRIES]

<!--End Guestbook Entries -->

 </table>

<!--Start Bottom Navigation -->

 <table width="$VARS[width]" border="0" cellspacing="0" cellpadding="2" align="center">
  <tr valign="top">
   <td class="font2"><img src="$GB_PG[base_url]/img/point2.gif" width="9" height="9">$TPL[GB_HTML_CODE] </td>
   <td align="right" class="font2">&nbsp;$TPL[GB_NAVIGATION]</td>
  </tr>
 </table>
</form> 
<!--End Bottom Navigation -->


