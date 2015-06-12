<?php
class Conf{
	
	static $debug = 1; 

	static $databases = array(

		'default' => array(
			'host'		=> 'localhost',
			'database'	=> 'tuto',
			'login'		=> 'root',
			'password'	=> ''
		)
	);

	static $disqusAccount = 'scribble999656';


}

Router::prefix('cockpit','admin');
Router::prefix('lookFor','include');
Router::prefix('fetch','cockpitInc');


Router::connect('','posts/index');
Router::connect('lookFor_blog','lookFor/posts');
Router::connect('lookFor_blog/user/*','lookFor/posts/index/*');
Router::connect('lookFor_blog/:slug-:id','lookFor/posts/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect('blog/:slug-:id','posts/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect('blog/user/*','posts/index/*');
Router::connect('blog/category/:slug','posts/category/slug:([a-z0-9\-]+)');
Router::connect('blog/*','posts/*');

Router::connect('medias/','medias/index');
Router::connect('lookFor_medias','lookFor/medias');
Router::connect('media/view/:slug-:id','medias/view/id:([0-9]+)/slug:([a-zA-Z0-9\-_! ]+)');
Router::connect('lookFor_media/:slug-:id','lookFor/medias/view/id:([0-9]+)/slug:([a-zA-Z0-9\-_! ]+)');

Router::connect('events/','events/index');
Router::connect('event/:slug-:id','events/event/id:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect('events/user/*','events/view/*');
Router::connect('lookFor_event/:slug-:id','lookFor/events/event/id:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect('lookFor_event/*','lookFor/events/event/*');

Router::connect('maps/','maps/index');
Router::connect('contact/','contact/index');
Router::connect('page/:slug-:id','pages/view/id:([0-9]+)/slug:([a-z0-9\-]+)');

Router::connect('cockpit','cockpit/posts/index');
