<?php

namespace App;

use App\Survey;
use Illuminate\Database\Eloquent\Model;

class ContactData extends Model
{
    protected $guarded = [];
    protected $fillable = ['contactLookupId','check_contact_id'];

    public function survey()
    {
        return $this->hasMany(Survey::class);
    }
}
