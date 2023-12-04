<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Support\Str;
use App\Models\IdentitasWeb;
use Illuminate\Http\Request;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class IdentitasWebController extends Controller
{
    protected $title = 'Web Identity';
    protected $menu = 'identitas-web';
    protected $sub_menu = '';
    protected $direktori = 'admin.page.identitas-web';
    public function create(Request $request)
    {
        $data = array();
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['identitas_web'] = IdentitasWeb::query()->first();
        $data['edit'] = true;
        $data['id_identitas_web'] = $data['identitas_web']->id_identitas_web;
        $data['data'] = $data['identitas_web'];
        $data['show'] = (!empty($request->show)) ? true : false;
        return view($this->direktori . '.add', $data);
    }

    public function store(Request $request)
    {
        $id = $request->id_identitas_web;
        if (empty($request->name_company)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Nama Company Field Must Be Filled', null);
        }
        if (empty($request->no_wa_company)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'No. WA Company Must Be Filled', null);
        }
        if (empty($request->email_company)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Email Company Must Be Filled', null);
        }
        if (empty($request->video_company)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Link YT Video Must Be Filled', null);
        }
        if (empty($request->address_company)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Address Company Must Be Filled', null);
        }
        if (empty($request->facebook_company)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Facebook Company Must Be Filled', null);
        }
        if (empty($request->twitter_company)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Twitter Company Must Be Filled', null);
        }
        if (empty($request->instagram_company)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Instagram Company Must Be Filled', null);
        }
        if (empty($request->title_banner_company)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Title Banner Company Must Be Filled', null);
        }
        if (empty($request->payment_class_1)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Payment Class 1 Must Be Filled', null);
        }
        if (empty($request->payment_class_2)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Payment Class 2 Must Be Filled', null);
        }
        if (empty($request->payment_class_3)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Payment Class 3 Must Be Filled', null);
        }
        $identitas_web = IdentitasWeb::find($id);
        $identitas_web->name_company = $request->name_company;
        $identitas_web->no_wa_company = $request->no_wa_company;
        $identitas_web->address_company = $request->address_company;
        $identitas_web->email_company = $request->email_company;
        $identitas_web->twitter_company = $request->twitter_company;
        $identitas_web->facebook_company = $request->facebook_company;
        $identitas_web->instagram_company = $request->instagram_company;
        $identitas_web->title_banner_company = $request->title_banner_company;
        $video_company = $request->video_company;
        if (!empty($request->video_company)) {
            if (str_contains($request->video_company, 'watch?v=')) {
                $video_company = str_replace('watch?v=', 'embed/', $request->video_company);
            } elseif (str_contains($request->video_company, 'youtu.be/')) {
                $video_company = str_replace('youtu.be/', 'youtube.com/embed/', $request->video_company);
            }
        }
        $identitas_web->video_company = $video_company;
        $identitas_web->payment_class_1 = $request->payment_class_1;
        $identitas_web->payment_class_2 = $request->payment_class_2;
        $identitas_web->payment_class_3 = $request->payment_class_3;
        if ($request->has('logo_company')) {
            if ($request->old_logo_company) {
                if (file_exists($request->old_logo_company)) {
                    unlink($request->old_logo_company);
                }
            }
            $image = $request->file('logo_company');
            $thumb_image = Image::make($image->getRealPath())->resize(250, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_path = 'image-upload/identitas-web/' . Str::random(4) . hash('sha256', $image->getContent()) . '.' . $image->getClientOriginalExtension();
            $thumb_path = public_path() . '/' . $image_path;
            $thumb_image = Image::make($thumb_image)->save($thumb_path);
            $identitas_web->logo_company = $image_path;
        }
        if ($request->has('banner_company')) {
            if ($request->old_banner_company) {
                if (file_exists($request->old_banner_company)) {
                    unlink($request->old_banner_company);
                }
            }
            $image = $request->file('banner_company');
            $thumb_image = Image::make($image->getRealPath())->resize(250, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_path = 'image-upload/identitas-web/' . Str::random(4) . hash('sha256', $image->getContent()) . '.' . $image->getClientOriginalExtension();
            $thumb_path = public_path() . '/' . $image_path;
            $thumb_image = Image::make($thumb_image)->save($thumb_path);
            $identitas_web->banner_company = $image_path;
        }
        $identitas_web->save();

        if ($identitas_web) {
            if (empty($id)) {
                return ResponseJsonTrait::responseJson(200, 'success', 'Successfully Save Data', null);
            } else {
                return ResponseJsonTrait::responseJson(200, 'success', 'Successfully Update Data', null);
            }
        } else {
            if (empty($id)) {
                return ResponseJsonTrait::responseJson(500, 'error', 'Failed Save Data', null);
            } else {
                return ResponseJsonTrait::responseJson(500, 'error', 'Failed Update Data', null);
            }
        }
    }
}
