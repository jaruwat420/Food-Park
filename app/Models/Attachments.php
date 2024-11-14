<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachments extends Model
{
    use HasFactory;

    protected $fillable = ['ticket_id', 'file_name', 'file_path', 'file_type'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
