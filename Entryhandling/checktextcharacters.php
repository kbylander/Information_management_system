<?php
// returns true if no matches occcur i.e. no illegal characters in the header. Otherwise false. 
function validcharachters($str){
    return !preg_match('/([^a-zA-Z0-9 .,>=|\n\r])/', $str);
}
?>

<?php
// returns true if no matches occcur i.e. no illegal characters in the sequnence. Otherwise false.
function validseq($str){
    return !preg_match('/[^A-Za-z \n]/', $str);
}
?>
