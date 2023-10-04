<x-backend-layout>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">

                <a href="{{ route('export') }}" class="btn btn-inverse-danger"> Download Xlsx </a>

            </ol>
        </nav>


        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">


                        <h6 class="card-title">Import Permission </h6>

                        <form id="myForm" method="POST" action="{{ route('import') }}" class="forms-sample"
                            enctype="multipart/form-data">
                            @csrf


                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1" class="form-label">Xlsx File Import </label>
                                <input type="file" name="import_file" class="form-control">

                            </div>




                            <button type="submit" class="btn btn-inverse-warning">Upload </button>

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
