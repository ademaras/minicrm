<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'title', 'status'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
