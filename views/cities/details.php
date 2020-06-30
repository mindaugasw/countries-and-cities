<div>
    <h2>City details - <?php echo $city->name ?></h2>

    <table class="details-table">
		<tbody>
			<tr>
				<th>ID:</th>
				<td><?php echo $city->id ?></td>
			</tr>
			<tr>
				<th>Area:</th>
				<td><?php echo $city->areaNice ?></td>
			</tr>
			<tr>
				<th>Population:</th>
				<td><?php echo $city->populationNice ?></td>
			</tr>
			<tr>
				<th>ZIP code:</th>
				<td><?php echo $city->zip_code ?></td>
			</tr>
			<tr>
				<th>Added at:</th>
				<td><?php echo $city->added_at ?></td>
			</tr>
			<tr>
				<th>In coutry:</th>
				<td><?php echo $city->country_name ?></td>
			</tr>
			<tr>
				<th colspan=2>
                <a href="<?php echo Router::Link('countries', 'details', $city->country_id) ?>">Go back</a> |
                <a href="<?php echo $city->editLink ?>">Edit</a> |
                <a href="javascript:Utils.AreaDeleteConfirm(<?php echo "'$city->deleteLink', '$city->name'" ?>)">Delete</a></th>
			</tr>
		</tbody>
	</table>
</div>