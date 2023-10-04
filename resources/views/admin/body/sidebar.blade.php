<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            Admin<span>Panel</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ active_class('admin/dashboard') }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ active_class('/') }}">
                <a href="{{ url('/') }}" class="nav-link" target="_blank">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Home</span>
                </a>
            </li>
            <li class="nav-item nav-category">Real Estate</li>
            @if (Auth::user()->can('property_types.menu'))
                <li class="nav-item {{ active_class('admin/ptypes') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#type" role="button" aria-expanded="{{ is_active_route('admin/ptypes') }}"
                        aria-controls="type">
                        <i class="link-icon" data-feather="feather"></i>
                        <span class="link-title">Property Type </span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/ptypes') }}" id="type">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('property_types.index'))
                                <li class="nav-item">
                                    <a href="{{ route('ptypes.index') }}" class="nav-link {{ active_class('admin/ptypes') }}" >All Type</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('property_types.create'))
                                <li class="nav-item">
                                    <a href="{{ route('ptypes.create') }}" class="nav-link {{ active_class('admin/ptypes/create') }}" >Add Type</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            @if (Auth::user()->can('properties.menu'))
                <li class="nav-item {{ active_class('admin/properties') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#property" role="button" aria-expanded="{{ is_active_route('admin/properties') }}"
                        aria-controls="property">
                        <i class="link-icon" data-feather="anchor"></i>
                        <span class="link-title">Property</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/properties') }}" id="property">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('properties.index'))
                                <li class="nav-item">
                                    <a href="{{ route('properties.index') }}" class="nav-link {{ active_class('admin/properties') }}">All Property</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('properties.create'))
                                <li class="nav-item">
                                    <a href="{{ route('properties.create') }}" class="nav-link {{ active_class('admin/properties/create') }}">Add Property</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
             @if (Auth::user()->can('propertysize.menu'))
             <li class="nav-item {{ active_class('admin/propertysize') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#propertysize" role="button" aria-expanded="{{ is_active_route('admin/propertysize') }}"
                        aria-controls="propertysize">
                        <i class="link-icon" data-feather="maximize-2"></i>
                        <span class="link-title">Property Size</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/propertysize') }}" id="propertysize">
                        <ul class="nav sub-menu">
                           @if (Auth::user()->can('propertysize.index'))
                                <li class="nav-item">
                                    <a href="{{ route('propertysize.index') }}" class="nav-link {{ active_class('admin/propertysize') }}">All Property Size</a>
                                </li>
                                 @endif
                           @if (Auth::user()->can('propertysize.create'))
                          
                                <li class="nav-item">
                                    <a href="{{ route('propertysize.create') }}" class="nav-link {{ active_class('admin/propertysize/create') }}">Add Property Size</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
             @endif
            @if (Auth::user()->can('amenities.menu'))
                <li class="nav-item {{ active_class('admin/amenities') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#amenities" role="button" aria-expanded="{{ is_active_route('admin/amenities') }}"
                        aria-controls="amenities">
                        <i class="link-icon" data-feather="star"></i>
                        <span class="link-title">Amenities</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/amenities') }}" id="amenities">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('amenities.index'))
                                <li class="nav-item">
                                    <a href="{{ route('amenities.index') }}" class="nav-link {{ active_class('admin/amenities') }}">All Amenities</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('amenities.create'))
                                <li class="nav-item">
                                    <a href="{{ route('amenities.create') }}" class="nav-link {{ active_class('admin/amenities/create') }}">Add Amenities</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
           @if (Auth::user()->can('facilities.menu'))
                <li class="nav-item {{ active_class('admin/facilities') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#facilities" role="button" aria-expanded="{{ is_active_route('admin/facilities') }}"
                        aria-controls="facilities">
                        <i class="link-icon" data-feather="thumbs-up"></i>
                        <span class="link-title">Facilities</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/facilities') }}" id="facilities">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('facilities.index'))
                                <li class="nav-item">
                                    <a href="{{ route('facilities.index') }}" class="nav-link {{ active_class('admin/facilities') }}">All Facilities</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('facilities.create'))
                                <li class="nav-item">
                                    <a href="{{ route('facilities.create') }}" class="nav-link {{ active_class('admin/facilities/create') }}">Add Facilities</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            @if (Auth::user()->can('image_preset.menu'))
                <li class="nav-item {{ active_class('admin/image_preset') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#image_preset" role="button"
                        aria-expanded="{{ is_active_route('admin/image_preset') }}" aria-controls="image_preset">
                        <i class="link-icon" data-feather="airplay"></i>
                        <span class="link-title">Image Preset</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/image_preset') }}" id="image_preset">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('image_preset.index'))
                                <li class="nav-item">
                                    <a href="{{ route('image_preset.index') }}" class="nav-link {{ active_class('admin/image_preset') }}">All Image Preset</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('image_preset.create'))
                                <li class="nav-item">
                                    <a href="{{ route('image_preset.create') }}" class="nav-link {{ active_class('admin/image_preset/create') }}">Add Image Preset</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
             @if (Auth::user()->can('module.menu'))
                <li class="nav-item {{ active_class('admin/module') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#module" role="button"
                        aria-expanded="{{ is_active_route('admin/module') }}" aria-controls="module">
                        <i class="link-icon" data-feather="airplay"></i>
                        <span class="link-title">Module</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/module') }}" id="module">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('module.index'))
                                <li class="nav-item">
                                    <a href="{{ route('modules.index') }}" class="nav-link {{ active_class('admin/module') }}">All Module</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('module.create'))
                                <li class="nav-item">
                                    <a href="{{ route('modules.create') }}" class="nav-link {{ active_class('admin/module/create') }}">Add Module</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            @if (Auth::user()->can('budgetrange.menu'))
                <li class="nav-item {{ active_class('admin/budgetrange') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#budgetrange" role="button"
                        aria-expanded="{{ is_active_route('admin/budgetrange') }}"
                        aria-controls="budgetrange">
                        <i class="link-icon" data-feather="airplay"></i>
                        <span class="link-title">Budget Range</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/budgetrange') }}" id="budgetrange">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('budgetrange.index'))
                                <li class="nav-item">
                                    <a href="{{ route('budgetrange.index') }}"
                                        class="nav-link {{ active_class('admin/budgetrange') }}">All
                                        Budget Range</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('module.create'))
                                <li class="nav-item">
                                    <a href="{{ route('budgetrange.create') }}"
                                        class="nav-link
                                        {{ active_class('admin/budgetrange/create') }}">Add
                                        Budget Range</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            @if (Auth::user()->can('admin.package_history'))
                <li class="nav-item {{ active_class('admin/buy/package_history') }}">

                    <a href="{{ route('admin.package_history') }}" class="nav-link {{ active_class('admin/buy/package_history') }}">
                        <i class="link-icon" data-feather="calendar"></i>

                        <span class="link-title">Package History</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->can('plan.menu'))
                <li class="nav-item {{ active_class('admin/plan') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#plan" role="button"
                        aria-expanded="{{ is_active_route('admin/plan') }}" aria-controls="plan">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Plan</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/plan') }}" id="plan">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('plan.index'))
                                <li class="nav-item">
                                    <a href="{{ route('plan.index') }}" class="nav-link {{ active_class('admin/plan') }}">All Plan</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('plan.create'))
                                <li class="nav-item">
                                    <a href="{{ route('plan.create') }}" class="nav-link {{ active_class('admin/plan/create') }}">Add Plan</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            @if (Auth::user()->can('planFeatures.menu'))
                <li class="nav-item {{ active_class('admin/planFeatures') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#planfeature" role="button"
                        aria-expanded="{{ is_active_route('admin/planFeatures') }}" aria-controls="planfeature">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Plan Feature</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/planFeatures') }}" id="planfeature">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('planFeatures.index'))
                                <li class="nav-item">
                                    <a href="{{ route('planFeatures.index') }}" class="nav-link {{ active_class('admin/planFeatures') }}">All Plan Feature</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('planFeatures.create'))
                                <li class="nav-item">
                                    <a href="{{ route('planFeatures.create') }}" class="nav-link {{ active_class('admin/planFeatures/create') }}">Add Plan
                                        Feature</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
           
                <li class="nav-item nav-category">User All Functions</li>
                 @if (Auth::user()->can('agent.menu'))
                <li class="nav-item {{ active_class('admin/agent') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#agents" role="button"
                        aria-expanded="{{ is_active_route('admin/agent') }}" aria-controls="agents">
                        <i class="link-icon" data-feather="user"></i>
                        <span class="link-title">Manage Agent</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/agent') }}" id="agents">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('admin.agents'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.agents') }}" class="nav-link {{ active_class('admin/agent') }}">All Agent</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('admin.agent_add'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.agent_add') }}" class="nav-link {{ active_class('admin/agent/create') }}">Add Agent</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            <li class="nav-item {{ active_class('admin/users') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#users" role="button"
                        aria-expanded="{{ is_active_route('admin/user') }}" aria-controls="users">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">Manage User</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/users') }}" id="users">
                        <ul class="nav sub-menu">
                           
                                <li class="nav-item">
                                    <a href="{{ route('admin.users') }}" class="nav-link {{ active_class('admin/users') }}">All User</a>
                                </li>
                           
                                <li class="nav-item">
                                    <a href="{{ route('admin.user_add') }}" class="nav-link {{ active_class('admin/user/create') }}">Add User</a>
                                </li>
                           
                        </ul>
                    </div>
                </li>
            @if (Auth::user()->can('testimonial.menu'))
                <li class="nav-item {{ active_class('admin/testimonial') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#testimonial" role="button"
                        aria-expanded="{{ is_active_route('admin/testimonial') }}" aria-controls="planfeature">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Testimonial</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/testimonial') }}" id="testimonial">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('testimonial.index'))
                                <li class="nav-item">
                                    <a href="{{ route('testimonial.index') }}" class="nav-link {{ active_class('admin/testimonial') }}">All Testimonial</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('testimonial.create'))
                                <li class="nav-item">
                                    <a href="{{ route('testimonial.create') }}" class="nav-link {{ active_class('admin/testimonial/create') }}">Add Testimonial</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            @if (Auth::user()->can('blog_category.menu'))
                <li class="nav-item {{ active_class('admin/blog_category') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#blog" role="button"
                        aria-expanded="{{ is_active_route('admin/blog_category') }}" aria-controls="planfeature">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Blog</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/blog_category') }}" id="blog">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('blog_category.index'))
                                <li class="nav-item">
                                    <a href="{{ route('blog_category.index') }}" class="nav-link {{ active_class('admin/blog_category') }}">All Blog
                                        Category</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('blog_category.create'))
                                <li class="nav-item">
                                    <a href="{{ route('blog_category.create') }}" class="nav-link {{ active_class('admin/blog_category/create') }}">Add Blog
                                        Category</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            @if (Auth::user()->can('blog.menu'))
                <li class="nav-item {{ active_class('admin/blog') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#post" role="button"
                        aria-expanded="{{ is_active_route('admin/blog') }}" aria-controls="planfeature">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Post</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/blog') }}" id="post">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('blog.index'))
                                <li class="nav-item">
                                    <a href="{{ route('blog.index') }}" class="nav-link {{ active_class('admin/blog') }}">All Post</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('blog.create'))
                                <li class="nav-item">
                                    <a href="{{ route('blog.create') }}" class="nav-link {{ active_class('admin/blog/create') }}">Add Post</a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a href="{{ route('blog_tag.index') }}" class="nav-link {{ active_class('admin/blog_tag') }}">All Post Tag</a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('blog_tag.create') }}" class="nav-link {{ active_class('admin/blog_tag/create') }}">Add Post Tag</a>
                            </li>


                        </ul>
                    </div>
                </li>
            @endif
            @if (Auth::user()->can('admin.blog.comment'))
                <li class="nav-item">
                    <a href="{{ route('admin.blog.comment') }}" class="nav-link {{ active_class('admin/blogpost/comment') }}">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Blog Comment </span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->can('admin.property.message'))
                <li class="nav-item">
                    <a href="{{ route('admin.property.message') }}" class="nav-link {{ active_class('admin/property/message') }}">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Property Message </span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->can('country.menu'))
                <li class="nav-item nav-category">Other</li>
                <li class="nav-item {{ active_class('admin/countries') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#country" role="button"
                        aria-expanded="{{ is_active_route('admin/countries') }}" aria-controls="country">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Country</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/countries') }}" id="country">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('country.index'))
                                <li class="nav-item">
                                    <a href="{{ route('countries.index') }}" class="nav-link {{ active_class('admin/countries') }}">All Country</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('country.create'))
                                <li class="nav-item">
                                    <a href="{{ route('countries.create') }}" class="nav-link {{ active_class('admin/countries/create') }}">Add Country</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            @if (Auth::user()->can('state.menu'))
                <li class="nav-item {{ active_class('admin/states') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#state" role="button"
                        aria-expanded="{{ is_active_route('admin/states') }}" aria-controls="state">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">State</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/states') }}" id="state">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('state.index'))
                                <li class="nav-item">
                                    <a href="{{ route('states.index') }}" class="nav-link {{ active_class('admin/states') }}">All States</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('state.create'))
                                <li class="nav-item">
                                    <a href="{{ route('states.create') }}" class="nav-link {{ active_class('admin/states/create') }}">Add States</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            @if (Auth::user()->can('city.menu'))
                <li class="nav-item {{ active_class('admin/cities') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#cities" role="button"
                        aria-expanded="{{ is_active_route('admin/cities') }}" aria-controls="cities">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">City</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/cities') }}" id="cities">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('city.index'))
                                <li class="nav-item">
                                    <a href="{{ route('cities.index') }}" class="nav-link {{ active_class('admin/cities') }}">All City</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('city.create'))
                                <li class="nav-item">
                                    <a href="{{ route('cities.create') }}" class="nav-link {{ active_class('admin/cities/create') }}">Add City</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
             @if (Auth::user()->can('neighborhoodcities.menu'))
                <li class="nav-item {{ active_class('admin/neighborhoodcities') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#neighborhoodcities" role="button"
                        aria-expanded="{{ is_active_route('admin/neighborhoodcities') }}" aria-controls="neighborhoodcities">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Neighborhood City</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/neighborhoodcities') }}" id="neighborhoodcities">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('neighborhoodcities.index'))
                                <li class="nav-item">
                                    <a href="{{ route('neighborhoodcities.index') }}" class="nav-link {{ active_class('admin/neighborhoodcities') }}">All Neighborhood City</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('neighborhoodcities.create'))
                                <li class="nav-item">
                                    <a href="{{ route('neighborhoodcities.create') }}" class="nav-link {{ active_class('admin/neighborhoodcities/create') }}">Add Neighborhood City</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            @if (Auth::user()->can('site.menu'))
                <li class="nav-item">
                    <a href="{{ route('site.setting') }}" class="nav-link {{ active_class('admin/site/setting') }}">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Site Setting </span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->can('smtp.menu'))
                <li class="nav-item">
                    <a href="{{ route('smtp.setting') }}" class="nav-link {{ active_class('admin/smpt/setting') }}">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">SMTP Setting </span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->can('role.menu'))
                <li class="nav-item nav-category">Role & Permission</li>
                <li class="nav-item {{ active_class('admin/roles') }} {{ active_class('admin/permission') }} {{ active_class('admin/add/roles/permission') }} {{ active_class('admin/all/roles/permission') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button"
                        aria-expanded="{{ is_active_route('admin/roles') }} {{ is_active_route('admin/permission') }} {{ is_active_route('admin/add/roles/permission') }} {{ is_active_route('admin/all/roles/permission') }}" aria-controls="advancedUI">
                        <i class="link-icon" data-feather="anchor"></i>
                        <span class="link-title">Role & Permission</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/permission') }} {{ show_class('admin/roles') }} {{ show_class('admin/all/roles/permission') }} {{ show_class('admin/add/roles/permission') }}" id="advancedUI">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('permission.index'))
                                <li class="nav-item">
                                    <a href="{{ route('permission.index') }}" class="nav-link {{ active_class('admin/permission') }}">All Permission</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('role.index'))
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link {{ active_class('admin/roles') }}">All Roles </a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.roles.permission'))
                                <li class="nav-item">
                                    <a href="{{ route('add.roles.permission') }}" class="nav-link {{ active_class('admin/add/roles/permission') }}">Role in Permission
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->can('all.roles.permission'))
                                <li class="nav-item">
                                    <a href="{{ route('all.roles.permission') }}" class="nav-link {{ active_class('admin/all/roles/permission') }}">All Role in
                                        Permission
                                    </a>
                                </li>
                            @endif

                    </div>
                </li>
            @endif
            @if (Auth::user()->can('admin.menu'))
                <li class="nav-item {{ active_class('admin/all/admin') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#admin" role="button"
                        aria-expanded="{{ is_active_route('admin/all/admin') }}" aria-controls="admin">
                        <i class="link-icon" data-feather="anchor"></i>
                        <span class="link-title">Manage Admin User</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('admin/all/admin') }}" id="admin">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('all.admin'))
                                <li class="nav-item">
                                    <a href="{{ route('all.admin') }}" class="nav-link {{ active_class('admin/all/admin') }}">All Admin</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.admin'))
                                <li class="nav-item">
                                    <a href="{{ route('add.admin') }}" class="nav-link {{ active_class('admin/add/admin') }}">Add Admin </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif


        </ul>
    </div>
</nav>
