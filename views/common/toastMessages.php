<div>
    <script>
        
        document.addEventListener("DOMContentLoaded", function() { 
        <?php
            /* To catch all alerts that were created while rendering the page
            * but still show them at the top of the page, they're added using JS. */

            $toasts = ToastMessages::GetAll();
            // $text = "";

            foreach ($toasts as $item)
            {
                echo "Utils.AddToastMessage(`{$item['type']}`, `{$item['message']}`); ";
                /*$text .=
                    "<div class='alert alert-{$item['type']} alert-dismissible fade show' role='alert'>
                        <div>{$item['message']}</div>
                        <div>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                    </div>";*/
                
            }        
        ?>
        });

    </script>
    <script>
    //     // $("#alerts-wrapper").append(?php echo json_encode($text); ?>);
    //     document.getElementById('alerts-wrapper').innerHTML = ?php echo json_encode($text)?>; // json_encode used to properly escape all whitespace

    </script>

</div>