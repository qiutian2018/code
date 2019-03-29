<?php
function self_echo($str,$die=false){
	echo $str . '<br/>';
	if($die){
		exit();
	}
}

class ShopProduct
{
	public $productName;
	static public $staticAttr = 'staticAttr';
	static public $staticCount = 0;
	function __construct($config)
	{
		$this->productName = $config['defaultName'];
	}

	static public function getStaticAttr()
	{
		self_echo(self::$staticAttr);
	}

	static public function getStaticCount()
	{
		self::$staticCount++;
		self_echo(self::$staticCount);
	}

}

class CDProduct extends ShopProduct
{
	public $playTime;
	static public $staticCount = 10;
	function __construct($config)
	{
		parent::__construct($config);
		$this->playTime = $config['playTime'];
	}

	static public function subGetStaticCount()
	{
		self_echo(self::$staticCount);
	}
}

$sp = new ShopProduct(['defaultName'=>'defaultName']);
self_echo($sp->productName);
ShopProduct::getStaticAttr();
ShopProduct::getStaticCount();
$cd = new CDProduct(['defaultName'=>'defaultName','playTime'=>'260']);
CDProduct::subGetStaticCount();

abstract class MyAbClass
{
	public $firstAttr = 'firstAttr';
	public $secondAttr = 'secondAttr';
	public function __construct(){}
	public function showFirstAttr()
	{
		self_echo($this->firstAttr);
	}
	abstract public function showSecondAttr();
}

class A extends MyAbClass
{
	public function __construct()
	{
		parent::__construct();
	}
	public function showSecondAttr()
	{
		self_echo($this->secondAttr);
	}
}
$ab = new A();
$ab->showFirstAttr();
$ab->showSecondAttr();

abstract class Domain
{
	public $group;
	public function __construct()
	{
		//static 延迟静态绑定 PHP5.3之后
		//self::getGroup()找得是自身类中的getGroup(),而static::getGroup()会先从当调用类中找getGroup(),找不到再往父级找
		$this->group = static::getGroup();
		// $this->group = self::getGroup();
		self_echo($this->group);
	}
	static public function create()
	{
		return new static();
	}
	static public function getGroup()
	{
		return 'default group';
	}
}
class User extends Domain
{
	// static public function create()
	// {
	// 	return new self();
	// }
}
class Shop extends Domain
{
	// static public function create()
	// {
	// 	return new self();
	// }
	static function getGroup()
	{
		return 'shop group';
	}
}

var_dump(User::create());//default Group
var_dump(Shop::create());//shop Group