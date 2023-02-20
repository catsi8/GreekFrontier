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
      <td height="25"> W H A T &nbsp;&nbsp;&nbsp;A R E&nbsp;&nbsp;&nbsp;S M I L I E S ?</td>
    </tr>
    <tr>
      <td>
        <p>'Smilies' s緌 pequenas imagens gr塻icas que podem ser usadas para demonstrar um sentimento ou emo誽o.
	Se voc?j?usou e-mail ou chat de internet, voc?j?conhece esse conceito. Certas sequ瘽cias de caracteres 
	s緌 convertidos automaticamente em smlies. Se voc?n緌 entendeu, tente inclinar a cabe蓷 para o lado e use
	um pouco de imagina誽o para compreender os Smiles.</p>
        <p> Esta ?a lista de Smiles aceitos atualmente: </p>
      </td>
    </tr>
  </table>
  <table bgcolor=#f7f7f7 border=0 width="95%" cellspacing="1" cellpadding="4">
    <tbody>
    <tr>
      <td bgcolor="#996699"><font color=#ffffff><b>O que digitar</b></font></td>
      <td bgcolor="#996699"><font color=#ffffff><b>Emo誽o</b></font></td>
      <td bgcolor="#996699"><font color=#ffffff><b>Imagem que ir?aparecer</b></font></td>
    </tr>

<?php include ("./smilies.inc"); ?>

    </tbody>
  </table>
  <br>
  <table width="95%" border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td height="25">O &nbsp;&nbsp;&nbsp; Q  U E &nbsp;&nbsp;&nbsp; ?&nbsp;&nbsp;&nbsp; A G C O D E ?</td>
    </tr>
    <tr>
      <td>
        <p>AGCode (Advanced Guestbook Code) ?uma varia誽o das tags HTML que voc?j?deve conhecer.
	Basicamente, ele permite adicionar funcionalidade ou estilo em sua mensagem onde normalmente seria preciso usar HTML.
	Voc?pode usar AGCode mesmo que HTML n緌 esteja habilitado para o livro de visitas.
	Voc?pode querer usar AGCode no lugar do HTML, mesmo que o HTML esteja habilitadopara o livro de visitas,
        porque ele necessita de menos c鏚ico para ser usado e mais seguro (um erro de sintaxe n緌 causa tantos problemas).
        <p>AGCodes atuais:
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
          <TD>Se o AGCode estiver ativado, voc?n緌 precisar?usar o c鏚igo [URL] para criar um hiperlink.
		Simplesmente digite a URL completa de uma das duas maneiras a seguir e o hiperlink ser?criado automaticamente:
            <UL>
              <LI><font color="#800000">http://www.suaURL.com </font>
              <LI><FONT color=#800000>www.suaURL.com </FONT>Note que voc?precisar?usar o endere蔞 completo com http:// ou
		o endere蔞 curto apenas com o www. Se o site n緌 come蓷r com "www", ent緌 voc?deve usar o ender蔞 completo com "http://".
		Al幦 disso, voc?pode usar os prefixos de URL do tipo https e ftp (quando o AGCode estiver ativado).<BR>
                <BR>
              <LI>Voc?pode tamb幦 criar hiperlinks usando o c鏚igo [url]. Apenas use o formato abaixo: <br><br>
                <CENTER>
                  <FONT color=#ff0000>[url=http://www.proxy2.de]</FONT>hiperlink<FONT color=#ff0000>[/url]</FONT>
                </CENTER><br><br>
              <LI>
                <P>O antigo c鏚igo [URL] continua funcionando, como demonstrado abaixo. Apenas digite o texto entre as tags [url] [/url] como mostrado no exemplo abaixo
		(AGCode est?em <FONT color=#ff0000>vermelho</FONT>).
                <P>
                  <CENTER>
                    <FONT color=#ff0000>[url]</FONT>http://www.proxy2.de<FONT color=#ff0000>[/url]</FONT>
                  </CENTER>
                <P>Nos exemplos acima o AGCode gera automaticamente
                  um hiperlink para a URL entre as tags. Tamb幦 se garantir?que o link
                  ser?aberto em uma nova janela quando clicado.
                  Note que o "http://" ?completamente opcional.
                  No segundo exemplo acima, a URL ser?linkada ao texto com qualquer URL que voc?digitar depois do sinal de igual ("=").
		  Al幦 disso, note que voc?N鬃 DEVE usar aspas dentro da tag URL.</P>
              </LI>
            </UL>
          </TD>
        <TR bgColor=#0099CC>
          <TD><b><font color="#FFFFFF">Links de Emails</font></b></TD>
        </TR>
        <TR bgColor=#ffffff>
          <TD>Para adicionar hiperlinks de e-mails na sua mensagem, basta digitar o e-mail entre as tags [email] [/email] como no exemplo abaixo.
           (AGCode est?em <FONT color=#ff0000>vermelho</FONT>).
            <P>
              <CENTER>
                <FONT color=#ff0000>[email]</FONT>webmaster@proxy2.de<FONT color=#ff0000>[/email]</FONT>
              </CENTER>
            <P>No exemplo acima, o AGCode gera automaticamente o hiperlink para o endere蔞 de e-mail entre as tags.</P>
          </TD>
        </TR>
        <TR bgColor=#0099CC>
          <TD><b><font color="#FFFFFF">Negrito e It嫮ico</font></b></TD>
        </TR>
        <TR bgColor=#ffffff>
          <TD>Voc?pode tornar o seu texto negrito ou it嫮ico utilizando as tags [b] [/b] ou [i] [/i] ("i" para it嫮ico, "b" para negrito ou "bold").
            <P>
              <CENTER>
                Ol? <FONT color=#ff0000>[b]</FONT><B>Jo緌</B><FONT color=#ff0000>[/b]</FONT><BR><br>
                Ol? <FONT color=#ff0000>[i]</FONT><I>Maria</I><font color="#FF0000">[i]</font>
              </CENTER>
          </TD>
        </TR>
        <TR bgColor=#0099CC>
          <TD><b><font color="#FFFFFF">Adicionando Imagens</font></b></TD>
        </TR>
        <TR bgColor=#ffffff>
          <TD>Para adicionar uma imagem gr塻ica na sua mensagem, basta digitar a URL da imagem entre as tags [img] [/img] como mostrado no exemplo abaixo 
	  (AGCode est?em <FONT color=#ff0000>vermelho</FONT>).
            <P>
              <CENTER>
                <FONT color=#ff0000>[img]</FONT>http://www.suaURL.com/imagem/logo.gif<FONT color=#ff0000>[/img]</FONT>
              </CENTER>
            <P>No exemplo acima, o AGCode exibe automaticamente a imagem na sua mensagem. 
	    Nota: o "http://" como parte da URL ?OBRIGAT紑IA para a tag <FONT color=#ff0000>[img]</FONT>.</P>
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
    <td><font color=#800000>Observa踥es:</font><br>
      Voc?n緌 deve usar ao mesmo tempo o HTML e o AGCode para fazer a mensa fun誽o. Al幦 disso note 
      que o AGCode n緌 ?"case-sensiteve" (ou seja, voc?pode usar <font color=#ff0000>[URL]</font>
      ou <font color=#ff0000>[url]</font>).<br><br>
      <font color="#800000">Usos Incorretos de AGCode:</font> <br>
       <font color="#ff0000">[url]</font> www.proxy2.de <font color=#ff0000>[/url]</font> - n緌 coloque espa蔞s entre as tags e o texto que voc?est?aplicando o c鏚igo.<br>
        <br>
        <font color="#ff0000">[email]</font>webmaster@proxy2.de<font color=#ff0000>[email]</font> - a tag final deve incluir a barra inclinada (<font color=#ff0000>[/email]</font>)
    </td>
  </tr>
</table>
</CENTER>
<BR>
</BODY>
</HTML>


