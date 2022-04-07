<?php
if (!function_exists('setting')) {
    function setting() {
        return \App\Model\Setting::orderBy('id', 'desc')->first();
    }
}
if (!function_exists('projects')) {
    function projects() {
        return \App\Model\Project::orderBy('id', 'desc')->first();
    }
}
if (!function_exists('contact')) {
    function contact() {
        return \App\Model\Contact::orderBy('id', 'desc')->first();
    }
}
if (!function_exists('footer')) {
    function footer() {
        return \App\Model\footer::orderBy('id', 'desc')->first();
    }
}
if (!function_exists('target')) {
    function target() {
        return \App\Model\Target::orderBy('id', 'desc')->first();
    }
}
if (!function_exists('aurl')) {
    function aurl($url = null) {
        return url('admin/'.$url);
    }
}
if (!function_exists('admin')) {
    function admin() {
        return auth()->guard('admin');
    }
}
if (!function_exists('active_menu')) {
    function active_menu($link) {
        if (preg_match('/'.$link.'/i', Request::segment(2))) {
            return ['menu-open', 'display:block'];
        } else {
            return ['', ''];
        }
    }
}
if (!function_exists('lang')) {
    function lang() {
        if (session()->has('lang')) {
            return session('lang');
        } else {
            return setting()->main_lang;
        }
    }
}
if (!function_exists('direction')) {
    function direction() {
        if (session()->has('lang')) {
            if (session('lang') == 'ar') {
                return 'rtl';
            } else {
                return 'ltr';
            }
        } else {
            return 'rtl';
        }
    }
}
if (!function_exists('datatable_lang')) {
    function datatable_lang() {
        return ['sProcessing' => trans('admin.sProcessing'),
            'sLengthMenu'        => trans('admin.sLengthMenu'),
            'sZeroRecords'       => trans('admin.sZeroRecords'),
            'sEmptyTable'        => trans('admin.sEmptyTable'),
            'sInfo'              => trans('admin.sInfo'),
            'sInfoEmpty'         => trans('admin.sInfoEmpty'),
            'sInfoFiltered'      => trans('admin.sInfoFiltered'),
            'sInfoPostFix'       => trans('admin.sInfoPostFix'),
            'sSearch'            => trans('admin.sSearch'),
            'sUrl'               => trans('admin.sUrl'),
            'sInfoThousands'     => trans('admin.sInfoThousands'),
            'sLoadingRecords'    => trans('admin.sLoadingRecords'),
            'oPaginate'          => [
                'sFirst'            => trans('admin.sFirst'),
                'sLast'             => trans('admin.sLast'),
                'sNext'             => trans('admin.sNext'),
                'sPrevious'         => trans('admin.sPrevious'),
            ],
            'oAria'            => [
                'sSortAscending'  => trans('admin.sSortAscending'),
                'sSortDescending' => trans('admin.sSortDescending'),
            ],
        ];
    }
}
//validate Helper Function
if (!function_exists('v_image')) {
  function v_image($ext=null){
      if($ext ==null){
          return 'image|mimes:jpg,jpeg,png,gif,bmp';
      }else{
          return 'image|mimes:'.$ext;
      }

  }
}