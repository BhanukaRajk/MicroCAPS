<?php
// Simple page redirect
function redirect($page)
{
    header('location: ' . URL_ROOT . $page);
}

function getUrl()
{

    if (isset($_GET['url'])) {

        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
    }
}
