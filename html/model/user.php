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
    // R::getAll( 'select * from books WHERE accepted IS NULL ORDER BY update_time DESC LIMIT 100 ' ); 
    
    // $users = R::getAll( 'select * from user WHERE email IS NOT NULL ORDER BY name DESC' ); 
    // $users = R::findAll( 'user' );
    $users = R::findAll('user' , 'WHERE email IS NOT NULL ORDER BY name ASC');
    return $users;
}


function getUserIdByEmail($email) {

    // return R::find('user', 'email LIKE ? LIMIT 1', [$email]); 
    // return R::find ('bean', "battribute is NULL" ); 

    // return R::getRow( 'SELECT * FROM user WHERE email LIKE ? LIMIT 1', [ '%Jazz%' ]); 
    // return R::getRow( 'SELECT id, email, group_id FROM user WHERE email LIKE ? LIMIT 1', [$email]); 

    //  $user  = R::findOne( 'user', ' email = ? ', [ 'user@mail.com' ] );
    $user  = R::findOne( 'user', ' email=?', [$email] ); // $user = R::findOne('user', 'email = ? ', array($email));

    // var_dump( $user ); 
    return $user; 

    
}



function deleteUser($id) {
    $user = R::load( 'user', $id ); 
    R::trash( $user );
}

function getUserByGroup($group_id) {

    // R::getAll( 'select * from book where id= :id AND active = :act',array(':id'=>$id,':act' => 1) );
    return R::find('user', 'group_id = '. $group_id);

}

function addVacationToUser ($user_id, $begin, $end) {
    
}