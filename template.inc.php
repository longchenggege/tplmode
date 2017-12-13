<?php
    //设置utf-8格式编码
header("Content-Type:text/html;charset=utf-8");
//网站根目录
define('ROOT_PATH',dirname(__FILE__));
//模板目录
define('TPL_DIR',ROOT_PATH.'/templates/');
//编译文件目录
define('TPL_C_DIR',ROOT_PATH.'/templates_c/');
//缓存文件目录
define('CACHE',ROOT_PATH.'/cache/');
//缓存开启与否
define('IS_CACHE',true);
IS_CACHE ? ob_start(): null;
require ROOT_PATH.'/includes/Templates.class.php';
$_tpl = new Templates();
?>