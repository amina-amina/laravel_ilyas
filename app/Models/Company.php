<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','adresse','website','email','user_id'];
    public function contact(){
        return $this->hasMany(Contact::class);
    }
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
