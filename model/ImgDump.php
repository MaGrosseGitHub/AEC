<?php
class ImgDump extends Model{

	var $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'Vous devez préciser un nom de fichier'
		),
		'extension' => array(
			'rule' => array('jpg', 'jpeg', 'png', 'gif', 'ico'),
			'message' => 'Mauvaise extension de fichier'
		)
	);


}