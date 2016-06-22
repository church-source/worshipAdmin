<?php
	include_once(__DIR__ . '/../model/Song.php');
//include('simplehtmldom/simple_html_dom.php');
class SongAdaptor
{
	
	public function __construct()
	{
		//do nothing
	}
	
	public function createSong($row)
	{	
		$song = new Song();
		$song->code = $row->{'gsx$code'}->{'$t'};
		$song->songTitle = $row->{'gsx$song'}->{'$t'};
		$song->secondaryTitle = $row->{'gsx$secondarynames'}->{'$t'};
		$song->key = $row->{'gsx$key'}->{'$t'};
		$song->artist = $row->{'gsx$artist'}->{'$t'};
		$song->style = $row->{'gsx$style'}->{'$t'};
		$song->sheetMusicLead = $row->{'gsx$sheetmusiclead'}->{'$t'};
		$song->sheetMusicPiano = $row->{'gsx$sheetmusicpiano'}->{'$t'};
		$song->sheetGuitarChords = $row->{'gsx$guitarchords'}->{'$t'};
		$song->sheetLyrics = $row->{'gsx$lyrics'}->{'$t'}; //need to make all these columns constant
		return  $song;
	}
}
?>