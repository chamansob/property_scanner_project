<x-backend-layout>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All  Modules</li>
                </li>
            </ol>
            <a href="{{ route('modules.create') }}" class="btn btn-inverse-info">Add Modules</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Modules </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>                                      
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modules as $module)
                                        <tr>
                                            <td>{{ $module->id }}</td>
                                            <td>@php
                                                if (!empty($module->image)) {
                                                    $img = explode('.', $module->image);
                                                    $small_img = $img[0] . '_thumb.' . $img[1];
                                                } else {
                                                    $small_img = '/upload/no_image.jpg'; # code...
                                                }
                                            @endphp
                                                <img src="{{ asset($small_img) }}"
                                                    class="img-thumbnail img-fluid img-responsive w-10">
                                            </td>
                                            <td>{{ !empty($module->name) ? $module->name : '-' }}</td>
                                           
                                            <td>
                                                @if ($module->status == 1)
                                                    {!! Form::open([
                                                        'method' => 'patch',
                                                        'route' => ['modules.status', $module->id],
                                                        'class' => 'forms-sample',
                                                    ]) !!}
                                                    <button type="submit" class="btn badge rounded-pill bg-danger">InActive
                                                    </button>

                                                    {{ Form::close() }}
                                                @else
                                                    {!! Form::open([
                                                        'method' => 'patch',
                                                        'route' => ['modules.status', $module->id],
                                                        'class' => 'forms-sample',
                                                    ]) !!}

                                                    <button type="submit" class="btn badge rounded-pill bg-success">Active
                                                    </button>

                                                    {{ Form::close() }}
                                                @endif
                                            </td>
                                            </td>
                                            <td>
                                                <form action="{{ route('modules.destroy', $module->id) }}" method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('modules.edit', $module->id) }}"
                                                        class="btn btn-inverse-warning">Edit</a>
                                                    <button type="submit"
                                                        class="btn btn-inverse-danger btn-submit">Delete</button>
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

    </div>
</x-backend-layout>
