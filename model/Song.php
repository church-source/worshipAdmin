<?php
	class Song{
		 var $code='';
		 var $songTitle='';
		 var $secondaryTitle='';
		 var $key='';
		 var $artist='';
		 var $style='';
		 var $tempo='';
		 var $ccli='';
		 var $sheetMusicPiano='';
		 var $sheetMusicLead='';
		 var $sheetGuitarChords='';
		 var $sheetLyrics='';
		 var $songSelectLink='';
		 var $youtubeLink='';
		 
		 function toString()
		 {
			return 	"<b>". $this->code . "</b> - " . 
				 	$this->songTitle . 
					" (" . $this->secondaryTitle . ") -" .
					"  Key: " . $this->key . ", ".
					"<a href=\"". $this->sheetGuitarChords ."\">Guitar</a>, " .
					"<a href=\"". $this->sheetMusicPiano ."\">Piano</a>, " .
					"<a href=\"". $this->sheetMusicLead ."\">Lead</a>, " .
					"<a href=\"". $this->sheetLyrics ."\">Lyrics</a> ";
		 }
		 
	}
?>