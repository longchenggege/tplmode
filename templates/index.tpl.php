<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><!--{long}--></title>
</head>
<body>


我将被index.php引入，{$name}要parsor类解析后才能正ss常显示。
{if $name}
    <div>11111号界面</div>
{else}
    <div>22222号界面</div>
{/if}
{#}我是注释部分的内容{#}

<br/>

{foreach $array(key,value)}
   --{@value}<br/>
{/foreach}
</body>
</html>