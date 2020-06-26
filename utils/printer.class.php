<?php

// Class for all kinds of reusable text
class printer {
	public static function g($glyph) {
		echo '<i class="fas fa-'.$glyph.'"></i> ';
	}

	public static function glyphGet($glyph) {
		return '<i class="fas fa-'.$glyph.'"></i> ';
	}

	public static function showAlert(/*$flavor, $message*/) {
		if (!isset($_GET['alert']) || !isset($_GET['message']))
			return false;
		$flavor = $_GET['alert'];

		echo "<div class='alert alert-{$flavor} alert-dismissible fade show' role='alert'><div>";

		if ($flavor === 'primary')
			printer::g('info-circle');
		else if ($flavor === 'secondary')
			printer::g('info-circle');
		else if ($flavor === 'success')
			printer::g('check-circle');
		else if ($flavor === 'danger')
			printer::g('exclamation-circle');
		else if ($flavor === 'warning')
			printer::g('exclamation-circle');
		else if ($flavor === 'info')
			printer::g('info-circle');
		else if ($flavor === 'light')
			printer::g('info-circle');
		else if ($flavor === 'dark')
			printer::g('info-circle');

		echo '</div><div>'.$_GET['message'].'</div>';
		echo "<div><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
	  		  </button></div></div>";
	}

	public static function titleMain($title) {
		echo '<h2>'.$title.'</h2><br>';
	}

	public static function titleSmall($title) {
		echo '<h4>'.$title.'</h4>';
	}

	public static function activeClass($module, $action) {
		if ($_GET['module'] === $module && $_GET['action'] === $action)
			echo ' active ';
	}

	/*public static function jobsTable(
		$jobs,
		$printManagers, $printWorkers,
		$printView, $printEdit, $printDelete,
		$colorOverdue) {

		echo "<table class='table table-striped table-hover table-sm shadow-sm jobs-table'><thead><tr>"
			."<th scope='col'>#</th>"
			."<th scope='col'>Pavadinimas</th>"
			."<th scope='col'>Atlikimo data</th>"
			."<th scope='col'>Vieta</th>"
			."<th scope='col'>Tipas</th>";
		if ($printManagers) echo "<th scope='col'>Valdytojas</th>";
		if ($printWorkers) echo "<th scope='col'>Vykdytojas</th>";
		echo "<th scope='col'>Būsena</th>";
		if ($printView) echo "<th scope='col'>Peržiūrėti</th>";
		if ($printEdit) echo "<th scope='col'>Redaguoti</th>";
		if ($printDelete) echo "<th scope='col'>Ištrinti</th>";
		echo "</tr></thead><tbody>";
		
		
		
		foreach ($jobs as $job) {
			if ($job['is_overdue'] && $colorOverdue === true) {
				if ($_SESSION['rolelevel'] === 'user') {
					if ($job['minutes_difference'] > 120) {
						echo "<tr class='table-danger' data-toggle='tooltip' data-placement='bottom' "
							."title='Kad darbas neatliktas laiku taip pat mato ir valdytojas bei administratorius.'>";
					} else if ($job['minutes_difference'] > 60) {
						echo "<tr class='table-danger' data-toggle='tooltip' data-placement='bottom' "
							."title='Kad darbas neatliktas laiku taip pat mato ir valdytojas.'>";
					} else 
						echo "<tr class='table-danger'>";
				} else
					echo "<tr class='table-danger'>";
			}
			else
				echo "<tr>";
			echo "<th scope='row'>{$job['id']}</th>"
				."<td class='td-name'>";
				
			if ($printView)
				echo "<a href='".makeLink::ml('jobs', 'view', $job['id'])."'>{$job['name']}</a>";
			else
				echo $job['name'];
			echo "</td>"
				."<td class='td-deadline'>{$job['deadline']}</td>"
				."<td class='td-zone'>{$job['zone_name']}</td>"
				."<td class='td-type'>";
			
			// Skubus / pasikartojantis / iprastas
			if ($job['is_urgent'] === '1' && $job['is_recurring'] === '1')
				echo "Skubus, pasikartojantis";
			else if ($job['is_urgent'] === '1')
				echo "Skubus";
			else if ($job['is_recurring'] === '1')
				echo "Pasikartojantis";
			else
				echo "Įprastas";
			echo "</td>";

			if ($printManagers)
				echo "<td class='td-manager'>{$job['manager_name']}</td>";
			if ($printWorkers) {
				if (!isset($job['worker_name']))
					echo "<td class='td-worker' style='text-align: center'>-</td>";
				else
					echo "<td class='td-worker'>{$job['worker_name']}</td>";
			}

			echo "<td class='td-state'>".miscUtils::jobStateToLithuanian($job['state'])."</td>";

			if ($printView)
				echo "<td style='text-align: center'>"
					.'<a href="'.makeLink::ml('jobs', 'view', $job['id']).'">'.printer::glyphGet('eye').'</a></td>';

			if ($printEdit)
				echo "<td style='text-align: center'>"
					.'<a href="'.makeLink::ml('jobs', 'edit', $job['id']).'">'.printer::glyphGet('edit').'</a></td>';

			if ($printDelete)
				echo "<td style='text-align: center'>"
					."<a href='#' onclick='showConfirmDialog(\"jobs\", \"{$job['id']}\"); return false;' title=''>"
					.printer::glyphGet('trash-alt')
					."</a></td>";

			echo "</tr>";
		}

		echo "</tbody></table><br>";
	}*/

	/*public static function jobsFilters($filterByManager, $filterByWorker) {
		include makeLink::template('jobs/jobFilters');
	}*/

	/*public static function columnToJson($array, $column) {
		return "['".implode("','", array_column($array, $column))."']";
	}*/

	/*public static function colorsRgba($opacity) {
		/*$colors = [
			'#9E0142',
			'#D53E4F',
			'#F46D43',
			'#FDAE61',
			'#FEE08B',
			'#FFFFBF',
			'#E6F598',
			'#ABDDA4',
			'#66C2A5',
			'#3288BD',
			'#5E4FA2'
		];*
		$colors = [
			'#AAD962',
			'#FBBF45',
			'#EF6A32',
			'#ED0345',
			'#A12A5E',
			'#710162',
			'#1A1334',
			'#26294A',
			'#01545A',
			'#017351',
			'#03C383'
		];
		$a = '';
		foreach ($colors as $hex) {
			list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
			$a .= "'rgba({$r}, {$g}, {$b}, {$opacity})',";
		}

		return $a;
	}*/

	/*public static function pageTitle($module, $action) {
		$joined = $module.'_'.$action;

		switch ($joined) {
			case 'accounts_list':
				return 'Vartotojų valdymas - Supervalymas';
			case 'accounts_my_edit':
				return 'Paskyros redagavimas - Supervalymas';
			case 'accounts_other_edit':
				return 'Vartotojo redagavimas - Supervalymas';
			case 'jobs_all_admin_list':
				return 'Visi darbai - Supervalymas';
			case 'jobs_all_untaken_list':
				return 'Visi darbai - Supervalymas';
			case 'jobs_edit':
				return 'Darbo redagavimas - Supervalymas';
			case 'jobs_my_manager_list':
				return 'Mano darbai - Supervalymas';
			case 'jobs_my_user_list':
				return 'Mano darbai - Supervalymas';
			case 'jobs_new':
				return 'Naujas darbas - Supervalymas';
			case 'jobs_view':
				return 'Darbo peržiūra - Supervalymas';
			case 'login_register':
				return 'Registracija - Supervalymas';
			case 'statistics_show':
				return 'Statistika - Supervalymas';
		}

		switch ($module) {
			case 'jobs':
				return 'Darbai - Supervalymas';
		}

		return 'Supervalymas';
	}*/
}

?>