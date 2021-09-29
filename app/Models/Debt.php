<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;
    protected $guarded = ['id'];  

    public $timestamps = false;


    public function expenseType()
    {
        return $this->belongsTo(ExpenseType::class);
    }
    
}
