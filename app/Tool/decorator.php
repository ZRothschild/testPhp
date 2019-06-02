<?php 
interface Decorator{
	function display();
}
class Student implements Decorator{
	private $name;
	public function __construct($name){
		$this->name = $name;
	}
	public function display(){
		echo "我是".$this->name."我去上学了".'<br>';
	}
}
class Finery implements Decorator{
	private $component;
	public function __construct(Decorator $component){
		$this->component = $component;
	}
	public function display(){
		$this->component->display();
	}
}
class GetUp extends Finery{
		public function display(){
		echo "起床".'<br>';
		parent::display();
	}
}
class MakeUp extends Finery{
		public function display(){
		echo "化妆".'<br>';
		parent::display();
	}
}
class School extends Finery{
	public function display(){
		parent::display();
		echo "我到学校了".'<br>';
	}
}
$xiaoFang = new Student('小芳');
$makeUp = new MakeUp($xiaoFang);
$getUp = new GetUp($makeUp);
$school  = new School($getUp);
$school->display();