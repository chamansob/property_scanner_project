<x-frontend-layout>
@php
    $template = App\Models\SiteSetting::find(1);
    
@endphp
@section('main')
@section('title')
    {{ $template->site_title }}
@endsection
@section('meta_description')
    {{ $template->meta_description }}
@endsection
@section('meta_keywords')
    {{ $template->meta_keywords }}
@endsection
 

        <!--============== Property Search Form Start ==============-->
          @include('frontend.home.search')
        <!--============== Property Search Form End ==============-->

        <!--============== Property Location Start ==============-->
          @include('frontend.home.location')
        <!--============== Property Location End ==============-->

        <!--============== Recent Property Start ==============-->
         @include('frontend.home.property')
        <!--============== Recent Property End ==============-->

        <!--============== Pricing Plan Start ==============-->
         @include('frontend.home.pricing')
        <!--============== Pricing Plan End ==============-->

        <!--============== Testimonial Section Start ==============-->
          @include('frontend.home.testimonial')
        <!--============== Testimonial Section End ==============-->

        <!--============== Blog Section Start ==============-->
         @include('frontend.home.blog')
        <!--============== Blog Section End ==============-->

        <!--============== Client Logo Start ==============-->
         @include('frontend.home.client')
        <!--============== Client Logo End ==============-->

        <!--============== Register Section Start ==============-->
         @include('frontend.home.subscribe')
        <!--============== Register Section End ==============-->

        
</x-frontend-layout>
