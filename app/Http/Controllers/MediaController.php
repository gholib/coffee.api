<?php


namespace App\Http\Controllers;


use App\Modules\Video\Models\Video;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function getImage($path)
    {
        return Storage::get("images/".$path);
    }

    public function getFile($path)
    {
        return Storage::get("files/".$path);
    }

    public function getBlogImage($path)
    {
        return Storage::get("images/blog/".$path);
    }

    public function getVideo($videoId)
    {
        return Storage::get("videos/".$videoId);
    }

    public function search($query)
    {
        $videos = Video::where('title', 'LIKE', '%'.$query.'%')
            ->freeVideos()
            ->published()
            ->get()
            ->toArray();

        return compact('videos');
    }

}