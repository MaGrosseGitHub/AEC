<?php header("Content-Type: application/rss+xml; charset=ISO-8859-1");
// <link rel="alternate" href="/feed/" title="My RSS feed" type="application/rss+xml" />
ob_start();
echo '<?xml version="1.0" encoding="ISO-8859-1" ?>'; ?>
<rss version="2.0">
		<channel>
			<title>FRMALS</title>
			<link>http://www.copyleft-stories.net84.net/main.php</link>
			<description>Flux RSS du site dela fédération royale marocaine d'aviation légére et sportive</description>
    		<language>fr-ma</language>';
			
			<?php
		
      	foreach ($posts as $k => $v): 
			echo '<item>';
	        echo "<title>$v->name</title>"; 
			echo "<link>". Router::url("posts/view/id:{$v->id}/slug:$v->slug") ."</link>";
			echo "<description><![CDATA[ ".substr(strip_tags($v->content),0,300)." ]]></description>";
			echo "<pubDate>".date('D, d M Y H:i:s',$v->created)."</pubDate>";
			echo '</item>';
		endforeach;
		
		?>
	
		</channel>
</rss>
<?php 
	$getFux = ob_get_clean(); 
	echo $getFux;
	$file = "cache/flux.xml";
	$handle = fopen($file, 'w');
	fwrite($handle, $getFux);
	fclose($handle);
	$this->redirect("cache/flux.xml");
 ?>