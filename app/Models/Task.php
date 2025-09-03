<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    public const STATUS_PENDING = 'PENDING';
    public const STATUS_RECEIVED = 'RECEIVED';
    public const STATUS_STARTED = 'STARTED';
    public const STATUS_SUCCESS = 'SUCCESS';
    public const STATUS_FAILURE = 'FAILURE';
    public const STATUS_RETRY= 'RETRY';

    protected $fillable = [
        'title', 'description', 'status',
    ];

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'status' => 'string',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function getStatuses(){
        return [
            self::STATUS_PENDING => 'В ожидании',
            self::STATUS_RECEIVED => 'Получено',
            self::STATUS_STARTED => 'В работе',
            self::STATUS_SUCCESS => 'Успех',
            self::STATUS_FAILURE => 'Ошибка',
            self::STATUS_RETRY => 'Повтор',
        ];
    }
}
