<x-frontend-layout>
  <!--============== Page title Start ==============-->
        <div class="full-row py-5">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3 class="text-secondary">Blog</h3>
                        <nav aria-label="breadcrumb" class="mb-2">
                            <ol class="breadcrumb mb-0 bg-transparent p-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>                                
                                <li class="breadcrumb-item active text-primary" aria-current="page">Blog</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!--============== Page title End ==============-->

        <!--============== Blog Area Start ==============-->
        <div class="full-row pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 order-xl-2">
                        <div class="blog-sidebar widget-box-model">
                            <!-- Search Field -->
                            <div class="widget widget_search">
                                <form role="search" method="get" class="search_form" action="http://localhost/axeman-wp/">
                                    <label>
									<span class="screen-reader-text">Search for:</span>
									<input type="search" class="search-field" placeholder="Search …" value="" name="s">
								</label>
                                    <input type="submit" class="search-submit" value="Search">
                                </form>
                            </div>
                            <!-- Category Field -->
                            <div class="widget widget_categories">
                                <h5 class="widget-title mb-3 text-dark">Categories</h5>
                                <ul>
                                    @foreach ($bcategory as $cat)
                                    @php
                                        $post = App\Models\Blog::where('blogcat_id', $cat->id)->get();
                                    @endphp
                                    <li class="cat-item cat-item-3"><a href="{{ url('blog/cat/list/' . $cat->id) }}">{{ $cat->category_name }}</a> ({{ count($post) }})</li>
                                   
                                    @endforeach
                                     </ul>
                            </div>
                            <!-- Recent Post -->
                            <div class="widget widget_recent_entries">
                                <h5 class="widget-title mb-3 text-dark">Recent Post</h5>
                                <ul>
                                     @foreach ($dpost as $post)
                                    <li>
                                        <a href="#">{{ $post->post_title }}</a>
                                        <span class="post-date">{{ $post->created_at->format('M d Y') }}</span>
                                    </li>
                                      @endforeach
                                </ul>
                            </div>

                            {{-- <!--============== Recent Property Widget Start ==============-->
                            <div class="widget widget_recent_property">
                                <h5 class="text-secondary mb-4 text-dark">Recent Property</h5>
                                <ul>
                                    <li>
                                        <img src="assets/images/thumbnaillist/01.jpg" alt="">
                                        <div class="thumb-body">
                                            <h6 class="listing-title"><a href="property-single-1.html">Nirala Appartment</a></h6>
                                            <span class="listing-price">$3200<small>( Monthly )</small></span>
                                            <ul class="d-flex quantity font-fifteen">
                                                <li title="Area"><span><i class="fa-solid fa-vector-square"></i></span>6500 Sqft</li>

                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <img src="assets/images/thumbnaillist/02.jpg" alt="">
                                        <div class="thumb-body">
                                            <h6 class="listing-title"><a href="property-single-1.html">Condo House</a></h6>
                                            <span class="listing-price">$11500<small>( Monthly )</small></span>
                                            <ul class="d-flex quantity font-fifteen">
                                                <li title="Area"><span><i class="fa-solid fa-vector-square"></i></span>2200 Sqft</li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <img src="assets/images/thumbnaillist/03.jpg" alt="">
                                        <div class="thumb-body">
                                            <h6 class="listing-title"><a href="property-single-1.html">Luxury Condos</a></h6>
                                            <span class="listing-price">$17000<small>( Monthly )</small></span>
                                            <ul class="d-flex quantity font-fifteen">
                                                <li title="Area"><span><i class="fa-solid fa-vector-square"></i></span>3500 Sqft</li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <img src="assets/images/thumbnaillist/04.jpg" alt="">
                                        <div class="thumb-body">
                                            <h6 class="listing-title"><a href="property-single-1.html">Small Appartment</a></h6>
                                            <span class="listing-price">$5200<small>( Monthly )</small></span>
                                            <ul class="d-flex quantity font-fifteen">
                                                <li title="Area"><span><i class="fa-solid fa-vector-square"></i></span>1200 Sqft</li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div> --}}
                            <!-- Tags -->
                            {{-- <div class="widget widget_tag_cloud">
                                <h5 class="widget-title mb-3">Tags</h5>
                                <div class="tagcloud">
                                    <ul>
                                        <li><a href="#">general</a></li>
                                        <li><a href="#">videos</a></li>
                                        <li><a href="#">media</a></li>
                                        <li><a href="#">web</a></li>
                                        <li><a href="#">parallax</a></li>
                                        <li><a href="#">ecommerce</a></li>
                                        <li><a href="#">t-shirt</a></li>
                                        <li><a href="#">women</a></li>
                                        <li><a href="#">trade</a></li>
                                        <li><a href="#">animation</a></li>
                                        <li><a href="#">theme</a></li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-xl-8 order-xl-1 sm-mb-30">
                        <div class="row row-cols-md-2 row-cols-1 g-4">
                              @foreach ($blog as $item)
                            <div class="col">
                                <div class="thumb-blog-simple shadow-sm rounded bg-white">
                                    <div class="post-image">
                                        <img src="{{ asset($item->post_image) }}" alt="">
                                    </div>
                                    <div class="content p-4">
                                        <div class="date text-general pb-2">{{ $item->created_at->format('M d Y') }}</div>
                                        <h5 class="mb-0 post-title"><a class="text-dark" href="{{ url('blog/details/' . $item->post_slug) }}">{{ $item->post_title }}</a></h5>
                                    </div>
                                </div>
                            </div>
                             @endforeach
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
        <!--============== Blog Area End ==============-->

</x-frontend-layout>
