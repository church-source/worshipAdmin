<?php

require_once(__DIR__ . '/../cust/Config.php');
require_once(__DIR__ . '/../model/Service.php');
require_once(__DIR__ . '/../adaptor/ServiceAdaptor.php');
require_once(__DIR__ . '/../adaptor/GoogleSpreadsheetAdaptorFactory.php');
require_once(__DIR__ . '/IServiceDAO.php');

class GSSServiceDAO implements IServiceDAO 
{
	protected static $serviceHistory = array();   
	
	public static function getServiceHistory()
	{
		return self::$serviceHistory;
	}
	
	/*Returns map of songs. Song Code as key*/
	public static function loadSongHistory()
	{
		$json = file_get_contents(Config::SERVICE_HISTORY_LINK);
		$obj = json_decode($json);
		
		$rows = $obj->{'feed'}->{'entry'};
		$adaptor = GoogleSpreadsheetAdaptorFactory::getInstance()->getServiceAdaptor();
		foreach($rows as $row) 
		{
			$service = $adaptor->createService($row);
			self::$serviceHistory[] = $service;
		}
	}
	
	public function getAllServiceHistoryEntriesBetweenDates($startDate, $endDate)
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

	}
}

GSSServiceDAO::loadSongHistory();

?>