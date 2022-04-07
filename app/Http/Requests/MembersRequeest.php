<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MembersRequeest extends Request
{
    protected $memberRules=[];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setLangNamespace('members');

        if($this->route()->getName()=='admin.members.store')
        {
            $this->membersRules['name_ar'] = 'required';

        }
        elseif($this->route()->getName() == 'admin.photos.update')
        {
            $this->PhotosRules['name_ar'] = 'required';
        }
        return $this->memberRules;
    }


    public function messages(){

        return[

            'ids.required'=>trans ('app.plase_select_items')
        ];
    }


}
