<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 */
class Companies extends Model
{
    protected $table = 'companies';

    protected $primaryKey = 'company_id';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'company_type_id',
        'latitude',
        'longitude',
        'city_id',
        'state_id',
        'country_id',
        'zip_code',
        'phone_num',
        'address',
        'rating',
        'email',
        'deals',
        'details',
        'logo',
        'monday_open',
        'monday_close',
        'tuesday_open',
        'tuesday_close',
        'wednesday_open',
        'wednesday_close',
        'thursday_open',
        'thursday_close',
        'friday_open',
        'friday_close',
        'saturday_open',
        'saturday_close',
        'sunday_open',
        'sunday_close',
        'site',
        'site_id',
        'map_address',
        'user_id'
    ];

    protected $fieldSearchable = [
        'latitude' => '=',
        'longitude' => '=',
        'name' => '='
    ];

    protected $guarded = [];

    public function company_type()
    {
        return $this->belongsTo('App\Models\CompanyTypes', 'company_type_id', 'company_type_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Countries', 'country_id', 'country_id');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\States', 'state_id', 'state_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\Cities', 'city_id', 'city_id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Images', 'company_id', 'company_id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Products', 'company_id', 'company_id');
    }

    public function tags()
    {
        return $this->hasMany('App\Models\CompanyTags', 'company_id');
    }

}