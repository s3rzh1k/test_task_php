<?php
    function finder($filename, $okey) {
        $file = fopen($filename, 'r+');
        if ($file) {
            while (!feof($file)) {
                $mytext = fgets($file, 4000);
                $mytext = mb_convert_encoding($mytext, "UTF-8");
                $array = explode("\x0A", $mytext);
                array_pop($array);
                foreach($array as $value) {
                }
                foreach($array as $key => $value) {
                    $array[$key] = explode("\t", $value);
                };
                $start = 0;
                $end = count($array) - 1;
                while ($start <= $end) {
                    $middle = floor(($start + $end) / 2);
                    $comparison = strnatcmp($array[$middle][0], $okey);
                    if ($comparison > 0) {
                        $end = $middle - 1;
                    } else if ($comparison < 0) {
                        $start = $middle + 1;
                    } else {
                        fclose($file);
                        return $array[$middle][1];
                    }
                }
            }
            fclose($file);
            return 'undef';
        } else echo "Ошибка при открытии файла";
    }
    $key = "ключ2";
    $filename = "args2.txt";
    $tag = finder($filename, $key);
    echo $tag;
?>

