<?php
    session_start();
    require ("pages/header.php");
    if (isset($_SESSION['logged_user'])){
        echo"<a href="."/pages/useraddadvertisement.php".">Добавить доклад</a>";
    }
?>

<h1 class="text-center">Все объявления</h1>
<div class="table-responsive container" id="pagination_data"></div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/main.js"></script> <!-- Gem jQuery -->
<script>$(document).ready(function(){
        load_data();
        function load_data(page)
        {
            $.ajax({
                url:"pagination.php",
                method:"POST",
                data:{page:page},
                success:function(data){
                    $('#pagination_data').html(data);
                }
            })
        }
        $(document).on('click', '.pagination_link', function(){
            var page = $(this).attr("id");
            load_data(page);
        });
    });</script>
</body>
</html>