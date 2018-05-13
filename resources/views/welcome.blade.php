<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@lang('custom.title')</title>
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap -->
        {!! Html::style('css/bootstrap.css') !!}
        {!! Html::style('bower/font-awesome/css/font-awesome.min.css') !!}
        {!! Html::style('css/welcome.css') !!}
        {!! Html::style('css/nivo-lightbox.css') !!}
        {!! Html::style('css/default.css') !!}
        {!! Html::style('https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300') !!}

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>
    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
        <nav id="menu" class="navbar navbar-default navbar-fixed-top">
            <div class="container"> 
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">@lang('custom.toggle_nav')</span> @lang('custom.title')<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    {!! html_entity_decode(
                        Html::link(
                            '#page-top',
                            Lang::get('custom.title'),
                            [
                                'class' => 'navbar-brand page-scroll',
                            ]
                        )
                    ) !!}
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            {!! Html::link('#page-top', Lang::get('custom.welcome'), ['class' => 'page-scroll']) !!}
                        </li>
                        <li>
                            {!! Html::link('#about', Lang::get('custom.about'), ['class' => 'page-scroll']) !!}
                        </li>
                        <li>
                            {!! Html::link('#portfolio', Lang::get('custom.portfolio'), ['class' => 'page-scroll']) !!}
                        </li>
                        <li>
                            {!! Html::link('#contact', Lang::get('custom.contact'), ['class' => 'page-scroll']) !!}
                        </li>
                        @auth
                            <li>
                                {!! Html::linkRoute('home', Lang::get('custom.home')) !!}
                            </li>
                        @else
                            <li>
                                {!! Html::linkRoute('register', Lang::get('custom.signup')) !!}
                            </li>
                            <li>
                                {!! Html::linkRoute('login', Lang::get('custom.signin')) !!}
                            </li>
                        @endauth
                        <li>
                            {!! html_entity_decode(
                                Html::linkRoute(
                                    'change-language', 
                                    Html::image('images/en.png') . Lang::get('custom.en'), 
                                    [
                                        'lang' => 'en'
                                    ]
                                )
                            ) !!}
                        </li>
                        <li>
                            {!! html_entity_decode(
                                Html::linkRoute(
                                    'change-language', 
                                    Html::image('images/vi.png') . Lang::get('custom.vi'), 
                                    [
                                        'lang' => 'vi'
                                    ]
                                )
                            ) !!}
                        </li>

                    </ul>
                </div>
                <!-- /.navbar-collapse --> 
            </div>
            <!-- /.container-fluid --> 
        </nav>
    <!-- Header -->
    <header id="header">
      <div class="intro">
        <div class="container">
          <div class="row">
            <div class="intro-text">
              <h1>@lang('custom.title')</h1>
              <p>@lang('custom.hardware') • @lang('custom.wireless') • @lang('custom.software')</p>
              <a href="#about" class="btn btn-custom btn-lg page-scroll">@lang('custom.learn_more')</a> </div>
          </div>
        </div>
      </div>
    </header>
    <!-- About Section -->
    <div id="about">
      <div class="container">
        <div class="section-title text-center center">
          <h2>About Me</h2>
          <hr>
        </div>
        <div class="row">
          <div class="col-xs-12 col-md-6"> <img src="img/about.jpg" class="img-responsive" alt=""> </div>
          <div class="col-xs-12 col-md-6">
            <div class="about-text">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam. Sed commodo nibh ante facilisis bibendum dolor feugiat at. Duis sed dapibus leo nec ornare diam commodo nibh.</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam. Sed commodo nibh ante facilisis bibendum dolor feugiat at. Duis sed dapibus leo nec ornare.</p>
              <a href="#portfolio" class="btn btn-default btn-lg page-scroll">My Portfolio</a> </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Portfolio Section -->
    <div id="portfolio">
      <div class="container">
        <div class="section-title text-center center">
          <h2>Portfolio</h2>
          <hr>
        </div>
        <div class="categories">
          <ul class="cat">
            <li>
              <ol class="type">
                <li><a href="#" data-filter="*" class="active">All</a></li>
                <li><a href="#" data-filter=".web">Web Design</a></li>
                <li><a href="#" data-filter=".photography">Photography</a></li>
                <li><a href="#" data-filter=".product">Product Design</a></li>
              </ol>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="row">
          <div class="portfolio-items">
            <div class="col-sm-6 col-md-3 col-lg-3 web">
              <div class="portfolio-item">
                <div class="hover-bg"> <a href="img/portfolio/01-large.jpg" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Project Title</h4>
                  </div>
                  <img src="img/portfolio/01-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 product">
              <div class="portfolio-item">
                <div class="hover-bg"> <a href="img/portfolio/02-large.jpg" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Project Title</h4>
                  </div>
                  <img src="img/portfolio/02-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 web">
              <div class="portfolio-item">
                <div class="hover-bg"> <a href="img/portfolio/03-large.jpg" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Project Title</h4>
                  </div>
                  <img src="img/portfolio/03-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 web">
              <div class="portfolio-item">
                <div class="hover-bg"> <a href="img/portfolio/04-large.jpg" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Project Title</h4>
                  </div>
                  <img src="img/portfolio/04-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 product">
              <div class="portfolio-item">
                <div class="hover-bg"> <a href="img/portfolio/05-large.jpg" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Project Title</h4>
                  </div>
                  <img src="img/portfolio/05-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 photography">
              <div class="portfolio-item">
                <div class="hover-bg"> <a href="img/portfolio/06-large.jpg" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Project Title</h4>
                  </div>
                  <img src="img/portfolio/06-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 photography">
              <div class="portfolio-item">
                <div class="hover-bg"> <a href="img/portfolio/07-large.jpg" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Project Title</h4>
                  </div>
                  <img src="img/portfolio/07-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 web">
              <div class="portfolio-item">
                <div class="hover-bg"> <a href="img/portfolio/08-large.jpg" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Project Title</h4>
                  </div>
                  <img src="img/portfolio/08-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 product">
              <div class="portfolio-item">
                <div class="hover-bg"> <a href="img/portfolio/09-large.jpg" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Project Title</h4>
                  </div>
                  <img src="img/portfolio/09-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 photography">
              <div class="portfolio-item">
                <div class="hover-bg"> <a href="img/portfolio/10-large.jpg" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Project Title</h4>
                  </div>
                  <img src="img/portfolio/10-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 photography">
              <div class="portfolio-item">
                <div class="hover-bg"> <a href="img/portfolio/11-large.jpg" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Project Title</h4>
                  </div>
                  <img src="img/portfolio/11-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 web">
              <div class="portfolio-item">
                <div class="hover-bg"> <a href="img/portfolio/12-large.jpg" title="Project Title" data-lightbox-gallery="gallery1">
                  <div class="hover-text">
                    <h4>Project Title</h4>
                  </div>
                  <img src="img/portfolio/12-small.jpg" class="img-responsive" alt="Project Title"> </a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Contact Section -->
    <div id="contact" class="text-center">
      <div class="container">
        <div class="section-title center">
          <h2>Get In Touch</h2>
          <hr>
        </div>
        <div class="col-md-8 col-md-offset-2">
          <form name="sentMessage" id="contactForm" novalidate>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" id="name" class="form-control" placeholder="Name" required="required">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="email" id="email" class="form-control" placeholder="Email" required="required">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
            </div>
            <div class="form-group">
              <textarea name="message" id="message" class="form-control" rows="4" placeholder="Message" required></textarea>
              <p class="help-block text-danger"></p>
            </div>
            <div id="success"></div>
            <button type="submit" class="btn btn-default btn-lg">Send Message</button>
          </form>
          <div class="social">
            <ul>
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
              <li><a href="#"><i class="fa fa-behance"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div id="footer">
      <div class="container text-center">
        <div class="fnav">
          <p>Copyright &copy; 2016 Spectrum. Designed by <a href="http://www.templatewire.com" rel="nofollow">TemplateWire</a></p>
        </div>
      </div>
    </div>


    {!! Html::script('bower/jquery/dist/jquery.min.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
    {!! Html::script('bower/smooth-scroll/dist/js/smooth-scroll.min.js') !!}
    {!! Html::script('js/nivo-lightbox.js') !!}
    {!! Html::script('js/jqBootstrapValidation.js') !!}
    {!! Html::script('js/contact_me.js') !!}
    {!! Html::script('js/main.js') !!}
    </body>
</html>
