<div>
    <h2>Country details - <?php echo $country['name'] ?></h2>

    <table class="details-table">
		<tbody>
			<tr>
				<th>ID:</th>
				<td><?php echo $country['id'] ?></td>
			</tr>
			<tr>
				<th>Area:</th>
				<td><?php echo MiscUtils::FormatBigNumber($country['area']) ?></td>
			</tr>
			<tr>
				<th>Population:</th>
				<td><?php echo MiscUtils::FormatBigNumber($country['population']) ?></td>
			</tr>
			<tr>
				<th>Phone code:</th>
				<td><?php echo "+".$country['phone_code'] ?></td>
			</tr>
			<tr>
				<th>Added at:</th>
				<td><?php echo $country['added_at'] ?></td>
			</tr>
			<tr>
				<th>Cities in database:</th>
				<td><?php echo sizeof($cities) ?></td>
			</tr>
			<tr>
				<th colspan=2>
                <a href="<?php echo Router::Link('countries', 'list') ?>">Go back</a> |
                Edit |
                <a href="#" onclick="showConfirmDialog(
                    '<?php echo 'Are you sure you want to delete '.$country['name'].' and all its cities?' ?>',
                    '<?php echo Router::Link('countries', 'delete', $country['id']) ?>')">Delete</a></th>
			</tr>


			<!-- --- EDIT / DELETE --- -->
			<?php /*	<tr><td colspan=2><br></td></tr>
				<tr>
					<td></td><td>
						<a href="<?php echo makeLink::ml('jobs', 'edit', $job['id']) ?>" >
							<button type="button" class="btn btn-secondary w-100" style="margin-bottom: 5px"
							data-toggle='tooltip' data-placement='left' title='Redaguoti darbo pavadinimą, atlikimo datą, vietą ir tipą.'>
							Redaguoti <?php printer::g('edit') ?></button>
						</a>
					</td>
				</tr>
				<tr>
					<td></td><td>
						<a href="#" onclick='showConfirmDialog("jobs", "<?php echo $job["id"];?>");'>
							<button type="button" class="btn btn-danger w-100">Ištrinti <?php printer::g('trash-alt') ?></button>
						</a>
					</td>
				</tr>
			<?php } */ ?>


			<!-- --- START / STOP --- -->
			<?php /* if ($_SESSION['rolelevel'] === 'user') {
				echo "<tr><td colspan=2><br></td></tr>";
				echo "<tr><td colspan=2>";
					if ($job['state'] === 'unstarted' || $job['state'] === 'postponed') {
						echo "<a href='"
							.makeLink::ml('jobs', 'change_state', $job['id'].'&state=started')
							."'><button type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='bottom' "
							." title='Darbas bus priskirtas jums ir taps nebematomu kitiems.'>Pradėti "
							.printer::glyphGet('play')
							."</button></a>";
					} else if ($job['state'] === 'started') {
						echo "<a href='"
							.makeLink::ml('jobs', 'change_state', $job['id'].'&state=postponed')
							."'><button type='button' class='btn btn-secondary' data-toggle='tooltip' data-placement='bottom' "
							." title='Darbas vėl taps matomu visiems.'>Atidėti "
							.printer::glyphGet('pause')
							."</button></a> ";
						echo "<a href='"
							.makeLink::ml('jobs', 'change_state', $job['id'].'&state=completed')
							."'><button type='button' class='btn btn-success'>Užbaigti "
							.printer::glyphGet('check')
							."</button></a>";
					}

				echo "</td></tr>";
			} */ ?>

		</tbody>
	</table>







    
    <h4>Cities list</h4>
    <h4>Filter cities list</h4>

    <?php include 'views/common/filters.php'; ?>
    
    <table class="table table-striped table-hover ">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Area</th>
            <th>Population</th>
            <th>Phone code</th>
            <th>Added at</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($countries as $item)
            {
                echo "<tr>
                    <td>{$item['id']}</td>
                    <td>
                        <a href='".Router::Link("countries", "details", $item['id'])."'>
                            {$item['name']}
                        </a>
                    </td>
                    <td>".MiscUtils::FormatBigNumber($item['area'])."</td>
                    <td>".MiscUtils::FormatBigNumber($item['population'])."</td>
                    <td>+{$item['phone_code']}</td>
                    <td>{$item['created_at']}</td>
                    <td>View | Edit | Delete</td>
                    </tr>";
            }
        ?>
    </tbody>
    </table>
</div>