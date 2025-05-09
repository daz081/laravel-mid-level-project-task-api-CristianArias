<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasUuids;
    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    public function tasks(){
        return $this->hasMany(Task::class,'project_id','id');
    }
}
