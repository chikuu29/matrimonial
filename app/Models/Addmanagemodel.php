<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addmanagemodel extends Model
{ 

    protected $tables = array('d' => 'm_process_name');  
    
    protected $table = 'm_process_name';
    
    protected $primaryKey = 'intProcessId';
    const CREATED_AT = 'dtmCreatedOn';
    const UPDATED_AT = 'dtmUpdatedOn';
}
