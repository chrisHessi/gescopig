<?php

return array(


    'pdf' => array(
        'enabled' => true,
//        'binary'  => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf"',
        //Production binary
        'binary' => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => '/usr/local/bin/wkhtmltoimage',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
