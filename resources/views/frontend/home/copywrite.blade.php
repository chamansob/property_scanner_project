@php
$template = App\Models\SiteSetting::find(1);
@endphp
<div class="copyright bg-footer text-default py-4">
            <div class="container">
                <div class="row ">
                    <div class="text-center">
                        <span class="text-white">{{ $template->copyright }}</span>
                    </div>
                    {{-- <div class="col">
                        <ul class="line-menu float-end list-color-gray">
                            <li><a href="#">Privacy & Policy </a></li>
                            <li>|</li>
                            <li><a href="#">Site Map</a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>