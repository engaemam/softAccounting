@extends('front.index_en')
@section('content')
    <!--/End Header Section -->

    <!-- start Welcome Section -->
    <section class="welcome my-md-4">
        <div class="container">
            <h2 class="mb-2"><span>WELCOME </span> To  </h2>
            <h6 class="mb-3">Survey Unit Engineering in ASU</h6>
            <div class="row">
                <p class="ml-auto mt-4">
                    {{ mb_substr(strip_tags( $pages[0]->description_en),0, 450) }} ...
                </p>
                <p class="w-100 text-center mt-md-5"><a href="{{route('front.site_en.about.index')}}" class="btn btn-link border-0">More</a></p>
            </div>
        </div>
    </section>

    <!-- /End Welcome Section -->


    <!-- start target section -->
    <section class="target mt-md-5">
        <div class="container">
            <h2 class="mb-2"><span>OUR </span> TARGET  </h2>
            <h6 class="mb-3">Survey Unit looking to reach to target</h6>
            <div class="row mt-md-5">
                <div class="col-md">
                    <p>The survey works for large establishments.</p>
                    <p>Monitoring the movements of installations and bridges.</p>
                    <p>Different spatial applications.</p>
                    <p>Road, longitudinal and longitudinal road works.</p>
                    <p>Using remote sensing methods.</p>
                    <p>Production of GIS databases.</p>
                    <p>Training courses in the fields of surveying.</p>
                </div>
                <div class="col-6 col-md">
                    <img src="{{url('/')}}/assets/images/num-of-projects.png" alt="our target" class="img-fluid">
                </div>

            </div>
        </div>
    </section>

    <!-- /End target section -->

    <!-- start members section -->
    <section class="members text-center">
        <div class="container">
            <h2 class="mb-2"><span>UNIT</span> MEMBERS </h2>
            <h6 class="mb-5">Survey Unit have best specialist members</h6>
            <!-- Set up your HTML -->

            <div class="owl-carousel owl-theme wow flipInY">
                @foreach($members as $member)
                <div>
                    <div class="ih-item circle effect1 colored"><a href="#">
                            <div class="spinner"></div>
                            <div class="img"><img src="{{$member->image}}" alt="إسم الدكتور / الوظيفه"></div>
                            <div class="info">
                                <div class="info-back">
                                    <h3>{{$member->name_en}}</h3>
                                    <p>{{$member->description_en}}</p>
                                </div>
                            </div></a>
                    </div>
                    <h6 class="member-title">{{$member->name_en}}</h6>
                    <h6 class="member-position">{{$member->description_en}}</h6>
                </div>
                @endforeach
            </div>

        </div>

    </section>


    <!-- /End members section -->

    <!-- Start projects Section -->
    <section class="projects">
        <div class="container">
            <h2 class="mb-2"><span>UNIT</span> PROJECTS  </h2>
            <h6 class="mb-5">Survey Unit do several projects in standard quality</h6>
            <div class="row">
                @foreach($projects as $project)
                <div class="col">
                    <div class="card mb-4">
                        <div class="img-contain">
                            <img class="card-img-top" src="{{$project->image}}" alt="{{$project->title_en}}" data-wow-delay=".3s">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title wow bounceInLeft my-3" data-wow-delay=".3s"><a href="{{url('/en/projects', ['id' => $project->id,'meta_title_en' => str_slug($project->mate_title_en)])}}">{{$project->title_en}}</a></h5>
                            <p class="card-text my-4">
                                {{$project->description_en}}
                            </p>
                            <a href="{{url('/en/projects', ['id' => $project->id,'meta_title_en' => str_slug($project->mate_title_en)])}}" class="btn btn-link border-0">More </a>
                        </div>
                    </div>
                </div>
                @endforeach
                    <p class="text-center w-100 mt-4 mb-5"><a href="{{route('front.site_en.projects.index')}}" class="btn btn-link border-0">VIEW ALL PROJECTS</a></p>

            </div>
        </div>

    </section>
    <!-- /End projects Section -->




@endsection
