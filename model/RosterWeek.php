<?php
require_once(__DIR__ . '/../cust/Util.php');

	class RosterWeek{
		 var $date = '';
		 var $morningEvening = '';
		 var $listOfSingers = array();
		 var $acousticGuitar ='';
		 var $bassGuitar ='';
		 var $piano ='';
		 var $violin ='';
		 var $drums ='';
		 var $lute ='';
		 var $soundDesk ='';
		 
		 function toString()
		 {
		 	$rosterWeekOutput = "<ul>";
		 	for ($i = 0; $i < count($this->listOfSingers); ++$i)
		 	{
		 			$rosterWeekOutput = $rosterWeekOutput . "<li>Singer " . ($i + 1) . " - " . $this->listOfSingers[$i] . "</br>";
		 	}
			$finalOutput = "<b>" . $this->morningEvening . " Roster: " . "</br></b>" . $rosterWeekOutput;
			if(!utilphp\util::IsNullOrEmptyString($this->acousticGuitar))
				$finalOutput = $finalOutput . "<li>Acoustic Guitar: " . $this->acousticGuitar . "</br>";
			if(!utilphp\util::IsNullOrEmptyString($this->bassGuitar))
				$finalOutput = $finalOutput . "<li>Bass Guitar: " . $this->bassGuitar . "</br>";
			if(!utilphp\util::IsNullOrEmptyString($this->piano))					
				$finalOutput = $finalOutput . "<li>Piano: " . $this->piano . "</br>";
			if(!utilphp\util::IsNullOrEmptyString($this->violin))					
				$finalOutput = $finalOutput . "<li>Violin: " . $this->violin . "</br>";
			if(!utilphp\util::IsNullOrEmptyString($this->drums))
				$finalOutput = $finalOutput . "<li>Drums: " . $this->drums . "</br>";
			if(!utilphp\util::IsNullOrEmptyString($this->lute))
				$finalOutput = $finalOutput . "<li>Lute: " . $this->lute . "</br>";					
			if(!utilphp\util::IsNullOrEmptyString($this->soundDesk))
			 	$finalOutput = $finalOutput . "<li>Sound Desk: " . $this->soundDesk . "</br>";
		 	$finalOutput = $finalOutput . "</ul>";
			return $finalOutput;
		 }
		 
		 public function addSinger($aSinger)
		 {
		 	array_push($this->listOfSingers,$aSinger);
		 }
		 
	}
?>
