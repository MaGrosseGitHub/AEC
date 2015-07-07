<?php
class Form{
	
	public $controller; 
	public $errors; 
	public $required = false;
	public $checkWJS = true;
	public $checkInputsRules;
	public $checkInputsMsgs;

	public function __construct($controller){
		$this->controller = $controller; 
	}

	private function JSPrepare($name, $type, $rule = null, $message = null){
		ob_start();
		echo 'input'.$name.': {';		
		if(!empty($rule)){
			echo $rule.',';
		}
		echo 		"required: true";
		if($type == "text" || $type == "password"){
			echo 	",minlength: 3";
		} elseif($type == "email"){
			echo 	",email : true";
		}
		echo "}";
		$JSRules = ob_get_clean();
		if(empty($this->checkInputsRules)){
			$this->checkInputsRules = $JSRules;
		} else{
			$this->checkInputsRules = $this->checkInputsRules.','.$JSRules;
		}

		if(!empty($message)){
			ob_start();
			echo 'input'.$name.': '.$message;
			$JSMsgs = ob_get_clean();
			if(empty($this->checkInputsMsgs)){
				$this->checkInputsMsgs = $JSMsgs;
			} else{
				$this->checkInputsMsgs = $this->checkInputsMsgs.','.$JSMsgs;
			}
		}
	}

	public function JSCheck($form){
		ob_start();
		echo "$('.$form').validate({";
		$this->checkInputsRules = "rules: {".$this->checkInputsRules."}";
		$this->checkInputsMsgs = ", messages: {".$this->checkInputsMsgs."}";
		echo $this->checkInputsRules;
		echo $this->checkInputsMsgs;
		echo "});";
		$JSCheck = ob_get_clean();

		debug($JSCheck);
		return $JSCheck;
	}

	public function ToggleJSCheck($check = boolean){
		$this->checkWJS = $check;
	}

	public function input($name,$label,$options = array(), $checkJS = true){
		if($this->required || $options['required']) {
			$requiredData = "required";
		} else {
			$requiredData = "";
		}

		if($requiredData == "required" && $this->checkWJS)

		$error = false; 
		$classError = ''; 
		if(isset($this->errors[$name])){
			$error = $this->errors[$name];
			$classError = ' error'; 
		}
		if ( !isset( $this->controller->request->data->$name ) ) {
			$value = ''; 
		} else {
			$value = $this->controller->request->data->$name; 
			if(isset($options['class']) && preg_match("#timestamp#", $options['class'])) {
				if(isValidTimeStamp($value)) {
					$value = date("d-m-Y",$value);
				}
			}
		}

		if ( isset($options['inputValue'] ) ) {
			$value = $options['inputValue'];
		} 

		if ( isset($options['class'] ) ) {
			$class = 'class = "'.$options['class'].'"';
		} else {
			$class = "";
		}

		if($label == 'hidden'){
			return '<input type="hidden" name="'.$name.'" value="'.$value.'">'; 
		}
		// $html = '
		// 			<label for="input'.$name.'">'.$label.'</label>
		// 			';
		
		$html = '<div class="clearfix'.$classError.'">
					<label for="input'.$name.'">'.$label.'</label>
					<div class="input">';			
		$attr = ' '; 
		foreach($options as $k=>$v){ 
			if($k!='type' && $k != "inputValue"){
				if(!is_array($v)){
					$attr .= " $k=\"$v\""; 
				}
			}
		}
		if(!isset($options['type']) && !isset($options['options'])){
			$html .= '<input '.$class.' type="text" id="input'.$name.'" name="'.$name.'" '.$requiredData.' value="'.$value.'"'.$attr.'>';
			$options['type'] = "text";
		}elseif(isset($options['options'])){
			$html .= '<select '.$class.' id="input'.$name.'" name="'.$name.'">';
			foreach($options['options'] as $k=>$v){
				$html .= '<option value="'.$k.'" '.($k==$value?'selected':'').'>'.$v.'</option>'; 
			}
			$html .= '</select>'; 
			$options['type'] = "select";
		}elseif($options['type'] == 'email'){
			$html .= '<input '.$class.' type="email" id="input'.$name.'" name="'.$name.'" '.$requiredData.' value="'.$value.'"'.$attr.'>';
		}elseif($options['type'] == 'textarea'){
			$html .= '<textarea id="input'.$name.'" '.$requiredData.' name="'.$name.'"'.$attr.'>'.$value.'</textarea>';
		}elseif($options['type'] == 'checkbox'){
			$html .= '<input type="hidden" id ="'.$name.'" name="'.$name.'" value="0"><input '.$class.' type="checkbox" id ="'.$name.'" name="'.$name.'" value="1" '.(empty($value)?'':'checked').'>'; 
		}elseif($options['type'] == 'file'){
			$html .= '<input type="file" class="input-file '.$class.'" id="input'.$name.'" name="'.$name.'"'.$attr.'>';
		}elseif($options['type'] == 'password'){
			$html .= '<input '.$class.' type="password" id="input'.$name.'" '.$requiredData.' name="'.$name.'" value="'.$value.'"'.$attr.'>';
		}
		if($error){
			$html .= '<span class="help-inline '.$class.'">'.$error.'</span>';
		}
		$html .= '</div></div>';

		if($checkJS && !$this->required){
			$checkRule = null; $checkMsg = null;
			if(isset($options['rule'])){
				$checkRule = $options['rule'];
			}
			if(isset($options['message'])){
				$checkMsg = $options['message'];
			}
			$this->JSPrepare($name, $options['type'], $checkRule, $checkMsg);
		}

		if($options['required']){
			$requiredData = "";
		}
		
		return $html; 
	}

}