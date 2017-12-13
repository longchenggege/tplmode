<?php
//模板解析类
class Parser{
	public $tpl;
	public function __construct($_tplfile){
		if(!$this->tpl = file_get_contents($_tplfile)){
			exit('模板文件读取错误');
		}
	    	
	}
	//解析普通变量
	public function parVar(){
		$var ='/\{\$([\w]+)\}/';
		if(preg_match($var,$this->tpl)){
		    $this->tpl = preg_replace($var,"<?php echo \$this->vars['\\1'];?>",$this->tpl);
		}
	}
	//解析if语句
	public function parIf(){
		$startif = '/\{if\s+\$([\w]+)\}/';
		$endif = '/\{\/if\}/';
		$elseif = '/\{else\}/';
	    if(preg_match($startif,$this->tpl)){
			if(preg_match($endif,$this->tpl)){
				$this->tpl = preg_replace($endif,"<?php }?>",$this->tpl);
				$this->tpl = preg_replace($startif,"<?php if(\$this->vars['$1']){?>",$this->tpl);
				if(preg_match($elseif,$this->tpl)){
					$this->tpl = preg_replace($elseif,"<?php }else{ ?>",$this->tpl);
				}
			}else{
				echo 'if没有结尾';	
			}
		}	
	}
	//解析注释
	private function parCommon(){
	    $zh ='/\{#\}(.*)\{#\}/';
		if(preg_match($zh,$this->tpl)){
		    $this->tpl = preg_replace($zh,"<?php /*$1*/ ?>",$this->tpl);
		}	
	}
	//解析froeach
	private function parForeach(){
	    $startea ='/\{foreach \$([\w]+)\(([\w]+),([\w]+)\)\}/';
		$endea = '/\{\/foreach\}/';
		$content = '/\{@([\w]+)\}/';
		if(preg_match($startea,$this->tpl)){
		    if(preg_match($endea,$this->tpl)){
			    $this->tpl = preg_replace($startea,"<?php foreach(\$this->vars['$1'] as \$$2=>\$$3){?>",$this->tpl);	
				$this->tpl = preg_replace($endea,"<?php } ?>",$this->tpl);
				if(preg_match($content,$this->tpl)){
					$this->tpl = preg_replace($content,"<?php echo \$$1?>",$this->tpl);
				}	
			}else{
				exit('fddfd');
			}
		}	
	}
	//解析include
	public function parInclude(){
		$include = '/\{include\s+file="([\w\.\-]+)"\}/';
	    if(preg_match($include,$this->tpl,$file)){
			if(!file_exists($file[1])||empty($file[1])){
			    exit($file[1].'引入文件出错');	
			}
			$this->tpl = preg_replace($include,"<?php include '$1'; ?>",$this->tpl);
		}	
	}
	
	//解析系统变量
	public function parConfig(){
		$con = '/<!--\{([\w]+)\}-->/';
	    if(preg_match($con,$this->tpl)){
			$this->tpl = preg_replace($con,"<?php echo \$this->config['$1'];?>",$this->tpl);
		}	
	}
	
	public function complie($_parfile){
		//执行替换
		$this->parVar();
		$this->parIf();
        $this->parCommon(); 
		$this->parForeach();
		$this->parInclude();
		$this->parConfig();
		//生成编译文件
		if(!file_put_contents($_parfile,$this->tpl)){
		    exit('编译文件出错');	
		}
	}
	
	
}

?>