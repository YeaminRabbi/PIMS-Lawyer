<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GalleryImages;
class Gallery extends Model
{
    public function get_imagesCount($id)
    {
        $count = GalleryImages::where('gallery_id', $id)->get()->count();
        return $count;
    }

    public function get_firstImage($id)
    {
        $image = GalleryImages::where('gallery_id', $id)->first();
        return $image->image;
    }
}
