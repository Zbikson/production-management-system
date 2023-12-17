<?php
require_once 'models/Detail.php';
require_once __DIR__ . '/../models/Database.php';
class DetailController {

    public function addDetail() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $detail = $_POST['detail-name'];
            

            if (Detail::getByDetailName($detail)) {
                $_SESSION['error_detail'] = 'Detal o takiej nazwie już istnieje!';
                header('Location: index.php?action=add-detail');
            }else{
                // Tworzenie nowego użytkownika
                $newDetail = new Detail($detail);
                $newDetail->save();

                header('Location: index.php?action=add-detail-view');
                $_SESSION['success_detail'] = 'Dodano detal!';
                
            }            
        } else {
            // Wyświetlenie formularza logowania
            include 'views/login.php';
        }
    }

public function addDetailView(){
    include 'views/add-detail-view.php';
}

}
?>