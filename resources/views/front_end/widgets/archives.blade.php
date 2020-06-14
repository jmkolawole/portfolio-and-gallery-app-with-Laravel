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
        <h4 class="section-title section-head text-center" style="text-align: center!important;">Archives</h4>
    </div>
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <h6>PICTURES</h6>
                    <div class="archive aside-widget">
                    @foreach($picture_archive as $year => $months)
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
                                                <a class="link" href="{{route('picture.archives',[$month,$year])}}">{{ $month }} ( {{ count($posts) }} )</a>
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
                    <h6>ALBUMS</h6>
                    <div id="accordion">
                        <div class="archive aside-widget album-widget">
                            @foreach($album_archive as $year => $months)
                                <div>
                                    <div id="heading_{{ $loop->index }}">
                                        <h6 class="mb-0">
                                            <a class="btn py-0 my- btn-danger" data-toggle="collapse"
                                               data-target="#collapsed_{{ $loop->index }}"
                                               aria-expanded="true"
                                               aria-controls="collapsed_{{ $loop->index }}" style="background-color: darkred!important;">
                                                <span style="color: white!important;"> ></span>
                                            </a>
                                            <span style="position: relative;top: -4px;">{{ $year }}</span>
                                        </h6>
                                    </div>

                                    <div id="collapsed_{{ $loop->index }}" class="collapse" aria-labelledby="heading_{{ $loop->index }}"
                                         data-parent="#accordion">
                                        <div>
                                            <ul style="list-style-type: none;">
                                                @foreach($months as $month => $posts)
                                                    <li class="">
                                                        <a class="link" href="{{route('album.archives',[$month,$year])}}">{{ $month }} ( {{ count($posts) }} )</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
