<?php
// ģ����ɾ�Ĳ�
abstract class CURD
{
	// ����Ԫ��
	abstract function add();
	// ����Ԫ��
	abstract function insert();
	// ɾ��Ԫ��
	abstract function delete($id);
	// ͨ��ID����
	abstract function findById($id);
	// ͨ�����ݲ���
	abstract function findByCon($con);
	// ��������
	abstract function doList();
}

class doCURD extends CURD 
{
	// ����
	public $key  = null;
	public $name = null;
	public $age  = null;
	// �ڵ�����
	public $length = '';

	public function __construct()
	{
		for ($i=1; $i <= 25; $i++) { 
			$this->key[]  = $i;
			$this->name[] =  chr(rand(65,90)).chr(rand(65,90)).chr(rand(65,90));
			$this->age[]  =  rand(0,100);
		}
	}
	// ����Ԫ��
	public function add()
	{

	}
	// ����Ԫ��
	public function insert()
	{

	}
	// ɾ��Ԫ��
	public function delete($id)
	{
		$count=count($this->key);
		$key  = $this->key;
		$name = $this->name;
		$age  = $this->age;
		for ($i=$count-2; $i >=$id-1; $i--) {
			if ($this->) {
				# code...
			}
			$this->key[$i] = $key[$i+1];
			$this->name[$i] = $name[$i+1];
			$this->age[$i] = $age[$i+1];
		}
		var_dump($this->key);
	}
	// ͨ��ID����
	public function findById($id)
	{
		for ($i=0; $i < count($this->key); $i++) { 
			$check[0] = $this->key[$i];
			$check[1] = $this->name[$i];
			$check[2] = $this->age[$i];
			if ($id == $check[0]) {
				echo implode(' ', $check);
				break 1 ;
			}
		}
	}
	// ͨ�����ݲ���
	public function findByCon($con)
	{
		for ($i=0; $i < count($this->key); $i++) { 
			$check[0] = $this->key[$i];
			$check[1] = $this->name[$i];
			$check[2] = $this->age[$i];
			if (in_array($con, $check)) {
				echo implode(' ', $check);
				break 1 ;
			}
		}

	}
	// ��������
	public function doList()
	{
		for ($i=0; $i < count($this->key); $i++) { 
			echo $this->key[$i].' ';
			echo $this->name[$i].' ';
			echo $this->age[$i].'<br>';
		}
	}

}

$ob = new doCURD;
// $ob->doList();
// $ob->findByCon(8);
// $ob->findById(8);
$ob->delete(8);