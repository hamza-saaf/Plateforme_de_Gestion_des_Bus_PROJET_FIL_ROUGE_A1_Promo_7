<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }

    public static function createPermission($name, $slug, $description = null)
    {
        return static::create([
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
        ]);
    }
}
