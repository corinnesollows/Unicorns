<?php
class Confirm extends Controller
{
    public function confirmPage() {
        if(!isset($_SESSION))
            session_start();
        unset($_SESSION['cart']);
        $_SESSION['cart'] = [];
        $this->view('Confirm/Confirm');
    }
}
?>