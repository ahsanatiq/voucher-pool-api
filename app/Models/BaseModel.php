<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public static $instance;
    public function __construct() {
        if(!self::$instance) {
            self::$instance = container()->get('eloquent');
        }
    }
}
