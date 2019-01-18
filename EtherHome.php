<?php

require_once "vendor/autoload.php";

use Sop\CryptoTypes\Asymmetric\EC\ECPublicKey;
use Sop\CryptoTypes\Asymmetric\EC\ECPrivateKey;
use Sop\CryptoEncoding\PEM;
use kornrunner\keccak;

function ETHWALLET(){
$walletInfo=array();

$curve_names = openssl_get_curve_names();

$config = [
    'private_key_type' => OPENSSL_KEYTYPE_EC,
    'curve_name' => $curve_names[10],
];

$res = openssl_pkey_new($config);


if (!$res) {
    echo 'ERROR: Fail to generate private key. -> ' . openssl_error_string();
    exit;
}

// Generate Private Key
openssl_pkey_export($res, $priv_key);

// Get The Public Key
 $key_detail = openssl_pkey_get_details($res);
$pub_key = $key_detail["key"];


$priv_pem = PEM::fromString($priv_key);

// Convert to Elliptic Curve Private Key Format
$ec_priv_key = ECPrivateKey::fromPEM($priv_pem);

// Then convert it to ASN1 Structure
$ec_priv_seq = $ec_priv_key->toASN1();

// Private Key & Public Key in HEX
$priv_key_hex = bin2hex($ec_priv_seq->at(1)->asOctetString()->string());
$priv_key_len = strlen($priv_key_hex) / 2;
$pub_key_hex = bin2hex($ec_priv_seq->at(3)->asTagged()->asExplicit()->asBitString()->string());
$pub_key_len = strlen($pub_key_hex) / 2;

// Derive the Ethereum Address from public key
// Every EC public key will always start with 0x04,
// we need to remove the leading 0x04 in order to hash it correctly
$pub_key_hex_2 = substr($pub_key_hex, 2);
$pub_key_len_2 = strlen($pub_key_hex_2) / 2;

// Hash time
$hash = Keccak::hash(hex2bin($pub_key_hex_2), 256);

// Ethereum address has 20 bytes length. (40 hex characters long)
// We only need the last 20 bytes as Ethereum address
$wallet_address = '0x' . substr($hash, -40);
$wallet_private_key = '0x' . $priv_key_hex;

$walletInfo[]=$wallet_address;
$walletInfo[]=$wallet_private_key;

return $walletInfo;
}


