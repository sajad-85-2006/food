<?php

class commponet
{
    function toster($text,$color,$color_2){
        ?>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script>
            Toastify({
                text: "<?=$text?>",
                duration: 2000,
                destination: "https://github.com/apvarun/toastify-js",
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, <?=$color?>, <?=$color_2?>)",
                },
                onClick: function(){} // Callback after click
            }).showToast();
        </script>
        <?php
    }function yes($msg,$danger,$btn,$text,$icon){
    ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>swal({
            title: "<?=$msg?>",
            text: "<?=$text?>",
            icon: "<?=$icon?>",
            dangerMode:<?=$danger?> ,
            button: "<?=$btn?>",
        });</script>
    <?php
}
    function modal($myModal,$myBtn){
        ?>
        <script>
            // Get the modal
            var modal = document.getElementById("<?=$myModal?>");

            // Get the button that opens the modal
            var btn = document.getElementById("<?=$myBtn?>");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal
            btn.onclick = function() {
                modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
        <?php
    }
}