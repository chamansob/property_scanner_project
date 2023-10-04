<x-backend-layout>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Admin</li>

            </ol>
            <a href="{{ route('all.admin') }}" class="btn btn-inverse-info"> All Admin </a>
        </nav>


        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Add Admin </h6>

                        <form id="myForm" method="POST" action="{{ route('store.admin') }}" class="forms-sample">
                            @csrf


                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1" class="form-label">Admin User Name </label>
                                <input type="text" name="username" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1" class="form-label">Admin Name </label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1" class="form-label">Admin Email </label>
                                <input type="email" name="email" class="form-control">
                            </div>


                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1" class="form-label">Admin Phone </label>
                                <input type="text" name="phone" class="form-control">
                            </div>



                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1" class="form-label">Admin Address </label>
                                <input type="text" name="address" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1" class="form-label">Admin Password </label>
                                <input type="password" name="password" class="form-control">
                            </div>


                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1" class="form-label">Role Name </label>
                                <select name="roles" class="form-select" id="exampleFormControlSelect1">
                                    <option selected="" disabled="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <button type="submit" class="btn btn-primary me-2">Save Changes </button>

                        </form>

                    </div>





                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->

            <!-- right wrapper end -->
        </div>

    </div>
</x-backend-layout>
