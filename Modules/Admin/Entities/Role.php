<?php

declare(strict_types=1);

namespace  Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Role extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /**
     * The primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $guarded = ['created_at', 'updated_at', 'id'];

    protected $fillable = ['name'];
    /*--User--*/
    public function user()
    {
        return $this->belongsTo('Modules\Admin\Entities\User', 'role', 'id');
    }
    /*--Syllabus--*/
}
