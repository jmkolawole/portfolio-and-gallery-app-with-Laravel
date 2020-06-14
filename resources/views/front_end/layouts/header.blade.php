<style>
    .search-wrap{
        position: relative;
        width:75%;
    }
    #searchIcon {
        font-size: 2em;
        position: absolute;
        top: 20%;
        left: 4%;
    }
    #searchIcon.hide{
        display:none;
    }
    #search {
        color: rgb(255, 0, 255);
        border: solid 3px rgb(247, 157, 210);
        border-radius: 10px;
        width: 0%;
        font-size: 2.2em;
        display: inline-block;
        margin-top: 0.25em;
        margin-left: 12.5%;
        outline: none;
        cursor: text;
        visibility: hidden;
        transition: 0.8s;
    }
    #search.visible{
        width:25%;
        visibility: visible;
    }
    #clear {
        width:5%;
        display: inline-block;
        position: absolute;
        top: 22px;
        opacity:0;
        transition:1.8s;
    }
    #clear.visible{
        opacity:1;
    }
    #clear:hover {
        cursor: pointer;
    }
</style>

<script>
    document.getElementById('searchIcon').onclick = function() {
        document.getElementById('search').classList.add("visible");
        document.getElementById('clear').classList.add("visible");
        document.getElementById('search').focus();
        document.getElementById('searchIcon').classList.add("hide");
    }
    document.getElementById('clear').onclick = function() {
        document.getElementById('searchIcon').classList.remove("hide");
        document.getElementById('search').classList.remove("visible");
        document.getElementById('clear').classList.remove("visible");
    }
</script>

<nav class="navbar center navbar-expand-lg">
    <div class="container flex-lg-column" style="">
        <div class="navbar-header">
            <div class="navbar-brand"><a href="{{route('home')}}"><img src="{{asset('front_end/images/logo3.png')}}"></a></div>
            <div class="navbar-hamburger ml-auto d-lg-none d-xl-none"><button class="hamburger animate" data-toggle="collapse" data-target=".navbar-collapse"><span></span></button></div>
        </div>

        <!-- /.navbar-header -->
        <div class="navbar-collapse collapse w-100 bg-light">
            <ul class="navbar-nav nav-fill w-100">
                <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Home</a></li>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#">Portfolio</a>
                    <ul class="dropdown-menu">

                        @foreach($categories as $category)
                        <li class="nav-item"><a class="dropdown-item" href="{{route('portfolio',$category->slug)}}">{{$category->name}}</a></li>
                            @endforeach

                    </ul>
                </li>

                <li class="nav-item dropdown"><a class="nav-link" href="{{route('gallery')}}">Gallery / Albums</a></li>

                <li class="nav-item dropdown nav-item"><a class="nav-link dropdown-toggle" href="{{route('blog')}}">Blog</a>
                    <ul class="dropdown-menu">

                        @foreach($blog_categories as $category)
                            <li class="nav-item"><a class="dropdown-item" href="{{route('categories.blog',$category->slug)}}">{{$category->name}}</a></li>
                        @endforeach

                    </ul>
                </li>


                <li class="nav-item dropdown"><a class="nav-link" href="{{route('about')}}">About</a></li>

                <li class="nav-item dropdown"><a class="nav-link" href="{{route('contact')}}">Contact</a></li>
            </ul>
        </div>

    </div>
</nav>

