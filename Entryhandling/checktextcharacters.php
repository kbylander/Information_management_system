<?php
function ValidFileCharacters($str){
    return !preg_match('/[^>A-Za-z0-9_-| ,.()]/', $str);
}
?>
