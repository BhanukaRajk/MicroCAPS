<<<<<<< HEAD
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

        public function strtoarray($string): array {

            $string = trim($string, '{}');

            $pair_strings = explode(',', $string);

            // Initialize an empty array to store the key-value pairs
            $array = array();

            // Loop through each pair and add it to the array
            foreach ($pair_strings as $pair_string) {
                // Split the pair string into key and value
                list($key, $value) = explode(':', $pair_string);

                // Remove any quotes or spaces from the key
                $key = trim($key, '\'" ');

                // Convert the value to a boolean
                $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);

                // Add the key-value pair to the array
                $array[$key] = $value;
            }

            return $array;
        }

=======
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

>>>>>>> bhanuka
    }