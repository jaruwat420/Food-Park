<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketSubject extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'order'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'subject_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
