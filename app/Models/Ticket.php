<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_name',
        'user_email',
        'user_id',
        'category_id',
        'status_id',
        'priority',
        'location_id',
        'department_id',
        'assigned_to',
        'ticket_id',
        'subject_id'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachments::class);
    }

    public function deleteAttachments()
    {
        foreach ($this->attachments as $attachment) {
            $attachment->deleteFile();
        }
        $this->attachments()->delete();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assigned()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function subject()
    {
        return $this->belongsTo(TicketSubject::class, 'subject_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(TicketStatus::class, 'status_id');
    }

    public function location()
    {
        return $this->belongsTo(Locations::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function history()
    {
        return $this->hasMany(TicketHistory::class);
    }
}
