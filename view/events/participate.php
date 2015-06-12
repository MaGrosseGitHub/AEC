<?php 
	if(empty($this->Form->errors)) {
		$reponse['confirm'] = "Partcipation enregistré.";
		$reponse['count'] = $Participation;

		echo json_encode($reponse);
	} else {
		echo json_encode($this->Form->errors);
	}

?>