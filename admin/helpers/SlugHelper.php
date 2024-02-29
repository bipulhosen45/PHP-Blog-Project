<?php


trait SlugHelper
{
    function str_slug($string){
//        $string = mb_strtolower($string,'UTF-8');
//        $string = str_replace('?', '', $string);
//        $string = str_replace('%', '', $string);
//        $string = preg_replace('/\s+/u', '-', trim($string));
//        return $string;
      return mb_strtolower(preg_replace('/[ ,.@#$%^&*()_\/=]+/', '-', trim($string)), 'UTF-8');
    }
}