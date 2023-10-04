<x-backend-layout>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Agent</li>
                </li>
            </ol>
            <a href="{{ route('admin.agents') }}" class="btn btn-inverse-info">All Agent</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Agent</h6>
                        {!! Form::open([
                            'method' => 'put',
                            'route' => ['admin.agent_update'],
                            'files' => true,
                            'class' => 'forms-sample',
                        ]) !!}
                        <div class="mb-3">
                            <img class="wd-70 rounded-circle" id="showImage"
                                src="{{ !empty($agent->photo) ? asset($agent->photo) : url('upload/no_image.jpg') }}"
                                alt="profile">
                        </div>
                        <div class="mb-3">
                            <x-input-label for="photo" :value="__('Photo')" />
                            <x-text-input id="photo" class="form-control" type="file" name="photo"
                                id="image" />
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">



                                    {!! Form::label('username', 'Agent Username', ['class' => 'form-label']) !!}

                                    {!! Form::text('username', $value = $agent->username, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Agent Username',
                                    ]) !!}
                                    @error('username')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::hidden('agent_id', $value = $agent->id) !!}


                                    {!! Form::label('name', 'Agent Name', ['class' => 'form-label']) !!}

                                    {!! Form::text('name', $value = $agent->name, ['class' => 'form-control', 'placeholder' => 'Agent Name']) !!}
                                    @error('name')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">

                                    {!! Form::label('email', 'Agent Email', ['class' => 'form-label']) !!}

                                    {!! Form::email('email', $value = $agent->email, ['class' => 'form-control', 'placeholder' => 'Agent Email']) !!}
                                    @error('email')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">

                                    {!! Form::label('phone', 'Agent Phone', ['class' => 'form-label']) !!}

                                    {!! Form::text('phone', $value = $agent->phone, ['class' => 'form-control', 'placeholder' => 'Agent Phone']) !!}
                                    @error('phone')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">

                                    {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Agent Password']) !!}
                                    @error('password')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">

                                    {!! Form::label('address', 'Agent Address', ['class' => 'form-label']) !!}

                                    {!! Form::textarea('address', $value = $agent->address, [
                                        'class' => 'form-control',
                                        'rows' => 3,
                                        'placeholder' => 'Agent Address',
                                    ]) !!}
                                    @error('address')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <div class="mb-3">
                            <?php
                            $status = [
                                '0' => 'Active',
                                '1' => 'Inactive',
                            ];
                            ?>
                            {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}

                            {!! Form::Select('status', $status, $agent->status, [
                                'class' => 'form-control',
                                'placeholder' => 'Select Status',
                            ]) !!}
                            @error('status')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        {!! Form::submit('Update', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Agent</h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
										<th>Upload By</th>                                      
                                        <th>Info</th>                                      
                                        <th>Status</th>
                                        <th>Change</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agent->property as $property)
                                        <?php
                                        $img = explode('.', $property->property_thumbnail);
                                        $table_img = $img[0] . '_small.' . $img[1]; ?>
                                        <tr>
                                            <td>{{ $property->id }}</td>
                                            
                                            <td><img src="{{ asset($table_img) }}"></td>
                                            <td><a href="{{ ($property->agent?->name) ? route("agent.details",$property->agent->id) : '#' }} "  target="_blank" class="btn btn-sm btn-{{ ($property->agent?->name) ? 'inverse-primary' : 'inverse-warning' }} "> {{ ($property->agent?->name) ? $property->agent->name : "Admin" }}</a></td>
                                            
                                            <td><strong class="text-primary">Name:</strong>{{ ucfirst($property->property_name) }}<br><strong class="text-info">Code:</strong>{{  $property->property_code }}<br><strong class="text-warning">Type:</strong>:{{ $property->type->type_name }}<br><strong class="text-danger">Status Type:</strong>{{ ucfirst($property->property_status) }}<br><strong class="text-primary">City:</strong>{{  $property->city?->name  }}<br><strong class="text-secondary">Created:</strong>{{ $property->created_at->format('d-m-Y g:i A ') }}<br><strong class="text-secondary">Updated:</strong>{{ $property->updated_at->format('d-m-Y g:i A ') }}</td>
                                            
                                            <td> <a href="#" id="currentStatus{{ $property->id }}"><span
                                                        class="badge rounded-pill bg-{{ $property->status == 0 ? 'danger' : 'success' }}">{{ $property->status == 0 ? 'Deactive' : 'Active' }}</span></a>
                                            </td>
                                            <td>
                                                <input data-id="{{ $property->id }}" class="toggle-class" type="checkbox"
                                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                    data-on="Active" data-off="Deactive"
                                                    {{ $property->status == 1 ? 'checked' : '' }}>

                                            </td>
                                            <td>
                                                <form action="{{ route('properties.destroy', $property->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ url('property/details/' . $property->id . '/' . $property->property_slug) }}"
                                                        class="btn btn-inverse-info" title="Public View"  target="_blank"> <i
                                                            data-feather="eye"></i> </a>
                                                    <a href="{{ route('properties.show', $property->id) }}"
                                                        class="btn btn-inverse-info" title="List View"> <i
                                                            data-feather="monitor"></i> </a>
                                                    <a href="{{ route('properties.edit', $property->id) }}"
                                                        class="btn btn-inverse-warning"><i data-feather="edit"></i> </a>

                                                    <button type="submit" class="btn btn-inverse-danger btn-submit"><i
                                                            data-feather="trash-2"></i> </button>
                                                </form>
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
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Package Plan </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Pay by</th>
                                        <th>Plan Name</th>
                                        <th>Validity</th>
                                        <th>Properties</th>
                                        <th>Amount</th>
                                        <th>Discount</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>                                  
                                    @foreach ($agent->packagehistory as $packplan)   
                                    @php
                                        $validity= $packplan->plan->plan_validity >  30 ? 'danger' : 'primary';
                                        $validity= $packplan->plan->plan_validity==0 ? 'success' : $validity;
                                    @endphp                                 
                                        <tr>
                                            <td>{{ $packplan->id }} </td>
                                             <td><span class="badge rounded-pill border border-{{ ($packplan->order_by=='admin')?'danger':'warning' }} text-{{ ($packplan->order_by=='admin')?'danger':'warning' }}">{{ ucfirst($packplan->order_by) }}</span></td>
                                            <td><span
                                                    class="badge bg-{{ PACK[$packplan->plan?->id? $packplan->plan?->id : 0] }}">{{ ucfirst($packplan->package_name) }}</span>
                                            </td>
                                            <td><span
                                                    class="badge rounded-pill bg-{{ $validity }}">{{ $packplan->plan->plan_validity}}</span>
                                            </td>
                                            <td>{{ ucfirst($packplan->package_credits) }}</td>
                                            <td>{{ EXSSYMBOL }} {{ ucfirst($packplan->package_amount) }}</td>
                                            <td>{{ EXSSYMBOL }} {{ ucfirst($packplan->package_discount) }}</td>
                                            <td>{{ $packplan->created_at->format('l d M Y') }}</td>

                                            <td>
                                                <form action="{{ route('admin.package_history.delete', $packplan->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                     <a href="{{ route('admin.package_invoice', $packplan->id) }}"
                                                    class="btn btn-inverse-warning"><i data-feather="download"></i> </a>
                                                     
                                                    <button type="submit"
                                                        class="btn btn-inverse-danger btn-submit"><i data-feather="trash"></i></button>
                                                </form></td>

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
</x-backend-layout>
