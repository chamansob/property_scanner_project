<x-backend-agent-layout>
    @php
        $template = App\Models\SiteSetting::find(1);                                 
    @endphp
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Buy Plan</li>
                </li>
            </ol>

        </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    {{ Form::open(['route' => 'agent.make.payment', 'class' => 'forms-sample', 'method' => 'post']) }}

                    {!! Form::hidden('plan_id', $value = $_POST['id']) !!}
                    {!! Form::hidden('plan_type', $value = $_POST['plan_type']) !!}

                    @php
                       if($plan_type == 0)
                       {
                        $amount=$plan->plan_amount;
                        $discount=0;
                        $yearly=$plan->plan_amount;
                       }
                       else {
                        $yearly=round($plan->plan_amount * ($plan_type == 0 ? 1 : 12));
                        $discount=round($plan->plan_amount * ($plan_type == 0 ? 1 : 12)/100 * $plan->plan_discount);
                        $amount=round(($plan->plan_amount * ($plan_type == 0 ? 1 : 12)-$discount)/12);
                        # code...
                       } 
                    @endphp
                    <div class="card-body">
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-3 ps-0">
                                <a href="#"
                                    class="noble-ui-logo logo-light d-block mt-3">{{ $template->site_title }}</a>

                                <p>{{ $template->address }}</p>
                                <h5 class="mt-5 mb-2 text-muted">Invoice to :</h5>
                                <p>{{ $user->name }},<br> {{ $user->email }}</p>
                            </div>
                            <div class="col-lg-3 pe-0">
                                <h4 class="fw-bolder text-uppercase text-end mt-4 mb-2">invoice</h4>
                                <h6 class="text-end mb-5 pb-4"> </h6>
                                <p class="text-end mb-1">Montly Pay</p>
                                <h4 class="text-end fw-normal">{{ MONEY }} {{  $amount }}/mo</h4>
                                <h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted"> </span> </h6>

                            </div>
                        </div>
                        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                            <div class="table-responsive w-100">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Package Name </th>
                                            <th class="text-end">Property Qty</th>
                                            <th class="text-end">Plan Type</th>
                                            <th class="text-end">Unit cost</th>
                                            <th class="text-end">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-end">
                                            <td class="text-start">1</td>
                                            <td class="text-start"><span
                                                    class="badge text-dark bg-{{ PACK[$plan->id] }}">{{ ucfirst($plan->plan_name) }}</span></td>
                                            <td>{{ $plan->plan_credit }}</td>
                                            <td>{{ plantype($plan_type) }}</td>
                                            <td>{{ MONEY }}
                                                {{ $yearly }}</td>
                                            <td>{{ MONEY }}
                                                {{ $yearly }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="container-fluid mt-5 w-100">
                            <div class="row">
                                <div class="col-md-6 ms-auto">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Sub Total</td>
                                                    <td class="text-end">{{ MONEY }} {{$yearly }}</td>
                                                </tr>
                                                @if ($plan_type == 1)
                                                    <tr>
                                                        <td class="text-bold-800">Discount ({{ $plan->plan_discount }}%)</td>
                                                        <td class="text-bold-800 text-end"> {{ MONEY }}  {{ $discount }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                
                                                <tr>
                                                    <td>Total</td>
                                                    <td class="text-danger text-end">(-) {{ MONEY }} {{ $yearly-$discount }}
                                                    </td>
                                                </tr>
                                                <tr class="bg-dark">
                                                    <td class="text-bold-800">Balance Due</td>
                                                    <td class="text-bold-800 text-end">{{ MONEY }}{{ $yearly-$discount }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid w-100">

                            <button type="submit" class="btn btn-primary float-end mt-4 mb-3 ms-2"><i
                                    data-feather="send" class="me-3 icon-md"></i>Pay Now</button>

                        </div>
                    </div>
                </div>
                {{ Form::close() }}




            </div>
        </div>
    </div>
</x-backend-agent-layout>
