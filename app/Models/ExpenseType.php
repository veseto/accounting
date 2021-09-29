<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    use HasFactory;

    public function debt()
    {
        return $this->hasOne(Debt::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
