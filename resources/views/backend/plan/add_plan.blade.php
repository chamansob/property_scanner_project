<x-backend-layout>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Plan</li>
                </li>
            </ol>
            <a href="{{ route('plan.index') }}" class="btn btn-inverse-info">Show All Plan</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Plan</h6>
                        {{ Form::open(['route' => 'plan.store', 'class' => 'forms-sample', 'method' => 'post']) }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">

                                    {!! Form::label('plan_name', 'Plan Name', ['class' => 'form-label']) !!}

                                    {!! Form::text('plan_name', $value = null, ['class' => 'form-control', 'placeholder' => 'Plan Name']) !!}
                                    @error('plan_name')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::label('plan_icon', 'Plan Icon', ['class' => 'form-label']) !!}
                                    {!! Form::text('plan_icon', $value = null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Plan Icon',
                                    ]) !!}
                                    @error('plan_icon')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::label('plan_heading', 'Plan Heading', ['class' => 'form-label']) !!}
                                    {!! Form::text('plan_heading', $value = null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Up to 1 Property ',
                                    ]) !!}
                                    @error('plan_heading')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::label('plan_subheading', 'Plan Sub Heading', ['class' => 'form-label']) !!}
                                    {!! Form::text('plan_subheading', $value = null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Monthly/Yearly Limit',
                                    ]) !!}
                                    @error('plan_subheading')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::label('plan_amount' , 'Plan Amount - ( '.MONEY.')' , ['class' => 'form-label']) !!}
                                    {!! Form::number('plan_amount', $value = null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Plan Amount',
                                    ]) !!}
                                    @error('plan_amount')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="mb-3">
                                    {!! Form::label('plan_pack_id', 'Plan Features', ['class' => 'form-label']) !!}
                                    {!! Form::select('plan_pack_id[]', $value = $features, null, [
                                        'class' => 'form-control js-example-basic-multiple',
                                        'multiple' => true,
                                    ]) !!}
                                </div><!-- Col -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::label('plan_credit', 'No of Properties', ['class' => 'form-label']) !!}
                                    {!! Form::number('plan_credit', 1, [
                                        'class' => 'form-control',
                                        'min'=>1,
                                        'max' =>1000,
                                        'placeholder' => 'No of Properties',
                                    ]) !!}

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <?php $color = ['success' => 'Success', 'danger' => 'Danger', 'info' => 'Info', 'primary' => 'Primary', 'warning' => 'Warning']; ?>
                                <div class="mb-3">
                                    {!! Form::label('plan_color', 'Plan Color', ['class' => 'form-label']) !!}
                                    {!! Form::select('plan_color', $value = $color, null, [
                                        'class' => 'form-control',
                                    ]) !!}
                                </div><!-- Col -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    @php
                                        $plan_discount = App\Models\SiteSetting::find(1)->discount;
                                    @endphp
                                    {!! Form::label('plan_discount', 'Plan Discount-('.$plan_discount.'%)', ['class' => 'form-label']) !!}
                                    {!! Form::number('plan_discount', $plan_discount,  [
                                        'class' => 'form-control',
                                        'min'=>0,
                                        'max'=>100,
                                        'placeholder' => 'Discount(%)',
                                    ]) !!}
                                     


                                </div>
                            </div>
                            <div class="col-lg-6">                               
                                <div class="mb-3">                                   
                                     {!! Form::label('plan_validity', 'Plan Validity in Days', ['class' => 'form-label']) !!}
                                    {!! Form::number('plan_validity', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Plan Validity in Days',
                                    ]) !!}
                                </div><!-- Col -->
                            </div>
                        </div>
                        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>
</x-backend-layout>
