<?php

require_once('twitteroauth/twitteroauth.php');

define('CONSUMER_KEY', 'CHANGE YOUR CONSUMER KEY');
define('CONSUMER_SECRET', 'CHANGE YOUR CONSUMER SECRET');
define('access_token', 'CHANGE YOUR ACCESS TOKEN');
define('access_token_secret', 'CHANGE YOUR ACCESS TOKEN SECRET');

        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, access_token, access_token_secret);
	        $followers = $connection->get("followers/ids.json?cursor=-1&");
	         $friends = $connection->get("friends/ids.json?cursor=-1&");
	          $fullfriend=batim($friends);
                   $fullfollower=batim($followers); 
 $index = 1;
    $unfollow_total=0;

$all_friends = $fullfriend['ids'];
$all_followers = $fullfollower['ids'];
foreach( $all_friends as $iFollow )
    {
    $isFollowing = in_array( $iFollow, $all_followers );
	           echo "$iFollow: ".( $isFollowing ? 'OK' : '!!!' )."<br/>";
    $index++;
     if( !$isFollowing )
        {
        $parameters = array( 'user_id' => $iFollow );
        $status = $connection->post('friendships/destroy', $parameters);
        $unfollow_total++;
        } if ($unfollow_total === 999) break;
    }
                    function batim($d) {
		   if (is_object($d)) {
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {

			return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
	}
