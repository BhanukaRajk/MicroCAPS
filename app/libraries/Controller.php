<?php

    /* Controller Base | Load the models and views */

    class Controller {

        /* Model */
        public function model( $model ) {

            require_once '../app/models/' . $model . '.php';

            return new $model();

        }

        /* View */
        public function view( $view, $data = [] ) {

            if( file_exists( '../app/views/' . $view . '.php' ) ) {

                $data['url'] = getUrl();
                require_once '../app/views/' . $view . '.php';

            } else {

                die( 'View does not exist' );

            }

        }

        public function Sum($data, $str) : int {
            $sum = 0;
            if (empty($data)) {
                return $sum;
            }
            foreach ($data as $value) {
                $sum += $value->$str;
            }
            return $sum;
        }

    }