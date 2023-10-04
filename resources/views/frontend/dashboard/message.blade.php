<section class="property-page-section property-list">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="blog-sidebar">
                    @include('frontend.dashboard.profile_info')
                    @include('frontend.dashboard.sidebar')
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">

                            <div class="lower-content">

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Property Name </th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($srequest as $key => $item)
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td><a
                                                        href="{{ url('property/details/' . $item['property']['id'] . '/' . $item['property']['property_slug']) }}">{{ $item['property']['property_name'] }}</a>
                                                </td>
                                                <td>{{ $item->tour_date }}</td>
                                                <td>{{ $item->tour_time }}</td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span
                                                            class="badge rounded-pill bg-success text-white">Confirm</span>
                                                    @else
                                                        <span
                                                            class="badge rounded-pill bg-danger text-white">Pending</span>
                                                    @endif
                                                </td>
                                                <td><a
                                                        href="{{ url('property/details/' . $item['property']['id'] . '/' . $item['property']['property_slug']) }}"><span
                                                            class="badge rounded-pill bg-warning text-white">View</span>
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
    </div>
</section>
