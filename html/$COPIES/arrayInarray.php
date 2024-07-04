

You could also use array_values() within a Loop for that like so:

<?php
    $result = [];
    $arr    = [
            [
            'phone_mobile'  => '+16046799329',
            'first_name'    => '',
            'last_name'     => 'test'
            ],
            [
            'phone_mobile'  => '7326751700',
            'first_name'    => 'Ralph',
            'last_name'     => 'OBrien'
            ],
            [
            'phone_mobile'  => '3204937568',
            'first_name'    => 'Chris',
            'last_name'     => 'Barth'
            ],
    ];

    foreach($arr as $i=>$data){
        $result[]   = array_values($data);
    }
    var_dump($result);



    // to to do 
    https://www.geeksforgeeks.org/multidimensional-arrays-in-php/