<?php 

function createUser ($name, $email, $weekdays) {
    $user = R::dispense( 'user' );
    $user->name = $name;
    $user->email = $email;
    $user->weekdays = json_encode($weekdays);
    $user->doneTask = 0;
    return R::store( $user );
}

function updateUser($id, $name, $email, $weekdays) {
    $user = R::load( 'user', $id );
    $user->name = $name;
    $user->email = $email;
    $user->weekdays = json_encode($weekdays);
    R::store( $user );
}

function getUser() {
    $users = R::findAll( 'user' );
    return $users;
}


function getUserIdByEmail($email) {

    // return R::find('user', 'email LIKE ? LIMIT 1', [$email]); 
    // R::getRow( 'SELECT * FROM user WHERE email LIKE ? LIMIT 1', [ '%Jazz%' ]); 
    //  $book  = R::findOne( 'book', ' title = ? ', [ 'SQL Dreams' ] );

    // return R::getRow( 'SELECT id, email, group_id FROM user WHERE email LIKE ? LIMIT 1', [$email]); 
    $user  = R::findOne( 'user', ' email = ? ', [ $email ] );
    // $user =  R::load( 'user', $email );
    return $user; 

}



function deleteUser($id) {
    $user = R::load( 'user', $id ); 
    R::trash( $user );
}

function getUserByGroup($group_id) {
    return R::find('user', 'group_id = '. $group_id);
}

function addVacationToUser ($user_id, $begin, $end) {
    
}