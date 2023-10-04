<x-backend-agent-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">


        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pricing</li>
                </li>
            </ol>

        </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mb-3 mt-4">Choose a plan</h3>
                        <div class="row ">
                            <div class="mb-3">
                                <div class="form-check form-switch mb-2 justify-content-center d-flex">
                                    <label class="form-check-label me-5" for="formSwitch1">Monthly</label>
                                    <input type="checkbox" class="form-check-input" id="formSwitch1" value="1">
                                    <label class="form-check-label ms-2" for="formSwitch1">Annualy</label>
                                </div>

                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                @foreach ($plans as $plan)
                                    @if ($plan->plan_type == 1)
                                        <div class="col-md-4 stretch-card grid-margin grid-margin-md-0 py-3 planbox"
                                            data-id={{ $plan->id }}>

                                            <div class="card">
                                                {{ Form::open(['route' => 'agent.buy.plan', 'class' => 'forms-sample', 'method' => 'post']) }}

                                                 <div class="card-body border border-2 border-{{ PACK[$plan->id] }}">
                                                    <h4 class="text-center mt-3 mb-4">{{ ucfirst($plan->plan_name) }}
                                                    </h4>
                                                    <div class="text-center">
                                                        <p
                                                            class="badge rounded-pill border border-warning text-warning">
                                                            - Save {{ $plan->plan_discount }}% </p>
                                                    </div>
                                                    <i data-feather="{{ $plan->plan_icon }}"
                                                        class="text-{{ $plan->plan_color }} icon-xxl d-block mx-auto my-3"></i>
                                                    <h1 class="text-center">{{ MONEY }} <span
                                                            class="amount">{{ $plan->plan_amount }}</span>
                                                    </h1>
                                                    <input type="hidden" name="plan_type" id="plan_type"
                                                        value="0">
                                                    <input type="hidden" name="id" id="amount"
                                                        value="{{ $plan->id }}">
                                                    <h4 class="text-muted text-center mb-4 fw-light">
                                                        <span class="plan">{{ 'Monthly' }}</span>
                                                    </h4>
                                                    <h5 class="text-{{ $plan->plan_color }} text-center mb-4">
                                                        {{ ucfirst($plan->plan_heading) }}
                                                    </h5>
                                                    <table class="mx-auto">
                                                        {{-- <tr>
                                                            <td><i data-feather="check"
                                                                    class="icon-md text-success me-2"></i>
                                                            </td>
                                                            <td>
                                                                <p>Up to {{ $plan->plan_credit }} Property</p>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        //  $fe = $plan->fe_In($plan->plan_pack_id);
                                                        ?>
                                                        @foreach ($fe as $feature)
                                                            <tr>
                                                                <td><i data-feather="check"
                                                                        class="icon-md text-success me-2"></i>
                                                                </td>
                                                                <td>
                                                                    <p>{{ $feature->features_name }}</p>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <?php
                                                        //  $fe = $plan->fe_Not_In($plan->plan_pack_id);
                                                        ?>
                                                        @foreach ($fe as $feature)
                                                            <tr>
                                                                <td><i data-feather="x"
                                                                        class="icon-md text-danger me-2"></i>
                                                                </td>
                                                                <td>
                                                                    <p class="text-muted">{{ $feature->features_name }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        @endforeach --}}

                                                    </table>

                                                    <div class="d-grid">

                                                        {!! Form::submit('Add To Cart', ['class' => 'btn btn-dark btn-icon-text mb-2 mb-md-0']) !!}

                                                    </div>
                                                </div>
                                                {{ Form::close() }}
                                            </div>

                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="row">
                                <h2 class="text-center my-5">Addon Plans</h2>
                               
                                @foreach ($plans as $plan)
                                    @if ($plan->plan_type == 0)
                                        <div class="col-md-4 stretch-card grid-margin grid-margin-md-0 py-3">

                                            <div class="card">
                                                {{ Form::open(['route' => 'agent.buy.plan', 'class' => 'forms-sample', 'method' => 'post']) }}

                                                <div class="card-body border border-2 border-{{ PACK[$plan->id] }}">
                                                    <h4 class="text-center mt-3 mb-4">{{ ucfirst($plan->plan_name) }}
                                                    </h4>

                                                    <i data-feather="{{ $plan->plan_icon }}"
                                                        class="text-{{ $plan->plan_color }} icon-xxl d-block mx-auto my-3"></i>
                                                    <h1 class="text-center">{{ MONEY }} <span
                                                            class="amount">{{ $plan->plan_amount }}</span>
                                                    </h1>
                                                    <input type="hidden" name="plan_type" id="plan_type"
                                                        value="0">
                                                    <input type="hidden" name="id" id="amount"
                                                        value="{{ $plan->id }}">
                                                    <h4 class="text-muted text-center mb-4 fw-light">
                                                        <span class="plan">{{ 'Monthly' }}</span>
                                                    </h4>
                                                    <h5 class="text-{{ $plan->plan_color }} text-center mb-4">
                                                        {{ ucfirst($plan->plan_heading) }}
                                                    </h5>
                                                    <table class="mx-auto">
                                                        {{-- <tr>
                                                            <td><i data-feather="check"
                                                                    class="icon-md text-success me-2"></i>
                                                            </td>
                                                            <td>
                                                                <p>Up to {{ $plan->plan_credit }} Property</p>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        //  $fe = $plan->fe_In($plan->plan_pack_id);
                                                        ?>
                                                        @foreach ($fe as $feature)
                                                            <tr>
                                                                <td><i data-feather="check"
                                                                        class="icon-md text-success me-2"></i>
                                                                </td>
                                                                <td>
                                                                    <p>{{ $feature->features_name }}</p>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <?php
                                                        //  $fe = $plan->fe_Not_In($plan->plan_pack_id);
                                                        ?>
                                                        @foreach ($fe as $feature)
                                                            <tr>
                                                                <td><i data-feather="x"
                                                                        class="icon-md text-danger me-2"></i>
                                                                </td>
                                                                <td>
                                                                    <p class="text-muted">{{ $feature->features_name }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        @endforeach --}}

                                                    </table>

                                                    <div class="d-grid">

                                                        {!! Form::submit('Add To Cart', ['class' => 'btn btn-dark  btn-icon-text mb-2 mb-md-0']) !!}

                                                    </div>
                                                </div>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#formSwitch1').on('change', function() {
                var value = this.value;
                if (this.checked) {
                    var value = this.value;
                    // $('.plan').text('Annualy');
                    $(".planbox").each(function(index, element) {
                        var id = $(element).data("id");
                        var plan_type = 1;
                       $(element).find("#plan_type").val(plan_type);
                        var crf = '{{ csrf_token() }}';
                        $.ajax({
                            url: "plantype",
                            type: "POST",
                            data: {
                                _token: crf,
                                id: id,
                                plan_type: plan_type
                            },
                            cache: false,
                            success: function(result) {
                                var amount = result[0].plan_amount;
                                var discount = result[0].plan_discount;
                                var yearly = parseInt(parseInt(amount * 12));
                                var discounted = parseInt(yearly - parseInt(amount *
                                    12) / 100 * parseInt(discount));

                                $(element).find('.amount').text(discounted / 12);

                            }
                        });
                    });
                } else {
                    var value = 0;
                    $('.plan').text('Monthly');
                    $(".planbox").each(function(index, element) {
                        var id = $(element).data("id");
                        var plan_type = 0;
                        $(element).find("#plan_type").val(plan_type);
                        var crf = '{{ csrf_token() }}';
                        $.ajax({
                            url: "plantype",
                            type: "POST",
                            data: {
                                _token: crf,
                                id: id,
                                plan_type: plan_type
                            },
                            cache: false,
                            success: function(result) {
                                var amount = result[0].plan_amount;
                                $(element).find('.amount').text(amount);

                            }
                        });
                    });
                }

            });


        });
    </script>
</x-backend-agent-layout>
