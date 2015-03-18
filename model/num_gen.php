<?php


 $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

function gen_ran_patient_num($rnd_length = 6) {
    global $characters;
    $string = '';
    for ($i = 0; $i < $rnd_length; $i++) {
         $string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $string;
}

?>