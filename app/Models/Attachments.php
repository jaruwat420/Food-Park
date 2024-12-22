<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachments extends Model
{
    use HasFactory;

    protected $fillable = ['ticket_id', 'file_name', 'file_path', 'file_type'];


    protected $appends = ['file_url'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function getFileUrlAttribute()
    {
        return Storage::url($this->file_path);
    }

    public function deleteFile()
    {
        if (Storage::exists($this->file_path)) {
            Storage::delete($this->file_path);
        }
    }
}
