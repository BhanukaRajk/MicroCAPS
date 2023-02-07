
<?php

function rearrange($date) {
    $date = explode('-', $date);
    $date = array_reverse($date);
    $date = implode(' - ', $date);
    return $date;
}