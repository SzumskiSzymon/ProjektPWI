<?php
if(!isset($_SESSION['email'])) {
    session_start();
    ob_start();
    include("functions.php");
}
if(!log_in()) {
    exit();
} else {
    if(acc($_SESSION['email']) == 'Admin') {
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
    <div class="container h100">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="contentBox h100">
                    <table class="table table-hover table-dark">
                        <thead>
                        <tr>
                            <th scope="col">Nazwa</th>
                            <th scope="col">Kategoria</th>
                            <th scope="col">Data ważn</th>
                            <th scope="col">Producent</th>
                            <th scope="col">Cena</th>
                            <th scope="col">Ilosc</th>
                            <th scope="col">Kod kreskowy</th>
                            <th scope="col">Akcja</th>
                        </tr>
                        </thead>
                        <tbody>
                            <form method="post">
                                <?php
                                include("connect.php");
                                $query = $pdo->query("SELECT * FROM products");
                                $query->execute();
                                $dane = $query -> fetchAll();
                                foreach ($dane as $row) {
                                    echo "<tr>";
                                    echo '<th scope="col">'.$row['PROD_NAME'].'</th>';
                                    echo '<th scope="col">'.$row['PROD_CATEGORY'].'</th>';
                                    echo '<th scope="col">'.$row['PROD_DATE'].'</th>';
                                    echo '<th scope="col">'.$row['PROD_BRAND'].'</th>';
                                    echo '<th scope="col">'.$row['PROD_PRICE'].'</th>';
                                    echo '<th scope="col">'.$row['PROD_QUANTITY'].'</th>';
                                    echo '<th scope="col">'.$row['PROD_BARCODE'].'</th>';
                                    echo '<th scope="row"><div class="form-row"><input type="submit" name="del-'.$row['PROD_ID'].'" class="btn btn-danger" value="Usuń" ></div></th>';
                                    echo "</tr>";
                                    $delvar = "del-".$row['PROD_ID'];
                                    if(isset($_POST["$delvar"])) {
                                        $del = $pdo -> prepare("DELETE FROM products WHERE PROD_ID = :id");
                                        $del->bindParam(':id', $row['PROD_ID'], PDO::PARAM_INT, 3);
                                        $del->execute();
                                        header('refresh: 1;');
                                    }
                                }
                                ?>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-3 col-md-3 col-lg-3">
                <form action="addProduct.php">
                    <input type="submit" name="dodaj" class="btn btn-success btn-block" value="Dodaj" >
                </form>
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