<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MockTest extends Model
{
    use HasFactory;
    protected $table ='add_mock_test';
    protected $fillable = [
        'question',
        'option1',
        'option2',
        'option3',
        'option4',
        'answer',
        'subject',
        'appearExam',
    ];

}
