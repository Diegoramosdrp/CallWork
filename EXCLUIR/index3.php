<html>
    <head>
        <title>CallWork</title>
        <link href=Css/style.css rel="stylesheet">
        <link href=Bootstrap/css/bootstrap.min.css rel="stylesheet" />
        <link href=Bootstrap/css/bootstrap-theme.min.css rel="stylesheet"/>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <?php include './Template/menusuperior.php';?>
            <div class="row">
                <div class="col-md-3">
                    <?php include './Template/menulateral.php';?>
                    <?php include './PHP/Gerenciador.php';?>
                </div>
                <div class="col-md-8">
                    <?php echo $_SESSION['a']['nome_usuario']; 
                    $server = $_SERVER['SERVER_NAME'];
                    $endereco = $_SERVER ['REQUEST_URI'];
                    print_r($endereco);?>
                </div>
            </div>
        </div>
    </body>
</html>