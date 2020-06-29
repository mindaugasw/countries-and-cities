<div>
    <h2>Country details - <?php echo $country->name ?></h2>

    <table class="details-table">
		<tbody>
			<tr>
				<th>ID:</th>
				<td><?php echo $country->id ?></td>
			</tr>
			<tr>
				<th>Area:</th>
				<td><?php echo $country->areaNice ?></td>
			</tr>
			<tr>
				<th>Population:</th>
				<td><?php echo $country->populationNice ?></td>
			</tr>
			<tr>
				<th>Phone code:</th>
				<td><?php echo "+".$country->phone_code ?></td>
			</tr>
			<tr>
				<th>Added at:</th>
				<td><?php echo $country->added_at ?></td>
			</tr>
			<tr>
				<th>Cities in database:</th>
				<td><?php echo sizeof($cities) ?></td>
			</tr>
			<tr>
				<th colspan=2>
                <a href="<?php echo Router::Link('countries', 'list') ?>">Go back</a> |
                <a href="<?php echo $country->editLink ?>">Edit</a> |
                <a href="javascript:Utils.AreaDeleteConfirm(<?php echo "'$country->deleteLink', '$country->name'" ?>)">Delete</a></th>
			</tr>
		</tbody>
	</table>
    <br>
    <?php include Router::View('cities/list') ?>

</div>