<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Companies extends Model
{
    use HasFactory;

    public static function getSub() {
        return [            
            'sub_id_1' => 'sub1',
            'sub_id_2' => 'sub2',
            'sub_id_3' => 'sub3',
            'sub_id_4' => 'sub4',
            'sub_id_5' => 'sub5',           
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_kt',
        'user_id',
        'geo',
        'options',
        'short_script',
        'short_url',
        'short_script_2',
        'short_url_2',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
       
    ];
   

}
