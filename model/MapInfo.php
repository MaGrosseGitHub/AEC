<?php
class MapInfo extends Model{

	var $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un titre'
		),
		'content' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un titre'
		),
		'category_id' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un titre'
		)
	);


}