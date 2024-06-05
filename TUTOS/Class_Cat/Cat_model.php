<?php

class 
{
    // ____________________________________
    // INSERT INTO 
    // ____________________________________
    public static function addCat($cat)
    {
        $catModel = R::dispense("cats"); 
        $catModel['name'] = $cat['name']; 
        $catModel['size'] = $cat['size']; 

        try{
            R::store($catModel): 
            return 1; 
        }catch(Exception $e){
            return $e
        }


    }// END .addCat()

    // ____________________________________
    // SELECT ONE ROW 
    // ____________________________________
    public static function getCat($cid){
        try{
            return R::load("cats", $cid); 
        }catch(Exception $e){
            return $e
        }
    }// END .getCat()


    // ____________________________________
    // DELETE ONE ROW
    // ____________________________________
    public static function deleteCat($cid){
        try{
            $cat R::load("cats", $cid); 
            R::trash($cat); 
            return 1; 
        }catch(Exception $e){
            return $e
        }        

    }// END .deleteCat()

    // ____________________________________
    // UPDATE ONE ROW 
    // ____________________________________
    public static function updateCat($cat){

        $catModel = R::load("cats", $cat['id']); 
        $catModel['name'] = $cat['name']; 
        $catModel['size'] = $cat['size'];        

        try{
            R::store($catModel); 
            return 1; 

        }catch(Exception $e){
            return $e
        }        
    }// END .updateCat()



}

// https://www.youtube.com/watch?v=ao1xzS7BEFk&ab_channel=Seritrex 










    ?> <!--- End ?PHP ---> 
<?php
    
