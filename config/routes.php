<?php

return array(

    'conference/([0-9]+)' => 'conference/$1/view', 
    'conference/delete/([0-9]+)' => 'conference/$1/delete',
    'conference/edit/([0-9]+)' => 'conference/$1/edit',
    'conference/add' => 'conference/add',

    '' => 'conference/index'
);