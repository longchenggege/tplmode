<?php
class Templates{
	//想接受变量但有不知道有多少变量要接受，可以通过数组来实现
	public $vars = array();
	private $config = array();
	
	public function __construct(){
		if(!is_dir(TPL_DIR)||!is_dir(CACHE)||!is_dir(TPL_C_DIR)){
		    exit('error:模板或缓存目录不存在，请手工设置');	
		}
		$sxe = simplexml_load_file('profile.xml');
		$taglib = $sxe->xpath('/root/taglib');
		foreach($taglib as $tag){
		    $this->config["$tag->name"] = $tag->value;	
		}
	}
	
	public function assign($var,$value){
		//$var用于同步模板里面的变量名
		//$vlaue表示模板里面的变量值
		if(isset($var)&&!empty($var)){
			$this->vars[$var] = $value;
		}else{
		    exit('请设置模板变量');	
		}
	}
	
	public function display($_file){
		//设置模板路径
		$_tplfile = TPL_DIR.$_file;
		//判断模板是否存在
		if(!file_exists($_tplfile)){
		    exit('模板文件不存在');	
		}
		//编译文件路径
		$_parfile = TPL_C_DIR.md5($_file).$_file;
		//缓存文件路径
		$_cachefile = CACHE.md5($_file).$_file;
		//缓存文件引入条件
		if(IS_CACHE){
		    if(file_exists($_cachefile)&&!empty($_parfile)){
			    if(filemtime($_parfile)>=filemtime($_tplfile)&&filemtime($_cachefile)>=filemtime($_parfile)){
					include $_cachefile;
				    return;	
				}
			}	
		}
		//判断是否存在编译文件或模板修改时间大于编译文件生成时间
		if(!file_exists($_parfile||filemtime($_tplfile)>filemtime($_parfile))){
			require ROOT_PATH.'/includes/Parser.class.php';
			$_parser = new Parser($_tplfile);
			$_parser->complie($_parfile);
			//载入编译文件
			include $_parfile;	
			if(IS_CACHE){
				//获取缓冲区数据并生成缓存文件
				file_put_contents($_cachefile,ob_get_contents());
				//载入缓存文件
				ob_end_clean();
				include $_cachefile;	
			}
		}
	}
}
?>