<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Model\Contact;
use Illuminate\Support\Facades\Auth;
use Storage;

class ContactController extends Controller {
    public function contact() {
        return view('admin.settings.contact', ['title' => trans('contact.contact')]);
    }

    public function contact_save() {
        $date=$this->validate(request(), [
            'address_ar'=>'required',
        ],[],
            [
                'address_ar' => trans('contact.address_ar'),
            ]);
        $data = request()->except(['_token', '_method']);
        $data['Seller_id'] = Auth::guard('admin')->user()->Seller_id;
        $contact=Contact::orderBy('id', 'desc')->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('settings/contact'));
    }
}