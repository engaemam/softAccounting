@include('front.site_en.layouts.header')
@include('front.site_en.layouts.navbar')

<section class="content">
    @include('front.site_en.layouts.message')
    @yield('content')

</section>


@include('front.site_en.layouts.footer')



