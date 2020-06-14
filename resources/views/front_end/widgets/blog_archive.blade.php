<style>
    @media only screen and (min-width: 768px) {

        .album-archive{
            text-align: right!important;
        }
        .album-widget{
            margin-top: 16px!important;

        }

    }
</style>
<div class="accordion">
    <div class="archive aside-widget">
        <div class="section-title">

        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 mt-60">
                <h3 class="widget-title">Blog Archives</h3>
                <div class="archive aside-widget">
                    @foreach($post_archive as $year => $months)
                        <div>
                            <div id="heading_{{ $loop->index }}">
                                <h6 class="mb-0">
                                    <a class="btn py-0 my-0" data-toggle="collapse"
                                       data-target="#collapse_{{ $loop->index }}"
                                       aria-expanded="true"
                                       aria-controls="collapse_{{ $loop->index }}">
                                        <span style="color: white!important;"> ></span>
                                    </a>
                                    {{ $year }}
                                </h6>
                            </div>

                            <div id="collapse_{{ $loop->index }}" class="collapse" aria-labelledby="heading_{{ $loop->index }}"
                                 data-parent="#accordion">
                                <div>
                                    <ul style="list-style-type: none;">
                                        @foreach($months as $month => $posts)
                                            <li class="">
                                                <a class="link" href="{{route('post.archives',[$month,$year])}}">{{ $month }} ( {{ count($posts) }} )</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>



            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 album-archive">

                <div id="accordion">

                </div>
            </div>
        </div>
    </div>
</div>

