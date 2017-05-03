<?php
include_once(__DIR__ . '/ServiceAdaptor.php');
include_once(__DIR__ . '/SongAdaptor.php');
include_once(__DIR__ . '/RosterAdaptor.php');

class GoogleSpreadsheetAdaptorFactory
{
	private $serviceAdaptor;
	private $songAdaptor;
	private $rosterAdaptor;
	
	private $factory;
	
	private function __construct()
	{
		 $this->serviceAdaptor = new ServiceAdaptor();
		 $this->songAdaptor = new SongAdaptor();
		 $this->rosterAdaptor = new RosterAdaptor();
	}
	
	//not thread safe...?
	public static function getInstance()
	{
		if($factory == null)
		{
			$factory = new GoogleSpreadsheetAdaptorFactory();	
		}
		return $factory;
	}
	
	public function getServiceAdaptor()
	{
		return $this->serviceAdaptor;
	}
	
	public function getSongAdaptor()
	{
		return $this->songAdaptor;
	}
	
	public function getRosterAdaptor()
	{
		return $this->rosterAdaptor;
	}
}
