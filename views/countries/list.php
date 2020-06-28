<div>
    <h2>Countries list</h2>

    <!-- TODO link is currently full page width -->
    <a href="<?php echo Router::Link("countries", "new") ?>"><h5>Add new country</h5></a>
    
    <h5>Filter countries list</h5>

    <?php include Router::View('common/filters') ?>
    
    <div id="countries-list-wrapper">
        <div class="loading-wrapper">
            <img src="public/imgs/loading.gif">
        </div>
    </div>
    <script> document.addEventListener("DOMContentLoaded", Countries.updateList); </script>
    
    <?php /* <table class="table table-striped table-hover table-list">
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
                    <td>{$item['added_at']}</td>
                    <td>
                        <a href='".Router::Link("countries", "details", $item['id'])."'>View</a> |
                        <a href='".Router::Link('countries', 'edit', $item['id'])."'>Edit</a> |
                        <a href=\"#\" onclick=\"showConfirmDialog(
                            'Are you sure you want to delete {$item['name']} and all its cities?',
                            '".Router::Link('countries', 'delete', $item['id'])."')\">Delete</a>
                    </td>
                    </tr>";
            }
        ?>
    </tbody>
    </table> */ ?>
</div>