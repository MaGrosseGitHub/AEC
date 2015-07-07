<?php 
/**
* Google URL shorten API
* @version API V1
*/
class UrlShortener
{
 /**
  * API URL
  * @var string
  */
 private $apiURL = 'https://www.googleapis.com/urlshortener/v1/url';

 /**
  * Google URL shorten Constructor
  * @param string $apiKey
  * @return void
  */
 function __construct($apiKey)
 {
  # API URL with API keys
  $this->apiURL = $this->apiURL . '?key=' . $apiKey;
 }

 /**
  * Short Long URL
  * @param string $url as long URL
  * @return string as short URL or void
  */
 public function encode($url)
 {
  $data = $this->cURL($url, true);
  return isset($data->id) ? $data->id : '' ;
 }

 /**
  * Extend Short URL
  * @param string $url as short URL
  * @return string as as long URL or void 
  */
 public function decode($url)
 {
  $data = $this->cURL($url, false);
  return isset($data->longUrl) ? $data->longUrl : '' ;
 }

 /**
  * Send cURL Request
  * @param string $url
  * @param bool $post
  * @return object
  */
 private function cURL($url, $post = true)
 {
  # create cURL
  $ch = curl_init();
  # POST request for URL shorten
  if ($post) {
   curl_setopt( $ch, CURLOPT_URL, $this->apiURL );
   # set header content type for json
   curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json') );
   # set request method post
   curl_setopt( $ch, CURLOPT_POST, true );
   # send json encoded request
   curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode(array('longUrl' => $url)) );
  }
  # GET request for URL extend
  else {
   curl_setopt( $ch, CURLOPT_URL, $this->apiURL . '&shortUrl=' . $url );
  }
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  #curl_setopt( $ch, CURLOPT_BINARYTRANSFER, true );
  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
  # execute curl request
  $json = curl_exec($ch);
  # close cURL connection
  curl_close($ch);
  # return response as object
  return (object) json_decode($json);
 }
}

?>