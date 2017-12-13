<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->config['long'];?></title>
</head>
<body>


我将被index.php引入，<?php echo $this->vars['name'];?>要parsor类解析后才能正ss常显示。
<?php if($this->vars['name']){?>
    <div>11111号界面</div>
<?php }else{ ?>
    <div>22222号界面</div>
<?php }?>
<?php /*我是注释部分的内容*/ ?>

<br/>

<?php foreach($this->vars['array'] as $key=>$value){?>
   --<?php echo $value?><br/>
<?php } ?>
</body>
</html>