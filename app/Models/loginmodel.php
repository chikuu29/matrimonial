<?php

namespace App\Models; 
use App\Models\AppModel;

//use Illuminate\Database\Eloquent\Model;

class loginmodel extends Model
{
    protected $tables = array('d' => 'm_admin_user_master');  
    
    protected $table = 'm_admin_user_master';
    
    protected $primaryKey = 'intUserId';
    const CREATED_AT = 'dtmCreatedOn';
    const UPDATED_AT = 'dtmUpdatedOn';
}
