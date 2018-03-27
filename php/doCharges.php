
<?php

require_once 'Openpay/vendor/autoload.php';
require_once 'Openpay/vendor/openpay/sdk/Openpay.php';

$openpay = Openpay::getInstance('mrv6ym9ykolrdz86rluf', 
  'sk_585f0b135c5748e9ba345bc94561bfd7');

$customer = array(
     'name' => "Leslie",
     'last_name' => "La bluthor",
     'phone_number' => "6692524959",
     'email' => "luisfelipe.osuna@outlook.com");

$chargeData = array(
    'method' => 'card',
    'source_id' => $_POST["token_id"],
    'amount' => 99500,
    'description' => "Hola prros",
    'device_session_id' => $_POST["deviceIdHiddenFieldName"],
    'customer' => $customer);

try{
    $charge = $openpay->charges->create($chargeData);    
}catch (Exception $e){
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}


?>