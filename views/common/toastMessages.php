<div>
    <script>
        
        document.addEventListener("DOMContentLoaded", function() { 
        <?php
            /* To catch all alerts that were created while rendering the page
            * but still show them at the top of the page, they're added using JS. */

            $toasts = ToastMessages::GetAll();
            foreach ($toasts as $item)
                echo "Utils.AddToastMessage(`{$item['type']}`, `{$item['message']}`); ";
        ?>
        });

    </script>
</div>