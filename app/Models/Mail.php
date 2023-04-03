<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id', 'mail_code', 'title', 'out_date', 'file', 'users_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
}
