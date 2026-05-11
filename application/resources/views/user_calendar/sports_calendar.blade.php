<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Official Website of Department of Sports, Uttar Pradesh, India</title>




  <link href="{{ asset('../../css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('../../css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('../../css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('../../css/responsive.css') }}" rel="stylesheet">
  <link href="{{ asset('../../fonts/font.css') }}" rel="stylesheet">
  <link href="{{ asset('../../css/animation.css') }}" rel="stylesheet">
  <link href="{{ asset('../../css/hover.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" rel="stylesheet">

  <style>
    .table th h2 {
      border-bottom: 0px dashed #fff;
      display: block;
      padding-bottom: 10px;
      color: #99134d !important;
      position: relative;
      margin-bottom: 0;
      margin-top: 0;
      font-family: "Roboto Condensed", sans-serif;
      font-weight: 600;
      background: #fff;
    }

    .table th h2::before {
      height: 4px;
      width: 10%;
      content: '';
      position: absolute;
      background-color: #ffcb67;
      bottom: -2px;
      left: 0;
      right: 0;
    }
  </style>

</head>

<body>

  <section class="banner-section">
    <header>
      <div class="container">
        <div class="row">
          <div class="col-md-5 col-9">
            <div class="logo">
              <div class="logoname">
                <h4 class="eng-name">Khel Sathi Portal</h4>
                <p class="eng-name1">Department of Sports</p>
                <p class="eng-line">Government of Uttar Pradesh</p>
              </div>
            </div>
          </div>
          <div class="col-md-7 col-3" style="position: relative;">
            <div class="banner_line1">
              <div class="banner_line1_1"><img src="{{ asset('../../images/dot.png') }}" /></div>
              <div class="banner_line1_2"></div>
              <div class="banner_line1_3"></div>
              <div class="banner_line1_4"></div>
              <div class="banner_line1_5"></div>
            </div>
            <div class="uplogo"><img src="{{ asset('../../images/foot-logo.png') }}" /></div>
          </div>
        </div>
      </div>
    </header>
  </section>
  <section class="inner_title text-center">
    <div class="container">
      <h1>Sports Calendar</h1>
    </div>
  </section>
  <section class="inner_data">
    <div class="container">
      @forelse($sports_calendar as $key=>$post)


      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover ">
          <thead>

            <tr style="
    border: 0;
">
              <th width="90px" colspan="4" class="p-0" style="
    border: 0;
">
                <h2 style="font-size: 1.2rem;">{{$post->header_name}}</h2>
              </th>

            </tr>
            <tr>
              <th colspan="4" style="
    background: #fff;
    height: 6px;
    border: 0;
    padding: 0;
    line-height: 0;
">&nbsp;</th>

            </tr>
            <tr>
              <th width="90px">Sr. No.</th>
              <th>Subject</th>
              <th style="width: 20%; text-align: center;">Uploaded Date</th>
              <th style="width: 20%; text-align: center;">File</th>
            </tr>
          </thead>
          <tbody>

            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $post->subject_name }}</td>
              <td style="width: 20%; text-align: center;">{{ dmy($post->created_at)}}</td>
              <td style="width: 20%; text-align: center;">
                <?php if ($post->type == 1) { ?>
                  <a target="_blank" href="{{ asset('calendar_management/media_data/'.$post->media_data) }}" class="btn btn-outline-primary btn-sm none external" title="Click here To Download" rel="noopener">Click here To Download</a>
                <?php } else if ($post->type == 2) { 
                  $media_url = $post->media_data;
                  if (strpos($media_url, 'khelsathi.in/pdf/') !== false) {
                      $file_name = basename($media_url);
                      $media_url = asset('../../pdf/'.$file_name);
                  }
                ?>
                  <a target="_blank" href="{{$media_url}}" class="btn btn-outline-primary btn-sm none external" title="Click here To View / Download" rel="noopener">Click here To View </a>
                <?php } ?>


              </td>
            </tr>
            @empty
            <p style="text-align:center" class="alert  alert-danger"><strong>No data available</strong></p>
            @endforelse


          </tbody>
        </table>
      </div>

    </div>
  </section>
  <section class="important">
    <div class="container">
      <div class="important-link">
        <ul class="">
          <li><img class="img-fluid" src="{{ asset('../../images/player1.png') }}" alt=""></li>
          <li><img class="img-fluid" src="{{ asset('../../images/player2.png') }}" alt=""></li>
          <li><img class="img-fluid" src="{{ asset('../../images/player3.png') }}" alt=""></li>
          <li><img class="img-fluid" src="{{ asset('../../images/player4.png') }}" alt=""></li>
          <li><img class="img-fluid" src="{{ asset('../../images/player5.png') }}" alt=""></li>
          <li><img class="img-fluid" src="{{ asset('../../images/player6.png') }}" alt=""></li>
          <li><img class="img-fluid" src="{{ asset('../../images/player7.png') }}" alt=""></li>
          <li><img class="img-fluid" src="{{ asset('../../images/player8.png') }}" alt=""></li>
          <li><img class="img-fluid" src="{{ asset('../../images/player9.png') }}" alt=""></li>
          <li><img class="img-fluid" src="{{ asset('../../images/player10.png') }}" alt=""></li>
        </ul>
      </div>
      <div class="khelo_india">
        <div class="card">
          <div class="row">
            <div class="col-md-3">
              <div class="khelo_img"><img src="{{ asset('../../images/khelo_india.png') }}" /></div>
            </div>
            <div class="col-md-8">
              <h2>National Programme For <span>Development Of Sports</span></h2>
              <p>The importance of sports and fitness in one’s life is invaluable. Playing sports inculcates team spirit, develops strategic & analytical thinking, leadership skills, goal setting and risk taking. A fit and healthy individual leads to an equally healthy society and strong nation.</p>
            </div>
            <div class="col-md-1">
              <div class="c1"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <p class="copyright"> This is the official Web Portal of Department of Sports, Government of Uttar Pradesh.<br>
            Content on this Web Portal is published and managed by Department of Sports, Government of Uttar Pradesh.

            <!--Khel Sathi is the official Portal of Department of Sports, Government of Uttar Pradesh.-->
          </p>
        </div>
        <div class="col-md-3">
          <!-- <p class="text-end text-white">Powered by <a href="http://www.otpl.co.in/" target="_blank"><span style="
	  color: #FF7575;
	  font-weight: bold;
	  font-style: italic;
  ">Omni</span> <span style="
	  color: #8694FF;
	  font-weight: bold;
  ">Net </span></a> </p> -->
          <ul class="social_icons">
            <li><a href="https://www.facebook.com/" class="external facebook"> <i class="fa fa-facebook"></i></a></li>
            <li><a href="https://twitter.com/" class="external twitter"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/" class="external instagram"><i class="fa fa-instagram"></i></a></li>
            <!--<li><a href="#"><i class="fa fa-linkedin"></i></a></li>-->
          </ul>
          <p class="Visitors">Visitors : <img class="statcounter" src="https://c.statcounter.com/12898415/0/201dc078/0/" alt="Web Analytics" referrerPolicy="no-referrer-when-downgrade"></p>
        </div>
      </div>
    </div>
  </footer>
  <script src="{{ asset('../../js/jquery.js') }}"></script>
  <script src="{{ asset('../../js/bootstrap.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
</body>

</html>
