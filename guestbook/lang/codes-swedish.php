<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//SWE">
<HTML>
<HEAD>
<TITLE>Smilies And AGCodes</TITLE>
<META content="text/html; charset=windows-1252" http-equiv="Content-Type">
<style type="text/css">
<!--
td {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt}
-->
</style>
</HEAD>
<BODY bgColor=#ffffff link=#000080 text=#000000 vLink=#000080>
<CENTER>
  <table width="95%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td height="25"> W H A T &nbsp;&nbsp;&nbsp;A R E&nbsp;&nbsp;&nbsp;S M I L I E S ?</td>
    </tr>
    <tr>
      <td>
        <p>'Smilies' 酺 sm?bilder du kan anv鄚da f顤 att visa k鄚slor. Om du vrider huvudet
	i sida s?kan du vanligen se vad de f顤est鄟ler.</p>
        <p> H酺 酺 en lista p?allm鄚nt accepterade smilies: </p>
      </td>
    </tr>
  </table>
  <table bgcolor=#f7f7f7 border=0 width="95%" cellspacing="1" cellpadding="4">
    <tbody>
    <tr>
      <td bgcolor="#996699"><font color=#ffffff><b>S?h酺 skrivs det</b></font></td>
      <td bgcolor="#996699"><font color=#ffffff><b>K鄚sla</b></font></td>
      <td bgcolor="#996699"><font color=#ffffff><b>Vad som visar sig grafiskt.</b></font></td>
    </tr>

<?php include ("./smilies.inc"); ?>

    </tbody>
  </table>
  <br>
  <table width="95%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td height="25">V A D &nbsp;&nbsp;&nbsp;?R &nbsp;&nbsp;&nbsp;A V A
        N C E R A D &nbsp;&nbsp;&nbsp;G ?S T B  O K &nbsp;&nbsp;&nbsp;C O D E ? </td>
    </tr>
    <tr>
      <td>
        <p>AGCode 酺 en variation p?vanlig enkel HTML kod. Man anv鄚der dessa koder
	f顤 att formatera sitt meddelande. Du kan anv鄚da AGCode 銥en om
          HTML inte f緳 anv鄚das i g酲tboken. Du kan ocks?v鄟ja att anv鄚da AGCode ist鄟let
	f顤 HTML, den inneh嶚ler f酺re kommando att h嶚la reda p?och 酺 s鄢rare.
        <p>Vanliga AGCodes:
      </td>
    </tr>
  </table>
<TABLE border=0 cellPadding=0 cellSpacing=0 width="95%" align="center">
  <TBODY>
  <TR>
    <TD bgColor=#000000>
      <TABLE border=0 cellPadding=4 cellSpacing=1 width="100%">
        <TBODY>
        <TR bgColor=#0099CC>
          <TD><b><font color="#FFFFFF">URL Hyperlinking</font></b></TD>
        </TR>
        <TR bgColor=#ffffff>
          <TD>Om AGCode 酺 till廞en s?beh饘er du inte l鄚gre anv鄚da 
            [URL] code f顤 att skapa en l鄚k. Bara skriv in hela URL:en p?n嶓ot av
		f闤jande s酹t s?kommer l鄚ken att skapas automatiskt.:
            <UL>
              <LI><font color="#800000">http://www.yourURL.com </font>
              <LI><FONT color=#800000>www.yourURL.com </FONT>Notera att du antingen kan
                anv鄚da den kompletta http:// address eller den kortare varianten www
                domain. Om hemsida inte b顤jar med "www", s?m廛te du anv鄚da den l鄚gre varianten.
		 Du kan ocks?anv鄚da https och ftp URL
                prefix i auto-link l輍e (n酺 AGCode is p?. <BR>
                <BR>
              <LI>Du kan ocks?ha 鄢ta [url] l鄚kar genom att skriva code. Andv鄚d
		bara f闤jande format: <br><br>
                <CENTER>
                  <FONT color=#ff0000>[url=http://www.proxy2.de]</FONT>hyperlink<FONT color=#ff0000>[/url]</FONT>
                </CENTER><br><br>
              <LI>
                <P>Den gamla [URL] coden kommer fortfarande att fungera, som beskrivs nedan. Men 
                  utifall l鄚ken visas som i exemplet(AGCode 酺
                  i <FONT color=#ff0000>r飆t</FONT>).
                <P>
                  <CENTER>
                    <FONT color=#ff0000>[url]</FONT>http://www.proxy2.de<FONT color=#ff0000>[/url]</FONT>
                  </CENTER>
                <P>I exemplet ovan, kommer AGCoden automatiskt att generera
                  en l鄚kt till URL:en. Den kommer ocks?att g顤a s?att l鄚ken 鞿pnas i ett nytt f霵ster n酺 
		man klicka p?den. Notera att "http://" delen av URL:en 酺 frivillig. 
		I det andra exemplet ovan, kommer URL:en l鄚ka texten till den URL du skriver in efter likhetstecknet.
                  Notera ocks?att du inte skall anv鄚da citationstecken inne i en l鄚k. 
		</P>
              </LI>
            </UL>
          </TD>
        <TR bgColor=#0099CC>
          <TD><b><font color="#FFFFFF">Email Links</font></b></TD>
        </TR>
        <TR bgColor=#ffffff>
          <TD>F顤 att l輍ga till en l鄚kad e-mail adress inuti ett meddelande, skriva bara in den som i exemplet nedan. 	(AGCode is in
            <FONT color=#ff0000>red</FONT>).
            <P>
              <CENTER>
                <FONT color=#ff0000>[email]</FONT>webmaster@proxy2.de<FONT color=#ff0000>[/email]</FONT>
              </CENTER>
            <P>I exemplet ovan kommer AGCoden automatiskt att generera en l鄚k till e-mail adressen som finns d酺.
              </P>
          </TD>
        </TR>
        <TR bgColor=#0099CC>
          <TD><b><font color="#FFFFFF">Fet ock kursiv stil</font></b></TD>
        </TR>
        <TR bgColor=#ffffff>
          <TD>Om du vill ha fet- eller kursiv stil s?skriver du bara in den mellan taggarna [b] [/b] [i] [/i] .
            <P>
              <CENTER>
                Hello, <FONT color=#ff0000>[b]</FONT><B>John</B><FONT color=#ff0000>[/b]</FONT><BR><br>
                Hello, <FONT color=#ff0000>[i]</FONT><I>Maria</I><font color="#FF0000">[i]</font>
              </CENTER>
          </TD>
        </TR>
        <TR bgColor=#0099CC>
          <TD><b><font color="#FFFFFF">L輍ga till bilder</font></b></TD>
        </TR>
        <TR bgColor=#ffffff>
          <TD>F顤 att l輍ga in en bild i ett meddelande s?skriver du bara in adressen och namnet p?bilden
		som det 酺 beskrivet h酺 nedan. (AGCode is in <FONT color=#ff0000>red</FONT>).
            <P>
              <CENTER>
                <FONT color=#ff0000>[img]</FONT>http://www.yourURL.com/image/logo.gif<FONT color=#ff0000>[/img]</FONT>
              </CENTER>
            <P>I exemplet ovan s?kommer AGCcoden automatiskt visa bilden i ditt meddelande.Notera: "http://" delen av URL:en 		m廛te skrivas in.<FONT color=#ff0000>[img]</FONT> </P>
          </TD>
        </TR>
        </TBODY>
      </TABLE>
    </TD>
  </TR>
  </TBODY>
</TABLE>
<table width="95%" border="0" cellspacing="1" cellpadding="4" align="center">
  <tr>
    <td><font color=#800000>Till輍g</font><br>
      Du skall inte anv鄚da b嶟e HTML och AGCode f顤 att g顤a samma sak. Notera ocks?
      att AGCoden inte 酺 beroende av sm?och stora bokst銥er (s?du kan anv鄚da <font color=#ff0000>[URL]</font>
      or <font color=#ff0000>[url]</font>).<br><br>
      <font color="#800000">Felaktig AGCode anv鄚dning:</font> <br>
       <font color="#ff0000">[url]</font> www.proxy2.de <font color=#ff0000>[/url]</font> - l輍g inte in mellanslag mellan 
	code inom paranteser eller texten som du formaterar.<br>
        <br>
        <font color="#ff0000">[email]</font>webmaster@proxy2.de<font color=#ff0000>[email]</font> - den avslutande parantesen har alltid ett fram廞 lutande snedstreck.(<font color=#ff0000>[/email]</font>)
    </td>
  </tr>
</table>
</CENTER>
<BR>
</BODY>
</HTML>

