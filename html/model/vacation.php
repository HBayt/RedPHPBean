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

function geVacation($id) {
    return R::find('vacation', 'id = '. $id);
}



function updateVacation($id, $start, $end, $user_id) {
    $vacation = R::load( 'vacation', $id );
    $vacation->start = $start;
    $vacation->end = $end; 
    $vacation->user_id = $user_id;

    R::store( $vacation ); 

    // var_dump($user_id);  
}


/*
function getUserIdByEmail($email) {

    // return R::find('user', 'email LIKE ? LIMIT 1', [$email]); 
    // R::getRow( 'SELECT * FROM user WHERE email LIKE ? LIMIT 1', [ '%Jazz%' ]); 
    //  $book  = R::findOne( 'book', ' title = ? ', [ 'SQL Dreams' ] );

    // return R::getRow( 'SELECT id, email, group_id FROM user WHERE email LIKE ? LIMIT 1', [$email]); 
    $user  = R::findOne( 'user', ' email = ? ', [ $email ] );
    return $user; 

}

*/ 