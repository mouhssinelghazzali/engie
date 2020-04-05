<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $guarded = [];
    protected $fillable = ['id','contactId','lastName','email','check_contact_id','firstName','lastName','phone__c'];
}
