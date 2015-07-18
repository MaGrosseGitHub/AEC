<?php
class Post extends Model{

	var $validate = array(
		'title_FR' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un titre FR'
		),
		'title_EN' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un titre EN'
		),
		'content_FR' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un contenu FR'
		),
		'content_EN' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un contenu EN'
		)
	);


}