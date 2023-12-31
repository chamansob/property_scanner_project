<x-backend-layout>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog Category All</li>
                </li>
            </ol>
            <a href="{{ route('blog_category.create') }}" class="btn btn-inverse-info">Add Blog Category</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All blog_category </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blog_category as $bcat)
                                        <tr>
                                            <td>{{ $bcat->id }}</td>
                                            <td>{{ $bcat->category_name }}</td>
                                            <td>{{ $bcat->category_slug }}</td>
                                            <td>
                                                <form action="{{ route('blog_category.destroy', $bcat->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('blog_category.edit', $bcat->id) }}"
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
