<?php

return [
    'project_list' => [
        'Project 1 / Software development',
        'Project 2 / Consulting',
    ],
    // invoice ID builds from invoice date as Date::format(<invoice_id_pattern>)
    // check PHP DateTime formatter for details
    'invoice_id_pattern' => 'ymd',
];
