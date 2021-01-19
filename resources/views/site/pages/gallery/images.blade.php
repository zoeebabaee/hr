@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('custom_css')
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }
    </style>
@endsection

@section('title')
    سامانه منابع انسانی :: گالری تصاویر
@endsection

@section('content')
    <div class="container cd-inner-content">
        <div class="col-12 no-padd">
            <fieldset class="red-fieldset mt-4 mb-4">
                <legend>گالری تصاویر</legend>
            </fieldset>
            <div class="top-innerpage" style="background:url('/site/default/img/banner_blog.png') no-repeat top center/cover;">
                <div class="container"><h1 class="wow animated fadeInUp"> گالری تصاویر </h1></div>
            </div>
            <div class="clearfix inner-content">
                <div class="wrap-content">
                        <div class="wb-grid wb-grid-stripe">
                            <div class="wb-center">
                                <div class="grid">
                                    <div id="js-filters-masonry-projects" class="cbp-l-filters-buttonCenter">
                                        <div data-filter="*" class="cbp-filter-item-active cbp-filter-item">
                                            آخرین تصاویر <div class="cbp-filter-counter"></div>
                                        </div>
                                        @foreach(\HR\GalleryCategory::all() as $cat)
                                        <div data-filter=".cat{{$cat->id}}" class="cbp-filter-item" style="display: none">
                                            {{$cat->name}}
                                            <div class="cbp-filter-counter" ></div>
                                        </div>
                                        @endforeach
    
                                    </div>
    
                                    <div id="js-grid-masonry-projects" class="cbp cbp-l-grid-masonry-projects">
                                        @foreach($images as $image)
                                            <div class="cbp-item cat{{$image->cat_id}}">
                                            <a class="cbp-caption cbp-lightbox" href="{{$image->img}}" data-title="{{$image->name}}">
                                                <div class="cbp-caption-defaultWrap">
                                                    <img data-main="{{$image->img}}" src="{{$image->l_img}}" alt="{{$image->name}}">
                                                </div>
                                            </a>
                                            <a href="{{$image->img}}" class=" cbp-lightbox cbp-l-grid-masonry-projects-title" rel="nofollow">{{$image->name}}</a>
                                            <p>{{strip_tags($image->body,'')}}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                    @if($remains_item)
                                    <div id="js-loadMore-masonry-projects" class="cbp-l-loadMore-button">
                                        <a onclick="ajax_load_more()" class="cbp-l-loadMore-link" rel="nofollow">
                                            <span class="cbp-l-loadMore-defaultText">موارد بیشتر (<span class="cbp-l-loadMore-loadItems" id="remain_items">{{$remains_item}}</span>)</span>
                                            <span class="cbp-l-loadMore-loadingText">موارد بیشتر ...</span>
                                            <span class="cbp-l-loadMore-noMoreLoading">موراد بیشتر</span>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
            <script>

                (function($, window, document, undefined) {
                    'use strict';

                    // init cubeportfolio
                    $('#js-grid-masonry-projects').cubeportfolio({
                        filters: '#js-filters-masonry-projects',
                        layoutMode: 'grid',
                        sortToPreventGaps: true,
                        defaultFilter: '*',
                        animationType: 'fadeOutTop',
                        gapHorizontal: 25,
                        gapVertical: 25,
                        gridAdjustment: 'responsive',
                        mediaQueries: [{
                            width: 1500,
                            cols: 5,
                        }, {
                            width: 1100,
                            cols: 4,
                        }, {
                            width: 800,
                            cols: 3,
                        }, {
                            width: 480,
                            cols: 2,
                            options: {
                                caption: '',
                                gapHorizontal: 10,
                                gapVertical: 10,
                            }
                        }],
                        caption: 'zoom',
                        displayType: 'fadeIn',
                        displayTypeSpeed: 100,


                        plugins: {
                            loadMore: {
                                element: '#js-loadMore-full-width',
                                action: 'auto',
                                loadItems: 8,
                            }
                        },
                    });
                })(jQuery, window, document);
                var ajax_current_page=1;
                function ajax_load_more(){
                    ajax_current_page++;
                    $.ajax({
                        method: "POST",
                        url: "{{route('site.pages.gallery.load.more')}}",
                        data: {page: ajax_current_page, _token: '{!!csrf_token()!!}'}
                    }).done(function (data) {
                        $("#js-grid-masonry-projects").cubeportfolio('append',data['data']);
                        $('#remain_items').html(data['remain'].toString());
                        if(data['remain'] == 0)
                            $('#js-loadMore-masonry-projects').remove();
                    });

                }

                $('cbp-filter-counter').on('change', function() {
                    alert( this.value );
                })
            </script>
@endsection