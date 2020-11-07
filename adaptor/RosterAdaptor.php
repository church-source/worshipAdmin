<?php
	include_once(__DIR__ . '/../model/RosterWeek.php');

	//include('simplehtmldom/simple_html_dom.php');
	class RosterAdaptor
	{
		public function __construct()
		{
			//do nothing
		}

		public function createRosterWeek($row)
		{	
			$rosterWeek = new RosterWeek();
			$rosterWeek->date = $row->{'gsx$date'}->{'$t'};
			$rosterWeek->morningEvening = $row->{'gsx$morningevening'}->{'$t'};
			for($i = 1; $i <=4; $i++)
			{
				self::addSingerToList($i, $row, $rosterWeek);
			}
			$rosterWeek->acousticGuitar  = $row->{'gsx$acousticguitar'}->{'$t'};
			$rosterWeek->bassGuitar= $row->{'gsx$bassguitar'}->{'$t'};
			$rosterWeek->piano = $row->{'gsx$piano'}->{'$t'};
			$rosterWeek->violin = $row->{'gsx$violin'}->{'$t'};
			$rosterWeek->drums = $row->{'gsx$drums'}->{'$t'};
			$rosterWeek->lute = $row->{'gsx$lute'}->{'$t'};
			$rosterWeek->cello = $row->{'gsx$cello'}->{'$t'};
			$rosterWeek->soundDesk = $row->{'gsx$sounddesk'}->{'$t'};

			
			return $rosterWeek;
		}
		
		private function addSingerToList($singerNumber, $row, $rosterWeek)
		{
			$singer = $row->{'gsx$singer'.$singerNumber}->{'$t'};
			if($singer != null)
			{
				$rosterWeek->addSinger($singer);
			}
		}
	}
?>