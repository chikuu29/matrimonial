<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class moduleNamemodel extends Model
{ protected $tables = array('d' => 'm_module_name');  
    
    protected $table = 'm_module_name';
    
    protected $primaryKey = 'intModuleId';
    const CREATED_AT = 'dtmCreatedOn';
    const UPDATED_AT = 'dtmUpdatedOn';
}
