<?php
function ValidFileCharacters($str){
    $pattern='/[^¨>A-Za-z0-9_-| ,.()]/';
    $replacement = '';
    preg_replace($pattern, $replacement, $str, $count);
    echo $count;
    if ($count != 0){
        return false;
    }
    return true;
}
?>