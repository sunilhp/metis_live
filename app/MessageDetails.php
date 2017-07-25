<?php
namespace App;


use Carbon\Carbon;
use Illuminate\Database\Connection;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class MessageDetails extends Model
{

    protected $db;

    protected $table = 'advocacy_message_details';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    public $timestamps = true;

    public function message()
    {
        return $this->hasOne('App\Messages','id','message_id');
    }
}