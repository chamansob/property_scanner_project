<x-frontend-layout>
    @section('title')
        Property Search
    @endsection
    <!--============== Page title Start ==============-->
    <div class="full-row py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3 class="text-secondary">Sale Property</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 bg-transparent p-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">Property Search</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--============== Page title End ==============-->

    <!--============== Property Grid View Start ==============-->
    <div class="full-row pt-0 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5">
                    <div class="listing-sidebar">
                        <div class="widget advance_search_widget">
                            <h5 class="mb-30">Search Property</h5>
                            <form class="rounded quick-search form-icon-right" action="#" method="post">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="keyword"
                                            placeholder="Enter Keyword...">
                                    </div>
                                    <div class="col-12">
                                        <select class="form-control">
                                            <option>Property Types</option>
                                            <option>House</option>
                                            <option>Office</option>
                                            <option>Appartment</option>
                                            <option>Condos</option>
                                            <option>Villa</option>
                                            <option>Small Family</option>
                                            <option>Single Room</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <select class="form-control">
                                            <option>Property Status</option>
                                            <option>For Rent</option>
                                            <option>For Sale</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" name="location"
                                                placeholder="Location">
                                            <i class="flaticon-placeholder flat-mini icon-font y-center text-dark"></i>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="position-relative">
                                            <button class="form-control price-toggle toggle-btn"
                                                data-target="#data-range-price">Price <i
                                                    class="fas fa-angle-down font-mini icon-font y-center text-dark"></i></button>
                                            <div id="data-range-price" class="price_range price-range-toggle w-100">
                                                <div class="area-filter price-filter">
                                                    <span class="price-slider">
                                                        <input class="filter_price" type="text" name="price"
                                                            value="0;10000000" />
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <select class="form-control">
                                            <option>Bedrooms</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <select class="form-control">
                                            <option>Bathrooms</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <select class="form-control">
                                            <option>Garage</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="keyword"
                                            placeholder="Min Area">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="keyword"
                                            placeholder="Max Area">
                                    </div>
                                    <div class="col-12">
                                        <div class="position-relative">
                                            <button class="form-control text-start toggle-btn"
                                                data-target="#aditional-features">Advanced <i
                                                    class="fas fa-ellipsis-v font-mini icon-font y-center text-dark"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-12 position-relative">
                                        <div id="aditional-features" class="aditional-features visible-static p-5">
                                            <h5 class="mb-3">Aditional Options</h5>
                                            <ul class="row row-cols-1 custom-check-box mb-4">
                                                <li class="col">
                                                    <input type="checkbox" class="custom-control-input hide"
                                                        id="customCheck1">
                                                    <label class="custom-control-label" for="customCheck1">Air
                                                        Conditioning</label>
                                                </li>
                                                <li class="col">
                                                    <input type="checkbox" class="custom-control-input hide"
                                                        id="customCheck2">
                                                    <label class="custom-control-label" for="customCheck2">Garage
                                                        Facility</label>
                                                </li>
                                                <li class="col">
                                                    <input type="checkbox" class="custom-control-input hide"
                                                        id="customCheck3">
                                                    <label class="custom-control-label" for="customCheck3">Swiming
                                                        Pool</label>
                                                </li>
                                                <li class="col">
                                                    <input type="checkbox" class="custom-control-input hide"
                                                        id="customCheck4">
                                                    <label class="custom-control-label" for="customCheck4">Fire
                                                        Security</label>
                                                </li>

                                                <li class="col">
                                                    <input type="checkbox" class="custom-control-input hide"
                                                        id="customCheck5">
                                                    <label class="custom-control-label" for="customCheck5">Fire Place
                                                        Facility</label>
                                                </li>
                                                <li class="col">
                                                    <input type="checkbox" class="custom-control-input hide"
                                                        id="customCheck6">
                                                    <label class="custom-control-label" for="customCheck6">Play
                                                        Ground</label>
                                                </li>
                                                <li class="col">
                                                    <input type="checkbox" class="custom-control-input hide"
                                                        id="customCheck7">
                                                    <label class="custom-control-label" for="customCheck7">Ferniture
                                                        Include</label>
                                                </li>
                                                <li class="col">
                                                    <input type="checkbox" class="custom-control-input hide"
                                                        id="customCheck8">
                                                    <label class="custom-control-label" for="customCheck8">Marbel
                                                        Floor</label>
                                                </li>

                                                <li class="col">
                                                    <input type="checkbox" class="custom-control-input hide"
                                                        id="customCheck9">
                                                    <label class="custom-control-label" for="customCheck9">Store
                                                        Room</label>
                                                </li>
                                                <li class="col">
                                                    <input type="checkbox" class="custom-control-input hide"
                                                        id="customCheck10">
                                                    <label class="custom-control-label" for="customCheck10">Hight
                                                        Class Door</label>
                                                </li>
                                                <li class="col">
                                                    <input type="checkbox" class="custom-control-input hide"
                                                        id="customCheck11">
                                                    <label class="custom-control-label" for="customCheck11">Floor
                                                        Heating System</label>
                                                </li>
                                                <li class="col">
                                                    <input type="checkbox" class="custom-control-input hide"
                                                        id="customCheck12">
                                                    <label class="custom-control-label" for="customCheck12">Garden
                                                        Include</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--============== Feature Property Widget Start ==============-->
                        <div class="widget property_carousel_widget">
                            <h5 class="mb-30">Feature Property</h5>
                            <div class="single-carusel owl-carousel nav-disable">
                                <div class="item">
                                    <div class="property-grid-2 property-block transation mb-3">
                                        <div
                                            class="overflow-hidden position-relative transation thumbnail-img rounded bg-secondary hover-img-zoom">
                                            <div class="cata position-absolute">
                                                <span class="sale bg-secondary text-white">For Sale</span>
                                            </div>
                                            <a href="property-single-v1.html"><img
                                                    src="assets/images/property_grid/property-grid-5.png"
                                                    alt="Image Not Found!"></a>
                                            <ul class="position-absolute quick-meta">
                                                <li><a href="#" title="Add Compare"><i
                                                            class="flaticon-transfer flat-mini"></i></a></li>
                                                <li><a href="#" title="Add Favourite"><i
                                                            class="flaticon-like-1 flat-mini"></i></a></li>
                                                <li class="md-mx-none"><a class="quick-view" href="#quick-view"
                                                        title="Quick View"><i
                                                            class="flaticon-zoom-increasing-symbol flat-mini"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="post-content py-3">
                                            <div class="post-meta font-small text-uppercase list-color-primary">
                                                <a href="#" class="listing-ctg"><i
                                                        class="fa-solid fa-building"></i><span>Villa</span></a>
                                            </div>
                                            <h5 class="listing-title"><a href="property-single-v1.html">Gorgeous Villa
                                                    Bay View</a></h5>
                                            <span class="listing-location"><i class="fas fa-map-marker-alt"></i> 2305
                                                Tree Frog Lane Overlandpk</span>
                                            <ul class="d-flex quantity font-fifteen">
                                                <li title="Beds"><span><i class="fa-solid fa-bed"></i></span>3</li>
                                                <li title="Baths"><span><i class="fa-solid fa-shower"></i></span>2
                                                </li>
                                                <li title="Area"><span><i
                                                            class="fa-solid fa-vector-square"></i></span>1200 Sqft</li>
                                                <li title="Gas"><span><i class="fa-solid fa-fire"></i></span>Yes
                                                </li>
                                            </ul>
                                            <span class="listing-price">{{  MONEY }}12000<small> ( Monthly )</small></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="property-grid-2 property-block transation mb-3">
                                        <div
                                            class="overflow-hidden position-relative transation thumbnail-img rounded bg-secondary hover-img-zoom">
                                            <div class="cata position-absolute">
                                                <span class="sale bg-secondary text-white">For Sale</span>
                                            </div>
                                            <a href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}"><img
                                                    src="assets/images/property_grid/property-grid-6.png"
                                                    alt="Image Not Found!"></a>
                                            <ul class="position-absolute quick-meta">
                                                <li><a href="#" title="Add Compare"><i
                                                            class="flaticon-transfer flat-mini"></i></a></li>
                                                <li><a href="#" title="Add Favourite"><i
                                                            class="flaticon-like-1 flat-mini"></i></a></li>
                                                <li class="md-mx-none"><a class="quick-view" href="#quick-view"
                                                        title="Quick View"><i
                                                            class="flaticon-zoom-increasing-symbol flat-mini"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="post-content py-3">
                                            <div class="post-meta font-small text-uppercase list-color-primary">
                                                <a href="#" class="listing-ctg"><i
                                                        class="fa-solid fa-building"></i><span>Appartment</span></a>
                                            </div>
                                            <h5 class="listing-title"><a href="property-single-v1.html">Luxury
                                                    Condos</a></h5>
                                            <span class="listing-location"><i class="fas fa-map-marker-alt"></i> 2305
                                                Tree Frog Lane Overlandpk</span>
                                            <ul class="d-flex quantity font-fifteen">
                                                <li title="Beds"><span><i class="fa-solid fa-bed"></i></span>3</li>
                                                <li title="Baths"><span><i class="fa-solid fa-shower"></i></span>2
                                                </li>
                                                <li title="Area"><span><i
                                                            class="fa-solid fa-vector-square"></i></span>1200 Sqft</li>
                                                <li title="Gas"><span><i class="fa-solid fa-fire"></i></span>Yes
                                                </li>
                                            </ul>
                                            <span class="listing-price">{{  MONEY }}1205500 <del>$1210000</del><small> ( Price
                                                    Only )</small></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="property-grid-2 property-block transation mb-3">
                                        <div
                                            class="overflow-hidden position-relative transation thumbnail-img rounded bg-secondary hover-img-zoom">
                                            <div class="cata position-absolute">
                                                <span class="sale bg-secondary text-white">For Rent</span>
                                            </div>
                                            <a href="property-single-v1.html"><img
                                                    src="assets/images/property_grid/property-grid-7.png"
                                                    alt="Image Not Found!"></a>
                                            <ul class="position-absolute quick-meta">
                                                <li><a href="#" title="Add Compare"><i
                                                            class="flaticon-transfer flat-mini"></i></a></li>
                                                <li><a href="#" title="Add Favourite"><i
                                                            class="flaticon-like-1 flat-mini"></i></a></li>
                                                <li class="md-mx-none"><a class="quick-view" href="#quick-view"
                                                        title="Quick View"><i
                                                            class="flaticon-zoom-increasing-symbol flat-mini"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="post-content py-3">
                                            <div class="post-meta font-small text-uppercase list-color-primary">
                                                <a href="#" class="listing-ctg"><i
                                                        class="fa-solid fa-building"></i><span>Appartment</span></a>
                                            </div>
                                            <h5 class="listing-title"><a href="property-single-v1.html">New Developed
                                                    Condos</a></h5>
                                            <span class="listing-location"><i class="fas fa-map-marker-alt"></i> 2305
                                                Tree Frog Lane Overlandpk</span>
                                            <ul class="d-flex quantity font-fifteen">
                                                <li title="Beds"><span><i class="fa-solid fa-bed"></i></span>3</li>
                                                <li title="Baths"><span><i class="fa-solid fa-shower"></i></span>2
                                                </li>
                                                <li title="Area"><span><i
                                                            class="fa-solid fa-vector-square"></i></span>1200 Sqft</li>
                                                <li title="Gas"><span><i class="fa-solid fa-fire"></i></span>Yes
                                                </li>
                                            </ul>
                                            <span class="listing-price">{{  MONEY }}17500 <del>$21000</del><small> ( Monthly
                                                    )</small></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="property-grid-2 property-block transation mb-3">
                                        <div
                                            class="overflow-hidden position-relative transation thumbnail-img rounded bg-secondary hover-img-zoom">
                                            <div class="cata position-absolute">
                                                <span class="sale bg-secondary text-white">For Rent</span>
                                            </div>
                                            <a href="property-single-v1.html"><img
                                                    src="assets/images/property_grid/property-grid-8.png"
                                                    alt="Image Not Found!"></a>
                                            <ul class="position-absolute quick-meta">
                                                <li><a href="#" title="Add Compare"><i
                                                            class="flaticon-transfer flat-mini"></i></a></li>
                                                <li><a href="#" title="Add Favourite"><i
                                                            class="flaticon-like-1 flat-mini"></i></a></li>
                                                <li class="md-mx-none"><a class="quick-view" href="#quick-view"
                                                        title="Quick View"><i
                                                            class="flaticon-zoom-increasing-symbol flat-mini"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="post-content py-3">
                                            <div class="post-meta font-small text-uppercase list-color-primary">
                                                <a href="#" class="listing-ctg"><i
                                                        class="fa-solid fa-building"></i><span>Condos</span></a>
                                            </div>
                                            <h5 class="listing-title"><a href="property-single-v1.html">Residensial
                                                    Appartment</a></h5>
                                            <span class="listing-location"><i class="fas fa-map-marker-alt"></i> 2305
                                                Tree Frog Lane Overlandpk</span>
                                            <ul class="d-flex quantity font-fifteen">
                                                <li title="Beds"><span><i class="fa-solid fa-bed"></i></span>3</li>
                                                <li title="Baths"><span><i class="fa-solid fa-shower"></i></span>2
                                                </li>
                                                <li title="Area"><span><i
                                                            class="fa-solid fa-vector-square"></i></span>1200 Sqft</li>
                                                <li title="Gas"><span><i class="fa-solid fa-fire"></i></span>Yes
                                                </li>
                                            </ul>
                                            <span class="listing-price">{{  MONEY }}22000 <del>$26200</del><small> ( Monthly
                                                    )</small></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="property-grid-2 property-block transation mb-3">
                                        <div
                                            class="overflow-hidden position-relative transation thumbnail-img rounded bg-secondary hover-img-zoom">
                                            <div class="cata position-absolute">
                                                <span class="sale bg-secondary text-white">For Sale</span>
                                            </div>
                                            <a href="property-single-v1.html"><img
                                                    src="assets/images/property_grid/property-grid-5.png"
                                                    alt="Image Not Found!"></a>
                                            <ul class="position-absolute quick-meta">
                                                <li><a href="#" title="Add Compare"><i
                                                            class="flaticon-transfer flat-mini"></i></a></li>
                                                <li><a href="#" title="Add Favourite"><i
                                                            class="flaticon-like-1 flat-mini"></i></a></li>
                                                <li class="md-mx-none"><a class="quick-view" href="#quick-view"
                                                        title="Quick View"><i
                                                            class="flaticon-zoom-increasing-symbol flat-mini"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="post-content py-3">
                                            <div class="post-meta font-small text-uppercase list-color-primary">
                                                <a href="#"><span>Villa</span></a>
                                            </div>
                                            <h5 class="listing-title"><a href="property-single-v1.html">Gorgeous Villa
                                                    Bay View</a></h5>
                                            <span class="listing-location"><i class="fas fa-map-marker-alt"></i> 2305
                                                Tree Frog Lane Overlandpk</span>
                                            <ul class="d-flex quantity font-fifteen">
                                                <li title="Beds"><span><i class="fa-solid fa-bed"></i></span>3</li>
                                                <li title="Baths"><span><i class="fa-solid fa-shower"></i></span>2
                                                </li>
                                                <li title="Area"><span><i
                                                            class="fa-solid fa-vector-square"></i></span>1200 Sqft</li>
                                                <li title="Gas"><span><i class="fa-solid fa-fire"></i></span>Yes
                                                </li>
                                            </ul>
                                            <span class="listing-price">{{  MONEY }}12000 <del>$15000</del><small> ( Monthly
                                                    )</small></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--============== Feature Property Widget End ==============-->

                        <!--============== Recent Property Widget Start ==============-->
                        <div class="widget widget_recent_property">
                            <h5 class="text-secondary mb-4">Recent Property</h5>
                            <ul>
                                <li>
                                    <img src="assets/images/thumbnaillist/01.jpg" alt="">
                                    <div class="thumb-body">
                                        <h6 class="listing-title"><a href="property-single-1.html">Nirala
                                                Appartment</a></h6>
                                        <span class="listing-price">{{  MONEY }}3200<small>( Monthly )</small></span>
                                        <ul class="d-flex quantity font-fifteen">
                                            <li title="Area"><span><i
                                                        class="fa-solid fa-vector-square"></i></span>6500 Sqft</li>

                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <img src="assets/images/thumbnaillist/02.jpg" alt="">
                                    <div class="thumb-body">
                                        <h6 class="listing-title"><a href="property-single-1.html">Condo House</a>
                                        </h6>
                                        <span class="listing-price">{{  MONEY }}11500<small>( Monthly )</small></span>
                                        <ul class="d-flex quantity font-fifteen">
                                            <li title="Area"><span><i
                                                        class="fa-solid fa-vector-square"></i></span>2200 Sqft</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <img src="assets/images/thumbnaillist/03.jpg" alt="">
                                    <div class="thumb-body">
                                        <h6 class="listing-title"><a href="property-single-1.html">Luxury Condos</a>
                                        </h6>
                                        <span class="listing-price">{{  MONEY }}17000<small>( Monthly )</small></span>
                                        <ul class="d-flex quantity font-fifteen">
                                            <li title="Area"><span><i
                                                        class="fa-solid fa-vector-square"></i></span>3500 Sqft</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <img src="assets/images/thumbnaillist/04.jpg" alt="">
                                    <div class="thumb-body">
                                        <h6 class="listing-title"><a href="property-single-1.html">Small
                                                Appartment</a></h6>
                                        <span class="listing-price">{{  MONEY }}5200<small>( Monthly )</small></span>
                                        <ul class="d-flex quantity font-fifteen">
                                            <li title="Area"><span><i
                                                        class="fa-solid fa-vector-square"></i></span>1200 Sqft</li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!--============== Recent Property Widget End ==============-->
                    </div>
                </div>

                <div class="col-xl-8 col-lg-7">
                    <div class="row">
                        <div class="col">
                            <div class="woo-filter-bar p-3 d-flex flex-wrap justify-content-between">
                                <div class="d-flex flex-wrap">

                                </div>
                                <div class="d-flex">
                                    <span class="woocommerce-ordering-pages me-4 font-fifteen">Showing at
                                        {{ count($property) }} result</span>
                                    {{-- <form class="view-category" method="get">
                                            <button title="List" class="list-view" value="list" name="display" type="submit"><i class="flaticon-grid-1 flat-mini"></i></button>
                                            <button title="Grid" class="grid-view active" value="grid" name="display" type="submit"><i class="flaticon-grid flat-mini"></i></button>
                                        </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-xl-2 row-cols-lg-1 row-cols-md-2 row-cols-1 g-4">
                        @foreach ($property as $item)
                            <div class="col">
                                <!-- Property Grid -->
                                <div class="property-grid-1 property-block bg-white transation-this hover-shadow">
                                    <div
                                        class="overflow-hidden position-relative transation thumbnail-img bg-secondary hover-img-zoom">
                                        <div class="cata position-absolute">
                                            <span class="sale bg-secondary text-white">For
                                                {{ ucfirst($item->property_status) }}</span>
                                            <span class="featured bg-primary text-white">
                                                @if ($item->featured == 1)
                                                    Featured
                                                @else
                                                    New
                                                @endif
                                            </span>
                                        </div>
                                        <a
                                            href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}">
                                            <img src="{{ asset($item->property_thumbnail) }}" class="w-100"></a>

                                        <ul class="position-absolute quick-meta">
                                            <li><a href="javascript:void(0)" title="Add Compare"
                                                    class="action-btn {{ $item->compare($item->id) != 0 ? 'compactive' : '' }} proc_{{ $item->id }}"
                                                    id="{{ $item->id }}" onclick="addToCompare(this.id)"><i
                                                        class="flaticon-transfer flat-mini"></i></a></li>
                                            <li><a href="javascript:void(0)" title="Add Wishlist"
                                                    class="action-btn {{ $item->wishlist($item->id) != 0 ? 'wishactive' : '' }} pro_{{ $item->id }}"
                                                    id="{{ $item->id }}" onclick="addToWishList(this.id)"><i
                                                        class="flaticon-like-1 flat-mini"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="property_text p-4">

                                        <span
                                            class="listing-price">{{  MONEY }}{{ number_format($item->lowest_price, 2) }}</span>
                                        <h5 class="listing-title"><a
                                                href="property-single-v1.html">{{ $item->property_name }}</a></h5>
                                        <span class="listing-location"><i
                                                class="fas fa-map-marker-alt text-primary"></i>
                                            {{ $item->address }}</span>
                                        <ul class="d-flex quantity font-fifteen">
                                            <li title="Beds"><span><i
                                                        class="fa-solid fa-bed"></i></span>{{ $item->bedrooms }}</li>
                                            <li title="Baths"><span><i
                                                        class="fa-solid fa-shower"></i></span>{{ $item->bathrooms }}
                                            </li>
                                            <li title="Area"><span><i
                                                        class="fa-solid fa-vector-square"></i></span>{{ $item->property_size }}
                                                {{ $item->propertysizes->name }}</li>
                                        </ul>
                                        <div class="d-flex justify-content-between mt-4">
                                            <div class="agent-meta">
                                                @if ($item->agent_id == null)
                                                    @php
                                                      
                                                         $admin=App\Models\User::find(1); 
                                                        $image = !empty($admin->photo) ? url($admin->photo) : url('upload/no_image.jpg');
                                                        $role = $admin->role;
                                                        $name = $admin->name;
                                                        
                                                    @endphp
                                                @else
                                                    @php
                                                        $image = !empty($item->user->photo) ? url($item->user->photo) : url('upload/no_image.jpg');
                                                        $role = $item->user->role;
                                                        $name = $item->user->name;
                                                        
                                                    @endphp
                                                @endif
                                                <a href="#" class="d-flex text-general align-items-center"><img
                                                        class="rounded-circle me-2" src="{{ $image }}"
                                                        alt="avata"><span>{{ ucfirst($name) }}</span></a>
                                            </div>
                                            <a href="#quick-email" class="btn btn-primary quick-view"><i
                                                    class="fas fa-envelope"></i> Send Email</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col mt-5">
                            <nav aria-label="Page navigation example">
                               {{ $property->links('vendor.pagination.custom') }} 
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--============== Property Grid View End ==============-->


</x-frontend-layout>
