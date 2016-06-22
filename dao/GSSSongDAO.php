<?php

require_once(__DIR__ . '/../cust/Config.php');
require_once(__DIR__ . '/../model/Song.php');
require_once(__DIR__ . '/../adaptor/SongAdaptor.php');
require_once(__DIR__ . '/../adaptor/GoogleSpreadsheetAdaptorFactory.php');
require_once(__DIR__ . '/ISongDAO.php');

class GSSSongDAO implements ISongDAO
{
	protected static $songLibrary;   
	
	public static function getSongLibrary()
	{
		return self::$songLibrary;
	}
	
	public function getSong($songCode)
	{
		return static::$songLibrary[$songCode];
	}
	
	/*Returns map of songs. Song Code as key*/
	public static function loadMapOfSongs()
	{
		$json = file_get_contents(Config::SONG_LIBRARY_LINK);
		$obj = json_decode($json);
		
		$rows = $obj->{'feed'}->{'entry'};
		$minRow;
		$isSongsPresent = false;
		$assArray;// = array();
		$adaptor = GoogleSpreadsheetAdaptorFactory::getInstance()->getSongAdaptor();
		//$adaptor->createSong("test");
		foreach($rows as $row) {
			$song = $adaptor->createSong($row);
			if($song->code != null && $song->code != "")
			{
				self::$songLibrary[$song->code] = $song;
			}
		}
		//self::$songLibrary = $assArray;
	}
}

GSSSongDAO::loadMapOfSongs();

?>