<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        'icon',
        'extension',
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
            // if (isset($request->icon)) {
            //     // 画像ファイル情報取得
            //     // $instance->icon = 'icon';
            //     $extension = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
            //     $instance->extension = $extension;
            // }
            $instance->save();
            if (isset($request->icon)) {
                // 画像ファイル情報取得
                // $instance->icon = 'icon';
                $extension = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
                $instance->extension = $extension;
                // $path = Storage::disk('s3')->put('/', $image, 'public');
                // $post->image = Storage::disk('s3')->url($path);

                // 画像S3保存
                $file = $request->file('icon');
                $image_path = '/album' . '/' . $instance['id'];
                $image_name = 'icon' . '.' . $extension;

                // Storage::putFileAs(
                //     $image_path,
                //     $file,
                //     $image_name
                // );


                $icon_path = Storage::putFileAs(
                    $image_path,
                    $file,
                    $image_name
                );

                $instance->icon = Storage::url($icon_path);

                // dd($instance);
            }
            $instance->update();
            // 二重送信防止
            $request->session()->regenerateToken();
        }
    }
}
