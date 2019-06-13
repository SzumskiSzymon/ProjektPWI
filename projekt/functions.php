<?php
//sprawdzanie czy ktoś zalogowany
function log_in() {
    if(!empty($_SESSION['password']) && !empty($_SESSION['email'])) {
        return true;
    } else {
        return false;
    }
}
//sprawdzanie administracji
function acc($email) {
    include("connect.php");
    $zapytanie1 = $pdo->prepare("SELECT c.DESCRIPTION FROM users_accounts a, users b, access_rights c WHERE a.U_EMAIL = :email AND b.USER_ACC_ID = a.U_ID AND b.ACCESS_RIGHTS = c.ACCESS_ID");
    $zapytanie1->bindParam(':email', $email, PDO::PARAM_STR, 50);
    $zapytanie1->execute();
    $wynik0 = $zapytanie1->fetchAll();

    if($wynik0[0]['DESCRIPTION'] == 'admin') {
        return 'Admin';
    } elseif($wynik0[0]['DESCRIPTION'] == 'mod') {
        return 'Mod';
    } elseif($wynik0[0]['DESCRIPTION']== 'user') {
        return 'User';
    } else {
        return false;
    }
}

?>