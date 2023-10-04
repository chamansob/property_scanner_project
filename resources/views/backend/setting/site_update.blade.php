<x-backend-layout>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Settings </li>
                </li>
            </ol>
            {{-- <a href="#" class="btn btn-inverse-info">Show All Blog </a> --}}

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Update Site Setting </h6>
                        {!! Form::open([
                            'method' => 'patch',
                            'route' => ['update.site.setting', $sitesetting->id],
                            'class' => 'forms-sample',
                            'files' => true,
                        ]) !!}

                        <div class="row">
                            <div class="col-sm-10">
                                <div class="mb-3">

                                    {!! Form::label('logo', 'Logo', ['class' => 'form-label']) !!}

                                    {!! Form::file('logo', [
                                        'class' => 'form-control',
                                        'placeholder' => 'Main Thumbnail',
                                        'onchange' => 'mainThamUrl(this)',
                                    ]) !!}
                                    @error('logo')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                    <div class="mt-3"><img src="" id="mainThmb"
                                            class="img-responsive border border-1">
                                    </div>
                                </div>
                            </div>
                            <?php
                            
                            $small_img = $sitesetting->logo;
                            ?>
                            <div class="mt-3 col-sm-2"><img src="{{ asset($small_img) }}"
                                    class="img-thumbnail img-fluid img-responsive w-10"></div>

                        </div>
                        <div class="mb-3">

                            {!! Form::label('app_name', 'App Name', ['class' => 'form-label']) !!}

                            {!! Form::text('app_name', $value = $sitesetting->app_name, [
                                'class' => 'form-control',
                                'placeholder' => 'App Name',
                            ]) !!}
                            @error('site_title')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">

                            {!! Form::label('site_title', 'Site Title', ['class' => 'form-label']) !!}

                            {!! Form::text('site_title', $value = $sitesetting->site_title, [
                                'class' => 'form-control',
                                'placeholder' => 'site_title',
                            ]) !!}
                            @error('site_title')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">

                            {!! Form::label('meta_description', 'Meta Description', ['class' => 'form-label']) !!}

                            {!! Form::textarea('meta_description', $value = $sitesetting->meta_description, [
                                'class' => 'form-control',
                                'placeholder' => 'Meta Description',
                                'rows' => 5,
                                'cols' => 30,
                            ]) !!}
                            @error('site_title')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">

                            {!! Form::label('meta_keywords', 'Meta Keywords', ['class' => 'form-label']) !!}

                            {!! Form::textarea('meta_keywords', $value = $sitesetting->meta_keywords, [
                                'class' => 'form-control',
                                'placeholder' => 'Meta Keywords',
                                'rows' => 5,
                                'cols' => 30,
                            ]) !!}
                            @error('site_title')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">

                                    {!! Form::label('company_address', 'Company Address', ['class' => 'form-label']) !!}

                                    {!! Form::text('company_address', $value = $sitesetting->company_address, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Company Address',
                                    ]) !!}
                                    @error('company_address')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">

                                    {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}

                                    {!! Form::text('email', $value = $sitesetting->email, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Email',
                                    ]) !!}
                                    @error('email')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">

                                    {!! Form::label('support_phone', 'Phone', ['class' => 'form-label']) !!}

                                    {!! Form::text('support_phone', $value = $sitesetting->support_phone, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Phone',
                                    ]) !!}
                                    @error('support_phone')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="mb-3">

                            {!! Form::label('facebook', 'Facebook', ['class' => 'form-label']) !!}

                            {!! Form::text('facebook', $value = $sitesetting->facebook, [
                                'class' => 'form-control',
                                'placeholder' => 'Facebook',
                            ]) !!}
                            @error('facebook')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('twitter', 'Twitter', ['class' => 'form-label']) !!}

                                    {!! Form::text('twitter', $value = $sitesetting->twitter, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Twitter',
                                    ]) !!}
                                    @error('twitter')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('pinterest', 'Pinterest', ['class' => 'form-label']) !!}

                                    {!! Form::text('pinterest', $value = $sitesetting->pinterest, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Pinterest',
                                    ]) !!}

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('google', 'Google Plus', ['class' => 'form-label']) !!}

                                    {!! Form::text('google', $value = $sitesetting->google, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Google Plus',
                                    ]) !!}

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('vimeo', 'Vimeo', ['class' => 'form-label']) !!}

                                    {!! Form::text('vimeo', $value = $sitesetting->vimeo, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Vimeo',
                                    ]) !!}

                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">

                                    {!! Form::label('copyright', 'Copyright', ['class' => 'form-label']) !!}

                                    {!! Form::text('copyright', $value = $sitesetting->copyright, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Copyright',
                                    ]) !!}
                                    @error('copyright')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">

                                    {!! Form::label('discount', 'Discount(%)', ['class' => 'form-label']) !!}

                                    {!! Form::number('discount', $value = $sitesetting->discount, [
                                        'class' => 'form-control',
                                        'min'=>1,
                                        'max'=>100,
                                        'placeholder' => 'Discount',
                                    ]) !!}
                                    @error('discount')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                              <div class="col-sm-4">
                                <div class="mb-3">

                                    {!! Form::label('currency', 'Other', ['class' => 'form-label']) !!}

                                    {!! Form::text('currency', $value = $sitesetting->currency, [
                                        'class' => 'form-control',
                                        'min'=>1,
                                        'max'=>100,
                                        'placeholder' => 'Currency',
                                    ]) !!}
                                    @error('currency')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-backend-layout>
