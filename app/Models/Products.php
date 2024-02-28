<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'Категория',
        'Тип',
        'Название',
        'Цена',
        'Описание',
        'Фото',
        'taskmasters_id',
    ];
    public function taskmaster()
    {
        return $this->belongsTo(Taskmasters::class);
    }
    
}
