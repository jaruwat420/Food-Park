<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket_history extends Model
{
    use HasFactory;

    protected $fillable = ['ticket_id', 'user_id', 'changed_field', 'old_value', 'new_value'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
