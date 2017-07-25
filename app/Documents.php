<?php
namespace App;


use Carbon\Carbon;
use Illuminate\Database\Connection;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{

    protected $db;

    protected $table = 'patient_documents';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    public $timestamps = true;

    public function visits()
    {
        return $this->hasOne('App\Visits');
    }

    public function claimbill()
    {
        return $this->hasOne('App\Claimbill');
    }

}