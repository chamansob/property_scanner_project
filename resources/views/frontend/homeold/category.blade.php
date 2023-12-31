 @php
     $ptypes = App\Models\PropertyType::latest()
         ->limit(5)
         ->get();
 @endphp
 <section class="category-section centred">
     <div class="auto-container">
         <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
             <ul class="category-list clearfix">
                 @foreach ($ptypes as $ptype)
                     @php
                         $property = App\Models\Property::where('ptype_id', $ptype->id)->get();
                     @endphp
                     <li>
                         <div class="category-block-one">
                             <div class="inner-box">
                                 <div class="icon-box"><i class="{{ $ptype->type_icon }}"></i></div>
                                 <h5><a
                                         href="{{ route('property.type', $ptype->id) }}">{{ ucfirst($ptype->type_name) }}</a>
                                 </h5>
                                 <span>{{ $property->count() }}</span>
                             </div>
                         </div>
                     </li>
                 @endforeach
             </ul>
             <div class="more-btn"><a href="categories.html" class="theme-btn btn-one">All Categories</a>
             </div>
         </div>
     </div>
 </section>
