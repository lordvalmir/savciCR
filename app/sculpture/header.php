    <body>
        <div class="background">
            <div class="main">
                <?php if(isset($_SESSION['login'])) echo'
                <div class="logout">
                    <div class="logoutpom">
                         <a href=logout.php>Odhlásit</a>
                    </div>
                </div>
                '?>