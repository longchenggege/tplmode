<?php
require dirname(__FILE__).'/template.inc.php';
//global $_tpl;
//声明一个变量
$name='龙哥哥';
$_array = array(1,2,3,5,6);
//注入变量
$_tpl->assign('name',$name);
$_tpl->assign('array',$_array);
$_tpl->display('index.tpl.php');
?>