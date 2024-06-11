<?php 

function createVacation($user_id, $start, $end) {
    $vacation = R::dispense('vacation');
    $vacation->user = R::load( 'user', $user_id );
    $vacation->start = $start;
    $vacation->end = $end; 
    R::store($vacation);
}

function getVacationByUser($user_id) {
    return R::find('vacation', 'user_id = '. $user_id);
}

function deleteVacation($id) {
    $vacation = R::load('vacation', $id);
    R::trash($vacation);
}


function getVacations() {

    $vacations = R::getAll("SELECT * FROM user LEFT JOIN vacation ON user.id = vacation.user_id WHERE user_id IS NOT NULL");

    return $vacations;
}
