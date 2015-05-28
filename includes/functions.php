<?php
                                // A simple function to display time ago in words
function time_ago($ptime) {
    $output = '';
    $tmeasures = ['minute','hour','day','week', 'month', 'year'];
    $units = [60, 60, 24, 7, 4, 12];
    $ntime = time() - strtotime($ptime);
    if ($ntime < 60){
        $output = 'just now';
    } else {
        for($t = 0; $t < 6 && floor(($ntime / $units[$t])) > 0; $t++){
            $ntime /= $units[$t];
            $output = floor($ntime) . ' ' . $tmeasures[$t] . ($ntime > 2 ? 's' : '') . ' ago';
        }
    }
    return $output;
}
?>