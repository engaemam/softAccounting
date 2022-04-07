<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Setting;
use Storage;

class Settings extends Controller {
    public function setting() {
        return view('admin.settings.settings', ['title' => trans('admin.settings')]);
    }

    public function setting_save() {
        $date=$this->validate(request(), [
            'logo'=>v_image(),
            'icon'=>v_image()],[],
            [
                'logo'=>trans('admin.logo'),
                'icon'=>trans('admin.icon')
            ]);
        $data = request()->except(['_token', '_method']);

        if(request()->hasFile('logo'))
        {
            $file =     request()->file('logo');
            $name = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext =     $file->getClientOriginalExtension();
            $size =     $file->getSize();
            $mim =     $file->getMimeType();
            $realpath =     $file->getRealPath();
            $file->move(public_path('upload/settings/'),$name);
            $data['logo']= asset('upload/settings/'.$name);
        }
        if(request()->hasFile('icon'))
        {
            $file =     request()->file('icon');
            $name = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext =     $file->getClientOriginalExtension();
            $size =     $file->getSize();
            $mim =     $file->getMimeType();
            $realpath =     $file->getRealPath();
            $file->move(public_path('upload/settings/'),$name);
            $data['icon']= asset('upload/settings/'.$name);
        }
        if(request()->hasFile('slider1'))
        {
            $file =     request()->file('slider1');
            $name = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext =     $file->getClientOriginalExtension();
            $size =     $file->getSize();
            $mim =     $file->getMimeType();
            $realpath =     $file->getRealPath();
            $file->move(public_path('upload/settings/'),$name);
            $data['slider1']= asset('upload/settings/'.$name);
        }
        if(request()->hasFile('slider2'))
        {
            $file =     request()->file('slider2');
            $name = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext =     $file->getClientOriginalExtension();
            $size =     $file->getSize();
            $mim =     $file->getMimeType();
            $realpath =     $file->getRealPath();
            $file->move(public_path('upload/settings/'),$name);
            $data['slider2']= asset('upload/settings/'.$name);
        }


        Setting::orderBy('id', 'desc')->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('settings'));
    }
}