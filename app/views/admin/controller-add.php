<?php

    $errors = [];
    $table = 'my_times';

    if($_SERVER['REQUEST_METHOD'] == 'POST')

        if (isset($_POST['btn_saved'])) {


            $date_start = strtotime($_POST['time_started']);
            $date_end = strtotime($_POST['time_ended']);

            if ( $date_start > $date_end ) {
                array_push($errors, 'You made a mistake, date end is above date start');
            }

            if(empty($_POST['time_started'])) array_push($errors, 'Select Date You Started');
            if(empty($_POST['time_ended'])) array_push($errors, 'Select Date You Finished');

            unset($_POST['btn_saved']);

            if(count($errors) == 0)
                create($table, $_POST);
                // dd($_POST);




        }

        
