<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\Request;

class ContactsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */protected $contactsRules=[];
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setLangNamespace('contacts');

        if($this->route()->getName()=='front.site_ar.contacts.store')
        {
            $this->contactsRules['name'] = 'required';

        }

        return $this->contactsRules;
    }
}
