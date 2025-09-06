<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'description', 'file_path',
        'original_name'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
