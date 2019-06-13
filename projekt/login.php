<?php
    if(!isset($_SESSION['email'])) {
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
            <div class="container h100">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-10">
                            <form method="post">
                                <div class="contentBox h100">
                                    <table class="table table-hover table-dark">
                                        <?php
                                            include("connect.php");
                                            $query = $pdo->prepare("SELECT * FROM users WHERE USER_ACC_ID =  :id");
                                            $query->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT, 3);
                                            $query->execute();
                                            $dane = $query -> fetchAll();
                                        ?>
                                            <tbody>
                                            <tr>
                                                <th scope="row">Imie</th>
                                                <th scope="row"><input type="text" class="form-control" value="<?php echo $dane[0]['USER_NAME']; ?>" name="name"></th>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nazwisko</th>
                                                <th scope="row"><input type="text" class="form-control" value="<?php echo $dane[0]['USER_SURNAME']; ?>" name="surname"></th>
                                            </tr>
                                            <tr>
                                                <th scope="row">Numer telefonu</th>
                                                <th scope="row"><input type="text" class="form-control" value="<?php echo $dane[0]['USER_PH_NR']; ?>" name="tel"></th>
                                            </tr>
                                            <tr>
                                                <th scope="row">Adres</th>
                                                <th scope="row"><input type="text" class="form-control" value="<?php echo $dane[0]['USER_ADDRESS']; ?>" name="addr"></th>
                                            </tr>
                                            <tr>
                                                <th scope="row">Data założenia</th>
                                                <th scope="row"><input type="text" class="form-control" value="<?php echo $dane[0]['USER_CREAT_DATE']; ?>" name="date" disabled></th>
                                            </tr>
                                            </tbody>
                                    </table>
                                </div>
                                <input type="submit" name="edit" class="btn btn-success btn-block">
                            </form>
                            <?php
                            if(isset($_POST['edit'])) {
                                if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['tel']) && !empty($_POST['addr'])) {
                                    $zapytanie = $pdo->prepare("UPDATE users SET USER_NAME = :name, USER_SURNAME = :surname, USER_PH_NR = :tel, USER_ADDRESS = :addr WHERE USER_ACC_ID = :id");
                                    $zapytanie -> bindParam(':name', $_POST['name'], PDO::PARAM_STR, 50);
                                    $zapytanie -> bindParam(':surname', $_POST['surname'], PDO::PARAM_STR, 50);
                                    $zapytanie -> bindParam(':tel', $_POST['tel'], PDO::PARAM_INT, 9);
                                    $zapytanie -> bindParam(':addr', $_POST['addr'], PDO::PARAM_STR, 50);
                                    $zapytanie -> bindParam(':id', $_SESSION['id'], PDO::PARAM_INT, 3);
                                    $zapytanie->execute();
                                    echo '<div class="card text-white bg-success"><div class="card-body text-center"><p class="card-text"><b>Zmieniono!</b></p></div></div>';
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