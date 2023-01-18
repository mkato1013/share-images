<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Album extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'is_private',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //
    ];

    /**
     * 一件取得
     */
    public static function getList()
    {
        $albums = Album::all();
        return $albums;
    }

    /**
     * 一覧取得
     */
    public static function getOne($id)
    {
        $album = Album::find($id);
        return $album;
    }

    /**
     * 登録・更新
     */
    public static function upsert($request, $id = null)
    {
        if ($id) {
            // 更新

        } else {
            // 登録
            $instance = new Album();
            $instance->name = $request->name;
            $instance->is_private = $request->is_private;
            $instance->user_id = Auth::id();
            $instance->save();
        }
    }
}
