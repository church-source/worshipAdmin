<?php

interface IServiceDAO
{
	public function getAllServiceHistoryEntriesBetweenDates($startDate, $endDate);
}
?>