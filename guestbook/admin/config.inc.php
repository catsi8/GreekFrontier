﻿<?php
/* database settings */
$GB_DB = array();
$GB_DB["dbName"] = "greekfro_agbook1";
$GB_DB["host"]   = "localhost";
$GB_DB["user"]   = "greekfro_agbook2";
$GB_DB["pass"]   = "ZlvdDL_hRe";

/* tables */
$GB_TBL = array();
$GB_TBL["data"]  = "agb_book_data";
$GB_TBL["auth"]  = "agb_book_auth";
$GB_TBL["cfg"]   = "agb_book_config";
$GB_TBL["com"]   = "agb_book_com";
$GB_TBL["ip"]    = "agb_book_ip";
$GB_TBL["words"] = "agb_book_words";
$GB_TBL["ban"]   = "agb_book_ban";
$GB_TBL["priv"]  = "agb_book_private";
$GB_TBL["smile"] = "agb_book_smilies";
$GB_TBL["pics"]  = "agb_book_pics";
$GB_TBL["cap"]   = "agb_book_captcha";

/* guestbook pages */
$GB_PG = array();
$GB_PG["index"]    = "index.php";
$GB_PG["admin"]    = "admin.php";
$GB_PG["comment"]  = "comment.php";
$GB_PG["addentry"] = "addentry.php";


/* guestbook templates */
$GB_TPL = array();
$GB_TPL["adm_enter"]  = "admin_enter.php";
$GB_TPL["body"]       = "body.php";
$GB_TPL["entry"]      = "entry.php";
$GB_TPL["error"]      = "error.php";
$GB_TPL["form"]       = "form.php";
$GB_TPL["preview"]    = "preview.php";
$GB_TPL["prev_entry"] = "preview_entry.php";
$GB_TPL["header"]     = "header.php";
$GB_TPL["footer"]     = "footer.php";
$GB_TPL["icq"]        = "icq.php";
$GB_TPL["url"]        = "url.php";
$GB_TPL["aim"]        = "aim.php";
$GB_TPL["com"]        = "com.php";
$GB_TPL["email"]      = "email.php";
$GB_TPL["success"]    = "success.php";
$GB_TPL["frm_icq"]    = "form_icq.php";
$GB_TPL["frm_aim"]    = "form_aim.php";
$GB_TPL["frm_gender"] = "form_gender.php";
$GB_TPL["frm_image"]  = "form_image.php";
$GB_TPL["com_pass"]   = "com_pass.php";
$GB_TPL["com_form"]   = "comment.php";
$GB_TPL["image"]      = "user_pic.php";
$GB_TPL["captcha"]    = "captcha.php";

/* misc */

define('USE_CAPTCHA', true);

define('IS_MODULE', false);  /* running as POST-Nuke 0.x or PHP-Nuke 5.x addon? */

$GB_PG["base_url"] = "http://greek-frontier.com/guestbook";  /* e.g http://www.yourdomain.com/guestbook */

$DB_CLASS  = "mysql.class.php";
$TEC_MAIL  = "yasuechiu@gmail.com";
$GB_UPLOAD = "public";
$GB_TMP    = "tmp";

if ($GB_PG["base_url"] == "") {
    $inter_type = php_sapi_name();
    if ($inter_type == "cgi") {
        if (isset($_SERVER["PATH_INFO"]) && !empty($_SERVER["PATH_INFO"])) {
            $GB_PG["base_url"] = dirname($_SERVER["PATH_INFO"]);
        } elseif (isset($_SERVER["REQUEST_URI"]) && !empty($_SERVER["REQUEST_URI"])) {
            $GB_PG["base_url"] = dirname($_SERVER["REQUEST_URI"]);
        } else {
            $GB_PG["base_url"] = dirname($_SERVER["SCRIPT_NAME"]);
        }
    } else {
        $GB_PG["base_url"] = dirname($_SERVER["PHP_SELF"]);
    }
}

?>

