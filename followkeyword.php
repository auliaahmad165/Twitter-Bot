<?php

session_start();
require_once('twitteroauth/twitteroauth.php');

define('CONSUMER_KEY', 'CHANGE YOUR CONSUMER KEY');
define('CONSUMER_SECRET', 'CHANGE YOUR CONSUMER SECRET');
define('access_token', 'CHANGE YOUR ACCESS TOKEN');
define('access_token_secret', 'CHANGE YOUR ACCESS TOKEN SECRET');

$jumlah = "1";
$type = "recent";

function randomline( $target )
{
    $lines = file( $target );
    return $lines[array_rand( $lines )];
}
$target = randomline('target.txt');
$koneksi = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
$nasi = $koneksi->get('search/tweets', array('q' => $target,  'count' => $jumlah, 'result_type' => $type));
$statuses = $nasi->statuses;
foreach($statuses as $status)
{
$username = $status->user->screen_name;
$eksekusi = $koneksi->post('friendships/create', array('screen_name' => $username));
if($eksekusi->errors) {
echo "<center>Failed, you have reached the limit.</center>";
}
else {
echo "<center>Successfully following $username </center>";
}
}
?>
