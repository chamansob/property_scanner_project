<x-backend-layout>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Package</li>
                </li>
            </ol>
            <a href="{{ route('admin.package_history') }}" class="btn btn-inverse-info">Package History</a>

        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Properties</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>{{ $agent->id }}</td>
                                    <td><img class="wd-100 rounded-circle"
                                            src="{{ !empty($agent->photo) || file_exists(asset($agent->photo)) ? asset($agent->photo) : url('upload/no_image.jpg') }}"
                                            alt="profile"></td>
                                    <td>{{ ucfirst($agent->name) }}</td>
                                    <td>{{ $agent->email }}</td>
                                    <td>{{ $agent->phone }}</td>
                                    <td>{{ count($agent->property) . '/' . $agent->credit }}</td>
                                    <td> <a href="#" id="currentStatus{{ $agent->id }}"><span
                                                class="badge rounded-pill bg-{{ $agent->status == 1 ? 'danger' : 'success' }}">{{ $agent->status == 1 ? 'Deactive' : 'Active' }}</span></a>
                                    </td>


                                </tr>

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Package</h6>
                        {{ Form::open(['route' => ['admin.agentplan.store'], 'class' => 'forms-sample', 'method' => 'post']) }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::label('plan_id', 'Plan', ['class' => 'form-label']) !!}
                                    {!! Form::hidden('user_id', $value = $agent->id) !!}
                                    {!! Form::select('plan_id', $value = $plan, null, [
                                        'class' => 'form-control',
                                        'id' =>'on_play_id'
                                    ]) !!}
                                </div><!-- Col -->
                            </div>
                            <div class="col-lg-6">

                                <div class="mb-3">
                                    {!! Form::label('plan_type', 'Plan Type', ['class' => 'form-label']) !!}
                                    {!! Form::select('plan_type', PLANTYPE, null, [
                                        'class' => 'form-control',
                                        'id'=> 'on_play_type'
                                    ]) !!}
                                </div><!-- Col -->
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12" id="converted">
                               <strong class="text-primary">Amount:</strong> <span class="amount">{{ MONEY }}
                                    {{ $oneplan->plan_amount }}</span> |
                                <strong class="text-success">Amount in ({{ EXCHNAGE }}):</strong> <span
                                    class="exchnage_amount">{{ EXCHNAGE }} {{ $oneplan->plan_amount *currency_exchange(EXCHNAGE) }}</span> |
                                <strong class="text-danger">Discount:</strong> <span
                                    class="discount_persantage">{{ $oneplan->plan_discount }} %</span> |
                                    <strong class="text-danger">Play Type:</strong> <span
                                    class="plan_type">{{ PLANTYPE[$oneplan->plan_type] }}</span>                                 
                            </div>
                        </div>
                        <hr>
                        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Agent Packages Plan </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Photo</th>
                                        <th>Agent Name</th>
                                        <th>Package Name</th>
                                        <th>Package Credit</th>
                                        <th>Amount</th>
                                        <th>Discount</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packagehistory as $packplan)
                                        <tr>
                                            <td>{{ $packplan->id }}</td>
                                            <td><img class="wd-100 rounded-circle"
                                                    src="{{ !empty($packplan->user->photo) || file_exists(asset($packplan->user->photo)) ? asset($packplan->user->photo) : url('upload/no_image.jpg') }}"
                                                    alt="profile"></td>
                                            <td>{{ ucfirst($packplan->user->name) }}</td>
                                            <td><span
                                                    class="badge bg-{{ PACK[$packplan->plan?->id ? $packplan->plan?->id : 0] }}">{{ ucfirst($packplan->package_name) }}</span>
                                            </td>
                                            <td>{{ ucfirst($packplan->package_credits) }}</td>
                                            <td>$ {{ ucfirst($packplan->package_amount) }}</td>
                                            <td>$ {{ ucfirst($packplan->package_discount) }}</td>
                                            <td>{{ $packplan->created_at->format('l d M Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.package_invoice', $packplan->id) }}"
                                                    class="btn btn-inverse-warning"><i data-feather="download"></i> </a>
                                            </td>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            
            
            $('#on_play_id').on('change', function() {
                var plan_id = this.value;
                var plan_type = $('#on_play_type').val();                
                var crf = '{{ csrf_token() }}';
                $("#converted").html('Loading....')
                $.ajax({
                    url: '{{ route('admin.agentplan.check_plan') }}',
                    type: "POST",
                    data: {
                        _token: crf,
                        plan_id: plan_id,
                        plan_type:plan_type                       
                    },
                    cache: false,
                    success: function(result) {
                        $("#converted").html(result);
                    }
                });
                $.ajax({
                    url: '{{ route('admin.agentplan.plantype') }}',
                    type: "POST",
                    data: {
                        _token: crf,
                        plan_id: plan_id                                     
                    },
                    cache: false,
                    success: function(result) {
                        $("#on_play_type").html(result);
                        var plan_type = $('#on_play_type').val(); 
                        if(plan_type==0)
                        {
                        $('.plan_type').text('{{ PLANTYPE[0] }}');
                        }else
                        {
                        $('.plan_type').text('{{ PLANTYPE[1] }}');
                        }
                        
                    }
                });
            });
            
            $('#on_play_type').on('change', function() {
                var plan_type = this.value;
                var plan_id = $('#on_play_id').val();
                var crf = '{{ csrf_token() }}';
                 $("#converted").html('Loading....')
                $.ajax({
                    url: '{{ route('admin.agentplan.check_plan') }}',
                    type: "POST",
                    data: {
                        _token: crf,
                        plan_id: plan_id,
                        plan_type:plan_type                       
                    },
                    cache: false,
                    success: function(result) {
                        $("#converted").html(result);
                    }
                });
            });
        });
    </script>
</x-backend-layout>
