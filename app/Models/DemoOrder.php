<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class DemoOrder extends Model
{
    protected $table = 'demo_orders';

    public $timestamps = false;

    protected $guarded = [];
}
