<body>

<!--start Header Section -->

<section class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <a href="{{route('front.index_en')}}" class="d-none d-lg-inline-block">
                    <img src="{{setting()->logo}}" alt="كلية الهندسة | جامعة عين شمس " class="logo-img wow zoomIn"
                         data-wow-delay=".3s">
                </a>
                <a href="{{url('/')}}" class="lang-icon">ع</a>
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand wow zoomIn d-lg-none" href="{{route('front.index_en')}}"><img src="{{setting()->logo}}"></a>

                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav p-0 mx-auto">
                            <li class="nav-item @if(app('request')->route()->getName()=='front.index_en') active @endif">
                                <a class="nav-link" href="{{route('front.index_en')}}"> Home </a>
                            </li>
                            <li class="nav-item @if(app('request')->route()->getName()=='front.site_en.about.index') active @endif">
                                <a class="nav-link" href="{{route('front.site_en.about.index')}}">About Us  </a>
                            </li>
                            <li class="nav-item @if(app('request')->route()->getName()=='front.site_en.members.index') active @endif ">
                                <a class="nav-link" href="{{route('front.site_en.members.index')}}"> Members </a>
                            </li>
                            <li class="nav-item @if(app('request')->route()->getName()=='front.site_en.projects.index') active @endif">
                                <a class="nav-link" href="{{route('front.site_en.projects.index')}}">Projects </a>
                            </li>
                            <li class="nav-item @if(app('request')->route()->getName()=='front.site_en.contacts.index') active @endif">
                                <a class="nav-link" href="{{route('front.site_en.contacts.index')}}"> Contact Us </a>
                            </li>

                        </ul>

                    </div>

                </nav>
            </div>
            <div class="col-md-12 col-lg-6">
                <div id="banner-slider" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#banner-slider" data-slide-to="0" class="active"></li>
                        <li data-target="#banner-slider" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{setting()->slider1}}" alt="كلية الهندسة | جامعة عين شمس ">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{setting()->slider1}}" alt="كلية الهندسة | جامعة عين شمس ">
                        </div>

                    </div>
                    <a class="carousel-control-prev" href="#banner-slider" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#banner-slider" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>
            </div>


        </div>

    </div>
</section>
<!--/End Header Section -->