@include('front.site_ar.layouts.header')
@include('front.site_ar.layouts.navbar')




    <section class="content">
        @include('front.site_ar.layouts.message')
        @yield('content')

    </section>


@include('front.site_ar.layouts.footer')



