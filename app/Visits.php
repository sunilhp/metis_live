<?php
namespace App;


use Carbon\Carbon;
use Illuminate\Database\Connection;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{

    protected $db;

    protected $table = 'patient_visit_history';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    public $timestamps = true;

    public function provider()
    {
        return $this->hasOne('App\Providers','id','provider_id');
    }

    public function documents_vs()
    {
        return $this->hasMany('App\Documents','visit_id','id');
    }

    public function documents() {
        return $this->documents_vs()->where('module','=', 'visits');
    }

}