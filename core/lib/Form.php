<?php
class Form{
	
	public $controller; 
	public $errors; 
	private $required = false;
	private $checkWJS = true;
	private static $formIds = array();

	public $addAsterisk = false;

	public function __construct($controller){
		$this->controller = $controller; 
	}

	public function ToggleJSCheck($check = boolean){
		$this->checkWJS = $check;
	}

	public function ToggleRequired($check = boolean){
		$this->required = $check;
	}

	public function JSCheck($form, $type = "id"){
		if($type == "id"){
			$form =  "$('#$form').validationEngine()";
		} elseif($type == "class"){
			$form =  "$('.$form').validationEngine()";
		}
		array_push(self::$formIds, $form);
	}

	public function JSFlush(){
		if(!empty(self::$formIds)){
			$JSQuery = '<script type="text/javascript"> $(document).ready(function(){  ';
			$JSQuery .= implode("; ", self::$formIds);
			if(count(self::$formIds) == 1){
				$JSQuery .= ';';
			}
			$JSQuery .= ' }); </script>';
			return $JSQuery;
		} else {
			return false;
		}
	}

	public function input($name,$label,$options = array(), $checkJS = true){
		if($this->required || (isset($options['required']) && $options['required'])) {
			$requiredData = "required";
		} else {
			$requiredData = "";
		}

		$error = false; 
		$dateSkip = false; 
		$classError = ''; 
		$placeHolder = "";

		if(isset($this->errors[$name])){
			$error = $this->errors[$name];
			$classError = ' error'; 
		}
		if ( !isset( $this->controller->request->data->$name ) ) {
			$value = ''; 
		} else {
			$value = $this->controller->request->data->$name; 
			if(isset($options['dateSkip']) && $options['dateSkip']){
				$dateSkip = true; //don't show date input if it doesn't need to be changed
			}
			if(isset($options['class']) && preg_match("#timestamp#", $options['class'])) {
				if(isValidTimeStamp($value)) {
					$value = date("d-m-Y",$value);
				} else{
					$value = "";
				}
			}
		} 

		if(isset($options['placeHolder'])){
			if(is_bool($options['placeHolder']) && $options['placeHolder']){
				$placeHolder = $label;
			} else {
				$placeHolder = $options['placeHolder'];
			}
		}

		if($dateSkip){
			$label = 'hidden';
		}

		if ( isset($options['inputValue'] ) ) {
			$value = $options['inputValue'];
		} 

		if ( isset($options['class'] ) ) {
			$class = 'class = "form-control '.$options['class'].'';
		} else {
			$class = 'class = "form-control ';
		}	

		// if($this->required || (isset($options['required']) && $options['required'])) {
		// 	$class .= "required";
		// }	

		if($label == 'hidden'){
			return '<input id = "input'.$name.'" type="hidden" name="'.$name.'" value="'.$value.'">'; 
		}

		if(isset($options['phOnly']) && $options['phOnly'] && (!isset($options['placeHolder']) || (isset($options['placeHolder']) && $options['placeHolder']))){
			// if $options['phOnly'] detected and true (1)
			// and $options['placeHolder'] not detected (2)
			// or $options['placeHolder'] detected and true (3)
			$placeHolder = $label;
		}
		
		$html = '<div class="clearfix control-group'.$classError.'">';
		if(!isset($options['phOnly']) || !$options['phOnly'])
			$html .= '<label class = "control-label" for="input'.$name.'">'.$label.'</label><br>';

		$html .= '<div class="controls ';
		if((isset($options['type']) && $options['type'] != "textarea") || !isset($options['type']))
			$html .= 'col-md-4 ';

		if($this->addAsterisk)
		{
			$addRequired = true;
			if((!$this->required || (isset($options['required']) && !$options['required'])))
				$addedRequired = false;
			if((isset($options['type']) && ($options['type'] == 'file' || $options['type'] == 'fileImg')) && (isset($options['fileSkip']) && $options['fileSkip']))
				$addRequired = false;
			if((isset($options['type']) && $options['type'] == "datepicker") && (isset($options['dateSkip']) && !$options['dateSkip']))
				$addRequired = false;
			if((isset($options['type']) && $options['type'] == "url") && (isset($options['requireUrl']) && !$options['requireUrl']))
				$addRequired = false;
	
			if($addRequired)
				$html .= 'required ';	//adds asterisk at the end of the field
		}

		$html .= ' input">';	
		$attr = ' '; 

		$paramsArray = ['inputValue', 'type', 'placeHolder', 'phOnly', 'class', 'dateSkip', 'listInvert', 'required', 'CbRequired', 'fileSkip', 'rule', 'message'];

		foreach($options as $k=>$v){ 
			if(!in_array($k, $paramsArray)){
				if(!is_array($v)){
					$attr .= " $k=\"$v\""; 
				}
			}
		}
		if(!isset($options['type']) && !isset($options['options'])){
			$class = $class.' validate[required, minSize[3]]"';
			$html .= '<input '.$class.' type="text" id="input'.$name.'" name="'.$name.'" '.$requiredData.' placeholder = "'.$placeHolder.'" value="'.$value.'"'.$attr.'>';
			$options['type'] = "text";
		}elseif(isset($options['options'])){
			if(isset($options['class']) && preg_match("#selectpicker#", $options['class'])) {
				$class = $class.' "';
			} else{
				$class = $class.' validate[required]"';
			}

			$html .= '<select '.$class.' id="input'.$name.'" name="'.$name.'">';
			if(!isset($options['noPlaceholder']) || (isset($options['noPlaceholder']) && !$options['noPlaceholder']))
				$html .= '<option value="">Choisissez une option</option>'; 
			foreach($options['options'] as $k=>$v){
				if(!isset($options['listInvert']) || !$options['listInvert']){
					$html .= '<option value="'.$k.'" '.($k==$value?'selected':'').'>'.$v.'</option>'; 
				} elseif(isset($options['listInvert']) && $options['listInvert']){
					$html .= '<option value="'.makeSlug($v).'" '.(makeSlug($v)==$value?'selected':'').'>'.$v.'</option>'; 
				}
			}
			$html .= '</select>'; 
			$options['type'] = "select";
		}elseif($options['type'] == 'datepicker'){
			$class = $class.' datepicker validate[required, custom[dateFr]]"';
			$html .= '<input '.$class.' type="text" id="input'.$name.'" name="'.$name.'" '.$requiredData.' placeholder = "'.$placeHolder.'" value="'.$value.'" '.$attr.'>';
		}elseif($options['type'] == 'email'){
			$class = $class.' validate[required,custom[email]]"';
			$html .= '<input '.$class.' type="email" id="input'.$name.'" name="'.$name.'" '.$requiredData.' placeholder = "'.$placeHolder.'" value="'.$value.'" '.$attr.'>';
		}elseif($options['type'] == 'url'){
			if(!isset($options['requireUrl']) || (isset($options['requireUrl']) && $options['requireUrl'])){
				$class = $class.' validate[required,custom[url]]"';
				$html .= '<input '.$class.' type="url" id="input'.$name.'" name="'.$name.'" '.$requiredData.' placeholder = "'.$placeHolder.'" value="'.$value.'" '.$attr.'>';
			} else if(isset($options['requireUrl']) && !$options['requireUrl']){
				$html .= '<input '.$class.' type="url" id="input'.$name.'" name="'.$name.'" placeholder = "'.$placeHolder.'" value="'.$value.'" '.$attr.'>';				
			}
		}elseif($options['type'] == 'textarea'){
			if(isset($options['class']) && preg_match("#redactors#", $options['class'])) {
				$class = $class.' validate[required, funcCall[checkRedactor]]"';
			} else{
				$class = $class.' validate[required, minSize[3]]"';
			}
			$class = $class.' validate[required, minSize[3]]"';
			$html .= '<textarea '.$class.' id="input'.$name.'" '.$requiredData.' name="'.$name.'" '.$attr.'>'.$value.'</textarea>';
		}elseif($options['type'] == 'checkbox'){
			if(isset($options['CbRequired']) && $options['CbRequired'])
				$class = $class.' validate[required]"'; //if checkbox required
			else
				$class = '"';
			$html .= '<input type="hidden" id ="'.$name.'" name="'.$name.'" value="0"><input '.$class.' type="checkbox" id ="'.$name.'" name="'.$name.'" value="1" '.(empty($value)?'':'checked').'>'; 
		}elseif($options['type'] == 'file'){
			if(isset($options['fileSkip']) && $options['fileSkip'])
				$class = $class.'"'; //file input not required
			elseif(!isset($options['fileSkip']) || !$options['fileSkip'])
				$class = $class.' input-file validate[required, funcCall[checkFileInput]]"';
			$html .= '<input type="file" '.$class.'" id="input'.$name.'" name="'.$name.'" '.$attr.'>';
		}elseif($options['type'] == 'fileImg'){
			if(isset($options['fileSkip']) && $options['fileSkip'])
				$class = $class.'"';
			elseif(!isset($options['fileSkip']) || !$options['fileSkip'])
				$class = $class.' input-file validate[required, funcCall[checkFileInputImg]]"';
			$html .= '<input type="file" '.$class.' id="input'.$name.'" name="'.$name.'" '.$attr.'>';
		}elseif($options['type'] == 'password'){
			$class = $class.' validate[required, minSize[3]]"';
			$html .= '<input '.$class.' type="password" id="input'.$name.'" '.$requiredData.' name="'.$name.'" value="'.$value.'" placeholder = "'.$placeHolder.'" '.$attr.'>';
		}elseif($options['type'] == 'passwords'){
			$originClass = $class;
			$class = $class.' validate[required, minSize[3]]"';
			$html .= '<input '.$class.' type="password" id="input'.$name.'" '.$requiredData.' name="'.$name.'" value="'.$value.'" placeholder = "'.$placeHolder.'" '.$attr.'>';
			$html .= '</div></div>';
			$html .= '<div class="clearfix'.$classError.'">
					<label for="input'.$name.'">'.$label.'</label>
					<div class="input">';
			$class = $originClass.' validate[required, equals[input'.$name.']]"';
			$html .= '<input '.$class.' type="password" id="input'.$name.'b" '.$requiredData.' name="'.$name.'" value="'.$value.'" placeholder = "'.$placeHolder.'" '.$attr.'>';
		}
		if($error){
			$html .= '<span class="help-inline '.$class.'">'.$error.'</span>';
		}
		$html .= '</div></div>';

		// if($this->checkWJS && (isset($options['rule']) || isset($options['message']) )){
		// 	$checkRule = null; $checkMsg = null;
		// 	if(isset($options['rule'])){
		// 		$checkRule = $options['rule'];
		// 	}
		// 	if(isset($options['message'])){
		// 		$checkMsg = $options['message'];
		// 	}
		// 	$this->JSPrepare($name, $options['type'], $checkRule, $checkMsg);
		// }

		if(isset($options['required']) && $options['required']){
			$requiredData = "";
		}
		
		return $html; 
	}

}