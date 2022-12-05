<?php
include "db.php";
function check_autorize($log, $pas) {
    global $users;
    return array_key_exists($log, $users) && $pas == $users[$log];
}

function check_admin($log, $pas)
{
    global $users;
    return array_key_exists($log, $users) && $pas == $users["admin"];
}

function check_log($log)
{
    return $log == "admin";
}

function out_arr()
{
    global $countries;
    $arr_out = [];
    $arr_out[] = "<table  class=\"table text-white-50\">";
    $arr_out[] = "<tr><td>№</td><td>Book</td><td>Name</td><td>Autor</td><td>Genre</td><td>Prise</td><td>Published</td><td>In stock</td></tr> \n"; 
    foreach ($countries as $country) {
        static $i = 1; 
        //статическая глобальная переменная-счетчик
        $str = "<tr>";
        $str .= "<td>" . $i . "</td>";
        foreach ($country as $key => $value) {
            if (!is_array($value)) {
                if($key == "poster"){
                    $str .= "<td><img src=\"img/$value\"></td>";
                }
                else{
                    $str .= "<td>$value</td>";
                }
            } else {
                foreach ($value as $k => $v) {
                    $str .= "<td>$v</td>";
                }
        }
      }
        $str .= "</tr> \n";
        $arr_out[] = $str;
        $i++;
}    
    $arr_out[] = "</table> \n";
    return $arr_out;

}
function name($a, $b)
{ // функция, определяющая способ сортировки (по названию столицы)
    if ($a["name"] < $b["name"]) {
        return -1;
    } elseif ($a["name"] == $b["name"]) {
        return 0;
    } else {
        return 1;
    }

}

function autor($a, $b)
{ // функция, определяющая способ сортировки (по названию столицы)
    if ($a["autor"] < $b["autor"]) {
        return -1;
    } elseif ($a["autor"] == $b["autor"]) {
        return 0;
    } else {
        return 1;
    }

}
    function genre($a, $b)
    { // функция, определяющая способ сортировки (по жанрам)
        if ($a["genre"] < $b["genre"]) {
            return -1;
        } elseif ($a["genre"] == $b["genre"]) {
            return 0;
        } else {
            return 1;
        }
    }

function prise($a, $b)
{ // функция, определяющая способ сортировки (по жанрам)
    if ($a["prise"] < $b["prise"]) {
        return -1;
    } elseif ($a["prise"] == $b["prise"]) {
        return 0;
    } else {
        return 1;
    }
}

function pub($a, $b)
{ // функция, определяющая способ сортировки (по жанрам)
    if ($a["pub"] < $b["pub"]) {
        return -1;
    } elseif ($a["pub"] == $b["pub"]) {
        return 0;
    } else {
        return 1;
    }
}

function stok($a, $b)
{ // функция, определяющая способ сортировки (по жанрам)
    if ($a["stok"] < $b["stok"]) {
        return -1;
    } elseif ($a["stok"] == $b["stok"]) {
        return 0;
    } else {
        return 1;
    }
}

function sorting($p)
{
    global $countries;
    uasort($countries, $p);
}

function out_arr_search(array $arr_index = null)
{
    global $countries; // делаем переменную $countries глобальной
    $arr_out = array();
    $arr_out[] = "<table  class=\"table text-white-50\">";
    $arr_out[] = "<tr><td>№</td><td>Book</td><td>Autor</td><td>Genre</td><td>Prise</td><td>Published</td><td>In stock</td></tr>";
    foreach ($countries as $index => $country) {
        if ($arr_index != null && in_array($index, $arr_index)) {
            static $i = 1;
            $str = "<tr>" . "<td>" . $i . "</td>";
            foreach ($country as $key => $value) {
                if (!is_array($value)) {
                    //$str .= "<td>$value</td>";
                    if($key == "poster"){
                        $str .= "<td><img src=\"img/$value\"></td>";
                    }
                    else{
                        $str .= "<td>$value</td>";
                    } 
                } else {
                    foreach ($value as $k => $v) {
                        $str .= "<td>$v</td>";
                    }
                }
            }
            $arr_out[] = $str;
            $i++;
        }
    }
    $arr_out[] = "</table>";
    return $arr_out;
}

function out_search($data)
{
    global $countries; // делаем переменную $countries глобальной
    $arr_index = array();
    foreach ($countries as $country_number => $country) {
        foreach ($country as $key => $value) {
            if (!is_array($value)) {
                if (stristr($value, $data)) {
                    $arr_index[] = $country_number;
                }
            } else {
                foreach ($value as $k => $v) {
                    if (stristr($v, $data) || strstr($k, $data)) {
                        $arr_index[] = $country_number;
                    }
                }
            }
        }
    }
    return out_arr_search(array_unique($arr_index));
}

function test_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}
