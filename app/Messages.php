<?php
namespace App;


use Carbon\Carbon;
use Illuminate\Database\Connection;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{

    protected $db;

    protected $table = 'advocacy_message';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    public $timestamps = true;



}