<?php

//$countriesObj = new country();

//$jobsObj = new jobs();
//$data = [];
/*if ($_SESSION['rolelevel'] !== 'admin') {
	header("Location: ".makeLink::home('danger', 'Neturite teisės pasiekti šį puslapį!'));
} else*/
$countries = Countries::GetAll();

include 'views/common/filters.php';
include 'views/countries/list.php';


/*die();

printer::showAlert();
printer::titleMain('Visi darbai'); 

printer::titleSmall('Filtruoti darbus'); 
/*printer::jobsFilter(
	$filterByName = true,
	$filterByDeadlineFrom = true,
	$filterByDeadlineTo = true,
	$filterByZone = true,
	$filterByType = true,
	$filterByManager = true,
	$filterByWorker = true,
	$filterByState = true);*
printer::jobsFilters($filterByManager = true, $filterByWorker = true);

usort($data, "compareJobDeadlines");


// --- OVERDUE JOBS ---
$overdue = array_filter($data, 'filterOverdueJobs2hours');
if (sizeof($overdue) !== 0) {
	printer::titleSmall('Vėluojantys darbai'); 
	printer::jobsTable(
		$overdue,
		$printMangers = true,
		$printWorkers = true,
		$printView = true,
		$printEdit = true,
		$printDelete = true,
		$colorOverdue = true);
}


// --- UNCOMPLETED JOBS ---
$inProgress = array_filter($data, 'filterInProgressJobs');
//$inProgress = array_diff_recursive($inProgress, $overdue);
if (sizeof($inProgress) !== 0) {
	printer::titleSmall('Neatlikti darbai'); 
	printer::jobsTable(
		$inProgress,
		$printMangers = true,
		$printWorkers = true,
		$printView = true,
		$printEdit = true,
		$printDelete = true,
		$colorOverdue = false);
} else
	printer::titleSmall('Neatliktų darbų nėra');


// --- COMPLETED JOBS ---
$completed = array_filter($data, 'filterFinishedJobs');
if (sizeof($completed) !== 0) {
	printer::titleSmall('Atlikti darbai'); 
	printer::jobsTable(
		array_reverse($completed),
		$printMangers = true,
		$printWorkers = true,
		$printView = true,
		$printEdit = true,
		$printDelete = true,
		$colorOverdue = false);
} else
	printer::titleSmall('Atliktų darbų nėra'); */


?>