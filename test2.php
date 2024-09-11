<?php 
session_start();
echo var_dump($_SESSION['modulos']);
echo var_dump($_SESSION['arrModulos']);
/*
$data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    $uuid =  vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    echo $uuid.'<br>';
    echo "otro uid<br>";
    $uuidv4 =  sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
    // 32 bits for "time_low"
    mt_rand(0, 0xffff), mt_rand(0, 0xffff),
    // 16 bits for "time_mid"
    mt_rand(0, 0xffff),
    // 16 bits for "time_hi_and_version",
    // four most significant bits holds version number 4
    mt_rand(0, 0x0fff) | 0x4000,
    // 16 bits, 8 bits for "clk_seq_hi_res",
    // 8 bits for "clk_seq_low",
    // two most significant bits holds zero and one for variant DCE1.1
    mt_rand(0, 0x3fff) | 0x8000,
    // 48 bits for "node"
    mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
    echo $uuidv4;
    */
    //$json = file_get_contents('php://input');
    //$data = json_decode($json);
    //echo var_dump(count($data));

?>