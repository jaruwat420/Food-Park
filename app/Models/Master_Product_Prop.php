<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_Product_Prop extends Model
{
    use HasFactory;

        // Set the table name to the view name
        protected $table = 'Master_Product_prop';

        // Disable timestamps if not present in the view
        public $timestamps = false;
}
