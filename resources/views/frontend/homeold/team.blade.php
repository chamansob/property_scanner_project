  @php
      $agents = App\Models\User::where('status', 'active')
          ->where('role', 'agent')
          ->orderBy('id', 'DESC')
          ->limit(5)
          ->get();
  @endphp
  <section class="team-section sec-pad centred bg-color-1">
      <div class="pattern-layer" style="background-image: url({{ asset('frontend/assets/images/shape/shape-1.png') }});">
      </div>
      <div class="auto-container">
          <div class="sec-title">
              <h5>Our Agents</h5>
              <h2>Meet Our Excellent Agents</h2>
          </div>
          <div class="single-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">

              @foreach ($agents as $item)
                  <div class="team-block-one">
                      <div class="inner-box">
                          <figure class="image-box">
                              @php
                                  if (!empty($item->photo)) {
                                      $img = explode('.', $item->photo);
                                      $table_img = $img[0] . '_agent_avatar.' . $img[1];
                                      $table_img = url($table_img);
                                  } else {
                                      $table_img = url('upload/no_image.jpg');
                                  }
                              @endphp


                              <img src="{{ $table_img }}" alt="">
                          </figure>
                          <div class="lower-content">
                              <div class="inner">
                                  <h4><a href="{{ route('agent.details', $item->id) }}">{{ $item->name }}</a></h4>
                                  <span class="designation">{{ $item->email }}</span>
                                  <ul class="social-links clearfix">
                                      <li><a href="index.html"><i class="fab fa-facebook-f"></i></a></li>
                                      <li><a href="index.html"><i class="fab fa-twitter"></i></a></li>
                                      <li><a href="index.html"><i class="fab fa-google-plus-g"></i></a></li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
      </div>
  </section>