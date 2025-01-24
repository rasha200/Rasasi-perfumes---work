<header class="header style7">
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-left">
                <div class="header-message">

                    Welcome to our online store!
                </div>

            </div>
            <div class="top-bar-right">
               

                <div class="header-language">
                    <div class="stelina-language stelina-dropdown">
                        <a href="#" class="active language-toggle" data-stelina="stelina-dropdown">
									<span>
										 (JOD)
									</span>
                        </a>
                        <ul class="stelina-submenu">
                            <li class="switcher-option">
                                <a href="#">
											<span>
												 (JOD)
											</span>
                                </a>
                            </li>
                            <li class="switcher-option">
                                <a href="#">
											<span>
                                                (USD)
											</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                @guest
                @if (Route::has('login'))
                <div class="header-language" style="padding-left: 20px;">
                    <div class="stelina-language">
                        <a href="{{ route('login') }}" class="active language-toggle" data-stelina="stelina-dropdown">
									<span>
										Login
									</span>
                        </a>
                        
                    </div>
                </div>
                @endif

                @if (Route::has('register'))
                <ul class="header-user-links">
                    <li>
                        <a href="{{ route('register') }}">Sign up</a>
                    </li>
                </ul>
                @endif

                @else
               
                <div class="header-language" style="padding-left: 20px;">
                    <div class="stelina-language">
                        <a href="#" class="active language-toggle" data-stelina="stelina-dropdown">
									<span>
										Hi,{{ Auth::user()->Fname }}  {{ Auth::user()->Lname }}
									</span>
                        </a>
                        
                    </div>
                </div>

               



                @if (Auth::user()->role == 'manager' )
                <div class="header-language" style="padding-left: 20px;">
                    <div class="stelina-language">
                        <a href="{{ route('dashboard') }}" class="active language-toggle" data-stelina="stelina-dropdown">
									<span>
										Dashboard
									</span>
                        </a>
                        
                    </div>
                </div>
                @endif

                @if ( Auth::user()->role == 'employee' )
                <div class="header-language" style="padding-left: 20px;">
                    <div class="stelina-language">
                        <a href="{{route('categories.index')}}" class="active language-toggle" data-stelina="stelina-dropdown">
									<span>
										Dashboard
									</span>
                        </a>
                        
                    </div>
                </div>
                @endif



               
                <ul class="header-user-links">
                    <li>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                           {{ __('Logout') }}
                       </a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form> 

                    @endguest
                    </li>
                </ul>

               

            </div>
        </div>
    </div>
    <div class="container">
        <div class="main-header">
            <div class="row">
                <div class="col-lg-3 col-sm-4 col-md-3 col-xs-7 col-ts-12 header-element">
                    <a href="{{ route('home') }}" class="logo">

                            <img src="{{asset("assets/img/logoo.jpg")}}" alt="img" style="width:150px;">

                    </a>
                </div>
                <div class="col-lg-7 col-sm-8 col-md-6 col-xs-5 col-ts-12">
                  
                    @php
                    $cartItems = json_decode(Cookie::get('cart', json_encode([])), true);
                    $cartCount = array_reduce($cartItems, function ($carry, $item) {
                        return $carry + $item['quantity'];
                    }, 0);
                    @endphp
                </div>
                <div class="col-lg-2 col-sm-12 col-md-3 col-xs-12 col-ts-12">
                    <div class="header-control">
                        <div class="block-minicart stelina-mini-cart block-header stelina-dropdown">
                            <a href="javascript:void(0);" class="shopcart-icon" data-stelina="stelina-dropdown">
                                Cart
                                <span class="count">
                                    {{ $cartCount }}
										</span>
                            </a>


                        <!-- include side bar start -->
                         @include("include/user_side/cart")
                        <!-- include side bar end -->


                        </div>

                        @guest

                        <div></div>

                        @else
                      
                        
                        <div class="block-account block-header stelina-dropdown">
                            <a href="{{ route('profile') }}">
                                <span class="flaticon-user"></span>
                            </a>
                        </div>
                       

                        @endguest
                        
                      
                        <a class="menu-bar mobile-navigation menu-toggle" href="#">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-nav-container rows-space-20">
        <div class="container">
            <div class="header-nav-wapper main-menu-wapper">
                <div class="vertical-wapper block-nav-categori">
                    <div class="block-title">
							<span class="icon-bar">
								<span></span>
								<span></span>
								<span></span>
							</span>
                        <span class="text">All Categories</span>
                    </div>

                </div>
                <div class="header-nav">
                    <div class="container-wapper">
                        <ul class="stelina-clone-mobile-menu stelina-nav main-menu " id="menu-main-menu">
                            <li class="menu-item  menu-item">
                                <a href="{{ route('home') }}" class="stelina-menu-item-title" title="Home">Home</a>
                                <span class="toggle-submenu"></span>

                            </li>
                            @foreach($categories as $category)
                            <li class="menu-item menu-item-has-children item-megamenu" onmouseover="showSubcategories({{ $category->id }})" onmouseout="hideSubcategories({{ $category->id }})">
                                <a href="{{ route('products.byCategory', $category->id) }}" class="stelina-menu-item-title">{{ $category->name }}</a>
                                <span class="toggle-submenu"></span>
                                <ul id="subcategory-{{ $category->id }}" class="submenu">
                                    @foreach($category->subcategories->chunk(5) as $subcategoryChunk) {{-- Group subcategories in batches of 5 --}}
                                        <li class="menu-item-group"> {{-- Container for each group of subcategories --}}
                                            @foreach($subcategoryChunk as $subcategory)
                                                <li class="menu-item">
                                                    <a href="{{ route('products.bySubCategory', $subcategory->id) }}">{{ $subcategory->name }}</a>
                                                </li>
                                            @endforeach
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                                <script>
                                function showSubcategories(categoryId) {
                                    document.getElementById(`subcategory-${categoryId}`).style.display = 'block';
                                }

                                function hideSubcategories(categoryId) {
                                    document.getElementById(`subcategory-${categoryId}`).style.display = 'none';
                                }

                                 </script>


                                <style>

                                .submenu {
                                    display: none;
                                    opacity: 0;
                                    transition: opacity 0.3s ease-in-out;
                                }

                                .submenu.show {
                                    display: block;
                                    opacity: 1;
                                }

                                </style>
                            <li class="menu-item">
                                <a href="{{ route('contact.landing') }}" class="stelina-menu-item-title" title="About">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
