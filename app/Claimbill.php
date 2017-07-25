<?php
namespace App;


use Carbon\Carbon;
use Illuminate\Database\Connection;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Claimbill extends Model
{

    protected $db;

    protected $table = 'advocacy_claim_bills';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    public $timestamps = true;


    public function documents()
    {
        return $this->hasMany('App\Documents','visit_id','id');

    }
    public function document_cb() {
        return $this->documents()->where('module','=', 'claims-bills');
    }

}