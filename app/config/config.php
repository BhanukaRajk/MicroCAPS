<?php

    /* APP ROOT */
    
    define('APP_ROOT',dirname(dirname(__FILE__)));


    /* URL ROOT */

    const URL_ROOT = 'http://localhost:8888/MicroCAPS/';
    // const URL_ROOT = 'http://127.0.0.1:8080/MicroCAPS/'; // FOR MAMP STACK //
    // const URL_ROOT = 'http://localhost/MicroCAPS/';      // FOR XAMPP //


    /* SITE NAME */
    
    const SITE_NAME = 'MicroCAPS';




    /* DATABASE CONNECTION FOR LOCAL SERVER */

    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = 'root';             // USE PASSWORD AS '' FOR OTHER COMPUTERS
    const DB_NAME = 'microcaps2';       // USE NAME AS 'microcaps' FOR OTHER COMPUTERS


    /* DATABASE CONNECTION FOR CLOUD SERVER */

    // const DB_HOST = 'microcaps-db.co36o1syoru0.ap-northeast-1.rds.amazonaws.com';
    // const DB_USER = 'admin';
    // const DB_PASS = 'admin123';
    // const DB_NAME = 'microcaps';

?>