<?php
class Weather{	

	private static $apiKey = "wfzwjcxv8vjt8j7x2jpnddfk";
	private static $basicUrl = "http://api.worldweatheronline.com/free/v1/";

	static function GetWeather($location, $id, $type = "weather", $setWeather = true, $numDays = null, $options = array()){
		$authorizedTypes = ['weather', 'ski', 'marine'];
		if(!in_array($type, $authorizedTypes)){
			$type = 'weather';
		}
		$defaultOptions = array(
								'format' => 'json',
								'num_of_days' => 5
							);
		$options = array_merge($defaultOptions, $options);

		$jsonUrl = self::$basicUrl.$type.'.ashx?key='.self::$apiKey.'&q='.$location;
		if($type == 'weather')
			$jsonUrl .= '&num_of_days='.$options['num_of_days'];
		$jsonUrl .= '&format='.$options['format'];

		$jsonReply = file_get_contents($jsonUrl);
		$jsonReply = json_decode($jsonReply);

		debug($jsonReply);

		if(!$setWeather)
			return $jsonReply;
		else
			return self::SetWeatherIcons($jsonReply, $type);
	}

	private static function SetWeatherIcons($jsonReply, $type){

		if($type == "weather"){
			$weatherCodeSummary = $jsonReply->data->current_condition[0]->weatherCode;
			$jsonReply->data->current_condition[0]->weatherCode = self::SetWeatherIcon($weatherCodeSummary); 
			$weatherCodeNextDays = $jsonReply->data->weather; 
			foreach ($weatherCodeNextDays as $day => $weatherInfo) {
				$weatherInfo->weatherCode = self::SetWeatherIcon($weatherInfo->weatherCode);
			}
		} elseif($type == "marine"){
			$weatherCodeMarine = $jsonReply->data->weather[0]->hourly;
			foreach ($weatherCodeMarine as $hour => $weatherInfo) {
				$weatherInfo->weatherCode = self::SetWeatherIcon($weatherInfo->weatherCode);
				$weatherInfo->time =  self::SetWeatherHours($weatherInfo->time);
			}
		} elseif($type == "ski"){
			$moutainSteps = ['top', 'mid', 'bottom'];
			$weatherCodeSki = $jsonReply->data->weather[0]->hourly;
			foreach ($weatherCodeSki as $hour => $weatherInfo) {
				foreach ($moutainSteps as $moutainStep => $stepInfo) {
                    $moutainStepData = reset($weatherInfo->$stepInfo);
					$moutainStepData->weatherCode = self::SetWeatherIcon($moutainStepData->weatherCode);
				}
				$weatherInfo->time =  self::SetWeatherHours($weatherInfo->time);
			}
		}

		return $jsonReply;
	}

	private static function SetWeatherIcon($weatherCode){
		// debug($weatherCode);
		//if hour > 19 and < 6 show night icon else show day icon
		$weatherIcons = array(
								//"xxx" => [always display (cloud icon[first li], day icon (sun icon)[second li], night icon (moon icon)[second li], [other icon(s) [other li(s)]] ]
								"395" => ['basethundercloud', 'icon-snowy icon-sunny', 'icon-snowy icon-night'],
								"392" => ['basethundercloud', 'icon-thunder icon-sunny', 'icon-thunder icon-night'],
								"389" => ['basethundercloud', 'icon-thunder'],
								"377" => ['basecloud', 'icon-sleet'],
								"374" => ['basecloud', 'icon-sleet icon-sunny', 'icon-sleet icon-night'],
								"368" => ['basecloud', 'icon-snowy icon-sunny', 'icon-snowy icon-night'],
								"359" => ['basethundercloud', 'icon-showers'],
								"356" => ['basethundercloud', 'icon-showers icon-sunny', 'icon-showers icon-night'],
								"353" => ['basecloud', 'icon-drizzle icon-sunny', 'icon-drizzle icon-night'],
								"338" => ['basethundercloud', 'icon-snowy'],
								"320" => ['basecloud', 'icon-snowy'],
								"293" => ['basecloud', 'icon-drizzle'],
								"260" => ['icon-mist'],
								"122" => ['basethundercloud'],
								"119" => ['icon-cloud'],
								"116" => ['basecloud', 'icon-sunny', 'icon-night'],
								"113" => ['icon-sun', 'icon-sun', 'icon-moon'],
								"386" => [392],
								"371" => [395],
								"365" => [374],
								"362" => [374],
								"179" => [374],
								"350" => [377],
								"317" => [377],
								"314" => [377],
								"311" => [377],
								"284" => [377],
								"281" => [377],
								"185" => [377],
								"182" => [377],
								"332" => [338],
								"329" => [338],
								"230" => [338],
								"335" => [395],
								"326" => [368],
								"323" => [368],
								"227" => [320],
								"308" => [359],
								"302" => [359],
								"296" => [359],
								"305" => [356],
								"299" => [356],
								"266" => [293],
								"263" => [353],
								"176" => [353],
								"248" => [260],
								"200" => [392],
								"143" => [260],
							);

		if(array_key_exists($weatherCode, $weatherIcons)){
			$weatherIconArr = $weatherIcons[$weatherCode];
			if(count($weatherIconArr) == 1 && is_int($weatherIconArr[0])){
				$weatherIconArr = $weatherIcons[$weatherIconArr[0]];
			} 

			$weatherIconLength = count($weatherIconArr);
			$weatherErrorIcon = '<span class="icon-none">&#10067;</span>';
			if($weatherIconLength >= 1 && !is_int($weatherIconArr[0])){
				$weatherIcon = '';
				foreach ($weatherIconArr as $iconKey => $iconValue) {
					if(!is_array($iconValue)){						
						if($iconKey == 0 && ($weatherIconArr < 3 || $weatherIconArr > 3)) {
							$weatherIcon = '<span class="'.$iconValue.'"></span>';
						} elseif($iconKey > 0 && $weatherIconLength >= 3){
							if(!is_array($weatherIconArr[1]) && !is_array($weatherIconArr[2])){
								if($iconKey  == 1){
									$weatherIcon .= '<span class="iconDay '.$iconValue.'"></span>';
								} elseif($iconKey == 2){
									$weatherIcon .= '<span class="iconNight '.$iconValue.'"></span>';
								}
							}
						}
					} else {
						foreach ($iconValue as $additionalIconKey => $additionalIconValue) {
							$weatherIcon .= '<span class="'.$additionalIconValue.'"></span>';
						}
					}
				}

			} else{
				$weatherIcon = $weatherErrorIcon;
			}
		} else {
			$weatherIcon = $weatherErrorIcon;
		}

		// return json_encode($weatherIcon);
		return $weatherIcon;
	}

	private static function SetWeatherHours($hour, $short = true){
		$noZero = false;
		$hour != '900' ? $noZero = false : $noZero = true;
		if(!$short){
			if(strlen($hour) == 1 && $hour == "0"){
				$hour = '<span class = "weatherTime">01</span>:00';
			} elseif(strlen($hour) == 3){
				$hour = '<span class = "weatherTime">'.(!$noZero ? '0' : '').(intval(substr($hour, 0,1))+1)."</span>:".substr($hour, 1, 2);
			} elseif(strlen($hour) == 4){
				$hour = '<span class = "weatherTime">'.(intval(substr($hour, 0, 2))+1).'</span>:'.substr($hour, 2);
			}
		} else {
			if(strlen($hour) == 1 && $hour == "0"){
				$hour = '<span class = "weatherTime">01</span>h';
			} elseif(strlen($hour) == 3){
				$hour = '<span class = "weatherTime">'.(!$noZero ? '0' : '').(intval(substr($hour, 0,1))+1)."</span>h";
			} elseif(strlen($hour) == 4){
				$hour = '<span class = "weatherTime">'.(intval(substr($hour, 0, 2))+1).'</span>h';
			}
		}

		return $hour;
	}

}