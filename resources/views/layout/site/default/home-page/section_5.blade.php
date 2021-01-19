<div class="section" id="section5" style="background: url(/site/default/img/bg-news.jpg) no-repeat top center/cover;">
    <div class="container wrapper-events">
        <h2 class="wow animated fadeInUp">آخرین خبرها ، پست ها و مقالات</h2>
        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#blogs" aria-controls="profile" role="tab" data-toggle="tab">وبلاگ</a></li>
                <li role="presentation"><a href="#news" aria-controls="news" role="tab" data-toggle="tab">اخبار</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="blogs">
                    @include('site.modules.lastblog')
                    <div class="col-xs-12">
                        <a class="more-home" href="{{route('site.blog.index')}}">
                        مشاهده موارد بیشتر
                        <i class="fa fa-angle-left"></i>
                        </a>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="news">
                    @include('site.modules.lastnews')
                    <div class="col-xs-12">
                        <a class="more-home" href="{{route('site.news.index')}}">
                        مشاهده موارد بیشتر
                        <i class="fa fa-angle-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>