<?php
function validcharachters($str){
    return !preg_match('/[^>A-Za-z0-9_-| ,.()=]/', $str);
}
?>

<?php
function validseq($str){
    return !preg_match('/[^>A-Za-z0-9_-| ,.()]/', $str);
}
?>
