<?php

namespace Modules\Architect\Services\EncoderFileLibrary\Entities;

use Illuminate\Database\Eloquent\Model;

class EncoderFile extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'encoder_files';

    const STATUS_PENDING = 'PENDING';
    const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    const STATUS_DONE = 'DONE';
    const STATUS_ERROR = 'ERROR';

    const TYPE_AUDIO = 'AUDIO';
    const TYPE_VIDEO = 'VIDEO';
    const TYPE_PICTURE = 'PICTURE';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'file',
        'type',
        'status',
        'error',
    ];
}
