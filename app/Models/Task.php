<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

class Task extends Model
{
    use HasUuids, Auditable;
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'status',
        'priority',
        'due_date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
