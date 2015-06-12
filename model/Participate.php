<?php
class Participate extends Model{

	var $validate = array(
		'nom' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un titre'
		),
		'prenom' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un titre'
		)
	);


}