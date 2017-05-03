<?php
/*
Plugin Name: Worship Admin
Plugin URI:  http://www.mvsongs.org
Description: A simple Worship Admin plugin quite specific to MVBC needs.
Version:     0.14
Author:      Rowan Pillay
Author URI:  www.bibleapp.za.org
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: my-toolset
*/

require_once 'dao/GSSSongDAO.php';
require_once 'dao/GSSServiceDAO.php';
require_once 'dao/GSSRosterDAO.php';

//[worship_admin]
function worship_admin( $atts )
{
	$dt_min = new DateTime("last sunday"); // Edit
	$dt_min->modify('+1 day'); // Edit
	$dt_max = clone($dt_min);
	$dt_max->modify('+6 days');
	
	$rosterDAO = new GSSRosterDAO();
	$songDAO = new GSSSongDAO();
	$serviceDAO = new GSSServiceDAO();
	
	$services = $serviceDAO->getAllServiceHistoryEntriesBetweenDates($dt_min, $dt_max);
	$output = "";
	if($services == null || empty($services))
	{ 
		$output = $output . "Songs have not been chosen for the current week. Contact the service leader if you need the songs. ";			
	}
	$prev_date="";
	foreach($services as $service) 
	{
		if($service->date !== $prev_date)
		{
			$output = $output . "<H4>Service date: " . $service->date . "</H4>";
		}
		$output = $output . $service->toString() . "</br>";
		$roster = $rosterDAO->getRosterForDate($service->date . "|" .$service->morningEvening);
		if(!is_null($roster))
		{
			$output = $output . $roster->toString() . "</br>";
		}
		$prev_date = $service->date;
	}
	

	
	return $output;
	//encoding
}

function weekRange($date) {
	$ts = strtotime($date);
	$start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
	return array(date('Y-m-d', $start),
			date('Y-m-d', strtotime('next saturday', $start)));
}

add_shortcode( 'worship_admin', 'worship_admin' );

?>