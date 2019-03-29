<?php
class User{
	public $name;
	public $addr = 'Bj';
	protected $age;
	public function show()
	{
		echo 'user info';
	}

	protected function showPro()
	{
		echo 'user info protected';
	}

	private function showPri()
	{
		echo 'user info private';
	}
}

echo '<pre>';
// $u = new User();
// $method = 'show';
// $methodPro = 'showPro';
// $methodPri = 'showPri';
// $u->$method();
// if(is_callable([$u,$method])){
// 	echo '----yes';
// }else{
// 	echo '-----no';
// }

// if(is_callable([$u,$methodPro])){
// 	echo '----Proyes';
// }else{
// 	echo '-----Prono';
// }

// if(is_callable([$u,$methodPri])){
// 	echo '----Priyes';
// }else{
// 	echo '-----Prino';
// }

// if(method_exists($u, $method)){
// 	echo '----method_exists---yes';
// }else{
// 	echo '----method_exists---no';
// }

// if(method_exists($u, $methodPro)){
// 	echo '----method_exists---Proyes';
// }else{
// 	echo '----method_exists---Prono';
// }

// if(method_exists($u, $methodPri)){
// 	echo '----method_exists---Priyes';
// }else{
// 	echo '----method_exists---Prino';
// }

// var_dump(get_class_vars('User'));

abstract class CommonsManager{
	abstract function saySth();
	abstract function doSth();
}
class MagaManager extends CommonsManager{
	public function saySth(){
		echo 'mage say';
	}
	public function doSth(){
		echo 'mage do';
	}
}
class BloggManager extends CommonsManager{
	public function saySth(){
		echo 'blogg say';
	}
	public function doSth(){
		echo 'blogg do';
	}
}
class Settings{
	const COMMSTYPE = 'blogg';
}

class Appconfig{
	private static $instance;
	private $commsManager;

	private function __clone(){}
	private function __construct(){
		$this->init();
	}
	private function init(){
		switch(Settings::COMMSTYPE){
			case 'blogg':
				$this->commsManager = new BloggManager();
				break;
			default :
				$this->commsManager = new MagaManager();
		}
	}
	//对象只有一个,构造函数也只会执行一次,可以在init中做一些仅一次操作的事
	public static function getInstance(){
		// if(empty(self::$instance)){
		// 	self::$instance = new self();
		// 	echo '----instance-----';
		// }
		if(!(self::$instance instanceof self)){
			self::$instance = new self();
			echo '---iiiii----';
		}
		return self::$instance;
	}
	public function getCommsManager(){
		//clone可以生成一个源对象CommonsManager的(浅)复制,其中一个修改会影响另一个
		//如果$this->commsManager引用了其他对象,那么需要去CommonsManager类中实现__clone()方法以确保得到对象的是深复制
		return clone $this->commsManager;
	}
}

$obj = Appconfig::getInstance();
$obj->getCommsManager()->doSth();


class TestCopy{
	public $name = 'yes';
	public function setName($name){
		$this->name = $name;
	}
}

$t = new TestCopy();
var_dump($t);
$c_t = $t;
var_dump($c_t);
$t->setName('yes2');
var_dump($t);
var_dump($c_t);