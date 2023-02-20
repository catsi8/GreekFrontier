<?php
require_once ("../admin/config.inc.php");
require_once ("../lib/mysql.class.php");

$smilies = new gbook_sql();
$smilies->connect();
$smilies->query("SELECT * FROM ".$GB_TBL['smile']);
$i=0;
while ($smilies->fetch_array($smilies->result)) {
    $bgcolor = ($i % 2) ? "#E1E1E1" : "#F7F7F7";
    echo "
    <tr>
      <td bgcolor=\"$bgcolor\"><b>".$smilies->record['s_code']." </b></td>
      <td bgcolor=\"$bgcolor\">".htmlspecialchars($smilies->record['s_emotion'])."</td>
      <td bgcolor=\"$bgcolor\"><img alt=\"".$smilies->record['s_code']."\" border=\"0\" src=\"../img/smilies/".$smilies->record['s_filename']."\" width=\"".$smilies->record['width']."\" height=\"".$smilies->record['height']."\"></td>
    </tr>\n";
    $i++;
}
?>
