<?php
session_start();

function isLoggedIn(): bool {
    if (isset($_SESSION['_id'])) {
        return true;
    } else {
        return false;
    }
}

function checkPosition($position): bool {

    if ($_SESSION['_position'] == $position) {
        return true;
    } else {
        return false;
    }

}

