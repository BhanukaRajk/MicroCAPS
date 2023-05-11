<?php

    /* Config */
    require_once 'config/config.php';

    /* Helpers */
    require_once 'helpers/DateHelper.php';
    require_once 'helpers/EmailHelper.php';
    require_once 'helpers/HtmlHelper.php';
    require_once 'helpers/PDFConverter.php';
    require_once 'helpers/UrlHelper.php';
    require_once 'helpers/SessionHelper.php';

    /* Libraries */
    spl_autoload_register( function( $className ) {
        require_once 'libraries/'.$className.'.php';
    });

    spl_autoload_register( function( $className ) {
        require_once 'PHPMailer/src/'.$className.'.php';
    });