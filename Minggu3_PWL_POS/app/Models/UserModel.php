<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
    public $incrementing = true;  // Pastikan auto-increment berjalan
    protected $fillable = ['username', 'nama', 'password', 'level_id'];
}
