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
          @include('frontend.home.banner')
        <!--============== Property Search Form End ==============-->

        

        
</x-frontend-layout>
