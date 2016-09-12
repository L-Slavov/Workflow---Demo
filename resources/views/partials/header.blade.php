<nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                  
                   <img src="{{ URL::to('/') }}/images/logo.png" alt="beOnline-logo" style="margin-top: -7px" />
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if (!Auth::guest())
                <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ url('/') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Заявки</a>
                        </li> 
                   @can("create_user")
                        <li>
                            <a href="{{ url('/register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Създай потребител</a>
                        </li> 
                    @endcan
                    @can('edit_user')
                        <li>
                            <a href="{{ url('/userlist') }}"><i class="glyphicon glyphicon-pencil"></i> Промени потребител</a>
                        </li>
                    @endcan
                    @can("create_inquiry")
                         <li>
                            <a href="{{ url('/inquiries') }}"><i class="fa fa-envelope" aria-hidden="true">
                            </i> Справки</a></li>
                         <li>
                            <a href="{{ url('/archive') }}"><i class="fa fa-archive" aria-hidden="true"></i>
                          Ахив</a></li>
                         <li>
                            <a href="{{ url('/createpartner') }}"><i class="fa fa-plus" aria-hidden="true"></i>

                          Добави партьор</a></li>


                    @endcan


                </ul>
                @endif

                <!-- Right Side Of Navbar -->

                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Вход</a></li>

                        
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->first_name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Изход</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>