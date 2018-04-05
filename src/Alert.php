<?php

class Alert
{
    static function successAlert($text){

        echo '
        <script> 
        $(".alert-success").css("display", "block").text("' . $text . '")
        </script>
        ';
    }

    static function infoAlert($text){
        echo '
        <script> 
        $(".alert-info").css("display", "block").text("' . $text . '")
        </script>
        ';
    }

    static function dangerAlert($text){
        echo '
        <script> 
        $(".alert-danger").css("display", "block").text("' . $text . '")
        </script>
        ';
    }
}