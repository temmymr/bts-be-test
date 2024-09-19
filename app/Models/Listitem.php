<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listitem extends Model
{
    use HasFactory;
    protected $table = 'listitem';

    protected $fillable = [
        'item_name',
        'checklist_id'
    ];
}
