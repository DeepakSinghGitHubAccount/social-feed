<a href="https://api.instagram.com/oauth/authorize/?client_id=87f00f490e9a471b930ed9641250c5f0&redirect_uri=http://localhost/a_A_sara/insta/ins.php&response_type=code&scope=basic+public_content+follower_list+comments+relationships+likes">ff</a>

<?php



$url = "https://api.instagram.com/oauth/access_token";
$code = $_GET['code'];
$access_token_parameters = array(
    'client_id'                =>     '87f00f490e9a471b930ed9641250c5f0',
    'client_secret'            =>     '2cc0cf75d44b4a2bbf07b9b97f409e76',
    'grant_type'               =>     'authorization_code',
    'redirect_uri'             =>     'http://localhost/a_A_sara/insta/ins.php',
    'code'                     =>     $code
);
$curl = curl_init($url);    // we init curl by passing the url
curl_setopt($curl,CURLOPT_POST,true);   // to send a POST request
curl_setopt($curl,CURLOPT_POSTFIELDS,$access_token_parameters);   // indicate the data to send
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   // to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   // to stop cURL from verifying the peer's certificate.
$result = curl_exec($curl);   // to perform the curl session
curl_close($curl);   // to close the curl session

$user_data = json_decode($result,true);

echo "<pre>";
print_r($user_data);



function rudr_instagram_api_curl_connect( $api_url ){
	$connection_c = curl_init(); // initializing
	curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
	curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
	curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
	$json_return = curl_exec( $connection_c ); // connect and get json data
	curl_close( $connection_c ); // close connection
	return json_decode( $json_return ); // decode and return
}



$access_token = $user_data['access_token'];
$tag = 'deepa';
$return = rudr_instagram_api_curl_connect('https://api.instagram.com/v1/self/media/recent?access_token='. $access_token);
 
var_dump( $return ); // if you want to display everything the function returns
 
foreach ( $return->data as $post ) {
	echo '<a href="' . $post->images->standard_resolution->url . '" class="fancybox"><img src="' . $post->images->thumbnail->url . '" /></a>';
	/*
	$post->images->standard_resolution->url - URL of 612x612 image
	$post->images->low_resolution->url - URL of 150x150 image
	$post->images->thumbnail->url - URL of 306x306 image
 
	$post->type - "image" or "video"
	$post->videos->low_resolution->url - URL of 480x480 video
	$post->videos->standard_resolution->url - URL of 640x640 video
 
	$post->link - URL of an Instagram post
	$post->tags - array of assigned tags
	$post->id - Instagram post ID
	$post->filter - photo filter
	$post->likes->count - the number of likes to this photo
	$post->comments->count - the number of comments
	$post->caption->text
	$post->created_time
 
	$post->user->username
	$post->user->profile_picture
	$post->user->id
 
	$post->location->latitude
	$post->location->longitude
	$post->location->street_address
	$post->location->name
	*/
 
}


?>