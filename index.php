<?php
include('PHPCoinAddress.php');
include('EtherHome.php');
$msg="";
?>
<!DOCTYPE html>
<html>
<head>
	<title>CryptoWallet Generator PHP</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
<body>
<?php
if(isset($_POST['generate'])){
	$cointype=$_POST['cointype'];
	if(empty($cointype)){
		$meg="<b>Invalid Coin Type";
	}else{
		if($cointype=='ETH'){
			$coin=ETHWALLET();
			$public=$coin[0];
			$private=$coin[1];
			$msg="Ethereum Wallet <br/>";
			$msg.="Public Address => ".$public." <br/>";
			$msg.="Private Key => ".$private." <br/>";
		}else{
			$coin=CoinAddress::$cointype();
			$public=$coin['public'];
			$private=$coin['private'];
			$msg=$cointype." Wallet <br/>";
			$msg.="Public Address => ".$public." <br/>";
			$msg.="Private Key => ".$private." <br/>";
		}
	}
}
if(isset($_POST['generate2'])){
	$cointype=$_POST['cointype'];
	if(empty($cointype)){
		$meg="<b>Invalid Coin Type";
	}else{
		header("location:api.php?id=".$cointype);
	}
}
?>
	<div class="row">
		<h1 align="center"><b>CryptoWallet Generator API PHP</b></h1>
	</div>
	<div class="row" style="margin:30px;">
		<div class="col-lg-4">	
			<p align="justify"> 
				This a server side wallet service written in php that does not save private keys on <b>any</b> database. Written in pure PHP without any framework, the private keys can be fetch directly on this page or fetch through an external url using JSON Array.
				<code>
					@kaakadev
				</code>
			</p>
		</div>
		<div class="col-lg-2">	
			<form method="post">
				<h2>Generator</h2>
				<div class="form-group">
					<label>Coin Type</label>
					<select class="form-control" name="cointype">
						<option></option>
						<option value="BTC">Bitcoin</option>
						<option value="ETH">Ethereum</option>
						<option value="LTC">Litecoin</option>
						<option value="DODGE">Dodge Coin</option>
						<option value="DASH">Dash Coin</option>
						<option value="FETHER">FETHERCOIN</option>
					</select>
				</div>
				<div class="form-group">
					<button class="btn btn-success" name="generate"> Generate</button>
				</div>
				<div class="form-group">
					<h2>Or generate JSON Array</h2>
					<button class="btn btn-success" name="generate2"> Fetch JSON</button>
				</div>
			</form>
		</div>
		<div class="col-lg-6">
			<h2>Output</h2>
			<code>
				<h4>Output Goes Here</h4>
				<?php
					print_r($msg);
				?>
			</code>
		</div>
	</div>
</body>
</html>