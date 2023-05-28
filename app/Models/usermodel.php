<?php

namespace App\Models;

use App\Models\AppModel;

class usermodel extends Model
{
    //
    protected $tables = array('d' => 't_faq');  
    
    protected $table = 't_faq';
    
    protected $primaryKey = 'intId';
    const CREATED_AT = 'dtmCreatedOn';
    const UPDATED_AT = 'dtmUpdatedOn';
}

