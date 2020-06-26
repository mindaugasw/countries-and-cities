<div>
    <table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Area</th>
            <th>Population</th>
            <th>Phone code</th>
            <th>Created at</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($countries as $item)
            {
                echo "<tr>
                    <td>{$item['id']}</td>
                    <td>{$item['name']}</td>
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