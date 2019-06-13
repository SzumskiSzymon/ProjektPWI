<?php
if(!isset($_SESSION['login'])) {
    session_start();
    include("functions.php");
}
if(!log_in()) {
    exit();
} else {
    if(acc($_SESSION['email']) == 'Admin' || acc($_SESSION['email']) == 'Mod' || acc($_SESSION['email']) ) {
        // wczytanie strony
    } else {
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Stona Glowna</title>

    <link href="css/fontello.css" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="style.css" rel="stylesheet">
</head>
<body data-spy="scroll" data-targer=".navbar" data-offset="50">
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Kamix</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php"><i class="icon-home" style="color:white"></i>
                            Strona Główna<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-tags" style="color:white"></i>
                            Nasza Oferta
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#products">Produkty</a>
                            <a class="dropdown-item" href="#newspaper">Gazetka</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#promotions">Nowości</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#aboutUs"><i class="icon-info" style="color:white"></i>O nas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#supply"><i class="icon-truck" style="color:white"></i>Dostawa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact"><i class="icon-phone-squared" style="color:white"></i>Kontakt</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-user" style="color:white"></i>Moje konto
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="basket.php">Koszyk</a>
                            <a class="dropdown-item" href="changePassword.php">Zmiana hasła</a>
                            <a class="dropdown-item" href="login.php">Dane</a>
                            <?php
                            if(acc($_SESSION['email']) == 'Admin') {
                                echo '<a class="dropdown-item" href="admin.php">Panel administratora</a>';
                            }
                            ?>
                        </div>
                    </li>
                    <?php
                    if(log_in()) {
                        echo '<li class="nav-item"><a class="nav-link" href="wyloguj.php">Wyloguj</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="jumbotron jumbotron-fluid height100p banner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="headerText text-center">
                    <h2>Dodaj produkt</h2>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="offset-sm-2 col-sm-8">
                <form class="form-container" method="post">
                    <div class="form-group">
                        <label style="color:white">Nazwa</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label style="color:white">Kategoria</label>
                        <input type="text" name="category" class="form-control">
                    </div>
                    <div class="form-group">
                        <label style="color:white">Ilość</label>
                        <input type="text" name="quantity" class="form-control">
                    </div>
                    <div class="form-group">
                        <label style="color:white">Producent</label>
                        <input type="text" name="brand" class="form-control">
                    </div>
                    <div class="form-group">
                        <label style="color:white">Cena</label>
                        <input type="text" name="price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label style="color:white">Kod kreskowy</label>
                        <input type="text" name="barCode" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" name="dodaj" class="btn btn-success btn-block" value="Dodaj" >
                    </div>
                </form>
                    <?php

                    if(isset($_POST['dodaj'])) {
                        if(!empty($_POST['name']) && !empty($_POST['category']) && !empty($_POST['quantity']) && !empty($_POST['brand']) && !empty($_POST['price'])&& !empty($_POST['barCode'])) {
                            include("connect.php");
                            $zapytanie = $pdo->prepare("INSERT INTO products (PROD_NAME, PROD_CATEGORY, PROD_QUANTITY,PROD_DATE, PROD_BRAND, PROD_PRICE,PROD_BARCODE)
                                                        VALUES(:PROD_NAME,:PROD_CATEGORY,:PROD_QUANTITY,'2019-06-11',:PROD_BRAND,:PROD_PRICE,:PROD_BARCODE)");
                            $zapytanie -> bindParam(':PROD_NAME', $_POST['name'], PDO::PARAM_STR, 30);
                            $zapytanie -> bindParam(':PROD_CATEGORY', $_POST['category'], PDO::PARAM_STR, 30);
                            $zapytanie -> bindParam(':PROD_QUANTITY', $_POST['quantity'], PDO::PARAM_INT, 11);
                            $zapytanie -> bindParam(':PROD_BRAND', $_POST['brand'], PDO::PARAM_STR, 30);
                            $zapytanie -> bindParam(':PROD_PRICE', $_POST['price'], PDO::PARAM_STR, 30);
                            $zapytanie -> bindParam(':PROD_BARCODE', $_POST['barCode'], PDO::PARAM_INT, 11);
                            $zapytanie->execute();
                            echo '<div class="card text-white bg-success"><div class="card-body text-center"><p class="card-text"><b>Dodano!</b></p></div></div>';
                        } else {
                            echo '<div class="card text-white bg-danger"><div class="card-body text-center"><p class="card-text"><b>Uzupełnij pola!</b></p></div></div>';
                        }
                    }
                    ?>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).scroll(function(){
        $('.navbar').toggleClass('scrolled', $(this).scrollTop() > $('.navbar').height());
    });
</script>
</body>
</html>