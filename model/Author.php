<?php
class Author extends Model{

	var $validate = array(
		'firstName' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un prénom'
		),
		'lastName' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un nom'
		),
		'bio_FR' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser une bio (FR)'
		),
		'bio_EN' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser une bio (EN)'
		)
	);


}