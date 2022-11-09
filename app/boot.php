<?php

    /* Config */
    require_once 'config/config.php';

    /* Libraries */
    //    require_once 'libraries/core.php';
    //    require_once 'libraries/controller.php';
    //    require_once 'libraries/database.php';

    /* Libraries */
    spl_autoload_register( function( $className ) {
        require_once 'libraries/'.$className.'.php';
    });
