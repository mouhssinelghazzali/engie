<?php

namespace App;

use App\ContactData;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $guarded = [];
    protected $fillable = ['id','response_id','stats','sendDate'];
    protected $dates = [
        'sendDate',
    ];


    // public function setDateAttribute( $value ) {
    //     $this->attributes['sendDate'] = (new Carbon($value))->format('d/m/y');
    //   }

    public function contactData()
    {
        return $this->belongsTo(ContactData::class);
    }


}
