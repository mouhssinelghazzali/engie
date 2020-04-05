<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    protected $guarded = [];
    protected $fillable = ['id','contactId','lastName','email','check_contact_id','firstName','lastName','phone__c','response_id','stats','sendDate'];
}
