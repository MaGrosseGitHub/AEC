<?php 

class Comments{

	public $url, $slug, $id, $disqusAccount;

	function __construct($comments = array(), $share = array(), $OnlyNbComments = false, $NbCommentsElem = null) {

		$commentsDefault = array('id' => null, 'slug' => null, 'url' => curPageURL(true));
		$comments = array_merge($commentsDefault, $comments);

		$shareDefault = array('url' => curPageURL(), 'text' => 'Frmals', 'shorten' => false, 'options' => array(), 'separation' => ' ');
		$share = array_merge($shareDefault, $share);

		$this->disqusAccount = Conf::$disqusAccount;
		$this->url = isset($comments['url']) ? $comments['url'] : '';
		$this->slug = isset($comments['slug']) ? $comments['slug'] : '';
		$this->id = isset($comments['id']) ? $comments['id'] : '';
		
		// echo $this->NbComments($NbCommentsElem);
		if(!$OnlyNbComments){
			$shareOptions = $this->Share($share['url'],$share['text'],$share['shorten'],$share['options'], $share['separation']);
			echo $shareOptions;
			// $commentsScript = $this->addComments();
			// echo $commentsScript;
		}
	}

	public function Share($url, $text, $shorten = true, $options = array(), $shareSeparation = ' '){
		if($shorten){
			$bitly = new Bitly();
			$url = $bitly->shorten($url);
			$url = $url['url'];
			// $this->bitly->shorten('http://blog.verkoyen.eu');
			// $response = $this->bitly->clicks('http://bit.ly/aHA6Dx');
			// $response = $this->bitly->expand('http://bit.ly/aHA6Dx');
			// $response = $this->bitly->validate($login, $apiKey);
			// $response = $this->bitly->isProDomain('ntl.sh');
		}

		$defaultOptions = array(
							'toolbar' => 0,
							'status' => 0,
							'width' => '480',
							'height' => '420'
						);
		$options = array_merge($defaultOptions, $options);
		$optionsJS = 'toolbar='.$options['toolbar'].',status='.$options['status'].',width='.$options['width'].',height='.$options['height'].'';

		$facebook = '<a target = "_blank" onclick="window.open(this.href,\'shareFrmalsFb\',\''.$optionsJS.'\');" href="http://www.facebook.com/sharer.php?u='.$url.'">Partage facebook</a>';
		$twitter = '<a target = "_blank" onclick="window.open(this.href,\'shareFrmalsT\',\''.$optionsJS.'\');" href="http://www.twitter.com/share?url='.$url.'&text='.$text.'">Partage twitter</a>';
		$google = '<a target = "_blank" onclick="window.open(this.href,\'shareFrmalsG\',\''.$optionsJS.'\');" href="https://plus.google.com/share?url='.$url.'">Partage google+</a>';

		$fbShare = '<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=273754796021273";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, \'script\', \'facebook-jssdk\'));</script>
					<div class="fb-like" data-href="'.$url.'" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>';
		$shareArray = array($facebook, $twitter, $google, $fbShare);

		return implode($shareSeparation, $shareArray);
	}

	public function follow(){

	}

	public function NbComments($element = null, $options = array()){
		$optionsDefault = array('id' => $this->id, 'slug' => $this->slug);
		$options = array_merge($optionsDefault, $options);

		if(!isset($element)){
			$link = curPageURL();
			$link = str_replace("lookFor_", "", $link);
		} else{
			$link = Router::url("$element/id:".$options['id']."/slug:".$options['slug']."");
		}

		/* <!-- <a href="http://example.com/article1.html#disqus_thread" data-disqus-identifier="article_1_identifier">First article</a> --> */
		return '<a class = "nbComments" href="'.$link.'#disqus_thread">NbComments</a>';
	}

	public function addComments() {
		if(!empty($this->url)){
			$disqus_url = str_replace("lookFor_", "", $this->url);
			$disqus_url = "window.location.origin+'$disqus_url'";
		}else{
			$disqus_url = "";
		}

		if(!empty($this->id)){
			$disqus_id = "p_".$this->id;
		}else{
			$disqus_id = "";
		}
		// debug($disqus_url);
		// debug($disqus_id);
		$script = "<div id=\"disqus_thread\"></div>
	    <script type=\"text/javascript\">
	    	// var disqusUrl = window.location.origin+'$this->url';
	    	// console.log(disqusUrl);
	        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
	        var disqus_shortname = '$this->disqusAccount'; // required: replace example with your forum shortname
		    //var disqus_identifier = '$disqus_id';
		    // var disqus_title = '$this->slug';
		    // var disqus_url = $disqus_url;
		    // console.log(checkUrl.length);
		    // if(checkUrl.length != 0){
		    // 	disqus_url = checkUrl;
		    // 	// console.log(disqus_url);
		    // }

	        /* * * DON'T EDIT BELOW THIS LINE * * */
	        (function() {
	            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
	            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
	            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	        })();

		    /* * * DON'T EDIT BELOW THIS LINE * * */
		    (function () {
		        var s = document.createElement('script'); s.async = true;
		        s.type = 'text/javascript';
		        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
		        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
		    }());
	    </script>";

	    return $script;
	}

	public static function RSS($ctrl, $data){
		ob_clean();
		header('Content-Type: text/xml');
		echo '<?xml version="1.0" encoding="UTF-8"?>
			<rss version="2.0">
			<channel>
			<title>My Website Name</title>
			<description>A description of the feed</description>
			<link>The URL to the website</link>';
			foreach ($data['stream'] as $k => $v){	      
				echo '
				<item>
					<title>'.$v->$data['fields']['title'].'</title>
					<description><![CDATA[
					'.$v->$data['fields']['description'].'
					]]></description>';
					if(!is_array($data['fields']['link']))
						if(isset($v->$data['fields']['link']))
							echo '<link>'.Router::url($v->$data['fields']['link']).'</link>';
						else
							echo '<link>'.Router::url($data['fields']['link']).'</link>';
						// echo '<link>http://www.mysite.com/article.php?id='.$link.'</link>';
					else {
						$link = "";
						foreach ($data['fields']['link'] as $field => $fValue) {
							if(isset($v->$fValue))
								$link .= $v->$fValue;
							else
								$link .= $fValue;
						}
						echo '<link>'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].Router::url($link).'</link>';
					}
					if(!is_array($data['fields']['pubDate']))
						echo '<pubDate>'.$v->$data['fields']['pubDate'].' GMT</pubDate>';
					else
						echo '<pubDate>'.date($data['fields']['pubDate']['format'], $v->$data['fields']['pubDate']['field']).' GMT</pubDate>';
				echo '</item>';
			}

		echo '</channel>
			</rss>';
		die();
	}

	private static function GetNbOfShares(){
		
      $fql  = "SELECT url, normalized_url, share_count, like_count, comment_count, ";
      $fql .= "total_count, commentsbox_count, comments_fbid, click_count FROM ";
      $fql .= "link_stat WHERE url = 'www.apple.com'";

      $apifql="https://api.facebook.com/method/fql.query?format=json&query=".urlencode($fql);
      $json=file_get_contents($apifql);
      debug( json_decode($json)); //Facebook

      $twitterLink = "http://urls.api.twitter.com/1/urls/count.json?url=www.apple.com";
      $twitterNB = file_get_contents($twitterLink);
      debug( json_decode($twitterNB)); //Twitter

      $url = 'http://apple.com';
      $gplus_type = true ? 'shares' : '+1s';

      /**
       * Get Google+ shares or +1's.
       * See out post at stackoverflow.com/a/23088544/328272
       */
      function get_gplus_count($url, $type = 'shares') {
        $curl = curl_init();

        // According to stackoverflow.com/a/7321638/328272 we should use certificates
        // to connect through SSL, but they also offer the following easier solution.
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if ($type == 'shares') {
          // Use the default developer key AIzaSyCKSbrvQasunBoV16zDH9R33D88CeLr9gQ, see
          // tomanthony.co.uk/blog/google_plus_one_button_seo_count_api.
          curl_setopt($curl, CURLOPT_URL, 'https://clients6.google.com/rpc?key=AIzaSyCKSbrvQasunBoV16zDH9R33D88CeLr9gQ');
          curl_setopt($curl, CURLOPT_POST, 1);
          curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
          curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        }
        elseif ($type == '+1s') {
          curl_setopt($curl, CURLOPT_URL, 'https://plusone.google.com/_/+1/fastbutton?url='.urlencode($url));
        }
        else {
          throw new Exception('No $type defined, possible values are "shares" and "+1s".');
        }

        $curl_result = curl_exec($curl);
        curl_close($curl);

        if ($type == 'shares') {
          $json = json_decode($curl_result, true);
          return intval($json[0]['result']['metadata']['globalCounts']['count']);
        }
        elseif ($type == '+1s') {
          libxml_use_internal_errors(true);
          $doc = new DOMDocument();
          $doc->loadHTML($curl_result);
          $counter=$doc->getElementById('aggregateCount');
          return $counter->nodeValue;
        }
      }

      // Get Google+ count.
      $gplus_count = get_gplus_count($url, $gplus_type);
      debug($gplus_count); //Google+
	}
}
?>