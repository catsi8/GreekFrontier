<?php
$include_path = dirname(__FILE__);
require_once $include_path."/admin/config.inc.php";
require_once $include_path."/lib/$DB_CLASS";
require_once $include_path."/lib/image.class.php";
require_once $include_path."/lib/template.class.php";
require_once $include_path."/lib/vars.class.php";
require_once $include_path."/lib/add.class.php";
require_once $include_path."/lib/phrase.class.php";

$gb_post = new addentry($include_path);

if (isset($_POST["gb_action"])) {
    $gb_post->name = (isset($_POST["gb_name"])) ? $_POST["gb_name"] : '';
    $gb_post->email = (isset($_POST["gb_email"])) ? $_POST["gb_email"] : '';
    $gb_post->url = (isset($_POST["gb_url"])) ? $_POST["gb_url"] : '';
    $gb_post->comment = (isset($_POST["gb_comment"])) ? $_POST["gb_comment"] : '';
    $gb_post->location = (isset($_POST["gb_location"])) ? $_POST["gb_location"] : '';
    $gb_post->icq = (isset($_POST["gb_icq"])) ? $_POST["gb_icq"] : 0;
    $gb_post->aim = (isset($_POST["gb_aim"])) ? $_POST["gb_aim"] : '';
    $gb_post->gender = (isset($_POST["gb_gender"])) ? $_POST["gb_gender"] : '';
    $gb_post->userfile = (isset($_FILES["userfile"]["tmp_name"]) && $_FILES["userfile"]["tmp_name"] != "") ? $_FILES : '';
    $gb_post->user_img = (isset($_POST["gb_user_img"])) ? $_POST["gb_user_img"] : '';
    $gb_post->preview = (isset($_POST["gb_preview"])) ? 1 : 0;
    $gb_post->private = (isset($_POST["gb_private"])) ? 1 : 0;
    $gb_post->token = (isset($_POST["gb_token"])) ? $_POST["gb_token"] : '';
    $gb_post->gb_captcha = (isset($_POST["gb_captcha"])) ? $_POST["gb_captcha"] : '';
    echo $gb_post->process($_POST["gb_action"]);
    
} else {
    echo $gb_post->process();
}
?>
