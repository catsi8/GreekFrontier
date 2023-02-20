<?php
$include_path = dirname(__FILE__);
require_once $include_path."/admin/config.inc.php";
require_once $include_path."/lib/$DB_CLASS";
require_once $include_path."/lib/image.class.php";
require_once $include_path."/lib/template.class.php";
require_once $include_path."/lib/vars.class.php";
require_once $include_path."/lib/comment.class.php";
require_once $include_path."/lib/phrase.class.php";

$gb_com = new gb_comment($include_path);
$gb_com->id = (isset($_GET["gb_id"])) ? $_GET["gb_id"] : '';
$gb_com->id = (isset($_POST["gb_id"])) ? $_POST["gb_id"] : $gb_com->id;
$gb_com->id = intval($gb_com->id);
$gb_com->comment = (isset($_POST["comment"])) ? $_POST["comment"] : '';
$gb_com->user = (isset($_POST["gb_user"])) ? $_POST["gb_user"] : '';
$gb_com->pass_comment = (isset($_POST["pass_comment"])) ? $_POST["pass_comment"] : '';
$gb_com->gb_captcha = (isset($_POST["gb_captcha"])) ? $_POST["gb_captcha"] : '';
$gb_com->token = (isset($_POST["gb_token"])) ? $_POST["gb_token"] : '';
$gb_action = (isset($_POST["gb_comment"])) ? $_POST["gb_comment"] : '';
$gb_com->comment_action($gb_action);

?>
