<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{
    use HasFactory;

     // Set the table name to the view name
    protected $table = 'Visits';
    protected $fillable = ['Ip', 'User_Agent', 'Url', 'Action'];

}
