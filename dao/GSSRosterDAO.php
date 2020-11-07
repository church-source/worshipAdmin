<?php

require_once(__DIR__ . '/../cust/Config.php');
require_once(__DIR__ . '/../cust/Util.php');
require_once(__DIR__ . '/../model/Service.php');
require_once(__DIR__ . '/../adaptor/ServiceAdaptor.php');
require_once(__DIR__ . '/../adaptor/GoogleSpreadsheetAdaptorFactory.php');
require_once(__DIR__ . '/IRosterDAO.php');

class GSSRosterDAO implements IRosterDAO 
{
	protected static $rosterWeeks;   
	
	public static function getRosterWeeks()
	{
		return self::$rosterWeeks;
	}
	
	/*Returns map of songs. Song Code as key*/
	public static function loadRoster()
	{
		ini_set("allow_url_fopen", 1);
		$json = utilphp\util::getFileContents(Config::ROSTER_LINK);
		$obj = json_decode($json);
	
		$rows = $obj->{'feed'}->{'entry'};

		$adaptor = GoogleSpreadsheetAdaptorFactory::getInstance()->getRosterAdaptor();
		foreach($rows as $row) 
		{
			$rosterWeek = $adaptor->createRosterWeek($row);
			if(!is_null($rosterWeek))
			{
				self::$rosterWeeks[$rosterWeek->date."|".$rosterWeek->morningEvening] = $rosterWeek;
				//self::$rosterWeeks[$rosterWeek->date] = $rosterWeek;
			}
		}
	}
	
	public function getRosterForDate($date)
	{
		return static::$rosterWeeks[$date];
	}
	
	/*public function getAllServiceHistoryEntriesBetweenDates($startDate, $endDate)
	{
		$serviceHistory = GSSServiceDAO::getServiceHistory();
		$churchServices = array();
		foreach($serviceHistory as $churchService) {
			//echo '<p>';
	
			$date = $churchService->date;
			$service = $churchService->morningEvening;
			
			if($service === "")
			{
				continue;
			}
				
			$datetime1 = new DateTime($date);
	
			$diffToBegin = $datetime1->diff($startDate);
			$diffToEnd = $datetime1->diff($endDate);
	
			$toBeginDayCount = $diffToBegin->format('%R%a');
			$toEndDayCount = $diffToEnd->format('%R%a');
	

			if($toBeginDayCount > -7 && $toBeginDayCount < 0 && $toEndDayCount >= 0 && $toEndDayCount <= 7)
			{
				if(!$isSongsPresent)
				{
					$isSongsPresent = true;
				}
				$churchServices[] = $churchService;
			}

		}
		return $churchServices;
	}*/
}

GSSRosterDAO::loadRoster();

?>
