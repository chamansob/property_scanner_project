<x-dashboard-layout>
      @php

            $id = Auth::user()->id;
            $userData = App\Models\User::find($id); 
        @endphp
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="full-row px-40 py-30 xs-p-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h3 class="my-3 text-dark">Schedule Request</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="border rounded bg-white p-30 mb-30">
                        <div class="row">
                           
                            <div class="col-xl-12">
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

</x-dashboard-layout>
