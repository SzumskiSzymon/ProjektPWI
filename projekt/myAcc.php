<?php
    session_start();
    ob_start();
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
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
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
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="sec7">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3"></div>
                    <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6">
                        <form class="form-container" method="post">
                            <h1 class="text-center" style="color:white">Login</h1>
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="color:white">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1" style="color:white">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                            </div>
                            <input type="submit" name="zaloguj" class="btn btn-success btn-block" value="Submit" >
                        </form>
                        <?php
                        if(isset($_POST['zaloguj'])) {
                            if(!empty($_POST['password']) && !empty($_POST['email'])) {
                                include("connect.php");
                                $zapytanie = $pdo->prepare("SELECT * FROM users_accounts where U_EMAIL = :email AND U_PASSWORD = :password");
                                $zapytanie->bindParam(':email', $_POST['email'], PDO::PARAM_STR, 50);
                                $hash1 = $hash = hash('sha256', $_POST['password']);
                                $zapytanie->bindParam(':password', $hash1, PDO::PARAM_STR, 64);
                                $zapytanie->execute();
                                $wynik = $zapytanie->rowCount();
                                if($wynik == 1) {
                                    $dane = $zapytanie->fetchAll();
                                    $_SESSION['password'] = $dane[0]['U_PASSWORD'];
                                    $_SESSION['email'] = $dane[0]['U_EMAIL'];
                                    $_SESSION['id'] = $dane[0]['U_ID'];
                                    header("Location: login.php");
                                } else {
                                    echo '<div class="card text-white bg-danger"><div class="card-body text-center"><p class="card-text"><b>Nazwa użytkownika lub hasło są nieprawidłowe.</b></p></div></div>';
                                }
                            } else {
                                echo '<div class="card text-white bg-danger"><div class="card-body text-center"><p class="card-text"><b>Wypełnij pola logowania!</b></p></div></div>';
                            }
                        }
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3"></div>
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
