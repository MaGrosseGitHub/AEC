<?php 
class MapsController extends Controller{
	
	/**
	* Blog, liste les articles
	**/
	function index($user = null){
		// debug('<br><br><br><br><br><br>'); 	

		$this->loadModel('Map');
		$condition = array();
		if(isset($user) && !empty($user))
			$condition = array('club'=>$user);
		$d['maps'] = $this->Map->find(array(
			'conditions' => $condition,
		));

		$maps = array();
		foreach ($d['maps'] as $markerKey => $markerInfo) {
			$maps["marker$markerKey"] = array();
			$curMarker = $maps["marker$markerKey"];
			$curMarker['idBdd'] = $markerInfo->id;
			$curMarker['type'] = $markerInfo->type;
			$curMarker['title'] = $markerInfo->title;
			$curMarker['club'] = $markerInfo->club;
			$curMarker['event'] = $markerInfo->event;
			$curMarker['content'] = $markerInfo->content;
			$curMarker['mapInfo'] = json_decode($markerInfo->mapInfo);
			$maps["marker$markerKey"] = $curMarker;
		}
		$d['maps'] = json_encode($maps);
		$this->set($d);
	}

	function mapster(){
		
	}

	function weather($location, $id) {	
		$weather = $this->GetWeather($location, $id);

    	$d['weekDays'] = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi','Dimanche');
		$d['weatherSummary'] = $weather['summary']->data->current_condition[0]; 
		$d['weatherNextDays'] = $weather['summary']->data->weather; 
		$d['nextDaysClassArr'] = ['weekDay', 'days', 'nextDaysIcon', 'temperatureMin', 'temperatureMax', 'precipitation', 'windSpeed', 'windDir'];
		$d['nextDaysInfoArr'] = ['date', 'date', 'weatherCode', 'tempMinC', 'tempMaxC', 'precipMM', 'windspeedKmph', 'winddir16Point'];

		$d['weatherMarine'] = $weather['marine']->data->weather[0]->hourly; 
		$d['weatherSki'] = $weather['ski']->data->weather[0]->hourly; 
		$d['detailedClassArr'] = ['icons', 'hours', 'temp', 'windSpeed', 'windDir', 'cloudCover', 'humidity', 'pressure', 'precipitation', 'visibility'];
		$d['detailedInfoArr'] = ['weatherCode', 'time', 'tempC', 'windspeedKmph', 'winddir16Point', 'cloudCover', 'humidity', 'pressure', 'precipMM', 'visibility'];

		$d['marineComponents'] = ['hours', 'cloudcover', 'humidity', 'pressure', 'precipMM', 'visibility'];
		$d['skiComponents'] = ['icons', 'temp', 'windSpeed', 'windDir'];
		$d['moutainSteps'] = ['top', 'mid', 'bottom'];

		$this->set($d);
	}

	function GetWeather($location, $id){
		$today = date('d-n-Y', time());
		$cacheDir = Cache::WEATHER.DS.$id.DS.$today;
		if(file_exists($cacheDir)){
			$weatherFile = $this->Cache->read($cacheDir.DS.$today, true);
		} else {
			require ROOT.DS.'core'.DS.'lib'.DS.'Weather.php'; 	
			$weatherFile = array();
			$weatherFile['summary'] = Weather::GetWeather($location, $id);
			$weatherFile['marine'] = Weather::GetWeather($location, $id, "marine");
			$weatherFile['ski'] = Weather::GetWeather($location, $id, "ski");
			$this->Cache->write($today, $weatherFile, $cacheDir, true);
		}

		return $weatherFile;
	}

}