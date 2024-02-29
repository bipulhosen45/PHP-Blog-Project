<?php


class Helper
{
    public function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function str_limit($string,$limit=100)
    {
        $string = $string. "";
        $string = mb_substr($string, 0,$limit);
        $string = mb_substr($string, 0,mb_strrpos($string, " "));
        $string = $string."...";
        return $string;
    }

    public  function limit($value, $limit = 100, $end = '...')
    {
        if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
        }
        return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
    }
}