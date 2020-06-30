<div>
    <h2>Countries list</h2>

    <h5><a href="<?php echo Router::Link("countries", "new") ?>">Add new country</a></h5>
    
    <h5>Filter countries list</h5>

    <?php include Router::View('common/filters') ?>
    
    <div id="areas-list-wrapper">
        <div class="loading-wrapper">
            <img src="<?php echo Router::Img('loading.gif'); ?>">
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() { Area.module = 'countries' });
        document.addEventListener("DOMContentLoaded", Area.UpdateList);
    </script>
</div>