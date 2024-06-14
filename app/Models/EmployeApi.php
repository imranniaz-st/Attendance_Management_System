<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeApi extends Model
{
    // Specify the connection name defined in config/database.php
    protected $connection = 'second_db';

    // Specify the table associated with the model
    protected $table = 'employees';
}
