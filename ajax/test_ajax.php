<?php
function date_range($first, $last, $step = '+1 day', $output_format = 'd-m-Y' ) {

    $dates = array();
    $current = strtotime($first);
    $last = strtotime($last);

    while( $current <= $last ) {

        $dates[] = date($output_format, $current);
        $current = strtotime($step, $current);
    }

    return $dates;
}

$date = date_range('09/23/2020', '10/14/2020', "+1 day", "d-m");
echo json_encode($date);