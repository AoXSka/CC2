<?php

/*
|--------------------------------------------------------------------------
| Bot Token
|--------------------------------------------------------------------------
|
| Change this to your Bot API Token
| It can be obtained from https://telegram.dog/BotFather
|
*/
// TEMPORAL
$config['botToken'] = '5825102395:AAHVOjQCJ0FKX3x9uxlOOUWFEY4Mjp62F7A';
//OrIGINAL
// $config['botToken'] = '5953976239:AAHctS7FPzCJMP8fE8W6ef98PT6vhWaezOk';

/*
|--------------------------------------------------------------------------
| Admin User ID
|--------------------------------------------------------------------------
|
| Change this to Admin's Numeric User ID
| ID can be obtained from https://telegram.dog/username_to_id_bot
|
*/
$config['adminID'] = '681184796';

/*
|--------------------------------------------------------------------------
| Logs Channel ID
|--------------------------------------------------------------------------
|
| Create a New Channel/Group for logging data
| ID can be obtained from https://telegram.dog/BotFather
|
*/
//     $config['logsID'] =  $_ENV['LOGS_DUMP_ID'];

/*
|--------------------------------------------------------------------------
| Timezone
|--------------------------------------------------------------------------
|
| Current timezone for Logging Activities with time
| It can be obtained from http://1min.in/content/international/time-zones
| By Default it's in IST
|
*/
$config['timeZone'] =  'America/Tegucigalpa';

/*
|--------------------------------------------------------------------------
| Database
|--------------------------------------------------------------------------
| Database to Store User Data
|
*/
$config['db']['hostname'] =  'sql9.freesqldatabase.com';
$config['db']['username'] =  'sql9579183';
$config['db']['password'] =  'yyK6F2aLQD';
$config['db']['database'] =  'sql9579183';

/*
|--------------------------------------------------------------------------
| Anti-Spam Timer
|--------------------------------------------------------------------------
|
| Anti-Spam Timer to prevent Spammers from Spamming the Checker
| Value is in Seconds. "20" = 20seconds
|
*/
$config['anti_spam_timer'] =  '20';

/*
|--------------------------------------------------------------------------
| SK Keys
|--------------------------------------------------------------------------
|
| SK Keys for !sm checker gate
| Add a Live SK Key here. You can Also add Multiple SK Keys
| array('sk1','sk2','sk3')
|
*/
$config['sk_keys'] =  explode(",", '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');
?>
