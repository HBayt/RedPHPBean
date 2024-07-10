<?php 

// ____________________________________________________________________________________________
// CRETAE A NEW VACATION AND INSERT IT INTO THE MySQL DATABASE 
// _____________________________________________________________________________________________
function createVacation($user_id, $start, $end) {
    $vacation = R::dispense('vacation');
    $vacation->user = R::load( 'user', $user_id );
    $vacation->start = $start;
    $vacation->end = $end; 
    R::store($vacation);
}

// ____________________________________________________________________________________________
// GET/RETURN A VACATION BY GIVEN USER_ID
// _____________________________________________________________________________________________

function getVacationByUser($user_id) {
    // return R::find('vacation', 'user_id = '. $user_id);
    $vacations = R::getAll("SELECT * FROM user LEFT JOIN vacation ON user.id = vacation.user_id WHERE user_id = ? ORDER BY user.name DESC", [$user_id,]);
    return $vacations;

}

// ____________________________________________________________________________________________
// DELETE A VACATION USING ITS ID
// _____________________________________________________________________________________________
function deleteVacation($id) {
    $vacation = R::load('vacation', $id);
    R::trash($vacation);
}

// ____________________________________________________________________________________________
// GET/RETURN ALL VACATIONS FROM THE TABLE VACATION (MySQL DB)
// _____________________________________________________________________________________________
function getVacations() {
    // $vacations = R::getAll("SELECT * FROM user LEFT JOIN vacation ON user.id = vacation.user_id WHERE user_id IS NOT NULL ORDER BY name ASC");
    $vacations = R::getAll("SELECT * FROM user LEFT JOIN vacation ON user.id = vacation.user_id WHERE user_id IS NOT NULL ORDER BY user.name DESC");
    return $vacations;
}

// ____________________________________________________________________________________________
// GET A VACATION USING IT ID 
// _____________________________________________________________________________________________
function geVacation($id) {
    return R::find('vacation', 'id = '. $id);
}


// ____________________________________________________________________________________________
// UPDATE A VACATION 
// _____________________________________________________________________________________________
function updateVacation($id, $start, $end, $user_id) {
    $vacation = R::load( 'vacation', $id ); 

    $vacation->start = $start;
    $vacation->end = $end; 
    $vacation->user_id = $user_id;

    R::store( $vacation ); 
}


