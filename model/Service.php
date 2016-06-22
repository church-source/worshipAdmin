<?php
	include_once(__DIR__ . '/../model/Song.php');
	class Service{
		 var $date = '';
		 var $morningEvening = '';
		 var $listOfSongs = array();
		 var $pianoSongBookLink ='';
		 var $leadSongBookLink ='';
		 var $guitarSongBookLink ='';
		 var $lyricsSongBookLink ='';
		 
		 function toString()
		 {
		 	$songoutput = "<ul>";
		 	foreach($this->listOfSongs as $song) 
		 	{
		 			$songoutput = $songoutput . "<li>" . $song->toString(). "</br>";
		 	}
		 	$songoutput = $songoutput . "</ul>";
		 	
			return 	"<H4><b>" . $this->morningEvening. " Service</b></H4>" .
				 	"<b>Song List: </b></br>" . $songoutput .
					"<b>Song Books: </b></br><a href='".$this->pianoSongBookLink."'>Piano Song Book</a></br>" .
					"<a href='".$this->leadSongBookLink."'>Lead Song Book</a></br>" . 
					"<a href='".$this->guitarSongBookLink."'>Guitar Song Book</a></br>";			
		 }
		 
		 function addSong(Song $aSong)
		 {
		 	array_push($this->listOfSongs,$aSong);
		 }
		 
	}
?>