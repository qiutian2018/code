<?php
function self_echo($str){
	echo $str . '<br/>';
}
function self_pre(){
	echo '<pre>';
}
class Conf{
	function __construct(array $conf)
	{
		if(empty($conf)){
			throw new Exception('empty config');
		}
		self_echo('conf is ok');
	}

	public function selfExcep($yes=true)
	{
		if(!$yes){
			throw new MyException('excep false');
		}
		self_echo('excep true');
	}
}

class MyException extends Exception{
	function __construct($msg)
	{
		$msg .= ' MyException msg';
		parent::__construct($msg);
	}
}

try{
	$a = new Conf(['a']);
	$a->selfExcep(false);
}catch(MyException $e){
	self_echo($e->getMessage());
	// self_echo($e->__toString());
	// self_echo($e->getCode());
	// self_echo($e->getFile());
	// self_echo($e->getLine());
	// self_echo($e->getPrevious());
	// self_pre();
	// var_dump($e->getTrace());
	// self_echo($e->getTraceAsString());
}catch(Exception $e){
	self_echo($e->getMessage());
}


class Person{
	public $name = 'ddddddddd';
	public $account;

	function __construct(Account $account)
	{
		$this->account = $account;
	}
	public function __get($property)
	{
		$method = "get{$property}";
		// if(method_exists($this, $method)){
		// 	$this->$method();
		// }else{
		// 	self_echo("get{$property} not exist");
		// }
		if(property_exists($this, $property)){
			slef_echo($property);
		}else{
			self_echo("$property not exist");
		}
	}
	public function getName()
	{
		self_echo('default name');
	}
	public function __call($method_name,$args)
	{
		if(method_exists($this, $method_name)){
			return $this->$method_name($args);
		}else{
			self_echo("$method_name does not exist");
		}
	}
	public function getAge($age)
	{
		self_echo('age' . $age);
	}

	function __clone()
	{
		$this->account = clone $this->account;
	}
}

class Account{
	public $money;
	function __construct($money)
	{
		$this->money = $money;
	}
}

self_pre();
$p = new Person(new Account(10));
self_echo($p->name);
$p->getName();
$p->getAge(11);
var_dump($p);
$p2 = $p;
var_dump($p2);
echo '-----------<br/>';
$p3 = new Person(new Account(100));
self_echo($p3->account->money);

$p4 =clone $p3;
var_dump($p3);
$p3->account->money+=1000;
self_echo($p3->account->money);

var_dump($p4);
self_echo($p4->account->money);