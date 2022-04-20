<?php
return array(
    'site_zregistry_carlist' => array(
        'id' => array('int', 50, 'null' => 0, 'autoincrement' => 1),
        'car_number' => array('varchar', 6, 'null' => 0),
        'region_number' => array('int', 3, 'null' => 0),
        'address' => array('varchar', 255, 'null' => 0),
        'address_type' => array('varchar', 20, 'null' => 0),
        'status' => array('varchar', 20, 'null' => 0),
        'date' => array('timestamp', 'null' => 0, 'default' => 'CURRENT_TIMESTAMP'),
        ':keys' => array(
            'PRIMARY' => 'id',
            'id' => array('id', 'unique' => 1),
        ),
    ),
    'site_zregistry_photos' => array(
        'id' => array('int', 50, 'null' => 0, 'autoincrement' => 1),
        'id_car' => array('int', 50, 'null' => 0),
        'value' => array('varchar', 255, 'null' => 0),
        ':keys' => array(
            'PRIMARY' => 'id',
        ),
    ),
);
