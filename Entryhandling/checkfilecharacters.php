<?php
function ValidFileCharacters($str){
    $chararray = str_split($str);
    foreach($chararray as $letter){
        if (preg_match('/[^>A-Za-z0-9_-| ,.()]/', $letter)){
            return false;        
        }
    }
    return true;
}
?>