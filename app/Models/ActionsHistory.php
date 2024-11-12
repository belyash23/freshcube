<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string action
 * @property bool success
 */
class ActionsHistory extends Model
{
    public const ACTION_LINK = 'link';
    protected $fillable = [
        'action',
        'success',
    ];

    protected function casts(): array
    {
        return [
            'success' => 'boolean',
        ];
    }
}
