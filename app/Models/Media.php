<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'original_name',
        'media_type',
        'file_path',
        'alternative_name',
        'caption',
        'description'
    ];

    public function getFileAttribute()
    {
        if($this->media_type == 'image/png'){
            return "/storage" . $this->file_path . $this->title;    
        } else if ($this->media_type == 'application/zip'){
            return "/assets/admin-assets/img/zip_logo.png";
        }
        return "/storage" . $this->file_path . $this->title;
    }
}
