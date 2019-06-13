<?php
session_start();
include("functions.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Stona Glowna</title>

    <link href="css/fontello.css" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="style.css" rel="stylesheet">
</head>
<body data-spy="scroll" data-targer=".navbar" data-offset="50">
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Kamix</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home"><i class="icon-home" style="color:white"></i>
                            Strona Główna<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-tags"
                                                                                                style="color:white"></i>
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
                    <?php
                    if (log_in()) {
                        echo '<li class="nav-item"><a class="nav-link" href="login.php"><i class="icon-user" style="color:white"></i>Moje konto</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="wyloguj.php">Wyloguj</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link" href="myAcc.php"><i class="icon-user" style="color:white"></i>Zaloguj</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="jumbotron jumbotron-fluid height100p banner" id="home">
    <div class="container h100">
        <div class="contentBox h100">
            <div>
                <h1>Strona powitalna</h1>
                <p>zobacz nasza oferte</p>
                <a href="#ourOffer" class="btn btnD3">Nasza oferta</a>
            </div>
        </div>
    </div>
</div>
<section class="sec1" id="ourOffer">
    <div class="container">
        <div class="row">
            <div class="offset-sm-2 col-sm-8">
                <div class="headerText text-center">
                    <h2>Nasza oferta</h2>
                    <p>Wybierz</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="box">
                    <div class="content">
                        <h2><i class="icon-basket"></i></h2>
                        <h3>Produkty</h3>
                        <p>Lorem ipsum</p>
                        <a href="#products">Wiecej</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="box">
                    <div class="content">
                        <h2><i class="icon-newspaper"></i></h2>
                        <h3>Gazetka</h3>
                        <p>Lorem ipsum</p>
                        <a href="#newspaper">Wiecej</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="box">
                    <div class="content">
                        <h2><i class="icon-tags"></i></h2>
                        <h3>Nowości</h3>
                        <p>Lorem ipsum</p>
                        <a href="#promotions">Wiecej</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="sec2" id="products">
    <div class="container h100">
        <div class="headerText text-center">
            <h2>Produkty</h2>
        </div>
        <div class="contentBox h100">
            <form method="post">
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
                        $user_id = $_SESSION['id'];
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
                            echo '<th scope="row"><div class="form-row"><input type="submit" name="add-'.$row['PROD_ID'].'" class="btn btn-success btn-block" value="Dodaj" ></div></th>';
                            echo "</tr>";
                            $addvar = "add-".$row['PROD_ID'];
                            if(isset($_POST["$addvar"])) {
                                $add = $pdo -> prepare("INSERT INTO orders (USER_ID, PROD_NAME, PROD_CAT,PROD_DATE, PROD_BRAND, PROD_PRICE)
                                                        VALUES($user_id,:name,:cat,'2019-06-11',brand,:price)");
                                $add->bindParam(':name', $row['PROD_NAME'], PDO::PARAM_STR);
                                $add->bindParam(':cat', $row['PROD_CATEGORY'], PDO::PARAM_STR);
                                $add->bindParam(':brand', $row['PROD_BRAND'], PDO::PARAM_STR);
                                $add->bindParam(':price', $row['PROD_PRICE'], PDO::PARAM_STR);

                                $add->execute();
                            }
                        }
                        ?>
                    </form>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</section>
<section class="sec3" id="newspaper">
    <div class="container h100">
        <div class="headerText text-center">
            <h2>Gazetka</h2>
        </div>
        <div class="row h100">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/baner1.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="img/baner1.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="img/baner1.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="sec4" id="promotions">
    <div class="container h100">
        <div class="headerText text-center">
            <h2>Nowości</h2>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="box">

                </div>
            </div>
        </div>
    </div>
</section>
<section class="sec5" id="aboutUs">
    <div class="container h100">
        <div class="row">
            <div class="col-sm-6">
                <div class="section_title"><br>
                    <div class="section_subtitle">O nas</div>
                    <h2 class="section_main_title">Jestesmy <strong>KREATYWNI</strong></h2>
                </div>
                <div class="about-item">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </p>
                </div>
            </div>
            <div class="col-sm-4 col-sm-offset-2">
                <div class="about-box">
                    <div class="box-overlay"></div>
                    <a href="www.youtube.com" class="videopopup">
                        <img src="img/baner1.png" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="sec6" id="supply">
    <div class="container h100">
        <div class="contentBox h100">
            <div>
                <h1>Dostawa</h1>
                <p>info o dostawie</p>
                <a href="#" class="btn btnD1">Wiecej</a>
            </div>
        </div>
    </div>
</section>
<section class="contact" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="headerText text-center">
                    <h2>Napisz do nas!</h2>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="offset-sm-2 col-sm-8">
                <form>
                    <div class="form-group">
                        <label>Imie</label>
                        <input type="text" name="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" email="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Telefon</label>
                        <input type="text" phone="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Wiadomosc</label>
                        <textarea class="form-control textarea" name=""></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btnD1">wyslij</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<footer class="py-5 bg-dark">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="float-left">
                    <div class="row">
                        <div class="col-4">
                            <p class="text-white"><i class="icon-mail-alt" style="color:white"></i>Kamix@waw.pl</p>
                        </div>
                        <div class="col-4">
                            <p class="text-white"><i class="icon-phone-squared" style="color:white"></i>123 123 123</p>
                        </div>
                        <div class="col-4">
                            <p class="text-white">
                                <i class="icon-direction" style="color:white"></i>ul.Mocna 23 Warszawa</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="float-right">
                    <p class="m-0 text-center text-white">Szumski Szymon</p>
                </div>
            </div>
            <div class="col-3">
                <p class="m-0 text-center text-white">Copyright © Kamix sp. zoo</p>
            </div>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).scroll(function () {
        $('.navbar').toggleClass('scrolled', $(this).scrollTop() > $('.navbar').height());
    });
</script>
</body>
</html>