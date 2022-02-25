<?php
function ValidCharacters($str){
    return !preg_match('/[^>A-Za-z0-9_-| ,.()]/', $str);
}
?>
