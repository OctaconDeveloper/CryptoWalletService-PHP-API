<?php
include('PHPCoinAddress.php');
include('EtherHome.php');
$id=$_GET['id'];
if(!empty($id)){
	$result=array();
	$c=array();
		if($id=='ETH'){
			$coin=ETHWALLET();
			$public=$coin[0];
			$private=$coin[1];
		}else{
			$coin=CoinAddress::$id();
			$public=$coin['public'];
			$private=$coin['private'];
		}
		$c['CoinName']=$id;
		$c['Public Address']=$public;
		$c['Private Key']=$private;
		$result['status']='Ok';
		$result['data']=$c;

		echo $db=json_encode($result);
}else{
	header("location:index.php");
}

?>