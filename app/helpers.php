<?php
function translate($en, $kh){
    if(app()->getLocale() == 'en'){
        return $en;
    }
    return $kh;
}