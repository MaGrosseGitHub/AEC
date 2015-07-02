<?php
class Contact extends Model{

	var $validate = array(
		'email' => array(
			'rule' => 'email',
			'message' => 'Vous devez préciser un email valide'
		)
	);


}