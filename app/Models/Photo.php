<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'is_private',
        'photo_img',
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
    public static function getList($album_id)
    {
        $photos = Photo::where('album_id', $album_id)->get();
        return $photos;
    }

    /**
     * 登録・更新
     */
    public static function upsert($request, $album_id, $id = null)
    {
        // DB::transaction();
        if ($id) {
            // 更新

        } else {
            // 登録
            $instance = new Photo();
            $instance->name = $request->name;
            $instance->description = $request->description;
            $instance->album_id = $album_id;
            $instance->is_private = $request->is_private;
            $instance->user_id = Auth::id();
            $instance->save();
            if (isset($request->photo_img)) {
                // 画像ファイル情報取得
                $extension = pathinfo($_FILES['photo_img']['name'], PATHINFO_EXTENSION);
                $instance->extension = $extension;

                // 画像S3保存
                $file = $request->file('photo_img');
                $image_path = '/albums' . '/' . $album_id . '/photos' . '/' . $instance['id'];
                $image_name = 'photo_img' . '.' . $extension;
                $photo_img_info = Storage::putFileAs(
                    $image_path,
                    $file,
                    $image_name
                );
                $instance->photo_img = Storage::url($photo_img_info);
            }
            $instance->update();
            // 二重送信防止
            $request->session()->regenerateToken();
        }
    }

    /**
     * 一件取得
     */
    public static function getOne($id)
    {
        $photo = Photo::find($id);
        return $photo;
    }
}
