<div>
    <h2>Countries list</h2>

    <!-- TODO link is currently full page width -->
    <a href="<?php echo Router::Link("countries", "new") ?>"><h4>Add new country</h4></a>
    
    <h4>Filter countries list</h4>

    <?php include 'views/common/filters.php'; ?>
    
    <table class="table table-striped table-hover table-list">
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
                    <td>
                        <a href='".Router::Link("countries", "details", $item['id'])."'>
                            {$item['name']}
                        </a>
                    </td>
                    <td>".MiscUtils::FormatBigNumber($item['area'])."</td>
                    <td>".MiscUtils::FormatBigNumber($item['population'])."</td>
                    <td>+{$item['phone_code']}</td>
                    <td>{$item['added_at']}</td>
                    <td>
                        <a href='".Router::Link("countries", "details", $item['id'])."'>View</a> |
                        <a href='".Router::Link('countries', 'edit', $item['id'])."'>Edit</a> |
                        Delete</td>
                    </tr>";
            }
        ?>
    </tbody>
    </table>
</div>