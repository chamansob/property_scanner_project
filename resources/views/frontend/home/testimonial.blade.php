@php
    $testimonils = App\Models\Testimonial::latest()->get();
@endphp
<div class="full-row overlay-secondary" style="background-image: url({{ asset('frontend/assets/images/background/bg-1.png') }}); background-position: center center; background-repeat: no-repeat">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mb-5">
                        <span class="text-primary tagline pb-2 d-table m-auto">Testimonial</span>
                        <h2 class="down-line w-50 mx-auto mb-4 text-white text-center w-sm-100">Whay Client Says About Us</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="testimonial-simple text-center px-5">
                            <div class="text-carusel owl-carousel">
                                @foreach ($testimonils as $testimonil)
                                <div class="item">
                                    <i class="flaticon-right-quote flat-large text-primary d-table mx-auto"></i>
                                    <blockquote class="text-white fs-5 fst-italic">“ {{ $testimonil->message }}”</blockquote>
                                    <h4 class="mt-4 font-400 text-white">{{ $testimonil->name }}</h4>
                                    <span class="text-primary font-fifteen">{{ $testimonil->position }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>