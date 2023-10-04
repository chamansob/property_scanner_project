<x-backend-layout>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> All Property Size</li>
                </li>
            </ol>
            <a href="{{ route('propertysize.create') }}" class="btn btn-inverse-info">Add Property Size</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Property Size </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Size</th>
                                        <th>-</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($property_sizes as $property_size)
                                        <tr>
                                            <td>{{ $property_size->id }}</td>
                                            <td>{{ $property_size->name }}</td>
                                            <td>{{ $property_size->property_size_slug }}</td>
                                            <td>
                                                <form action="{{ route('propertysize.destroy', $property_size->id) }}" method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('propertysize.edit', $property_size->id) }}"
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
