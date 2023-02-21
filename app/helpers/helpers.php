<?php
function customCrypt($vWord){
    $customKey = "y/B?E(H+MbPeShVmYq3t6w9zXC&F)J@N"; 
    $newEncrypter = new \Illuminate\Encryption\Encrypter( $customKey, Config::get( 'app.cipher' ) );
    return $newEncrypter->encrypt( $vWord );
}

function customDecrypt($vWord){
    $customKey = "y/B?E(H+MbPeShVmYq3t6w9zXC&F)J@N";
    $newEncrypter = new \Illuminate\Encryption\Encrypter( $customKey, Config::get( 'app.cipher' ) );
    return $newEncrypter->decrypt( $vWord );
}


function getUserIp(){
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                $ip_address = $ip;
            }
        } else {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED'];
    } elseif (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
    } elseif (!empty($_SERVER['HTTP_FORWARDED'])) {
        $ip_address = $_SERVER['HTTP_FORWARDED'];
    } else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    if($ip_address == "::1"){
        $ip_address = "127.0.0.1";
    }
    return $ip_address;
}



function notific8($message) {
    $messages = [
        'errors' => [
            $message
        ]
    ];
    $messagebag = new \Illuminate\Support\MessageBag($messages);
    return $messagebag;
}

function flash($title = null, $message = null) {
    // Set variable $flash to fetch the Flash Class
    // in Flash.php
    $flash = app('App\Http\Flash');

    // If 0 parameters are passed in ($title, $message)
    // then just return the flash instance.
    if (func_num_args() == 0) {
        return $flash;
    }

    // Just return a regular flash->info message
    return $flash->info($title, $message);
}

