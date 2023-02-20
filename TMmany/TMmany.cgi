#!/usr/bin/perl
########################################################
#版權宣告
#程式名稱：TMmany 線上傳訊
#程式版本：1.2.3
#程式作者：TurtleMan
#作者電郵：turtlemn@pchome.com.tw
#特別說明：
# 原始碼中域名轉換部分參考自 紅雪網頁 傅鴻明先生 所創作之「NSLOOKUP 1.00  網域名稱查詢程式」
# 另外cookie設定及表單資料處理參考自男丁格爾之「Male Nurse Guest」程式
#以上版權宣告，請勿刪除
################設定開始##################################
$datafile='many.txt';##紀錄資料的檔案位址
$cycle=10;##自動reload的週期(單位：秒)
$bgcolor='FFFFFF';##背景顏色
$cgiurl='TMmany.cgi';##主程式檔名
$usehtmlpass='~!12345!~';##(使用HTML的密碼)注意：必須為7個半形字元《置於兩個單引號中》發送訊息時加在字串最前面就可以使用html語法了
$listcolor='0080C0';##線上人數選單文字顏色
$listbgcolor='Ffffff';##線上人數選單背景顏色
$cmdlistcolor='F0F8FF';##系統命令選單文字顏色
$cmdlistbgcolor='0080C0';##系統命令選單背景顏色
$onlistcolor='0080C0';##線上人名選單文字顏色
$onlistbgcolor='F0F8FF';##線上人名選單背景顏色
$nickcount=12;##設定暱稱可輸入的最多字元數(全形字一字佔2字元)
################設定結束##################################
$version='1.2.3';
$now=time();
$ip=$ENV{'REMOTE_ADDR'};
$options="";
$found=0;
$count=0;
%FORM=&get_form;
#########################################################################
if($FORM{job} eq "setnick") { &setnick; }
elsif($FORM{job} eq "chgnick") { &chgnick; }
elsif($FORM{job} eq "wrtmsg") { &wrtmsg; }
elsif($FORM{job} eq "savemsg") { &savemsg; }
elsif($FORM{job} eq "show") { &show; }
elsif($FORM{job} eq "chgmsgonoff") { &chgmsgonoff; }
elsif($FORM{job} eq "readme") { &readme; }
else { &main; }
#########################################################################
sub main{
#########################################################################
open (FILE, $datafile);@DATAS=<FILE>;close (FILE);
open(FILE,">$datafile");
$mynick=$ip;
foreach $line (@DATAS)
{
 ($recip,$recadd,$recmsgonoff,$rectime,$recintime,$recnick,$recmsg)=split("∥",$line);
 chop $recmsg;
 if(($now-$rectime)<=($cycle+30))
 {
  if($ip eq $recip)
  {
   $message=$recmsg;
   $found=1;
   $count++;
   print FILE "$recip∥$recadd∥$recmsgonoff∥$now∥$recintime∥$recnick∥\n";
   $options=$options."<OPTION VALUE=1 STYLE=background-color:$onlistbgcolor\;color:$onlistcolor>★ ";
   if($recnick ne "")
   {
    $options=$options.$recnick."\n";
    $mynick=$recnick;
   }
   else
   {
    $options=$options.$ip."\n";
   }
  }
  ## $ip ne $recip
  else
  {
   print FILE "$recip∥$recadd∥$recmsgonoff∥$rectime∥$recintime∥$recnick∥$recmsg\n";
   if($recnick ne "")
   {
    $options=$options."<OPTION VALUE=$recip∥$recnick STYLE=background-color:$onlistbgcolor\;color:$onlistcolor> 　 ";
    $options=$options.$recnick."\n";
   }
   else
   {
    $options=$options."<OPTION VALUE=$recip∥ STYLE=background-color:$onlistbgcolor\;color:$onlistcolor> ";
    $options=$options.$recip."\n";
   }
   $count++;
  }
 }
}#End foreach
if(!$found)
{
 ($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst)=localtime(time);
 $mon++;
#------ip轉換
 $arg=$ip;
 if($arg =~ /^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/)
 {
  @bytes = split (/\./,$arg);
  $pack = pack("C4", @bytes);
 }
 else
 {
  ($pack) = (gethostbyname($arg))[4];
 }
 ($name, $aliases, $addrtype, $length, @addrs) = gethostbyaddr($pack, 2);
 if($name eq "")
 {
  $arg=$ip;
 }
 else
 {
  $arg=$name;
 }
#------
 &get_cookie;
 print FILE "$ip∥$arg∥on∥$now∥$mon/$mday $hour:$min:$sec∥$cookienick∥\n";
 $options=$options."<OPTION VALUE=1 STYLE=background-color:$onlistbgcolor\;color:$onlistcolor>☆ ";
 if($cookienick eq "")
 {
  $options=$options.$ip."\n";
 }
 else
 {
  $options=$options.$cookienick."\n";
 }
 $count++;
}
close(FILE);
#########################################################################
print "Content-type: text/html\n\n";
print "<HTML><HEAD><meta http-equiv=\"Content-Type\" content=\"text/html\; charset=big5\"><TITLE>TMmany</TITLE>\n";
print "<META HTTP-EQUIV=REFRESH CONTENT=\"$cycle;URL=$cgiurl\">\n";
print "<SCRIPT LANGUAGE=JavaScript>\n";
if($message ne "")
{
 print "message=window.open('','','menubar=no,status=no,toolbar=no,scrollbars=yes,width=300,height=300,left=300,top=200')\;\n";
 print "message.document.writeln('<HTML><HEAD><TITLE>收到訊息</TITLE></HEAD>')\;\n";
 print "message.document.writeln('<BODY BGCOLOR=$bgcolor STYLE=\"font-size:8pt\;font-family:新細明體,Arial\">')\;\n";
 print "message.document.writeln('<TABLE ALIGN=CENTER><TR><TD STYLE=position:relative\\;color:white\\;font-size:8pt\\;text-decoration:underline\\;letter-spacing:5px\\;filter:glow(color=red,strength=1)\\;>收到訊息</TD></TR></TABLE><BR>')\;\n";
 print "message.document.writeln('<CENTER><input type=button value=\"關閉視窗\" STYLE=font-size:8pt\;color:blue\; onclick=window.close()\;></CENTER><HR>')\;\n";
 print "message.document.writeln('$message')\;\n";
 print "message.document.writeln('<HR><CENTER><input type=button value=\"關閉視窗\" STYLE=font-size:8pt\;color:blue\; onclick=window.close()\;></CENTER>')\;\n";
 print "message.document.writeln('<DIV STYLE=color:blue\;font-size:8pt\;text-align:center\;padding-top:20px\;letter-spacing:2px>TMmany 線上傳訊 v $version<BR>重新排版：<a href=http://222721.24cc.com target=_blank>★~瀟灑居~★</a><FONT COLOR=FF0000 STYLE=font-size:8pt>★沈♂浩★~*</FONT></DIV></CENTER>')\;\n";
 print "message.document.writeln('</BODY></HTML>')\;\n";
}
print "function change(obj)\n";
print "{\n";
print " if(obj.options[obj.selectedIndex].value==0)\n";
print " {\n";
print "  location.replace(\'$cgiurl\')\;\n";
print " }\n";
print " else if(obj.options[obj.selectedIndex].value==1)\n";
print " {\n";
print "  obj.selectedIndex=0\;\n";
print "  window.open('$cgiurl?job=setnick','','menubar=no,status=no,toolbar=no,width=180,height=170,left=300,top=200')\;\n";
print " }\n";
print " else if(obj.options[obj.selectedIndex].value==2)\n";
print " {\n";
print "  obj.selectedIndex=0\;\n";
print "  window.open('$cgiurl?job=wrtmsg&sender=$mynick&towho=all∥大家','','menubar=no,status=no,toolbar=no,width=180,height=180,left=300,top=200')\;\n";
print " }\n";
print " else if(obj.options[obj.selectedIndex].value==3)\n";
print " {\n";
print "  obj.selectedIndex=0\;\n";
print "  window.open('$cgiurl?job=show','','menubar=no,scrollbars=yes,status=no,toolbar=no,width=400,height=300,left=200,top=150')\;\n";
print " }\n";
print " else if(obj.options[obj.selectedIndex].value==4)\n";
print " {\n";
print "  location.replace(\'$cgiurl?job=chgmsgonoff\')\;\n";
print " }\n";
print " else if(obj.options[obj.selectedIndex].value==5)\n";
print " {\n";
print "  obj.selectedIndex=0\;\n";
print "  window.open('$cgiurl?job=readme','','menubar=no,scrollbars=yes,status=no,toolbar=no,width=500,height=300,left=200,top=150')\;\n";
print " }\n";
print " else\n";
print " {\n";
print "  window.open('$cgiurl?job=wrtmsg&sender=$mynick&towho='+obj.options[obj.selectedIndex].value,'','menubar=no,status=no,toolbar=no,width=180,height=190,left=300,top=200')\;\n";
print "  obj.selectedIndex=0\;\n";
print " }\n";
print "}\n";
print "</SCRIPT>\n";
print "</HEAD>\n";
print "<BODY BGCOLOR=$bgcolor topmargin=\"0\" leftmargin=\"0\"><CENTER>\n";
print "<FORM>\n";
print "<SELECT ONCHANGE='change(this)\;'>\n";
print "<OPTION SELECTED STYLE=background-color:$listbgcolor\;color:$listcolor>在線人數： ".$count." </FONT>人\n";
print $options;
print "<OPTION VALUE=0 STYLE=background-color:$cmdlistbgcolor\;color:$cmdlistcolor>ˍˍˍˍˍˍˍˍ\n";
print "<OPTION VALUE=2 STYLE=background-color:$cmdlistbgcolor\;color:$cmdlistcolor>▼傳送廣播訊息▼\n";
print "<OPTION VALUE=3 STYLE=background-color:$cmdlistbgcolor\;color:$cmdlistcolor>◆詳細線上資料◆\n";
print "<OPTION VALUE=4 STYLE=background-color:$cmdlistbgcolor\;color:$cmdlistcolor>◆訊息接收開關◆\n";
print "<OPTION VALUE=5 STYLE=background-color:$cmdlistbgcolor\;color:$cmdlistcolor>◆使用說明範例◆\n";
print "<OPTION VALUE=0 STYLE=background-color:$cmdlistbgcolor\;color:$cmdlistcolor>▲最新人數狀況▲\n";
print "<OPTION VALUE=0 STYLE=background-color:$cmdlistbgcolor\;color:$cmdlistcolor>￣￣￣￣￣￣￣￣\n";
print "</SELECT>\n";
print "</FORM>\n";
#########################################################################
print "</CENTER></BODY></HTML>\n";
}#End of main
#########################################################################
sub setnick
{
 print "Content-type: text/html\n\n";
 print "<HTML><HEAD><meta http-equiv=\"Content-Type\" content=\"text/html\; charset=big5\"><TITLE>變更您的暱稱</TITLE></HEAD>\n";
 print "<SCRIPT LANGUAGE=JavaScript>\n";
 print "function lengthcheck()\n";
 print "{\n";
 print " var total=0\;\n";
 print " for(i=0\;i<my.nick.value.length\;i++)\n";
 print " {\n";
 print "  if(my.nick.value.charCodeAt(i)>200)\n";
 print "   total+=2\;\n";
 print "  else\n";
 print "   total++\;\n";
 print " }\n";
 print " if(total>$nickcount)\n";
 print " {\n";
 print "  alert(\'輸入字串過長，請重新輸入！\')\;\n";
 print "  my.reset()\;\n";
 print "  my.nick.focus()\;\n";
 print "  return false\;\n";
 print " }\n";
 print " else if(total == 0)\n";
 print " {\n";
 print "  alert(\'沒有輸入任何東西，請重新輸入！\')\;\n";
 print "  my.reset()\;\n";
 print "  my.nick.focus()\;\n";
 print "  return false\;\n";
 print " }\n";
 print " else\n";
 print "  return true\;\n";
 print "}\n";
 print "</SCRIPT>\n";
 print "<BODY BGCOLOR=$bgcolor ONLOAD=my.nick.focus()>\n";
 print "<FORM NAME=my ACTION=$cgiurl METHOD=post ONSUBMIT=return(lengthcheck())\;>\n";
 print "<TABLE ALIGN=CENTER CELLSPACING=3 STYLE=text-align:center\;font-size:8pt>\n";
 print "<TR><TD STYLE=position:relative\;color:white\;font-size:8pt\;text-decoration:underline\;letter-spacing:5px\;filter:glow(color=red,strength=1)\;>輸入暱稱</TD><TR>\n";
 print "<TR><TD><INPUT TYPE=text NAME=nick SIZE=10 MAXLENGTH=12 STYLE=font-size:8pt\;color:green\;border-width:3px\;border-style:double\;border-color:darkcyan></TD></TR>\n";
 print "<TR><TD><INPUT TYPE=submit VALUE=確定 STYLE=font-size:8pt\;color:brown\;background-color:powderblue\;border-width:1px\;border-style:solid\;border-color:darkcyan>\n";
 print "<INPUT TYPE=reset VALUE=清除 STYLE=font-size:8pt\;color:brown\;background-color:powderblue\;border-width:1px\;border-style:solid\;border-color:darkcyan></TD></TR>\n";
 print "</TABLE>\n";
 print "<INPUT TYPE=hidden NAME=job VALUE=chgnick>\n";
 print "</FORM>\n";
 print "<HR><CENTER><input type=button value=\"關閉視窗\" STYLE=font-size:8pt\;color:blue\; onclick=window.close()\;></CENTER>";
 print "</BODY></HTML>\n";
}
#########################################################################
sub chgnick
{
 $FORM{nick}=~s/∥/||/g;
 open (FILE, $datafile);@DATAS=<FILE>;close (FILE);
 open(FILE,">$datafile");
 foreach $line (@DATAS)
 {
  ($recip,$recadd,$recmsgonoff,$rectime,$recintime,$recnick,$recmsg)=split("∥",$line);
  chop $recmsg;
  if($ip eq $recip)
  {
   print FILE "$recip∥$recadd∥$recmsgonoff∥$rectime∥$recintime∥$FORM{nick}∥$recmsg\n";
  }
  else
  {
   print FILE "$recip∥$recadd∥$recmsgonoff∥$rectime∥$recintime∥$recnick∥$recmsg\n";
  }
 }
 close(FILE);
 &set_cookie;
 print "Content-type: text/html\n\n";
 print "<SCRIPT LANGUAGE=JavaScript>\n";
 print "window.close()\;\n";
 print "</SCRIPT>\n";
}
#########################################################################
sub wrtmsg
{
 @reciever=split(/∥/,$FORM{towho});
 print "Content-type: text/html\n\n";
 print "<HTML><HEAD><meta http-equiv=\"Content-Type\" content=\"text/html\; charset=big5\"><TITLE>傳送訊息</TITLE>\n";
 print "<SCRIPT LANGUAGE=JavaScript>\n";
 print "\n";
 print "function codecheck()\n";
 print "{\n";
 print " if(my.msg.value.length == 0)\n";
 print " {\n";
 print "  alert(\'沒有輸入任何東西，請重新輸入！\')\;\n";
 print "  my.msg.focus()\;\n";
 print "  return false\;\n";
 print " }\n";
 print " var result=1\;\n";
 print " var colors=0\;\n";
 print " var codes1=[\'~\!big\!~\',\'~\!/big\!~\',\'~\!small\!~\',\'~\!/small\!~\',\'~\!i\!~\',\'~\!/i\!~\',\'~\!b\!~\',\'~\!/b\!~\']\;\n";
 print " var codes2=[\'~\!red\!~\',\'~\!blue\!~\',\'~\!green\!~\',\'~\!purple\!~\',\'~\!dodgerblue\!~\',\'~\!deeppink\!~\',\'~\!lightgreen\!~\',\'~\!mediumpurple\!~\',\'~\!sienna\!~\',\'~\!olivedrab\!~\']\;\n";
 print " for(i=0\;i<codes1.length\;i+=2)\n";
 print " {\n";
 print "  if(codecount(codes1[i])!=codecount(codes1[i+1]))\n";
 print "   result=0\;\n";
 print " }\n";
 print " if(result)\n";
 print " {\n";
 print "  for(i=0\;i<codes2.length\;i++)\n";
 print "   colors+=codecount(codes2[i])\;\n";
 print "  if(colors!=codecount(\'~\!/color\!~\'))\n";
 print "   result=0\;\n";
 print " }\n";
 print " if(result)\n";
 print "  return true\;\n";
 print " else\n";
 print " {\n";
 print "  alert(\'　ＨＴＭＬ特殊字元檢查錯誤！\\n　﹋﹋﹋﹋﹋﹋﹋﹋﹋﹋﹋﹋﹋\\n┌──────────────┐\\n│【提示】所有的標籤都必須成對│\\n└──────────────┘\\n例如：\\n一個 ~\!b\!~ 就必須對應一個 ~\!/b\!~\')\;\n";
 print "  my.msg.focus()\;\n";
 print "  return false\;\n";
 print " }\n";
 print "}\n";
 print "function codecount(codestr)\n";
 print "{\n";
 print " var count=0\;\n";
 print " var index=0\;\n";
 print " while(my.msg.value.indexOf(codestr,index)!=-1)\n";
 print " {\n";
 print "  count++\;\n";
 print "  index=my.msg.value.indexOf(codestr,index)+1\;\n";
 print " }\n";
 print " return count\n";
 print "}\n";
 print "</SCRIPT>\n";
 print "</HEAD>\n";
 print "<BODY BGCOLOR=$bgcolor ONLOAD=my.msg.focus()>\n";
 print "<FORM NAME=my ACTION=$cgiurl METHOD=post ONSUBMIT=return(codecheck())\;>\n";
 print "<TABLE CELLSPACING=3 ALIGN=CENTER STYLE=text-align:center\;font-size:8pt>\n";
 print "<TR><TD STYLE=position:relative\;color:white\;font-size:8pt\;text-decoration:underline\;letter-spacing:5px\;filter:glow(color=red,strength=1)\;>傳送訊息</TD><TR>\n";
 print "<TR><TD>給：<FONT COLOR=coral>$reciever[1]【$reciever[0]】</FONT></TD></TR>\n";
 print "<TR><TD><INPUT TYPE=text NAME=msg SIZE=10 STYLE=font-size:8pt\;color:green\;border-width:3px\;border-style:double\;border-color:darkcyan></TD></TR>\n";
 print "<TR><TD><INPUT TYPE=submit VALUE=確定 STYLE=font-size:8pt\;color:brown\;background-color:powderblue\;border-width:1px\;border-style:solid\;border-color:darkcyan\;>\n";
 print "<INPUT TYPE=reset VALUE=清除 STYLE=font-size:8pt\;color:brown\;background-color:powderblue\;border-width:1px\;border-style:solid\;border-color:darkcyan></TD></TR>\n";
 print "</TABLE>\n";
 print "<INPUT TYPE=hidden NAME=job VALUE=savemsg>\n";
 print "<INPUT TYPE=hidden NAME=sender VALUE=\'$FORM{sender}【$ip】\'>\n";
 print "<INPUT TYPE=hidden NAME=reciever VALUE=\'$reciever[0]\'>\n";
 print "</FORM>\n";
 print "<HR><CENTER><input type=button value=\"關閉視窗\" STYLE=font-size:8pt\;color:blue\; onclick=window.close()\;></CENTER>";
 print "</BODY></HTML>\n";
}
#########################################################################
sub savemsg
{
 ($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst)=localtime(time);
 $mon++;
 ##-----過濾不合法字元
 if(substr($FORM{msg},0,7) ne $usehtmlpass)
 {
  $FORM{msg}=~s/</&lt\;/g;
  $FORM{msg}=~s/>/&gt\;/g;
 }
 else
 {
  $FORM{msg}=substr($FORM{msg},7);
 }
 $FORM{msg}=~s/∥/||/g;
 $FORM{msg}=~s/\'/\\\'/g;
 $FORM{msg}=~s/\"/\\\"/g;
 ##轉換特殊html語法
 $FORM{msg}=~s/~!red!~/<font color=red>/g;
 $FORM{msg}=~s/~!blue!~/<font color=blue>/g;
 $FORM{msg}=~s/~!green!~/<font color=green>/g;
 $FORM{msg}=~s/~!purple!~/<font color=purple>/g;
 $FORM{msg}=~s/~!dodgerblue!~/<font color=dodgerblue>/g;
 $FORM{msg}=~s/~!deeppink!~/<font color=deeppink>/g;
 $FORM{msg}=~s/~!lightgreen!~/<font color=lightgreen>/g;
 $FORM{msg}=~s/~!mediumpurple!~/<font color=mediumpurple>/g;
 $FORM{msg}=~s/~!sienna!~/<font color=sienna>/g;
 $FORM{msg}=~s/~!olivedrab!~/<font color=olivedrab>/g;
 $FORM{msg}=~s/~!big!~/<big>/g;
 $FORM{msg}=~s/~!small!~/<small>/g;
 $FORM{msg}=~s/~!i!~/<i>/g;
 $FORM{msg}=~s/~!b!~/<b>/g;
 $FORM{msg}=~s/~!\/color!~/<\/font>/g;
 $FORM{msg}=~s/~!\/big!~/<\/big>/g;
 $FORM{msg}=~s/~!\/small!~/<\/small>/g;
 $FORM{msg}=~s/~!\/i!~/<\/i>/g;
 $FORM{msg}=~s/~!\/b!~/<\/b>/g;
 ##-----
 open (FILE, $datafile);@DATAS=<FILE>;close (FILE);
 open(FILE,">$datafile");
 foreach $line (@DATAS)
 {
  ($recip,$recadd,$recmsgonoff,$rectime,$recintime,$recnick,$recmsg)=split("∥",$line);
  chop $recmsg;
  $newmsg="";
  if(($FORM{reciever} eq "all") and ($ip ne $recip) and ($recmsgonoff eq "on"))
  {
   $found=1;
   if($recmsg ne "")
   {
    $newmsg=$recmsg."<HR>";
   }
   $newmsg=$newmsg."<FONT COLOR=blueviolet>".$FORM{sender}."</FONT> 的<SPAN STYLE=text-decoration:underline>訊息廣播</SPAN>：<BR>".$FORM{msg}."<BR><DIV STYLE=text-align:right\;color:gray\;font-size:8pt>\&lt\; ".$mon."/".$mday." ".$hour.":".$min.":".$sec." \&gt\;</DIV>";
   print FILE "$recip∥$recadd∥$recmsgonoff∥$rectime∥$recintime∥$recnick∥$newmsg\n";
  }
  elsif(($FORM{reciever} eq $recip) and ($recmsgonoff eq "on"))
  {
   $found=1;
   if($recmsg ne "")
   {
    $newmsg=$recmsg."<HR>";
   }
   $newmsg=$newmsg."收到來自 <FONT COLOR=9966ff>".$FORM{sender}."</FONT> 的<SPAN STYLE=text-decoration:underline>訊息</SPAN>：<BR>".$FORM{msg}."<BR><DIV STYLE=text-align:right\;color:gray\;font-size:8pt>\&lt\; ".$mon."/".$mday." ".$hour.":".$min.":".$sec." \&gt\;</DIV>";
   print FILE "$recip∥$recadd∥$recmsgonoff∥$rectime∥$recintime∥$recnick∥$newmsg\n";
  }
  else
  {
   print FILE "$recip∥$recadd∥$recmsgonoff∥$rectime∥$recintime∥$recnick∥$recmsg\n";
  }
 }
 close(FILE);
 print "Content-type: text/html\n\n";
 if($found eq 1){print "<SCRIPT LANGUAGE=JavaScript>\nwindow.close()\;\n</SCRIPT>\n";}
 else
 {
  print "<HTML><HEAD><meta http-equiv=\"Content-Type\" content=\"text/html\; charset=big5\"><TITLE>傳送訊息發生錯誤</TITLE></HEAD>\n";
  print "<BODY BGCOLOR=$bgcolor><CENTER>\n";
  print "<TABLE><TR><TD STYLE=position:relative\;color:white\;font-size:8pt\;text-decoration:underline\;letter-spacing:5px\;filter:glow(color=red,strength=1)\;>錯誤訊息</TD></TR></TABLE><BR>\n";
  print "<DIV STYLE=font-size:8pt\;color:darkred\;text-align:left>傳送訊息時發生錯誤！<BR>錯誤發生原因可能為：<BR>●收訊者的收訊開關為『關』<BR>●收訊者已經不在站上<BR>●若為訊息廣播則表示其他人<BR>的收訊開關皆為『關』</DIV>\n";
  print "<HR><CENTER><input type=button value=\"關閉視窗\" STYLE=font-size:8pt\;color:blue\; onclick=window.close()\;>";
  print "</CENTER></BODY></HTML>\n";
 }
}
#########################################################################
sub chgmsgonoff
{
 open (FILE, $datafile);@DATAS=<FILE>;close (FILE);
 open(FILE,">$datafile");
 foreach $line (@DATAS)
 {
  ($recip,$recadd,$recmsgonoff,$rectime,$recintime,$recnick,$recmsg)=split("∥",$line);
  chop $recmsg;
  if($ip eq $recip)
  {
   if($recmsgonoff eq "on"){print FILE "$recip∥$recadd∥off∥$rectime∥$recintime∥$recnick∥$recmsg\n";}
   else{print FILE "$recip∥$recadd∥on∥$rectime∥$recintime∥$recnick∥$recmsg\n";}
  }
  else
  {
   print FILE "$recip∥$recadd∥$recmsgonoff∥$rectime∥$recintime∥$recnick∥$recmsg\n";
  }
 }
 close(FILE);
 &main;
}
#########################################################################
sub show
{
 open (FILE, $datafile);@DATAS=<FILE>;close (FILE);
 print "Content-type: text/html\n\n";
 print "<HTML><HEAD><meta http-equiv=\"Content-Type\" content=\"text/html\; charset=big5\"><TITLE>詳細資料</TITLE></HEAD>\n";
 print "<BODY BGCOLOR=$bgcolor><CENTER>\n";
 print "<TABLE><TR><TD STYLE=position:relative\;color:white\;font-size:8pt\;text-decoration:underline\;letter-spacing:5px\;filter:glow(color=red,strength=1)\;>詳細資料</TD></TR></TABLE><BR>\n";
 print "<input type=button value=\"關閉視窗\" STYLE=font-size:8pt\;color:blue\; onclick=window.close()\;><HR>";
 print "<TABLE BORDER=1 STYLE=font-size:8pt\;text-align:center><TR><TD>暱稱<BR>【IP/主機名稱】</TD><TD>上站時間</TD><TD>收發訊息<BR>狀態</TD><TD>有無訊息</TD></TR>\n";
 foreach $line (@DATAS)
 {
  ($recip,$recadd,$recmsgonoff,$rectime,$recintime,$recnick,$recmsg)=split("∥",$line);
  chop $recmsg;
  print "<TR><TD><FONT COLOR=darkcyan>$recnick</FONT><BR><FONT COLOR=darkseagreen>【$recip/$recadd】</FONT></TD><TD>$recintime</TD>";
  if($recmsgonoff eq "on")
  {
   print "<TD><FONT COLOR=red>開</FONT></TD>";
  }
  else
  {
   print "<TD>關</TD>";
  }
  if($recmsg eq "")
  {
   print "<TD>無</TD></TR>\n";
  }
  else
  {
   print "<TD><FONT COLOR=red>有</FONT></TD></TR>\n";
  }
 }
 print "\n";
 print "</TABLE>\n";
 print "<HR><input type=button value=\"關閉視窗\" STYLE=font-size:8pt\;color:blue\; onclick=window.close()\;></CENTER>";
 print "</CENTER></BODY></HTML>\n";
}
#########################################################################
sub readme
{
 print "Content-type: text/html\n\n";
print <<HTML;
 <HTML><HEAD><meta http-equiv="Content-Type" content="text/html; charset=big5"><TITLE>TMmany 線上傳訊 v 1.2.3</TITLE>
<STYLE TYPE="text/css">
.maintab {background-color:peachpuff;border-color:lightcoral;border-width:4px;border-style:double;font-size:8pt;text-align:center}
.maintab td {background-color:lightgoldenrodyellow;border-color:lightpink;border-width:1px;border-style:solid;line-height:18px}
.maintab table td {font-size:8pt;text-align:center;border-width:0px;line-height:15px}
</STYLE>
</HEAD>
<BODY BGCOLOR=F0FFF0><CENTER>
<TABLE><TR><TD STYLE=position:relative;color:white;font-size:8pt;text-decoration:underline;letter-spacing:5px;filter:glow(color=red,strength=1);>說明檔案</TD></TR></TABLE><BR>
<input type=button value="關閉視窗" STYLE=font-size:8pt;color:blue; onclick=window.close();><HR>
<TABLE CLASS=maintab CELLSPACING=1 CELLPADDING=2>
<TR HEIGHT=50><TH COLSPAN=2 STYLE=position:relative;color:bisque;font-size:8pt;text-decoration:underline;letter-spacing:5px;filter:glow(color=blue,strength=1);>TMmany 線上傳訊 v 1.2.3</TD></TR>
<TR><TD STYLE=background-color:paleturquoise;color:teal>程式作者</TD><TD STYLE=background-color:paleturquoise;color:teal><a href=mailto:turtlemn\@pchome.com.tw>TurtleMan</a></TD></TR>
<TR><TD COLSPAN=2><FONT COLOR=GREEN>★　程式說明　★</FONT></TD></TR>
<TR><TD COLSPAN=2 ALIGN=LEFT>
<FONT COLOR=navy>§線上人數計數</FONT><BR>
　<FONT COLOR=royalblue>除了傳統的顯示目前線上的人數之外，還可以查詢線上個人的詳細資料，<BR>
　包含暱稱、IP、主機名稱、上站時間、收訊狀態以及訊息開關。</FONT><BR>
　<FONT COLOR=orchid>●暱稱：</FONT><BR>
　<FONT COLOR=orangered>→</FONT>使用 Cookie 每次更改暱稱時將值寫入，每次上站即自動由 Cookie 中讀<BR>
　　取上次設定的暱稱，可以不用每次上站重新填寫。<BR>
　<FONT COLOR=orangered>→</FONT>暱稱的設定長度最長為７個中文字〈全形字〉或１４個英數字〈半形字〉<BR>
　　，可以參雜使用。<BR>
<FONT COLOR=navy>§線上傳送訊息</FONT><BR>
　<FONT COLOR=royalblue>可以選擇對單人發送訊息或以訊息廣播的形式對多人同時發送訊息</FONT><BR>
　<FONT COLOR=orchid>●單人傳訊：</FONT><BR>
　<FONT COLOR=orangered>→</FONT>直接在下拉選單中點選要發送的對象就會出現填寫訊息的視窗，填寫完<BR>
　　成後送出即完成發訊動作。<BR>
　<FONT COLOR=orangered>→</FONT>為了避免有人『故意』在訊息中加入破壞語法，因此訊息中所有的HTML<BR>
　　標籤都會無法顯示；但是你還是可以改用下面的HTML替代語法來使用簡<BR>
　　單的語法。<BR>
　<FONT COLOR=orchid>●訊息廣播：</FONT><BR>
　<FONT COLOR=orangered>→</FONT>在下拉選單中點選訊息廣播選項就會出現填寫訊息的視窗，填寫完成後<BR>
　　送出即完成廣播動作。<BR>
　<FONT COLOR=orangered>→</FONT>訊息廣播的收訊對象為：除了你以外所有收訊開關為『開』的線上人員<BR>
　<FONT COLOR=orangered>→</FONT>為了避免有人『故意』在訊息中加入破壞語法，因此訊息中所有的HTML<BR>
　　標籤都會無法顯示；但是你還是可以改用下面的HTML替代語法來使用簡<BR>
　　單的語法。<BR>
</TD></TR>
<TR><TD COLSPAN=2><FONT COLOR=GREEN>★　替代語法　★</FONT></TD></TR>
<TR><TD COLSPAN=2>
<FONT COLOR=RED>※</FONT><FONT COLOR=crimson>所有標籤的作用範圍就在起始標籤及結尾標籤中<BR>
　因此所有的標籤都必須成對出現！</FONT>
  <TABLE WIDTH=90%>
  <TR><TD>起始標籤</TD><TD>結尾標籤</TD><TD>說明</TD></TR>
  <TR><TD>~!red!~</TD><TD>~!/color!~</TD><TD>設定字體為<FONT COLOR=red>■</FONT>色</TD></TR>
  <TR><TD>~!blue!~</TD><TD>~!/color!~</TD><TD>設定字體為<FONT COLOR=blue>■</FONT>色</TD></TR>
  <TR><TD>~!green!~</TD><TD>~!/color!~</TD><TD>設定字體為<FONT COLOR=green>■</FONT>色</TD></TR>
  <TR><TD>~!purple!~</TD><TD>~!/color!~</TD><TD>設定字體為<FONT COLOR=purple>■</FONT>色</TD></TR>
  <TR><TD>~!dodgerblue!~</TD><TD>~!/color!~</TD><TD>設定字體為<FONT COLOR=dodgerblue>■</FONT>色</TD></TR>
  <TR><TD>~!deeppink!~</TD><TD>~!/color!~</TD><TD>設定字體為<FONT COLOR=deeppink>■</FONT>色</TD></TR>
  <TR><TD>~!lightgreen!~</TD><TD>~!/color!~</TD><TD>設定字體為<FONT COLOR=lightgreen>■</FONT>色</TD></TR>
  <TR><TD>~!mediumpurple!~</TD><TD>~!/color!~</TD><TD>設定字體為<FONT COLOR=mediumpurple>■</FONT>色</TD></TR>
  <TR><TD>~!olivedrab!~</TD><TD>~!/color!~</TD><TD>設定字體為<FONT COLOR=olivedrab>■</FONT>色</TD></TR>
  <TR><TD>~!sienna!~</TD><TD>~!/color!~</TD><TD>設定字體為<FONT COLOR=sienna>■</FONT>色</TD></TR>
  <TR><TD>~!big!~</TD><TD>~!/big!~</TD><TD>放大字體</TD></TR>
  <TR><TD>~!small!~</TD><TD>~!/small!~</TD><TD>縮小字體</TD></TR>
  <TR><TD>~!i!~</TD><TD>~!/i!~</TD><TD>斜體字</TD></TR>
  <TR><TD>~!b!~</TD><TD>~!/b!~</TD><TD>粗體字</TD></TR>
  </TABLE><BR>
【範例-輸入】
<DIV STYLE=font-size:8pt;color:black;text-align:left;width:80%>這~!red!~~!big!~是~!/big!~~!i!~一個~!/i!~<BR>~!/color!~簡~!green!~單~!deeppink!~的~!/color!~範~!/color!~例！</DIV>
【顯示的效果】
<DIV STYLE=font-size:8pt;color:black;text-align:left;width:80%>這<FONT COLOR=red><BIG>是</BIG><I>一個</I></FONT>簡<FONT COLOR=green>單<FONT COLOR=deeppink>的</FONT>範</FONT>例！</DIV>
</TD></TR>
</TABLE>
<HR><input type=button value="關閉視窗" STYLE=font-size:8pt;color:blue; onclick=window.close();>
</CENTER></BODY></HTML>
HTML
}
#########################################################################
sub get_form
{
 my (@pairs,@querys,%in);
 my ($buffer, $pair, $name, $value);
 @querys = split(/&/, $ENV{'QUERY_STRING'});
 foreach (@querys)
 {
  ($name,$value) = split(/=/, $_);
  $name  = &decode($name);
  $value = &decode($value);
  %in=&setvaluetoform($name, $value); 
 }
 read(STDIN, $buffer, $ENV{'CONTENT_LENGTH'});
 @pairs = split(/&/, $buffer);
 foreach (@pairs)
 {
  ($name, $value) = split(/=/, $_);
  push (@make, $value) if ($name eq "mark");
  $name  = &decode($name);
  $value = &decode($value);
  %in=&setvaluetoform($name, $value); 
 }
 return %in;
}
#########################################################################
sub decode
{
 local($return)=$_[0];
 $return =~ tr/+/ /;
 $return =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
 return $return;
}
#########################################################################
sub setvaluetoform
{
 if ($FORM{$_[0]})
 {
  $FORM{$_[0]}="$FORM{$_[0]}§$_[1]";
 }
 else
 {
  $FORM{$_[0]}=$_[1];
 }
 return %FORM;
}
#########################################################################
sub set_cookie {
($secg,$ming,$hourg,$mdayg,$mong,$yearg,$wdayg,$ydayg,$isdstg)= gmtime(time + 60*24*60*60);

$yearg += 1900;
if ($secg < 10) { $secg = "0$secg"; }
if ($ming < 10) { $ming = "0$ming"; }
if ($hourg < 10) { $hourg = "0$hourg"; }
if ($mdayg < 10) { $mdayg = "0$mdayg"; }

$month = ('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec')[$mong];
$youbi = ('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday')[$wdayg];
$date_gmt = "$youbi, $mdayg\-$month\-$yearg $hourg:$ming:$secg GMT";
$cook="nick∥$FORM{nick}\,email∥emailemail";
print "Set-Cookie: TMmany=$cook; expires=$date_gmt\n";
}
#########################################################################
sub get_cookie { 
@pairs = split(/\;/, $ENV{'HTTP_COOKIE'});
foreach $pair (@pairs) {
local($name, $value) = split(/\=/, $pair);
$name =~ s/ //g;
$DUMMY{$name} = $value;
}
@pairs = split(/\,/, $DUMMY{'TMmany'});
foreach $pair (@pairs) {
local($name, $value) = split(/\∥/, $pair);
$COOKIE{$name} = $value;
}
	$cookienick  = $COOKIE{'nick'};
}
