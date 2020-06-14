<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Active::checkRoute('dashboard')}}" href="{{route('dashboard')}}"><i class="fa fa-circle-notch"></i>Dashboard</a>
                    </li>

                    @if(Auth::user()->hasRole('Author') || Auth::user()->hasRole('Admin'))
                    <li class="nav-item">
                        <a class="nav-link {{ Active::checkRoute(['create.album','album.index','album.show','album.edit']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2"
                           aria-controls="submenu-2"><i class="fa fa-fw fa-images"></i>Albums</a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ Active::checkRoute('create.album')}}" href="{{route('create.album')}}"><i class="fa fa-plus"></i>
                                        New Album<span class="badge badge-secondary">New</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Active::checkRoute('album.index')}}" href="{{route('album.index')}}"><i class="fa fa-eye"></i>All Albums</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif

                    @if(Auth::user()->hasRole('Author') || Auth::user()->hasRole('Admin'))
                    <li class="nav-item">
                        <a class="nav-link {{ Active::checkRoute(['picture.add','picture.index','picture.show','picture.edit'])}}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3"
                           aria-controls="submenu-3"><i class="fa fa-fw fa-image"></i>Pictures</a>
                        <div id="submenu-3" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ Active::checkRoute('picture.add')}}" href="{{route('picture.add')}}"><i class="fa fa-plus"></i>
                                        New Photo<span class="badge badge-secondary">New</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Active::checkRoute('picture.index')}}" href="{{route('picture.index')}}"><i class="fa fa-eye"></i>All Pictures</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif

                    @if(Auth::user()->hasRole('Author') || Auth::user()->hasRole('Admin'))
                    <li class="nav-item">
                        <a class="nav-link {{ Active::checkRoute(['category.resources','category.index'])}}" href="{{route('category.index')}}"><i class="fa fa-list"></i>Categories</a>
                    </li>
                    @endif


                    @if(Auth::user()->hasRole('Author') || Auth::user()->hasRole('Admin'))
                    <li class="nav-item">
                        <a class="nav-link {{ Active::checkRoute(['testimony.add','testimony.index','testimony.edit','testimony.show']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4"
                           aria-controls="submenu-4"><i class="fa fa-fw fa-microphone"></i>Testimonies</a>
                        <div id="submenu-4" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ Active::checkRoute('testimony.add')}}" href="{{route('testimony.add')}}"><i class="fa fa-plus"></i>
                                        New Testimony<span class="badge badge-secondary">New</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Active::checkRoute('testimony.index')}}" href="{{route('testimony.index')}}"><i class="fa fa-eye"></i>All Testimonies</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif


                    @if(Auth::user()->hasRole('Admin'))
                    <li class="nav-item">
                        <a class="nav-link {{ Active::checkRoute(['banner.home.index','banner.index']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5"
                           aria-controls="submenu-5"><i class="fa fa-fw fa-flag"></i>Banners</a>
                        <div id="submenu-5" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ Active::checkRoute('banner.home.index')}}" href="{{route('banner.home.index')}}"><i class="fa fa-home"></i>Home Page Banner</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  {{ Active::checkRoute('banner.index')}}" href="{{route('banner.index')}}"><i class="fa fa-list"></i>Category Banner</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif

                    <li><a><hr style="color: white!important;"></a></li>

                    @if(Auth::user()->hasRole('Author') || Auth::user()->hasRole('Admin'))
                        <li class="nav-item">
                            <a class="nav-link {{ Active::checkRoute(['blog.categories','blog.categories.resources'])}}" href="{{route('blog.categories')}}"><i class="fa fa-list"></i>Blog Categories</a>
                        </li>
                    @endif

                    @if(Auth::user()->hasRole('Author') || Auth::user()->hasRole('Admin'))
                        <li class="nav-item">
                            <a class="nav-link {{ Active::checkRoute(['tags','tags.resources'])}}" href="{{route('tags')}}"><i class="fa fa-list"></i>Tags</a>
                        </li>
                    @endif

                    @if(Auth::user()->hasRole('Admin'))
                        <li class="nav-item">
                            <a class="nav-link {{ Active::checkRoute(['create.post','posts']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6"
                               aria-controls="submenu-6"><i class="fa fa-fw fa-pen-square"></i>Posts</a>
                            <div id="submenu-6" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link {{ Active::checkRoute('create.post')}}" href="{{route('create.post')}}"><i class="fa fa-pen"></i>New Post</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link  {{ Active::checkRoute('posts')}}" href="{{route('posts')}}"><i class="fa fa-list"></i>All Posts</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif


                    @if(Auth::user()->hasRole('Author') || Auth::user()->hasRole('Admin'))
                        <li class="nav-item">
                            <a class="nav-link {{ Active::checkRoute(['subscribers'])}}" href="{{route('subscribers')}}"><i class="fa fa-list"></i>Subscribers</a>
                        </li>
                    @endif

                    <li><a><hr style="color: white!important;"></a></li>

                    @if(Auth::user()->hasRole('Admin'))
                    <li class="nav-item">
                        <a class="nav-link {{ Active::checkRoute('show.users')}}" href="{{route('show.users')}}"><i class="fa fa-user"></i>Admins/Users</a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link {{ Active::checkRoute(['edit.profile','show.profile','edit.password'])}}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-7"
                           aria-controls="submenu-7"><i class="fa fa-fw fa-cog"></i>Settings</a>
                        <div id="submenu-7" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ Active::checkRoute('edit.profile')}}" href="{{route('edit.profile')}}"><i class="fa fa-edit"></i>Update Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Active::checkRoute('show.profile')}}" href="{{route('show.profile')}}"><i class="fa fa-eye"></i>Show Profile</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ Active::checkRoute('edit.password')}} " href="{{route('edit.password')}}"><i class="fa fa-wrench"></i>Reset Password</a>
                                </li>

                                <li class="nav-item" style="margin-bottom:60px!important;">
                                    <a class="nav-link" href="{{route('logout')}}"><i class="fa fa-lock"></i>Logout</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

    </div>
    </nav>
</div>