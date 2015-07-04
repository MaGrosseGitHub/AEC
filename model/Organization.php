<?php
class Organization extends Model{

	var $validate = array(
		'firstName' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un prénom'
		),
		'lastName' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un prénom'
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