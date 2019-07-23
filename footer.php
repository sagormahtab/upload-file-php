<style>
    html{
        position: relative;
        min-height: 100%;
    }
    .footer{
        position: absolute;
        bottom: 0;
        width: 100%;
        background-color: #f3f1f1;
        height: 30px;
    }
</style>
<footer class="footer">
    <div class="container">
        <p class="text-muted">
            <?php
                $today = date("Y");
                echo "Copyright &copy; 2010-$today";
            ?>
        </p>
    </div>
</footer>