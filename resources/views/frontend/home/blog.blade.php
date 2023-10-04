@php
     $blog = App\Models\Blog::latest()
         ->limit(3)
         ->get();
 @endphp
<div class="full-row bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <span class="pb-2 d-table w-50 w-sm-100 text-primary m-auto text-center tagline">Our Recent Post</span>
                        <h2 class="down-line w-50 w-sm-100 mx-auto text-center mb-5 text-white">Publish What We Think, About Our Company Activities</h2>
                    </div>
                </div>
                <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1">
                    @foreach ($blog as $item)
                    <div class="col">
                        <div class="thumb-blog-overlay bg-white hover-text-PushUpBottom mb-4">
                            <div class="post-image position-relative overlay-secondary">
                                <img src="{{ asset($item->post_image) }}" >
                                <div class="position-absolute xy-center">
                                    <div class="overflow-hidden text-center">
                                        <a class="text-white first-push-up transation font-large" href="{{ url('blog/details/' . $item->post_slug) }}">+</a>
                                    </div>
                                </div>
                            </div>
                            <div class="post-content p-35">
                                <h5 class="d-block font-400 mb-3"><a href="{{ url('blog/details/' . $item->post_slug) }}" class="transation text-dark hover-text-primary">{{ $item->post_title }}</a></h5>
                                <p>{{ $item->short_descp }}</p>
                                <div class="post-meta text-uppercase">
                                    <a href="#"><span>By {{ $item['user']['name'] }}</span></a>
                                    <a href="#"><span>{{ $item->created_at->format('M d, Y') }}</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>