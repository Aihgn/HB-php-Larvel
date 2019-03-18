<!-- Navbar
		================================================= -->

   <nav id="menu-wrap" class="menu-back cbp-af-header">
		<div class="menu-top background-black">
			<div class="container">
				<div class="row">
					<div class="col-6 px-0 px-md-3 pl-1 py-3">
						<span class="call-top">call us:</span> 
						<a href="#" class="call-top">(+84) 888 888 888</a>
					</div>	
					<div class="col-6 px-0 px-md-3 py-3 text-right">
						@guest
							<a href="{{route('login')}}" class="account-top">log in</a>
							<a href="{{route('register')}}" class="account-top">register</a>
							<a href="{{route('guestbooking')}}" class="account-top">My bookings</a>
						@else					
							{{-- <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li> --}}
                            <div class="account-wrap">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
								<ul>
									<li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form></a></li>	
								</ul>
							</div>
                            
						@endguest		
					</div>				
				</div>	
			</div>		
		</div>
		<div class="menu">			
			<ul>
				<li><a class="curent-page" href="{{route('home')}}" >home</a></li>
				<li><a href="{{route('rooms')}}" >rooms</a></li>
				<li><a href="">gallery</a></li>				
				<li><a href="">Service</a></li>
				<li><a href="">contact</a></li>
				<li><a href="{{route('about')}}">about us</a></li>
				<li><a href=""><span>book now</span></a></li>
			</ul>
		</div>
	</nav>