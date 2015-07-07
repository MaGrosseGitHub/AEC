<?php
class Event extends Model{

	var $validate = array(
		'fromDate' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un titre'
		),
		'toDate' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un titre'
		)
	);


}