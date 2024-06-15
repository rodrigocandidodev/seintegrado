<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class StudentCn.
 *
 * @package namespace App\Entities;
 */
class StudentCn extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'matricula_cn', 'date_cn', 'termo', 'livro', 'folha','student_id'
    ];

}
