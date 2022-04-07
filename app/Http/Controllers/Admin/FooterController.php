<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Model\Footer;
use Storage;

class FooterController extends Controller {
    public function footer() {
        return view('admin.settings.footer', ['title' => trans('footer.footer')]);
    }

    public function footer_save() {
        $date=$this->validate(request(), [
            'footer_facebook'=>'required',
        ],[],
            [
                'footer_facebook' => trans('footer.address_ar'),
            ]);
        $data = request()->except(['_token', '_method']);

        Footer::orderBy('id', 'desc')->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('settings/footer'));
    }
}