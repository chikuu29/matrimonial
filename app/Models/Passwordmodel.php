<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passwordmodel extends Model
{
    protected $tables = array('d' => 'm_admin_user_master');  
    
    protected $table = 'm_admin_user_master';
    
    protected $primaryKey = 'intUserId';
    const CREATED_AT = 'dtmCreatedOn';
    const UPDATED_AT = 'dtmUpdatedOn';
}
