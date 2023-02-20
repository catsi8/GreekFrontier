<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
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
      <td height="25"> C O S A &nbsp;&nbsp;&nbsp;S O N O&nbsp;&nbsp;&nbsp;L E&nbsp;&nbsp;&nbsp;S M I L I E S ?</td>
    </tr>
    <tr>
      <td>
        <p>Le 'Smilies' sono  piccole immagini grafiche che possono essere usate per esprimere
	 emozioni. Se avete gi?scritto email o chattato, avrete sicuramente gi?una buona familiarit?
	con il loro uso. Le  'faccine' standard vengono automaticamente convertite in 'Smiles' .
Provate a girare  la vostra testa di lato se non  riuscite a vedere le 'faccine'; usando un po' di
immaginazione dovreste poter riconoscere una faccia che esprime uno stato d'animo</p>
        <p> Qui sotto c'?la lista di tutte le 'faccine' al momento riconosciute dal guestbook: </p>
      </td>
    </tr>
  </table>
  <table bgcolor=#f7f7f7 border=0 width="95%" cellspacing="1" cellpadding="4">
    <tbody>
    <tr>
      <td bgcolor="#996699"><font color=#ffffff><b>Cosa devi scrivere</b></font></td>
      <td bgcolor="#996699"><font color=#ffffff><b>Emozione</b></font></td>
      <td bgcolor="#996699"><font color=#ffffff><b>Il disegno che verr?visualizzato</b></font></td>
    </tr>

<?php include ("./smilies.inc"); ?>

    </tbody>
  </table>
  <br>
  <table width="95%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td height="25">C O S' E'&nbsp;&nbsp;&nbsp;L'&nbsp;A D V A
        N D C E D &nbsp;&nbsp;&nbsp;G U E S T B O O K &nbsp;&nbsp;&nbsp;C O D E ? </td>
    </tr>
    <tr>
      <td>
        <p>L'AGCode ?una variazione dei tag HTML di cui potreste gi?avere una conoscenza di base.
Permette di aggiungere funzionalit?o stili al vostro messaggio, cosa permessa normalmente con l'uso dell'HTML. Si pu?usare l'AGCode anche se l'HTML sui messaggi ?disabilitato. Potreste usare
l'AGCode in sostituzione dell'HTML, anche se l'HTML ?attivo sul guestbook, perch?richiede di scrivere meno codice ed ?pi?sicuro da usare (sintassi errate non daranno problemi indesiderati).
        <p>L'AGCodes corrente:
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
          <TD>Se AGCode ?abilitato, non dovrete pi?usare il codice per creare un hyperlink. Digitate semplicemente la URL completa in uno dei seguenti modi e il link sar?creato automaticamente:
            <UL>
              <LI><font color="#800000">http://www.iltuoURL.com </font>
              <LI><FONT color=#800000>www.iltuoURL.com </FONT>Potete usare la dicitura completa di http:// o digitare solo il dominio senza www. Se il sito non inizia con "www", dovete usare l'indirizzo completo con davanti "http://". Si possono anche usare indirizzi con protocolli https e ftp  (quando  AGCode ?attivo). <BR>
                <BR>
              <LI>Puoi anche avere degli hyperlink usando lo [url] codice, usando il seguente formato: <br><br>
                <CENTER>
                  <FONT color=#ff0000>[url=http://www.proxy2.de]</FONT>hyperlink<FONT color=#ff0000>[/url]</FONT>
                </CENTER><br><br>
              <LI>
                <P>Il vecchio [URL] codice lavorer?ancora, come scritto qui sotto. Racchiudete il link come vedete nel seguente esempio (l'AGCode ?FONT color=#ff0000>scritto in rosso</FONT>).
                <P>
                  <CENTER>
                    <FONT color=#ff0000>[url]</FONT>http://www.proxy2.de<FONT color=#ff0000>[/url]</FONT>
                  </CENTER>
                <P>

Nell'esempio sopra l'AGCode generer?automaticamente
un hiperlink all'indirizzo che racchiude. Assicurer?che il link sia aperto in una nuova finestra non appena un utente ci cliccher?sopra. Notare che la parte "http://" ?opzionale. Nel secondo esempio visto sopra, la URL sar?assegnata al testo che verr?inserito dopo il segno uguale. Si noti anche che non sono state usate le virgolette per scrivere l'indirizzo. </P>
              </LI>
            </UL>
          </TD>
        <TR bgColor=#0099CC>
          <TD><b><font color="#FFFFFF">Email Links</font></b></TD>
        </TR>
        <TR bgColor=#ffffff>
          <TD>Per aggiungere un link ad una email nel messaggio, racchiudere l'indirizzo email come descritto qui sotto (l'AGCode ?
            <FONT color=#ff0000>scritto in rosso</FONT>).
            <P>
              <CENTER>
                <FONT color=#ff0000>[email]</FONT>webmaster@proxy2.de<FONT color=#ff0000>[/email]</FONT>
              </CENTER>
            <P>Nell'esempio sopra, l'AGCode automaticamente genera un hyperlink
             all'indirizzo email che racchiude. </P>
          </TD>
        </TR>
        <TR bgColor=#0099CC>
          <TD><b><font color="#FFFFFF">Grassetto e corsivo</font></b></TD>
        </TR>
        <TR bgColor=#ffffff>
          <TD>Potete decidere di rendere in grassetto o in corsivo  parti del messaggio racchiundendo la porzione di testo che vi interessa con i tag [b] [/b] o  [i] [/i] .
            <P>
              <CENTER>
                Ciao, <FONT color=#ff0000>[b]</FONT><B>John</B><FONT color=#ff0000>[/b]</FONT><BR><br>
                Ciao, <FONT color=#ff0000>[i]</FONT><I>Maria</I><font color="#FF0000">[i]</font>
              </CENTER>
          </TD>
        </TR>
        <TR bgColor=#0099CC>
          <TD><b><font color="#FFFFFF">Aggiungere immagini</font></b></TD>
        </TR>
        <TR bgColor=#ffffff>
          <TD>Per aggiungere immagini nel messaggio, racchiudere la URL dell'immagine come nell'esempio qui sotto (l'AGCode ?<FONT color=#ff0000>scritto in rosso</FONT>).
            <P>
              <CENTER>
                <FONT color=#ff0000>[img]</FONT>http://www.yourURL.com/image/logo.gif<FONT color=#ff0000>[/img]</FONT>
              </CENTER>
            <P>Nell'esempio sopra, l'AGCode rende  automaticamente visibile l'immagine all'interno del messaggio. Notare che la parte "http://" della URL ?OBBLIGATORIA per il tag <FONT color=#ff0000>[img]</FONT>.</P>
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
    <td><font color=#800000>NOTE</font><br>
      Non usare l'HTML e l'AGCode assieme per fare la stessa cosa. Si noti anche che l'AGCode non ?'case-sensitive' (cio?non fa differenza scrivere in maiuscolo o in minuscolo il codice: si pu?scrivere sia <font color=#ff0000>[URL]</font>
      che <font color=#ff0000>[url]</font>).<br><br>
      <font color="#800000">Uso incorretto dell'AGCode:</font> <br>
       <font color="#ff0000">[url]</font> www.proxy2.de <font color=#ff0000>[/url]</font> - non mettere spazi tra i tag e il testo racchiuso all'interno.<br>
        <br>
        <font color="#ff0000">[email]</font>webmaster@proxy2.de<font color=#ff0000>[email]</font> - Il tag di chiusura deve avere una barra davanti(<font color=#ff0000>[/email]</font>)
    </td>
  </tr>
</table>
</CENTER>
<BR>
</BODY>
</HTML>

