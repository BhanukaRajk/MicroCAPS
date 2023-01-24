<?php

    /* Config */
    require_once 'config/config.php';

    require_once 'helpers/UrlHelper.php';
    require_once 'helpers/SessionHelper.php';

    /* Libraries */
    spl_autoload_register( function( $className ) {
        require_once 'libraries/'.$className.'.php';
    });