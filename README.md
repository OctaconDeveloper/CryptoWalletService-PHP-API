# CryptoWalletService PHP API
A server side PHP API for te generation of Bitcoin,Ethereum,Litecoin Dashcoin, Dodge Coin and FetherCoin without saving the private keys on any db.
can be incorporated into any PHP Project...
The API can called for non PHP project, the data can be retrieved in a JSON aray

API call can be made using the url

api.php?id

Follwed by the coin ticker
for example of Ethereum

api.php?id=ETH

result given in JSON Array

{"status":"Ok","data":{"CoinName":"ETH","Public Address":"0x30d25ccceefc08b709727d181e1dcea351be10d7","Private Key":"0x8551daadf35d3295715af4e97afe2ff93ab9d4fd79a11bc660e57260d0d7be50"}}

address and private keys not stored and dynamically generated
