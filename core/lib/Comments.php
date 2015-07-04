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

	public static function RSS($ctrl){
		ob_clean();
		header('Content-Type: text/xml');
		echo '<?xml version="1.0" encoding="UTF-8"?>
			<rss version="2.0">
			<channel>
			<title>My Website Name</title>
			<description>A description of the feed</description>
			<link>The URL to the website</link>';

			$ctrl->loadModel('Post');
			$condition = array('online' => 1,'type'=>'post', 'social_online'=>0);
			$fields = ['id', 'title_FR', 'content_FR', 'slug', 'user_id', 'category_id'];
			$fields = implode(",", $fields);
			$options = array(
				'conditions' => $condition,
				'fields' => $fields,
				'order'      => 'created DESC'
			);

			$posts = $ctrl->Post->find($options);

			foreach ($posts as $k => $v){	      
			    echo '
			       <item>
			          <title>'.$v->title_FR.'</title>
			          <description><![CDATA[
			          '.$v->content_FR.'
			          ]]></description>
			          <link>http://www.mysite.com/article.php?id='.$v->id.$v->slug.'</link>
			          <pubDate>'.date("Y-m-d", time()).' GMT</pubDate>
			      </item>';
			}

		echo '</channel>
			</rss>';
		die();
	}
}
?>