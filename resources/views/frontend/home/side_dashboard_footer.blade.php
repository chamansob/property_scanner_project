 @php
        $template = App\Models\SiteSetting::find(1);
       
    @endphp
    <div class="full-row pt-0 pb-5">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 text-center"><span>{{ $template->copyright }}</span></div>
                            </div>
                        </div>
 </div>