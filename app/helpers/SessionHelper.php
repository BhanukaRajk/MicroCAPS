<?php
session_start();

function isLoggedIn()
{
    if (isset($_SESSION['_id'])) {
        return true;
    } else {
        return false;
    }
}

