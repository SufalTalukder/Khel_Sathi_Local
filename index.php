<style>
  .dList div {
    display: block !important;
  }
</style>
<?php


if (file_exists("connection.php")) {
  include("connection.php");
}


// $sql = "SELECT * FROM cities";
// $result = $conn->query($sql);
// $row = $result->fetch_assoc();
// echo "<pre>"; print_r($row); exit;


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
  <link href="fonts/font.css" rel="stylesheet">
  <link href="css/animation.css" rel="stylesheet">
  <link href="css/hover.css" rel="stylesheet">
  <link href="css/map.css" rel="stylesheet">
  <link href="css/owl.carousel.css" rel="stylesheet">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="js/animate.min.css">
  <link href="css/animate.css" rel="stylesheet">
  <script src="js/modernizr-custom.js"></script>
  <!-- Default Statcounter code for Kehl Sathi Portal
         -->
  <script type="text/javascript">
    var sc_project = 12898415;
    var sc_invisible = 0;
    var sc_security = "201dc078";
    var scJsHost = "https://";
    document.write("<sc" + "ript type='text/javascript' src='" +
      scJsHost +
      "statcounter.com/counter/counter.js'></" + "script>");
  </script>
  <style>
    .footer-links {
      color: #ffcc02;
      margin: 0px 0px 10px 0px;
      padding: 0px 0px 0px 0px;
      border-bottom: 0px solid #fff;
      font-weight: 600;
    }

    .footer-links a {
      color: #ffcc02;
    }

    .logo-2 {
      padding-right: 0px;
    }

    .logo-2 img {
      max-width: 80%;
    }
  </style>
</head>

<body>
  <section class="banner-section">
    <header>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-5 col-9">
            <div class="logo">
              <div class="logo-2"><img src="images/foot-logo.png"> </div>
              <div class="logoname">
                <h4 class="eng-name">Khel Sathi Portal</h4>
                <p class="eng-name1">Department of Sports</p>
                <p class="eng-line">Government of Uttar Pradesh</p>
              </div>
            </div>
          </div>
          <div class="col-md-7 col-3" style="position: relative;">
            <div class="banner_line1">
              <div class="banner_line1_1"><img src="images/dot.png" /></div>
              <div class="banner_line1_2"></div>
              <div class="banner_line1_3"></div>
              <div class="banner_line1_4"></div>
              <div class="banner_line1_4"></div>
            </div>
            <div class="uplogo"><img style="max-width: 114px;" src="images/H_202408231636066070.jpg" /></div>
          </div>
        </div>
      </div>
    </header>
    <div class="banner-2">
      <div class="banner_line2">
        <div class="banner_line2_1"></div>
        <div class="banner_line2_2"></div>
        <div class="banner_line2_3"></div>
        <div class="banner_line2_4"></div>
        <div class="banner_line2_5"></div>
        <div class="banner_line2_6"></div>
        <div class="banner_line2_7"></div>
      </div>
      <div class="banner_line3"></div>
      <img src="images/banner_18.png" />
    </div>
    <div class="banner">
      <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
            aria-label="Slide 4"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"
            aria-label="Slide 5"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5"
            aria-label="Slide 6"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="7"
            aria-label="Slide 7"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active"><img src="images/banner-3.jpg" class="d-block w-100" alt="..."></div>
          <div class="carousel-item"><img src="images/banner-1-khel.jpg" class="d-block w-100" alt="..."></div>
          <div class="carousel-item"><img src="images/banner-2-khel.jpg" class="d-block w-100" alt="..."></div>
          <div class="carousel-item"><img src="images/banner-3-khel.jpg" class="d-block w-100" alt="..."></div>
          <div class="carousel-item"><img src="images/banner-4-khel.jpg" class="d-block w-100" alt="..."></div>
          <div class="carousel-item"><img src="images/banner-5-khel-1.jpg" class="d-block w-100" alt="..."></div>
          <div class="carousel-item"><img src="images/banner-2-khel.jpg" class="d-block w-100" alt="..."></div>
        </div>
      </div>
    </div>
    <div class="banner_news">
      <ul>
        <li> Inauguration of Sardar Patel National Disabled T-20 Cup at Bharat Ratna Shri Atal Bihari Vajpayee Ekana
          Cricket Stadium by Honourable Chief Minister, Yogi Adityanath Ji </li>
      </ul>
    </div>
  </section>
  <!-- <br>
<div class="container">
  <div class="row">
    <div class="news-head" style="text-align: center;">
      <div class="col-md-12">
        <marquee behavior="scroll">
      
      <a href="https://upsports.gov.in/site/writereaddata/UploadNews/pdf/C_202509101517411744.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>Notice for Invitation for Applications – Laxman Award / Rani Laxmi Bai Award for the Year 2024-25</strong> </a> &nbsp;|&nbsp; 
      
      <a href="https://upsports.gov.in/site/writereaddata/UploadNews/pdf/C_202508052323354426.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>First College Allotment Order 2025-26</strong> </a> &nbsp;|&nbsp; 
      
      <a href="https://upsports.gov.in/site/writereaddata/UploadNews/pdf/C_202507091325561091.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>Notification Regarding Issuance of Admission Letters for Selected Players in Residential Sports Hostels 2025-26</strong> </a> &nbsp;|&nbsp; 
      
      <a href="https://upsports.gov.in/site/writereaddata/UploadNews/pdf/C_202506251822410050.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>Sports College Lucknow: Age Verification Report Notice for Selected Players (Class 6 & 7, Session 2025-26)</strong> </a> &nbsp;|&nbsp; 
    
      <a href="pdf/pre-Trial-2025-26-result-all-games_040625.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>Pre Trial Result 2025-26 Sports College Admission</strong> </a> &nbsp;|&nbsp; 
      
      <a href="pdf/Final-Trial-2025-26-all-games_040625.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>Final Trial Result 2025-26 </strong> </a> &nbsp;|&nbsp; 
      
      
      
      
      <a href="https://upsports.gov.in/site/writereaddata/UploadNews/pdf/C_202505051657132602.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>Notification Regarding Revised List of Pre Trial Result (2025-26) for Volleyball</strong> </a> &nbsp;|&nbsp; 	
      
    <a href="https://upsports.gov.in/site/writereaddata/UploadNews/pdf/C_202505011323534033.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>Notification Regarding Pre Trial Result (2025-26)</strong> </a> &nbsp;|&nbsp; 	
      
      
      
      
      
      
        <a href="https://upsports.gov.in/site/writereaddata/UploadNews/pdf/C_202503221123510959.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>Information regarding Admission to Sports Colleges for Classes 6, 7, 8, and 9 in Session 2025-26</strong> </a> &nbsp;|&nbsp; <a href="pdf/notice_270125.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>Notice regarding the Hostel Admission Application 2025-26</strong> </a> &nbsp;|&nbsp; <a href="pdf/img20241122_13591883.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>Regarding applications for the appointment of International-level players/coaches for training in hostels</strong> </a> &nbsp;|&nbsp; <a href="pdf/Khel-Niti.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>Notice Regarding Sports Policy </strong> </a> &nbsp;|&nbsp; <a href="https://upsports.gov.in/site/writereaddata/UploadNews/pdf/C_202409231559324871.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>Notice for the Direct Recruitment Application 2024-25</strong> </a> &nbsp;|&nbsp; <a href="pdf/award_210924.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>Regarding Laxman/Rani Laxmibai Award 2023-24.</strong> </a> &nbsp;|&nbsp; <a href="https://upsports.gov.in/site/writereaddata/UploadNews/pdf/C_202408081737467010.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>एकलव्य  क्रीड़ा  कोष नियमावली - २०२१ के अधीन आवेदन करने हेतु आवश्यक बिंदु |</strong> </a> &nbsp;|&nbsp; 
        
        <a href="pdf/img20240719_17013493.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>छात्रावास प्रवेश हेतु चयनित आवेदकों की द्वितीय सूची के संबंध में कार्यालय आदेश।</strong> </a>
    &nbsp;|&nbsp;
      <a href="pdf/C_202406141749461046.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>छात्रावास प्रवेश 2024-2025 के लिए शॉर्टलिस्ट किए गए आवेदकों के लिए सम्बंधित सूचना </strong> </a>>
        
        </marquee>
        
        <marquee behavior="alternate"><a href="https://upsports.gov.in/site/writereaddata/UploadNews/pdf/C_202403211814369541.pdf" target="_blank" rel="noopener" class="external">&nbsp;<strong>स्पोर्ट्स कॉलेज प्रारम्भिक चयन परीक्षा 2024-25 परिणाम सम्बन्धी सूचना </strong> </a></marquee>> 
      </div>
    </div>
  </div>
</div> -->
  <div class="main">
    <section class="process_area mb-120 mobile-res-mb">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-12 col-12">
            <div class="leader shoot_card align-middle">
              <ul>
                <li>
                  <div class="pmmodi"> <img src="images/Yogi-Adityanath.jpg" alt="Hon’ble Chief Minister"
                      title="Hon’ble Chief Minister" /> </div>
                  <h4>Yogi Adityanath</h4>
                  <p>Hon’ble Chief Minister, UP</p>
                </li>
                <li>
                  <div class="pmmodi"><img src="images/Shri-Girish-Chandra-Yadav.jpg" alt="Shri Girish Chandra Yadav"
                      title="Shri Girish Chandra Yadav" /> </div>
                  <h4>Shri Girish Chandra Yadav</h4>
                  <p>Minister of State, <br>
                    Department of Sports & Youth Welfare,
                    UP </p>
                </li>
                <!-- <li>
                <div class="pmmodi"><img src="https://upsports.gov.in/site/writereaddata/UploadedPressRelease/pdf/C_202501151310148022.jpg"  alt="Shri Manish Chauhan" title="Shri Manish Chauhan" /> </div>
                <h4>Shri Manish Chauhan</h4>
                <p>Principal Secretary, <br>
                  Sports Department, UP</p>
              </li>-->
                <li>
                  <div class="pmmodi"><img src="images/Suhas.jpg" alt="Shri Suhas L.Y., IAS"
                      title="Shri Suhas L.Y., IAS" /> </div>
                  <h4>Shri Suhas L.Y., IAS</h4>
                  <p>Secretary, <br>
                    Sports Department, UP</p>
                </li>
                <li>
                  <div class="pmmodi"><img src="images/Singh.jpg" alt="Dr R P Singh, Director"
                      title="Dr R P Singh, Director" /> </div>
                  <h4>Dr. R P Singh </h4>
                  <p>Director, <br>
                    Sports Directorate, Lucknow, UP</p>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-8 col-sm-12 col-12">
            <div class="title" style="display: flow-root;">
              <h2 class="float-start">Online Services</h2>
              <div class="dropdown float-end">
                <!-- <a href="schemes-criteria.html" target="_blank" class="dropbtn wow hvr-float-shadow animate__fadeIn" style="margin-right:10px">Schemes Criteria</a> -->
                <a href="application/public/admin/login" target="_blank"
                  class="dropbtn wow hvr-float-shadow animate__fadeIn" style="margin-right:10px">Dept. Login </a>
                <a href="associaton_list.html" target="_blank" class="dropbtn wow hvr-float-shadow animate__fadeIn"
                  style="margin-right:10px">Sports Associatons List</a>
                <button onclick="myFunction()" class="dropbtn wow hvr-float-shadow animate__fadeIn"
                  data-animation="fadeInUp" data-delay="1s" data-wow-duration="1s"><i class="fa fa-university"></i> List
                  of Sports Colleges <i class="fa fa-angle-down"></i> </button>
                <div id="myDropdown" class="dropdown-content">
                  <a target="_blank" href="https://upsports.gov.in/sportscollege">Guru Gobind Singh Sports College,
                    Lucknow</a>
                  <a target="_blank" href="Bir_Bahadur_Singh_Sports_College.html">Veer Bahadur Singh Sports College,
                    Gorakhpur</a> <a target="_blank" href="Major_Dhyan_Chand_Sports_College.html">Major Dhyanchand
                    Sports College, Saifai</a>
                </div>
              </div>
            </div>
            <ul class="Services">
              <li class="text-center">
                <!--a href="" data-bs-toggle="modal" data-bs-target="#Player"-->
                <a href="application/public/" target="_blank">

                  <div class="process_card wow hvr-float-shadow animate__fadeIn" data-animation="fadeInUp"
                    data-delay="1s" data-wow-duration="1s">
                    <div class="process_icon"> <img src="images/player.png" alt="Player Registration"
                        title="Player Registration" /> </div>
                    <div class="process_content">
                      <h4>Player Registration</h4>
                      <p>For Financial Aid, Direct Recruitment, and Awards.</p>
                    </div>
                  </div>
                </a>
              </li>
              <li class="text-center">
                <a href="application/public/facility_booking/login" target="_blank">


                  <div class="process_card wow hvr-float-shadow animate__fadeIn box" data-animation="fadeInUp"
                    data-delay="1s" data-wow-duration="1s">
                    <div class="process_icon process_icon_4">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="56px"
                        height="56px">
                        <image x="0px" y="0px" width="45px" height="45px"
                          xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAADgAAAA4CAMAAACfWMssAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAACslBMVEWMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwOMhwP///88rIinAAAA5HRSTlMAAUi37fHz7uGWH1fl9/D1uiUz2vimWDo5MGzyvSGJ+YgFO+r72MEVQ++TthuE/mUdsRp1dibErBl4LKsty6gXCh4cB0TSpBOPxsLDjBZA7Hw00ZwRPfwp26o21psSFIG5tLN5C1/KDgbnKhgESd79jXvNx+b0WnC1fry7uNcuCA8QDZXpQY7IxYJFgyIgyeg+U79KCUytz2iFqUZSI3r6bigDP3NQmeNRf69UNd/QmkeXDDJ9S3HUlFwngFkC4l2HPOvAvlVOdGBpW7BmK0L2Y86eoGfTzJ/gVmp35KKGkt1h3JEH8tCxAAAAAWJLR0TlWGULvwAAAAd0SU1FB+gHHwwhFBPGkGwAAARvSURBVEjHnZb7XxRVGMbPcltb45KBBSiwgKyLspgXRIzWlsuyCCGCSMiuQMp1YZGFAgQBRQXcIAkpQ8JMsiuRlwyJLEnMNJDu9+vzhzSzszt7mxn48Px05n3Pd+a85z3ve4YQkZu7h6cXlzzFyx6SED6Jlj8MePtwSOwLwO8RPnDFo/APWPnY464KDAqmyFWrecAQhIZJuV3hEZEU6sdDrkGUjOeda+Xe0esA9/WcXiCGL4q1YkXshijgiY2coGITP4jNZEscsDWe84vbBEDKl0CR2zcuASRPJgJPKXnBHRLJ0xapkhhXMr1USitSgFQ1DxifpolLZ7QzPSPT7HomC7vMg+zdQE4uN7gnDzb5h5tde/PxLPPxgn1AoZYT1O0vKi5hVFzyHDPnwHYEH2RmFZRCUVjGGWO5TsvKepLcxKjYVqlUKqv01TUw1OoXuatEeigUeTV1paWJxqh6oOH5xYIk6YVlBrvYG2WLBalUNAX4NR+m1NxSj9YjHGCbRLXeUaoNbeb1tnfQaj96DJ3HXcGqEyetebQqrivEIevdiOjhyKM/XNWQbTdRH4aIZFdQtr/ZvdFR7i1N7QuDpFyb6yKHzsAHLqglg+TU0kCTiS/G1S9KXGSy9oz4Q4m9reh7iSOPtXWaOBedNB6kD7b0dL+CTo/8ZVcwXAxOteSSgTODPkCrMRKKV15VO4MdZzXNfs5qcX9tSHZu0Is6CoXDua93AiOa82+UO8Z4ob2j3VFl0nLVmxd7qUV6Fo/SswveukStoebY26YB4V0dfqeE+ggi3n2vzWJ5P/qDSMAw9uG4SAA0aSjKK+Wj8ct2xitX+/soc9Y1AfBjGK5/MnHjgpO5ym0yyhc7bTFmVilZxdO9MAPyT6c4X1mpwWdsdUTvK7VprO4mIZ+j8wvuteQWIZ8vj1vbyFnc6nGYn7Q8iOnUqmmssYLq7ii/IlZfttwmpAniGXtOf8cbXzHb3Ys6NsYprZ10RynLXQR/zSADdMj6i/7wqDY/B7ZincCuXkMk4+pIu7eH6Dc1QH6facnJfUgTAK/IkWo+Xt8AKbNBc/B5YPHEzmFCANQWYd5ED8q+BS7J4XXfukk5aAi01aMyU8Yq03zrdFubvu47uqa+F1nAvT+gWW0FlbXzxi5WPxqpPJLjYgQw15z6J8WtWPYwnDfgzhTbV+VOeaQKoGwQwePMXFnQDMupupB/hK0O7ak4u3qcPnyaNo6GosjlCieTQIjUVlZTarsLUsbcoZdTgavO3FAFc/kIdrnsnyH/xdF0Ywwjv9IDKH7jB0UP5vD7GQduGvjjAANu5geJ9E8D6idE7HM2VdyrVOYhEDYlQCb9lQd5jM7ympt/A+kJzMNudEkEQDIw2QD0z9KH1JQzB8PgFosjBjihFSLJTO8IPHbpdpybB3wy2PQkXIfh3j9DPXwami24+y/945BD/fQm3raFS6ops0HOLx+PmizmNAX/N+ywlAK6wy+oUF/jSueGVxmdUtEnqM6KusaAUQfof2fow1/rZMe3AAAAAElFTkSuQmCC" />
                      </svg>
                    </div>
                    <div class="process_content">
                      <h4>Facility Booking</h4>
                      <p>For Stadiums, Guest Houses, Gyms & Swimming Pools</p>
                    </div>
                  </div>
                </a>
              </li>
              <!--li class="text-center">
                           <div class="process_card wow hvr-float-shadow animate__fadeIn box" data-animation="fadeInUp" data-delay="1s" data-wow-duration="1s">
                             <!-- <div class="ribbon">To be announced soon</div>-->
              <!--div class="process_icon process_icon_4">
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 60 63">
                                    <image x="2" y="3" width="56" height="56" xlink:href="data:img/png;base64,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"/>
                                 </svg>
                              </div>
                              <div class="process_content">
                                 <h4>Facility</h4>
                                 <p>For Stadium Booking</p>
                              </div>
                           </div>
                        </li-->
              <li class="text-center">
                <a href="application/public/private_coaching" target="_blank">


                  <div class="process_card wow hvr-float-shadow animate__fadeIn box" data-animation="fadeInUp"
                    data-delay="1s" data-wow-duration="1s">
                    <div class="process_icon process_icon_4">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="56px">
                        <image x="0px" y="0px" height="50px"
                          xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAMAAADDpiTIAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABqlBMVEVmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSlmlSn///8aokQPAAAAjHRSTlMADE5wiqS+2PIbaLb4CnTL/gNk5UzVH8A86mL5jrD8o3FYZcEghgLGqAY5UiZ20esBNtYFbOPcV0PMCBrJNVv34qULFo3u3at5RYgHXiPXN7T1bwky7LHw5ygVnw7SyMcNJ8XE5sM7SEeAkJGSk5SVlu+PWu0Yr3U4ovEeJeQkKgTNeyyhX32FveGeLppZjUAAAAABYktHRI0bDOLVAAAAB3RJTUUH6AcfDAAkuYC1IwAAEwVJREFUeNrtnfdjVMcVRhcWhFABFSREk5CEwIi21NCbjRODDYntFKc6PbKd3oPjkmI7yf7RAQxGZea9efNm5rt35ju/anff3HsOaLVaSZ2OhU2bu1u2Dmwb7BfO4LaBrVu6mzd1imL70PAIevOyGBke2o62korRHTvH0PuWyNjOHaNoNwkYn5hEb1oukxPjaD+x2TWFXrJspnahDUVlejd6wfLZPY22FI+ZPejtamDPDNpTLPbuQ+9WB/v2ok1FYXw/erF62J/hc8HxA+itauJAfgXsR+9UF/vRvkKzF71RbWT2PGCGz/8asi+rrwWm+fVfY/bk9HoAX//xYDfaWjh2oXepk2xeFR7n6/9eTOXyteAEepNamUCbC8Mov//ryWQe7w/Ygd6jXnag3QVhJ3qNetmJdheC7fb3f81OzR2cL5yDc1Oz1gWN5fA+wSHbdIMLeXyKa83ogvW90UPoswVg2DLb4iH0yeRwaNGypGH0ydqzacQ82tJh9MkkcXjJvKUR/T8vsNny75/+13DY8n/AZvTBWtM1f/7n///rOGR+HtBFn6s1W4xzLaCPJY8F46K2oI/Vmq2msWb5/H8Do8avBreij9WaAdNYU+hTScT4LbMB9Klas8001hz6VBKZM21qG/pUrTE+tzmIPpVEDhqfLaNP1RrjU5t59KkkMm9cFfpUrWEArjCAwmEAhcMACocBFA4DKBwGUDgMoHAYQOEwgCi0fdNmwpMygGTXb0C6kzKAdNdnAOlgAK4wgHTXZwDpYACuMIB012cA6WAArjCAdNdnAOlgAK4wgHTXZwDpYACuMIB012cA6WAArjCAdNdnAOlgAK4wgHTXZwDpYACuMIB012cA6WAArjCAdNdnAOlgAK4wgMJhAIXDAAqHARQOAygcBlA4DKBwGEDhMIDCYQCFwwAKhwEUDgMoHAZQOAygcBhA4TCAwmEAhcMACocBFA4DKJySAjjyAtnAkYICIM6g/TEAMGh/DAAM2h8DAIP2xwDAoP0xADBofwwADNofAwCD9scAwKD9MQAwaH8MAAzaHwMAg/bHAMCg/TEAMGh/DAAM2h8DAIP2xwDAoP0xADBofwwADNofAwCD9hcnAL4p1EBJbwrl28INlPS2cAZggAEUDgMoHAZQOAygcBhA4TCAwmEAhcMACocBFA4DKBwGUDgMoHAYQOEwgMJhAIXDAAqHARQOAygcBlA4DKBwGEDhMIDCYQCFwwAKhwEUDgMoHAZQOAygcBhA4TCANhydXj42n4xjy9NHg4/AADw5fmL45KmxfmLGTp0cPnE85BwMwIPe6aUzqdWv5szS6V6oWRhAY86eO4+0/znnz50NMw0DaEhv/gJa/udc+FIvxDwMoBkXL6HFP+fSxQADMYAmXJ5DS1/L3OXWIzGABly5ija+nqtX2s7EANy5Non2vZHJay2HYgDOXL+Btm3ixvV2UzEAV66jVdtoVwADcOSayH//j7nR6rMAA3DjisDP/8+YbPNMkAE4cfkq2nIVV1t8NcgAnBD29f965vwnYwAuXEQbrsP/NUEG4EBP0Ou/Zi71fGdjAN5LEkXg2dD+WhN0SWeFfP+vigu+3x1mAPWcQ9t14ZzncAyglp6A93/Uc77nNx0DqOU02q0bp/2mYwC1LFl3fvNWd+Z2uqFuz3Rv3bQeZsnvQdUE8OL1lwbuvPzlr7zSc7l1yABs7/+cvXsv/Rru3Z21HOeM3wNqCeDVO8/Otviaw80DBnDcsvD7DzCbeHDfciC/d4vrCODKV1cd7muvH669Q8AATlj8v4FaxhuWAk54PZqKAN78+trjHaj9AZmAAQwbH2sW9O//MQ/MnwWGvR5MQwBv3ll/vm/UFRAwgJPGx7qLXMhd45FOej2WggA2+q8vIGAAp0wPdRPw/O8594xfC5zyeiz5AZj81xYQLoCjxp//u4XdyS3Tmca8fnJUfABm/3UFhAtg2vhQXexSusZDTfs8lPQAbP5rCggXwLLxoWawW5kxHmrZ56GEB2D3X11AuACOGR8q4et/Jm4bD3XM56FkB1Dlv7KAcAHIXFDu8z2l2n9VAbkvKPf5PqfOf0UBuS8o9/meUO/fXkDuC8p9vse4+LcWkPuCcp+v4+rfVkDuC8p9Pnf/lgJyX1Du8zXwby4g9wXlPl8T/8YCcl9Q5vM1828qIPMFZT5fU/+GAvJeUObzNfe/sYCsF5T5fD7+NxSQ84Iyn8/P//oCMl5Q5vP5+l9XQL4Lyny+av/fdC4g2wVlPl+1/2+91a368OoCcl1Q5vPV+be9GW5jAZku6AvynK/ev3MBeS7oOVnO5+LftYAsF7SKHOdz8+9YQI4LWk2G87n6dysgwwWtIb/53P3XFXDgcJYLWkt28zXxX1fA6zkuaB25zdfMf00BX3tN7YK+/Z3vut1Q6Xw2mvqvKWCxp3RB3/5e//tuBeicz0Zz/zUFvKJzQY/89x0LUDmfDR//1QV8ReWCnvjv93/gUoDG+Wz4+a8s4MsaF/TUv1sBCuez4eu/qoCXFS7oC/9OBeibz4a//85b1u8O39G3oFX++/0jb9fdXN18Ntr4/5b1fgPqFrTGv0MB2uazUeP/hxV3rfDff0nbgtb57/d/9Hb1HZTNZyOS//51ZQva4L+2AF3z2Yjl/86LuhZk8F9XgKr5bMTy339V14KM/vv9H79dcR9N89mo9v8Tf/9f1bUgi/9HBWyy30nRfDai+f/6FVULsvqvLEDPfDai+b/zpqoFVfjv939qLUDNfDYi+1ezoEr//ZGf2e6nZT4bsf1rWVCN/59b76hkPhvR/StZkLd/JfPZiO9fx4L8/euYz0YC/yoW1MK/ivlspPCvYUFt/GuYz0YS/1IW9Av7h1r5lzKfBy38/9Ddv5AFrfTfsX2onX8h83mQyL+MBa08uqGlgJb+ZcznQSr/Iha08uSW75o+1Na/iPk8SOZfwoJWnt7UUEBr/xLm8yCdfwELWvnitu+t/1B7/wLm86CN/580849f0MqqG68rIIB//HwepPQPX9DKmlv/cvWHQviHz+dBUv/oBa2su/mqAoL4R8/nQVr/4AWtbLj9r559KIx/fQEk9o9d0IrhDk8LCORfXQCp/UMXtGK8x697nXD+tQWQ3D9yQSuWsz4qIJh/ZQGk9w9c0Ir1tL95MZh/XQEA/OMWtFJx3t8G868qAIR/2IJ+0fekmX9NAUD84xb0uyT+FQWA8Q9c0Dsp/OsJAOQfuSCPAhr7VxMAyj90QY0LaO5fSwAw/9gFvRvdv5IAavwfr7hrS//gBTUqwMe/jgCA/tELalCAl3/0fE4g/cMX9F5c//D5HID6xy/IsQBP//j5asH6F7AgpwJ8/QuYrwawfwkL+mVE/xLmqwTtX8SCagvw9y9ivgrg/mUs6FfR/MuYzwrev5AFVRbQxr+Q+SwI8C9lQRUFtPIvZT4jEvyLWdCv4/gXM58BEf7lLMhSQEv/cubbQLX/yUT+BS3IWEBb/4LmW4cQ/4IW1PtNBP+C5ltLC//HQ/qXtKCNBbT3L2m+1YjxL2pBvXWfBW609y9qvufI8S9sQb//w6q7/uCtZndWMN9TBPmXtqA//unZHW/8edxrubLne4Ik//IW9JfX/zr1tx+/++pDnzMomE+Yf4kLCoq8+WT5F7igsIibT5h/eQsKjLT5pPkXt6DQCJtPnH9pCwqOrPnk+Re2oPCImk+gf1kLioCk+ST6F7WgGAiar43/yVj+JS0oCnLmk+lf0ILiIGY+of7lLCgSUuaT6l/MgmIhZD6x/qUsKBoy5pPrX8iC4iFivhr/71fcNbZ/GQuKiIT5JPsXsaCYCJhPtH8JC4oKfj7Z/gUsKC7w+YT7xy8oMuj5pPuHLyg24PnE+0cvKDrY+eT7D7igY8aHuh3qoH7cNh7qmM9DPZw3UXkXBf4DBrBsfKiZYCf1YsZ4qOU0F9fgP2AA08aH6qbZtY2u8VDTSa6twn/AAI6OmR7qVpJdW7llOtPY0RSX1uE/YACdU6aHunkvxbJt3LtpOtOpFJdW4j9kACeNj3U3xbZt3DUe6WSCK2vxHzKAYeNjzT5IsG4LD2aNRxqOf+UW/t9P6j9kACfMR77/Rvx9m3njvvlEJ6JfWY//kAEctxz6Puj/gAcW//3j7R+7GkX+QwbQOWM59uxdwDPBe3dnLcc5E/vSmvwHDWDJevKbt7ozCV8TvD3TvXXTepilyFdX5T9oAKf7KjiN9P93Yf6DBtA7j3brwvke/UcKoHMOLdeFc/QfLYCzF9B267lwlv6jBWD5nrkovGfL03/gAHqX0H7ruNSj/4gBdC6iBddxkf7XEjiAzhzacDVz8Tap03/wAC5fRTuu4urleJvU6T94AJ0rlcNgmbwSb5FK/YcPoHPtBtqzjRvX4u1Rq/8IAXSuo0XbuB5vjWr9xwigc13k/wE36N9EjAA61wQ+D5jk//9GogTQuXIV7Xs9V/n8z0ycADqXhb0eMIf7+u+Diru+/3e0/1gBdDoXBb0qfAn4+p9w//EC6PTmhXxv8MKXehEXqNx/xAA6nbPnBLxD5Pw55Pd/xfuPGsCj/wVOL53pAzmzdLoXdX3q/UcO4DHHTwyfPDXWT8zYqZPDJ8Dv/9bgP0EATzg6vXxsPhnHlqcF/PynCv+pAsiSHPwzAH+y8M8AvMnDPwPwJRP/DMCTXPwzAD+y8c8AvMjHPwPwoYX/D4T5ZwAe5OSfATQnK/8MoDF5+WcATcnMPwNoSG7+GUAzsvPPABqRn38G0IQP8/PPABrw0cf5+WcADfhHhv4ZgDv/3Fch8bxS/wzAnX/l6J8BOPOw4occ9PpnAM78O0v/DMCZT7L0zwCc+dRqcXHUfi/p/hmAMwt2j59ZCxDvnwE4U/VrcG0FyPfPAJyp/D3I5gIU+GcAzlT/ImxTARr8MwBnan4T+sYCVPhnAM7U/Sr89QXo8M8AnKn9WwhrC1DinwE4U//HMFYXoMU/A3DG4a+hPC9AjX8G4IzLn8N5VsAHlb8dS5J/BuCM099D+rwARf4ZgDNufxDrcQGa/DMAZxz/Itpno6r8MwBnXP8k3qIq/wzAmSB/E1GcfwbgTIgA5PlnAM4ECECgfwbgTPsAJPoPGIB5QcabvtD+H5NCRPpnAMmQ6Z8BpEKofwaQCKn+GUAaxPpnAEmQ658BpECwfwaQAMn+GUB8RPtnANGR7Z8BxEa4fwYQGen+GUBcxPtnAFGR758BxESBfwYQEQ3+GUA8VPhnANHQ4Z8BxOLjD9FqGQCQfZ98hDbLAHD857//Q3sFBPBw3oTxpsvzmvn9n4cqPjrx6SevPkRbhQRAVMIACocBFA4DKBwGUDgMoHAYQOEwgMJhAIXDAAqHARQOAygcBlA4DKBwGEDhMIDCYQCFwwAKhwEUDgMoHAbgSoM3vWqCAbjS4G3vmmAArjCAwmEAhcMACocBFA4DKBwGUDgMoHAYQOGUFMCRF8gGjhQUAHEG7Y8BgEH7YwBg0P4YABi0PwYABu2PAYBB+2MAYND+GAAYtD8GAAbtjwGAQftjAGDQ/hgAGLQ/BgAG7Y8BgEH7YwBg0P4YABi0PwYABu2PAYBB+2MAYND+GAAYtL84AfBNoQZKelMo3xZuoKS3hTMAAwygcBhA4TCAwmEAhcMACocBFA4DKBwGUDgMoHAYQOEwgMJhAIXDAAqHARQOAygcBlA4DKBwGEDhMIDCYQDprt+AdCdlAOmuzwDSwQBcYQDprs8A0sEAXGEA6a7PANLBAFxhAOmuzwDSwQBcYQDprs8A0sEAXGEA6a7PANLBAFxhAOmuzwDSwQBcYQDprs8A0sEAXGEA6a7PANLBAFxhAOmuzwDSwQBcYQBRmG9JwpMygLJhAIXDAAqHARQOAygcBlA4DKBwGEDhMIDCYQCFk2kAg6apDqJPJZGDpk0Nok/Vmm2msebQp5LInGlT29Cnas2Aaawp9KkkMmXa1AD6VK3ZahprdhR9LHmMzpo2tRV9rNZsMT61WUAfSx4LxkVtQR+rNV3jXIOH0OeSxiHjs+V+F32u1mw2ztVfPIw+mCwOL5r3tBl9sNZsGjFPtsQCVnF4ybylkU3ok7Vn2Dxaf5GfBb7gkOXff38YfbIADFlm6w8u8GuBJ4wuDNp2NIQ+WwC2j9mm689OzR1s+6ZN7Rycm5q1LmhsO9peCHb2iSc70e6CsAO9Rr3sQLsLwugkeo9amczkSdIEepFamUCbC8T4VPtdlMjUONpcKHahV6mTXWhv4diN3qVGdqOtBWR6D3qb+tgzjbYWkpl96H1qY98M2llY9qIXqo29aGOh2Y/eqC72o30FZ/wAeqeaOJDNV4CrCtiP3qoe9mfo/xF7+UzQiX3Zff5/xgy/GnRgT2bP/1czzVeEatmd1df/G9jF7wtUMpXR679mxif43WErkxN5Pvtby+iOnWPtd5UfYzt3ZPL9/3q2Dw2PoPcti5HhoSze/+fOps3dLVsHtg22351uBrcNbN3S3ZzB+//N/B+TWUOZvJ3P9QAAAABJRU5ErkJggg==" />
                      </svg>
                    </div>
                    <div class="process_content">
                      <h4>Online Registration</h4>
                      <p>For Private Coaching, Academies/Associations, Gyms & Swimming Pools</p>
                    </div>
                  </div>
                </a>
              </li>
              <li class="text-center">
                <a href="onlineAdmission" target="_blank">

                  <div class="process_card wow hvr-float-shadow animate__fadeIn" data-animation="fadeInUp"
                    data-delay="1s" data-wow-duration="1s">

                    <div class="process_icon process_icon_3">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="60"
                        viewBox="0 0 120 120">
                        <image x="2" y="2" width="116" height="116"
                          xlink:href="data:img/png;base64,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" />
                      </svg>
                    </div>
                    <div class="process_content">
                      <h4>Sports College Admission</h4>
                      <p>for admission in <br />
                        Class VI, IX and XI only</p>
                    </div>
                  </div>
                </a>
              </li>
              <li class="text-center">
                <a href="javascript:void(0)" style="cursor:not-allowed; pointer-events:none; opacity:0.65;">
                  <!-- <a href="application/public/hostel/login" target="_blank"> -->

                  <div class="process_card wow hvr-float-shadow animate__fadeIn" data-animation="fadeInUp"
                    data-delay="1s" data-wow-duration="1s">
                    <div class="ribbon">Applications Closed</div>
                    <div class="process_icon process_icon_3">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="56px">
                        <image x="0px" y="0px" height="50px"
                          xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAjoAAALhCAMAAABhb/4eAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAB4FBMVEU5aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK45aK7////LyMYbAAAAnnRSTlMABREiOldtjJOhrLKwrrepn4pmSTAmCQMBUdHn+/5rDj6c4fSaQAgHTd4MAkXJCh6lHTTq3DdV6+g54/YqI7kaad3xHwQLdacX9UP5f7/Bh0sNDxPuEpgW4tAV5MQ8KcjvIQZi3yy0+BjytvMy8He9+v3afPctL/x5ltmRHKNT7YIUR7snW0HLXdYQJTVZ7M3m1IVyGU/X02RwzmDDjvEYRCgAAAABYktHRJ/otZOdAAAAB3RJTUUH6AcfDAgKrY8y5AAANhdJREFUeNrtnQdf1Moah7NY8NhF3B0LghUxCvbeXY4FC4hYsGPFCh4Uj73Xazv2tp/1brbA7puZTCY7kGT3//zuOffekMw7mTw7mUwmM4bhJ5GyIUOHDS8f8dfIUaNGjxkLXDF63PgJFRMrJ0Vj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" />
                      </svg>
                    </div>
                    <div class="process_content">
                      <h4>Hostel Admission</h4>
                    </div>
                  </div>
                </a>
              </li>
              <li class="text-center">
                <a href="application/public/sports_calendar" target="_blank">

                  <div class="process_card wow hvr-float-shadow animate__fadeIn box" data-animation="fadeInUp"
                    data-delay="1s" data-wow-duration="1s">

                    <div class="process_icon process_icon_6">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 60 63">
                        <image x="1" y="3" width="57" height="57"
                          xlink:href="data:img/png;base64,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" />
                      </svg>
                    </div>
                    <div class="process_content">
                      <h4>Sports Calendar</h4>
                      <p>For Coaching Camps & Sports Competitions </p>
                    </div>
                  </div>
                </a>
              </li>
              <li class="text-center">
                <!-- <a href="https://sewayojan.up.nic.in/IEP/JobseekerRegistration.aspx" target="_blank"> -->
                <!-- <a href="application/public/player_coach/login" target="_blank"> -->
                <a href="javascript:void(0)" style="cursor:not-allowed; pointer-events:none; opacity:0.65;">
                  <div class="process_card wow hvr-float-shadow animate__fadeIn box" data-animation="fadeInUp"
                    data-delay="1s" data-wow-duration="1s">
                    <div class="ribbon">Coming Soon</div>
                    <div class="process_icon process_icon_5">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 60 63">
                        <image y="1" height="60"
                          xlink:href="data:img/png;base64,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" />
                      </svg>
                    </div>
                    <div class="process_content">
                      <h4>Online Registration</h4>
                      <p>For Coaches</p>
                    </div>
                  </div>
                </a>
              </li>

              <li class="text-center">
                <div class="process_card wow hvr-float-shadow animate__fadeIn box" data-animation="fadeInUp"
                  data-delay="1s" data-wow-duration="1s">
                  <div class="ribbon">Coming soon</div>
                  <div class="process_icon process_icon_4">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                      viewBox="0 0 60 63">
                      <image x="2" y="3" width="56" height="56"
                        xlink:href="data:img/png;base64,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" />
                    </svg>
                  </div>
                  <div class="process_content">
                    <h4>Online Registration</h4>
                    <p>For Coaching Camps</p>
                  </div>
                </div>
              </li>
              <!--<li class="col-md-4 col-sm-6 col-12  text-center">
                           <div class="process_card wow hvr-float-shadow animate__fadeIn v" data-animation="fadeInUp" data-delay="1s" data-wow-duration="1s"><div class="ribbon">To be announced soon</div>
                             <div class="process_icon process_icon_6">
                               <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 60 63">
                                 <image y="2" height="59" xlink:href="data:img/png;base64,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"/>
                               </svg>
                             </div>
                             <div class="process_content">
                               <h4>Online Booking</h4>
                               <p>To Avail Facilities of Department</p>
                             </div>
                           </div>
                           
                           </li>-->
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section class="important">
      <div class="container">
        <div class="important-link">
          <ul class="">
            <li><img class="img-fluid" src="images/player1.png" alt=""></li>
            <li><img class="img-fluid" src="images/player2.png" alt=""></li>
            <li><img class="img-fluid" src="images/player3.png" alt=""></li>
            <li><img class="img-fluid" src="images/player4.png" alt=""></li>
            <li><img class="img-fluid" src="images/player5.png" alt=""></li>
            <li><img class="img-fluid" src="images/player6.png" alt=""></li>
            <li><img class="img-fluid" src="images/player7.png" alt=""></li>
            <li><img class="img-fluid" src="images/player8.png" alt=""></li>
            <li><img class="img-fluid" src="images/player9.png" alt=""></li>
            <li><img class="img-fluid" src="images/player10.png" alt=""></li>
          </ul>
        </div>
        <div class="khelo_india">
          <div class="card">
            <div class="row">
              <div class="col-md-3">
                <div class="khelo_img"><img src="images/khelo_india.png" /></div>
              </div>
              <div class="col-md-8">
                <h2>State Initiative for <span>Development of Sports</span></h2>
                <p>The importance of sports and fitness in one’s life is invaluable. Playing sports inculcates team
                  spirit, develops strategic & analytical thinking, leadership skills, goal setting and risk taking. A
                  fit and healthy individual leads to an equally healthy society and strong nation.</p>
              </div>
              <div class="col-md-1">
                <div class="c1"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <section id="upmap" class="Discover">
    <div class="container">
      <div class="tab-content">
        <div class="text-left title1">
          <h2>District-wise Sports Infrastructure</h2>
        </div>
        <div id="district" class="tab-pane in active">
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
            y="0px" viewBox="0 0 300 300" enable-background="new 0 0 0 0" xml:space="preserve" id="map-svg" class="  ">
            <g id="matrix-group" transform="matrix(1 0 0 1 0 0) scale(0.45,0.45)" fill="#000000" stroke="none">
              <path class="territory" data-id="575" id="Saharanpur"
                d="M52.029,17.846c-0.124,0.081,0.162,1.182,0.569,2.405c1.265,3.587,0.856,4.769-2.935,8.56
                           c-2.078,2.079-3.222,3.506-3.222,4.117c0,1.548-0.813,3.098-2.771,5.258c-1.063,1.142-2.487,2.813-3.22,3.709
                           c-0.938,1.183-1.714,1.753-2.813,1.957s-2.445,1.102-5.014,3.506c-5.056,4.647-6.972,6.604-8.644,8.602
                           c-2.895,3.465-2.935,3.505-3.139,9.944c-0.204,5.707-0.246,5.952-1.386,7.541c-1.429,1.957-1.956,4.036-1.062,4.036
                           c0.366,0,1.306,0.448,2.118,1.02c1.387,0.937,1.55,0.978,2.446,0.406c1.304-0.854,2.771-0.447,4.401,1.224
                           c0.773,0.732,2.403,1.712,3.71,2.161l2.404,0.854l3.221-0.814l3.221-0.815l2.364,1.467c1.671,1.02,3.017,1.508,4.604,1.671
                           c2.079,0.204,3.791,0.733,6.687,1.998c1.996,0.896,4.075,0.979,6.398,0.326c1.182-0.326,2.649-0.692,3.262-0.814
                           c0.61-0.123,1.67-0.815,2.363-1.591c0.693-0.773,1.468-1.385,1.752-1.385c0.285,0,1.225-0.732,2.12-1.631l1.55-1.589l-1.468-1.671
                           c-1.346-1.426-1.508-1.875-1.508-3.791c0-2.486-0.856-5.706-2.283-8.602c-1.223-2.567-1.223-2.771,0.203-5.747
                           c1.102-2.323,2.202-3.628,5.341-6.521c0.733-0.693,1.672-1.998,2.12-2.936c0.408-0.938,0.938-1.834,1.143-1.956
                           c0.203-0.122,0.325-2.12,0.325-4.402c-0.081-3.709,0.041-4.402,0.896-5.87c0.528-0.938,1.671-2.282,2.526-2.976
                           c1.915-1.55,2.079-2.854,0.366-2.854c-1.549,0-4.523-1.304-5.502-2.405c-0.448-0.447-1.061-0.854-1.428-0.854
                           c-0.366,0-1.021-0.286-1.427-0.612c-0.448-0.326-1.061-0.611-1.346-0.611c-0.854,0-5.34-3.139-5.829-4.075
                           c-0.244-0.448-1.386-1.55-2.566-2.446c-1.184-0.896-2.363-1.834-2.689-2.12C57.245,18.946,52.314,17.561,52.029,17.846z" />
              <path class="territory" data-id="525" id="Bijnaur" d="M111.132,77.725c-1.1,0.285-2.201,0.692-2.445,0.938c-0.285,0.202-2.241,1.141-4.359,2.038
                           c-2.12,0.938-4.565,2.16-5.382,2.689c-1.712,1.143-3.302,1.264-4.811,0.408c-1.427-0.815-1.957-0.733-2.12,0.285
                           c-0.081,0.692-0.813,1.264-2.646,2.161c-1.389,0.651-3.02,1.711-3.668,2.282c-0.611,0.57-1.469,1.183-1.836,1.305
                           c-0.896,0.326-0.979,2.283-0.161,3.872c0.283,0.61,0.65,1.917,0.813,2.935c0.163,0.979,0.652,2.609,1.103,3.628
                           c0.406,0.979,0.896,2.813,1.02,4.076c0.163,1.264,0.53,2.568,0.856,2.976c0.324,0.367,0.854,1.713,1.223,3.018
                           c0.326,1.304,0.854,2.894,1.181,3.505c0.326,0.612,0.571,1.997,0.571,3.098c0,1.468,0.203,2.202,0.815,2.731
                           c1.142,1.06,1.182,5.055,0.041,6.074c-0.448,0.406-0.938,1.508-1.063,2.404c-0.163,0.938-0.529,1.997-0.813,2.323
                           c-0.285,0.367-0.408,1.224-0.326,2.12c0.163,1.263,0.364,1.549,1.1,1.549c0.489,0,1.508,0.448,2.283,1.02
                           c0.731,0.528,2.242,1.304,3.302,1.63c1.104,0.367,2.08,0.854,2.201,1.06c0.326,0.53,3.669,0.448,5.584-0.122
                           c1.182-0.366,1.671-0.366,2.038,0c0.732,0.733,2.729,0.57,6.276-0.488c1.753-0.571,4.521-1.102,6.071-1.183
                           c2.242-0.122,3.343-0.407,5.098-1.427c1.223-0.693,2.729-1.508,3.302-1.834c0.609-0.326,1.834-1.549,2.771-2.731
                           c1.348-1.711,1.673-2.444,1.673-3.791c0-0.938,0.245-2.119,0.529-2.567c0.244-0.489,0.896-1.589,1.386-2.486
                           c0.529-0.979,1.388-1.834,2.16-2.16c0.692-0.285,1.631-1.06,2.079-1.712l0.856-1.182l-0.856-0.612
                           c-2.404-1.711,0.774-4.81,4.524-4.361c1.672,0.204,2.038,0.082,2.976-0.854c0.57-0.571,1.267-1.061,1.55-1.061
                           c0.733,0,4.852-3.465,5.422-4.564c0.731-1.386,0-1.957-2.567-1.957c-2.896,0-4.28-0.611-7.583-3.464
                           c-2.568-2.161-2.977-2.365-5.503-2.65c-4.483-0.569-7.174-2.038-10.68-5.788c-1.672-1.834-3.304-3.954-3.588-4.769
                           c-1.386-4.035-3.587-8.234-4.359-8.397C114.882,77.235,112.885,77.235,111.132,77.725z" />
              <path class="territory" data-id="523" id="Baghpat"
                d="M16.687,116.937c0,1.957,0.162,4.199,0.408,4.974c0.285,0.979,0.285,1.834-0.042,2.813
                           c-0.896,2.649-0.61,5.054,0.856,7.989c0.771,1.549,1.793,2.935,2.281,3.138c0.652,0.286,1.021,0.938,1.185,1.998
                           c0.285,1.712-0.082,4.729-0.612,5.055c-0.164,0.122-0.326,2.283-0.367,4.852c0,4.32,0.043,4.646,0.734,4.441
                           c0.489-0.121,1.143,0.326,2.038,1.469c1.062,1.304,1.59,1.671,2.607,1.671c0.692,0,1.917,0.449,2.771,1.019
                           c4.118,2.895,8.479,0.611,5.666-2.935c-1.143-1.467-1.021-2.038,0.732-3.994c0.814-0.938,1.795-2.039,2.161-2.487
                           c0.365-0.406,1.143-1.141,1.793-1.589c0.896-0.692,1.143-1.142,1.103-2.243c-0.124-2.853-0.815-7.622-1.508-9.985
                           c-1.144-4.076-1.225-5.421-0.286-6.44c1.02-1.142,1.549-2.202,1.834-3.791c0.204-1.06,0.041-1.468-0.896-2.364
                           c-1.061-1.02-1.631-1.183-5.3-1.468c-3.994-0.367-7.336-1.345-7.947-2.405c-0.487-0.733-3.059-1.671-4.688-1.671
                           c-0.814,0-2.079-0.367-2.813-0.814c-0.732-0.448-1.428-0.815-1.509-0.815C16.769,113.35,16.687,114.939,16.687,116.937z" />
              <path class="territory" data-id="563" id="Meerut" d="M48.032,120.769c-1.348,1.59-1.591,1.712-3.953,1.875c-2.161,0.163-2.528,0.286-2.528,0.979
                           c0,0.732-1.06,2.975-2.12,4.483c-0.367,0.53-0.326,1.224,0.245,3.261c0.407,1.387,0.896,2.976,1.102,3.506
                           c0.204,0.529,0.366,1.875,0.366,3.017c0,1.141,0.203,2.731,0.448,3.546c0.326,1.143,0.285,1.834-0.163,3.22l-0.61,1.753l1.51,0.774
                           c1.589,0.774,5.38,1.508,10.965,2.038c1.833,0.163,3.628,0.53,3.954,0.815c0.854,0.692,1.956,4.36,1.752,5.951
                           c-0.122,1.142,0.081,1.59,1.141,2.649l1.265,1.223l2.282-1.712c1.266-0.938,3.06-2.689,3.954-3.872
                           c1.63-2.16,1.711-2.201,3.75-2.201c1.386,0,2.364,0.244,2.854,0.692c0.689,0.611,0.978,0.57,4.729-0.651
                           c2.527-0.815,4.771-1.265,6.196-1.265c3.097,0,4.116-0.732,3.791-2.771c-0.163-0.815-0.693-2.201-1.225-3.018
                           c-0.487-0.855-1.224-2.281-1.591-3.18c-0.648-1.589-0.648-1.752,0.408-4.973c0.815-2.446,1.063-3.709,0.857-4.892
                           c-0.204-1.223-0.122-1.794,0.405-2.365c0.366-0.406,0.773-1.508,0.896-2.404c0.122-0.896,0.57-1.957,0.979-2.324
                           c0.938-0.814,1.021-3.26,0.162-4.401c-0.486-0.651-0.979-0.733-4.973-0.529c-7.377,0.406-9.62,0.938-15.938,3.832
                           c-3.466,1.589-3.872,1.63-5.99,0.528c-0.897-0.448-1.794-0.814-2.08-0.814c-0.244,0-1.102-0.734-1.957-1.632
                           c-1.63-1.793-2.896-2.037-4.483-1.019c-1.223,0.816-2.935,0.449-3.791-0.856c-0.325-0.529-0.73-0.978-0.896-0.978
                           C49.622,119.098,48.848,119.831,48.032,120.769z" />
              <path class="territory" data-id="573" id="Rampur" d="M158.252,129.736c-1.063,0.53-1.752,1.183-1.834,1.712c-0.081,0.571-0.815,1.183-2.038,1.834
                           c-1.672,0.815-1.957,1.102-1.957,2.161c0,0.896-0.408,1.589-1.508,2.609c-0.815,0.773-1.672,1.385-1.834,1.385
                           c-0.653,0-0.326,1.305,0.65,2.569c1.429,1.956,1.549,2.771,0.814,5.991l-0.651,2.976l1.753,1.468
                           c1.508,1.346,1.752,1.752,1.916,3.547c0.365,4.483,0.203,5.422-1.346,7.133c-1.019,1.142-1.426,1.957-1.426,2.976
                           c0,1.63-1.348,3.506-2.568,3.506c-0.448,0-1.427-0.204-2.2-0.489c-1.876-0.692-2.038-0.203-0.569,1.59
                           c0.691,0.855,1.265,1.753,1.265,1.996c0,0.246,0.815,1.143,1.793,1.957c1.224,1.021,1.834,1.834,1.997,2.771
                           c1.061,6.073,1.061,6.155,0.408,7.255c-0.57,1.02-0.57,1.182,0.081,2.161c0.568,0.896,0.61,1.304,0.245,2.323
                           c-0.367,1.183-0.326,1.305,0.691,1.671c1.63,0.653,2.854,0.042,4.894-2.486c3.992-4.932,4.932-5.788,7.173-6.685
                           c2.607-1.061,8.725-6.115,9.09-7.5c0.123-0.529,0.123-1.549,0-2.283c-0.203-1.223-0.081-1.426,1.144-1.997
                           c0.772-0.367,1.956-1.549,2.771-2.813c0.813-1.181,2.648-3.261,4.117-4.605c1.834-1.671,2.689-2.731,2.689-3.383
                           c0-0.53,0.365-1.712,0.814-2.608c0.448-0.938,0.813-1.875,0.813-2.12c0-0.204,0.366-0.773,0.772-1.223
                           c0.653-0.693,0.813-1.549,0.896-4.076c0.164-3.995-0.162-4.321-4.481-4.362c-5.503-0.041-6.521-0.366-9.742-3.098
                           c-1.549-1.386-3.261-2.609-3.709-2.772c-1.264-0.365-2.078-2.282-2.078-4.81c0-2.446-0.408-3.017-3.1-4.361
                           C162.043,128.636,160.412,128.677,158.252,129.736z" />
              <path class="territory" data-id="552" id="Amroha" d="M88.386,136.87c-0.204,0.651-0.569,1.589-0.814,2.159c-0.405,1.102-0.079,2.161,1.834,5.544
                           c1.307,2.364,1.674,4.892,0.856,6.155c-0.53,0.774-0.57,1.264-0.204,2.486c0.204,0.814,0.408,1.998,0.408,2.568
                           c0,0.978,0.896,3.342,2.854,7.5c1.469,3.098,2.241,8.111,2.079,13.369c-0.041,1.998,0.123,4.198,0.366,4.933
                           c0.408,1.264,0.611,1.386,2.487,1.631c2.283,0.326,2.283,0.326,2.729,3.709c0.243,2.242,0.366,2.446,1.347,2.567
                           c0.854,0.081,1.386-0.243,2.607-1.712c1.712-2.078,2.363-2.282,3.709-1.019c0.528,0.489,1.225,0.774,1.549,0.652
                           c0.733-0.286,0.896-1.712,0.245-2.12c-0.651-0.407-0.487-1.508,0.406-2.446c0.489-0.53,0.897-1.712,1.061-3.179
                           c0.246-1.956,0.163-2.487-0.447-3.18c-0.449-0.448-0.814-1.101-0.856-1.508c-0.08-0.367-0.284-1.469-0.529-2.445
                           c-0.242-0.979-0.324-1.998-0.161-2.243c0.161-0.285,0.324-1.793,0.364-3.342c0.082-4.076,0.285-4.524,2.73-5.666
                           c2.16-0.979,5.054-1.061,5.666-0.123c0.163,0.285,1.061,0.123,2.566-0.448c1.266-0.489,2.648-0.897,3.018-0.897
                           c0.53,0,0.938-0.651,1.468-2.444l0.734-2.446l-1.348-2.609c-0.732-1.468-1.507-2.73-1.793-2.853
                           c-2.079-1.061-2.895-1.834-3.017-2.813c-0.081-0.61-0.408-1.589-0.691-2.2c-0.487-0.979-0.447-1.265,0.447-2.936
                           c1.104-2.079,1.265-3.506,0.449-3.832c-0.896-0.326-5.991,0.408-9.048,1.306c-2.978,0.896-6.115,1.101-6.522,0.488
                           c-0.121-0.245-0.731-0.245-1.549,0c-2.079,0.611-5.829,0.448-6.398-0.245c-0.284-0.325-1.184-0.773-2.036-1.019
                           c-0.816-0.204-2.202-0.856-3.02-1.427C89.936,135.442,88.917,135.483,88.386,136.87z" />
              <path class="territory" data-id="571" id="Pilibhit"
                d="M210.875,152.114c0.367,2.405-0.448,3.709-1.834,2.895c-1.144-0.733-1.63-0.204-1.875,2.038
                           c-0.163,1.386,0.082,2.365,1.101,4.564c1.55,3.426,1.346,4.28-1.223,5.137c-1.753,0.57-2.365,1.345-2.896,3.586
                           c-0.487,2.202,0.488,3.995,2.813,5.096c1.875,0.896,1.917,0.938,2.283,3.343l0.365,2.446l2.896,1.427
                           c2.896,1.426,2.896,1.426,3.179,3.383c0.246,1.712,0.082,2.283-1.019,4.443c-1.062,2.079-1.549,2.608-3.1,3.301
                           c-2.363,1.02-2.281,0.856-1.671,2.324c0.448,1.06,0.407,1.508-0.204,3.057c-0.651,1.794-0.651,1.875,0.161,2.569
                           c1.348,1.06,1.55,3.423,0.489,4.932l-0.854,1.224l1.021,1.019c0.611,0.611,1.265,1.63,1.508,2.283
                           c0.489,1.467,1.794,1.63,2.323,0.286c0.204-0.489,1.182-1.672,2.202-2.649l1.793-1.794l0.896,1.427
                           c0.49,0.856,0.857,2.079,0.857,3.099c0,1.63,1.021,3.302,2.079,3.302c0.204,0,0.938,0.571,1.59,1.263
                           c1.63,1.794,3.017,1.428,4.157-1.141c0.732-1.671,0.813-2.649,0.773-8.356c-0.082-7.377,0.284-9.212,2.038-10.679
                           c1.467-1.264,1.916-1.304,2.282-0.367c0.449,1.305,1.469,2.16,2.566,2.16c0.57,0,1.266,0.204,1.51,0.448
                           c0.245,0.246,1.549,0.45,2.896,0.45c2.241,0,2.567,0.122,3.791,1.385c0.732,0.774,1.548,1.386,1.793,1.386
                           c0.244,0,0.979-0.57,1.671-1.264c1.549-1.672,3.345-2.568,3.954-2.079c0.285,0.245,1.143,0.529,1.957,0.693
                           c0.979,0.163,1.793,0.692,2.363,1.467c0.489,0.653,1.142,1.183,1.428,1.183c0.813,0,3.098-3.017,3.098-4.036
                           c0-1.223-1.345-3.709-2.647-4.932c-1.508-1.386-3.342-5.177-2.771-5.748c0.693-0.693,3.385-1.182,6.973-1.182
                           c4.237,0,5.055-0.367,4.688-2.16c-0.285-1.508-1.347-2.813-3.383-4.198c-0.774-0.489-2.405-1.834-3.547-2.935
                           c-1.794-1.672-2.16-2.284-2.16-3.425c0-0.773,0.203-1.589,0.407-1.793c0.69-0.692,0.081-1.508-2.282-2.976
                           c-1.224-0.774-2.405-1.711-2.609-2.119c-0.365-0.692-6.97-6.521-10.436-9.213l-1.671-1.304l-1.223,1.304
                           c-0.693,0.733-1.876,2.324-2.65,3.587c-1.63,2.527-5.502,6.073-6.685,6.073c-1.265,0-2.69-1.224-2.486-2.079
                           c0.122-0.408,0-1.345-0.286-2.079c-0.732-2.161-0.979-2.364-2.118-1.957c-1.224,0.489-1.428,0.489-2.121,0.081
                           c-0.407-0.285-0.366-0.652,0.123-1.834c0.325-0.814,0.61-1.59,0.61-1.671c0-0.367-2.405,0.652-2.896,1.223
                           c-0.242,0.326-0.813,0.571-1.264,0.571c-0.734,0-0.775-0.245-0.693-2.771c0.081-1.509,0-2.936-0.121-3.18
                           c-0.325-0.489-2.649-0.245-3.018,0.285c-0.448,0.733-1.549,0.326-3.343-1.142l-1.834-1.509L210.875,152.114z" />
              <path class="territory" data-id="529" id="Bareilly"
                d="M195.019,152.93c-1.386,0.856-3.914,1.019-5.096,0.285c-0.652-0.408-0.938-0.367-1.833,0.489
                           c-0.571,0.529-1.021,1.182-1.021,1.468c0,0.326-0.365,1.182-0.813,1.998c-0.449,0.814-0.814,1.916-0.814,2.485
                           c0,0.733-0.854,1.875-3.221,4.158c-1.793,1.711-3.587,3.791-3.995,4.565c-0.448,0.773-1.386,1.793-2.08,2.242
                           c-1.06,0.692-1.263,1.101-1.303,2.445c-0.042,0.897-0.163,1.957-0.327,2.324c-0.528,1.304-7.703,7.092-9.416,7.622
                           c-1.752,0.488-4.32,2.896-7.051,6.481l-1.508,1.955l1.426,0.775c0.774,0.407,2.039,1.467,2.813,2.282l1.388,1.549l-0.041,4.606
                           c-0.041,3.627,0.082,4.891,0.651,5.95c0.691,1.346,2.813,2.936,3.913,2.936c0.326,0,1.144,0.285,1.753,0.611
                           c1.591,0.813,3.344,1.101,8.11,1.223c2.323,0.081,5.869,0.285,7.948,0.529c3.139,0.325,3.954,0.57,5.177,1.549
                           c0.815,0.651,1.469,1.304,1.469,1.468c0,0.163,0.814,1.102,1.834,2.079c1.508,1.508,1.834,2.079,1.834,3.302
                           c0,0.896-0.365,1.997-0.854,2.69c-2.69,3.628,2.444,2.567,6.889-1.427c2.079-1.834,2.938-3.546,2.938-5.746
                           c0-1.021,0.404-2.038,1.385-3.385c0.732-1.019,1.549-2.485,1.834-3.261c0.245-0.771,0.896-1.997,1.468-2.729
                           c1.102-1.47,1.063-3.262-0.082-3.71c-1.182-0.448-1.346-1.631-0.488-3.547c0.733-1.711,0.774-1.956,0.162-3.098
                           c-0.854-1.67-0.326-2.609,2.038-3.464c1.509-0.612,2.038-1.102,2.937-2.813c1.631-3.015,1.346-4.36-1.226-5.747
                           c-1.059-0.57-2.241-1.02-2.564-1.02c-0.734,0-1.267-1.223-1.591-3.668c-0.244-1.671-0.407-1.957-2.322-3.057
                           c-2.609-1.55-3.506-3.629-2.731-6.44c0.774-2.935,1.429-3.791,3.425-4.525l1.875-0.732l-0.731-1.263
                           c-1.712-2.979-2.12-6.319-1.103-8.969c0.447-1.223-1.061-1.305-3.14-0.163c-1.06,0.611-2.12,1.102-2.324,1.102
                           c-0.243,0-1.181-0.733-2.118-1.631c-0.938-0.896-1.834-1.63-1.958-1.589C196.365,152.114,195.712,152.48,195.019,152.93z" />
              <path class="territory" data-id="531" id="Bulandshahr"
                d="M74.935,168.867c-0.529,0.733-1.303,1.834-1.671,2.404c-0.854,1.387-3.221,2.242-4.36,1.589
                           c-0.732-0.366-1.183-0.163-3.1,1.428c-1.264,1.019-2.444,1.834-2.689,1.834c-0.772,0-3.303,1.957-3.789,2.935
                           c-0.366,0.692-0.896,0.979-2.282,1.141c-1.631,0.163-1.917,0.367-2.528,1.631c-0.406,0.814-1.468,1.996-2.363,2.648
                           c-1.918,1.427-2.648,3.709-1.428,4.361c1.145,0.652,2.242,1.917,2.242,2.567c0,0.367-0.449,1.102-1.021,1.672
                           c-0.813,0.814-0.938,1.182-0.609,1.793c0.609,1.141,0.528,1.467-0.815,2.976c-1.265,1.468-1.957,4.158-1.265,5.137
                           c0.204,0.325,1.062,0.692,1.916,0.814c2.039,0.326,2.935,1.915,2.202,3.709c-0.571,1.345-0.285,2.039,0.813,2.039
                           c1.226,0,2.119,1.712,1.834,3.424c-0.164,0.774-0.527,1.63-0.854,1.915c-0.855,0.734-0.733,2.405,0.204,2.405
                           c0.406,0,0.979,0.285,1.265,0.611c0.366,0.448,0.652,0.529,0.938,0.244c0.286-0.285,0.204-0.651-0.242-1.182
                           c-0.408-0.449-0.53-0.896-0.327-1.141c0.204-0.204,0.449-0.815,0.528-1.387c0.123-0.938,0.284-1.02,2.364-1.06
                           c1.226-0.041,2.978-0.367,3.831-0.774c1.957-0.814,2.896-0.61,5.3,1.224c1.021,0.773,2.567,1.752,3.467,2.241
                           c1.06,0.529,1.956,1.387,2.443,2.364c0.692,1.386,0.938,1.549,1.997,1.386c1.021-0.121,1.266-0.407,1.468-1.549
                           c0.285-1.346,1.876-3.017,2.978-3.017c0.285,0,1.06,0.326,1.671,0.773c0.611,0.408,1.998,1.265,3.057,1.875
                           c1.389,0.733,2.161,1.549,2.568,2.527l0.612,1.385l2.037-1.752c3.14-2.649,3.222-2.689,6.521-3.098
                           c1.672-0.204,3.668-0.693,4.402-1.101c1.834-0.938,3.139-0.325,4.729,2.16c1.063,1.672,1.428,1.916,2.772,2.038
                           c1.834,0.163,3.138-0.773,3.138-2.16c0-1.101-1.06-3.709-1.63-4.075c-0.246-0.163-0.856-0.938-1.386-1.753
                           c-0.53-0.857-2.079-2.69-3.467-4.158c-1.386-1.467-3.017-3.22-3.668-3.872c-1.183-1.264-3.75-5.136-4.237-6.441
                           c-0.124-0.367,0.041-2.729,0.364-5.258c0.896-6.359,0.529-7.664-2.036-7.664c-1.834,0-3.101-2.568-3.101-6.318
                           c0-2.282-0.123-2.649-0.731-2.649c-0.408,0-0.897-0.163-1.103-0.366c-0.246-0.204-0.854-0.449-1.427-0.53s-1.182-0.529-1.427-1.059
                           c-0.285-0.653-0.856-0.979-1.916-1.183c-0.856-0.122-1.752-0.489-1.998-0.774c-0.285-0.327-1.225-0.571-2.323-0.571
                           c-1.63,0-2.038-0.204-3.668-1.834c-0.979-1.019-2.121-1.834-2.487-1.834C76.24,167.563,75.506,168.175,74.935,168.867z" />
              <path class="territory" data-id="560" id="Lakhimpur" d="M271.652,169.724c-0.406,0.61-0.691,2.486-0.854,5.299l-0.286,4.361l-1.711-1.752
                           c-2.201-2.161-4.321-3.873-6.033-4.729c-0.689-0.366-1.711-0.938-2.242-1.263c-0.813-0.53-0.978-0.53-1.304,0
                           c-0.489,0.774-0.531,2.445-0.042,2.445c0.204,0,1.266,0.814,2.324,1.834c1.101,1.019,2.201,1.834,2.405,1.834
                           c0.243,0,1.182,0.773,2.077,1.752c2.12,2.161,2.731,4.851,1.47,6.44c-0.733,0.856-1.185,0.979-5.747,1.183
                           c-2.691,0.163-5.016,0.367-5.139,0.489c-0.324,0.325,0.938,2.527,2.08,3.627c1.51,1.427,3.018,4.564,3.018,6.358
                           c0,1.265-0.327,1.917-1.753,3.424c-0.938,1.02-1.957,1.957-2.283,2.038c-0.448,0.163-0.611,1.224-0.611,4.893
                           c-0.082,6.113-0.649,7.296-3.913,7.947c-2.402,0.449-3.017,1.265-1.916,2.527c1.021,1.141,1.184,2.405,0.529,3.709
                           c-0.651,1.182-4.77,4.606-6.195,5.096c-1.59,0.53-2.729,1.957-3.424,4.198c-0.649,2.242-0.854,2.446-3.139,3.709l-2.446,1.386
                           l0.367,1.875c0.245,1.062,0.57,2.649,0.813,3.547c0.203,0.896,0.489,2.444,0.611,3.464c0.163,1.509,0.449,2.038,1.631,2.935
                           c1.307,1.02,1.673,1.102,3.628,0.897c1.429-0.164,2.405-0.123,2.771,0.204c0.286,0.243,1.509,0.733,2.648,1.1
                           c1.184,0.327,2.69,0.979,3.385,1.386c1.141,0.693,1.345,0.693,2.199,0.123c0.61-0.367,1.388-0.489,2.078-0.367
                           c0.857,0.204,1.511,0,2.527-0.733c0.734-0.57,1.916-1.142,2.609-1.304c0.69-0.124,2.605-0.979,4.318-1.876
                           c3.586-1.916,4.771-1.875,6.851,0.246c2.241,2.2,2.854,2.16,3.139-0.286c0.245-1.712,0.571-2.322,1.998-3.627
                           c2.771-2.567,5.054-2.812,7.296-0.814c0.489,0.408,1.793,0.652,3.668,0.733c1.63,0.082,3.832,0.245,4.894,0.367
                           c1.672,0.245,1.914,0.204,2.158-0.611c0.284-0.855,3.669-3.302,5.341-3.831c0.487-0.163,1.184-0.611,1.59-1.06
                           c0.529-0.611,1.265-0.814,2.689-0.814c2.119,0,2.404,0.243,3.017,2.608c0.366,1.427,0.651,1.671,2.243,2.161
                           c1.02,0.325,2.771,1.02,3.871,1.508c1.144,0.53,3.221,1.101,4.646,1.224c1.469,0.163,3.099,0.61,3.71,0.977
                           c0.568,0.367,1.385,0.897,1.834,1.142c1.182,0.652,1.304,3.017,0.205,4.035c-1.186,1.061-1.021,1.712,0.567,2.242
                           c0.732,0.245,1.712,0.815,2.119,1.263l0.733,0.815l0.326-0.856c0.16-0.447,0.122-1.712-0.082-2.853
                           c-0.203-1.102-0.326-5.462-0.326-9.701l0.082-7.744l-2.938-2.935c-1.63-1.63-2.935-3.099-2.935-3.302
                           c0-0.204-0.61-1.062-1.388-1.876c-1.916-2.16-2.118-3.099-1.021-4.605c1.266-1.712,1.225-3.75-0.12-5.177
                           c-1.632-1.793-3.181-4.321-3.181-5.218c0-0.448,0.285-1.224,0.61-1.712c0.529-0.774,0.529-0.896-0.082-1.101
                           c-0.365-0.162-1.469-0.162-2.486,0c-1.954,0.287-2.523-0.081-2.523-1.711c0-0.489-0.65-1.672-1.428-2.649
                           c-1.55-1.997-1.59-2.445-0.366-7.622c0.691-2.813,0.529-3.873-0.813-5.3c-1.185-1.305-2.446-1.916-5.423-2.567
                           c-2.2-0.449-2.566-0.653-2.566-1.427c0-0.489-0.284-1.101-0.61-1.387c-0.327-0.285-0.609-0.732-0.609-1.06
                           c0-0.775-1.348-1.062-2.609-0.571c-2.771,1.061-5.747,0.245-6.151-1.671c-0.246-1.101-0.693-1.468-3.06-2.569
                           c-2.935-1.345-5.014-3.464-6.479-6.603c-0.979-2.12-2.405-3.261-4.565-3.588c-0.896-0.163-2.201-0.53-2.853-0.856
                           C273.446,168.542,272.385,168.623,271.652,169.724z" />
              <path class="territory" data-id="542" id="Gautam Budh Nagar" d="M29.323,172.943c0,0.693-0.283,1.59-0.651,1.996c-0.611,0.693-0.57,0.979,0.855,3.915
                           c0.814,1.752,1.752,3.668,2.079,4.279c0.325,0.57,0.57,1.467,0.57,1.916c0,0.489,0.448,1.589,0.979,2.446
                           c0.733,1.181,1.388,1.63,2.404,1.834c0.774,0.162,1.672,0.162,1.957,0.039c0.367-0.121,0.857,0.367,1.346,1.387
                           c0.734,1.549,0.734,1.631-0.081,3.831l-0.854,2.241l0.896,0.774c0.489,0.449,1.225,0.938,1.632,1.06
                           c0.813,0.285,0.854,0.653,0.283,2.161c-0.528,1.347,0.406,3.017,1.714,3.017c0.487,0,1.223,0.326,1.63,0.692
                           c0.732,0.652,0.691,0.734-0.774,2.242c-0.979,1.02-1.304,1.548-0.896,1.548c0.365,0,0.938,0.327,1.304,0.734
                           c0.773,0.857,0.449,1.508-1.467,2.691c-0.979,0.61-1.063,0.813-0.653,1.345c0.286,0.326,0.734,1.019,0.979,1.508
                           c0.366,0.734,0.813,0.856,2.688,0.856c1.265,0,2.568,0.243,2.896,0.528c1.304,1.062,6.438-2.038,6.438-3.872
                           c0-0.285-0.854-0.938-1.957-1.427c-2.039-0.978-2.323-1.793-1.061-3.22c0.813-0.896,0.283-1.997-0.938-1.997
                           c-0.57,0-1.549-0.53-2.241-1.265c-1.184-1.182-1.224-1.346-0.979-3.546c0.204-1.793,0.531-2.608,1.468-3.546
                           c0.856-0.896,1.104-1.386,0.815-1.834c-0.693-1.101-0.449-2.322,0.69-3.057l1.062-0.693l-1.548-1.304
                           c-1.471-1.264-1.551-1.427-1.308-3.138c0.163-1.469,0.571-2.12,1.998-3.425c0.979-0.896,2.201-2.282,2.69-3.098
                           c0.979-1.63,0.938-1.712-1.306-2.813c-0.65-0.326-1.917-1.55-2.813-2.649l-1.63-2.038l-3.914,0.163c-3.18,0.082-4.035,0-4.483-0.489
                           c-0.568-0.691-1.346-0.528-2.854,0.611c-1.508,1.141-3.14,0.979-3.994-0.489c-0.53-0.896-1.021-1.223-1.834-1.223
                           C29.447,171.639,29.323,171.803,29.323,172.943z" />
              <path class="territory" data-id="524" id="Bahraich" d="M312.656,196.055c-1.225,6.033-1.225,6.441,0,7.622c0.61,0.571,1.225,1.712,1.387,2.487
                           c0.242,1.264,0.364,1.385,1.264,1.182c1.591-0.408,3.791,0.163,4.32,1.101c0.325,0.653,0.284,1.143-0.284,2.16
                           c-0.651,1.266-0.651,1.306,0.407,3.059c0.609,0.979,1.59,2.161,2.158,2.648c0.856,0.693,1.063,1.224,1.063,2.854
                           c0.041,1.142-0.285,2.567-0.692,3.383c-0.938,1.834-0.896,1.957,0.529,3.179c0.692,0.53,1.225,1.306,1.225,1.63
                           c0,0.326,1.428,1.958,3.14,3.628l3.098,3.058l0.163,9.457c0.082,5.217,0.163,10.231,0.163,11.21c0.04,1.06-0.204,1.997-0.569,2.444
                           c-0.408,0.449-0.53,0.897-0.285,1.346c0.203,0.327,0.447,1.672,0.528,2.935c0.123,1.265,0.449,2.731,0.774,3.22
                           c0.325,0.53,0.732,1.752,0.854,2.731c0.122,0.978,0.611,2.282,1.062,2.854c1.508,1.916,2.894,5.178,2.894,6.89
                           c0,1.305,0.244,1.875,1.224,2.813c2.73,2.527,3.548,5.135,4.077,13.369c0.203,3.098,0.61,5.869,1.183,7.541
                           c0.447,1.47,0.854,2.979,0.854,3.345c0,0.692,1.915,1.954,2.936,1.954c1.225-0.038,1.591-0.649,1.144-1.834
                           c-0.366-0.896-0.285-1.262,0.244-1.875c0.407-0.445,0.854-0.771,1.102-0.771c0.203,0,1.55-0.57,2.978-1.266
                           c2.771-1.385,3.832-2.729,3.832-4.891c0-0.815,0.325-1.346,1.142-1.834c0.61-0.408,1.874-1.55,2.854-2.569
                           c1.55-1.63,1.713-1.957,1.346-2.771c-0.61-1.304-0.569-3.179,0.082-3.709c0.244-0.204,1.264-0.529,2.2-0.693
                           c1.346-0.203,1.834-0.122,2.321,0.489c0.367,0.408,1.307,1.509,2.119,2.446l1.469,1.712l1.551-1.02
                           c0.896-0.57,1.507-1.264,1.386-1.59c-0.325-0.814,2.16-2.65,3.67-2.65c1.59,0,2.282-0.61,2.282-2.037
                           c0-0.612,0.121-1.224,0.284-1.387c0.202-0.162,0.487-1.062,0.731-1.997c0.327-1.304,0.773-1.957,2.079-2.813
                           c1.429-0.979,1.631-1.263,1.467-2.324c-0.161-1.059-0.364-1.263-1.67-1.467c-0.813-0.122-2.038-0.407-2.729-0.611
                           c-0.692-0.244-1.59-0.326-1.916-0.163c-0.366,0.124-1.346-0.122-2.2-0.569c-0.856-0.489-2.526-1.062-3.71-1.306
                           c-1.141-0.286-2.242-0.651-2.362-0.855c-0.123-0.203-0.53-0.366-0.938-0.366c-0.774,0-2.486-1.631-2.486-2.365
                           c0-0.326-0.733-0.489-1.998-0.489c-1.671,0-2.077-0.164-2.646-1.02c-0.406-0.57-0.611-1.386-0.447-1.793
                           c0.121-0.367,0.041-1.712-0.205-2.936c-0.406-2.16,0-4.442,0.816-4.442c0.202,0,0.324-0.815,0.282-1.834
                           c-0.08-1.671-0.162-1.834-1.143-1.834c-0.772,0-1.182-0.326-1.711-1.427c-0.367-0.815-0.692-1.875-0.692-2.406
                           c0-1.344-0.772-3.464-1.958-5.217c-0.73-1.143-0.896-1.795-0.689-2.772c0.325-1.426,0.161-1.345,4.238-1.997
                           c3.262-0.488,4.196-0.978,3.83-1.915c-0.123-0.327,0.081-0.938,0.448-1.346c0.611-0.693,0.529-0.774-1.468-1.63
                           c-1.184-0.53-2.691-1.224-3.383-1.549c-2.08-1.102-3.996-2.079-6.073-3.058c-1.062-0.53-2.243-1.345-2.569-1.834
                           c-0.365-0.528-1.508-1.589-2.646-2.403c-1.102-0.815-2.363-2.161-2.813-2.977c-1.426-2.65-3.464-5.136-4.646-5.707
                           c-1.104-0.53-1.227-0.488-2.202,0.653c-0.57,0.651-1.264,1.549-1.549,1.997c-0.488,0.733-0.529,0.733-1.427-0.326
                           c-0.938-1.102-1.632-2.404-2.896-5.34c-0.365-0.814-1.426-2.323-2.322-3.303c-0.896-0.977-1.63-1.956-1.63-2.16
                           c0-0.244-0.285-0.651-0.61-0.938c-0.326-0.285-0.979-1.549-1.47-2.854c-1.101-3.018-3.505-5.381-6.193-6.114
                           c-1.063-0.285-2.729-1.02-3.669-1.63l-1.754-1.102L312.656,196.055z" />
              <path class="territory" data-id="577" id="Shahjahanpur" d="M230.848,198.338c-0.488,1.182-0.61,2.935-0.529,8.273c0.081,7.541-0.364,9.621-2.443,11.373
                           c-1.549,1.346-3.873,1.265-4.771-0.122c-0.407-0.57-1.427-1.386-2.282-1.834c-1.753-0.896-2.362-2.038-2.362-4.482
                           c0-0.856-0.163-1.59-0.327-1.59c-0.488,0-2.119,1.794-2.119,2.363c0,0.733-1.712,1.712-3.058,1.712
                           c-1.429,0-2.242-0.611-2.242-1.671c0-0.407-0.449-1.223-0.979-1.876l-0.978-1.141l-0.57,1.427c-0.326,0.774-1.101,1.997-1.672,2.69
                           c-0.652,0.733-1.1,1.793-1.1,2.445c0,2.242-0.896,4.28-2.609,6.114c-2.038,2.08-6.033,4.647-7.337,4.647
                           c-1.222,0-1.875,0.733-1.875,2.079c0,0.61-0.204,1.264-0.407,1.386c-0.813,0.489-2.161,3.669-2.08,4.892
                           c0.042,0.652,0.408,1.59,0.815,2.038c1.101,1.264,1.752,3.22,1.427,4.443c-0.244,1.019-2.446,3.098-3.261,3.098
                           c-0.57,0-5.869,2.282-6.236,2.69c-0.204,0.203-0.449,2.161-0.61,4.32l-0.243,3.994h1.467c1.467,0,2.647,0.693,5.055,2.895
                           c1.021,0.938,1.671,1.101,4.972,1.346l3.832,0.285l1.552-1.264c0.937-0.693,2.078-1.224,2.729-1.224
                           c1.834,0,2.405,1.264,2.405,5.381c0,4.321,0.326,5.258,2.242,6.4l1.467,0.855l0.612-1.427c0.73-1.794,0.73-2.323-0.204-5.625
                           c-0.449-1.672-1.186-3.261-1.834-3.914c-1.672-1.711-1.267-3.057,0.978-3.383c0.611-0.081,1.225-0.57,1.549-1.263
                           c0.448-0.938,0.774-1.102,2.323-1.102s1.875,0.163,2.404,1.102c0.408,0.814,1.223,1.385,2.647,1.875l2.12,0.733l3.142-2.935
                           l3.098-2.894l3.506,0.244l3.506,0.284l2.16-1.752l2.161-1.753l-0.204-2.242c-0.122-1.223-0.407-3.18-0.692-4.279
                           c-1.549-6.481-1.549-6.359-0.813-6.727c0.326-0.163,1.507-0.774,2.646-1.345c1.755-0.896,2.08-1.305,2.731-3.139
                           c0.938-2.771,1.142-2.976,5.014-5.502c1.793-1.184,3.709-2.609,4.239-3.18l0.938-1.061l-0.856-1.385
                           c-0.448-0.774-0.856-1.877-0.856-2.487c0-1.263,1.875-3.261,2.772-2.895c0.938,0.367,2.527-0.243,3.016-1.183
                           c0.286-0.488,0.489-2.854,0.531-5.543c0.081-4.483,0.041-4.729-0.979-5.829c-1.104-1.223-3.791-2.16-4.688-1.63
                           c-0.286,0.162-1.06,0.937-1.671,1.63c-0.815,1.019-1.427,1.345-2.446,1.345c-1.019,0-1.63-0.326-2.524-1.345
                           c-1.063-1.183-1.389-1.305-3.75-1.386c-1.47-0.082-2.813-0.286-3.06-0.53c-0.204-0.204-0.854-0.407-1.387-0.407
                           c-0.57,0-1.467-0.529-2.16-1.264l-1.182-1.262L230.848,198.338z" />
              <path class="territory" data-id="517" id="Aligarh" d="M63.156,214.521c-1.224,0.448-2.648,0.733-3.14,0.611c-0.896-0.163-0.937-0.082-0.689,1.753
                           c0.243,1.793,0.161,1.998-0.856,2.689c-1.019,0.653-1.183,0.653-2.364,0.082c-0.732-0.366-1.631-0.773-2.038-0.896
                           c-0.447-0.122-0.854-0.611-0.979-1.061c-0.245-0.979-0.448-0.979-2.568-0.162c-1.345,0.53-1.875,0.57-2.688,0.203
                           c-0.57-0.244-1.997-0.448-3.14-0.448c-1.184,0-2.363-0.204-2.607-0.448c-0.571-0.57-2.283,0.489-2.896,1.915
                           c-0.285,0.571-0.486,1.101-0.486,1.183c0,0.081,0.938,1.061,2.077,2.201c1.916,1.875,2.038,2.119,1.755,3.383
                           c-0.408,1.753-0.285,3.547,0.283,4.239c0.407,0.489,0.773,0.408,2.363-0.489c1.021-0.61,2.405-1.55,3.017-2.079
                           c1.511-1.223,1.916-1.182,3.75,0.285c1.183,0.938,1.957,1.224,3.263,1.224c1.385,0,1.875,0.203,2.402,1.02
                           c0.366,0.53,0.652,1.264,0.652,1.59c0,0.326,0.611,1.507,1.346,2.608c2.485,3.914,3.75,5.993,4.483,7.418l0.775,1.468l-1.47,2.488
                           c-2.24,3.791-1.916,5.869,1.021,7.011c1.183,0.448,1.916,2.649,1.142,3.546c-0.608,0.734,0.367,2.649,1.711,3.302
                           c1.43,0.693,4.158-0.244,7.42-2.444c1.998-1.346,2.322-1.753,2.119-2.487c-0.487-1.549-0.69-5.014-0.366-5.665
                           c0.204-0.326,1.674-1.753,3.222-3.139c2.648-2.364,2.935-2.486,4.278-2.242c0.773,0.163,2.038,0.326,2.813,0.367
                           c1.468,0.122,2.854,1.467,2.896,2.894c0,0.448,1.103,1.998,2.403,3.465l2.365,2.609l0.732-1.183c1.51-2.405,2.323-3.059,3.831-3.059
                           c2.364,0,3.059-0.367,3.792-1.956c0.365-0.815,1.143-2.568,1.711-3.833c0.57-1.263,1.063-2.485,1.063-2.73
                           c0-0.652,2.079-2.079,3.016-2.079c1.063,0,3.183,2.119,3.873,3.873c0.245,0.651,1.021,1.875,1.673,2.648l1.183,1.428l1.63-1.63
                           c1.834-1.754,2.161-3.384,1.062-4.853c-0.896-1.181-0.405-2.241,2.16-4.482c2.282-2.079,3.344-3.913,3.344-5.788
                           c0-0.611,0.364-1.672,0.813-2.405l0.815-1.345l-1.43-0.857c-0.813-0.488-2.08-0.854-2.854-0.854c-1.712,0-3.221-0.652-5.218-2.201
                           l-1.509-1.183l-0.938,0.855c-0.693,0.653-1.468,0.896-2.854,0.896c-2.362,0-3.75-0.814-4.769-2.894
                           c-0.979-1.834-1.468-2.08-3.019-1.265c-0.65,0.325-2.606,0.774-4.278,0.979c-2.568,0.286-3.301,0.57-4.32,1.548
                           c-0.653,0.612-1.916,1.59-2.771,2.161c-1.916,1.304-2.979,1.02-3.914-0.978c-0.489-0.979-1.388-1.794-3.385-2.854
                           c-2.565-1.386-2.771-1.468-3.343-0.815c-0.365,0.408-0.649,1.183-0.649,1.753c0,1.304-0.612,1.793-2.569,2.078
                           c-2.079,0.326-2.607,0.042-3.546-1.752c-0.53-1.021-1.549-1.998-2.936-2.813c-1.184-0.692-2.771-1.752-3.548-2.282
                           C65.682,213.461,66.009,213.461,63.156,214.521z" />
              <path class="territory" data-id="535" id="Etah"
                d="M126.336,226.423c0,0.285-0.285,0.773-0.611,1.06c-0.327,0.285-0.61,0.896-0.61,1.387
                           c0,2.241-0.979,4.116-3.342,6.521c-2.08,2.079-2.403,2.567-1.998,3.179c0.244,0.408,0.447,1.55,0.447,2.568
                           c0,1.671-0.203,2.079-1.916,3.913l-1.956,2.08l1.144,0.977c0.896,0.735,1.63,0.979,3.18,0.979c1.304,0,2.729,0.367,4.116,1.019
                           c1.142,0.571,2.485,1.021,2.935,1.021c1.021,0,3.465,1.426,3.75,2.201c0.122,0.284,1.427,1.875,2.938,3.506
                           c2.159,2.322,3.342,3.22,5.625,4.279c1.589,0.733,3.139,1.671,3.465,2.078c0.691,0.938,4.156,2.201,5.218,1.916
                           c0.57-0.163,0.813-0.733,0.979-2.445c0.245-2.404,1.266-3.954,3.1-4.646c1.06-0.449,2.894,0.447,2.894,1.426
                           c0,0.611,3.628,3.18,5.869,4.076c0.856,0.367,2.323,0.652,3.222,0.652c1.833,0,4.359-0.775,4.359-1.345
                           c0-0.204-1.182-1.59-2.647-3.099c-2.038-2.119-2.649-3.016-2.649-3.954c0-1.753,0.449-2.161,3.302-3.22l2.608-0.938l-0.041-1.916
                           c-0.041-1.672-0.286-2.161-1.712-3.587c-1.875-1.877-2.938-2.12-10.231-2.528c-2.241-0.163-4.44-0.529-5.217-0.896
                           c-1.223-0.569-3.139-2.607-6.646-7.011c-0.854-1.1-1.469-1.385-3.668-1.752c-1.469-0.204-2.813-0.57-3.058-0.774
                           c-0.204-0.203-0.651-0.366-1.019-0.366c-1.429,0-5.992-2.649-8.233-4.771C127.685,225.893,126.336,225.281,126.336,226.423z" />
              <path class="territory" data-id="569" id="Mathura" d="M49.296,228.258c0,0.488-3.018,2.525-4.771,3.261c-1.184,0.489-1.468,0.448-2.363-0.123
                           c-2.079-1.385-4.198,0.286-3.385,2.691c0.325,0.896,0.204,1.345-0.529,2.323c-1.183,1.631-2.526,1.631-3.668,0.04l-0.938-1.223
                           l-1.223,0.979c-1.712,1.264-5.054,2.934-6.686,3.301c-0.732,0.163-1.63,0.733-1.998,1.264c-0.609,0.979-0.609,1.061,0.448,2.12
                           c1.266,1.386,1.386,3.302,0.326,5.421c-0.408,0.815-0.652,1.672-0.57,1.916c0.082,0.246,0.979,0.857,1.957,1.386
                           c2.445,1.224,2.854,1.712,2.282,2.977c-0.327,0.692-0.813,1.019-1.508,1.019c-1.223,0-1.345,0.815-0.204,1.834l0.856,0.774
                           l-1.104,0.855c-1.507,1.184-1.141,2.079,2.487,5.87c3.546,3.75,3.954,4.442,3.627,6.44c-0.204,1.427-0.081,1.671,1.55,3.22
                           c1.182,1.182,2.283,1.793,3.384,1.998c1.548,0.244,4.278,2.283,4.278,3.179c0,0.53,1.753,1.875,2.487,1.916
                           c0.324,0,0.979-0.284,1.426-0.61c0.408-0.326,1.102-0.611,1.469-0.611c0.57,0,0.611,0.204,0.325,1.223
                           c-0.203,0.693-0.692,1.671-1.143,2.242c-1.183,1.509-1.834,4.28-1.347,5.625c0.407,1.02,0.53,1.061,1.347,0.611
                           c0.487-0.285,1.265-0.938,1.673-1.427c0.691-0.856,1.06-0.938,4.563-0.856c3.506,0.082,3.872,0,5.381-1.019
                           c1.916-1.305,3.952-1.794,4.812-1.102c0.487,0.408,0.732,0.244,1.468-0.979c0.53-0.896,1.183-1.468,1.63-1.468
                           c1.346,0,3.018,1.102,3.548,2.283c0.609,1.266,0.773,1.184,1.304-0.61c0.286-0.979,0.204-1.346-0.324-1.753
                           c-1.021-0.773-2.12-2.607-2.12-3.547c0-0.447,0.49-1.385,1.061-2.078c0.938-1.061,1.063-1.55,0.855-3.098
                           c-0.082-1.019-0.489-2.161-0.855-2.568c-0.407-0.448-0.65-1.468-0.65-2.854c0-1.141-0.286-2.69-0.653-3.383
                           c-0.569-1.102-0.61-1.549-0.204-2.649c0.531-1.426,0.327-2.16-0.529-2.16c-1.792,0-4.033-3.912-3.18-5.585
                           c0.489-0.977,0.163-1.752-0.732-1.752c-0.406,0-1.224-0.57-1.834-1.305c-1.02-1.181-1.102-1.549-0.896-3.587
                           c0.122-1.631,0.53-2.813,1.426-4.076c1.104-1.59,1.186-1.916,0.652-2.486c-0.326-0.326-0.57-0.814-0.57-1.061
                           c0-0.448-1.712-3.179-3.954-6.439c-0.609-0.896-1.223-2.201-1.345-2.854c-0.204-1.141-0.367-1.222-2.364-1.508
                           c-1.55-0.163-2.525-0.57-3.303-1.304C49.826,227.849,49.296,227.646,49.296,228.258z" />
              <path class="territory" data-id="583" id="Shravasti" d="M364.465,234.533c-0.204,0.245-0.53,0.896-0.651,1.387c-0.407,1.345-1.997,2.161-5.341,2.689
                           c-1.672,0.246-3.057,0.653-3.057,0.896c0,0.245,0.486,1.101,1.06,1.957c0.571,0.855,1.264,2.69,1.59,4.158
                           c0.611,3.097,0.815,3.464,1.794,3.464c1.182,0,1.752,1.019,1.916,3.302c0.12,1.55-0.041,2.324-0.652,3.139
                           c-0.65,0.938-0.732,1.387-0.365,3.14c0.204,1.101,0.324,2.485,0.283,3.058c-0.119,0.937,0,1.019,2.079,1.223
                           c1.957,0.163,2.324,0.367,2.896,1.427c0.367,0.651,1.021,1.305,1.467,1.386c0.408,0.041,1.063,0.366,1.388,0.651
                           c0.326,0.285,1.429,0.651,2.446,0.814c1.019,0.163,2.281,0.571,2.854,0.938c0.528,0.325,1.631,0.652,2.443,0.732
                           c1.672,0.082,6.399,1.143,6.769,1.508c0.122,0.122,0.407,0.979,0.61,1.916c0.446,1.916,0.081,2.854-1.427,3.669
                           c-0.815,0.407-0.938,0.651-0.61,1.101c0.69,0.773,1.752,0.651,2.647-0.326c0.57-0.653,1.101-0.813,2.078-0.653
                           c1.835,0.326,2.729-0.733,2.12-2.487c-0.244-0.692-0.692-1.345-1.021-1.468c-0.365-0.163-0.567-0.814-0.567-2.038
                           c0-1.589,0.161-1.956,1.549-3.016c1.387-1.143,1.428-1.264,0.69-1.508c-2.159-0.734-5.136-2.446-5.666-3.263
                           c-0.527-0.773-0.406-1.019,2.038-3.464c1.389-1.467,3.345-3.383,4.32-4.279c2.037-1.875,3.099-4.524,2.363-5.91
                           c-0.529-1.02,0.246-2.324,2.282-3.872c1.672-1.265,1.754-2.121,0.325-2.65c-0.568-0.244-1.834-1.062-2.771-1.834
                           c-0.979-0.773-1.916-1.426-2.078-1.426c-0.328,0-1.794-0.897-4.729-2.894c-0.569-0.367-1.875-0.815-2.854-0.938
                           c-1.591-0.204-2.039-0.081-4.037,1.305c-1.182,0.814-2.813,2.323-3.586,3.343c-0.771,1.019-1.55,1.875-1.714,1.955
                           c-0.161,0.082-1.181-1.141-2.2-2.729c-1.426-2.119-2.2-2.894-3.098-3.098c-0.651-0.122-1.631-0.611-2.161-1.061
                           C365.116,234.208,364.791,234.127,364.465,234.533z" />
              <path class="territory" data-id="549" id="Hathras" d="M107.423,240.199c-0.366,0.489-0.652,1.224-0.652,1.59s-0.244,0.896-0.526,1.143
                           c-0.327,0.244-0.775,1.181-1.063,2.119c-1.142,3.832-2.16,4.729-5.421,4.811c-1.305,0.041-1.712,0.285-2.813,1.752
                           c-1.467,2.038-2.117,2.486-3.18,2.16c-1.263-0.406-5.666-5.625-5.828-6.929c-0.123-1.06-0.367-1.223-2.362-1.671
                           c-1.226-0.285-2.364-0.53-2.487-0.57c-0.123,0-1.385,1.102-2.771,2.405c-2.813,2.649-2.813,2.649-1.834,7.296
                           c0.204,1.101,0.082,1.549-0.691,2.364c-0.488,0.53-1.102,0.979-1.266,0.979c-0.203,0-1.183,0.53-2.12,1.183
                           c-0.978,0.692-2.24,1.345-2.854,1.507c-0.855,0.204-1.345,0.734-1.916,2.08c-0.692,1.631-0.692,1.916-0.163,2.976
                           c0.326,0.651,0.611,1.997,0.611,2.936c0,0.977,0.366,2.485,0.813,3.383c1.183,2.283,1.062,4.892-0.204,6.563
                           c-0.855,1.101-0.979,1.549-0.651,2.16c0.449,0.774,0.487,0.774,2.485-0.203c2.364-1.143,3.181-1.223,3.507-0.367
                           c0.161,0.326,0.854,0.896,1.59,1.264c1.181,0.531,1.548,0.57,2.525,0.082c0.61-0.285,1.469-1.224,1.875-2.079
                           c0.773-1.672,1.265-1.834,2.607-0.896c0.813,0.57,1.061,0.57,2.647-0.041c2.323-0.896,4.117-2.568,3.548-3.261
                           c-0.285-0.367-0.244-0.773,0.202-1.468c0.489-0.773,0.531-1.263,0.163-2.607c-0.528-1.876-0.243-3.017,0.651-3.017
                           c0.327,0,1.957-1.02,3.587-2.242c1.632-1.223,3.627-2.405,4.442-2.649c0.772-0.203,2.202-1.06,3.18-1.916
                           c1.469-1.223,1.875-1.386,2.487-1.019c1.344,0.815,6.766-1.385,9.497-3.954c0.65-0.57,1.426-1.671,1.711-2.365
                           c0.813-1.875,0.204-3.342-2.854-7.051c-1.346-1.671-2.647-3.424-2.813-3.872c-0.489-1.386-2.038-3.465-2.568-3.465
                           C108.28,239.304,107.748,239.711,107.423,240.199z" />
              <path class="territory" data-id="576" id="Sitapur" d="M304.179,240.158c-0.246,0.245-1.59,1.02-3.02,1.754c-1.753,0.896-2.936,1.834-3.625,2.853l-0.979,1.549
                           l-2.485-0.245c-1.347-0.122-3.547-0.325-4.893-0.407c-1.345-0.04-2.771-0.162-3.138-0.203c-0.367,0-1.226-0.489-1.916-1.061
                           c-1.47-1.264-2.487-1.101-4.647,0.734c-1.385,1.141-1.589,1.59-1.793,3.627c-0.163,1.509-0.448,2.404-0.854,2.568
                           c-1.226,0.447-3.305-0.326-5.017-1.875c-1.956-1.794-2.199-1.794-5.461,0.041c-1.101,0.61-2.771,1.345-3.669,1.631
                           c-0.896,0.284-2.038,0.896-2.566,1.344c-0.651,0.611-1.508,0.896-2.689,0.896c-2.283,0-2.771,0.489-3.669,3.425
                           c-0.652,2.2-0.652,2.486-0.081,3.628c0.367,0.691,0.653,1.956,0.653,2.812s0.364,2.528,0.731,3.75
                           c0.651,1.875,1.062,2.365,2.978,3.668c1.304,0.856,2.729,2.283,3.505,3.506c0.691,1.102,1.753,2.486,2.322,3.058
                           c0.569,0.569,1.062,1.263,1.062,1.467c0,0.245,0.692,1.916,1.507,3.668c0.815,1.753,1.551,3.914,1.59,4.769
                           c0.122,1.916,0.367,2.201,1.266,1.428c0.896-0.774,3.18-1.957,3.792-1.957c0.244,0,1.426,0.896,2.566,1.998
                           c2.607,2.485,3.669,2.894,7.053,2.894c3.912,0,6.112,0.693,7.297,2.242c0.569,0.693,1.02,1.426,1.02,1.59
                           c0,0.733,2.608,6.767,2.938,6.767c0.201,0,1.263-0.447,2.362-1.019c2.404-1.226,3.262-2.69,3.18-5.302
                           c-0.081-1.67,0.082-2.079,1.021-2.894c0.772-0.652,1.63-0.979,2.647-0.938c1.672,0,4.852,0.53,5.788,0.938
                           c0.407,0.162,0.938-0.245,1.63-1.265c1.145-1.712,4.199-3.791,5.546-3.791c0.488,0,2.077,0.612,3.587,1.345
                           c2.484,1.266,2.729,1.306,3.303,0.693c0.366-0.408,0.61-1.467,0.61-2.528c0-1.589,0.202-2.079,1.508-3.301
                           c3.221-3.139,5.503-3.017,6.768,0.326c1.713,4.523,2.445,5.258,2.896,2.771c0.162-0.855,0.73-2.242,1.305-3.098l1.019-1.548
                           l-1.467-1.672c-1.144-1.346-1.428-2.039-1.428-3.384c0-1.631-1.021-4.157-2.2-5.463c-0.896-1.021-1.875-3.506-1.875-4.85
                           c0-0.653-0.326-1.468-0.733-1.834c-0.528-0.489-0.731-1.345-0.772-3.099c-0.122-3.709-1.672-6.358-4.035-6.808
                           c-0.732-0.123-1.631-0.569-1.997-0.978c-0.651-0.734-0.61-0.897,0.569-2.65c0.692-1.019,1.266-1.998,1.266-2.16
                           c-0.081-0.773-3.1-2.12-5.381-2.364c-1.427-0.123-3.384-0.652-4.401-1.143c-1.02-0.488-2.977-1.223-4.36-1.63
                           c-1.509-0.489-2.607-1.06-2.729-1.427c-0.123-0.366-0.284-1.264-0.448-1.997c-0.243-1.102-0.447-1.304-1.387-1.304
                           C305.115,239.711,304.424,239.915,304.179,240.158z" />
              <path class="territory" data-id="528" id="Balrampur" d="M397.808,243.746c0,0.407-0.61,1.264-1.305,1.834c-0.732,0.61-1.592,1.264-1.875,1.507
                           c-0.326,0.286-0.449,0.856-0.326,1.469c0.609,2.282-1.589,6.766-4.077,8.314c-0.731,0.448-2.118,1.712-3.057,2.854
                           c-1.632,1.957-1.673,2.079-0.938,2.608c0.448,0.326,1.673,0.896,2.731,1.264c2.402,0.815,3.179,2.08,2.198,3.588
                           c-0.363,0.529-1.061,1.1-1.508,1.263c-0.896,0.286-1.183,2.365-0.408,2.854c0.408,0.245,1.633,2.854,1.633,3.465
                           c0,0.163-0.448,0.938-0.979,1.711c-0.938,1.427-0.938,1.467-0.203,2.12c0.448,0.366,0.772,0.896,0.772,1.223
                           c0,0.327,0.65,1.386,1.47,2.323c1.468,1.753,3.22,2.813,4.646,2.813c0.406,0,0.938,0.285,1.223,0.61
                           c0.285,0.326,0.854,0.612,1.265,0.612c0.813,0,1.793,1.793,1.347,2.486c-0.122,0.245-0.284,2.69-0.366,5.462
                           c-0.123,4.565-0.041,5.095,0.609,5.298c0.408,0.123,2.161,1.51,3.913,3.059c1.794,1.551,3.385,2.854,3.547,2.854
                           c0.163,0,0.856,0.407,1.55,0.896l1.265,0.938l1.387-1.51c0.773-0.855,1.387-1.874,1.387-2.282s0.448-1.631,0.979-2.771
                           c0.529-1.102,1.183-2.688,1.428-3.545c0.813-2.487,1.834-2.895,6.275-2.528l3.751,0.286l-1.103-1.182
                           c-0.938-0.978-1.143-1.549-1.143-3.22c0-1.916-0.123-2.12-1.875-3.588c-1.671-1.428-1.834-1.71-1.632-2.854
                           c0.572-2.813,2.406-6.644,4.036-8.273c2.119-2.201,2.937-2.486,4.115-1.386c1.591,1.468,8.604,2.283,9.579,1.101
                           c0.285-0.326,1.143-0.692,1.916-0.856l1.428-0.244l-1.225-1.386c-1.793-2.038-2.038-3.913-0.73-5.87l1.019-1.549l-0.979-2.813
                           c-0.528-1.55-1.184-3.181-1.386-3.628c-0.651-1.467-0.938-2.813-1.021-4.605c-0.041-0.938-0.162-1.794-0.244-1.916
                           c-0.122-0.082-1.021,0.041-1.996,0.244c-1.021,0.246-2.566,0.327-3.467,0.204c-1.1-0.122-2.159,0.042-3.261,0.57
                           c-1.063,0.489-3.425,0.896-6.851,1.183c-6.112,0.529-6.479,0.407-9.82-2.978c-3.468-3.505-10.068-8.151-12.188-8.56
                           C398.012,242.972,397.808,243.013,397.808,243.746z" />
              <path class="territory" data-id="548" id="Hardoi"
                d="M236.189,251.165c-2.936,2.444-3.221,2.526-6.604,2.2c-3.506-0.325-3.995-0.082-7.255,3.344
                           c-1.185,1.223-2.446,2.16-2.896,2.16c-1.549,0-5.666-1.916-6.072-2.813c-0.529-1.182-1.306-1.06-2.525,0.367
                           c-0.53,0.651-1.347,1.222-1.793,1.222c-0.734,0-0.734,0.082,0.204,1.509c0.528,0.856,1.304,2.977,1.712,4.688
                           c0.65,2.935,0.65,3.302,0.041,5.503c-0.367,1.304-0.734,3.342-0.856,4.523c-0.122,1.184-0.488,2.527-0.854,3.018
                           c-0.897,1.304-0.775,2.935,0.364,4.604c1.47,2.12,1.714,4.321,0.732,6.44c-1.304,2.813-1.304,2.935,0,4.525
                           c0.815,1.019,1.55,1.467,2.283,1.467c0.609,0,2.364,0.651,3.873,1.426c1.548,0.734,3.79,1.59,5.013,1.875
                           c1.834,0.408,2.446,0.815,3.791,2.405c0.896,1.06,1.753,2.444,1.916,3.099c0.326,1.426,3.668,8.151,4.198,8.479
                           c0.204,0.123,0.487,0.854,0.61,1.591c0.122,0.73,0.773,1.875,1.428,2.485c1.183,1.101,1.223,1.142,2.565,0.487
                           c1.754-0.896,2.938-1.875,3.547-3.058c0.692-1.264,2.241-0.854,3.953,1.101c1.266,1.47,1.266,1.47,2.324,0.774
                           c0.611-0.367,1.182-1.224,1.346-1.834c0.122-0.61,0.285-1.305,0.366-1.591c0.245-0.813,2.119-1.834,3.75-2.037
                           c1.347-0.163,1.712-0.041,2.813,1.184c0.69,0.731,1.59,2.159,1.957,3.178c0.406,0.979,1.304,2.488,1.998,3.304
                           c0.731,0.815,1.63,1.998,2.036,2.567c0.406,0.568,0.896,1.062,1.144,1.062c0.69,0,3.26-2.978,3.994-4.688
                           c0.938-2.119,1.304-2.36,4.729-3.545c2.283-0.813,3.384-1.509,5.38-3.466c2.813-2.729,4.771-3.505,7.744-3.097
                           c1.469,0.202,1.916,0.039,3.183-0.979c1.264-1.063,1.712-1.226,3.302-1.021c1.427,0.163,1.834,0.041,2.038-0.489
                           c0.204-0.569-1.55-5.991-2.649-7.989c-0.65-1.263-3.017-2.038-6.277-2.038c-3.829,0-5.339-0.571-7.946-3.017l-1.997-1.875
                           l-1.508,1.019c-3.101,2.079-4.771,1.59-4.935-1.467c-0.042-0.979-0.65-3.057-1.346-4.607c-0.733-1.548-1.304-2.934-1.304-3.097
                           c0-0.204-0.652-1.101-1.428-2.039c-0.774-0.938-1.428-1.875-1.428-2.079c0-0.692-3.26-3.954-4.48-4.442
                           c-1.916-0.815-3.019-3.14-3.669-7.745c-0.162-1.224-0.53-2.813-0.855-3.546c-0.448-1.102-0.408-1.589,0.245-3.587l0.814-2.283
                           l-1.021-0.774c-0.571-0.408-1.834-0.979-2.854-1.264c-1.02-0.245-2.443-0.775-3.181-1.102c-1.1-0.488-1.671-0.528-2.854-0.162
                           c-1.348,0.407-1.632,0.366-2.938-0.529c-0.813-0.571-1.549-1.021-1.672-1.021C238.307,249.494,237.288,250.227,236.189,251.165z" />
              <path class="territory" data-id="536" id="Kasganj" d="M118.795,251.654c0.285,1.102-0.735,3.791-1.958,5.137c-2.323,2.525-9.13,5.707-11.005,5.095
                           c-0.408-0.124-1.306,0.244-2.242,0.938c-0.814,0.652-2.161,1.386-2.978,1.632c-0.813,0.202-2.936,1.508-4.77,2.812
                           c-2.73,1.998-3.26,2.528-3.016,3.22c0.163,0.448,0.242,1.591,0.203,2.528c-0.04,1.059,0.08,1.752,0.365,1.752
                           c0.244,0,0.773,0.285,1.184,0.652c0.528,0.448,1.916,0.652,5.707,0.774c6.357,0.204,9.09,0.652,11.332,1.752l1.754,0.854
                           l-0.286-0.896c-0.489-1.386-0.326-3.994,0.286-4.524c0.285-0.285,1.548-0.815,2.771-1.224c1.226-0.447,2.608-1.1,3.101-1.507
                           c0.446-0.448,1.019-0.774,1.222-0.774c0.204,0,0.571-0.326,0.854-0.774c0.611-0.978,2.486-1.345,4.36-0.815
                           c2.08,0.571,2.487,1.591,1.55,3.711l-0.732,1.752l1.223,1.631c0.693,0.938,1.834,2.038,2.486,2.444
                           c0.691,0.449,1.468,1.387,1.753,2.038c0.979,2.12,2.12,2.69,4.646,2.242c2.567-0.489,3.222-1.223,3.791-4.442
                           c0.365-1.997,0.61-2.404,2.445-3.913c1.143-0.896,2.813-1.915,3.792-2.201c1.588-0.529,1.875-0.529,3.058,0.163
                           c0.732,0.408,1.631,1.101,1.997,1.59c0.488,0.57,1.185,0.856,2.445,0.896c0.979,0.042,3.75,0.204,6.155,0.367
                           c3.873,0.285,4.441,0.448,4.85,1.183c0.246,0.488,1.47,1.997,2.691,3.383c1.67,1.957,2.524,2.607,3.668,2.812
                           c1.223,0.245,1.589,0.123,2.241-0.691l0.771-0.979l-1.426-1.223c-1.143-0.979-1.467-1.59-1.549-2.977
                           c-0.082-0.938,0.082-1.916,0.365-2.2c0.286-0.286,0.49-0.693,0.49-0.979c0-0.246,0.284-0.693,0.61-0.979s0.61-0.979,0.61-1.591
                           c-0.042-1.549-1.428-4.36-2.567-5.095c-0.855-0.611-1.144-0.611-2.729-0.041c-2.363,0.815-4.893,0.775-7.378-0.163
                           c-2.566-1.019-6.398-3.586-6.686-4.604c-0.692-2.161-3.059,0.488-3.059,3.423c0,1.917-0.042,2.039-1.508,2.607
                           c-1.387,0.611-1.672,0.571-3.75-0.122c-1.265-0.406-2.813-1.223-3.506-1.834c-0.692-0.569-2.242-1.508-3.466-2.078
                           c-1.711-0.733-3.261-2.038-6.398-5.3c-2.977-3.139-4.441-4.36-5.136-4.36c-0.53,0-1.916-0.448-3.059-1.02
                           c-1.306-0.61-2.813-1.02-3.953-1.02C118.713,250.717,118.591,250.799,118.795,251.654z" />
              <path class="territory" data-id="539" id="Farrukhabad" d="M167.302,254.181c-0.896,0.326-1.672,0.611-1.712,0.611c-0.082,0-0.123,0.367-0.123,0.814
                           c0,0.449,1.101,1.875,2.446,3.221c1.304,1.304,2.524,2.854,2.646,3.383c0.122,0.53,0.774,1.223,1.386,1.59
                           c1.51,0.896,3.304,4.525,3.304,6.726c0,0.979-0.163,1.834-0.367,1.998c-0.611,0.367-1.67,2.69-1.67,3.668
                           c0,0.53,0.448,1.224,1.02,1.59c1.508,0.978,1.957,2.118,1.467,3.506c-0.202,0.651-0.242,1.304-0.038,1.426
                           c0.201,0.123,0.73,1.427,1.222,2.894c0.979,2.936,2.813,5.341,4.321,5.707c0.528,0.123,1.304,0.897,1.793,1.672l0.854,1.428
                           l3.18-0.285c2.978-0.245,3.345-0.204,4.483,0.651c0.856,0.611,1.265,1.265,1.265,1.998c0,1.427,0.691,2.037,2.282,2.037
                           c0.693,0,2.079,0.287,3.06,0.652c2.322,0.814,3.952,0.49,5.827-1.182c1.307-1.101,1.592-1.631,1.755-3.303
                           c0.161-1.223,0.938-3.423,2.036-5.503c1.917-3.791,1.998-4.932,0.49-7.092c-0.449-0.611-0.938-1.956-1.142-2.975
                           c-0.326-1.673-0.245-2.08,0.609-3.344c0.569-0.774,0.979-1.997,0.979-2.771c0-1.224-0.204-1.468-2.08-2.405
                           c-2.688-1.386-3.219-2.65-3.219-7.542c0-4.28-0.489-4.932-2.406-3.097c-1.426,1.344-2.893,1.588-7.784,1.181
                           c-3.466-0.286-3.914-0.407-4.28-1.264c-0.202-0.489-0.772-1.02-1.224-1.142c-0.448-0.162-1.182-0.61-1.63-1.019
                           c-0.692-0.611-1.63-0.775-4.769-0.856c-3.345-0.122-4.118-0.244-5.179-1.06c-0.691-0.489-1.712-0.896-2.321-0.896
                           c-0.611,0-1.429-0.285-1.795-0.611C170.969,253.691,169.094,253.488,167.302,254.181z" />
              <path class="territory" data-id="579" id="Sidharth Nagar" d="M441.26,267.388c-1.062,1.468-1.102,1.753-0.65,3.058c0.245,0.813,0.65,1.468,0.855,1.468
                           c0.648,0,1.67,1.997,1.386,2.813c-0.123,0.448-0.896,1.019-1.755,1.303c-0.813,0.285-1.914,0.775-2.444,1.102
                           c-1.346,0.855-7.785,0.408-9.985-0.733l-1.59-0.814l-1.265,1.059c-0.854,0.693-1.752,2.202-2.649,4.403l-1.385,3.302l1.874,1.671
                           c1.753,1.508,1.876,1.794,1.876,3.587c0,1.631,0.245,2.242,1.264,3.383c1.143,1.306,1.184,1.509,0.651,2.283
                           c-0.569,0.856-0.896,0.896-4.81,0.774c-3.06-0.082-4.239,0-4.483,0.408c-0.61,0.896-0.407,1.1,1.386,1.345
                           c3.019,0.447,7.5,3.14,8.274,5.015c0.041,0.08,0.693-0.162,1.427-0.447c0.773-0.325,2.648-0.896,4.159-1.266
                           c2.566-0.61,3.015-0.61,5.5,0c3.221,0.814,3.385,0.938,4.853,3.832c0.651,1.265,1.592,2.444,2.16,2.729
                           c0.569,0.285,2.648,1.265,4.646,2.16l3.589,1.671l0.896-0.813c0.487-0.488,1.428-0.855,2.078-0.855c0.855,0,1.631-0.487,2.854-1.793
                           c2.037-2.2,5.298-4.482,7.418-5.176c2.646-0.856,3.384-1.551,3.384-3.059c0-0.775,0.243-2.446,0.569-3.751
                           c0.327-1.265,0.732-3.058,0.938-3.914c0.285-1.346,0.651-1.793,2.119-2.69c1.019-0.571,2.445-1.875,3.179-2.854
                           c4.159-5.625,4.444-6.768,2.69-10.19c-1.021-1.997-1.469-2.405-3.914-3.628c-2.566-1.303-3.097-1.385-7.338-1.548
                           c-2.484-0.082-5.42,0.081-6.479,0.326c-2.16,0.489-2.854,0.204-5.91-2.567c-1.916-1.712-2.362-1.793-9.01-1.549
                           c-3.016,0.082-3.505,0-4.318-0.774l-0.938-0.896L441.26,267.388z" />
              <path class="territory" data-id="564" id="Maharajganj"
                d="M490.459,269.346c0.731,3.709,0.772,6.154,0.082,7.173c-0.979,1.508-4.771,4.321-6.441,4.811
                           c-0.773,0.203-1.548,0.774-1.792,1.305c-1.103,2.323-5.462,7.582-6.93,8.273c-1.389,0.692-1.592,0.979-1.794,2.609
                           c-0.163,1.019-0.489,2.567-0.733,3.464s-0.448,2.283-0.448,3.099v1.469l3.384,0.938c3.344,0.938,4.975,1.916,5.424,3.346
                           c0.323,1.102,0.896,0.896,2.482-0.896c1.632-1.795,4.28-2.937,5.059-2.162c0.568,0.569-0.082,2.813-1.51,5.301
                           c-1.754,3.018-1.876,3.71-0.979,4.605c0.651,0.651,1.386,0.813,3.709,0.813h2.854l2.364,2.201c2.079,2.037,2.567,2.283,4.934,2.647
                           l2.648,0.449l1.834-1.793c2.854-2.771,4.116-3.265,8.314-3.304c3.261-0.041,3.71-0.163,4.36-0.979
                           c0.691-0.814,0.732-1.428,0.528-4.893l-0.285-3.913l2.526-5.869c1.998-4.646,2.445-6.114,2.242-7.175
                           c-0.162-1.019,0.043-1.834,0.979-3.505c0.692-1.223,1.632-3.668,2.119-5.462c0.814-3.098,0.814-3.261,0.123-3.791
                           c-1.713-1.304-4.24-2.526-7.664-3.791c-2.08-0.773-5.014-2.242-6.726-3.424l-3.06-2.12l-8.927-0.286l-8.928-0.325L490.459,269.346z" />
              <path class="territory" data-id="538" id="Firozabad" d="M123.484,269.793c-0.327,0.122-1.387,0.814-2.281,1.59c-0.938,0.732-2.813,1.752-4.158,2.2
                           c-2.568,0.856-3.301,1.794-2.486,3.261c0.693,1.346,0.449,2.813-0.65,3.302c-0.855,0.366-1.306,0.285-3.019-0.61
                           c-1.101-0.611-2.526-1.102-3.22-1.102c-0.692,0-1.753-0.204-2.405-0.449c-0.61-0.244-1.957-0.284-3.016-0.163
                           c-1.875,0.286-1.916,0.286-2.201,2.079c-0.286,1.958-1.184,2.854-3.261,3.262c-1.43,0.244-2.242,1.793-2.242,4.198
                           c0,0.733-0.286,2.364-0.653,3.586c-0.771,2.649-0.61,9.091,0.285,10.148c0.734,0.854,3.139,0.488,5.259-0.855
                           c2.364-1.508,3.423-1.671,4.483-0.61c0.938,0.938,0.854,2.485-0.203,3.668c-0.489,0.53-0.286,0.611,1.548,0.733
                           c2.487,0.122,2.731,0.285,3.913,2.813c0.489,1.059,1.265,2.607,1.672,3.383l0.774,1.429l3.099-0.123l3.057-0.081l0.815,1.305
                           c0.53,0.896,1.304,1.51,2.323,1.794c1.304,0.367,1.711,0.772,2.646,2.729c0.938,1.955,1.308,2.322,2.202,2.322
                           c0.57,0,1.589-0.367,2.242-0.854c1.223-0.855,2.688-0.896,5.992-0.082c0.896,0.205,0.978,0.123,0.813-1.307
                           c-0.122-1.428,0-1.631,1.875-2.895l1.956-1.386l-2.483-2.404c-2.405-2.282-2.487-2.446-2.487-4.403c0-2.198,0.813-3.342,2.895-4.154
                           c0.611-0.204,1.511-0.979,1.997-1.673l0.938-1.304l-1.916,0.285c-2.079,0.326-3.505-0.285-4.362-1.875
                           c-0.366-0.734-0.286-1.021,0.571-1.957c0.57-0.57,1.141-1.792,1.263-2.69c0.449-2.649-2.038-10.802-3.057-10.149
                           c-0.204,0.123-0.693-0.53-1.185-1.467c-0.446-0.897-1.264-1.917-1.753-2.243c-1.507-0.978-4.439-4.81-4.235-5.501
                           c0.122-0.326,0.486-1.306,0.854-2.12c0.571-1.346,0.571-1.509,0.041-1.305c-0.326,0.163-0.854,0.081-1.142-0.163
                           C124.339,269.753,123.809,269.671,123.484,269.793z" />
              <path class="territory" data-id="568" id="Mainpuri"
                d="M146.228,273.503c-3.342,1.671-3.914,2.323-4.239,4.81c-0.365,3.18-2.036,5.014-4.77,5.299l-1.957,0.244
                           l0.286,1.672c0.122,0.896,0.448,2.038,0.691,2.487c0.244,0.448,0.448,2.079,0.448,3.668c0,2.323-0.163,3.099-0.896,4.158
                           c-1.183,1.671-0.53,2.282,2.039,1.915c1.63-0.244,1.916-0.123,2.484,0.69c0.611,0.857,0.611,1.021-0.245,2.529
                           c-0.487,0.896-1.508,1.957-2.199,2.323c-2.16,1.142-2.568,1.63-2.568,3.097c0,1.021,0.285,1.631,1.101,2.324
                           c2.08,1.672,3.386,3.221,3.629,4.239c0.243,0.938,0.366,0.978,2.364,0.692c3.1-0.448,7.255-0.246,7.866,0.365
                           c0.285,0.284,0.611,0.938,0.733,1.426c0.447,2.324,1.712,2.283,4.811-0.162c3.221-2.485,5.625-3.18,10.068-2.854
                           c5.829,0.447,8.723,0.854,9.66,1.387c0.487,0.284,1.998,0.487,3.343,0.487c2.16,0,2.525-0.123,3.138-1.021
                           c0.326-0.529,0.53-1.184,0.408-1.387c-0.164-0.244,0.163-1.101,0.693-1.957c2.077-3.344,2.117-3.75,0.69-7.703
                           c-1.06-2.977-1.183-3.792-0.813-4.811c0.365-1.061,0.283-1.346-0.611-2.284c-0.57-0.57-1.019-1.263-1.019-1.548
                           c0-0.246-0.449-0.571-1.021-0.733c-1.59-0.407-3.71-3.221-4.892-6.481c-0.815-2.16-1.268-2.935-1.674-2.771
                           c-1.385,0.529-4.318-0.366-5.909-1.794c-0.855-0.773-1.591-1.712-1.591-1.997c0-0.325-0.161-0.569-0.405-0.569
                           c-0.204,0-0.815-0.612-1.306-1.387c-0.896-1.345-0.896-1.345-4.975-1.63c-2.281-0.163-5.014-0.365-6.113-0.407
                           c-1.51-0.081-2.16-0.284-2.771-1.06c-0.611-0.733-2.609-2.12-2.937-2.038C147.777,272.768,147.043,273.095,146.228,273.503z" />
              <path class="territory" data-id="515" id="Agra" d="M91.24,277.742c-1.955,1.712-5.299,2.934-6.438,2.363c-1.062-0.569-1.264-0.569-1.264,0.082
                           c0,0.814-2.079,2.609-3.385,2.896c-1.265,0.284-3.71-0.367-4.852-1.306c-1.06-0.896-3.342,0.082-3.017,1.306
                           c0.121,0.447,0,1.63-0.245,2.607c-0.57,2.242-1.834,2.977-3.385,1.957c-0.569-0.366-1.021-0.937-1.021-1.263
                           c0-0.326-0.367-0.775-0.773-1.02c-1.061-0.529-1.142-0.529-1.386,0.366c-0.082,0.408-0.649,1.061-1.223,1.427
                           c-0.814,0.57-1.184,0.57-2.038,0.204c-1.063-0.488-1.103-0.448-4.403,1.427c-1.1,0.651-2.2,0.814-5.054,0.814l-3.668,0.04
                           l-0.204,2.65c-0.204,2.567-0.245,2.648-1.549,3.057c-1.144,0.326-1.347,0.612-1.589,1.956c-0.326,1.998-1.551,2.896-3.546,2.527
                           c-1.225-0.244-1.591-0.121-2.486,0.814c-1.305,1.428-1.305,1.834,0,1.834c1.061,0,4.28,2.566,4.28,3.425
                           c0,0.284,0.608,1.101,1.385,1.834l1.346,1.305l1.59-0.815c1.956-1.059,2.119-1.059,3.304,0.041l0.938,0.896l1.183-1.143l1.185-1.144
                           l1.344,1.267l1.388,1.265l-1.021,0.813c-0.571,0.447-1.182,0.814-1.345,0.814s-1.185,0.367-2.242,0.854
                           c-1.062,0.448-2.283,0.979-2.729,1.184c-0.447,0.205-1.631,0.447-2.647,0.529c-2.937,0.285-14.228,4.771-15.041,5.951
                           c-0.896,1.426-1.305,6.397-0.611,7.744c0.326,0.569,0.571,1.508,0.571,2.078c0,0.611,0.204,1.264,0.49,1.549
                           c1.303,1.305,2.24-0.039,2.812-3.953c0.204-1.346,0.653-2.525,1.143-3.059l0.855-0.814L38.826,324
                           c1.875,1.793,7.459,0.57,12.104-2.566c4.933-3.385,6.073-3.588,16.671-3.182c5.178,0.205,9.172,0.529,9.416,0.773
                           c0.326,0.326,0.286,0.814,0,1.59c-0.244,0.652-0.365,1.388-0.244,1.714c0.326,0.854,2.16-0.205,3.101-1.796
                           c0.446-0.731,1.141-1.467,1.508-1.631c0.407-0.121,1.548-1.142,2.566-2.199l1.875-1.997l4.646,0.245
                           c2.568,0.121,5.095,0.406,5.584,0.65c1.385,0.692,1.549,1.631,0.408,2.567c-0.571,0.446-2.038,1.63-3.302,2.647
                           c-2.731,2.201-3.06,2.771-1.43,2.526c0.693-0.122,1.632,0.121,2.243,0.529c1.103,0.692,1.103,0.692,2.487-0.774
                           c1.223-1.304,1.631-1.468,3.301-1.468c2.283,0.041,4.893,0.572,5.503,1.185c0.286,0.283,0.286,0.61-0.082,0.979
                           c-0.365,0.448-0.325,0.691,0.082,1.063c1.142,0.896,4.443,2.485,5.259,2.485c0.448,0,1.753,0.528,2.854,1.224
                           c1.059,0.65,2.2,1.225,2.484,1.225c0.244,0.039,1.143,0.568,1.916,1.222c1.997,1.755,3.548,1.632,8.355-0.61
                           c1.834-0.854,7.295-1.02,8.071-0.243c0.243,0.243,0.938,0.448,1.508,0.448c0.65,0,1.507,0.487,2.283,1.265
                           c0.649,0.69,1.752,1.509,2.444,1.794c0.691,0.284,2.12,1.427,3.181,2.482l1.875,1.998l-0.775-2.771
                           c-0.406-1.55-1.305-3.547-1.957-4.483c-0.652-0.938-1.59-2.526-2.119-3.545c-0.979-1.957-4.359-5.465-6.357-6.563
                           c-2.16-1.143-4.564-1.305-5.91-0.366c-2.324,1.672-4.729,0.896-6.074-1.956c-0.773-1.672-1.223-2.08-2.526-2.484
                           c-1.061-0.326-1.793-0.856-2.199-1.672l-0.653-1.227l-2.977,0.205l-3.017,0.242l-1.265-1.875c-0.692-1.02-1.265-2.036-1.265-2.279
                           c0-0.205-0.365-1.104-0.772-1.957c-0.692-1.266-1.103-1.591-2.364-1.795c-0.854-0.162-1.712-0.08-1.917,0.123
                           c-0.243,0.242-1.019,0.406-1.752,0.406c-1.834,0-1.794-1.224,0.082-3.344c2.201-2.403,1.224-2.977-1.63-0.979
                           c-0.653,0.488-2.038,1.061-3.019,1.305c-2.24,0.569-3.423,0.164-4.482-1.631c-0.979-1.672-1.102-7.703-0.245-10.965
                           c0.326-1.304,0.612-2.976,0.612-3.75c0-0.732,0.364-2.16,0.771-3.179c0.693-1.63,0.938-1.834,2.446-2.08
                           c1.304-0.204,1.793-0.487,2.079-1.304c0.854-2.161,0.569-2.609-1.548-2.609c-1.103,0-2.324-0.244-2.773-0.61
                           C92.87,276.233,92.952,276.233,91.24,277.742z" />
              <path class="territory" data-id="543" id="Gonda"
                d="M385.375,278.435c-0.896,0.979-2.729,1.061-4.075,0.163c-0.979-0.653-1.021-0.653-1.021,0.366
                           c0,0.571-0.163,1.183-0.407,1.305c-0.202,0.122-0.406,0.733-0.406,1.345c0,1.673-1.063,2.854-2.771,3.139
                           c-2.566,0.449-2.813,0.611-3.059,1.793c-0.162,0.814-0.854,1.549-2.281,2.445c-1.754,1.143-2.16,1.265-2.976,0.815
                           c-1.389-0.693-3.223-2.487-3.629-3.546c-0.285-0.733-0.569-0.854-1.47-0.653c-1.549,0.367-1.549,0.408-1.019,1.916
                           c0.283,0.774,0.486,1.59,0.486,1.876c0,0.773-2.896,4.076-4.36,4.973c-0.979,0.61-1.345,1.142-1.345,1.916
                           c-0.081,2.322-1.266,3.789-4.484,5.462c-1.67,0.855-3.301,1.549-3.587,1.549c-0.813,0,0.53,2.323,1.551,2.648
                           c1.711,0.529,4.853,3.467,5.625,5.26c0.568,1.223,1.509,2.322,3.059,3.423c1.224,0.938,2.607,2.283,3.059,3.017
                           c0.488,0.734,2.078,2.446,3.546,3.752c1.468,1.347,2.648,2.729,2.648,3.099c0,0.731,0.772,1.224,1.957,1.224
                           c0.364,0,1.63,0.773,2.771,1.672c1.141,0.938,3.261,2.08,4.85,2.648l2.813,0.979l4.076-1.387c2.282-0.773,5.503-1.631,7.215-1.875
                           c2.854-0.447,3.262-0.447,5.056,0.367c2.525,1.1,3.221,1.1,4.28-0.246c0.731-0.938,0.813-1.467,0.61-4.156
                           c-0.123-1.957-0.041-3.75,0.324-4.934c0.488-1.752,0.569-1.834,2.896-2.404c2.119-0.488,2.607-0.488,4.523,0.123
                           c1.143,0.365,2.648,0.652,3.304,0.652c1.306,0,3.343,0.691,5.38,1.752c1.306,0.691,1.428,0.691,3.221,0.041
                           c1.306-0.529,2.119-1.184,2.854-2.364c0.57-0.938,1.672-2.444,2.404-3.342c1.225-1.511,1.306-1.755,0.773-2.446
                           c-0.327-0.447-0.611-1.223-0.611-1.793s-0.326-1.509-0.691-2.038c-0.448-0.61-0.731-1.752-0.731-2.854c0-1.835,0-1.835-2.446-3.138
                           c-1.347-0.692-3.261-1.388-4.277-1.552l-1.876-0.285l-0.854,1.999c-0.49,1.062-0.979,2.525-1.144,3.26
                           c-0.162,0.772-0.896,1.875-1.875,2.771c-1.427,1.267-1.834,1.429-2.937,1.226c-0.732-0.164-1.589-0.53-1.957-0.855
                           c-0.324-0.326-0.854-0.57-1.101-0.57c-0.285,0-0.691-0.367-0.979-0.813c-0.283-0.447-0.732-0.814-0.938-0.814
                           c-0.246,0-1.264-0.854-2.242-1.874c-1.02-1.021-2.363-2.162-3.058-2.486c-0.651-0.365-1.348-0.854-1.51-1.102
                           c-0.161-0.244-0.202-3.018-0.122-6.195c0.163-6.521,0.326-6.156-3.748-7.46c-1.918-0.611-2.486-1.06-4.036-3.098
                           c-0.979-1.345-1.792-2.608-1.792-2.771c0-0.326-2.322-2.73-2.648-2.73C386.15,277.619,385.781,277.985,385.375,278.435z" />
              <path class="territory" data-id="558" id="Kushinagar" d="M529.673,282.511c-0.408,0.449-1.307,0.979-1.957,1.142c-0.938,0.245-1.307,0.693-1.794,2.12
                           c-0.367,1.02-0.979,2.324-1.428,2.936c-0.57,0.814-0.691,1.508-0.529,2.445c0.205,1.101-0.244,2.527-2.283,7.257l-2.525,5.907
                           l0.284,3.752c0.203,2.977,0.123,4.076-0.325,4.975c-0.896,1.71-2.854,2.484-5.665,2.2c-2.896-0.285-5.301,0.528-7.379,2.606
                           c-1.386,1.385-1.467,1.631-1.467,3.953c0.041,2.854,0.448,3.588,2.444,4.238c0.772,0.284,1.957,0.938,2.647,1.471
                           c1.183,0.978,1.183,0.978,1.468,6.602c0.163,3.141,0.163,6.195,0.04,6.85c-0.121,0.651-0.04,1.102,0.164,1.02
                           c6.154-2.483,11.534-5.299,13.044-6.808c0.938-0.938,1.915-1.711,2.119-1.711c0.65,0,6.438,6.398,8.562,9.375
                           c4.237,6.032,5.014,6.929,6.153,6.929c2.119,0,4.117-2.443,4.117-5.013c0-0.571,0.407-1.508,0.855-2.12
                           c0.813-0.979,1.06-1.06,2.771-0.813c4.894,0.651,10.639,0.692,13.451,0.041c1.59-0.365,3.586-0.651,4.483-0.651
                           c1.426,0,1.63-0.122,1.875-1.145c0.405-1.995-0.327-3.219-2.201-3.545c-1.753-0.285-3.303-1.752-3.303-3.099
                           c0-1.264-1.143-1.998-3.099-1.998c-2.202,0-2.569-0.61-1.835-3.018c1.02-3.341,1.02-4.237-0.122-6.563
                           c-0.651-1.305-1.468-2.322-1.956-2.486c-0.896-0.283-1.061-0.123-2.896,2.486c-1.429,1.998-3.628,0.938-4.198-2.119
                           c-0.245-1.264-0.285-1.305-1.103-0.73c-2.403,1.671-5.584-0.286-5.584-3.466c0-0.896,0.243-1.755,0.651-2.079
                           c1.183-0.979,0.529-3.953-1.387-6.686c-1.307-1.795-1.711-2.771-1.711-3.914c0-1.957-0.53-2.283-1.998-1.223
                           c-1.631,1.182-3.142,1.1-3.953-0.164c-0.855-1.346-0.529-3.139,1.102-5.707c0.651-1.06,1.143-2.201,1.021-2.486
                           c-0.286-0.693-3.629-2.813-5.83-3.669c-0.979-0.367-1.752-0.896-1.752-1.142c0-0.611,1.059-2.16,2.524-3.749
                           c0.692-0.735,1.145-1.632,1.063-2.039C532.034,281.574,530.569,281.492,529.673,282.511z" />
              <path class="territory" data-id="521" id="Barabanki" d="M326.964,284.549c-1.632,1.141-1.711,1.345-1.711,3.22c0,1.589-0.246,2.283-1.063,3.261
                           c-1.143,1.347-2.606,1.631-3.385,0.692c-0.813-0.978-4.482-2.364-5.462-2.038c-0.487,0.124-1.956,1.386-3.221,2.731
                           c-2.322,2.486-2.363,2.486-3.711,1.998c-0.729-0.245-2.443-0.611-3.79-0.734c-2.976-0.327-3.465,0.123-3.547,3.099
                           c-0.081,2.201-0.162,2.119,2.568,2.689c0.772,0.123,2.241,0.855,3.262,1.551c1.021,0.69,2.2,1.467,2.648,1.672
                           c1.142,0.569,1.224,2.566,0.203,4.156c-0.651,1.1-1.063,1.346-2.2,1.346c-1.834,0-2.282,0.732-1.021,1.67
                           c0.53,0.408,0.979,1.186,1.021,1.878c0.041,0.61,0.122,1.347,0.122,1.589c0.041,0.286,0.854,0.609,1.875,0.734
                           c2.201,0.364,3.221,1.224,2.854,2.443c-0.772,2.403-0.691,3.506,0.489,5.422c0.651,1.061,1.385,2.445,1.63,3.057
                           c0.326,0.734,0.979,1.226,1.834,1.47c0.938,0.243,1.59,0.813,2.365,2.159c0.896,1.509,1.304,1.835,2.485,1.916
                           c2.771,0.285,2.977,1.307,1.428,7.176c-1.226,4.605-1.673,8.845-1.063,9.984c0.285,0.57,0.857,0.855,1.672,0.855
                           c0.693,0,2.405,0.65,3.791,1.427c1.55,0.854,3.102,1.429,3.953,1.429c1.55,0,1.998-0.246,2.65-1.429
                           c0.69-1.183,5.177-0.979,8.069,0.367c2.689,1.265,5.138,2.241,6.112,2.362c1.063,0.162,1.915-2.485,1.794-5.665
                           c-0.082-2.363,0-2.648,1.185-3.872c2.078-2.159,2.894-5.705,1.549-6.85c-0.652-0.528-2.648-3.83-2.648-4.359
                           c0-0.162,0.365-0.773,0.773-1.307c0.569-0.731,1.345-1.061,2.977-1.265c1.306-0.203,2.937-0.772,3.83-1.385
                           c1.468-0.938,1.754-0.979,3.101-0.57c1.427,0.407,1.591,0.365,2.321-0.569c0.448-0.529,1.55-1.225,2.485-1.509l1.672-0.487
                           l-3.75-3.955c-2.079-2.159-4.687-4.77-5.788-5.787c-1.142-0.979-2.28-2.445-2.605-3.182c-0.652-1.589-2.12-3.017-4.239-4.156
                           c-1.224-0.651-1.753-0.692-3.018-0.366c-0.813,0.245-1.955,0.325-2.443,0.204c-1.469-0.366-3.465-2.241-3.465-3.221
                           c0-0.488-0.449-2.322-1.021-4.078c-0.772-2.444-1.019-4.035-1.019-6.971c0-2.079-0.164-4.32-0.367-4.972
                           c-0.203-0.653-0.529-1.916-0.652-2.813l-0.284-1.631l-0.69,0.979c-0.367,0.529-0.938,1.915-1.267,3.058
                           c-0.527,1.711-0.813,2.119-1.672,2.2c-1.59,0.204-2.894-1.142-3.791-4.035c-0.528-1.55-1.101-2.65-1.509-2.731
                           C328.962,283.367,327.902,283.855,326.964,284.549z" />
              <path class="territory" data-id="555" id="Kannauj"
                d="M207.737,292.986c-0.16,0.122-0.282,0.897-0.282,1.672c0,2.079-1.146,4.035-3.061,5.381
                           c-2.241,1.549-4.359,1.875-6.685,1.061c-0.979-0.365-2.365-0.651-3.06-0.651c-1.752,0-3.017-0.979-3.302-2.566
                           c-0.366-1.876-1.468-2.446-3.954-2.119c-1.752,0.244-2.119,0.448-2.565,1.548c-0.449,1.061-0.407,1.59,0.324,3.71
                           c0.447,1.385,0.979,2.648,1.143,2.854c0.691,0.771,0.326,2.937-0.856,5.3c-0.69,1.305-1.223,2.688-1.223,3.059
                           c0,1.225-1.998,3.709-2.978,3.709c-0.732,0-0.772,0.082-0.283,0.408c0.324,0.242,1.631,0.405,2.854,0.324
                           c2.446-0.082,2.608,0,7.5,3.508c3.262,2.362,4.606,2.524,6.318,0.896c1.061-1.019,1.344-1.101,3.057-0.854
                           c1.428,0.244,2.161,0.611,3.101,1.67c0.649,0.775,1.223,1.672,1.223,1.998c0,0.285,1.143,1.103,2.569,1.836
                           c1.385,0.692,3.342,1.955,4.358,2.813c1.021,0.854,2.323,1.672,2.938,1.834c0.938,0.204,1.223,0.081,1.752-0.854
                           c1.753-3.1,2.161-3.586,3.302-3.83c1.224-0.244,3.913-1.672,5.136-2.731c0.774-0.651,0.734-1.142-0.406-4.687
                           c-0.814-2.609-0.406-2.938,2.485-1.957l2.323,0.813l0.772-1.021c0.979-1.224,0.896-1.426-1.957-7.092
                           c-1.102-2.119-2.2-4.524-2.444-5.3c-0.855-2.608-2.813-4.444-5.503-5.138c-1.306-0.366-3.425-1.183-4.646-1.834
                           c-1.224-0.653-2.854-1.183-3.588-1.183c-1.06,0-1.589-0.326-2.486-1.427C208.429,292.661,208.185,292.497,207.737,292.986z" />
              <path class="territory selected" data-id="561" id="Lucknow" d="M299.736,300.895c-0.162,0.285-1.792,1.184-3.668,2.08c-1.875,0.854-3.506,1.752-3.627,1.957
                           c-0.125,0.243-1.224,0.405-2.403,0.405c-1.753,0-2.324,0.164-3.101,1.021c-0.896,0.938-1.223,1.021-4.035,0.938
                           c-2.894-0.081-3.221,0-4.933,1.226c-0.979,0.73-2.12,1.834-2.526,2.443c-0.61,0.938-0.61,1.143-0.123,1.428
                           c1.062,0.569,0.733,2.362-0.69,3.588c-1.143,0.979-1.267,1.224-0.734,1.59c0.326,0.244,1.185,0.326,1.915,0.203
                           c1.469-0.244,2.568,0.568,2.568,1.957c0,1.304,0.408,1.672,2.566,2.485c2.2,0.813,2.73,1.509,3.791,4.771
                           c0.611,1.793,1.021,2.404,1.875,2.729c1.225,0.448,2.12,2.202,1.754,3.385c-0.161,0.448-0.896,0.938-1.957,1.183
                           c-0.938,0.245-1.955,0.53-2.199,0.61c-0.775,0.244-0.652,1.631,0.286,3.344c0.446,0.854,0.813,1.955,0.813,2.445
                           c0,1.264,0.407,1.385,2.896,0.731c3.343-0.896,4.851-0.772,7.011,0.608c1.06,0.652,1.917,1.349,1.917,1.511
                           c0,0.202,0.73,0.772,1.63,1.347c0.896,0.569,2.197,1.711,2.896,2.523c0.649,0.856,2.24,2.283,3.546,3.183
                           c1.266,0.854,3.181,2.241,4.236,3.06l1.877,1.426l0.896-1.426c0.732-1.185,2.771-3.101,6.808-6.318
                           c0.246-0.204,0.569-1.631,0.692-3.139c0.161-1.511,0.732-4.565,1.265-6.729c1.265-4.975,1.265-5.219-0.041-5.219
                           c-1.59,0-2.526-0.69-3.424-2.443c-0.449-0.896-1.103-1.631-1.388-1.631c-0.854,0-3.018-1.916-3.343-2.979
                           c-0.162-0.487-0.691-1.549-1.183-2.322c-1.549-2.525-1.875-3.953-1.224-5.504l0.569-1.385l-1.796-0.285
                           c-2.036-0.285-3.098-1.266-3.261-2.938c-0.04-0.652-0.487-1.589-0.938-2.037c-1.265-1.264-1.183-3.099,0.123-3.669
                           c0.568-0.284,1.507-0.487,2.079-0.487c1.102,0,2.444-2.039,1.508-2.324c-0.246-0.079-1.267-0.771-2.241-1.549
                           C304.179,300.936,300.346,299.916,299.736,300.895z" />
              <path class="territory" data-id="530" id="Basti" d="M433.066,302.893c-1.549,0.407-3.545,1.021-4.401,1.388l-1.55,0.689l0.815,1.347
                           c0.489,0.732,0.854,1.67,0.854,1.996c0,0.367,0.326,1.307,0.692,2.121c0.652,1.385,0.652,1.467-0.203,2.566
                           c-0.529,0.609-1.713,2.324-2.729,3.791c-1.511,2.241-2.12,2.813-3.915,3.546c-1.143,0.488-2.281,0.896-2.484,0.896
                           c-0.204,0-1.632-0.567-3.181-1.223c-1.55-0.693-3.427-1.223-4.198-1.223c-0.773,0-2.078-0.285-2.938-0.611
                           c-1.753-0.773-4.77-0.488-5.584,0.529c-0.365,0.406-0.486,1.834-0.447,4.605c0.082,3.627,0,4.115-0.938,5.502l-1.019,1.471
                           l1.101,1.588c0.651,0.938,1.794,1.917,2.771,2.363c0.938,0.408,2.896,1.59,4.399,2.607c3.914,2.689,6.034,3.71,7.868,3.79
                           c0.896,0.041,2.935,0.651,4.482,1.388c1.589,0.732,3.79,1.754,4.934,2.281c1.141,0.489,2.281,1.225,2.566,1.551
                           c0.691,0.854,4.811,2.688,5.951,2.688c0.487,0,1.671-0.244,2.566-0.569c1.957-0.691,6.931-0.488,10.026,0.407
                           c2.281,0.651,2.689,0.406,2.689-1.631c0-1.103,1.385-2.729,4.851-5.625c0.447-0.367,0.938-1.349,1.062-2.119
                           c0.245-1.226,0.082-1.672-1.101-3.101c-0.733-0.938-1.998-2.037-2.771-2.443c-0.771-0.408-1.834-1.186-2.322-1.712
                           c-1.183-1.267-2.485-5.017-2.607-7.582c-0.121-1.998-0.08-2.079,2.242-4.158c2.895-2.647,3.262-3.343,2.936-5.462
                           c-0.245-1.63-0.367-1.711-3.426-3.179c-1.711-0.815-3.586-1.634-4.156-1.794c-1.508-0.406-2.729-1.713-3.831-4.034
                           c-1.02-2.201-1.02-2.242-5.544-3.224C436.204,302.239,434.656,302.482,433.066,302.893z" />
              <path class="territory" data-id="545" id="Gorakhpur" d="M471.993,304.727c0,1.144,0.529,3.019,1.102,3.83c0.041,0.082,0.609-0.08,1.264-0.326
                           c1.021-0.406,1.469-0.363,2.772,0.246c1.549,0.732,1.59,0.814,1.549,2.771c-0.041,1.143-0.082,2.566-0.123,3.262
                           c-0.082,0.651,0.123,1.997,0.408,2.936c1.021,3.304-0.854,6.521-3.182,5.463c-0.772-0.366-1.345-0.366-2.362,0
                           c-1.143,0.447-1.51,0.896-2.283,2.977c-0.773,2.119-0.896,3.303-0.854,7.621c0,4.322,0.162,5.667,1.102,8.768
                           c1.224,3.953,3.384,7.987,4.892,8.967c0.531,0.326,1.021,0.979,1.146,1.388c0.445,1.793-2.979,4.074-5.22,3.505
                           c-1.305-0.326-2.24,1.018-2.24,3.221c0.041,2.039,0.568,2.729,3.546,4.605c2.32,1.468,2.402,1.468,7.704,1.712l5.339,0.204
                           l2.363,1.834c6.727,5.218,8.396,6.031,11.372,5.259c1.632-0.407,1.997-0.366,2.937,0.284c0.611,0.448,1.672,1.182,2.405,1.672
                           l1.303,0.896l2.202-1.346c1.224-0.734,2.443-1.793,2.729-2.404c0.49-0.979,0.367-1.387-1.018-4.199
                           c-0.938-1.834-2.08-3.546-2.854-4.116l-1.306-1.021l-1.426,0.856l-1.388,0.896l-0.814-1.144c-0.938-1.347-1.752-4.076-1.996-6.768
                           c-0.285-2.813,0.57-3.709,3.302-3.342c1.958,0.244,1.997,0.244,3.751-1.672c1.957-2.08,2.607-4.117,1.793-5.666
                           c-0.325-0.611-0.448-2.159-0.366-4.319c0.081-1.876,0.081-5.3,0.04-7.623c-0.079-3.953-0.16-4.238-1.141-5.177
                           c-0.57-0.529-1.55-1.104-2.201-1.223c-1.956-0.408-2.977-1.957-3.18-4.688c-0.082-1.345-0.244-2.444-0.367-2.444
                           c-0.081,0-1.509-0.204-3.099-0.447c-2.813-0.408-3.018-0.529-5.015-2.648l-2.038-2.201h-2.525c-3.302,0-5.098-0.732-5.788-2.402
                           c-0.489-1.185-0.408-1.51,1.183-4.605c0.896-1.835,1.55-3.424,1.429-3.546c-0.122-0.123-0.896,0.53-1.754,1.426
                           c-1.428,1.673-3.426,2.526-4.361,1.875c-0.244-0.161-0.731-0.854-1.101-1.548c-0.569-1.063-1.062-1.348-3.873-2.12
                           c-1.793-0.488-3.343-0.896-3.507-0.896C472.115,303.3,471.993,303.949,471.993,304.727z" />
              <path class="territory" data-id="578" id="Sant Kabir Nagar"
                d="M467.918,304.357c-1.021,0.367-2.283,1.103-2.896,1.632c-0.57,0.53-1.224,0.979-1.47,0.979
                           c-0.243,0-1.225,0.896-2.118,1.997c-1.264,1.469-2.039,2.079-3.18,2.282c-2.691,0.489-3.142,1.103-3.183,4.116v2.688l-2.524,2.405
                           c-2.854,2.689-3.059,3.383-1.957,7.052c0.69,2.242,1.835,3.671,3.669,4.606c1.712,0.896,4.646,4.236,4.688,5.339
                           c0,0.528-0.203,1.753-0.445,2.771c-0.408,1.508-0.815,2.037-2.365,3.059c-2.405,1.632-3.099,2.605-3.464,4.892l-0.285,1.876
                           l2.16,1.428c2.321,1.549,8.723,5.625,11.86,7.582l1.915,1.224v-1.183c0-1.471,0.938-3.793,1.672-4.281
                           c0.326-0.204,1.469-0.365,2.527-0.406c1.264,0,2.199-0.285,2.648-0.734c0.65-0.611,0.609-0.734-0.408-1.589
                           c-1.712-1.427-3.505-4.812-4.853-9.09c-1.102-3.424-1.263-4.646-1.345-9.294c-0.082-4.811,0-5.584,0.896-7.99
                           c1.224-3.22,1.671-3.79,3.749-4.482c1.266-0.407,1.876-0.445,2.648-0.082c0.938,0.449,1.103,0.367,1.468-0.648
                           c0.326-0.814,0.326-1.591-0.082-2.938c-0.527-1.998-0.568-2.565-0.161-5.299c0.284-1.754,0.243-1.916-0.814-2.365
                           c-0.814-0.364-1.264-0.405-1.59-0.082c-0.203,0.205-0.938,0.408-1.59,0.408c-0.938,0-1.266-0.285-1.793-1.549
                           c-0.366-0.813-0.732-2.283-0.855-3.262c-0.082-0.938-0.285-1.712-0.448-1.712C469.875,303.747,468.937,304.033,467.918,304.357z" />
              <path class="territory" data-id="584" id="Unnao"
                d="M250.332,310.922c-0.693,0.122-1.021,0.611-1.347,1.996c-0.364,1.468-0.813,2.08-2.077,2.895
                           c-1.551,1.021-1.633,1.063-2.979,0.408c-0.733-0.367-1.672-1.061-2.038-1.59l-0.731-0.938l-1.632,1.509
                           c-0.896,0.854-2.117,1.754-2.729,2.038c-0.938,0.406-1.062,0.611-0.733,1.305c0.203,0.487,1.266,1.549,2.322,2.364
                           c2.364,1.835,2.609,2.647,2.69,8.479c0.042,3.952,0.123,4.4,1.142,5.867c0.611,0.854,1.101,1.834,1.101,2.12
                           c0,0.326,0.408,0.649,0.938,0.731c0.489,0.121,1.467,0.283,2.12,0.447c0.69,0.123,1.793,0.49,2.445,0.816
                           c0.69,0.284,1.834,0.771,2.566,1.059c1.997,0.734,2.896,2.813,3.18,7.379c0.325,5.545,0.773,6.479,5.097,10.519
                           c2.039,1.916,4.076,3.669,4.563,3.872c2.527,1.184,5.221,3.059,7.297,5.097c2.649,2.646,3.385,4.604,3.059,8.231
                           c-0.204,2.24-0.162,2.404,0.979,3.222c0.652,0.448,1.185,1.144,1.185,1.549c0,0.366,0.285,1.062,0.609,1.509
                           c0.325,0.406,0.611,1.102,0.611,1.469c0,0.854,3.058,3.182,4.156,3.182c0.813,0,2.365-1.021,4.441-2.896
                           c2.486-2.32,4.401-3.627,5.585-3.871c0.814-0.164,1.632-0.813,2.485-2.036c0.693-0.979,1.427-1.796,1.632-1.796
                           c0.202,0,0.487-0.568,0.651-1.264c0.244-1.102,0.08-1.508-1.508-3.18c-3.386-3.547-4.118-6.4-1.389-5.342
                           c0.611,0.205,1.834,0.408,2.691,0.408c0.854,0,1.711,0.164,1.834,0.406c0.121,0.203,1.224,0.693,2.402,1.02
                           c1.265,0.367,2.608,1.144,3.304,1.836c1.386,1.467,2.038,1.549,2.813,0.285c1.509-2.364,1.063-5.504-1.101-7.908
                           c-0.773-0.855-0.773-1.102-0.325-4.075c0.284-1.753,0.528-3.546,0.569-3.954c0.041-0.529-0.651-1.264-2.119-2.322
                           c-1.185-0.813-2.937-2.321-3.872-3.302c-2.486-2.569-6.317-5.585-7.501-5.911c-0.61-0.123-2.079-0.041-3.342,0.245
                           c-1.225,0.284-2.896,0.611-3.709,0.733l-1.467,0.203l-0.489-2.364c-0.244-1.347-0.732-2.771-1.062-3.181
                           c-0.326-0.447-0.61-1.508-0.61-2.363c0-1.752,0.854-2.527,3.342-2.977c1.387-0.244,1.469-0.367,1.102-1.102
                           c-0.245-0.49-0.691-0.691-1.021-0.57c-1.061,0.408-2.242-0.488-1.996-1.509c0.325-1.344-1.184-4.894-2.282-5.462
                           c-0.53-0.285-1.672-0.771-2.487-1.104c-1.304-0.527-1.549-0.813-1.793-2.157c-0.243-1.511-0.324-1.593-1.549-1.429
                           c-1.509,0.162-3.505-1.182-3.505-2.402c0-0.489,0.569-1.389,1.223-2.08c1.184-1.143,1.225-1.266,0.53-1.752
                           c-0.57-0.448-0.896-0.448-1.753,0c-0.571,0.283-1.59,0.65-2.283,0.773c-1.467,0.323-2.363,1.183-2.813,2.688
                           c-0.448,1.468-3.464,4.812-4.605,5.096c-1.55,0.367-2.444-0.123-3.831-2.161c-0.691-1.061-1.59-2.119-1.998-2.402
                           c-0.365-0.284-1.102-1.551-1.63-2.854c-0.896-2.279-2.161-3.79-3.017-3.708C251.474,310.718,250.864,310.84,250.332,310.922z" />
              <path class="territory" data-id="537" id="Etahwah"
                d="M160.575,314.427c-0.774,0.285-2.609,1.345-4.036,2.405c-3.587,2.73-5.992,2.648-6.972-0.246
                           c-0.406-1.225-0.651-1.426-1.958-1.549c-0.813-0.08-2.688,0.042-4.155,0.205c-1.47,0.16-3.304,0.365-4.076,0.447
                           c-2.487,0.203-2.854,0.567-2.854,2.565c0,1.632,0.163,1.958,2.241,3.913c1.264,1.186,2.73,3.059,3.262,4.198
                           c0.529,1.102,1.591,2.937,2.322,4.075c0.734,1.102,1.673,3.305,2.08,4.894c0.733,2.854,0.815,2.937,2.242,3.181
                           c0.854,0.121,2.079,0.243,2.771,0.243c2.12,0,2.363,0.733,1.388,4.036c-0.449,1.589-1.021,2.977-1.225,3.098
                           c-0.732,0.448-0.448,1.021,1.429,3.02c1.019,1.06,1.834,2.158,1.834,2.443c0,0.246,0.73,1.387,1.63,2.526
                           c0.896,1.142,1.63,2.486,1.63,3.017c0,1.998,0.69,2.937,2.323,3.222c5.258,0.815,7.296,0.979,8.07,0.528
                           c0.447-0.203,1.63-0.65,2.648-0.896c1.467-0.367,1.793-0.65,1.711-1.264c-0.081-0.407-0.204-1.51-0.245-2.405
                           c-0.082-0.938-0.407-2.12-0.732-2.647c-0.365-0.57-0.773-2.242-0.938-3.709c-0.245-2.648-0.245-2.729,1.02-3.794
                           c0.691-0.567,1.592-1.06,1.997-1.06c0.774,0,2.896-3.668,2.896-5.098c0.041-0.444,0.285-1.264,0.61-1.834
                           c0.488-0.896,0.448-1.101-0.08-1.752c-0.367-0.365-1.021-0.691-1.429-0.691c-1.387,0-1.347-1.225,0.123-2.445
                           c1.386-1.142,1.386-1.183,1.426-4.729c0.041-2.813,0.326-4.279,1.144-6.522c0.57-1.59,1.062-3.26,1.062-3.668
                           c-0.042-1.304-1.021-2.199-2.404-2.199c-0.733,0-1.712-0.204-2.202-0.489C173.293,314.427,162.737,313.693,160.575,314.427z" />
              <path class="territory" data-id="556" id="Kanpur Nagar" d="M230.97,317.646c-0.855,0.896-1.385,1.184-2.038,0.979c-2.894-0.814-2.688-0.938-2.039,1.468
                           c0.693,2.73,0.327,3.587-2.159,5.054l-1.916,1.146l1.672,1.467c0.938,0.775,1.714,1.712,1.714,2.038
                           c0.04,1.428,1.141,3.669,2.362,4.688c0.733,0.61,1.307,1.346,1.307,1.631c0,1.061,3.18,6.686,4.318,7.703
                           c0.651,0.57,2.201,1.591,3.427,2.242c1.223,0.65,3.219,2.117,4.399,3.181c1.792,1.713,2.12,2.198,2.12,3.505
                           c0,1.104-0.246,1.631-0.938,2.12c-0.529,0.323-1.183,1.101-1.429,1.672c-1.06,2.237-0.325,8.272,1.389,11.494
                           c0.771,1.549,0.731,2.159-0.448,3.751c-0.57,0.771-1.021,1.874-1.021,2.443c0,2.078-1.915,2.648-4.48,1.385
                           c-1.063-0.528-1.508-0.567-2.08-0.201c-0.407,0.242-1.225,0.445-1.752,0.445c-1.508,0-1.671,0.652-0.651,2.568
                           c0.855,1.59,0.855,1.794,0.284,3.18c-0.408,1.021-1.182,1.793-2.364,2.486c-1.426,0.773-1.752,1.182-1.671,1.916
                           c0.041,0.529-0.286,1.549-0.772,2.323l-0.815,1.346l1.345,0.854c1.349,0.813,3.06,1.06,6.441,0.854
                           c1.019-0.041,2.364,0.123,2.976,0.327c1.021,0.407,1.104,0.61,1.104,2.565c-0.042,1.185-0.286,2.607-0.611,3.183
                           c-0.327,0.569-0.571,1.142-0.611,1.304c0,0.122,1.021,0.733,2.242,1.307c1.426,0.65,2.404,1.386,2.73,2.037
                           c1.019,2.281,4.48,0.365,5.584-3.1c0.731-2.242,2.443-4.361,7.583-9.457c4.399-4.359,4.729-4.646,6.685-4.892
                           c1.59-0.203,2.486-0.651,4.157-2.079c1.142-0.979,2.647-1.915,3.301-2.037c0.897-0.204,1.387-0.691,1.834-1.753
                           c0.857-2.038,1.145-5.421,0.571-7.054c-0.734-2.281-5.666-6.604-9.457-8.273c-2.078-0.896-8.438-7.296-9.333-9.334
                           c-0.407-1.021-0.815-3.261-0.938-5.585c-0.282-4.771-0.978-6.274-3.058-6.972c-0.814-0.243-1.711-0.608-1.915-0.813
                           c-0.245-0.162-1.265-0.448-2.242-0.61c-2.364-0.324-3.506-1.062-4.278-2.729c-0.366-0.692-0.938-1.875-1.306-2.526
                           c-0.528-0.896-0.69-2.363-0.731-5.503c-0.041-2.364-0.203-4.646-0.407-5.096c-0.204-0.448-1.59-2.038-3.1-3.546
                           c-1.51-1.51-2.854-3.1-3.017-3.587C232.601,316.1,232.358,316.18,230.97,317.646z" />
              <path class="territory" data-id="519" id="Auraiya" d="M180.426,321.766c-0.896,2.607-1.142,4.033-1.1,6.398c0,2.281-0.163,3.423-0.734,4.564
                           c-0.773,1.467-0.773,1.547-0.04,2.198c1.142,1.021,1.305,2.038,0.611,3.386c-0.367,0.689-0.653,1.549-0.653,1.957
                           c0,0.404-0.53,1.834-1.223,3.179c-1.021,2.118-1.428,2.526-2.938,3.058l-1.753,0.651l0.123,2.608
                           c0.123,1.59,0.408,2.936,0.774,3.342c0.324,0.367,0.651,1.387,0.731,2.242c0.244,2.566,0.693,4.197,1.185,4.197
                           c0.243,0,1.101,0.53,1.875,1.184c2.281,1.834,5.096,1.996,8.231,0.408c0.734-0.367,2.896-0.082,4.117,0.528
                           c0.489,0.244,0.611,0.649,0.489,1.265c-0.163,0.651,0.041,1.224,0.813,1.916l1.063,0.979l1.712-1.835
                           c4.035-4.359,8.069-11.25,7.581-13.002c-0.611-2.202-0.407-4.279,0.609-5.666c1.063-1.468,3.386-3.302,4.118-3.302
                           c0.244,0,0.855-0.448,1.385-0.938l0.896-0.979l-0.814-1.875c-0.446-1.019-1.183-2.078-1.63-2.321
                           c-0.487-0.244-1.102-0.938-1.427-1.591l-0.61-1.142l2.038-0.448c1.144-0.285,2.241-0.406,2.404-0.285
                           c0.204,0.121,0.734-0.406,1.224-1.184c1.144-1.874,0.691-2.525-2.729-4.115c-1.998-0.938-2.813-1.509-3.18-2.444
                           c-0.611-1.429-1.673-2.445-2.938-2.813c-0.652-0.201-1.346,0.043-2.404,0.856c-2.24,1.671-3.871,1.509-7.012-0.692
                           c-4.439-3.141-5.421-3.587-7.621-3.628l-2.039-0.041L180.426,321.766z" />
              <path class="territory" data-id="541" id="Ayodhya" d="M365.404,327.104c-0.653,0.285-1.59,0.938-2.039,1.43c-0.689,0.771-1.062,0.854-2.688,0.65
                           c-1.593-0.244-2.161-0.123-3.101,0.569c-0.609,0.487-2.038,0.979-3.181,1.101c-2.894,0.367-3.179,0.733-2.118,2.527
                           c0.488,0.813,1.226,1.834,1.589,2.201c0.856,0.854,0.979,3.343,0.246,5.747c-0.45,1.509-0.408,1.672,0.487,2.403
                           c0.652,0.528,1.305,0.692,1.956,0.528c1.103-0.284,2.12,0.367,2.12,1.388c0,0.408,0.568,1.225,1.224,1.875
                           c1.021,0.979,1.223,1.508,1.223,3.019c0,2.688,0.367,3.097,2.16,2.524c0.896-0.324,2.283-0.406,3.425-0.242
                           c3.058,0.445,8.725,1.834,9.944,2.484c0.651,0.325,2.121,0.57,3.303,0.57c1.388,0,3.019,0.406,4.605,1.061
                           c1.834,0.813,3.221,1.102,5.504,1.144c3.545,0.039,4.441,0.485,6.767,3.302c1.591,1.834,2.649,2.363,5.746,2.813l1.754,0.243
                           l1.591-3.14c0.896-1.753,1.997-3.423,2.486-3.709c0.69-0.405,0.813-0.772,0.567-1.916c-0.202-1.141-0.08-1.549,0.814-2.403
                           c0.569-0.609,1.306-1.062,1.674-1.062c0.772,0,2.32,0.775,2.688,1.347c0.284,0.405,2.813-1.224,2.813-1.834
                           c0-0.162,0.242-0.326,0.567-0.326c0.448,0,0.569-0.651,0.569-2.771c-0.041-3.669,0.245-5.014,1.144-5.666
                           c0.692-0.488,0.692-0.529-0.082-0.611c-0.406,0-1.265,0-1.875,0.041c-1.142,0.082-6.03-2.443-8.15-4.237
                           c-0.651-0.528-2.364-1.55-3.79-2.241c-2.08-0.979-2.854-1.672-3.914-3.264c-0.814-1.264-1.631-2.035-2.078-2.035
                           c-0.408,0-1.509-0.366-2.404-0.855c-1.591-0.814-1.794-0.814-5.178-0.203c-3.384,0.569-8.683,2.159-9.295,2.813
                           c-0.528,0.486-1.994,0.324-4.729-0.652c-2.771-0.979-4.36-1.834-6.032-3.343c-0.569-0.489-1.55-1.021-2.201-1.185
                           c-0.65-0.162-1.549-0.366-2.038-0.446C367.031,326.615,366.095,326.777,365.404,327.104z" />
              <path class="territory" data-id="554" id="Kanpur Dehat"
                d="M219.476,328.123c-0.123,0.407-0.938,1.507-1.793,2.445c-1.508,1.629-1.712,1.711-3.179,1.427
                           c-0.856-0.123-1.834-0.53-2.161-0.813c-0.57-0.449-0.773-0.285-1.753,1.303c-0.814,1.388-1.345,1.834-2.039,1.793
                           c-1.957-0.16-2.16-0.04-1.06,0.938c0.567,0.489,1.386,1.753,1.753,2.854c0.69,1.834,0.69,1.955-0.041,3.262
                           c-0.449,0.732-1.632,1.753-2.69,2.322c-3.465,1.834-4.523,3.953-3.587,7.175c0.285,1.021,0.082,1.754-1.141,4.321
                           c-0.856,1.711-2.283,4.156-3.224,5.42c-0.937,1.265-1.712,2.447-1.712,2.648c0,0.164-0.529,0.773-1.182,1.346l-1.225,1.021
                           l1.062,0.938c0.855,0.855,0.979,1.184,0.733,2.607c-0.733,4.361-0.733,4.158,0.326,4.854c0.529,0.365,1.997,0.771,3.181,0.938
                           c2.729,0.285,4.034,1.346,4.034,3.221c0,1.713,0.448,1.957,3.589,1.998c3.139,0,3.829,0.65,4.604,4.115
                           c0.407,1.712,0.814,2.484,1.752,3.221c1.144,0.856,1.469,0.896,3.547,0.53c2.2-0.366,3.302-0.123,5.707,1.183
                           c0.325,0.203,1.997-3.67,1.997-4.523c0-0.773,1.468-1.631,2.282-1.307c0.938,0.367,3.832-1.303,4.239-2.443
                           c0.324-0.813,0.244-1.304-0.407-2.201c-1.59-2.24-0.774-4.115,2.038-4.688c2.079-0.407,4.522-0.325,5.014,0.164
                           c0.815,0.813,1.916,0.529,1.916-0.53c0-0.529,0.449-1.632,1.021-2.445c0.978-1.428,0.978-1.589,0.406-2.813
                           c-1.63-3.507-2.403-10.23-1.387-12.229c0.245-0.488,0.938-1.388,1.468-1.998c0.733-0.772,0.979-1.345,0.814-2.037
                           c-0.285-0.979-3.301-3.424-5.91-4.771c-3.058-1.589-4.81-3.546-6.848-7.622c-1.265-2.568-2.405-4.239-3.304-4.934
                           c-0.772-0.569-1.305-1.307-1.183-1.551c0.366-0.979-0.774-3.343-2.242-4.604C221.23,327.186,219.843,326.98,219.476,328.123z" />
              <path class="territory" data-id="534" id="Deoria" d="M524.74,337.05c-1.021,0.896-4.036,2.567-7.5,4.117c-5.665,2.567-6.686,3.302-5.748,4.238
                           c0.651,0.651,0.571,2.977-0.163,4.483c-0.324,0.731-1.305,2.118-2.198,3.139c-1.551,1.794-1.592,1.834-4.076,1.753l-2.487-0.041
                           v1.183c0,0.691,0.367,2.363,0.857,3.792l0.813,2.604l1.223-0.607c1.186-0.57,1.347-0.57,3.1,0.528
                           c1.551,0.979,2.201,1.793,3.668,4.647c1.918,3.788,1.998,4.971,0.531,7.01l-0.813,1.144l1.102,0.243
                           c0.65,0.122,1.468,0.326,1.834,0.447c0.405,0.082,1.835-0.406,3.181-1.142c3.058-1.631,3.872-1.388,5.543,1.833
                           c0.855,1.633,1.346,2.201,1.834,2.079c1.143-0.364,2.69,0.488,4.729,2.567c1.591,1.672,2.364,2.117,4.117,2.484
                           c2.403,0.489,5.421,0.571,7.337,0.205c1.184-0.246,1.225-0.326,0.734-1.143c-0.857-1.305-1.144-3.629-0.693-5.545
                           c0.203-0.938,0.488-1.793,0.611-1.916c0.121-0.161,1.103-0.08,2.16,0.164c2.16,0.488,3.058,0.203,5.341-1.713
                           c1.224-1.021,1.304-1.021,2.525-0.406l1.224,0.65v-5.543v-5.505h-2.935c-4.118,0-5.503-0.771-6.521-3.546
                           c-0.938-2.607-1.712-2.895-4.974-1.956c-2.689,0.774-4.158,0.448-5.544-1.346c-0.813-1.021-1.102-3.546-0.487-4.402
                           c0.162-0.202,1.344-0.651,2.646-0.938c1.266-0.284,2.322-0.571,2.322-0.652c0-0.772-7.418-10.354-9.904-12.759l-1.711-1.63
                           L524.74,337.05z" />
              <path class="territory" data-id="518" id="Ambedkar Nagar"
                d="M420.676,344.02c-0.692,0.449-0.855,1.307-0.979,5.057c-0.08,2.729-0.08,2.729-2.119,4.563
                           c-2.198,2.039-3.261,2.243-4.688,1.021c-0.53-0.448-1.063-0.814-1.224-0.814c-0.733,0-1.225,1.182-0.979,2.364
                           c0.204,1.101,0.081,1.467-0.978,2.444c-0.938,0.854-3.345,4.811-3.345,5.462c0,0.081,1.266,0.122,2.813,0.163
                           c3.587,0,4.729,0.689,5.057,3.058c0.487,3.587,2.118,4.563,8.684,5.218c3.789,0.408,4.033,0.489,5.503,1.915l1.508,1.47l3.872-0.205
                           c2.648-0.12,4.156-0.366,4.811-0.854c1.59-1.104,2.649-0.814,4.118,1.063c1.914,2.443,5.664,6.113,7.213,6.97l1.268,0.733v-3.873
                           c0-2.16,0.201-4.729,0.486-5.705c0.408-1.592,0.408-1.959-0.203-2.607c-0.854-0.938-0.854-1.428-0.082-2.938
                           c0.488-0.938,0.529-1.387,0.123-2.24c-0.406-0.896-0.365-1.143,0.365-1.631c0.448-0.327,0.938-0.938,1.021-1.346
                           c0.163-0.611,0.041-0.734-0.691-0.572c-0.611,0.123-1.143-0.16-1.591-0.771c-0.896-1.306-0.854-1.469,0.691-2.404
                           c0.979-0.611,2.038-0.814,4.28-0.814c3.302,0,3.709,0.326,3.017,2.404c-0.731,2.078,0.162,3.953,2.978,6.235
                           c1.386,1.103,3.18,2.813,4.034,3.791c1.142,1.388,1.794,1.834,2.647,1.834c1.714,0,2.201-0.774,1.714-2.895
                           c-0.245-0.979-0.448-2.567-0.448-3.466c0-2.813-0.449-4.199-1.388-4.482c-0.446-0.122-1.305-0.65-1.875-1.184
                           c-0.568-0.489-2.078-1.467-3.343-2.159c-3.099-1.714-8.724-5.423-10.518-6.931c-1.793-1.549-3.709-2.08-8.562-2.487
                           c-2.936-0.243-4.155-0.202-5.177,0.204c-0.733,0.326-1.957,0.57-2.688,0.57c-1.511,0-6.359-2.037-7.178-2.977
                           c-0.243-0.326-1.549-1.102-2.813-1.714c-1.263-0.569-2.648-1.224-3.015-1.468C422.101,343.572,421.407,343.572,420.676,344.02z" />
              <path class="territory" data-id="582" id="Sultanpur" d="M379.871,358.245c0,0.407,0.245,1.062,0.571,1.509c0.285,0.447,0.651,1.672,0.772,2.729
                           c0.283,2.162-0.487,3.549-2.729,4.729c-3.385,1.793-4.319,2.606-4.319,3.709c0,0.57,0.365,1.753,0.813,2.606
                           c0.449,0.814,0.816,1.713,0.816,1.957c0,0.979,4.563,4.646,7.58,6.033c1.266,0.569,4.605,4.482,5.586,6.563
                           c0.487,1.021,1.143,2.078,1.427,2.361c0.244,0.285,0.487,0.896,0.487,1.268c0,0.566,0.448,0.813,1.754,1.02
                           c0.938,0.164,2.688,0.773,3.912,1.347c3.02,1.387,5.504,1.143,9.375-0.938c3.181-1.712,4.646-1.712,5.097,0.081
                           c0.163,0.57,0.813,1.345,1.509,1.712c1.345,0.774,1.753,1.834,1.509,3.872l-0.164,1.386l1.308-0.771
                           c0.73-0.449,3.016-1.104,5.055-1.551c2.077-0.407,3.953-0.938,4.156-1.142c0.447-0.449-0.611-1.632-2.648-3.059
                           c-1.752-1.184-2.607-6.521-1.347-8.273c0.531-0.692,0.692-0.733,1.957-0.205c0.732,0.285,2.038,0.652,2.854,0.733
                           c1.386,0.205,1.589,0.082,1.996-0.938c0.938-2.485,1.468-3.221,2.525-3.75c1.021-0.488,1.306-0.447,2.938,0.529
                           c2.037,1.182,5.138,2.364,5.421,2.078c0.082-0.121,0.041-1.631-0.123-3.383l-0.283-3.18l-4.157,0.121l-4.197,0.123l-1.59-1.508
                           c-1.469-1.388-1.836-1.511-4.935-1.834c-6.972-0.736-8.928-1.755-9.822-5.098c-0.325-1.104-0.611-2.241-0.733-2.525
                           c-0.162-0.531-0.081-0.531-6.889-0.692c-5.828-0.123-7.215-0.61-9.416-3.261c-2.078-2.486-3.099-2.979-6.073-2.854
                           c-1.875,0.082-3.099-0.164-5.38-1.062C381.096,357.309,379.871,357.188,379.871,358.245z" />
              <path class="territory" id="Azamgarh" data-id="520" d="M452.428,360.813c-0.53,0.367-0.53,0.407,0,0.326c2.08-0.203,2.729,1.021,1.793,3.182
                           c-0.366,0.854-0.731,2.24-0.731,3.099c-0.041,0.813-0.287,1.713-0.529,1.957c-0.366,0.367-0.326,0.731,0.16,1.468
                           c0.49,0.733,0.572,1.387,0.285,2.688c-0.162,0.938-0.364,3.793-0.404,6.358c-0.041,3.872-0.203,4.771-0.774,5.176
                           c-0.406,0.285-1.021,0.408-1.508,0.205c-1.916-0.689-6.237-4.4-7.989-6.85c-2.771-3.872-3.14-3.546-3.14,2.936
                           c-0.041,5.91,0.896,10.764,3.628,19.158c0.813,2.405,1.672,5.91,1.916,7.785l0.486,3.344l3.101,3.06
                           c2.565,2.565,3.628,3.301,6.356,4.399c2.242,0.896,3.751,1.833,4.771,2.937c1.224,1.305,1.713,1.549,2.445,1.305
                           c3.384-1.061,5.462-0.489,7.215,2.037c0.896,1.306,1.141,1.428,3.057,1.428c1.877,0,2.202-0.122,3.221-1.428
                           c0.611-0.772,2.039-1.874,3.142-2.444c2.201-1.102,2.606-1.998,1.142-2.483c-2.403-0.693-3.18-3.222-1.468-4.403
                           c1.265-0.896,1.793-0.814,4.28,0.407c2.241,1.144,3.383,1.103,3.383-0.203c0-0.448,0.449-1.306,0.979-1.915l0.938-1.145
                           l-0.813-1.834c-0.527-1.143-0.854-2.771-0.854-4.154c-0.041-1.998,0.122-2.488,1.306-3.792c0.69-0.815,1.303-1.673,1.303-1.875
                           c0-0.245-0.771-0.408-1.752-0.408c-2.977,0-3.508-1.549-1.712-5.055c0.61-1.224,0.938-2.322,0.773-2.935
                           c-0.326-1.307,0.082-1.875,2.895-3.914c3.466-2.567,4.688-4.483,5.341-8.479c0.366-2.446,0.772-3.587,1.592-4.565l1.1-1.304
                           l-1.631-0.61c-1.834-0.733-4.074-2.242-7.582-5.055l-2.444-1.916h-5.015h-5.054l-2.121-1.428l-2.118-1.428l-0.123,1.305
                           c-0.08,0.734,0.041,2.404,0.326,3.67c0.65,3.465-0.447,5.177-3.383,5.218c-1.388,0-1.875-0.325-4.321-2.772
                           c-1.508-1.508-3.587-3.463-4.564-4.358c-1.956-1.753-3.016-4.278-2.565-6.112c0.243-0.979,0.203-1.021-1.713-1.021
                           C453.937,360.365,452.755,360.568,452.428,360.813z" />
              <path class="territory" data-id="551" id="Jalaun"
                d="M170.156,361.873c-1.794,0.691-2.813,0.773-6.686,0.529l-2.608-0.204l-0.896,1.714l-0.938,1.712l1.225,1.101
                           c0.651,0.651,1.63,1.916,2.161,2.854c0.854,1.429,0.938,1.916,0.609,2.854c-0.366,0.938-0.568,1.062-1.794,0.856
                           c-1.141-0.164-1.549-0.042-2.403,0.854c-0.529,0.609-0.938,1.305-0.814,1.59c0.246,0.69-1.1,1.264-2.854,1.225
                           c-0.854-0.042-1.793,0.244-2.117,0.568c-0.57,0.569-0.57,0.732,0,1.834c1.223,2.365,0.528,3.953-2.446,5.666l-1.793,1.061
                           l0.896,1.509c0.447,0.813,1.469,2.201,2.199,3.058c0.735,0.814,1.348,1.795,1.348,2.119c0,0.775-2.979,2.938-4.524,3.263
                           c-0.652,0.161-1.385,0.651-1.631,1.062c-0.53,1.02-0.041,5.258,0.609,5.463c0.245,0.12,2.445,0.366,4.853,0.569
                           c2.405,0.202,4.688,0.608,5.014,0.854c0.938,0.814,0.652,2.242-0.608,3.344c-0.897,0.814-1.104,1.306-0.979,2.119
                           c0.285,1.428,0.979,1.143,1.875-0.692c0.57-1.265,0.896-1.509,1.916-1.509c1.426,0,1.957,0.979,2.322,4.279
                           c0.124,1.104,0.488,2.444,0.772,2.938c0.814,1.305,2.896,2.117,5.503,2.24c1.956,0.082,2.485-0.082,3.587-1.02
                           c1.387-1.144,3.222-1.428,4.035-0.611c0.284,0.285,0.487,1.103,0.487,1.793c0,1.713,0.367,1.916,2.283,1.225
                           c0.896-0.326,2.648-0.814,3.913-1.102c1.998-0.406,2.444-0.406,3.261,0.123c0.653,0.406,1.224,0.527,1.875,0.285
                           c0.734-0.285,0.897-0.652,0.897-2.16c0-1.551,0.161-1.959,1.182-2.649c1.426-1.021,1.63-1.021,3.139-0.245
                           c2.405,1.225,3.425,0.325,1.956-1.752c-0.406-0.57-0.567-1.346-0.406-1.916c0.284-1.061,1.714-1.753,2.404-1.061
                           c0.286,0.283,0.774,0.121,1.589-0.57c1.348-1.143,2.038-1.223,3.914-0.571c1.104,0.367,1.429,0.328,2.364-0.405
                           c0.854-0.651,1.427-0.814,2.568-0.61c2.281,0.366,4.196,1.347,5.666,2.896c1.345,1.426,2.118,1.467,2.118,0.12
                           c0-0.979,0.732-1.468,1.347-0.854c0.609,0.61,1.916,0.569,1.916-0.082c0-0.244-0.367-1.063-0.815-1.711
                           c-1.019-1.552-1.019-2.038,0-3.06c0.692-0.693,1.144-0.772,3.221-0.529c3.344,0.326,4.524-0.406,4.524-2.854
                           c0-1.386-0.245-1.996-1.019-2.73c-1.063-1.019-2.08-3.789-1.632-4.521c0.365-0.57-0.61-1.631-2.118-2.241
                           c-0.979-0.407-1.834-0.448-3.346-0.163c-1.386,0.243-2.402,0.243-3.016-0.041c-2.607-1.184-2.896-1.509-3.627-4.32
                           c-0.938-3.342-1.508-3.871-3.995-3.586c-2.526,0.326-3.75-0.408-4.28-2.446c-0.608-2.363-0.772-2.526-3.343-2.853
                           c-4.36-0.531-5.707-2.406-4.563-6.44c0.487-1.835,0-2.729-1.549-2.729c-1.957,0-4.604-1.998-4.604-3.506
                           c0-0.979-1.266-1.47-2.445-0.938c-3.506,1.59-7.011,1.426-9.131-0.489C175.127,360.977,172.845,360.813,170.156,361.873z" />
              <path class="territory" data-id="562" id="Mau" d="M500.323,374.673c-2.12,0.692-3.425,2.771-4.075,6.438c-0.325,1.795-0.774,3.709-1.063,4.199
                           c-0.733,1.385-4.402,5.135-5.91,6.071c-1.142,0.693-1.305,1.021-1.142,1.916c0.122,0.733-0.163,1.794-0.814,3.14
                           c-1.388,2.729-1.347,3.059,0.407,3.059c3.221,0,3.993,1.957,1.793,4.443c-1.631,1.834-1.834,2.813-1.06,5.42
                           c0.979,3.424,1.265,3.67,4.033,3.345c2.241-0.286,2.526-0.408,5.504-3.306c1.713-1.67,3.506-3.301,3.953-3.625
                           c1.144-0.815,3.83-0.692,8.969,0.405c7.377,1.632,7.011,1.591,7.256,0.285c0.121-0.651,1.142-2.12,2.242-3.343
                           c2.402-2.648,3.016-3.749,2.647-4.729c-0.449-1.304-2.283-2.976-3.222-2.976c-2.241,0-5.096-0.896-5.707-1.835
                           c-1.183-1.834,0.57-3.749,5.666-6.113c3.018-1.387,3.873-2.607,3.181-4.482c-0.326-0.938-0.326-1.631-0.041-2.404
                           c0.326-0.896,0.205-1.468-0.609-3.098c-0.53-1.104-1.184-2.08-1.348-2.201c-0.203-0.122-1.427,0.326-2.688,1.019l-2.281,1.224
                           l-3.222-0.648c-2.977-0.609-3.303-0.609-4.604,0.04c-1.388,0.652-1.47,0.652-3.304-0.407c-1.021-0.609-2.079-1.346-2.323-1.672
                           C501.993,374.143,501.993,374.143,500.323,374.673z" />
              <path class="territory" data-id="540" id="Fatehpur"
                d="M273.036,380.705c-0.448,0.773-1.102,1.223-2.079,1.428c-0.856,0.162-2.038,0.854-2.978,1.834
                           c-1.265,1.264-2.119,1.711-4.076,2.118c-2.403,0.488-2.566,0.61-7.46,5.585c-4.646,4.688-6.604,7.297-6.604,8.846
                           c0,0.326-0.653,1.347-1.468,2.241c-1.549,1.714-1.549,1.714,0.854,2.242c0.692,0.164,2.446,0.813,3.913,1.427
                           c2.527,1.143,2.854,1.184,5.259,0.773c1.429-0.202,2.689-0.487,2.854-0.569c0.285-0.163,4.688,0.326,7.337,0.854
                           c0.772,0.162,1.671,0.449,1.997,0.69c0.285,0.246,0.938,0.654,1.427,0.897c1.957,0.979,0.979,4.359-1.427,4.852
                           c-1.63,0.326-2.404,0.938-2.404,1.915c0,0.611,0.285,0.772,1.428,0.772c2.936,0,4.975,1.875,4.523,4.117
                           c-0.366,1.876,1.224,2.813,4.729,2.813c2.241,0,3.058,0.162,3.871,0.813c1.348,1.061,1.674,1.061,6.236-0.406
                           c4.076-1.307,5.096-1.307,6.889,0.041c0.61,0.447,2.038,0.938,3.179,1.142c2.609,0.407,3.386,0.979,3.386,2.649
                           c0,1.427,0.854,2.854,2.039,3.505c0.609,0.326,1.1,0.205,2.28-0.611c1.348-0.896,1.633-0.979,2.365-0.446
                           c1.102,0.69,1.265,1.632,0.651,3.506c-0.774,2.361,0.203,4.196,2.935,5.462c2.937,1.386,5.83,2.283,7.174,2.283
                           c1.877,0,2.69,0.854,2.405,2.606c-0.123,0.814-0.081,1.467,0.082,1.467c0.202,0,1.184-1.141,2.24-2.524
                           c1.55-2.121,1.876-2.854,1.876-4.32c0-2.119-0.814-3.832-2.364-4.934c-0.771-0.529-1.508-1.671-2.078-3.303l-0.896-2.444
                           l1.102-2.444c1.104-2.446,1.467-2.854,6.236-6.687c1.346-1.143,2.484-2.242,2.484-2.567c0-0.854-2.484-3.383-3.627-3.669
                           c-2.771-0.691-5.667-4.523-6.072-8.109l-0.162-1.713l-2.12,0.204c-1.875,0.163-2.323,0.04-4.688-1.347
                           c-2.526-1.508-4.036-3.303-4.729-5.463c-0.489-1.631-0.979-1.998-2.938-2.28c-1.794-0.245-5.545,0.325-10.476,1.711
                           c-2.977,0.854-4.441,0.733-5.707-0.448c-0.569-0.529-1.061-1.305-1.061-1.711c0-0.408-0.204-1.428-0.448-2.283
                           c-0.326-1.265-0.733-1.712-2.119-2.363c-0.979-0.407-2.648-0.772-3.831-0.772c-1.712,0-2.486-0.245-3.954-1.267
                           c-0.979-0.69-1.957-1.672-2.201-2.159c-1.468-3.263-2.363-4.892-2.729-5.015C273.893,379.605,273.405,380.053,273.036,380.705z" />
              <path class="territory" data-id="526" id="Ballia" d="M524.781,380.582c-0.408,0.408-0.53,0.938-0.367,1.348c1.347,3.057,0.121,5.137-4.156,7.174
                           c-1.712,0.814-3.587,1.955-4.158,2.527c-1.02,1.018-1.02,1.1-0.282,1.385c0.446,0.164,1.873,0.448,3.22,0.61
                           c2.771,0.327,4.812,1.795,5.544,4.036c0.611,1.834-0.123,3.506-2.813,6.48c-1.143,1.264-2.077,2.606-2.077,3.018
                           c0,0.404,0.487,1.018,1.141,1.385c0.611,0.366,2.445,1.794,4.116,3.221c2.445,2.037,3.751,2.771,6.851,3.914
                           c5.136,1.832,6.193,2.403,6.479,3.627c0.407,1.551-0.08,4.116-1.264,7.012c-1.103,2.688-1.021,3.303,0.487,4.646
                           c0.69,0.651,0.854,0.651,2.078,0.041c2.364-1.144,4.894-4.403,5.829-7.5c1.753-5.788,4.361-6.687,9.579-3.262
                           c1.672,1.101,3.587,2.118,4.197,2.282c1.673,0.364,4.199-1.021,6.727-3.67c2.08-2.158,2.487-2.361,4.239-2.281
                           c1.063,0.041,4.402,2.977,4.771,4.156c0.325,1.021,2.28,1.998,4.033,1.998c0.855,0,2.854-0.773,5.38-2.037
                           c2.446-1.223,4.524-2.039,5.342-2.039h1.387l-2.771-3.303c-2.937-3.545-3.912-4.197-7.459-4.646
                           c-3.629-0.49-3.994-0.732-5.342-3.751c-0.691-1.55-1.385-3.06-1.549-3.386c-0.244-0.445-1.142-0.609-3.547-0.65
                           c-2.689,0-3.586-0.203-5.38-1.102c-2.689-1.428-5.055-3.752-6.358-6.316c-1.305-2.566-3.586-4.604-7.217-6.439
                           c-1.629-0.771-3.871-2.078-5.053-2.854c-2.078-1.389-2.201-1.43-4.035-0.938c-2.119,0.529-7.297,0.284-9.741-0.447
                           c-0.979-0.284-2.444-1.346-3.792-2.69C526.45,379.768,525.84,379.564,524.781,380.582z" />
              <path class="territory" data-id="553" id="Jaunpur" d="M429.846,383.15c-0.366,0.367-0.651,0.938-0.651,1.225c0,1.141-1.265,2.854-2.403,3.22
                           c-1.265,0.448-2.771,0.203-4.481-0.692c-0.815-0.446-0.856-0.405-0.856,1.348c0,2.566,0.569,3.709,2.364,4.934
                           c1.996,1.305,2.689,2.688,2.037,4.034c-0.529,1.226-0.813,1.347-5.341,2.282c-4.4,0.938-5.543,1.59-5.299,3.018
                           c0.447,2.322-0.854,3.791-3.994,4.483c-0.61,0.122-1.631,0.896-2.243,1.711c-2.647,3.263-3.342,3.791-5.787,4.481
                           c-1.385,0.367-2.565,0.938-2.688,1.226c-0.081,0.244,0.081,1.347,0.405,2.442c0.692,2.324,0.733,4.443,0.082,6.318
                           c-0.527,1.63-2.566,4.688-3.872,5.91l-0.896,0.813l4.359,2.039c3.344,1.508,5.056,2.606,7.421,4.729
                           c3.423,3.097,4.563,3.587,8.764,3.587c3.179,0,3.261,0.039,4.77,2.119c1.225,1.589,2.282,2.079,6.439,2.771
                           c3.22,0.568,4.563,1.263,5.747,2.895c0.896,1.305,2.936,2.403,4.441,2.403c0.611,0,0.814-0.285,0.814-0.979
                           c0-1.386,0.651-2.936,1.672-4.034c0.854-0.896,0.854-1.59,0.164-4.481c-0.449-1.754,0.446-3.425,2.199-3.994
                           c0.813-0.285,2.241-1.021,3.221-1.673c1.711-1.184,1.793-1.184,3.301-0.61c1.186,0.488,1.958,0.528,3.345,0.244
                           c1.631-0.366,3.425-0.284,5.421,0.326c0.406,0.122,1.143,1.102,1.631,2.241l0.896,1.997l2.119-2.241
                           c2.2-2.404,3.343-2.813,4.605-1.631c0.691,0.65,0.772,0.609,1.102-0.284c0.204-0.53,0.488-2.323,0.651-3.913
                           c0.285-2.854,0.244-3.02-0.979-4.813c-1.428-2.077-2.647-2.567-4.934-1.876c-1.914,0.571-3.994-0.122-5.055-1.753
                           c-0.447-0.649-1.875-1.507-3.952-2.364c-2.73-1.101-3.914-1.916-6.81-4.687l-3.546-3.302l-0.529-3.792
                           c-0.243-2.119-0.979-5.179-1.55-6.89c-0.609-1.672-1.834-6.072-2.729-9.742l-1.672-6.687l-1.711-0.487
                           c-0.938-0.283-2.526-0.979-3.506-1.59C430.578,382.458,430.496,382.417,429.846,383.15z" />
              <path class="territory" data-id="547" id="Hamirpur"
                d="M226.651,385.229c-0.041,0.326-0.569,1.754-1.224,3.183c-1.467,3.343-1.386,5.177,0.325,7.338
                           c1.061,1.385,1.265,1.956,1.265,3.831s-0.163,2.361-1.061,3.22c-0.896,0.855-1.469,0.979-4.158,1.062
                           c-1.711,0.041-3.179,0.082-3.219,0.082c-0.082,0.039,0.283,0.772,0.771,1.711c1.185,2.283,0.693,3.793-1.223,3.953
                           c-0.773,0.082-1.712,0.49-2.161,0.938c-1.101,1.104-1.793,0.979-3.75-0.773c-2.976-2.647-5.136-3.301-6.848-2.037
                           c-1.021,0.772-1.306,0.813-2.978,0.365c-1.834-0.447-3.098-0.283-3.098,0.407c0,0.651-1.754,1.103-2.528,0.692
                           c-0.896-0.448-0.938,0-0.122,1.063c0.734,0.979,0.815,3.139,0.122,3.83c-0.69,0.691-2.729,0.61-4.157-0.123
                           c-1.59-0.813-2.199-0.242-2.362,2.161c-0.122,1.793-0.245,1.957-1.712,2.688c-1.51,0.732-1.673,0.732-2.813,0.121
                           c-1.671-0.979-1.834-0.896-2.16,1.185c-0.163,1.224-0.772,2.526-1.875,3.953c-1.59,2.079-1.59,2.161-1.345,4.771
                           c0.244,2.567,1.02,4.076,2.079,4.076c0.285,0,0.979,0.569,1.548,1.264c0.896,1.062,1.021,1.509,0.814,2.772
                           c-0.162,0.813-0.447,1.671-0.651,1.914c-0.366,0.488,2.365,1.386,4.239,1.386c0.528,0,1.346,0.287,1.834,0.61
                           c1.061,0.733,7.825,1.225,10.107,0.733c1.266-0.284,1.753-0.651,2.241-1.632c0.815-1.711,5.462-5.421,6.768-5.421
                           c1.225,0,2.445-0.609,3.831-1.874c1.712-1.59,2.896-1.631,4.279-0.124c1.55,1.631,2.854,2.119,3.914,1.553
                           c0.652-0.328,1.06-0.286,1.834,0.201c0.938,0.652,0.979,0.611,2.201-1.019c0.651-0.938,1.224-1.877,1.224-2.08
                           c0-0.529,1.184-0.365,2.241,0.325c1.021,0.652,1.386,2.323,0.652,2.813c-0.489,0.285,0.204,2.404,0.979,3.058
                           c0.366,0.326,0.814,0.205,1.671-0.528c2.079-1.713,3.181-1.713,5.016-0.041c0.896,0.772,2.159,1.59,2.771,1.754
                           c0.653,0.162,1.387,0.772,1.673,1.385c0.284,0.611,0.814,1.103,1.143,1.103s1.06,0.285,1.589,0.65
                           c0.979,0.611,0.979,0.611,1.427-1.142c1.183-4.604,2.08-5.911,3.627-5.422c1.021,0.325,1.957-0.164,2.609-1.305
                           c0.285-0.488,1.059-1.712,1.793-2.73l1.304-1.875l-1.019-1.183l-0.979-1.183l0.856-1.469c0.813-1.427,0.813-1.427,0.041-3.18
                           c-0.57-1.348-1.183-1.957-2.69-2.689c-1.06-0.529-2.201-1.427-2.567-1.998c-0.651-0.978-0.651-1.06,0.082-1.589
                           c0.407-0.327,1.021-0.569,1.347-0.569c0.285,0,1.712-0.854,3.18-1.875c3.668-2.607,3.505-3.67-0.896-5.586
                           c-1.386-0.609-3.14-1.222-3.871-1.345c-0.774-0.163-1.834-0.61-2.405-1.021c-0.571-0.367-1.671-0.772-2.446-0.854
                           c-1.1-0.082-1.549-0.407-1.956-1.306c-0.408-0.771-1.305-1.467-2.729-2.119c-2.527-1.102-2.937-1.914-2.038-4.157
                           c0.367-0.896,0.61-2.159,0.529-2.813l-0.122-1.142l-3.67-0.081c-4.156-0.082-6.357-0.814-7.417-2.404
                           c-0.652-1.02-0.652-1.143,0.121-2.567c0.61-1.021,0.732-1.793,0.528-2.485C226.814,385.066,226.651,384.902,226.651,385.229z" />
              <path class="territory" data-id="572" id="Pratapgarh"
                d="M353.255,387.676c-0.731,0.814-1.507,1.223-2.282,1.223c-1.426,0-1.793,0.979-1.021,2.854
                           c0.692,1.59,0.733,3.505,0.123,3.913c-0.283,0.162,0,0.732,0.773,1.549c3.181,3.344,2.771,5.951-0.938,5.951
                           c-2.647,0-6.235,1.916-10.107,5.381c-1.835,1.671-3.832,3.18-4.401,3.303c-0.854,0.203-1.183,0.651-1.591,2.078
                           c-0.487,1.793-0.487,1.793,1.265,4.157c1.713,2.242,2.363,3.424,4.688,7.989c1.183,2.283,2.936,3.83,5.055,4.4
                           c0.855,0.244,2.119,0.896,2.771,1.428c0.65,0.569,2.077,1.387,3.138,1.836l1.957,0.854l1.306-1.467
                           c1.508-1.631,1.875-1.713,3.464-0.734c1.103,0.611,1.266,0.611,3.019-0.041c3.18-1.223,3.75-1.915,4.278-5.136
                           c0.529-3.425,1.713-5.951,2.896-6.316c0.57-0.165,1.672,0.12,3.018,0.773c2.647,1.304,2.771,1.304,5.463,0.04
                           c1.996-0.938,6.604-1.753,8.438-1.509c1.021,0.123,1.427,0.772,1.427,2.323c0,0.979,0.284,1.428,1.348,2.038
                           c0.69,0.406,2.239,1.672,3.424,2.771c1.834,1.711,2.282,1.955,3.261,1.711c0.611-0.121,1.793-1.021,2.648-1.916
                           c3.018-3.302,3.833-6.479,2.566-10.107c-1.061-3.058-0.285-4.278,3.587-5.461c2.486-0.733,2.607-0.854,4.077-3.1
                           c1.102-1.671,3.302-3.261,4.605-3.261c1.916,0,2.936-2.405,1.508-3.468c-0.529-0.404-0.692-1.06-0.61-2.729
                           c0.081-1.916-0.042-2.199-0.813-2.566c-0.531-0.243-1.226-1.021-1.55-1.713c-0.734-1.588-0.938-1.629-2.527-0.487
                           c-1.59,1.143-5.665,2.403-7.744,2.403c-0.896,0-2.567-0.486-3.914-1.101c-2.16-1.063-2.812-1.146-9.455-1.428
                           c-3.914-0.163-7.868-0.407-8.765-0.53c-1.468-0.244-1.876-0.081-3.669,1.184c-2.242,1.631-4.32,2.688-5.299,2.688
                           c-0.367,0-1.266-0.61-1.997-1.344c-0.775-0.693-1.875-1.755-2.446-2.242l-1.062-0.979l-1.061,0.854
                           c-1.304,1.021-2.281,0.651-3.22-1.306c-0.854-1.795-3.587-5.707-4.116-5.868C354.52,386.492,353.865,386.982,353.255,387.676z" />
              <path class="territory" data-id="550" id="Jhansi"
                d="M145.29,404.958c-0.571,0.569-1.021,1.428-1.021,1.957c0,0.487-0.65,1.589-1.509,2.444
                           c-1.468,1.469-1.468,1.51-0.773,2.566c0.896,1.389,0.692,3.426-0.446,4.158c-0.815,0.566-0.938,0.488-1.549-0.691
                           c-0.856-1.633-1.755-1.469-2.446,0.528c-0.692,1.998-1.266,2.604-2.689,2.935c-1.672,0.367-1.794,0.855-0.487,1.918
                           c2.322,1.957,2.935,2.729,3.342,4.237c1.101,3.912,0.408,4.729-5.34,6.358c-0.856,0.244-2.609,1.386-3.995,2.646l-2.446,2.242
                           l-1.671-0.813c-1.712-0.855-2.446-0.773-4.117,0.405c-0.854,0.611-4.034-0.119-5.707-1.345l-1.141-0.813l-1.834,1.711l-1.876,1.714
                           l-1.63-0.529c-1.387-0.49-1.711-0.49-1.997,0c-0.204,0.325-0.204,0.772-0.042,1.021c0.204,0.201,0.447,1.265,0.569,2.281
                           c0.244,1.752,0.163,1.956-1.265,3.303c-0.814,0.772-2.404,1.753-3.465,2.118c-1.103,0.408-2.079,1.063-2.161,1.429
                           c-0.122,0.364-0.487,1.183-0.854,1.875c-0.365,0.65-1.02,1.875-1.427,2.688l-0.772,1.509l1.672,3.994
                           c0.896,2.243,1.997,4.525,2.443,5.139c0.447,0.609,0.814,1.306,0.814,1.591c0,0.244,0.815,1.508,1.793,2.813
                           c0.979,1.265,1.916,2.73,2.08,3.263c0.204,0.65,0.489,0.813,1.142,0.65c0.488-0.123,1.103-0.244,1.347-0.244
                           c0.245,0,0.938-0.69,1.508-1.59c0.854-1.305,1.427-1.672,3.138-2.079c1.753-0.408,2.201-0.408,3.061,0.163
                           c1.182,0.773,1.589,0.326,1.223-1.346c-0.449-2.079-2.937-3.71-5.584-3.71c-1.427,0-4.402-0.814-4.402-1.223
                           c0-0.123,1.348-0.57,2.978-0.979c1.59-0.408,3.261-0.816,3.669-0.938c0.408-0.08,0.978-0.608,1.345-1.143
                           c0.489-0.773,0.53-1.142,0.163-1.834c-0.407-0.733-0.366-1.02,0.122-1.507c0.571-0.57,0.692-0.49,1.264,0.651
                           c0.692,1.265,1.752,1.63,2.568,0.813c0.285-0.285,0.081-1.021-0.652-2.445c-0.854-1.631-0.937-2.079-0.487-2.362
                           c0.979-0.61,4.563-0.938,5.137-0.448c0.408,0.325,0.732,0.163,1.345-0.693c0.448-0.609,0.938-1.549,1.103-2.078
                           c0.202-0.771,0.528-0.938,1.55-0.813c1.182,0.123,1.305,0.245,1.305,1.55c0,1.141-0.204,1.508-1.101,1.955
                           c-1.471,0.691-1.429,1.102,0.081,1.998c0.691,0.365,1.224,0.854,1.224,1.06c0,0.164,0.854,0.693,1.956,1.185
                           c1.06,0.487,2.038,0.979,2.161,1.061c0.731,0.367,1.508-1.223,1.304-2.566c-0.163-1.021-0.041-1.673,0.448-2.16
                           c0.609-0.691,0.568-0.814-0.489-1.589c-0.611-0.448-1.711-1.104-2.404-1.511c-1.101-0.528-1.345-0.896-1.345-1.998
                           c0-2.157,0.979-3.138,3.138-3.138c1.592,0,2.039,0.204,3.223,1.468c0.771,0.774,1.386,1.875,1.386,2.404
                           c0,1.468,0.407,2.242,1.223,2.242c1.387,0,1.671-0.979,1.549-5.666l-0.122-4.564l1.347-1.223c2.688-2.405,5.014-0.693,5.299,3.831
                           c0.123,2.2,0,2.688-0.854,3.75l-1.021,1.224l2.405,2.689c1.997,2.24,2.401,2.976,2.401,4.197c0,1.225-0.202,1.551-1.06,1.876
                           c-1.468,0.568-1.997,0.527-3.058-0.366l-0.979-0.815l0.897-0.65c0.527-0.366,1.142-1.021,1.345-1.469
                           c0.771-1.428-1.712-0.979-3.75,0.652c-0.979,0.772-2.979,2.241-4.443,3.22c-2.976,2.038-3.505,2.526-3.709,3.709
                           c-0.081,0.653,0.081,0.815,0.938,0.692c1.712-0.162,2.282,0.896,1.467,2.607c-0.855,1.754-0.855,2.199-0.081,2.199
                           c0.326,0,1.63-1.549,2.895-3.505c2.486-3.75,3.467-4.646,4.975-4.646c2.08,0,3.71,3.384,2.444,4.933
                           c-0.486,0.611-2.729,1.427-4.563,1.672c-1.143,0.163-1.998,2.937-1.468,4.646c0.245,0.691,0.325,2.037,0.161,2.977
                           c-0.202,1.387-0.161,1.672,0.406,1.672c0.326,0,1.104-0.691,1.631-1.55c1.225-1.955,3.71-4.157,4.688-4.157
                           c0.407,0,1.061,0.367,1.468,0.815c1.063,1.182,1.226,0.73,0.367-1.428c-0.774-2.077-0.489-2.648,1.345-2.648
                           c0.734,0,5.789,4.32,5.381,4.646c-0.08,0.04-0.896,0.365-1.793,0.691c-1.754,0.652-2.16,1.508-1.631,3.546l0.284,1.103l0.653-0.896
                           c0.978-1.304,4.44-2.976,4.932-2.402c0.163,0.243,0.448,1.346,0.571,2.402c0.204,2.283,0.978,3.262,2.935,3.832
                           c1.672,0.53,1.997,0.204,1.631-1.468c-0.365-1.712,0.284-1.835,2.896-0.611c1.997,0.938,2.648,1.062,5.299,0.896
                           c3.669-0.243,4.646-0.938,4.646-3.222c0-0.854-0.161-1.672-0.406-1.794c-0.204-0.122-0.407-0.854-0.407-1.549
                           c0-0.73-0.286-1.672-0.612-2.078c-0.325-0.447-0.608-1.183-0.608-1.631c0-1.345-1.429-3.302-2.772-3.872
                           c-0.691-0.286-1.385-0.896-1.548-1.346c-0.326-1.143,0.611-3.181,1.467-3.181c0.408,0,1.266-0.651,1.916-1.429
                           c0.611-0.813,1.712-2.118,2.405-2.976c1.223-1.469,2.729-5.137,2.854-6.809c0-0.447,0.041-1.306,0.082-1.875
                           c0.041-0.609,0.691-1.997,1.469-3.1c2.037-2.976,2.037-4.076,0.041-5.503c-0.896-0.611-1.834-1.1-2.079-1.141
                           c-0.57,0-1.185-6.441-0.774-7.826c0.163-0.531,0.856-1.508,1.508-2.201c0.653-0.693,1.348-1.957,1.551-2.771
                           c0.365-1.752,0.04-1.834-2.937-0.771c-1.753,0.609-1.956,0.609-2.935-0.041c-0.815-0.489-1.063-1.021-1.063-2.08
                           c0-1.712-0.569-1.792-2.12-0.324c-1.1,1.062-1.386,1.103-4.399,1.021c-2.242-0.082-3.668-0.326-4.565-0.815
                           c-1.875-1.06-3.179-3.139-3.179-5.013c0-0.856-0.204-2.039-0.448-2.69l-0.449-1.142l-0.405,1.019
                           c-1.267,3.342-4.402,3.303-4.976-0.08c-0.244-1.265-0.081-1.672,0.979-2.937l1.265-1.427l-1.346-0.203
                           c-0.734-0.123-2.731-0.326-4.402-0.449c-1.671-0.121-3.383-0.326-3.75-0.447C146.594,404.021,145.903,404.348,145.29,404.958z" />
              <path class="territory" data-id="544" id="Ghazipur" d="M499.55,410.094c-1.917,1.877-3.71,3.549-3.954,3.711c-0.284,0.161-1.794,0.407-3.384,0.569
                           c-3.019,0.284-4.318,0.979-4.318,2.323c0,1.02-1.429,2.363-2.528,2.363c-0.527,0-1.834-0.449-2.976-1.021
                           c-1.104-0.528-2.283-1.021-2.568-1.021c-1.062,0-0.285,1.429,1.063,1.998c1.387,0.61,1.956,1.833,1.548,3.221
                           c-0.161,0.449-1.344,1.387-2.648,2.079c-1.549,0.813-2.688,1.793-3.261,2.688c-0.774,1.346-0.938,1.428-3.058,1.428h-2.201
                           l-0.325,3.14c-0.122,1.755-0.53,3.873-0.815,4.771c-0.568,1.507-0.527,1.629,0.652,2.977c0.691,0.731,1.225,1.55,1.225,1.753
                           c0,0.938,2.241,0.285,4.196-1.184c1.185-0.854,2.73-1.712,3.466-1.835c1.956-0.446,5.422,0.449,7.785,1.997
                           c2.2,1.468,3.506,1.59,4.935,0.408c0.324-0.285,1.223-0.693,1.995-0.938c1.225-0.449,1.51-0.367,2.649,0.568
                           c0.691,0.569,1.876,1.427,2.648,1.916c1.956,1.225,5.991,8.521,6.357,11.413c0.488,3.872,0.244,3.75,3.994,1.834
                           c1.835-0.979,4.729-2.771,6.399-4.034c3.423-2.607,8.561-7.745,8.561-8.603c0-1.224,2.161-3.628,4.198-4.646
                           c1.181-0.609,3.22-1.834,4.563-2.771c1.306-0.896,2.608-1.793,2.813-1.956c0.285-0.162,0.082-0.651-0.488-1.224
                           c-1.793-1.915-1.875-3.14-0.486-6.604c0.649-1.712,1.223-3.749,1.223-4.524c0-1.629-0.284-1.832-5.951-3.83
                           c-2.854-1.021-4.321-1.834-6.114-3.383c-4.319-3.668-5.136-4.076-11.087-5.341c-3.098-0.651-6.727-1.266-8.109-1.387l-2.568-0.203
                           L499.55,410.094z" />
              <path class="territory" data-id="527" id="Banda"
                d="M259.911,408.668c-0.856,0.326-1.793,0.486-2.079,0.367c-0.449-0.164-0.53,0.16-0.367,1.549l0.204,1.753
                           l-3.1,2.362c-1.712,1.265-3.424,2.322-3.791,2.322c-0.405,0.041,0.245,0.489,1.469,1.104c1.834,0.896,2.322,1.346,3.139,3.139
                           c1.102,2.404,1.183,2.936,0.408,4.32c-0.53,0.896-0.489,1.182,0.286,2.526l0.896,1.509l-0.938,1.224
                           c-0.488,0.69-0.896,1.426-0.896,1.67c0,0.205-0.366,0.611-0.813,0.896c-0.449,0.285-0.814,0.731-0.814,0.979
                           c0,1.184-1.469,2.283-3.18,2.322c-1.711,0.082-1.753,0.123-2.365,2.12c-0.325,1.102-0.772,3.424-0.938,5.095
                           c-0.489,4.812-1.592,5.952-4.076,4.441c-1.711-1.02-2.242-0.979-1.51,0.123c0.529,0.814,0.529,1.224,0.042,3.14
                           c-0.325,1.226-0.854,2.607-1.183,3.101c-0.73,1.1-0.488,1.426,0.979,1.426c1.507,0,3.627-2.283,3.951-4.319
                           c0.124-0.854,0.448-1.712,0.692-1.876c0.897-0.611,3.14-0.285,5.421,0.774c1.305,0.567,2.568,1.02,2.813,0.979
                           s0.65,0.162,0.854,0.448c0.652,0.813,0.938,6.274,0.449,7.703c-0.408,1.144-0.326,1.347,1.182,2.771
                           c0.855,0.855,2.037,1.672,2.608,1.794c1.712,0.449,3.179,1.875,3.709,3.628c0.449,1.551,0.449,1.713-0.407,2.322
                           c-4.604,3.262-4.81,3.507-4.646,5.3c0.162,1.468,0,1.915-0.938,2.896c-1.305,1.388-2.895,1.834-4.358,1.265
                           c-0.857-0.326-1.186-0.244-1.755,0.366c-0.609,0.693-0.609,0.896,0.447,3.018c1.509,3.1,1.957,3.465,3.507,2.568
                           c1.632-0.938,3.018-0.856,3.709,0.121c0.529,0.772,0.651,0.813,1.225,0.203c0.609-0.568,0.568-0.773-0.163-2.038l-0.815-1.385
                           l1.55-1.021c0.855-0.571,1.957-1.346,2.486-1.712c1.346-0.979,2.567-0.285,4.32,2.485c1.508,2.321,2.976,3.262,4.359,2.854
                           c1.143-0.365,0.979-0.813-1.02-2.444c-1.263-1.02-1.997-2.076-2.444-3.344c-0.365-1.059-0.65-1.956-0.65-1.995
                           c0-0.124,3.138,0.855,4.481,1.346c0.325,0.163,0.896,0.204,1.265,0.163c0.365-0.041,0.896,0.202,1.183,0.568
                           c1.264,1.508,2.813-0.406,2.038-2.483c-0.57-1.43-0.489-3.141,0.122-3.995c0.489-0.652,0.571-0.652,1.061-0.082
                           c0.284,0.326,0.61,1.387,0.732,2.28c0.204,1.39,0.53,1.878,1.712,2.65c0.815,0.489,1.793,1.304,2.161,1.794
                           c0.489,0.57,1.182,0.854,2.242,0.854c0.813,0,2.079,0.202,2.813,0.486c0.692,0.245,1.589,0.326,1.956,0.205
                           c0.571-0.205,0.571-0.407,0.204-1.182c-0.285-0.531-0.611-1.227-0.773-1.55c-0.161-0.326-1.265-1.267-2.444-2.039l-2.161-1.469
                           l0.082-3.83c0.082-3.467,0.204-3.994,1.142-5.22c0.57-0.771,1.55-1.549,2.201-1.794l1.184-0.406l-0.244-3.425
                           c-0.326-3.913,0.202-5.054,2.362-5.054c2.69,0,5.748-2.486,8.03-6.645c1.061-1.877,1.752-2.568,3.342-3.345
                           c1.062-0.57,2.405-1.02,2.977-1.02c1.103,0,2.283-1.347,2.283-2.527c0-0.366,0.365-0.896,0.814-1.142
                           c0.979-0.529,1.021-1.144,0.122-3.709c-0.611-1.631-0.611-2.2-0.203-3.344c0.771-2.199,0.608-2.566-0.652-1.388
                           c-1.428,1.388-2.323,1.388-4.238,0.082c-1.103-0.732-1.631-1.508-1.997-2.771c-0.243-0.938-0.528-1.958-0.61-2.243
                           c-0.082-0.244-0.773-0.488-1.549-0.488c-0.776,0-2.405-0.528-3.709-1.223l-2.283-1.226l-3.914,1.267
                           c-4.156,1.346-6.113,1.385-7.459,0.162c-0.447-0.407-1.507-0.611-3.301-0.611c-3.832,0-6.441-1.956-5.87-4.44
                           c0.326-1.552-0.938-2.486-3.302-2.486c-1.793,0-2.364-0.408-2.731-2.037c-0.325-1.43,1.104-3.1,3.183-3.751
                           c1.712-0.57,2.361-1.712,1.141-2.078c-0.407-0.164-1.02-0.448-1.345-0.651C267.412,408.504,262.031,407.893,259.911,408.668z" />
              <path class="territory" data-id="557" id="Kaushambi"
                d="M331.162,418.777c-0.652,0.488-1.509,1.183-1.835,1.549c-0.325,0.365-1.508,1.387-2.607,2.241
                           c-1.225,0.979-2.363,2.321-2.896,3.506c-0.854,1.835-0.854,1.997-0.245,3.954c0.448,1.346,1.021,2.242,1.794,2.688
                           c1.632,0.979,2.73,3.424,2.73,6.032c0,1.997-0.204,2.445-1.997,4.933c-1.103,1.47-2.936,3.548-4.077,4.565
                           c-1.67,1.508-1.996,1.996-1.629,2.445c0.243,0.324,0.896,0.568,1.426,0.568c1.511,0,3.751,1.551,4.688,3.263
                           c0.488,0.896,1.101,1.67,1.386,1.793c0.244,0.081,1.55-0.405,2.896-1.063c2.648-1.385,5.341-1.711,6.48-0.73
                           c0.528,0.445,0.651,1.019,0.528,2.443c-0.163,1.753-0.081,1.956,1.062,2.69c1.102,0.731,1.63,0.813,4.117,0.527
                           c7.541-0.854,7.499-0.854,8.273-2.402c0.528-1.063,1.183-1.631,2.729-2.241c2.039-0.815,3.669-1.835,5.136-3.182
                           c0.855-0.772,1.063-2.937,0.326-3.384c-0.771-0.448-1.997-3.547-1.997-5.097c0-0.813,0.245-2.201,0.57-3.099
                           c0.488-1.429,0.488-1.713,0-2.2c-0.286-0.326-0.733-1.469-0.938-2.569c-0.529-2.854-0.979-3.097-2.282-1.1
                           c-0.611,0.896-1.266,1.672-1.468,1.672c-0.733,0-6.316-2.771-6.85-3.384c-0.285-0.367-1.224-0.856-2.079-1.103
                           c-2.403-0.649-4.688-2.565-5.868-4.974c-1.957-3.913-5.341-9.293-5.869-9.293C332.508,417.84,331.855,418.287,331.162,418.777z" />
              <path class="territory" data-id="516" id="Prayagraj" d="M379.466,422.324c-0.773,0.161-2.241,0.69-3.263,1.141c-1.955,0.938-4.074,1.144-4.688,0.53
                           c-0.244-0.245-1.102-0.692-1.957-1.063l-1.548-0.649l-0.733,1.752c-0.449,0.979-0.896,2.771-1.062,3.994
                           c-0.162,1.224-0.569,2.647-0.896,3.182c-0.569,0.896-5.055,3.342-6.112,3.342c-0.815,0-0.611,1.956,0.324,3.222
                           c0.814,1.102,0.814,1.224,0.203,3.059c-0.938,2.771-0.813,4.32,0.57,6.479c1.753,2.813,1.468,5.91-0.611,7.012
                           c-0.448,0.203-1.386,0.773-2.037,1.265c-0.691,0.449-2.08,1.145-3.099,1.55c-2.16,0.772-2.568,1.711-2.445,5.339
                           c0.082,1.553-0.123,2.324-0.732,3.141c-1.143,1.428-0.611,3.182,0.938,3.182c1.753,0,2.526,1.265,2.771,4.482
                           c0.122,1.265,0.284,1.467,1.467,1.63c0.733,0.122,1.347,0.327,1.306,0.489c0,0.203,0,0.487,0,0.65s-0.529,0.651-1.224,1.021
                           c-1.347,0.814-1.509,1.388-0.651,2.525c0.448,0.651,1.102,0.774,4.197,0.774l3.67,0.04l2.118,1.916
                           c2.405,2.16,4.036,2.771,7.582,2.771c1.347,0,3.099,0.122,3.872,0.245l1.428,0.245l-0.164,3.505
                           c-0.162,4.482,0.49,7.541,1.875,8.604c1.184,0.979,4.239,2.159,9.092,3.546c1.915,0.528,3.75,1.101,4.076,1.183
                           c0.447,0.122,1.182-0.65,2.362-2.403c0.938-1.429,3.425-4.198,5.544-6.114c5.789-5.339,6.849-6.89,8.438-12.597
                           c1.307-4.646,1.307-4.81,0.651-6.194c-0.487-1.061-1.752-2.119-4.769-4.074c-2.979-1.916-4.28-3.018-4.729-4.036
                           c-1.223-2.486,0.082-4.811,3.629-6.479c2.568-1.225,3.75-2.526,4.158-4.646c0.326-1.835,1.304-3.791,1.834-3.791
                           c0.611,0,1.792-2.69,1.508-3.465c-0.162-0.367-0.896-0.896-1.672-1.224c-1.713-0.732-3.098-2.405-3.098-3.751
                           c0-0.611,0.527-1.51,1.264-2.2c0.693-0.651,1.101-1.184,0.896-1.184c-0.161,0-1.549-1.101-3.057-2.484
                           c-2.039-1.794-3.954-3.019-7.339-4.605c-2.525-1.184-5.298-2.282-6.194-2.404c-1.102-0.161-2.2-0.854-3.914-2.403
                           c-1.305-1.185-2.936-2.566-3.626-3.1c-0.896-0.691-1.267-1.305-1.267-2.159c0-1.144-0.08-1.183-1.711-1.144
                           C381.666,421.997,380.24,422.158,379.466,422.324z" />
              <path class="territory" data-id="565" id="Mahoba" d="M214.992,433.369c-0.531,0.854-4.036,2.813-5.017,2.813c-1.264,0-5.666,3.465-5.951,4.729
                           c-0.527,1.998-1.916,2.405-8.068,2.364c-4.443,0-5.748-0.162-6.318-0.651c-0.406-0.326-1.468-0.734-2.363-0.855
                           c-0.896-0.122-2.281-0.365-3.14-0.527c-1.712-0.286-2.323,0.405-2.405,2.729c-0.08,2.323-1.712,6.932-2.976,8.275
                           c-1.508,1.631-2.038,2.934-1.266,3.262c0.326,0.121,0.691,0.896,0.855,1.752c0.326,1.835,1.916,4.076,3.139,4.442
                           c0.488,0.163,1.387,0.609,1.997,1.019c1.266,0.896,1.834,0.531,2.771-1.63c0.528-1.305,0.979-1.59,1.427-0.854
                           c0.123,0.201,0.57,0.405,1.02,0.405c0.691,0,0.691,0.041-0.041,1.51c-0.446,0.854-1.752,2.566-2.895,3.791
                           c-1.549,1.63-2.322,2.895-2.854,4.604c-1.226,3.954-1.021,4.362,2.118,3.954c1.306-0.163,2.567-0.122,2.978,0.082
                           c0.731,0.367,0.731,0.447-0.082,1.182l-0.814,0.773l0.855,1.428c0.45,0.814,1.062,1.386,1.306,1.304
                           c0.244-0.041,1.63-1.915,3.059-4.073c2.362-3.628,2.688-3.953,3.87-3.953c1.225,0.041,2.12,0.854,3.508,3.261
                           c0.324,0.489,0.69,0.489,2.935,0c1.427-0.285,3.139-0.57,3.832-0.652c0.693-0.041,1.63-0.242,2.038-0.487
                           c0.938-0.447,1.467-0.284,3.628,1.102c2.567,1.631,3.505,2.078,4.442,2.078c1.305,0,1.672-0.447,2.24-2.485
                           c0.489-1.753,0.448-2.039-0.487-4.075c-0.979-2.24-1.671-5.666-1.143-5.666c0.732,0,3.14,0.979,3.791,1.51
                           c0.855,0.771,1.307,0.486,2.607-1.55l0.979-1.592h2.896c2.486,0,2.977-0.12,3.832-1.02c0.568-0.529,1.019-1.468,1.019-2.037
                           c0-1.306,1.348-2.648,2.608-2.648c2.039,0,3.547-0.488,3.343-1.103c-0.123-0.325,0.122-1.264,0.53-2.078
                           c1.468-2.895,1.752-4.239,0.979-5.055c-0.813-0.938-0.407-1.834,1.225-2.771c0.978-0.528,1.141-0.528,2.038,0.326
                           c1.223,1.143,1.752,1.143,2.077-0.041c0.529-2.038,0.123-2.445-3.545-3.669c-0.365-0.162-0.896-0.73-1.183-1.305
                           c-0.245-0.57-0.938-1.143-1.508-1.305c-0.57-0.122-1.59-0.772-2.242-1.387c-1.427-1.469-1.875-1.469-3.914-0.123
                           c-1.589,1.063-1.589,1.063-2.894,0.326c-1.591-0.938-2.649-3.546-2.039-4.974c0.651-1.387-0.244-1.103-0.979,0.326
                           c-0.896,1.753-2.363,2.606-3.464,2.037c-0.488-0.243-1.385-0.366-1.997-0.202c-1.427,0.322-2.853-0.246-4.646-1.835
                           C215.766,433.329,215.156,433.043,214.992,433.369z" />
              <path class="territory" data-id="585" id="Varanasi" d="M446.519,437.037c-0.896,0.609-2.119,1.266-2.771,1.387c-1.268,0.326-1.837,1.712-1.145,2.978
                           c0.774,1.428,0.529,3.587-0.489,4.852c-1.468,1.753-1.507,2.16-1.021,7.297c0.408,4.075,0.611,4.894,1.428,5.706
                           c0.531,0.529,0.938,1.141,0.938,1.346c0,0.244,0.365,0.611,0.855,0.855c0.61,0.366,1.021,0.325,1.713-0.122
                           c1.426-0.897,2.936-1.143,3.749-0.53c0.691,0.489,0.691,0.652,0.041,3.183c-0.813,2.976-0.773,4.317,0.243,4.932
                           c0.734,0.489,1.834,0.082,3.67-1.386c0.813-0.651,1.875-0.938,4.319-1.145l3.22-0.244l2.121-2.28c1.346-1.55,2.079-2.69,2.079-3.345
                           c0-1.508,2.282-3.587,6.153-5.585c3.384-1.752,4.198-2.565,4.646-4.81c0.326-1.55-0.487-2.69-2.934-4.198
                           c-0.734-0.486-1.471-1.264-1.593-1.793c-0.121-0.528-0.487-1.184-0.813-1.468c-0.325-0.245-0.569-0.693-0.569-0.938
                           c0-0.243-1.021-1.549-2.243-2.895l-2.24-2.405l-1.469,1.712c-2.854,3.386-4.522,3.467-5.867,0.326
                           c-0.652-1.507-0.938-1.792-2.283-1.997c-0.813-0.162-2.323-0.08-3.262,0.123c-1.265,0.285-2.159,0.244-3.303-0.164
                           C448.189,435.896,448.068,435.938,446.519,437.037z" />
              <path class="territory" data-id="532" id="Chandauli" d="M477.131,441.276c-1.511,1.021-2.978,1.835-3.304,1.835c-1.102,0-0.65,0.732,1.225,2.039
                           c2.323,1.588,3.221,3.221,2.854,5.258c-0.45,2.605-1.591,3.994-4.564,5.503c-3.507,1.753-6.235,3.75-6.235,4.521
                           c0,0.734,1.265,1.429,2.526,1.429c0.528,0,2.079,0.65,3.424,1.468c1.306,0.854,3.14,1.916,4.036,2.405
                           c1.344,0.731,1.63,1.102,1.752,2.28c0.081,1.185-0.163,1.754-1.631,3.426c-0.979,1.102-1.711,2.321-1.631,2.688
                           c0.203,1.223-1.021,3.099-2.566,3.792l-1.468,0.731l0.244,2.485c0.201,1.793,0.079,3.06-0.326,4.279
                           c-0.528,1.509-0.528,1.998-0.041,3.628c0.326,1.021,0.568,2.487,0.568,3.181c0,1.793,1.551,3.912,3.222,4.483
                           c2.403,0.771,2.363,2.771-0.041,4.688c-1.468,1.144-1.428,1.51,0.326,2.241c0.773,0.326,1.876,0.938,2.444,1.388
                           c0.938,0.732,1.468,0.771,5.991,0.568c4.564-0.244,5.177-0.365,7.623-1.631c1.468-0.732,2.895-1.345,3.18-1.345
                           c0.732,0,0.611-0.734-0.367-2.078c-0.732-1.063-0.771-1.427-0.445-3.751c0.326-2.16,0.244-3.1-0.572-6.399
                           c-0.528-2.117-1.344-4.973-1.834-6.315c-1.468-4.075-1.468-5.422,0.082-7.948c0.734-1.224,1.631-2.729,2.078-3.342
                           c0.896-1.349,0.896-1.672,0.164-3.101c-0.285-0.608-0.449-1.672-0.367-2.361c0.162-0.979,0.531-1.431,1.754-1.957
                           c0.896-0.367,2.69-1.957,4.237-3.709c1.753-1.917,3.222-3.184,4.118-3.469c0.771-0.241,1.426-0.567,1.426-0.69
                           c0-0.162-0.203-1.467-0.447-2.938c-0.772-4.646-3.913-9.819-7.623-12.595c-1.508-1.1-2.282-1.141-3.708-0.121
                           c-0.61,0.447-1.753,0.896-2.607,1.062c-1.306,0.244-1.792,0.082-3.71-1.185c-1.956-1.304-4.646-2.242-6.439-2.283
                           C480.105,439.442,478.597,440.259,477.131,441.276z" />
              <path class="territory" data-id="533" id="Chitrakoot"
                d="M309.886,441.317c-0.49,0.529-0.979,1.347-1.143,1.875c-0.488,1.55-1.877,2.771-3.141,2.771
                           c-2.282,0-4.238,1.428-5.99,4.361c-0.854,1.55-2.118,3.262-2.771,3.831c-1.59,1.509-4.321,2.813-5.87,2.813h-1.304l0.285,3.709
                           c0.283,3.872,0.041,4.853-1.388,4.853c-0.365,0-1.183,0.487-1.793,1.061c-0.979,1.021-1.062,1.346-1.062,4.442v3.384l1.427,0.245
                           c1.103,0.203,1.671,0.08,2.608-0.61l1.223-0.896l1.712,1.51c1.712,1.467,1.794,1.467,2.078,0.61c0.205-0.49,0.246-1.471,0.082-2.201
                           c-0.163-0.855,0-1.794,0.408-2.609c0.938-1.792,2.976-1.792,4.48,0c1.265,1.509,1.306,1.794,0.246,3.548
                           c-0.448,0.731-0.815,1.589-0.815,1.915s-0.771,2.039-1.669,3.75c-1.145,2.079-1.754,3.831-1.835,5.056
                           c-0.081,1.266-0.569,2.606-1.43,3.993l-1.303,2.12l0.814,1.102c1.101,1.509,2.525,1.631,3.791,0.285
                           c0.528-0.57,1.304-1.02,1.711-1.02c0.449,0,1.468-0.449,2.283-1.021c1.671-1.145,2.525-1.307,2.525-0.449
                           c0,0.979,1.386,3.099,2.2,3.344c0.488,0.163,1.225-0.204,2.24-1.184c0.815-0.772,1.835-1.592,2.242-1.834
                           c0.854-0.408,1.062-0.285,5.83,3.71c1.711,1.427,1.914,1.508,2.524,0.896c0.365-0.326,0.855-1.509,1.062-2.528
                           c0.245-1.059,0.611-1.953,0.854-2.035s1.143,0.771,1.957,1.916c1.265,1.712,1.631,1.997,2.118,1.631
                           c0.733-0.651,0.733-1.957-0.041-3.264c-0.771-1.346-0.771-3.302,0-4.319c0.326-0.405,0.612-1.021,0.612-1.347
                           c0-0.324,0.772-1.793,1.711-3.262c1.266-2.037,1.712-3.138,1.753-4.522c0.041-2.362,0.938-4.894,1.672-4.894
                           c0.326,0,0.57,0.246,0.57,0.571c0,1.142,1.223,1.06,2.119-0.163c0.487-0.693,1.019-1.224,1.142-1.224
                           c0.162,0,1.102,0.527,2.08,1.224c0.979,0.651,2.2,1.223,2.688,1.223c2.199,0,2.854,1.103,1.265,2.202
                           c-0.896,0.651-0.896,0.651-0.122,1.266c1.224,0.979,3.303,1.834,4.441,1.834c0.528,0,1.388-0.367,1.916-0.775l0.979-0.772
                           l-1.304-1.631c-1.348-1.672-1.225-2.12,0.609-2.12c1.591-0.041,1.875-0.65,0.938-2.158l-0.896-1.469l1.062-0.69
                           c0.854-0.569,0.979-0.897,0.813-1.957c-0.202-0.938-0.041-1.59,0.609-2.404c0.571-0.734,0.815-1.55,0.734-2.404
                           c-0.122-1.264-0.204-1.346-1.753-1.305c-0.897,0-3.345,0.245-5.464,0.529c-3.588,0.448-3.912,0.407-4.688-0.284
                           c-0.49-0.449-1.264-1.021-1.793-1.306c-0.855-0.407-0.938-0.651-0.692-2.405c0.202-1.59,0.122-1.995-0.364-2.2
                           c-0.816-0.325-1.471-0.121-4.606,1.428c-2.978,1.51-4.32,1.348-5.341-0.609c-1.061-1.997-2.771-3.425-4.401-3.669
                           c-1.387-0.245-3.424-1.631-3.424-2.364c0-0.203,0.611-1.021,1.304-1.834c1.104-1.223,1.348-1.875,1.389-3.424l0.041-1.958
                           l-1.875-0.244c-1.875-0.244-3.426-0.772-6.236-1.996C310.74,440.136,310.987,440.095,309.886,441.317z" />
              <path class="territory" data-id="566" id="Mirzapur" d="M439.181,462.065c-1.958,2.118-4.158,2.647-8.233,1.874c-2.896-0.528-4.893-0.283-7.134,0.814
                           c-2.404,1.223-3.75,1.021-5.095-0.691l-1.104-1.469l-1.916,2.16c-1.833,2.12-1.915,2.12-3.138,1.63
                           c-0.692-0.284-1.916-1.263-2.729-2.118c-0.814-0.896-1.714-1.551-1.957-1.469c-0.813,0.245-0.813,2.039-0.041,3.465
                           c0.691,1.307,0.691,1.471,0.082,2.528l-0.652,1.182l1.755,1.021c1.791,1.103,3.179,2.896,3.668,4.811
                           c0.406,1.631-2.079,10.271-3.588,12.557c-0.691,1.021-3.547,4.117-6.358,6.931c-2.854,2.813-5.462,5.706-5.869,6.438l-0.732,1.306
                           l2.854-0.243c3.305-0.327,3.711,0,2.896,2.525c-0.366,1.102-0.366,1.589,0,1.915c0.367,0.365,0.814,0.042,1.997-1.306
                           c1.549-1.834,2.485-1.957,2.485-0.408c0,0.489-0.569,2.12-1.265,3.671c-1.752,4.075-1.101,5.38,2.119,4.237
                           c3.058-1.102,3.791-0.691,2.771,1.508c-0.283,0.652-0.283,1.307,0,2.038c0.408,1.104,0.612,1.184,7.055,3.019
                           c0.527,0.162,0.732-0.203,0.938-2.16c0.528-4.524,0.772-5.137,2.119-5.95c1.264-0.732,1.304-0.732,4.197,0.487l2.896,1.265
                           l0.813-1.956c3.711-8.684,5.788-13.368,6.071-13.652c0.163-0.164,0.53-0.043,0.815,0.322c0.285,0.326,0.896,0.611,1.346,0.611
                           c0.447,0,1.428,0.448,2.16,1.021c1.59,1.224,2.445,1.264,4.034,0.202c1.061-0.69,1.835-0.813,5.423-0.772l4.156,0.082l1.59-1.713
                           c1.754-1.875,2.444-1.997,5.137-0.854l1.915,0.813l1.47-1.184c0.854-0.65,1.957-1.671,2.484-2.239
                           c0.57-0.57,1.307-1.063,1.713-1.063c0.938,0,1.915,1.428,2.241,3.262c0.367,1.795,1.141,3.058,2.648,4.116l1.184,0.855l1.63-1.306
                           c1.712-1.387,1.794-2.038,0.205-2.038c-1.225,0-2.896-1.997-3.425-3.993c-1.591-6.439-1.714-7.38-1.185-8.314
                           c0.285-0.57,0.529-2.364,0.529-4.563c0-3.181,0.081-3.67,0.816-4.075c2.605-1.47,3.138-1.957,2.853-2.979
                           c-0.162-0.772,0.162-1.427,1.631-3.139c1.021-1.184,1.834-2.404,1.834-2.73c-0.042-0.813-6.767-4.852-8.069-4.852
                           c-0.61,0-1.348-0.163-1.671-0.366c-0.733-0.487-2.649,0.896-3.75,2.648c-0.979,1.59-2.2,2.08-5.788,2.323
                           c-2.037,0.161-3.019,0.405-3.669,1.019c-2.2,1.958-4.28,2.243-5.786,0.693c-1.187-1.143-1.308-2.607-0.449-5.788l0.569-2.119
                           l-1.752,0.854c-1.551,0.773-1.916,0.814-3.06,0.326c-0.691-0.285-1.549-1.062-1.876-1.673c-0.325-0.651-0.731-1.182-0.896-1.141
                           C440.933,460.272,440.076,461.087,439.181,462.065z" />
              <path class="territory" data-id="581" id="Sant Ravidas Nagar"
                d="M439.548,454.203c-0.243-1.957-0.364-2.12-1.347-2.12c-1.957-0.041-4.318-1.183-5.503-2.65
                           c-1.508-1.915-2.078-2.157-5.989-2.853c-3.671-0.652-5.706-1.713-6.769-3.506c-0.69-1.145-0.854-1.186-3.587-1.186
                           c-1.549,0-3.221-0.121-3.67-0.201c-0.446-0.125-1.425,0.16-2.117,0.607c-2.08,1.264-1.59,2.648,1.345,3.872
                           c2.647,1.102,2.813,4.197,0.366,6.849c-0.896,0.979-1.508,2.12-1.672,3.181c-0.162,0.896-0.771,2.321-1.427,3.221
                           c-0.488,0.684-0.747,1.073-0.822,1.32c-0.944,0.318-1.87,0.708-2.56,1.123c2.635-1.312-0.49,0.246-1.02,0.53
                           c-0.531,0.245-1.347,1.021-1.835,1.632c-0.772,1.062-0.772,1.224-0.244,2.199c0.326,0.571,1.101,1.429,1.753,1.917
                           c1.02,0.732,1.183,0.773,1.752,0.162c0.61-0.568,0.569-0.732-0.041-1.712c-0.528-0.772-0.496-3.049,1.247-3.872
                           c0.854-0.342,1.569-0.643,2.188-0.915c0.498,0.4,1.104,0.948,1.661,1.527l1.834,1.835l1.875-2.119
                           c1.589-1.834,1.997-2.079,2.936-1.834c0.569,0.122,1.387,0.813,1.793,1.507c0.814,1.429,1.103,1.429,5.34-0.08
                           c2.445-0.855,2.813-0.896,5.747-0.406c4.2,0.691,5.788,0.324,7.583-1.632C439.872,458.888,439.995,458.236,439.548,454.203z" />
              <path class="territory" data-id="559" id="Lalitpur"
                d="M112.274,468.14c-0.651,0.326-1.591,1.143-2.038,1.834c-0.447,0.692-1.305,1.347-1.875,1.469
                           c-0.609,0.163-1.428,0.61-1.834,1.061c-0.406,0.448-1.305,1.104-1.956,1.427c-0.691,0.327-2.039,1.267-3.017,2.12
                           c-1.712,1.468-1.753,1.589-1.916,4.321c-0.163,3.384-0.937,4.646-3.506,5.584c-1.141,0.447-2.16,1.182-2.813,2.118
                           c-1.143,1.632-2.159,2.485-5.015,4.116c-1.101,0.611-2.078,1.387-2.201,1.672c-0.122,0.326,0.651,1.469,1.834,2.647
                           c2.771,2.813,3.182,3.873,2.567,6.933c-0.57,2.771-0.244,3.749,1.508,4.646c2.324,1.224,2.938,2.16,2.938,4.563
                           c0,2.688-0.611,4.278-2.649,6.687c-1.834,2.2-2.242,3.22-2.364,5.747c-0.081,1.753,0.081,2.12,1.468,3.546
                           c1.388,1.386,1.511,1.753,1.144,2.486c-0.408,0.771-0.204,1.02,2.688,2.854c5.138,3.263,4.852,2.937,4.197,4.564
                           c-0.284,0.773-0.979,1.916-1.468,2.567l-0.938,1.224l2.486,2.771c1.346,1.51,2.69,2.771,3.017,2.771c0.57,0,2.608-2.445,2.608-3.14
                           c0-0.245,0.285-0.691,0.652-0.979c0.366-0.285,1.265-1.509,1.998-2.65c1.671-2.605,2.771-3.302,4.074-2.605
                           c1.103,0.569,5.666,5.626,7.419,8.151c1.795,2.566,3.793,4.359,5.219,4.604c0.772,0.122,1.957-0.082,3.179-0.612
                           c1.589-0.69,2.12-0.771,2.977-0.364c0.896,0.405,0.979,0.609,0.773,1.834c-0.204,1.103-0.081,1.713,0.693,2.771
                           c0.486,0.731,0.938,1.384,0.978,1.467c0.204,0.489,1.591-0.691,1.998-1.713c0.448-1.06,0.856-1.304,2.69-1.671
                           c1.834-0.326,2.321-0.652,3.098-1.834c0.896-1.388,1.916-2.813,4.117-5.747c1.957-2.568,3.709-6.563,3.831-8.724l0.124-2.039
                           l-1.631-0.406c-0.896-0.245-2.323-0.734-3.141-1.102c-2.119-0.938-3.546-3.994-1.834-3.994c0.243,0,1.225,0.731,2.12,1.631
                           c1.589,1.59,1.671,1.59,2.607,0.979c0.854-0.609,0.938-0.896,0.732-3.139c-0.204-2.12-0.528-2.896-2.283-5.422
                           c-1.141-1.631-2.158-3.425-2.321-3.994c-0.53-2.201-2.567-3.018-3.873-1.589c-1.426,1.548-4.076,3.382-4.812,3.382
                           c-0.366-0.041-1.712-1.224-3.018-2.647l-2.363-2.607l0.732-1.143c0.366-0.61,1.266-1.795,1.998-2.607
                           c1.263-1.469,1.263-1.509,1.467-6.931c0.122-3.018,0.326-5.747,0.489-6.113c0.487-1.142-1.428-2.649-3.668-2.978
                           c-2.813-0.366-4.894-1.875-5.462-3.912c-0.245-0.938-0.407-3.547-0.326-5.829c0.163-6.521-0.774-9.782-3.181-11.087
                           c-0.772-0.406-1.386-1.062-1.386-1.429c0-0.365-0.366-1.019-0.813-1.427c-0.449-0.408-1.021-1.426-1.266-2.283
                           c-0.326-0.978-0.65-1.467-1.021-1.304c-0.285,0.123-0.938-0.082-1.468-0.449C114.149,467.446,113.864,467.446,112.274,468.14z" />
              <path class="territory" data-id="580" id="Sonbhadra" d="M463.719,497.324c-1.306,1.143-2.607,2.038-2.896,2.038c-0.325,0-1.509-0.406-2.688-0.896l-2.16-0.896
                           l-1.589,1.834l-1.549,1.796l-4.28-0.082c-3.669-0.082-4.525,0-5.91,0.731c-1.916,1.021-3.955,0.814-5.097-0.447
                           c-0.407-0.446-1.225-0.813-1.834-0.813c-1.021,0-1.266,0.447-3.954,6.604l-2.896,6.646l2.608,0.123
                           c2.323,0.121,2.936-0.041,5.259-1.266c2.813-1.509,3.465-1.386,3.465,0.609c0,0.979,0.367,1.309,2.854,2.567
                           c1.588,0.774,2.854,1.591,2.854,1.794c0,0.204,0.814,1.264,1.834,2.404c3.06,3.384,2.322,4.852-2.079,4.4
                           c-3.668-0.365-4.236,0.123-2.525,2.241l1.265,1.59l-0.691,1.592c-0.773,1.712-0.896,3.425-0.447,7.052
                           c0.285,2.323,0.325,2.364,1.631,2.364c2.241,0,2.648,0.324,2.2,1.551c-0.244,0.567-0.979,3.546-1.631,6.603
                           c-0.938,4.116-1.225,6.236-1.103,8.438c0.164,3.384,0.041,3.464-2.525,2.159c-0.896-0.447-2.078-0.813-2.647-0.813
                           c-3.304,0,1.589,7.051,11.249,16.184c5.137,4.892,7.094,6.479,9.213,7.5l2.688,1.265l6.563-0.285
                           c8.314-0.326,11.698-1.061,13.981-2.936l1.712-1.428l0.122-4.524l0.123-4.563l1.345-0.691c1.957-0.938,2.937-1.956,2.937-2.978
                           c0-0.49,0.366-1.224,0.813-1.631c0.489-0.407,1.225-1.428,1.712-2.202c0.488-0.813,1.305-1.996,1.793-2.604
                           c1.591-1.916,3.505-8.563,3.587-12.313l0.041-3.303l1.754-1.549c0.938-0.855,1.713-1.835,1.713-2.161
                           c0-0.979-1.184-3.18-2.607-4.853c-1.145-1.346-1.388-1.996-1.593-4.481c-0.322-3.303-0.159-3.588,2.364-3.954
                           c4.936-0.774,7.949-2.567,7.949-4.769c0-0.57,0.162-1.225,0.365-1.471c0.205-0.203,0.448-1.224,0.57-2.28
                           c0.121-1.551,0.04-2.078-0.57-2.607c-0.488-0.448-0.773-1.265-0.773-2.161c0-1.102-0.448-2.079-1.63-3.708
                           c-2.567-3.467-3.139-3.954-5.341-4.688c-1.711-0.57-2.283-0.611-3.181-0.203c-0.569,0.285-1.713,0.771-2.484,1.101
                           c-0.774,0.325-2.159,0.938-3.059,1.347c-1.183,0.569-3.017,0.813-6.728,0.979l-5.095,0.245l-1.835-1.224
                           c-1.021-0.651-1.998-1.224-2.242-1.224c-0.569,0-5.421-3.872-6.316-5.016c-0.407-0.529-0.896-1.508-1.021-2.16
                           c-0.489-2.119-0.651-2.607-0.938-2.607C466.204,495.327,465.025,496.224,463.719,497.324z" />
              <path class="territory" data-id="570" id="Muzaffarnagar"
                d="M82.027,89.304c0.488-0.449,1.551-1.346,2.363-2.038c0.815-0.652,2.527-1.671,3.791-2.242
                           c1.509-0.693,2.283-1.264,2.283-1.712c0-0.774-2.201-2.12-5.258-3.179c-1.021-0.367-2.65-1.102-3.628-1.63
                           c-1.021-0.571-2.201-1.02-2.69-0.979c-0.446-0.003-1.955,0.73-3.26,1.626c-1.345,0.856-2.568,1.59-2.771,1.59
                           c-0.163,0-1.061,0.815-1.998,1.834c-0.896,0.979-1.997,1.916-2.402,2.038c-0.408,0.123-1.389,0.856-2.243,1.632
                           c-0.814,0.773-1.793,1.426-2.16,1.426s-1.876,0.367-3.302,0.814c-2.813,0.897-5.258,0.815-7.582-0.203
                           c-2.606-1.138-4.287-1.678-6.202-1.923l-3.332,6.504l-3.208,10.278l-1.475,2.949l-4.467,2.27l-0.71,8.956
                           c3.932,0.301,5.624,0.895,7.166,2.437c1.102,1.1,1.671,1.345,3.059,1.345c1.507,0,1.916-0.245,3.423-1.793
                           c2.161-2.324,3.181-2.65,3.914-1.223c0.772,1.385,1.875,1.997,2.201,1.182c0.162-0.448,0.854-0.611,2.403-0.611
                           c1.957,0,2.282,0.163,3.587,1.467c0.732,0.774,2.363,1.916,3.588,2.487l2.16,1.02l1.916-0.856c1.021-0.53,2.363-1.183,2.977-1.509
                           c0.569-0.326,1.427-0.57,1.834-0.57c0.408,0,0.938-0.163,1.182-0.326c0.979-0.855,7.867-2.038,13.003-2.241
                           c2.364-0.082,2.445-0.123,2.568-1.224c0.081-0.651-0.123-1.753-0.489-2.444c-0.325-0.734-0.813-2.243-1.101-3.344
                           c-0.286-1.142-0.816-2.486-1.225-3.057c-0.364-0.571-0.813-2.08-0.938-3.383c-0.163-1.305-0.489-2.896-0.815-3.465
                           c-0.285-0.611-0.771-2.12-1.06-3.344c-0.286-1.223-0.734-2.896-1.021-3.668C81.047,91.383,81.007,90.119,82.027,89.304z" />
              <path class="territory" data-id="611" id="Shamali"
                d="M37.833,104.976l1.226-2.452l3.212-10.289l2.906-5.674l-0.501-0.411c-0.289,0.003-0.451,0.043-0.521,0.132
                           c-0.861-0.491-1.58-0.877-2.148-1.167c-0.244-0.487-0.559-0.771-1.064-1.074c-0.212-0.129-0.391-0.226-0.562-0.308l-1.386-0.202
                           c-0.422,0.05-0.952,0.164-1.721,0.346c-4.236,0.979-4.688,1.06-5.217,0.612c-0.246-0.204-1.469-0.693-2.648-1.102
                           c-1.348-0.448-2.445-1.1-3.019-1.834c-0.979-1.386-2.16-1.752-2.813-0.978c-0.734,0.896-2.364,0.692-3.709-0.448
                           c-1.224-1.017-1.997-1.262-2.486-0.731c-0.163,0.122-0.285,0.774-0.285,1.427c0,0.653-0.449,1.997-1.019,2.935
                           c-0.938,1.63-1.021,2.038-0.857,6.196c0.082,2.608,0.407,5.218,0.815,6.277c0.608,1.793,1.508,8.724,1.468,11.168
                           c0,0.611-0.204,1.467-0.407,1.875c-0.652,1.264-0.488,2.446,0.326,2.446c0.448,0,1.1,0.367,1.508,0.815
                           c0.57,0.61,1.224,0.814,2.404,0.773c0.938-0.041,2.444,0.245,3.424,0.612c0.366,0.14,0.66,0.245,0.926,0.32
                           c0.925,1.386,1.808,1.64,1.808,1.64l1.101,0.571c0.559,0.278,2.104,0.586,3.689,0.746l0.776-9.794L37.833,104.976z" />
              <path class="territory" data-id="574" id="Rae Bareli"
                d="M336.253,393.373l1.432-3.214v-11.743l2.396-1.416l2.015-3.695v-8.984l-2.538-4v-1.768l-1.732-7.656
                           c-0.646-0.133-1.27-0.237-1.741-0.282c-0.005-0.001-1.507-0.483-2.129,1.64c0,0,0.065,0.591-1.347,0.702
                           c-0.215-0.009-0.481-0.001-0.782,0.014c-0.015-0.001-0.022,0.001-0.038,0v0.003c-0.126,0.006-0.241,0.01-0.387,0.02
                           c-1.753,0.082-2.487-0.122-4.688-1.348c-1.671-0.938-3.181-1.468-4.075-1.468c-0.938,0-1.59-0.202-1.713-0.608
                           c-0.282-0.694-0.403-0.694-1.585-0.205c-1.267,0.488-5.83,4.812-6.113,5.748c-0.449,1.347-1.836,1.588-3.589,0.69
                           c-0.896-0.446-1.671-0.69-1.753-0.61c-0.123,0.082-0.365,1.307-0.61,2.69c-0.447,2.362-0.408,2.605,0.407,3.466
                           c0.449,0.486,0.854,1.182,0.854,1.549c0,0.364,0.285,0.854,0.611,1.141c1.185,0.979,0.448,5.828-1.142,7.623
                           c-1.184,1.347-2.73,1.183-4.605-0.448c-0.896-0.772-2.402-1.589-3.344-1.834c-0.896-0.284-1.793-0.651-1.915-0.854
                           c-0.326-0.489-3.057-0.53-3.057-0.041c0,0.162,0.854,1.184,1.874,2.242c1.795,1.793,1.875,1.957,1.672,3.586
                           c-0.163,1.183-0.569,2.039-1.264,2.65c-0.571,0.486-1.062,1.018-1.062,1.182c0,0.162-0.449,0.896-1.062,1.672
                           c-0.734,0.979-1.348,1.347-2.201,1.347c-1.062,0-3.424,1.631-5.38,3.669c-0.407,0.445-1.063,0.938-1.427,1.184
                           c-0.407,0.202-0.652,0.446-0.529,0.528c0.122,0.082,1.101,0.567,2.242,1.142c1.915,0.979,2.038,1.143,2.648,3.467
                           c1.062,4.115,0.732,4.035,8.152,2.199c3.828-0.938,5.663-1.223,7.418-1.061c2.523,0.204,4.811,1.468,4.811,2.646
                           c0.041,1.063,1.793,3.914,2.688,4.362c0.448,0.203,1.389,0.854,2.119,1.386c1.185,0.814,1.633,0.896,3.508,0.691
                           c2.729-0.366,3.303,0.123,3.628,3.059c0.161,1.144,0.527,2.403,0.896,2.813c0.326,0.367,0.611,0.896,0.611,1.143
                           c0,0.569,2.362,2.362,3.669,2.729c0.567,0.164,1.71,0.938,2.524,1.714l1.509,1.467l0.245-1.467c0.324-1.632,0.731-2.08,2.24-2.488
                           c0.57-0.12,2.2-1.344,3.668-2.688l2.649-2.445c0,0,0.49-0.46,1.092-0.912l-7.561-5.349L336.253,393.373z" />
              <path class="territory" data-id="608" id="Amethi" d="M388.841,391.139c-0.205-0.123-0.734-1.02-1.145-1.957c-1.142-2.523-3.79-5.258-6.89-7.133
                           c-3.301-1.998-6.646-5.056-6.646-6.113c0-0.408-0.163-0.896-0.365-1.143c-0.203-0.203-0.691-1.389-1.062-2.609l-0.652-2.24
                           l1.956-1.752c1.063-0.979,2.771-2.161,3.792-2.689c1.754-0.896,1.834-1.021,1.711-2.525c-0.079-0.855-0.568-2.527-1.1-3.629
                           c-0.814-1.713-1.266-2.158-2.73-2.688c-4.646-1.755-9.944-2.526-12.637-1.916c-2.525,0.61-3.139,0.082-3.465-3.058
                           c-0.163-1.793-0.489-2.527-1.387-3.385c-0.651-0.609-1.184-1.427-1.184-1.794c0-0.487-0.243-0.651-0.938-0.528
                           c-0.53,0.123-1.51-0.244-2.405-0.854c-1.3-0.858-1.544-0.938-1.992-0.41c-0.325,0.367-0.488,1.55-0.407,2.854
                           c0.123,2.813-0.938,6.195-2.16,6.727c-0.65,0.285-1.671,0.082-4.197-0.773c-1.875-0.649-3.628-1.386-3.914-1.672
                           c-0.197-0.151-0.824-0.364-1.596-0.572l1.628,7.19v1.417l2.538,4v9.803l-2.396,4.395l-2.016,1.189v11.207l-1.533,3.43l-1.424,4.451
                           l7.228,5.112c0.438-0.158,0.985-0.385,1.723-0.71c1.632-0.691,3.547-1.222,4.481-1.222c1.063,0,1.673-0.205,1.673-0.531
                           c0-0.69-1.55-3.139-1.996-3.139c-0.204,0-0.65-0.488-1.062-1.062c-0.651-0.979-0.651-1.101,0.041-1.834
                           c0.692-0.772,0.692-0.896,0.04-2.729c-1.061-2.978-0.285-4.974,1.876-4.974c0.896,0,1.711-0.407,2.813-1.51
                           c1.47-1.427,1.549-1.427,2.525-0.813c1.103,0.733,2.978,3.262,4.361,5.909c0.979,1.834,1.02,1.834,2.2-0.082
                           c0.325-0.567,0.854-0.243,3.465,2.16c2.2,2.08,3.262,2.813,3.791,2.65c0.446-0.124,1.957-1.061,3.384-2.079
                           c2.526-1.753,2.73-1.835,4.77-1.589c1.144,0.162,4.279,0.363,6.931,0.486c4.118,0.203,4.77,0.162,4.77-0.406
                           C389.245,391.668,389.084,391.26,388.841,391.139z" />
              <path class="territory" data-id="546" id="Ghaziabad" d="M53.451,163.141l0.123-0.096c1.893-1.483,3.39-3.011,4.533-4.572c-0.114-1.636-0.561-6.319-1.964-7.094
                           c-0.063-0.036-0.199-0.077-0.376-0.119c-0.011-0.002-0.019-0.006-0.029-0.007c-0.637-0.147-1.869-0.319-3.18-0.444
                           c-7.011-0.733-9.009-1.142-11.251-2.364c-2.078-1.141-2.28-1.181-2.853-0.529c-0.326,0.367-1.183,1.427-1.956,2.323l-1.387,1.631
                           l0.773,0.979c0.611,0.775,0.774,1.508,0.693,3.058c-0.122,1.916-0.245,2.12-1.551,2.771c-0.773,0.366-1.998,0.692-2.729,0.733
                           c-1.386,0-4.771-1.265-5.177-1.998c-0.162-0.244-0.938-0.448-1.752-0.448c-1.143,0-1.752-0.326-2.938-1.549
                           c-2.565-2.731-3.627-1.63-2.037,2.159c0.488,1.224,1.063,2.242,1.225,2.242c0.163,0,1.182,0.693,2.281,1.59
                           c1.102,0.854,2.363,1.67,2.854,1.834c1.671,0.529,2.16,1.508,1.711,3.465c-0.569,2.649-0.244,3.302,1.794,3.302
                           c1.957,0,2.405,0.244,3.098,1.508c0.57,1.142,1.307,1.182,2.241,0.163c0.979-1.1,3.02-1.427,4.158-0.652
                           c0.53,0.367,1.876,0.612,3.099,0.612h2.16l-0.006-0.093c0.508-0.069,1.149-0.26,1.922-0.681c0.208,0.158,0.527,0.227,1.063,0.282
                           c0.75,0.08,1.263,0.352,1.293,0.665c1.896-4.469,3.932-8.247,4.088-8.536L53.451,163.141z" />
              <path class="territory" data-id="609" id="Hapur" d="M93.772,172.941c-0.244-0.488-0.447-1.63-0.447-2.608c-0.04-1.998-0.814-5.26-1.469-6.074
                           c-0.244-0.326-0.69-1.304-0.979-2.201c-0.286-0.896-0.857-2.324-1.266-3.139c-0.446-0.856-0.772-2.039-0.772-2.69
                           s-0.122-1.793-0.245-2.486c-0.244-1.265-0.285-1.265-2.976-1.265c-1.919,0.002-3.672,0.37-6.158,1.226
                           c-3.954,1.386-4.812,1.468-5.951,0.611c-0.408-0.326-1.345-0.611-2.079-0.611c-1.101,0-1.549,0.325-2.771,1.917
                           c-1.388,1.834-4.361,4.36-6.278,5.421c-1.103,0.569-2.079,0.284-3.301-1.02l-0.14-0.146c-1.144,1.456-2.578,2.876-4.316,4.251
                           c-0.425,0.799-2.634,5.005-4.485,9.57c0.793,1.125,2.011,2.316,3.035,2.79c0.896,0.408,1.916,1.061,2.201,1.428
                           c0.731,0.896,2.362,0.814,2.647-0.082c0.285-0.815,3.628-3.343,4.442-3.343c0.286,0,1.59-0.938,2.895-2.12
                           c2.323-2.079,2.404-2.12,3.466-1.509c1.387,0.815,2.648,0.367,3.466-1.181c1.182-2.324,2.895-3.75,4.441-3.75
                           c1.225,0,1.752,0.326,3.182,1.834c1.63,1.712,1.834,1.834,3.873,1.834c1.345,0,2.281,0.204,2.485,0.529
                           c0.161,0.286,1.143,0.774,2.118,1.061c1.021,0.285,1.834,0.815,1.957,1.183c0.163,0.651,3.263,1.957,3.669,1.549
                           C94.138,173.838,94.016,173.39,93.772,172.941z" />
              <path class="territory" data-id="522" id="Badaun" d="M191.557,217.946c-0.896-0.814-1.631-1.671-1.631-1.875c0-0.203-0.611-0.774-1.304-1.305
                           c-1.511-1.06-4.647-1.509-12.271-1.712c-5.256-0.203-6.805-0.447-9.251-1.507c-4.117-1.834-4.688-2.202-5.666-4.036
                           c-0.938-1.63-1.019-2.282-1.019-6.399l0.041-4.605l-1.752-1.631c-0.18-0.166-0.36-0.317-0.539-0.463
                           c-5.361-0.598-10.055-0.566-10.722,0.572c-1.136,1.938-4.034,3.894-6.591,5.62c-1.411,0.952-2.869,1.936-3.19,2.417
                           c-0.158,0.237-0.364,0.522-0.594,0.841c-0.915,1.264-2.817,3.895-2,4.713c1.362,1.362,0.951,4.041,0.343,5.509
                           c-0.215,0.521-0.57,1.204-1.193,1.267c-0.665,0.264-3.83,2.853-3.419,6.674c0.162,1.505,0.08,3.048-0.105,4.456
                           c0.149,0.134,0.287,0.266,0.409,0.393c1.916,1.834,6.155,4.279,7.5,4.279c0.408,0,0.815,0.163,0.938,0.367
                           c0.163,0.203,1.223,0.488,2.403,0.651c3.79,0.489,5.097,1.509,8.479,6.604c1.509,2.242,3.139,2.936,7.5,3.18
                           c8.313,0.447,9.905,0.979,12.311,4.158c0.896,1.141,1.103,1.875,1.103,3.75c0.041,2.037,0.163,2.363,1.182,2.975
                           c0.611,0.407,1.55,0.734,2.079,0.734c0.53,0,1.427,0.407,2.039,0.854c0.611,0.489,1.916,0.979,2.854,1.062l1.752,0.204l0.244-2.526
                           c0.163-1.428,0.284-3.425,0.284-4.484c0-2.405,0.408-2.731,5.099-4.606c4.237-1.672,5.461-2.854,4.688-4.401
                           c-0.285-0.531-0.813-1.346-1.223-1.794c-1.55-1.752-1.021-5.706,1.06-7.989c0.53-0.611,0.611-1.386,0.489-5.748
                           c-0.042-0.896,0.204-1.834,0.611-2.282C193.595,220.677,193.309,219.578,191.557,217.946z" />
              <path class="territory" data-id="567" id="Moradabad"
                d="M115.725,188.181c0.154,0.096,3.691,2.354,3.847,6.074c0.458,0.583,2.2,2.503,5.255,2.503h7.055
                           c0.532-0.849,2.005-2.576,5.352-2.994c3.47-0.434,4.859-5.109,4.873-5.156l0.274-0.948l0.837,0.516
                           c-0.023-0.016,0.151,0.031,0.657,0.031c0.312,0,0.752-0.018,1.353-0.078c0.291-0.98,1.102-2.966,3.002-3.546
                           c0.295-0.09,0.604-0.13,0.92-0.143c0.044-0.073,0.088-0.148,0.136-0.209c0.283-0.407,0.446-1.427,0.365-2.364l-0.082-0.857v0
                           c-0.049-2.131-0.811-3.213-0.811-3.213c0-0.408-0.814-1.467-1.834-2.404c-1.021-0.896-1.834-1.875-1.834-2.161
                           c0-0.245-0.53-1.101-1.224-1.876c-1.266-1.426-1.59-3.015-0.692-3.668c1.061-0.896,2.813-0.978,3.628-0.245
                           c1.101,1.02,2.079,0.245,2.445-1.916c0.164-1.019,0.855-2.446,1.549-3.343c1.264-1.549,1.345-2.038,1.1-5.584
                           c-0.121-1.467-0.446-2.038-1.834-3.343c-1.793-1.63-2.078-2.649-1.304-4.688c0.245-0.611,0.449-1.875,0.489-2.853
                           c0.082-1.509-0.123-1.998-1.184-3.099c-1.713-1.793-1.469-3.139,0.979-5.136c1.508-1.264,1.753-1.671,1.589-2.568
                           c-0.244-1.264,0.733-2.363,2.73-3.016c1.55-0.489,1.875-1.712,0.813-3.016l-0.732-0.897l-1.59,1.305
                           c-2.443,2.078-2.936,1.427-3.71-5.259c-0.081-0.733-0.366-1.59-0.61-1.916c-0.61-0.733-2.978-1.427-4.975-1.427
                           c-1.223,0-1.712-0.285-2.688-1.427l-1.184-1.467l-0.652,0.979c-0.326,0.53-1.185,1.183-1.834,1.467
                           c-1.795,0.734-3.548,3.832-3.873,6.727c-0.203,1.998-0.488,2.648-2.038,4.443c-1.144,1.304-2.937,2.73-4.729,3.75l-2.935,1.63
                           l-0.122,2.363c-0.082,1.753-0.326,2.568-1.021,3.303c-0.772,0.813-0.813,0.978-0.245,1.467c0.327,0.286,0.61,1.019,0.61,1.671
                           c0,0.652,0.204,1.182,0.449,1.182c0.732,0,3.627,2.568,3.627,3.221c0,0.366,0.449,1.386,1.021,2.282
                           c1.144,1.875,1.266,3.099,0.447,5.38c-0.287,0.839-0.4,1.249-0.35,1.441c-0.489,1.588-1.053,1.997-1.053,1.997l-0.072,0.048
                           c-0.463,0.049-1.019,0.133-1.7,0.265c-0.814,0.163-1.753,0.529-2.08,0.774c-0.814,0.693-4.198,1.101-4.523,0.53
                           c-0.406-0.652-3.302-0.571-3.911,0.163c-0.285,0.326-0.734,0.61-1.021,0.61c-0.61,0-1.1,3.139-0.772,4.893
                           c0.162,0.652,0.121,1.508-0.039,1.916c-0.571,1.305,0.12,4.076,1.345,5.503c0.772,0.896,0.449,5.992-0.449,7.296
                           c-0.408,0.53-0.53,1.386-0.408,2.446c0.064,0.452,0.067,0.865,0.025,1.243c1.095,0.589,2.208,1.095,3.114,1.304L115.725,188.181z" />
              <path class="territory" data-id="610" id="Sambhal" d="M146.565,188.953l-0.101,0.539l-0.544,0.069c-1.23,0.152-2.051,0.169-2.597,0.12
                           c-0.581,1.513-2.329,5.125-5.901,5.572c-3.465,0.433-4.363,2.456-4.4,2.542l-0.194,0.457l-0.499,0.008h-7.5
                           c-4.352,0-6.533-3.198-6.624-3.334l-0.126-0.189v-0.227c0-2.749-2.533-4.635-3.055-4.994c-0.952-0.241-2.058-0.731-3.14-1.301
                           c-0.768,1.095-2.275,1.28-3.884,0.138c-1.145-0.814-1.185-0.814-1.428-0.04c-0.123,0.448-0.813,1.305-1.509,1.875
                           c-1.02,0.856-1.631,1.061-2.813,0.938l-1.55-0.123l-0.325,2.648c-0.164,1.468-0.286,2.976-0.245,3.343
                           c0.122,0.938,2.323,4.32,3.791,5.789c1.631,1.671,6.398,7.052,8.029,9.089c1.469,1.875,2.566,4.279,2.566,5.666
                           c0,0.773,0.57,1.386,2.526,2.607c1.227,0.807,2.183,1.294,2.957,1.499c2.238,1.391,4.896,1.309,4.896,1.309
                           c0.406,0.253,0.954,0.526,1.687,0.865c0.823,0.366,1.822,0.952,2.723,1.581c0.097-1.051,0.118-2.149,0.004-3.211
                           c-0.337-3.133,1.284-5.462,2.28-6.571c0.516-0.575,1.502-1.499,2.247-1.713c0.406-0.604,1.129-3.309,0.173-4.265
                           c-1.722-1.722,0.424-4.689,1.844-6.652c0.218-0.301,0.413-0.57,0.562-0.794c0.462-0.693,1.61-1.486,3.599-2.829
                           c2.305-1.555,5.172-3.49,6.136-5.135c0.708-1.208,2.964-1.66,5.707-1.714c-0.878-0.287-1.602-0.622-1.917-0.937
                           c-0.608-0.611-0.73-1.143-0.527-2.202c0.389-1.545-0.131-2.817-0.446-3.404c-0.098,0.016-0.202,0.019-0.294,0.047
                           C147.043,186.509,146.57,188.929,146.565,188.953z" />
            </g>
            <g id="tooltip" visibility="hidden">
              <rect width="50" height="18" fill="#FF4800" rx="2" ry="2" />
              <text x="4" y="6" fill="#FFFFFF">Tooltip</text>
            </g>
          </svg>
          <div class="dList" id="ajax_data">
            <div id="dData_32" style="display: block">
              <h2 id="district_name">Lucknow</h2>
              <p>Sports has always been an integral part of Uttar Pradesh’s culture and important aspect of life such
                that we could say that Uttar Pradesh has a rich sports heritage like it’s cultural heritage from where
                various new sports persons of different disciplines have emerged out excellently and have resulted in
                glory of the State in realms of sports. Thus, to grow and encourage promising talent in Uttar Pradesh, a
                Sports Department has been setup by Government of Uttar Pradesh that solely works to bring about
                qualitative improvement in the performance of sports persons by offering them all the essential
                facilities to excel in their respective sports.</p>
              <ul class="ullist-column" id="stadium_list">
                <li>
                  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 415.506 415.506" xml:space="preserve">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                      <path
                        d="M383.272,110.52l0.002-0.646l-3.484-0.011l-0.086,27.448c-8.281-6.856-17.703-12.51-26.766-17.017 c-23.309-11.592-48.772-18.684-74.508-23.022l0.041-13.047c12.619-10.885,23.938,5.021,32.303-10.692 c-19.652,0.258-15.338-11.771-32.234-10.734l0.002-0.646l-3.484-0.011l-0.109,34.548c-6.285-0.999-12.58-1.838-18.861-2.541 c-35.063-3.924-70.861-3.619-105.82,1.212c-3.229,0.446-6.465,0.94-9.705,1.463l-0.109-34.682l-3.484,0.011l0.002,0.646 c-16.897-1.037-12.582,10.993-32.234,10.734c8.363,15.713,19.684-0.193,32.301,10.692l0.043,13.168 c-29.039,4.941-58.164,13.233-83.584,28.047c-5.867,3.419-11.984,7.537-17.688,12.285l-0.088-27.863l-3.484,0.011l0.002,0.646 C15.338,109.481,19.654,121.512,0,121.254c8.367,15.712,19.685-0.192,32.303,10.693l0.029,8.801 c-12.324,11.22-21.863,25.568-21.074,42.402c0.912,19.49,12.287,34.646,26.885,46.248v27.828c-5.445-4.65-9.631-9.446-12.393-13.967 c-1.525-2.488-2.686-4.849-3.545-6.978c-0.828-2.137-1.412-4.026-1.752-5.592c-0.346-1.563-0.578-2.787-0.672-3.617 c-0.111-0.833-0.168-1.263-0.168-1.263s-0.033,0.433-0.096,1.271c-0.072,0.841-0.129,2.098-0.059,3.742 c0.156,3.262,0.719,8.221,3.197,14.016c1.211,2.896,2.832,6.002,4.924,9.176c2.078,3.184,4.682,6.381,7.674,9.584 c0.918,0.976,1.891,1.945,2.889,2.91v25.319c-5.445-4.65-9.631-9.445-12.393-13.966c-1.525-2.488-2.686-4.849-3.545-6.978 c-0.828-2.136-1.412-4.026-1.752-5.592c-0.346-1.563-0.578-2.788-0.672-3.617c-0.111-0.833-0.168-1.263-0.168-1.263 s-0.033,0.433-0.096,1.271c-0.072,0.841-0.129,2.098-0.059,3.742c0.156,3.262,0.719,8.22,3.199,14.016 c1.211,2.895,2.832,6.001,4.924,9.176c2.078,3.184,4.682,6.38,7.674,9.583c0.918,0.975,1.889,1.943,2.887,2.908l0.74,0.701 c5.4,5.107,11.889,10.04,19.26,14.613c4.549,2.825,9.438,5.5,14.594,8.053c5.16,2.543,10.615,4.894,16.285,7.137 c11.363,4.416,23.65,8.211,36.555,11.218c6.445,1.538,13.053,2.835,19.764,3.979c0.332,0.057,0.666,0.107,0.998,0.163l1.918,6.39 l4.053-1.216l4.051-1.216l-14.377-47.884c44.209-11.229,87.334-11.229,131.541,0l-14.377,47.883l4.053,1.217l4.051,1.217 l1.918-6.389c0.332-0.056,0.668-0.107,0.998-0.164c6.713-1.144,13.32-2.442,19.766-3.979c12.902-3.007,25.191-6.802,36.555-11.218 c5.668-2.243,11.125-4.594,16.285-7.137c5.154-2.553,10.045-5.228,14.592-8.053c7.371-4.573,13.859-9.506,19.262-14.613l0.74-0.701 c0.998-0.964,1.969-1.933,2.885-2.908c6.031-6.369,10.244-12.928,12.615-18.751c2.439-5.813,3.068-10.751,3.188-14.023 c0.063-1.648,0.012-2.912-0.063-3.743c-0.063-0.838-0.096-1.271-0.096-1.271s-0.059,0.43-0.17,1.263 c-0.096,0.84-0.322,2.057-0.676,3.616c-0.348,1.564-0.939,3.451-1.758,5.59c-0.846,2.132-2.012,4.492-3.551,6.972 c-1.555,2.471-3.467,5.074-5.824,7.667c-1.926,2.099-4.109,4.223-6.551,6.309v-25.321c0.998-0.965,1.971-1.934,2.887-2.91 c6.029-6.369,10.244-12.929,12.613-18.752c2.439-5.813,3.068-10.751,3.188-14.023c0.063-1.648,0.012-2.913-0.063-3.743 c-0.063-0.838-0.096-1.271-0.096-1.271s-0.059,0.43-0.17,1.263c-0.096,0.84-0.322,2.057-0.676,3.616 c-0.348,1.565-0.939,3.451-1.756,5.59c-0.846,2.132-2.012,4.492-3.551,6.972c-1.557,2.471-3.467,5.074-5.824,7.667 c-1.926,2.1-4.111,4.224-6.553,6.31V229.77c14.756-11.677,26.125-26.96,27.268-46.711c-0.061-17.35-9.113-31.51-21.455-42.729 l0.025-8.384c12.619-10.885,23.938,5.019,32.303-10.693C395.852,121.512,400.168,109.481,383.272,110.52z M280.027,114.548 c16.605,3.143,32.943,7.585,48.641,13.701c14,5.455,31.211,13.355,43.342,24.885l-66.66,41.398 c-13.203-10.172-34.381-18.08-59.785-22.076L280.027,114.548z M229.93,108.653c13.213,0.727,26.494,2.042,39.658,4.104 l-34.686,58.282c-8.693-0.95-17.787-1.458-27.148-1.458c-9.363,0-18.455,0.507-27.15,1.458l-34.693-58.297 C173.648,108.351,201.9,107.111,229.93,108.653z M55.637,143.732c23.703-15.661,52.072-24.007,79.842-29.186l34.463,57.909 c-25.404,3.997-46.582,11.904-59.785,22.076l-66.695-41.421C47.25,149.625,51.412,146.522,55.637,143.732z M85.145,316.543 c-7.936-2.711-15.35-5.71-22.109-8.982c-4.535-2.154-8.732-4.49-12.617-6.872c-0.814-0.498-1.605-1.004-2.389-1.513v-24.268 c3.15,2.375,6.525,4.688,10.111,6.914c4.549,2.825,9.439,5.5,14.594,8.053c3.973,1.958,8.123,3.801,12.41,5.569V316.543z M85.145,281.943c-7.936-2.711-15.352-5.711-22.111-8.983c-4.535-2.154-8.73-4.49-12.615-6.872 c-0.816-0.497-1.605-1.004-2.389-1.513v-28.113c3.461,2.231,7,4.297,10.545,6.205c8.537,4.595,17.439,8.505,26.57,11.873V281.943z M76.422,232.545c-13.803-6.317-27.742-14.164-37.881-25.706c-4.895-5.57-11.996-16.036-10.539-24.222 c0.709-3.98,1.832-10.702,4.355-15.745c1.236-2.247,2.668-4.369,4.242-6.385l66.076,41.036c-4.676,5.438-7.244,11.331-7.244,17.49 c0,9.679,6.328,18.706,17.252,26.33C100.236,242.043,88.055,237.868,76.422,232.545z M128.746,327.655 c-11.809-2.156-23.133-4.828-33.715-7.97v-20.436c9.649,3.467,19.881,6.496,30.543,8.981c3.219,0.768,6.479,1.476,9.771,2.135 l5.803,19.328C136.967,329.063,132.828,328.379,128.746,327.655z M320.477,319.685c-10.582,3.143-21.906,5.814-33.717,7.97 c-4.08,0.724-8.221,1.408-12.402,2.039l5.803-19.328c3.293-0.659,6.553-1.367,9.772-2.135c10.664-2.485,20.896-5.515,30.545-8.981 V319.685z M320.477,285.085c-10.582,3.142-21.906,5.814-33.715,7.97c-3.631,0.644-7.309,1.256-11.021,1.828 c-45.701-11.633-90.273-11.633-135.975,0c-3.711-0.572-7.389-1.184-11.02-1.828c-11.811-2.155-23.133-4.828-33.715-7.97v-27.131 c20.076,6.438,41.053,10.423,61.723,12.957c34.283,4.202,69.221,4.148,103.496-0.104c20.242-2.512,40.645-6.456,60.227-12.713 V285.085z M367.478,299.177c-0.783,0.509-1.574,1.015-2.391,1.513c-3.885,2.382-8.08,4.717-12.615,6.872 c-6.76,3.271-14.176,6.27-22.109,8.982v-21.099c4.285-1.769,8.438-3.611,12.41-5.569c5.154-2.552,10.045-5.228,14.592-8.053 c3.588-2.226,6.963-4.54,10.113-6.914V299.177z M367.478,264.575c-0.783,0.509-1.574,1.016-2.389,1.513 c-3.885,2.382-8.08,4.717-12.615,6.872c-6.76,3.272-14.176,6.272-22.111,8.983V254.69c8.365-3.068,16.555-6.584,24.469-10.653 c4.268-2.193,8.52-4.607,12.646-7.247V264.575z M387.141,182.557c-0.145,15.047-13.639,29.256-26.842,38.099 c-17.16,11.493-36.879,19.13-57.113,24.43c10.701-7.569,16.889-16.503,16.889-26.074c0-6.158-2.566-12.052-7.242-17.49 l65.863-40.903C383.428,166.971,386.568,174.235,387.141,182.557z">
                      </path>
                    </g>
                  </svg>
                  <strong>K.D. Singh Babu Stadium, Lucknow </strong> <a class="btn btn-link" data-bs-toggle="modal"
                    data-bs-target="#lucknow_modal"><i class="fa fa-map-pin"></i> View Map</a>
                </li>
                <li>
                  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 415.506 415.506" xml:space="preserve">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                      <path
                        d="M383.272,110.52l0.002-0.646l-3.484-0.011l-0.086,27.448c-8.281-6.856-17.703-12.51-26.766-17.017 c-23.309-11.592-48.772-18.684-74.508-23.022l0.041-13.047c12.619-10.885,23.938,5.021,32.303-10.692 c-19.652,0.258-15.338-11.771-32.234-10.734l0.002-0.646l-3.484-0.011l-0.109,34.548c-6.285-0.999-12.58-1.838-18.861-2.541 c-35.063-3.924-70.861-3.619-105.82,1.212c-3.229,0.446-6.465,0.94-9.705,1.463l-0.109-34.682l-3.484,0.011l0.002,0.646 c-16.897-1.037-12.582,10.993-32.234,10.734c8.363,15.713,19.684-0.193,32.301,10.692l0.043,13.168 c-29.039,4.941-58.164,13.233-83.584,28.047c-5.867,3.419-11.984,7.537-17.688,12.285l-0.088-27.863l-3.484,0.011l0.002,0.646 C15.338,109.481,19.654,121.512,0,121.254c8.367,15.712,19.685-0.192,32.303,10.693l0.029,8.801 c-12.324,11.22-21.863,25.568-21.074,42.402c0.912,19.49,12.287,34.646,26.885,46.248v27.828c-5.445-4.65-9.631-9.446-12.393-13.967 c-1.525-2.488-2.686-4.849-3.545-6.978c-0.828-2.137-1.412-4.026-1.752-5.592c-0.346-1.563-0.578-2.787-0.672-3.617 c-0.111-0.833-0.168-1.263-0.168-1.263s-0.033,0.433-0.096,1.271c-0.072,0.841-0.129,2.098-0.059,3.742 c0.156,3.262,0.719,8.221,3.197,14.016c1.211,2.896,2.832,6.002,4.924,9.176c2.078,3.184,4.682,6.381,7.674,9.584 c0.918,0.976,1.891,1.945,2.889,2.91v25.319c-5.445-4.65-9.631-9.445-12.393-13.966c-1.525-2.488-2.686-4.849-3.545-6.978 c-0.828-2.136-1.412-4.026-1.752-5.592c-0.346-1.563-0.578-2.788-0.672-3.617c-0.111-0.833-0.168-1.263-0.168-1.263 s-0.033,0.433-0.096,1.271c-0.072,0.841-0.129,2.098-0.059,3.742c0.156,3.262,0.719,8.22,3.199,14.016 c1.211,2.895,2.832,6.001,4.924,9.176c2.078,3.184,4.682,6.38,7.674,9.583c0.918,0.975,1.889,1.943,2.887,2.908l0.74,0.701 c5.4,5.107,11.889,10.04,19.26,14.613c4.549,2.825,9.438,5.5,14.594,8.053c5.16,2.543,10.615,4.894,16.285,7.137 c11.363,4.416,23.65,8.211,36.555,11.218c6.445,1.538,13.053,2.835,19.764,3.979c0.332,0.057,0.666,0.107,0.998,0.163l1.918,6.39 l4.053-1.216l4.051-1.216l-14.377-47.884c44.209-11.229,87.334-11.229,131.541,0l-14.377,47.883l4.053,1.217l4.051,1.217 l1.918-6.389c0.332-0.056,0.668-0.107,0.998-0.164c6.713-1.144,13.32-2.442,19.766-3.979c12.902-3.007,25.191-6.802,36.555-11.218 c5.668-2.243,11.125-4.594,16.285-7.137c5.154-2.553,10.045-5.228,14.592-8.053c7.371-4.573,13.859-9.506,19.262-14.613l0.74-0.701 c0.998-0.964,1.969-1.933,2.885-2.908c6.031-6.369,10.244-12.928,12.615-18.751c2.439-5.813,3.068-10.751,3.188-14.023 c0.063-1.648,0.012-2.912-0.063-3.743c-0.063-0.838-0.096-1.271-0.096-1.271s-0.059,0.43-0.17,1.263 c-0.096,0.84-0.322,2.057-0.676,3.616c-0.348,1.564-0.939,3.451-1.758,5.59c-0.846,2.132-2.012,4.492-3.551,6.972 c-1.555,2.471-3.467,5.074-5.824,7.667c-1.926,2.099-4.109,4.223-6.551,6.309v-25.321c0.998-0.965,1.971-1.934,2.887-2.91 c6.029-6.369,10.244-12.929,12.613-18.752c2.439-5.813,3.068-10.751,3.188-14.023c0.063-1.648,0.012-2.913-0.063-3.743 c-0.063-0.838-0.096-1.271-0.096-1.271s-0.059,0.43-0.17,1.263c-0.096,0.84-0.322,2.057-0.676,3.616 c-0.348,1.565-0.939,3.451-1.756,5.59c-0.846,2.132-2.012,4.492-3.551,6.972c-1.557,2.471-3.467,5.074-5.824,7.667 c-1.926,2.1-4.111,4.224-6.553,6.31V229.77c14.756-11.677,26.125-26.96,27.268-46.711c-0.061-17.35-9.113-31.51-21.455-42.729 l0.025-8.384c12.619-10.885,23.938,5.019,32.303-10.693C395.852,121.512,400.168,109.481,383.272,110.52z M280.027,114.548 c16.605,3.143,32.943,7.585,48.641,13.701c14,5.455,31.211,13.355,43.342,24.885l-66.66,41.398 c-13.203-10.172-34.381-18.08-59.785-22.076L280.027,114.548z M229.93,108.653c13.213,0.727,26.494,2.042,39.658,4.104 l-34.686,58.282c-8.693-0.95-17.787-1.458-27.148-1.458c-9.363,0-18.455,0.507-27.15,1.458l-34.693-58.297 C173.648,108.351,201.9,107.111,229.93,108.653z M55.637,143.732c23.703-15.661,52.072-24.007,79.842-29.186l34.463,57.909 c-25.404,3.997-46.582,11.904-59.785,22.076l-66.695-41.421C47.25,149.625,51.412,146.522,55.637,143.732z M85.145,316.543 c-7.936-2.711-15.35-5.71-22.109-8.982c-4.535-2.154-8.732-4.49-12.617-6.872c-0.814-0.498-1.605-1.004-2.389-1.513v-24.268 c3.15,2.375,6.525,4.688,10.111,6.914c4.549,2.825,9.439,5.5,14.594,8.053c3.973,1.958,8.123,3.801,12.41,5.569V316.543z M85.145,281.943c-7.936-2.711-15.352-5.711-22.111-8.983c-4.535-2.154-8.73-4.49-12.615-6.872 c-0.816-0.497-1.605-1.004-2.389-1.513v-28.113c3.461,2.231,7,4.297,10.545,6.205c8.537,4.595,17.439,8.505,26.57,11.873V281.943z M76.422,232.545c-13.803-6.317-27.742-14.164-37.881-25.706c-4.895-5.57-11.996-16.036-10.539-24.222 c0.709-3.98,1.832-10.702,4.355-15.745c1.236-2.247,2.668-4.369,4.242-6.385l66.076,41.036c-4.676,5.438-7.244,11.331-7.244,17.49 c0,9.679,6.328,18.706,17.252,26.33C100.236,242.043,88.055,237.868,76.422,232.545z M128.746,327.655 c-11.809-2.156-23.133-4.828-33.715-7.97v-20.436c9.649,3.467,19.881,6.496,30.543,8.981c3.219,0.768,6.479,1.476,9.771,2.135 l5.803,19.328C136.967,329.063,132.828,328.379,128.746,327.655z M320.477,319.685c-10.582,3.143-21.906,5.814-33.717,7.97 c-4.08,0.724-8.221,1.408-12.402,2.039l5.803-19.328c3.293-0.659,6.553-1.367,9.772-2.135c10.664-2.485,20.896-5.515,30.545-8.981 V319.685z M320.477,285.085c-10.582,3.142-21.906,5.814-33.715,7.97c-3.631,0.644-7.309,1.256-11.021,1.828 c-45.701-11.633-90.273-11.633-135.975,0c-3.711-0.572-7.389-1.184-11.02-1.828c-11.811-2.155-23.133-4.828-33.715-7.97v-27.131 c20.076,6.438,41.053,10.423,61.723,12.957c34.283,4.202,69.221,4.148,103.496-0.104c20.242-2.512,40.645-6.456,60.227-12.713 V285.085z M367.478,299.177c-0.783,0.509-1.574,1.015-2.391,1.513c-3.885,2.382-8.08,4.717-12.615,6.872 c-6.76,3.271-14.176,6.27-22.109,8.982v-21.099c4.285-1.769,8.438-3.611,12.41-5.569c5.154-2.552,10.045-5.228,14.592-8.053 c3.588-2.226,6.963-4.54,10.113-6.914V299.177z M367.478,264.575c-0.783,0.509-1.574,1.016-2.389,1.513 c-3.885,2.382-8.08,4.717-12.615,6.872c-6.76,3.272-14.176,6.272-22.111,8.983V254.69c8.365-3.068,16.555-6.584,24.469-10.653 c4.268-2.193,8.52-4.607,12.646-7.247V264.575z M387.141,182.557c-0.145,15.047-13.639,29.256-26.842,38.099 c-17.16,11.493-36.879,19.13-57.113,24.43c10.701-7.569,16.889-16.503,16.889-26.074c0-6.158-2.566-12.052-7.242-17.49 l65.863-40.903C383.428,166.971,386.568,174.235,387.141,182.557z">
                      </path>
                    </g>
                  </svg>
                  <strong>Chowk Stadium, Lucknow </strong> <a class="btn btn-link" data-bs-toggle="modal"
                    data-bs-target="#lucknow_modal1"><i class="fa fa-map-pin"></i> View Map</a>
                </li>
                <li>
                  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 415.506 415.506" xml:space="preserve">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                      <path
                        d="M383.272,110.52l0.002-0.646l-3.484-0.011l-0.086,27.448c-8.281-6.856-17.703-12.51-26.766-17.017 c-23.309-11.592-48.772-18.684-74.508-23.022l0.041-13.047c12.619-10.885,23.938,5.021,32.303-10.692 c-19.652,0.258-15.338-11.771-32.234-10.734l0.002-0.646l-3.484-0.011l-0.109,34.548c-6.285-0.999-12.58-1.838-18.861-2.541 c-35.063-3.924-70.861-3.619-105.82,1.212c-3.229,0.446-6.465,0.94-9.705,1.463l-0.109-34.682l-3.484,0.011l0.002,0.646 c-16.897-1.037-12.582,10.993-32.234,10.734c8.363,15.713,19.684-0.193,32.301,10.692l0.043,13.168 c-29.039,4.941-58.164,13.233-83.584,28.047c-5.867,3.419-11.984,7.537-17.688,12.285l-0.088-27.863l-3.484,0.011l0.002,0.646 C15.338,109.481,19.654,121.512,0,121.254c8.367,15.712,19.685-0.192,32.303,10.693l0.029,8.801 c-12.324,11.22-21.863,25.568-21.074,42.402c0.912,19.49,12.287,34.646,26.885,46.248v27.828c-5.445-4.65-9.631-9.446-12.393-13.967 c-1.525-2.488-2.686-4.849-3.545-6.978c-0.828-2.137-1.412-4.026-1.752-5.592c-0.346-1.563-0.578-2.787-0.672-3.617 c-0.111-0.833-0.168-1.263-0.168-1.263s-0.033,0.433-0.096,1.271c-0.072,0.841-0.129,2.098-0.059,3.742 c0.156,3.262,0.719,8.221,3.197,14.016c1.211,2.896,2.832,6.002,4.924,9.176c2.078,3.184,4.682,6.381,7.674,9.584 c0.918,0.976,1.891,1.945,2.889,2.91v25.319c-5.445-4.65-9.631-9.445-12.393-13.966c-1.525-2.488-2.686-4.849-3.545-6.978 c-0.828-2.136-1.412-4.026-1.752-5.592c-0.346-1.563-0.578-2.788-0.672-3.617c-0.111-0.833-0.168-1.263-0.168-1.263 s-0.033,0.433-0.096,1.271c-0.072,0.841-0.129,2.098-0.059,3.742c0.156,3.262,0.719,8.22,3.199,14.016 c1.211,2.895,2.832,6.001,4.924,9.176c2.078,3.184,4.682,6.38,7.674,9.583c0.918,0.975,1.889,1.943,2.887,2.908l0.74,0.701 c5.4,5.107,11.889,10.04,19.26,14.613c4.549,2.825,9.438,5.5,14.594,8.053c5.16,2.543,10.615,4.894,16.285,7.137 c11.363,4.416,23.65,8.211,36.555,11.218c6.445,1.538,13.053,2.835,19.764,3.979c0.332,0.057,0.666,0.107,0.998,0.163l1.918,6.39 l4.053-1.216l4.051-1.216l-14.377-47.884c44.209-11.229,87.334-11.229,131.541,0l-14.377,47.883l4.053,1.217l4.051,1.217 l1.918-6.389c0.332-0.056,0.668-0.107,0.998-0.164c6.713-1.144,13.32-2.442,19.766-3.979c12.902-3.007,25.191-6.802,36.555-11.218 c5.668-2.243,11.125-4.594,16.285-7.137c5.154-2.553,10.045-5.228,14.592-8.053c7.371-4.573,13.859-9.506,19.262-14.613l0.74-0.701 c0.998-0.964,1.969-1.933,2.885-2.908c6.031-6.369,10.244-12.928,12.615-18.751c2.439-5.813,3.068-10.751,3.188-14.023 c0.063-1.648,0.012-2.912-0.063-3.743c-0.063-0.838-0.096-1.271-0.096-1.271s-0.059,0.43-0.17,1.263 c-0.096,0.84-0.322,2.057-0.676,3.616c-0.348,1.564-0.939,3.451-1.758,5.59c-0.846,2.132-2.012,4.492-3.551,6.972 c-1.555,2.471-3.467,5.074-5.824,7.667c-1.926,2.099-4.109,4.223-6.551,6.309v-25.321c0.998-0.965,1.971-1.934,2.887-2.91 c6.029-6.369,10.244-12.929,12.613-18.752c2.439-5.813,3.068-10.751,3.188-14.023c0.063-1.648,0.012-2.913-0.063-3.743 c-0.063-0.838-0.096-1.271-0.096-1.271s-0.059,0.43-0.17,1.263c-0.096,0.84-0.322,2.057-0.676,3.616 c-0.348,1.565-0.939,3.451-1.756,5.59c-0.846,2.132-2.012,4.492-3.551,6.972c-1.557,2.471-3.467,5.074-5.824,7.667 c-1.926,2.1-4.111,4.224-6.553,6.31V229.77c14.756-11.677,26.125-26.96,27.268-46.711c-0.061-17.35-9.113-31.51-21.455-42.729 l0.025-8.384c12.619-10.885,23.938,5.019,32.303-10.693C395.852,121.512,400.168,109.481,383.272,110.52z M280.027,114.548 c16.605,3.143,32.943,7.585,48.641,13.701c14,5.455,31.211,13.355,43.342,24.885l-66.66,41.398 c-13.203-10.172-34.381-18.08-59.785-22.076L280.027,114.548z M229.93,108.653c13.213,0.727,26.494,2.042,39.658,4.104 l-34.686,58.282c-8.693-0.95-17.787-1.458-27.148-1.458c-9.363,0-18.455,0.507-27.15,1.458l-34.693-58.297 C173.648,108.351,201.9,107.111,229.93,108.653z M55.637,143.732c23.703-15.661,52.072-24.007,79.842-29.186l34.463,57.909 c-25.404,3.997-46.582,11.904-59.785,22.076l-66.695-41.421C47.25,149.625,51.412,146.522,55.637,143.732z M85.145,316.543 c-7.936-2.711-15.35-5.71-22.109-8.982c-4.535-2.154-8.732-4.49-12.617-6.872c-0.814-0.498-1.605-1.004-2.389-1.513v-24.268 c3.15,2.375,6.525,4.688,10.111,6.914c4.549,2.825,9.439,5.5,14.594,8.053c3.973,1.958,8.123,3.801,12.41,5.569V316.543z M85.145,281.943c-7.936-2.711-15.352-5.711-22.111-8.983c-4.535-2.154-8.73-4.49-12.615-6.872 c-0.816-0.497-1.605-1.004-2.389-1.513v-28.113c3.461,2.231,7,4.297,10.545,6.205c8.537,4.595,17.439,8.505,26.57,11.873V281.943z M76.422,232.545c-13.803-6.317-27.742-14.164-37.881-25.706c-4.895-5.57-11.996-16.036-10.539-24.222 c0.709-3.98,1.832-10.702,4.355-15.745c1.236-2.247,2.668-4.369,4.242-6.385l66.076,41.036c-4.676,5.438-7.244,11.331-7.244,17.49 c0,9.679,6.328,18.706,17.252,26.33C100.236,242.043,88.055,237.868,76.422,232.545z M128.746,327.655 c-11.809-2.156-23.133-4.828-33.715-7.97v-20.436c9.649,3.467,19.881,6.496,30.543,8.981c3.219,0.768,6.479,1.476,9.771,2.135 l5.803,19.328C136.967,329.063,132.828,328.379,128.746,327.655z M320.477,319.685c-10.582,3.143-21.906,5.814-33.717,7.97 c-4.08,0.724-8.221,1.408-12.402,2.039l5.803-19.328c3.293-0.659,6.553-1.367,9.772-2.135c10.664-2.485,20.896-5.515,30.545-8.981 V319.685z M320.477,285.085c-10.582,3.142-21.906,5.814-33.715,7.97c-3.631,0.644-7.309,1.256-11.021,1.828 c-45.701-11.633-90.273-11.633-135.975,0c-3.711-0.572-7.389-1.184-11.02-1.828c-11.811-2.155-23.133-4.828-33.715-7.97v-27.131 c20.076,6.438,41.053,10.423,61.723,12.957c34.283,4.202,69.221,4.148,103.496-0.104c20.242-2.512,40.645-6.456,60.227-12.713 V285.085z M367.478,299.177c-0.783,0.509-1.574,1.015-2.391,1.513c-3.885,2.382-8.08,4.717-12.615,6.872 c-6.76,3.271-14.176,6.27-22.109,8.982v-21.099c4.285-1.769,8.438-3.611,12.41-5.569c5.154-2.552,10.045-5.228,14.592-8.053 c3.588-2.226,6.963-4.54,10.113-6.914V299.177z M367.478,264.575c-0.783,0.509-1.574,1.016-2.389,1.513 c-3.885,2.382-8.08,4.717-12.615,6.872c-6.76,3.272-14.176,6.272-22.111,8.983V254.69c8.365-3.068,16.555-6.584,24.469-10.653 c4.268-2.193,8.52-4.607,12.646-7.247V264.575z M387.141,182.557c-0.145,15.047-13.639,29.256-26.842,38.099 c-17.16,11.493-36.879,19.13-57.113,24.43c10.701-7.569,16.889-16.503,16.889-26.074c0-6.158-2.566-12.052-7.242-17.49 l65.863-40.903C383.428,166.971,386.568,174.235,387.141,182.557z">
                      </path>
                    </g>
                  </svg>
                  <strong>Mini Stadium Vijayant Khand, Gomti Nagar, Lucknow </strong> <a class="btn btn-link" data-bs-toggle="modal"
                    data-bs-target="#lucknow_modal2"><i class="fa fa-map-pin"></i> View Map</a>
                </li>
                <li>
                  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 415.506 415.506" xml:space="preserve">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                      <path
                        d="M383.272,110.52l0.002-0.646l-3.484-0.011l-0.086,27.448c-8.281-6.856-17.703-12.51-26.766-17.017 c-23.309-11.592-48.772-18.684-74.508-23.022l0.041-13.047c12.619-10.885,23.938,5.021,32.303-10.692 c-19.652,0.258-15.338-11.771-32.234-10.734l0.002-0.646l-3.484-0.011l-0.109,34.548c-6.285-0.999-12.58-1.838-18.861-2.541 c-35.063-3.924-70.861-3.619-105.82,1.212c-3.229,0.446-6.465,0.94-9.705,1.463l-0.109-34.682l-3.484,0.011l0.002,0.646 c-16.897-1.037-12.582,10.993-32.234,10.734c8.363,15.713,19.684-0.193,32.301,10.692l0.043,13.168 c-29.039,4.941-58.164,13.233-83.584,28.047c-5.867,3.419-11.984,7.537-17.688,12.285l-0.088-27.863l-3.484,0.011l0.002,0.646 C15.338,109.481,19.654,121.512,0,121.254c8.367,15.712,19.685-0.192,32.303,10.693l0.029,8.801 c-12.324,11.22-21.863,25.568-21.074,42.402c0.912,19.49,12.287,34.646,26.885,46.248v27.828c-5.445-4.65-9.631-9.446-12.393-13.967 c-1.525-2.488-2.686-4.849-3.545-6.978c-0.828-2.137-1.412-4.026-1.752-5.592c-0.346-1.563-0.578-2.787-0.672-3.617 c-0.111-0.833-0.168-1.263-0.168-1.263s-0.033,0.433-0.096,1.271c-0.072,0.841-0.129,2.098-0.059,3.742 c0.156,3.262,0.719,8.221,3.197,14.016c1.211,2.896,2.832,6.002,4.924,9.176c2.078,3.184,4.682,6.381,7.674,9.584 c0.918,0.976,1.891,1.945,2.889,2.91v25.319c-5.445-4.65-9.631-9.445-12.393-13.966c-1.525-2.488-2.686-4.849-3.545-6.978 c-0.828-2.136-1.412-4.026-1.752-5.592c-0.346-1.563-0.578-2.788-0.672-3.617c-0.111-0.833-0.168-1.263-0.168-1.263 s-0.033,0.433-0.096,1.271c-0.072,0.841-0.129,2.098-0.059,3.742c0.156,3.262,0.719,8.22,3.199,14.016 c1.211,2.895,2.832,6.001,4.924,9.176c2.078,3.184,4.682,6.38,7.674,9.583c0.918,0.975,1.889,1.943,2.887,2.908l0.74,0.701 c5.4,5.107,11.889,10.04,19.26,14.613c4.549,2.825,9.438,5.5,14.594,8.053c5.16,2.543,10.615,4.894,16.285,7.137 c11.363,4.416,23.65,8.211,36.555,11.218c6.445,1.538,13.053,2.835,19.764,3.979c0.332,0.057,0.666,0.107,0.998,0.163l1.918,6.39 l4.053-1.216l4.051-1.216l-14.377-47.884c44.209-11.229,87.334-11.229,131.541,0l-14.377,47.883l4.053,1.217l4.051,1.217 l1.918-6.389c0.332-0.056,0.668-0.107,0.998-0.164c6.713-1.144,13.32-2.442,19.766-3.979c12.902-3.007,25.191-6.802,36.555-11.218 c5.668-2.243,11.125-4.594,16.285-7.137c5.154-2.553,10.045-5.228,14.592-8.053c7.371-4.573,13.859-9.506,19.262-14.613l0.74-0.701 c0.998-0.964,1.969-1.933,2.885-2.908c6.031-6.369,10.244-12.928,12.615-18.751c2.439-5.813,3.068-10.751,3.188-14.023 c0.063-1.648,0.012-2.912-0.063-3.743c-0.063-0.838-0.096-1.271-0.096-1.271s-0.059,0.43-0.17,1.263 c-0.096,0.84-0.322,2.057-0.676,3.616c-0.348,1.564-0.939,3.451-1.758,5.59c-0.846,2.132-2.012,4.492-3.551,6.972 c-1.555,2.471-3.467,5.074-5.824,7.667c-1.926,2.099-4.109,4.223-6.551,6.309v-25.321c0.998-0.965,1.971-1.934,2.887-2.91 c6.029-6.369,10.244-12.929,12.613-18.752c2.439-5.813,3.068-10.751,3.188-14.023c0.063-1.648,0.012-2.913-0.063-3.743 c-0.063-0.838-0.096-1.271-0.096-1.271s-0.059,0.43-0.17,1.263c-0.096,0.84-0.322,2.057-0.676,3.616 c-0.348,1.565-0.939,3.451-1.756,5.59c-0.846,2.132-2.012,4.492-3.551,6.972c-1.557,2.471-3.467,5.074-5.824,7.667 c-1.926,2.1-4.111,4.224-6.553,6.31V229.77c14.756-11.677,26.125-26.96,27.268-46.711c-0.061-17.35-9.113-31.51-21.455-42.729 l0.025-8.384c12.619-10.885,23.938,5.019,32.303-10.693C395.852,121.512,400.168,109.481,383.272,110.52z M280.027,114.548 c16.605,3.143,32.943,7.585,48.641,13.701c14,5.455,31.211,13.355,43.342,24.885l-66.66,41.398 c-13.203-10.172-34.381-18.08-59.785-22.076L280.027,114.548z M229.93,108.653c13.213,0.727,26.494,2.042,39.658,4.104 l-34.686,58.282c-8.693-0.95-17.787-1.458-27.148-1.458c-9.363,0-18.455,0.507-27.15,1.458l-34.693-58.297 C173.648,108.351,201.9,107.111,229.93,108.653z M55.637,143.732c23.703-15.661,52.072-24.007,79.842-29.186l34.463,57.909 c-25.404,3.997-46.582,11.904-59.785,22.076l-66.695-41.421C47.25,149.625,51.412,146.522,55.637,143.732z M85.145,316.543 c-7.936-2.711-15.35-5.71-22.109-8.982c-4.535-2.154-8.732-4.49-12.617-6.872c-0.814-0.498-1.605-1.004-2.389-1.513v-24.268 c3.15,2.375,6.525,4.688,10.111,6.914c4.549,2.825,9.439,5.5,14.594,8.053c3.973,1.958,8.123,3.801,12.41,5.569V316.543z M85.145,281.943c-7.936-2.711-15.352-5.711-22.111-8.983c-4.535-2.154-8.73-4.49-12.615-6.872 c-0.816-0.497-1.605-1.004-2.389-1.513v-28.113c3.461,2.231,7,4.297,10.545,6.205c8.537,4.595,17.439,8.505,26.57,11.873V281.943z M76.422,232.545c-13.803-6.317-27.742-14.164-37.881-25.706c-4.895-5.57-11.996-16.036-10.539-24.222 c0.709-3.98,1.832-10.702,4.355-15.745c1.236-2.247,2.668-4.369,4.242-6.385l66.076,41.036c-4.676,5.438-7.244,11.331-7.244,17.49 c0,9.679,6.328,18.706,17.252,26.33C100.236,242.043,88.055,237.868,76.422,232.545z M128.746,327.655 c-11.809-2.156-23.133-4.828-33.715-7.97v-20.436c9.649,3.467,19.881,6.496,30.543,8.981c3.219,0.768,6.479,1.476,9.771,2.135 l5.803,19.328C136.967,329.063,132.828,328.379,128.746,327.655z M320.477,319.685c-10.582,3.143-21.906,5.814-33.717,7.97 c-4.08,0.724-8.221,1.408-12.402,2.039l5.803-19.328c3.293-0.659,6.553-1.367,9.772-2.135c10.664-2.485,20.896-5.515,30.545-8.981 V319.685z M320.477,285.085c-10.582,3.142-21.906,5.814-33.715,7.97c-3.631,0.644-7.309,1.256-11.021,1.828 c-45.701-11.633-90.273-11.633-135.975,0c-3.711-0.572-7.389-1.184-11.02-1.828c-11.811-2.155-23.133-4.828-33.715-7.97v-27.131 c20.076,6.438,41.053,10.423,61.723,12.957c34.283,4.202,69.221,4.148,103.496-0.104c20.242-2.512,40.645-6.456,60.227-12.713 V285.085z M367.478,299.177c-0.783,0.509-1.574,1.015-2.391,1.513c-3.885,2.382-8.08,4.717-12.615,6.872 c-6.76,3.271-14.176,6.27-22.109,8.982v-21.099c4.285-1.769,8.438-3.611,12.41-5.569c5.154-2.552,10.045-5.228,14.592-8.053 c3.588-2.226,6.963-4.54,10.113-6.914V299.177z M367.478,264.575c-0.783,0.509-1.574,1.016-2.389,1.513 c-3.885,2.382-8.08,4.717-12.615,6.872c-6.76,3.272-14.176,6.272-22.111,8.983V254.69c8.365-3.068,16.555-6.584,24.469-10.653 c4.268-2.193,8.52-4.607,12.646-7.247V264.575z M387.141,182.557c-0.145,15.047-13.639,29.256-26.842,38.099 c-17.16,11.493-36.879,19.13-57.113,24.43c10.701-7.569,16.889-16.503,16.889-26.074c0-6.158-2.566-12.052-7.242-17.49 l65.863-40.903C383.428,166.971,386.568,174.235,387.141,182.557z">
                      </path>
                    </g>
                  </svg>
                  <strong>Vinay Khand Mini Sports Stadium </strong> <a class="btn btn-link" data-bs-toggle="modal"
                    data-bs-target="#lucknow_modal2"><i class="fa fa-map-pin"></i> View Map</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div id="experience" class="tab-pane ">
          <svg class="svg-mapcat  " version="1.1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300"
            enable-background="new 0 0 0 0" xml:space="preserve" id="map-svg-locations">
            <g id="matrix-group" transform="matrix(1 0 0 1 0 0) scale(0.45,0.45)" fill="#000000" stroke="none">
              <path class="territory" id="Saharanpur"
                d="M52.029,17.846c-0.124,0.081,0.162,1.182,0.569,2.405c1.265,3.587,0.856,4.769-2.935,8.56
                           c-2.078,2.079-3.222,3.506-3.222,4.117c0,1.548-0.813,3.098-2.771,5.258c-1.063,1.142-2.487,2.813-3.22,3.709
                           c-0.938,1.183-1.714,1.753-2.813,1.957s-2.445,1.102-5.014,3.506c-5.056,4.647-6.972,6.604-8.644,8.602
                           c-2.895,3.465-2.935,3.505-3.139,9.944c-0.204,5.707-0.246,5.952-1.386,7.541c-1.429,1.957-1.956,4.036-1.062,4.036
                           c0.366,0,1.306,0.448,2.118,1.02c1.387,0.937,1.55,0.978,2.446,0.406c1.304-0.854,2.771-0.447,4.401,1.224
                           c0.773,0.732,2.403,1.712,3.71,2.161l2.404,0.854l3.221-0.814l3.221-0.815l2.364,1.467c1.671,1.02,3.017,1.508,4.604,1.671
                           c2.079,0.204,3.791,0.733,6.687,1.998c1.996,0.896,4.075,0.979,6.398,0.326c1.182-0.326,2.649-0.692,3.262-0.814
                           c0.61-0.123,1.67-0.815,2.363-1.591c0.693-0.773,1.468-1.385,1.752-1.385c0.285,0,1.225-0.732,2.12-1.631l1.55-1.589l-1.468-1.671
                           c-1.346-1.426-1.508-1.875-1.508-3.791c0-2.486-0.856-5.706-2.283-8.602c-1.223-2.567-1.223-2.771,0.203-5.747
                           c1.102-2.323,2.202-3.628,5.341-6.521c0.733-0.693,1.672-1.998,2.12-2.936c0.408-0.938,0.938-1.834,1.143-1.956
                           c0.203-0.122,0.325-2.12,0.325-4.402c-0.081-3.709,0.041-4.402,0.896-5.87c0.528-0.938,1.671-2.282,2.526-2.976
                           c1.915-1.55,2.079-2.854,0.366-2.854c-1.549,0-4.523-1.304-5.502-2.405c-0.448-0.447-1.061-0.854-1.428-0.854
                           c-0.366,0-1.021-0.286-1.427-0.612c-0.448-0.326-1.061-0.611-1.346-0.611c-0.854,0-5.34-3.139-5.829-4.075
                           c-0.244-0.448-1.386-1.55-2.566-2.446c-1.184-0.896-2.363-1.834-2.689-2.12C57.245,18.946,52.314,17.561,52.029,17.846z" />
              <path class="territory" id="Bijnaur" d="M111.132,77.725c-1.1,0.285-2.201,0.692-2.445,0.938c-0.285,0.202-2.241,1.141-4.359,2.038
                           c-2.12,0.938-4.565,2.16-5.382,2.689c-1.712,1.143-3.302,1.264-4.811,0.408c-1.427-0.815-1.957-0.733-2.12,0.285
                           c-0.081,0.692-0.813,1.264-2.646,2.161c-1.389,0.651-3.02,1.711-3.668,2.282c-0.611,0.57-1.469,1.183-1.836,1.305
                           c-0.896,0.326-0.979,2.283-0.161,3.872c0.283,0.61,0.65,1.917,0.813,2.935c0.163,0.979,0.652,2.609,1.103,3.628
                           c0.406,0.979,0.896,2.813,1.02,4.076c0.163,1.264,0.53,2.568,0.856,2.976c0.324,0.367,0.854,1.713,1.223,3.018
                           c0.326,1.304,0.854,2.894,1.181,3.505c0.326,0.612,0.571,1.997,0.571,3.098c0,1.468,0.203,2.202,0.815,2.731
                           c1.142,1.06,1.182,5.055,0.041,6.074c-0.448,0.406-0.938,1.508-1.063,2.404c-0.163,0.938-0.529,1.997-0.813,2.323
                           c-0.285,0.367-0.408,1.224-0.326,2.12c0.163,1.263,0.364,1.549,1.1,1.549c0.489,0,1.508,0.448,2.283,1.02
                           c0.731,0.528,2.242,1.304,3.302,1.63c1.104,0.367,2.08,0.854,2.201,1.06c0.326,0.53,3.669,0.448,5.584-0.122
                           c1.182-0.366,1.671-0.366,2.038,0c0.732,0.733,2.729,0.57,6.276-0.488c1.753-0.571,4.521-1.102,6.071-1.183
                           c2.242-0.122,3.343-0.407,5.098-1.427c1.223-0.693,2.729-1.508,3.302-1.834c0.609-0.326,1.834-1.549,2.771-2.731
                           c1.348-1.711,1.673-2.444,1.673-3.791c0-0.938,0.245-2.119,0.529-2.567c0.244-0.489,0.896-1.589,1.386-2.486
                           c0.529-0.979,1.388-1.834,2.16-2.16c0.692-0.285,1.631-1.06,2.079-1.712l0.856-1.182l-0.856-0.612
                           c-2.404-1.711,0.774-4.81,4.524-4.361c1.672,0.204,2.038,0.082,2.976-0.854c0.57-0.571,1.267-1.061,1.55-1.061
                           c0.733,0,4.852-3.465,5.422-4.564c0.731-1.386,0-1.957-2.567-1.957c-2.896,0-4.28-0.611-7.583-3.464
                           c-2.568-2.161-2.977-2.365-5.503-2.65c-4.483-0.569-7.174-2.038-10.68-5.788c-1.672-1.834-3.304-3.954-3.588-4.769
                           c-1.386-4.035-3.587-8.234-4.359-8.397C114.882,77.235,112.885,77.235,111.132,77.725z" />
              <path class="territory" id="Baghpat"
                d="M16.687,116.937c0,1.957,0.162,4.199,0.408,4.974c0.285,0.979,0.285,1.834-0.042,2.813
                           c-0.896,2.649-0.61,5.054,0.856,7.989c0.771,1.549,1.793,2.935,2.281,3.138c0.652,0.286,1.021,0.938,1.185,1.998
                           c0.285,1.712-0.082,4.729-0.612,5.055c-0.164,0.122-0.326,2.283-0.367,4.852c0,4.32,0.043,4.646,0.734,4.441
                           c0.489-0.121,1.143,0.326,2.038,1.469c1.062,1.304,1.59,1.671,2.607,1.671c0.692,0,1.917,0.449,2.771,1.019
                           c4.118,2.895,8.479,0.611,5.666-2.935c-1.143-1.467-1.021-2.038,0.732-3.994c0.814-0.938,1.795-2.039,2.161-2.487
                           c0.365-0.406,1.143-1.141,1.793-1.589c0.896-0.692,1.143-1.142,1.103-2.243c-0.124-2.853-0.815-7.622-1.508-9.985
                           c-1.144-4.076-1.225-5.421-0.286-6.44c1.02-1.142,1.549-2.202,1.834-3.791c0.204-1.06,0.041-1.468-0.896-2.364
                           c-1.061-1.02-1.631-1.183-5.3-1.468c-3.994-0.367-7.336-1.345-7.947-2.405c-0.487-0.733-3.059-1.671-4.688-1.671
                           c-0.814,0-2.079-0.367-2.813-0.814c-0.732-0.448-1.428-0.815-1.509-0.815C16.769,113.35,16.687,114.939,16.687,116.937z" />
              <path class="territory" id="Meerut" d="M48.032,120.769c-1.348,1.59-1.591,1.712-3.953,1.875c-2.161,0.163-2.528,0.286-2.528,0.979
                           c0,0.732-1.06,2.975-2.12,4.483c-0.367,0.53-0.326,1.224,0.245,3.261c0.407,1.387,0.896,2.976,1.102,3.506
                           c0.204,0.529,0.366,1.875,0.366,3.017c0,1.141,0.203,2.731,0.448,3.546c0.326,1.143,0.285,1.834-0.163,3.22l-0.61,1.753l1.51,0.774
                           c1.589,0.774,5.38,1.508,10.965,2.038c1.833,0.163,3.628,0.53,3.954,0.815c0.854,0.692,1.956,4.36,1.752,5.951
                           c-0.122,1.142,0.081,1.59,1.141,2.649l1.265,1.223l2.282-1.712c1.266-0.938,3.06-2.689,3.954-3.872
                           c1.63-2.16,1.711-2.201,3.75-2.201c1.386,0,2.364,0.244,2.854,0.692c0.689,0.611,0.978,0.57,4.729-0.651
                           c2.527-0.815,4.771-1.265,6.196-1.265c3.097,0,4.116-0.732,3.791-2.771c-0.163-0.815-0.693-2.201-1.225-3.018
                           c-0.487-0.855-1.224-2.281-1.591-3.18c-0.648-1.589-0.648-1.752,0.408-4.973c0.815-2.446,1.063-3.709,0.857-4.892
                           c-0.204-1.223-0.122-1.794,0.405-2.365c0.366-0.406,0.773-1.508,0.896-2.404c0.122-0.896,0.57-1.957,0.979-2.324
                           c0.938-0.814,1.021-3.26,0.162-4.401c-0.486-0.651-0.979-0.733-4.973-0.529c-7.377,0.406-9.62,0.938-15.938,3.832
                           c-3.466,1.589-3.872,1.63-5.99,0.528c-0.897-0.448-1.794-0.814-2.08-0.814c-0.244,0-1.102-0.734-1.957-1.632
                           c-1.63-1.793-2.896-2.037-4.483-1.019c-1.223,0.816-2.935,0.449-3.791-0.856c-0.325-0.529-0.73-0.978-0.896-0.978
                           C49.622,119.098,48.848,119.831,48.032,120.769z" />
              <path class="territory" id="Rampur" d="M158.252,129.736c-1.063,0.53-1.752,1.183-1.834,1.712c-0.081,0.571-0.815,1.183-2.038,1.834
                           c-1.672,0.815-1.957,1.102-1.957,2.161c0,0.896-0.408,1.589-1.508,2.609c-0.815,0.773-1.672,1.385-1.834,1.385
                           c-0.653,0-0.326,1.305,0.65,2.569c1.429,1.956,1.549,2.771,0.814,5.991l-0.651,2.976l1.753,1.468
                           c1.508,1.346,1.752,1.752,1.916,3.547c0.365,4.483,0.203,5.422-1.346,7.133c-1.019,1.142-1.426,1.957-1.426,2.976
                           c0,1.63-1.348,3.506-2.568,3.506c-0.448,0-1.427-0.204-2.2-0.489c-1.876-0.692-2.038-0.203-0.569,1.59
                           c0.691,0.855,1.265,1.753,1.265,1.996c0,0.246,0.815,1.143,1.793,1.957c1.224,1.021,1.834,1.834,1.997,2.771
                           c1.061,6.073,1.061,6.155,0.408,7.255c-0.57,1.02-0.57,1.182,0.081,2.161c0.568,0.896,0.61,1.304,0.245,2.323
                           c-0.367,1.183-0.326,1.305,0.691,1.671c1.63,0.653,2.854,0.042,4.894-2.486c3.992-4.932,4.932-5.788,7.173-6.685
                           c2.607-1.061,8.725-6.115,9.09-7.5c0.123-0.529,0.123-1.549,0-2.283c-0.203-1.223-0.081-1.426,1.144-1.997
                           c0.772-0.367,1.956-1.549,2.771-2.813c0.813-1.181,2.648-3.261,4.117-4.605c1.834-1.671,2.689-2.731,2.689-3.383
                           c0-0.53,0.365-1.712,0.814-2.608c0.448-0.938,0.813-1.875,0.813-2.12c0-0.204,0.366-0.773,0.772-1.223
                           c0.653-0.693,0.813-1.549,0.896-4.076c0.164-3.995-0.162-4.321-4.481-4.362c-5.503-0.041-6.521-0.366-9.742-3.098
                           c-1.549-1.386-3.261-2.609-3.709-2.772c-1.264-0.365-2.078-2.282-2.078-4.81c0-2.446-0.408-3.017-3.1-4.361
                           C162.043,128.636,160.412,128.677,158.252,129.736z" />
              <path class="territory" id="Jyotiba Phule Nagar" d="M88.386,136.87c-0.204,0.651-0.569,1.589-0.814,2.159c-0.405,1.102-0.079,2.161,1.834,5.544
                           c1.307,2.364,1.674,4.892,0.856,6.155c-0.53,0.774-0.57,1.264-0.204,2.486c0.204,0.814,0.408,1.998,0.408,2.568
                           c0,0.978,0.896,3.342,2.854,7.5c1.469,3.098,2.241,8.111,2.079,13.369c-0.041,1.998,0.123,4.198,0.366,4.933
                           c0.408,1.264,0.611,1.386,2.487,1.631c2.283,0.326,2.283,0.326,2.729,3.709c0.243,2.242,0.366,2.446,1.347,2.567
                           c0.854,0.081,1.386-0.243,2.607-1.712c1.712-2.078,2.363-2.282,3.709-1.019c0.528,0.489,1.225,0.774,1.549,0.652
                           c0.733-0.286,0.896-1.712,0.245-2.12c-0.651-0.407-0.487-1.508,0.406-2.446c0.489-0.53,0.897-1.712,1.061-3.179
                           c0.246-1.956,0.163-2.487-0.447-3.18c-0.449-0.448-0.814-1.101-0.856-1.508c-0.08-0.367-0.284-1.469-0.529-2.445
                           c-0.242-0.979-0.324-1.998-0.161-2.243c0.161-0.285,0.324-1.793,0.364-3.342c0.082-4.076,0.285-4.524,2.73-5.666
                           c2.16-0.979,5.054-1.061,5.666-0.123c0.163,0.285,1.061,0.123,2.566-0.448c1.266-0.489,2.648-0.897,3.018-0.897
                           c0.53,0,0.938-0.651,1.468-2.444l0.734-2.446l-1.348-2.609c-0.732-1.468-1.507-2.73-1.793-2.853
                           c-2.079-1.061-2.895-1.834-3.017-2.813c-0.081-0.61-0.408-1.589-0.691-2.2c-0.487-0.979-0.447-1.265,0.447-2.936
                           c1.104-2.079,1.265-3.506,0.449-3.832c-0.896-0.326-5.991,0.408-9.048,1.306c-2.978,0.896-6.115,1.101-6.522,0.488
                           c-0.121-0.245-0.731-0.245-1.549,0c-2.079,0.611-5.829,0.448-6.398-0.245c-0.284-0.325-1.184-0.773-2.036-1.019
                           c-0.816-0.204-2.202-0.856-3.02-1.427C89.936,135.442,88.917,135.483,88.386,136.87z" />
              <path class="territory" id="Pilibhit"
                d="M210.875,152.114c0.367,2.405-0.448,3.709-1.834,2.895c-1.144-0.733-1.63-0.204-1.875,2.038
                           c-0.163,1.386,0.082,2.365,1.101,4.564c1.55,3.426,1.346,4.28-1.223,5.137c-1.753,0.57-2.365,1.345-2.896,3.586
                           c-0.487,2.202,0.488,3.995,2.813,5.096c1.875,0.896,1.917,0.938,2.283,3.343l0.365,2.446l2.896,1.427
                           c2.896,1.426,2.896,1.426,3.179,3.383c0.246,1.712,0.082,2.283-1.019,4.443c-1.062,2.079-1.549,2.608-3.1,3.301
                           c-2.363,1.02-2.281,0.856-1.671,2.324c0.448,1.06,0.407,1.508-0.204,3.057c-0.651,1.794-0.651,1.875,0.161,2.569
                           c1.348,1.06,1.55,3.423,0.489,4.932l-0.854,1.224l1.021,1.019c0.611,0.611,1.265,1.63,1.508,2.283
                           c0.489,1.467,1.794,1.63,2.323,0.286c0.204-0.489,1.182-1.672,2.202-2.649l1.793-1.794l0.896,1.427
                           c0.49,0.856,0.857,2.079,0.857,3.099c0,1.63,1.021,3.302,2.079,3.302c0.204,0,0.938,0.571,1.59,1.263
                           c1.63,1.794,3.017,1.428,4.157-1.141c0.732-1.671,0.813-2.649,0.773-8.356c-0.082-7.377,0.284-9.212,2.038-10.679
                           c1.467-1.264,1.916-1.304,2.282-0.367c0.449,1.305,1.469,2.16,2.566,2.16c0.57,0,1.266,0.204,1.51,0.448
                           c0.245,0.246,1.549,0.45,2.896,0.45c2.241,0,2.567,0.122,3.791,1.385c0.732,0.774,1.548,1.386,1.793,1.386
                           c0.244,0,0.979-0.57,1.671-1.264c1.549-1.672,3.345-2.568,3.954-2.079c0.285,0.245,1.143,0.529,1.957,0.693
                           c0.979,0.163,1.793,0.692,2.363,1.467c0.489,0.653,1.142,1.183,1.428,1.183c0.813,0,3.098-3.017,3.098-4.036
                           c0-1.223-1.345-3.709-2.647-4.932c-1.508-1.386-3.342-5.177-2.771-5.748c0.693-0.693,3.385-1.182,6.973-1.182
                           c4.237,0,5.055-0.367,4.688-2.16c-0.285-1.508-1.347-2.813-3.383-4.198c-0.774-0.489-2.405-1.834-3.547-2.935
                           c-1.794-1.672-2.16-2.284-2.16-3.425c0-0.773,0.203-1.589,0.407-1.793c0.69-0.692,0.081-1.508-2.282-2.976
                           c-1.224-0.774-2.405-1.711-2.609-2.119c-0.365-0.692-6.97-6.521-10.436-9.213l-1.671-1.304l-1.223,1.304
                           c-0.693,0.733-1.876,2.324-2.65,3.587c-1.63,2.527-5.502,6.073-6.685,6.073c-1.265,0-2.69-1.224-2.486-2.079
                           c0.122-0.408,0-1.345-0.286-2.079c-0.732-2.161-0.979-2.364-2.118-1.957c-1.224,0.489-1.428,0.489-2.121,0.081
                           c-0.407-0.285-0.366-0.652,0.123-1.834c0.325-0.814,0.61-1.59,0.61-1.671c0-0.367-2.405,0.652-2.896,1.223
                           c-0.242,0.326-0.813,0.571-1.264,0.571c-0.734,0-0.775-0.245-0.693-2.771c0.081-1.509,0-2.936-0.121-3.18
                           c-0.325-0.489-2.649-0.245-3.018,0.285c-0.448,0.733-1.549,0.326-3.343-1.142l-1.834-1.509L210.875,152.114z" />
              <path class="territory" id="Bareilly"
                d="M195.019,152.93c-1.386,0.856-3.914,1.019-5.096,0.285c-0.652-0.408-0.938-0.367-1.833,0.489
                           c-0.571,0.529-1.021,1.182-1.021,1.468c0,0.326-0.365,1.182-0.813,1.998c-0.449,0.814-0.814,1.916-0.814,2.485
                           c0,0.733-0.854,1.875-3.221,4.158c-1.793,1.711-3.587,3.791-3.995,4.565c-0.448,0.773-1.386,1.793-2.08,2.242
                           c-1.06,0.692-1.263,1.101-1.303,2.445c-0.042,0.897-0.163,1.957-0.327,2.324c-0.528,1.304-7.703,7.092-9.416,7.622
                           c-1.752,0.488-4.32,2.896-7.051,6.481l-1.508,1.955l1.426,0.775c0.774,0.407,2.039,1.467,2.813,2.282l1.388,1.549l-0.041,4.606
                           c-0.041,3.627,0.082,4.891,0.651,5.95c0.691,1.346,2.813,2.936,3.913,2.936c0.326,0,1.144,0.285,1.753,0.611
                           c1.591,0.813,3.344,1.101,8.11,1.223c2.323,0.081,5.869,0.285,7.948,0.529c3.139,0.325,3.954,0.57,5.177,1.549
                           c0.815,0.651,1.469,1.304,1.469,1.468c0,0.163,0.814,1.102,1.834,2.079c1.508,1.508,1.834,2.079,1.834,3.302
                           c0,0.896-0.365,1.997-0.854,2.69c-2.69,3.628,2.444,2.567,6.889-1.427c2.079-1.834,2.938-3.546,2.938-5.746
                           c0-1.021,0.404-2.038,1.385-3.385c0.732-1.019,1.549-2.485,1.834-3.261c0.245-0.771,0.896-1.997,1.468-2.729
                           c1.102-1.47,1.063-3.262-0.082-3.71c-1.182-0.448-1.346-1.631-0.488-3.547c0.733-1.711,0.774-1.956,0.162-3.098
                           c-0.854-1.67-0.326-2.609,2.038-3.464c1.509-0.612,2.038-1.102,2.937-2.813c1.631-3.015,1.346-4.36-1.226-5.747
                           c-1.059-0.57-2.241-1.02-2.564-1.02c-0.734,0-1.267-1.223-1.591-3.668c-0.244-1.671-0.407-1.957-2.322-3.057
                           c-2.609-1.55-3.506-3.629-2.731-6.44c0.774-2.935,1.429-3.791,3.425-4.525l1.875-0.732l-0.731-1.263
                           c-1.712-2.979-2.12-6.319-1.103-8.969c0.447-1.223-1.061-1.305-3.14-0.163c-1.06,0.611-2.12,1.102-2.324,1.102
                           c-0.243,0-1.181-0.733-2.118-1.631c-0.938-0.896-1.834-1.63-1.958-1.589C196.365,152.114,195.712,152.48,195.019,152.93z" />
              <path class="territory" id="Bulandshahr"
                d="M74.935,168.867c-0.529,0.733-1.303,1.834-1.671,2.404c-0.854,1.387-3.221,2.242-4.36,1.589
                           c-0.732-0.366-1.183-0.163-3.1,1.428c-1.264,1.019-2.444,1.834-2.689,1.834c-0.772,0-3.303,1.957-3.789,2.935
                           c-0.366,0.692-0.896,0.979-2.282,1.141c-1.631,0.163-1.917,0.367-2.528,1.631c-0.406,0.814-1.468,1.996-2.363,2.648
                           c-1.918,1.427-2.648,3.709-1.428,4.361c1.145,0.652,2.242,1.917,2.242,2.567c0,0.367-0.449,1.102-1.021,1.672
                           c-0.813,0.814-0.938,1.182-0.609,1.793c0.609,1.141,0.528,1.467-0.815,2.976c-1.265,1.468-1.957,4.158-1.265,5.137
                           c0.204,0.325,1.062,0.692,1.916,0.814c2.039,0.326,2.935,1.915,2.202,3.709c-0.571,1.345-0.285,2.039,0.813,2.039
                           c1.226,0,2.119,1.712,1.834,3.424c-0.164,0.774-0.527,1.63-0.854,1.915c-0.855,0.734-0.733,2.405,0.204,2.405
                           c0.406,0,0.979,0.285,1.265,0.611c0.366,0.448,0.652,0.529,0.938,0.244c0.286-0.285,0.204-0.651-0.242-1.182
                           c-0.408-0.449-0.53-0.896-0.327-1.141c0.204-0.204,0.449-0.815,0.528-1.387c0.123-0.938,0.284-1.02,2.364-1.06
                           c1.226-0.041,2.978-0.367,3.831-0.774c1.957-0.814,2.896-0.61,5.3,1.224c1.021,0.773,2.567,1.752,3.467,2.241
                           c1.06,0.529,1.956,1.387,2.443,2.364c0.692,1.386,0.938,1.549,1.997,1.386c1.021-0.121,1.266-0.407,1.468-1.549
                           c0.285-1.346,1.876-3.017,2.978-3.017c0.285,0,1.06,0.326,1.671,0.773c0.611,0.408,1.998,1.265,3.057,1.875
                           c1.389,0.733,2.161,1.549,2.568,2.527l0.612,1.385l2.037-1.752c3.14-2.649,3.222-2.689,6.521-3.098
                           c1.672-0.204,3.668-0.693,4.402-1.101c1.834-0.938,3.139-0.325,4.729,2.16c1.063,1.672,1.428,1.916,2.772,2.038
                           c1.834,0.163,3.138-0.773,3.138-2.16c0-1.101-1.06-3.709-1.63-4.075c-0.246-0.163-0.856-0.938-1.386-1.753
                           c-0.53-0.857-2.079-2.69-3.467-4.158c-1.386-1.467-3.017-3.22-3.668-3.872c-1.183-1.264-3.75-5.136-4.237-6.441
                           c-0.124-0.367,0.041-2.729,0.364-5.258c0.896-6.359,0.529-7.664-2.036-7.664c-1.834,0-3.101-2.568-3.101-6.318
                           c0-2.282-0.123-2.649-0.731-2.649c-0.408,0-0.897-0.163-1.103-0.366c-0.246-0.204-0.854-0.449-1.427-0.53s-1.182-0.529-1.427-1.059
                           c-0.285-0.653-0.856-0.979-1.916-1.183c-0.856-0.122-1.752-0.489-1.998-0.774c-0.285-0.327-1.225-0.571-2.323-0.571
                           c-1.63,0-2.038-0.204-3.668-1.834c-0.979-1.019-2.121-1.834-2.487-1.834C76.24,167.563,75.506,168.175,74.935,168.867z" />
              <path class="territory" id="Lakhimpur" d="M271.652,169.724c-0.406,0.61-0.691,2.486-0.854,5.299l-0.286,4.361l-1.711-1.752
                           c-2.201-2.161-4.321-3.873-6.033-4.729c-0.689-0.366-1.711-0.938-2.242-1.263c-0.813-0.53-0.978-0.53-1.304,0
                           c-0.489,0.774-0.531,2.445-0.042,2.445c0.204,0,1.266,0.814,2.324,1.834c1.101,1.019,2.201,1.834,2.405,1.834
                           c0.243,0,1.182,0.773,2.077,1.752c2.12,2.161,2.731,4.851,1.47,6.44c-0.733,0.856-1.185,0.979-5.747,1.183
                           c-2.691,0.163-5.016,0.367-5.139,0.489c-0.324,0.325,0.938,2.527,2.08,3.627c1.51,1.427,3.018,4.564,3.018,6.358
                           c0,1.265-0.327,1.917-1.753,3.424c-0.938,1.02-1.957,1.957-2.283,2.038c-0.448,0.163-0.611,1.224-0.611,4.893
                           c-0.082,6.113-0.649,7.296-3.913,7.947c-2.402,0.449-3.017,1.265-1.916,2.527c1.021,1.141,1.184,2.405,0.529,3.709
                           c-0.651,1.182-4.77,4.606-6.195,5.096c-1.59,0.53-2.729,1.957-3.424,4.198c-0.649,2.242-0.854,2.446-3.139,3.709l-2.446,1.386
                           l0.367,1.875c0.245,1.062,0.57,2.649,0.813,3.547c0.203,0.896,0.489,2.444,0.611,3.464c0.163,1.509,0.449,2.038,1.631,2.935
                           c1.307,1.02,1.673,1.102,3.628,0.897c1.429-0.164,2.405-0.123,2.771,0.204c0.286,0.243,1.509,0.733,2.648,1.1
                           c1.184,0.327,2.69,0.979,3.385,1.386c1.141,0.693,1.345,0.693,2.199,0.123c0.61-0.367,1.388-0.489,2.078-0.367
                           c0.857,0.204,1.511,0,2.527-0.733c0.734-0.57,1.916-1.142,2.609-1.304c0.69-0.124,2.605-0.979,4.318-1.876
                           c3.586-1.916,4.771-1.875,6.851,0.246c2.241,2.2,2.854,2.16,3.139-0.286c0.245-1.712,0.571-2.322,1.998-3.627
                           c2.771-2.567,5.054-2.812,7.296-0.814c0.489,0.408,1.793,0.652,3.668,0.733c1.63,0.082,3.832,0.245,4.894,0.367
                           c1.672,0.245,1.914,0.204,2.158-0.611c0.284-0.855,3.669-3.302,5.341-3.831c0.487-0.163,1.184-0.611,1.59-1.06
                           c0.529-0.611,1.265-0.814,2.689-0.814c2.119,0,2.404,0.243,3.017,2.608c0.366,1.427,0.651,1.671,2.243,2.161
                           c1.02,0.325,2.771,1.02,3.871,1.508c1.144,0.53,3.221,1.101,4.646,1.224c1.469,0.163,3.099,0.61,3.71,0.977
                           c0.568,0.367,1.385,0.897,1.834,1.142c1.182,0.652,1.304,3.017,0.205,4.035c-1.186,1.061-1.021,1.712,0.567,2.242
                           c0.732,0.245,1.712,0.815,2.119,1.263l0.733,0.815l0.326-0.856c0.16-0.447,0.122-1.712-0.082-2.853
                           c-0.203-1.102-0.326-5.462-0.326-9.701l0.082-7.744l-2.938-2.935c-1.63-1.63-2.935-3.099-2.935-3.302
                           c0-0.204-0.61-1.062-1.388-1.876c-1.916-2.16-2.118-3.099-1.021-4.605c1.266-1.712,1.225-3.75-0.12-5.177
                           c-1.632-1.793-3.181-4.321-3.181-5.218c0-0.448,0.285-1.224,0.61-1.712c0.529-0.774,0.529-0.896-0.082-1.101
                           c-0.365-0.162-1.469-0.162-2.486,0c-1.954,0.287-2.523-0.081-2.523-1.711c0-0.489-0.65-1.672-1.428-2.649
                           c-1.55-1.997-1.59-2.445-0.366-7.622c0.691-2.813,0.529-3.873-0.813-5.3c-1.185-1.305-2.446-1.916-5.423-2.567
                           c-2.2-0.449-2.566-0.653-2.566-1.427c0-0.489-0.284-1.101-0.61-1.387c-0.327-0.285-0.609-0.732-0.609-1.06
                           c0-0.775-1.348-1.062-2.609-0.571c-2.771,1.061-5.747,0.245-6.151-1.671c-0.246-1.101-0.693-1.468-3.06-2.569
                           c-2.935-1.345-5.014-3.464-6.479-6.603c-0.979-2.12-2.405-3.261-4.565-3.588c-0.896-0.163-2.201-0.53-2.853-0.856
                           C273.446,168.542,272.385,168.623,271.652,169.724z" />
              <path class="territory" id="Gautam Budh Nagar" d="M29.323,172.943c0,0.693-0.283,1.59-0.651,1.996c-0.611,0.693-0.57,0.979,0.855,3.915
                           c0.814,1.752,1.752,3.668,2.079,4.279c0.325,0.57,0.57,1.467,0.57,1.916c0,0.489,0.448,1.589,0.979,2.446
                           c0.733,1.181,1.388,1.63,2.404,1.834c0.774,0.162,1.672,0.162,1.957,0.039c0.367-0.121,0.857,0.367,1.346,1.387
                           c0.734,1.549,0.734,1.631-0.081,3.831l-0.854,2.241l0.896,0.774c0.489,0.449,1.225,0.938,1.632,1.06
                           c0.813,0.285,0.854,0.653,0.283,2.161c-0.528,1.347,0.406,3.017,1.714,3.017c0.487,0,1.223,0.326,1.63,0.692
                           c0.732,0.652,0.691,0.734-0.774,2.242c-0.979,1.02-1.304,1.548-0.896,1.548c0.365,0,0.938,0.327,1.304,0.734
                           c0.773,0.857,0.449,1.508-1.467,2.691c-0.979,0.61-1.063,0.813-0.653,1.345c0.286,0.326,0.734,1.019,0.979,1.508
                           c0.366,0.734,0.813,0.856,2.688,0.856c1.265,0,2.568,0.243,2.896,0.528c1.304,1.062,6.438-2.038,6.438-3.872
                           c0-0.285-0.854-0.938-1.957-1.427c-2.039-0.978-2.323-1.793-1.061-3.22c0.813-0.896,0.283-1.997-0.938-1.997
                           c-0.57,0-1.549-0.53-2.241-1.265c-1.184-1.182-1.224-1.346-0.979-3.546c0.204-1.793,0.531-2.608,1.468-3.546
                           c0.856-0.896,1.104-1.386,0.815-1.834c-0.693-1.101-0.449-2.322,0.69-3.057l1.062-0.693l-1.548-1.304
                           c-1.471-1.264-1.551-1.427-1.308-3.138c0.163-1.469,0.571-2.12,1.998-3.425c0.979-0.896,2.201-2.282,2.69-3.098
                           c0.979-1.63,0.938-1.712-1.306-2.813c-0.65-0.326-1.917-1.55-2.813-2.649l-1.63-2.038l-3.914,0.163c-3.18,0.082-4.035,0-4.483-0.489
                           c-0.568-0.691-1.346-0.528-2.854,0.611c-1.508,1.141-3.14,0.979-3.994-0.489c-0.53-0.896-1.021-1.223-1.834-1.223
                           C29.447,171.639,29.323,171.803,29.323,172.943z" />
              <path class="territory" id="Bahraich" d="M312.656,196.055c-1.225,6.033-1.225,6.441,0,7.622c0.61,0.571,1.225,1.712,1.387,2.487
                           c0.242,1.264,0.364,1.385,1.264,1.182c1.591-0.408,3.791,0.163,4.32,1.101c0.325,0.653,0.284,1.143-0.284,2.16
                           c-0.651,1.266-0.651,1.306,0.407,3.059c0.609,0.979,1.59,2.161,2.158,2.648c0.856,0.693,1.063,1.224,1.063,2.854
                           c0.041,1.142-0.285,2.567-0.692,3.383c-0.938,1.834-0.896,1.957,0.529,3.179c0.692,0.53,1.225,1.306,1.225,1.63
                           c0,0.326,1.428,1.958,3.14,3.628l3.098,3.058l0.163,9.457c0.082,5.217,0.163,10.231,0.163,11.21c0.04,1.06-0.204,1.997-0.569,2.444
                           c-0.408,0.449-0.53,0.897-0.285,1.346c0.203,0.327,0.447,1.672,0.528,2.935c0.123,1.265,0.449,2.731,0.774,3.22
                           c0.325,0.53,0.732,1.752,0.854,2.731c0.122,0.978,0.611,2.282,1.062,2.854c1.508,1.916,2.894,5.178,2.894,6.89
                           c0,1.305,0.244,1.875,1.224,2.813c2.73,2.527,3.548,5.135,4.077,13.369c0.203,3.098,0.61,5.869,1.183,7.541
                           c0.447,1.47,0.854,2.979,0.854,3.345c0,0.692,1.915,1.954,2.936,1.954c1.225-0.038,1.591-0.649,1.144-1.834
                           c-0.366-0.896-0.285-1.262,0.244-1.875c0.407-0.445,0.854-0.771,1.102-0.771c0.203,0,1.55-0.57,2.978-1.266
                           c2.771-1.385,3.832-2.729,3.832-4.891c0-0.815,0.325-1.346,1.142-1.834c0.61-0.408,1.874-1.55,2.854-2.569
                           c1.55-1.63,1.713-1.957,1.346-2.771c-0.61-1.304-0.569-3.179,0.082-3.709c0.244-0.204,1.264-0.529,2.2-0.693
                           c1.346-0.203,1.834-0.122,2.321,0.489c0.367,0.408,1.307,1.509,2.119,2.446l1.469,1.712l1.551-1.02
                           c0.896-0.57,1.507-1.264,1.386-1.59c-0.325-0.814,2.16-2.65,3.67-2.65c1.59,0,2.282-0.61,2.282-2.037
                           c0-0.612,0.121-1.224,0.284-1.387c0.202-0.162,0.487-1.062,0.731-1.997c0.327-1.304,0.773-1.957,2.079-2.813
                           c1.429-0.979,1.631-1.263,1.467-2.324c-0.161-1.059-0.364-1.263-1.67-1.467c-0.813-0.122-2.038-0.407-2.729-0.611
                           c-0.692-0.244-1.59-0.326-1.916-0.163c-0.366,0.124-1.346-0.122-2.2-0.569c-0.856-0.489-2.526-1.062-3.71-1.306
                           c-1.141-0.286-2.242-0.651-2.362-0.855c-0.123-0.203-0.53-0.366-0.938-0.366c-0.774,0-2.486-1.631-2.486-2.365
                           c0-0.326-0.733-0.489-1.998-0.489c-1.671,0-2.077-0.164-2.646-1.02c-0.406-0.57-0.611-1.386-0.447-1.793
                           c0.121-0.367,0.041-1.712-0.205-2.936c-0.406-2.16,0-4.442,0.816-4.442c0.202,0,0.324-0.815,0.282-1.834
                           c-0.08-1.671-0.162-1.834-1.143-1.834c-0.772,0-1.182-0.326-1.711-1.427c-0.367-0.815-0.692-1.875-0.692-2.406
                           c0-1.344-0.772-3.464-1.958-5.217c-0.73-1.143-0.896-1.795-0.689-2.772c0.325-1.426,0.161-1.345,4.238-1.997
                           c3.262-0.488,4.196-0.978,3.83-1.915c-0.123-0.327,0.081-0.938,0.448-1.346c0.611-0.693,0.529-0.774-1.468-1.63
                           c-1.184-0.53-2.691-1.224-3.383-1.549c-2.08-1.102-3.996-2.079-6.073-3.058c-1.062-0.53-2.243-1.345-2.569-1.834
                           c-0.365-0.528-1.508-1.589-2.646-2.403c-1.102-0.815-2.363-2.161-2.813-2.977c-1.426-2.65-3.464-5.136-4.646-5.707
                           c-1.104-0.53-1.227-0.488-2.202,0.653c-0.57,0.651-1.264,1.549-1.549,1.997c-0.488,0.733-0.529,0.733-1.427-0.326
                           c-0.938-1.102-1.632-2.404-2.896-5.34c-0.365-0.814-1.426-2.323-2.322-3.303c-0.896-0.977-1.63-1.956-1.63-2.16
                           c0-0.244-0.285-0.651-0.61-0.938c-0.326-0.285-0.979-1.549-1.47-2.854c-1.101-3.018-3.505-5.381-6.193-6.114
                           c-1.063-0.285-2.729-1.02-3.669-1.63l-1.754-1.102L312.656,196.055z" />
              <path class="territory" id="Shahjahanpur" d="M230.848,198.338c-0.488,1.182-0.61,2.935-0.529,8.273c0.081,7.541-0.364,9.621-2.443,11.373
                           c-1.549,1.346-3.873,1.265-4.771-0.122c-0.407-0.57-1.427-1.386-2.282-1.834c-1.753-0.896-2.362-2.038-2.362-4.482
                           c0-0.856-0.163-1.59-0.327-1.59c-0.488,0-2.119,1.794-2.119,2.363c0,0.733-1.712,1.712-3.058,1.712
                           c-1.429,0-2.242-0.611-2.242-1.671c0-0.407-0.449-1.223-0.979-1.876l-0.978-1.141l-0.57,1.427c-0.326,0.774-1.101,1.997-1.672,2.69
                           c-0.652,0.733-1.1,1.793-1.1,2.445c0,2.242-0.896,4.28-2.609,6.114c-2.038,2.08-6.033,4.647-7.337,4.647
                           c-1.222,0-1.875,0.733-1.875,2.079c0,0.61-0.204,1.264-0.407,1.386c-0.813,0.489-2.161,3.669-2.08,4.892
                           c0.042,0.652,0.408,1.59,0.815,2.038c1.101,1.264,1.752,3.22,1.427,4.443c-0.244,1.019-2.446,3.098-3.261,3.098
                           c-0.57,0-5.869,2.282-6.236,2.69c-0.204,0.203-0.449,2.161-0.61,4.32l-0.243,3.994h1.467c1.467,0,2.647,0.693,5.055,2.895
                           c1.021,0.938,1.671,1.101,4.972,1.346l3.832,0.285l1.552-1.264c0.937-0.693,2.078-1.224,2.729-1.224
                           c1.834,0,2.405,1.264,2.405,5.381c0,4.321,0.326,5.258,2.242,6.4l1.467,0.855l0.612-1.427c0.73-1.794,0.73-2.323-0.204-5.625
                           c-0.449-1.672-1.186-3.261-1.834-3.914c-1.672-1.711-1.267-3.057,0.978-3.383c0.611-0.081,1.225-0.57,1.549-1.263
                           c0.448-0.938,0.774-1.102,2.323-1.102s1.875,0.163,2.404,1.102c0.408,0.814,1.223,1.385,2.647,1.875l2.12,0.733l3.142-2.935
                           l3.098-2.894l3.506,0.244l3.506,0.284l2.16-1.752l2.161-1.753l-0.204-2.242c-0.122-1.223-0.407-3.18-0.692-4.279
                           c-1.549-6.481-1.549-6.359-0.813-6.727c0.326-0.163,1.507-0.774,2.646-1.345c1.755-0.896,2.08-1.305,2.731-3.139
                           c0.938-2.771,1.142-2.976,5.014-5.502c1.793-1.184,3.709-2.609,4.239-3.18l0.938-1.061l-0.856-1.385
                           c-0.448-0.774-0.856-1.877-0.856-2.487c0-1.263,1.875-3.261,2.772-2.895c0.938,0.367,2.527-0.243,3.016-1.183
                           c0.286-0.488,0.489-2.854,0.531-5.543c0.081-4.483,0.041-4.729-0.979-5.829c-1.104-1.223-3.791-2.16-4.688-1.63
                           c-0.286,0.162-1.06,0.937-1.671,1.63c-0.815,1.019-1.427,1.345-2.446,1.345c-1.019,0-1.63-0.326-2.524-1.345
                           c-1.063-1.183-1.389-1.305-3.75-1.386c-1.47-0.082-2.813-0.286-3.06-0.53c-0.204-0.204-0.854-0.407-1.387-0.407
                           c-0.57,0-1.467-0.529-2.16-1.264l-1.182-1.262L230.848,198.338z" />
              <path class="territory" id="Aligarh" d="M63.156,214.521c-1.224,0.448-2.648,0.733-3.14,0.611c-0.896-0.163-0.937-0.082-0.689,1.753
                           c0.243,1.793,0.161,1.998-0.856,2.689c-1.019,0.653-1.183,0.653-2.364,0.082c-0.732-0.366-1.631-0.773-2.038-0.896
                           c-0.447-0.122-0.854-0.611-0.979-1.061c-0.245-0.979-0.448-0.979-2.568-0.162c-1.345,0.53-1.875,0.57-2.688,0.203
                           c-0.57-0.244-1.997-0.448-3.14-0.448c-1.184,0-2.363-0.204-2.607-0.448c-0.571-0.57-2.283,0.489-2.896,1.915
                           c-0.285,0.571-0.486,1.101-0.486,1.183c0,0.081,0.938,1.061,2.077,2.201c1.916,1.875,2.038,2.119,1.755,3.383
                           c-0.408,1.753-0.285,3.547,0.283,4.239c0.407,0.489,0.773,0.408,2.363-0.489c1.021-0.61,2.405-1.55,3.017-2.079
                           c1.511-1.223,1.916-1.182,3.75,0.285c1.183,0.938,1.957,1.224,3.263,1.224c1.385,0,1.875,0.203,2.402,1.02
                           c0.366,0.53,0.652,1.264,0.652,1.59c0,0.326,0.611,1.507,1.346,2.608c2.485,3.914,3.75,5.993,4.483,7.418l0.775,1.468l-1.47,2.488
                           c-2.24,3.791-1.916,5.869,1.021,7.011c1.183,0.448,1.916,2.649,1.142,3.546c-0.608,0.734,0.367,2.649,1.711,3.302
                           c1.43,0.693,4.158-0.244,7.42-2.444c1.998-1.346,2.322-1.753,2.119-2.487c-0.487-1.549-0.69-5.014-0.366-5.665
                           c0.204-0.326,1.674-1.753,3.222-3.139c2.648-2.364,2.935-2.486,4.278-2.242c0.773,0.163,2.038,0.326,2.813,0.367
                           c1.468,0.122,2.854,1.467,2.896,2.894c0,0.448,1.103,1.998,2.403,3.465l2.365,2.609l0.732-1.183c1.51-2.405,2.323-3.059,3.831-3.059
                           c2.364,0,3.059-0.367,3.792-1.956c0.365-0.815,1.143-2.568,1.711-3.833c0.57-1.263,1.063-2.485,1.063-2.73
                           c0-0.652,2.079-2.079,3.016-2.079c1.063,0,3.183,2.119,3.873,3.873c0.245,0.651,1.021,1.875,1.673,2.648l1.183,1.428l1.63-1.63
                           c1.834-1.754,2.161-3.384,1.062-4.853c-0.896-1.181-0.405-2.241,2.16-4.482c2.282-2.079,3.344-3.913,3.344-5.788
                           c0-0.611,0.364-1.672,0.813-2.405l0.815-1.345l-1.43-0.857c-0.813-0.488-2.08-0.854-2.854-0.854c-1.712,0-3.221-0.652-5.218-2.201
                           l-1.509-1.183l-0.938,0.855c-0.693,0.653-1.468,0.896-2.854,0.896c-2.362,0-3.75-0.814-4.769-2.894
                           c-0.979-1.834-1.468-2.08-3.019-1.265c-0.65,0.325-2.606,0.774-4.278,0.979c-2.568,0.286-3.301,0.57-4.32,1.548
                           c-0.653,0.612-1.916,1.59-2.771,2.161c-1.916,1.304-2.979,1.02-3.914-0.978c-0.489-0.979-1.388-1.794-3.385-2.854
                           c-2.565-1.386-2.771-1.468-3.343-0.815c-0.365,0.408-0.649,1.183-0.649,1.753c0,1.304-0.612,1.793-2.569,2.078
                           c-2.079,0.326-2.607,0.042-3.546-1.752c-0.53-1.021-1.549-1.998-2.936-2.813c-1.184-0.692-2.771-1.752-3.548-2.282
                           C65.682,213.461,66.009,213.461,63.156,214.521z" />
              <path class="territory" id="Etah"
                d="M126.336,226.423c0,0.285-0.285,0.773-0.611,1.06c-0.327,0.285-0.61,0.896-0.61,1.387
                           c0,2.241-0.979,4.116-3.342,6.521c-2.08,2.079-2.403,2.567-1.998,3.179c0.244,0.408,0.447,1.55,0.447,2.568
                           c0,1.671-0.203,2.079-1.916,3.913l-1.956,2.08l1.144,0.977c0.896,0.735,1.63,0.979,3.18,0.979c1.304,0,2.729,0.367,4.116,1.019
                           c1.142,0.571,2.485,1.021,2.935,1.021c1.021,0,3.465,1.426,3.75,2.201c0.122,0.284,1.427,1.875,2.938,3.506
                           c2.159,2.322,3.342,3.22,5.625,4.279c1.589,0.733,3.139,1.671,3.465,2.078c0.691,0.938,4.156,2.201,5.218,1.916
                           c0.57-0.163,0.813-0.733,0.979-2.445c0.245-2.404,1.266-3.954,3.1-4.646c1.06-0.449,2.894,0.447,2.894,1.426
                           c0,0.611,3.628,3.18,5.869,4.076c0.856,0.367,2.323,0.652,3.222,0.652c1.833,0,4.359-0.775,4.359-1.345
                           c0-0.204-1.182-1.59-2.647-3.099c-2.038-2.119-2.649-3.016-2.649-3.954c0-1.753,0.449-2.161,3.302-3.22l2.608-0.938l-0.041-1.916
                           c-0.041-1.672-0.286-2.161-1.712-3.587c-1.875-1.877-2.938-2.12-10.231-2.528c-2.241-0.163-4.44-0.529-5.217-0.896
                           c-1.223-0.569-3.139-2.607-6.646-7.011c-0.854-1.1-1.469-1.385-3.668-1.752c-1.469-0.204-2.813-0.57-3.058-0.774
                           c-0.204-0.203-0.651-0.366-1.019-0.366c-1.429,0-5.992-2.649-8.233-4.771C127.685,225.893,126.336,225.281,126.336,226.423z" />
              <path class="territory" id="Mathura" d="M49.296,228.258c0,0.488-3.018,2.525-4.771,3.261c-1.184,0.489-1.468,0.448-2.363-0.123
                           c-2.079-1.385-4.198,0.286-3.385,2.691c0.325,0.896,0.204,1.345-0.529,2.323c-1.183,1.631-2.526,1.631-3.668,0.04l-0.938-1.223
                           l-1.223,0.979c-1.712,1.264-5.054,2.934-6.686,3.301c-0.732,0.163-1.63,0.733-1.998,1.264c-0.609,0.979-0.609,1.061,0.448,2.12
                           c1.266,1.386,1.386,3.302,0.326,5.421c-0.408,0.815-0.652,1.672-0.57,1.916c0.082,0.246,0.979,0.857,1.957,1.386
                           c2.445,1.224,2.854,1.712,2.282,2.977c-0.327,0.692-0.813,1.019-1.508,1.019c-1.223,0-1.345,0.815-0.204,1.834l0.856,0.774
                           l-1.104,0.855c-1.507,1.184-1.141,2.079,2.487,5.87c3.546,3.75,3.954,4.442,3.627,6.44c-0.204,1.427-0.081,1.671,1.55,3.22
                           c1.182,1.182,2.283,1.793,3.384,1.998c1.548,0.244,4.278,2.283,4.278,3.179c0,0.53,1.753,1.875,2.487,1.916
                           c0.324,0,0.979-0.284,1.426-0.61c0.408-0.326,1.102-0.611,1.469-0.611c0.57,0,0.611,0.204,0.325,1.223
                           c-0.203,0.693-0.692,1.671-1.143,2.242c-1.183,1.509-1.834,4.28-1.347,5.625c0.407,1.02,0.53,1.061,1.347,0.611
                           c0.487-0.285,1.265-0.938,1.673-1.427c0.691-0.856,1.06-0.938,4.563-0.856c3.506,0.082,3.872,0,5.381-1.019
                           c1.916-1.305,3.952-1.794,4.812-1.102c0.487,0.408,0.732,0.244,1.468-0.979c0.53-0.896,1.183-1.468,1.63-1.468
                           c1.346,0,3.018,1.102,3.548,2.283c0.609,1.266,0.773,1.184,1.304-0.61c0.286-0.979,0.204-1.346-0.324-1.753
                           c-1.021-0.773-2.12-2.607-2.12-3.547c0-0.447,0.49-1.385,1.061-2.078c0.938-1.061,1.063-1.55,0.855-3.098
                           c-0.082-1.019-0.489-2.161-0.855-2.568c-0.407-0.448-0.65-1.468-0.65-2.854c0-1.141-0.286-2.69-0.653-3.383
                           c-0.569-1.102-0.61-1.549-0.204-2.649c0.531-1.426,0.327-2.16-0.529-2.16c-1.792,0-4.033-3.912-3.18-5.585
                           c0.489-0.977,0.163-1.752-0.732-1.752c-0.406,0-1.224-0.57-1.834-1.305c-1.02-1.181-1.102-1.549-0.896-3.587
                           c0.122-1.631,0.53-2.813,1.426-4.076c1.104-1.59,1.186-1.916,0.652-2.486c-0.326-0.326-0.57-0.814-0.57-1.061
                           c0-0.448-1.712-3.179-3.954-6.439c-0.609-0.896-1.223-2.201-1.345-2.854c-0.204-1.141-0.367-1.222-2.364-1.508
                           c-1.55-0.163-2.525-0.57-3.303-1.304C49.826,227.849,49.296,227.646,49.296,228.258z" />
              <path class="territory" id="Shravasti" d="M364.465,234.533c-0.204,0.245-0.53,0.896-0.651,1.387c-0.407,1.345-1.997,2.161-5.341,2.689
                           c-1.672,0.246-3.057,0.653-3.057,0.896c0,0.245,0.486,1.101,1.06,1.957c0.571,0.855,1.264,2.69,1.59,4.158
                           c0.611,3.097,0.815,3.464,1.794,3.464c1.182,0,1.752,1.019,1.916,3.302c0.12,1.55-0.041,2.324-0.652,3.139
                           c-0.65,0.938-0.732,1.387-0.365,3.14c0.204,1.101,0.324,2.485,0.283,3.058c-0.119,0.937,0,1.019,2.079,1.223
                           c1.957,0.163,2.324,0.367,2.896,1.427c0.367,0.651,1.021,1.305,1.467,1.386c0.408,0.041,1.063,0.366,1.388,0.651
                           c0.326,0.285,1.429,0.651,2.446,0.814c1.019,0.163,2.281,0.571,2.854,0.938c0.528,0.325,1.631,0.652,2.443,0.732
                           c1.672,0.082,6.399,1.143,6.769,1.508c0.122,0.122,0.407,0.979,0.61,1.916c0.446,1.916,0.081,2.854-1.427,3.669
                           c-0.815,0.407-0.938,0.651-0.61,1.101c0.69,0.773,1.752,0.651,2.647-0.326c0.57-0.653,1.101-0.813,2.078-0.653
                           c1.835,0.326,2.729-0.733,2.12-2.487c-0.244-0.692-0.692-1.345-1.021-1.468c-0.365-0.163-0.567-0.814-0.567-2.038
                           c0-1.589,0.161-1.956,1.549-3.016c1.387-1.143,1.428-1.264,0.69-1.508c-2.159-0.734-5.136-2.446-5.666-3.263
                           c-0.527-0.773-0.406-1.019,2.038-3.464c1.389-1.467,3.345-3.383,4.32-4.279c2.037-1.875,3.099-4.524,2.363-5.91
                           c-0.529-1.02,0.246-2.324,2.282-3.872c1.672-1.265,1.754-2.121,0.325-2.65c-0.568-0.244-1.834-1.062-2.771-1.834
                           c-0.979-0.773-1.916-1.426-2.078-1.426c-0.328,0-1.794-0.897-4.729-2.894c-0.569-0.367-1.875-0.815-2.854-0.938
                           c-1.591-0.204-2.039-0.081-4.037,1.305c-1.182,0.814-2.813,2.323-3.586,3.343c-0.771,1.019-1.55,1.875-1.714,1.955
                           c-0.161,0.082-1.181-1.141-2.2-2.729c-1.426-2.119-2.2-2.894-3.098-3.098c-0.651-0.122-1.631-0.611-2.161-1.061
                           C365.116,234.208,364.791,234.127,364.465,234.533z" />
              <path class="territory" id="Hathras" d="M107.423,240.199c-0.366,0.489-0.652,1.224-0.652,1.59s-0.244,0.896-0.526,1.143
                           c-0.327,0.244-0.775,1.181-1.063,2.119c-1.142,3.832-2.16,4.729-5.421,4.811c-1.305,0.041-1.712,0.285-2.813,1.752
                           c-1.467,2.038-2.117,2.486-3.18,2.16c-1.263-0.406-5.666-5.625-5.828-6.929c-0.123-1.06-0.367-1.223-2.362-1.671
                           c-1.226-0.285-2.364-0.53-2.487-0.57c-0.123,0-1.385,1.102-2.771,2.405c-2.813,2.649-2.813,2.649-1.834,7.296
                           c0.204,1.101,0.082,1.549-0.691,2.364c-0.488,0.53-1.102,0.979-1.266,0.979c-0.203,0-1.183,0.53-2.12,1.183
                           c-0.978,0.692-2.24,1.345-2.854,1.507c-0.855,0.204-1.345,0.734-1.916,2.08c-0.692,1.631-0.692,1.916-0.163,2.976
                           c0.326,0.651,0.611,1.997,0.611,2.936c0,0.977,0.366,2.485,0.813,3.383c1.183,2.283,1.062,4.892-0.204,6.563
                           c-0.855,1.101-0.979,1.549-0.651,2.16c0.449,0.774,0.487,0.774,2.485-0.203c2.364-1.143,3.181-1.223,3.507-0.367
                           c0.161,0.326,0.854,0.896,1.59,1.264c1.181,0.531,1.548,0.57,2.525,0.082c0.61-0.285,1.469-1.224,1.875-2.079
                           c0.773-1.672,1.265-1.834,2.607-0.896c0.813,0.57,1.061,0.57,2.647-0.041c2.323-0.896,4.117-2.568,3.548-3.261
                           c-0.285-0.367-0.244-0.773,0.202-1.468c0.489-0.773,0.531-1.263,0.163-2.607c-0.528-1.876-0.243-3.017,0.651-3.017
                           c0.327,0,1.957-1.02,3.587-2.242c1.632-1.223,3.627-2.405,4.442-2.649c0.772-0.203,2.202-1.06,3.18-1.916
                           c1.469-1.223,1.875-1.386,2.487-1.019c1.344,0.815,6.766-1.385,9.497-3.954c0.65-0.57,1.426-1.671,1.711-2.365
                           c0.813-1.875,0.204-3.342-2.854-7.051c-1.346-1.671-2.647-3.424-2.813-3.872c-0.489-1.386-2.038-3.465-2.568-3.465
                           C108.28,239.304,107.748,239.711,107.423,240.199z" />
              <path class="territory" id="Sitapur" d="M304.179,240.158c-0.246,0.245-1.59,1.02-3.02,1.754c-1.753,0.896-2.936,1.834-3.625,2.853l-0.979,1.549
                           l-2.485-0.245c-1.347-0.122-3.547-0.325-4.893-0.407c-1.345-0.04-2.771-0.162-3.138-0.203c-0.367,0-1.226-0.489-1.916-1.061
                           c-1.47-1.264-2.487-1.101-4.647,0.734c-1.385,1.141-1.589,1.59-1.793,3.627c-0.163,1.509-0.448,2.404-0.854,2.568
                           c-1.226,0.447-3.305-0.326-5.017-1.875c-1.956-1.794-2.199-1.794-5.461,0.041c-1.101,0.61-2.771,1.345-3.669,1.631
                           c-0.896,0.284-2.038,0.896-2.566,1.344c-0.651,0.611-1.508,0.896-2.689,0.896c-2.283,0-2.771,0.489-3.669,3.425
                           c-0.652,2.2-0.652,2.486-0.081,3.628c0.367,0.691,0.653,1.956,0.653,2.812s0.364,2.528,0.731,3.75
                           c0.651,1.875,1.062,2.365,2.978,3.668c1.304,0.856,2.729,2.283,3.505,3.506c0.691,1.102,1.753,2.486,2.322,3.058
                           c0.569,0.569,1.062,1.263,1.062,1.467c0,0.245,0.692,1.916,1.507,3.668c0.815,1.753,1.551,3.914,1.59,4.769
                           c0.122,1.916,0.367,2.201,1.266,1.428c0.896-0.774,3.18-1.957,3.792-1.957c0.244,0,1.426,0.896,2.566,1.998
                           c2.607,2.485,3.669,2.894,7.053,2.894c3.912,0,6.112,0.693,7.297,2.242c0.569,0.693,1.02,1.426,1.02,1.59
                           c0,0.733,2.608,6.767,2.938,6.767c0.201,0,1.263-0.447,2.362-1.019c2.404-1.226,3.262-2.69,3.18-5.302
                           c-0.081-1.67,0.082-2.079,1.021-2.894c0.772-0.652,1.63-0.979,2.647-0.938c1.672,0,4.852,0.53,5.788,0.938
                           c0.407,0.162,0.938-0.245,1.63-1.265c1.145-1.712,4.199-3.791,5.546-3.791c0.488,0,2.077,0.612,3.587,1.345
                           c2.484,1.266,2.729,1.306,3.303,0.693c0.366-0.408,0.61-1.467,0.61-2.528c0-1.589,0.202-2.079,1.508-3.301
                           c3.221-3.139,5.503-3.017,6.768,0.326c1.713,4.523,2.445,5.258,2.896,2.771c0.162-0.855,0.73-2.242,1.305-3.098l1.019-1.548
                           l-1.467-1.672c-1.144-1.346-1.428-2.039-1.428-3.384c0-1.631-1.021-4.157-2.2-5.463c-0.896-1.021-1.875-3.506-1.875-4.85
                           c0-0.653-0.326-1.468-0.733-1.834c-0.528-0.489-0.731-1.345-0.772-3.099c-0.122-3.709-1.672-6.358-4.035-6.808
                           c-0.732-0.123-1.631-0.569-1.997-0.978c-0.651-0.734-0.61-0.897,0.569-2.65c0.692-1.019,1.266-1.998,1.266-2.16
                           c-0.081-0.773-3.1-2.12-5.381-2.364c-1.427-0.123-3.384-0.652-4.401-1.143c-1.02-0.488-2.977-1.223-4.36-1.63
                           c-1.509-0.489-2.607-1.06-2.729-1.427c-0.123-0.366-0.284-1.264-0.448-1.997c-0.243-1.102-0.447-1.304-1.387-1.304
                           C305.115,239.711,304.424,239.915,304.179,240.158z" />
              <path class="territory" id="Balrampur" d="M397.808,243.746c0,0.407-0.61,1.264-1.305,1.834c-0.732,0.61-1.592,1.264-1.875,1.507
                           c-0.326,0.286-0.449,0.856-0.326,1.469c0.609,2.282-1.589,6.766-4.077,8.314c-0.731,0.448-2.118,1.712-3.057,2.854
                           c-1.632,1.957-1.673,2.079-0.938,2.608c0.448,0.326,1.673,0.896,2.731,1.264c2.402,0.815,3.179,2.08,2.198,3.588
                           c-0.363,0.529-1.061,1.1-1.508,1.263c-0.896,0.286-1.183,2.365-0.408,2.854c0.408,0.245,1.633,2.854,1.633,3.465
                           c0,0.163-0.448,0.938-0.979,1.711c-0.938,1.427-0.938,1.467-0.203,2.12c0.448,0.366,0.772,0.896,0.772,1.223
                           c0,0.327,0.65,1.386,1.47,2.323c1.468,1.753,3.22,2.813,4.646,2.813c0.406,0,0.938,0.285,1.223,0.61
                           c0.285,0.326,0.854,0.612,1.265,0.612c0.813,0,1.793,1.793,1.347,2.486c-0.122,0.245-0.284,2.69-0.366,5.462
                           c-0.123,4.565-0.041,5.095,0.609,5.298c0.408,0.123,2.161,1.51,3.913,3.059c1.794,1.551,3.385,2.854,3.547,2.854
                           c0.163,0,0.856,0.407,1.55,0.896l1.265,0.938l1.387-1.51c0.773-0.855,1.387-1.874,1.387-2.282s0.448-1.631,0.979-2.771
                           c0.529-1.102,1.183-2.688,1.428-3.545c0.813-2.487,1.834-2.895,6.275-2.528l3.751,0.286l-1.103-1.182
                           c-0.938-0.978-1.143-1.549-1.143-3.22c0-1.916-0.123-2.12-1.875-3.588c-1.671-1.428-1.834-1.71-1.632-2.854
                           c0.572-2.813,2.406-6.644,4.036-8.273c2.119-2.201,2.937-2.486,4.115-1.386c1.591,1.468,8.604,2.283,9.579,1.101
                           c0.285-0.326,1.143-0.692,1.916-0.856l1.428-0.244l-1.225-1.386c-1.793-2.038-2.038-3.913-0.73-5.87l1.019-1.549l-0.979-2.813
                           c-0.528-1.55-1.184-3.181-1.386-3.628c-0.651-1.467-0.938-2.813-1.021-4.605c-0.041-0.938-0.162-1.794-0.244-1.916
                           c-0.122-0.082-1.021,0.041-1.996,0.244c-1.021,0.246-2.566,0.327-3.467,0.204c-1.1-0.122-2.159,0.042-3.261,0.57
                           c-1.063,0.489-3.425,0.896-6.851,1.183c-6.112,0.529-6.479,0.407-9.82-2.978c-3.468-3.505-10.068-8.151-12.188-8.56
                           C398.012,242.972,397.808,243.013,397.808,243.746z" />
              <path class="territory" id="Hardoi"
                d="M236.189,251.165c-2.936,2.444-3.221,2.526-6.604,2.2c-3.506-0.325-3.995-0.082-7.255,3.344
                           c-1.185,1.223-2.446,2.16-2.896,2.16c-1.549,0-5.666-1.916-6.072-2.813c-0.529-1.182-1.306-1.06-2.525,0.367
                           c-0.53,0.651-1.347,1.222-1.793,1.222c-0.734,0-0.734,0.082,0.204,1.509c0.528,0.856,1.304,2.977,1.712,4.688
                           c0.65,2.935,0.65,3.302,0.041,5.503c-0.367,1.304-0.734,3.342-0.856,4.523c-0.122,1.184-0.488,2.527-0.854,3.018
                           c-0.897,1.304-0.775,2.935,0.364,4.604c1.47,2.12,1.714,4.321,0.732,6.44c-1.304,2.813-1.304,2.935,0,4.525
                           c0.815,1.019,1.55,1.467,2.283,1.467c0.609,0,2.364,0.651,3.873,1.426c1.548,0.734,3.79,1.59,5.013,1.875
                           c1.834,0.408,2.446,0.815,3.791,2.405c0.896,1.06,1.753,2.444,1.916,3.099c0.326,1.426,3.668,8.151,4.198,8.479
                           c0.204,0.123,0.487,0.854,0.61,1.591c0.122,0.73,0.773,1.875,1.428,2.485c1.183,1.101,1.223,1.142,2.565,0.487
                           c1.754-0.896,2.938-1.875,3.547-3.058c0.692-1.264,2.241-0.854,3.953,1.101c1.266,1.47,1.266,1.47,2.324,0.774
                           c0.611-0.367,1.182-1.224,1.346-1.834c0.122-0.61,0.285-1.305,0.366-1.591c0.245-0.813,2.119-1.834,3.75-2.037
                           c1.347-0.163,1.712-0.041,2.813,1.184c0.69,0.731,1.59,2.159,1.957,3.178c0.406,0.979,1.304,2.488,1.998,3.304
                           c0.731,0.815,1.63,1.998,2.036,2.567c0.406,0.568,0.896,1.062,1.144,1.062c0.69,0,3.26-2.978,3.994-4.688
                           c0.938-2.119,1.304-2.36,4.729-3.545c2.283-0.813,3.384-1.509,5.38-3.466c2.813-2.729,4.771-3.505,7.744-3.097
                           c1.469,0.202,1.916,0.039,3.183-0.979c1.264-1.063,1.712-1.226,3.302-1.021c1.427,0.163,1.834,0.041,2.038-0.489
                           c0.204-0.569-1.55-5.991-2.649-7.989c-0.65-1.263-3.017-2.038-6.277-2.038c-3.829,0-5.339-0.571-7.946-3.017l-1.997-1.875
                           l-1.508,1.019c-3.101,2.079-4.771,1.59-4.935-1.467c-0.042-0.979-0.65-3.057-1.346-4.607c-0.733-1.548-1.304-2.934-1.304-3.097
                           c0-0.204-0.652-1.101-1.428-2.039c-0.774-0.938-1.428-1.875-1.428-2.079c0-0.692-3.26-3.954-4.48-4.442
                           c-1.916-0.815-3.019-3.14-3.669-7.745c-0.162-1.224-0.53-2.813-0.855-3.546c-0.448-1.102-0.408-1.589,0.245-3.587l0.814-2.283
                           l-1.021-0.774c-0.571-0.408-1.834-0.979-2.854-1.264c-1.02-0.245-2.443-0.775-3.181-1.102c-1.1-0.488-1.671-0.528-2.854-0.162
                           c-1.348,0.407-1.632,0.366-2.938-0.529c-0.813-0.571-1.549-1.021-1.672-1.021C238.307,249.494,237.288,250.227,236.189,251.165z" />
              <path class="territory" id="Kanshiram Nagar" d="M118.795,251.654c0.285,1.102-0.735,3.791-1.958,5.137c-2.323,2.525-9.13,5.707-11.005,5.095
                           c-0.408-0.124-1.306,0.244-2.242,0.938c-0.814,0.652-2.161,1.386-2.978,1.632c-0.813,0.202-2.936,1.508-4.77,2.812
                           c-2.73,1.998-3.26,2.528-3.016,3.22c0.163,0.448,0.242,1.591,0.203,2.528c-0.04,1.059,0.08,1.752,0.365,1.752
                           c0.244,0,0.773,0.285,1.184,0.652c0.528,0.448,1.916,0.652,5.707,0.774c6.357,0.204,9.09,0.652,11.332,1.752l1.754,0.854
                           l-0.286-0.896c-0.489-1.386-0.326-3.994,0.286-4.524c0.285-0.285,1.548-0.815,2.771-1.224c1.226-0.447,2.608-1.1,3.101-1.507
                           c0.446-0.448,1.019-0.774,1.222-0.774c0.204,0,0.571-0.326,0.854-0.774c0.611-0.978,2.486-1.345,4.36-0.815
                           c2.08,0.571,2.487,1.591,1.55,3.711l-0.732,1.752l1.223,1.631c0.693,0.938,1.834,2.038,2.486,2.444
                           c0.691,0.449,1.468,1.387,1.753,2.038c0.979,2.12,2.12,2.69,4.646,2.242c2.567-0.489,3.222-1.223,3.791-4.442
                           c0.365-1.997,0.61-2.404,2.445-3.913c1.143-0.896,2.813-1.915,3.792-2.201c1.588-0.529,1.875-0.529,3.058,0.163
                           c0.732,0.408,1.631,1.101,1.997,1.59c0.488,0.57,1.185,0.856,2.445,0.896c0.979,0.042,3.75,0.204,6.155,0.367
                           c3.873,0.285,4.441,0.448,4.85,1.183c0.246,0.488,1.47,1.997,2.691,3.383c1.67,1.957,2.524,2.607,3.668,2.812
                           c1.223,0.245,1.589,0.123,2.241-0.691l0.771-0.979l-1.426-1.223c-1.143-0.979-1.467-1.59-1.549-2.977
                           c-0.082-0.938,0.082-1.916,0.365-2.2c0.286-0.286,0.49-0.693,0.49-0.979c0-0.246,0.284-0.693,0.61-0.979s0.61-0.979,0.61-1.591
                           c-0.042-1.549-1.428-4.36-2.567-5.095c-0.855-0.611-1.144-0.611-2.729-0.041c-2.363,0.815-4.893,0.775-7.378-0.163
                           c-2.566-1.019-6.398-3.586-6.686-4.604c-0.692-2.161-3.059,0.488-3.059,3.423c0,1.917-0.042,2.039-1.508,2.607
                           c-1.387,0.611-1.672,0.571-3.75-0.122c-1.265-0.406-2.813-1.223-3.506-1.834c-0.692-0.569-2.242-1.508-3.466-2.078
                           c-1.711-0.733-3.261-2.038-6.398-5.3c-2.977-3.139-4.441-4.36-5.136-4.36c-0.53,0-1.916-0.448-3.059-1.02
                           c-1.306-0.61-2.813-1.02-3.953-1.02C118.713,250.717,118.591,250.799,118.795,251.654z" />
              <path class="territory" id="Farrukhabad" d="M167.302,254.181c-0.896,0.326-1.672,0.611-1.712,0.611c-0.082,0-0.123,0.367-0.123,0.814
                           c0,0.449,1.101,1.875,2.446,3.221c1.304,1.304,2.524,2.854,2.646,3.383c0.122,0.53,0.774,1.223,1.386,1.59
                           c1.51,0.896,3.304,4.525,3.304,6.726c0,0.979-0.163,1.834-0.367,1.998c-0.611,0.367-1.67,2.69-1.67,3.668
                           c0,0.53,0.448,1.224,1.02,1.59c1.508,0.978,1.957,2.118,1.467,3.506c-0.202,0.651-0.242,1.304-0.038,1.426
                           c0.201,0.123,0.73,1.427,1.222,2.894c0.979,2.936,2.813,5.341,4.321,5.707c0.528,0.123,1.304,0.897,1.793,1.672l0.854,1.428
                           l3.18-0.285c2.978-0.245,3.345-0.204,4.483,0.651c0.856,0.611,1.265,1.265,1.265,1.998c0,1.427,0.691,2.037,2.282,2.037
                           c0.693,0,2.079,0.287,3.06,0.652c2.322,0.814,3.952,0.49,5.827-1.182c1.307-1.101,1.592-1.631,1.755-3.303
                           c0.161-1.223,0.938-3.423,2.036-5.503c1.917-3.791,1.998-4.932,0.49-7.092c-0.449-0.611-0.938-1.956-1.142-2.975
                           c-0.326-1.673-0.245-2.08,0.609-3.344c0.569-0.774,0.979-1.997,0.979-2.771c0-1.224-0.204-1.468-2.08-2.405
                           c-2.688-1.386-3.219-2.65-3.219-7.542c0-4.28-0.489-4.932-2.406-3.097c-1.426,1.344-2.893,1.588-7.784,1.181
                           c-3.466-0.286-3.914-0.407-4.28-1.264c-0.202-0.489-0.772-1.02-1.224-1.142c-0.448-0.162-1.182-0.61-1.63-1.019
                           c-0.692-0.611-1.63-0.775-4.769-0.856c-3.345-0.122-4.118-0.244-5.179-1.06c-0.691-0.489-1.712-0.896-2.321-0.896
                           c-0.611,0-1.429-0.285-1.795-0.611C170.969,253.691,169.094,253.488,167.302,254.181z" />
              <path class="territory" id="Sidharth Nagar" d="M441.26,267.388c-1.062,1.468-1.102,1.753-0.65,3.058c0.245,0.813,0.65,1.468,0.855,1.468
                           c0.648,0,1.67,1.997,1.386,2.813c-0.123,0.448-0.896,1.019-1.755,1.303c-0.813,0.285-1.914,0.775-2.444,1.102
                           c-1.346,0.855-7.785,0.408-9.985-0.733l-1.59-0.814l-1.265,1.059c-0.854,0.693-1.752,2.202-2.649,4.403l-1.385,3.302l1.874,1.671
                           c1.753,1.508,1.876,1.794,1.876,3.587c0,1.631,0.245,2.242,1.264,3.383c1.143,1.306,1.184,1.509,0.651,2.283
                           c-0.569,0.856-0.896,0.896-4.81,0.774c-3.06-0.082-4.239,0-4.483,0.408c-0.61,0.896-0.407,1.1,1.386,1.345
                           c3.019,0.447,7.5,3.14,8.274,5.015c0.041,0.08,0.693-0.162,1.427-0.447c0.773-0.325,2.648-0.896,4.159-1.266
                           c2.566-0.61,3.015-0.61,5.5,0c3.221,0.814,3.385,0.938,4.853,3.832c0.651,1.265,1.592,2.444,2.16,2.729
                           c0.569,0.285,2.648,1.265,4.646,2.16l3.589,1.671l0.896-0.813c0.487-0.488,1.428-0.855,2.078-0.855c0.855,0,1.631-0.487,2.854-1.793
                           c2.037-2.2,5.298-4.482,7.418-5.176c2.646-0.856,3.384-1.551,3.384-3.059c0-0.775,0.243-2.446,0.569-3.751
                           c0.327-1.265,0.732-3.058,0.938-3.914c0.285-1.346,0.651-1.793,2.119-2.69c1.019-0.571,2.445-1.875,3.179-2.854
                           c4.159-5.625,4.444-6.768,2.69-10.19c-1.021-1.997-1.469-2.405-3.914-3.628c-2.566-1.303-3.097-1.385-7.338-1.548
                           c-2.484-0.082-5.42,0.081-6.479,0.326c-2.16,0.489-2.854,0.204-5.91-2.567c-1.916-1.712-2.362-1.793-9.01-1.549
                           c-3.016,0.082-3.505,0-4.318-0.774l-0.938-0.896L441.26,267.388z" />
              <path class="territory" id="Maharajganj"
                d="M490.459,269.346c0.731,3.709,0.772,6.154,0.082,7.173c-0.979,1.508-4.771,4.321-6.441,4.811
                           c-0.773,0.203-1.548,0.774-1.792,1.305c-1.103,2.323-5.462,7.582-6.93,8.273c-1.389,0.692-1.592,0.979-1.794,2.609
                           c-0.163,1.019-0.489,2.567-0.733,3.464s-0.448,2.283-0.448,3.099v1.469l3.384,0.938c3.344,0.938,4.975,1.916,5.424,3.346
                           c0.323,1.102,0.896,0.896,2.482-0.896c1.632-1.795,4.28-2.937,5.059-2.162c0.568,0.569-0.082,2.813-1.51,5.301
                           c-1.754,3.018-1.876,3.71-0.979,4.605c0.651,0.651,1.386,0.813,3.709,0.813h2.854l2.364,2.201c2.079,2.037,2.567,2.283,4.934,2.647
                           l2.648,0.449l1.834-1.793c2.854-2.771,4.116-3.265,8.314-3.304c3.261-0.041,3.71-0.163,4.36-0.979
                           c0.691-0.814,0.732-1.428,0.528-4.893l-0.285-3.913l2.526-5.869c1.998-4.646,2.445-6.114,2.242-7.175
                           c-0.162-1.019,0.043-1.834,0.979-3.505c0.692-1.223,1.632-3.668,2.119-5.462c0.814-3.098,0.814-3.261,0.123-3.791
                           c-1.713-1.304-4.24-2.526-7.664-3.791c-2.08-0.773-5.014-2.242-6.726-3.424l-3.06-2.12l-8.927-0.286l-8.928-0.325L490.459,269.346z" />
              <path class="territory" id="Firozabad" d="M123.484,269.793c-0.327,0.122-1.387,0.814-2.281,1.59c-0.938,0.732-2.813,1.752-4.158,2.2
                           c-2.568,0.856-3.301,1.794-2.486,3.261c0.693,1.346,0.449,2.813-0.65,3.302c-0.855,0.366-1.306,0.285-3.019-0.61
                           c-1.101-0.611-2.526-1.102-3.22-1.102c-0.692,0-1.753-0.204-2.405-0.449c-0.61-0.244-1.957-0.284-3.016-0.163
                           c-1.875,0.286-1.916,0.286-2.201,2.079c-0.286,1.958-1.184,2.854-3.261,3.262c-1.43,0.244-2.242,1.793-2.242,4.198
                           c0,0.733-0.286,2.364-0.653,3.586c-0.771,2.649-0.61,9.091,0.285,10.148c0.734,0.854,3.139,0.488,5.259-0.855
                           c2.364-1.508,3.423-1.671,4.483-0.61c0.938,0.938,0.854,2.485-0.203,3.668c-0.489,0.53-0.286,0.611,1.548,0.733
                           c2.487,0.122,2.731,0.285,3.913,2.813c0.489,1.059,1.265,2.607,1.672,3.383l0.774,1.429l3.099-0.123l3.057-0.081l0.815,1.305
                           c0.53,0.896,1.304,1.51,2.323,1.794c1.304,0.367,1.711,0.772,2.646,2.729c0.938,1.955,1.308,2.322,2.202,2.322
                           c0.57,0,1.589-0.367,2.242-0.854c1.223-0.855,2.688-0.896,5.992-0.082c0.896,0.205,0.978,0.123,0.813-1.307
                           c-0.122-1.428,0-1.631,1.875-2.895l1.956-1.386l-2.483-2.404c-2.405-2.282-2.487-2.446-2.487-4.403c0-2.198,0.813-3.342,2.895-4.154
                           c0.611-0.204,1.511-0.979,1.997-1.673l0.938-1.304l-1.916,0.285c-2.079,0.326-3.505-0.285-4.362-1.875
                           c-0.366-0.734-0.286-1.021,0.571-1.957c0.57-0.57,1.141-1.792,1.263-2.69c0.449-2.649-2.038-10.802-3.057-10.149
                           c-0.204,0.123-0.693-0.53-1.185-1.467c-0.446-0.897-1.264-1.917-1.753-2.243c-1.507-0.978-4.439-4.81-4.235-5.501
                           c0.122-0.326,0.486-1.306,0.854-2.12c0.571-1.346,0.571-1.509,0.041-1.305c-0.326,0.163-0.854,0.081-1.142-0.163
                           C124.339,269.753,123.809,269.671,123.484,269.793z" />
              <path class="territory" id="Mainpuri"
                d="M146.228,273.503c-3.342,1.671-3.914,2.323-4.239,4.81c-0.365,3.18-2.036,5.014-4.77,5.299l-1.957,0.244
                           l0.286,1.672c0.122,0.896,0.448,2.038,0.691,2.487c0.244,0.448,0.448,2.079,0.448,3.668c0,2.323-0.163,3.099-0.896,4.158
                           c-1.183,1.671-0.53,2.282,2.039,1.915c1.63-0.244,1.916-0.123,2.484,0.69c0.611,0.857,0.611,1.021-0.245,2.529
                           c-0.487,0.896-1.508,1.957-2.199,2.323c-2.16,1.142-2.568,1.63-2.568,3.097c0,1.021,0.285,1.631,1.101,2.324
                           c2.08,1.672,3.386,3.221,3.629,4.239c0.243,0.938,0.366,0.978,2.364,0.692c3.1-0.448,7.255-0.246,7.866,0.365
                           c0.285,0.284,0.611,0.938,0.733,1.426c0.447,2.324,1.712,2.283,4.811-0.162c3.221-2.485,5.625-3.18,10.068-2.854
                           c5.829,0.447,8.723,0.854,9.66,1.387c0.487,0.284,1.998,0.487,3.343,0.487c2.16,0,2.525-0.123,3.138-1.021
                           c0.326-0.529,0.53-1.184,0.408-1.387c-0.164-0.244,0.163-1.101,0.693-1.957c2.077-3.344,2.117-3.75,0.69-7.703
                           c-1.06-2.977-1.183-3.792-0.813-4.811c0.365-1.061,0.283-1.346-0.611-2.284c-0.57-0.57-1.019-1.263-1.019-1.548
                           c0-0.246-0.449-0.571-1.021-0.733c-1.59-0.407-3.71-3.221-4.892-6.481c-0.815-2.16-1.268-2.935-1.674-2.771
                           c-1.385,0.529-4.318-0.366-5.909-1.794c-0.855-0.773-1.591-1.712-1.591-1.997c0-0.325-0.161-0.569-0.405-0.569
                           c-0.204,0-0.815-0.612-1.306-1.387c-0.896-1.345-0.896-1.345-4.975-1.63c-2.281-0.163-5.014-0.365-6.113-0.407
                           c-1.51-0.081-2.16-0.284-2.771-1.06c-0.611-0.733-2.609-2.12-2.937-2.038C147.777,272.768,147.043,273.095,146.228,273.503z" />
              <path class="territory unsco mice" id="Agra" d="M91.24,277.742c-1.955,1.712-5.299,2.934-6.438,2.363c-1.062-0.569-1.264-0.569-1.264,0.082
                           c0,0.814-2.079,2.609-3.385,2.896c-1.265,0.284-3.71-0.367-4.852-1.306c-1.06-0.896-3.342,0.082-3.017,1.306
                           c0.121,0.447,0,1.63-0.245,2.607c-0.57,2.242-1.834,2.977-3.385,1.957c-0.569-0.366-1.021-0.937-1.021-1.263
                           c0-0.326-0.367-0.775-0.773-1.02c-1.061-0.529-1.142-0.529-1.386,0.366c-0.082,0.408-0.649,1.061-1.223,1.427
                           c-0.814,0.57-1.184,0.57-2.038,0.204c-1.063-0.488-1.103-0.448-4.403,1.427c-1.1,0.651-2.2,0.814-5.054,0.814l-3.668,0.04
                           l-0.204,2.65c-0.204,2.567-0.245,2.648-1.549,3.057c-1.144,0.326-1.347,0.612-1.589,1.956c-0.326,1.998-1.551,2.896-3.546,2.527
                           c-1.225-0.244-1.591-0.121-2.486,0.814c-1.305,1.428-1.305,1.834,0,1.834c1.061,0,4.28,2.566,4.28,3.425
                           c0,0.284,0.608,1.101,1.385,1.834l1.346,1.305l1.59-0.815c1.956-1.059,2.119-1.059,3.304,0.041l0.938,0.896l1.183-1.143l1.185-1.144
                           l1.344,1.267l1.388,1.265l-1.021,0.813c-0.571,0.447-1.182,0.814-1.345,0.814s-1.185,0.367-2.242,0.854
                           c-1.062,0.448-2.283,0.979-2.729,1.184c-0.447,0.205-1.631,0.447-2.647,0.529c-2.937,0.285-14.228,4.771-15.041,5.951
                           c-0.896,1.426-1.305,6.397-0.611,7.744c0.326,0.569,0.571,1.508,0.571,2.078c0,0.611,0.204,1.264,0.49,1.549
                           c1.303,1.305,2.24-0.039,2.812-3.953c0.204-1.346,0.653-2.525,1.143-3.059l0.855-0.814L38.826,324
                           c1.875,1.793,7.459,0.57,12.104-2.566c4.933-3.385,6.073-3.588,16.671-3.182c5.178,0.205,9.172,0.529,9.416,0.773
                           c0.326,0.326,0.286,0.814,0,1.59c-0.244,0.652-0.365,1.388-0.244,1.714c0.326,0.854,2.16-0.205,3.101-1.796
                           c0.446-0.731,1.141-1.467,1.508-1.631c0.407-0.121,1.548-1.142,2.566-2.199l1.875-1.997l4.646,0.245
                           c2.568,0.121,5.095,0.406,5.584,0.65c1.385,0.692,1.549,1.631,0.408,2.567c-0.571,0.446-2.038,1.63-3.302,2.647
                           c-2.731,2.201-3.06,2.771-1.43,2.526c0.693-0.122,1.632,0.121,2.243,0.529c1.103,0.692,1.103,0.692,2.487-0.774
                           c1.223-1.304,1.631-1.468,3.301-1.468c2.283,0.041,4.893,0.572,5.503,1.185c0.286,0.283,0.286,0.61-0.082,0.979
                           c-0.365,0.448-0.325,0.691,0.082,1.063c1.142,0.896,4.443,2.485,5.259,2.485c0.448,0,1.753,0.528,2.854,1.224
                           c1.059,0.65,2.2,1.225,2.484,1.225c0.244,0.039,1.143,0.568,1.916,1.222c1.997,1.755,3.548,1.632,8.355-0.61
                           c1.834-0.854,7.295-1.02,8.071-0.243c0.243,0.243,0.938,0.448,1.508,0.448c0.65,0,1.507,0.487,2.283,1.265
                           c0.649,0.69,1.752,1.509,2.444,1.794c0.691,0.284,2.12,1.427,3.181,2.482l1.875,1.998l-0.775-2.771
                           c-0.406-1.55-1.305-3.547-1.957-4.483c-0.652-0.938-1.59-2.526-2.119-3.545c-0.979-1.957-4.359-5.465-6.357-6.563
                           c-2.16-1.143-4.564-1.305-5.91-0.366c-2.324,1.672-4.729,0.896-6.074-1.956c-0.773-1.672-1.223-2.08-2.526-2.484
                           c-1.061-0.326-1.793-0.856-2.199-1.672l-0.653-1.227l-2.977,0.205l-3.017,0.242l-1.265-1.875c-0.692-1.02-1.265-2.036-1.265-2.279
                           c0-0.205-0.365-1.104-0.772-1.957c-0.692-1.266-1.103-1.591-2.364-1.795c-0.854-0.162-1.712-0.08-1.917,0.123
                           c-0.243,0.242-1.019,0.406-1.752,0.406c-1.834,0-1.794-1.224,0.082-3.344c2.201-2.403,1.224-2.977-1.63-0.979
                           c-0.653,0.488-2.038,1.061-3.019,1.305c-2.24,0.569-3.423,0.164-4.482-1.631c-0.979-1.672-1.102-7.703-0.245-10.965
                           c0.326-1.304,0.612-2.976,0.612-3.75c0-0.732,0.364-2.16,0.771-3.179c0.693-1.63,0.938-1.834,2.446-2.08
                           c1.304-0.204,1.793-0.487,2.079-1.304c0.854-2.161,0.569-2.609-1.548-2.609c-1.103,0-2.324-0.244-2.773-0.61
                           C92.87,276.233,92.952,276.233,91.24,277.742z" />
              <path class="territory" id="Gonda"
                d="M385.375,278.435c-0.896,0.979-2.729,1.061-4.075,0.163c-0.979-0.653-1.021-0.653-1.021,0.366
                           c0,0.571-0.163,1.183-0.407,1.305c-0.202,0.122-0.406,0.733-0.406,1.345c0,1.673-1.063,2.854-2.771,3.139
                           c-2.566,0.449-2.813,0.611-3.059,1.793c-0.162,0.814-0.854,1.549-2.281,2.445c-1.754,1.143-2.16,1.265-2.976,0.815
                           c-1.389-0.693-3.223-2.487-3.629-3.546c-0.285-0.733-0.569-0.854-1.47-0.653c-1.549,0.367-1.549,0.408-1.019,1.916
                           c0.283,0.774,0.486,1.59,0.486,1.876c0,0.773-2.896,4.076-4.36,4.973c-0.979,0.61-1.345,1.142-1.345,1.916
                           c-0.081,2.322-1.266,3.789-4.484,5.462c-1.67,0.855-3.301,1.549-3.587,1.549c-0.813,0,0.53,2.323,1.551,2.648
                           c1.711,0.529,4.853,3.467,5.625,5.26c0.568,1.223,1.509,2.322,3.059,3.423c1.224,0.938,2.607,2.283,3.059,3.017
                           c0.488,0.734,2.078,2.446,3.546,3.752c1.468,1.347,2.648,2.729,2.648,3.099c0,0.731,0.772,1.224,1.957,1.224
                           c0.364,0,1.63,0.773,2.771,1.672c1.141,0.938,3.261,2.08,4.85,2.648l2.813,0.979l4.076-1.387c2.282-0.773,5.503-1.631,7.215-1.875
                           c2.854-0.447,3.262-0.447,5.056,0.367c2.525,1.1,3.221,1.1,4.28-0.246c0.731-0.938,0.813-1.467,0.61-4.156
                           c-0.123-1.957-0.041-3.75,0.324-4.934c0.488-1.752,0.569-1.834,2.896-2.404c2.119-0.488,2.607-0.488,4.523,0.123
                           c1.143,0.365,2.648,0.652,3.304,0.652c1.306,0,3.343,0.691,5.38,1.752c1.306,0.691,1.428,0.691,3.221,0.041
                           c1.306-0.529,2.119-1.184,2.854-2.364c0.57-0.938,1.672-2.444,2.404-3.342c1.225-1.511,1.306-1.755,0.773-2.446
                           c-0.327-0.447-0.611-1.223-0.611-1.793s-0.326-1.509-0.691-2.038c-0.448-0.61-0.731-1.752-0.731-2.854c0-1.835,0-1.835-2.446-3.138
                           c-1.347-0.692-3.261-1.388-4.277-1.552l-1.876-0.285l-0.854,1.999c-0.49,1.062-0.979,2.525-1.144,3.26
                           c-0.162,0.772-0.896,1.875-1.875,2.771c-1.427,1.267-1.834,1.429-2.937,1.226c-0.732-0.164-1.589-0.53-1.957-0.855
                           c-0.324-0.326-0.854-0.57-1.101-0.57c-0.285,0-0.691-0.367-0.979-0.813c-0.283-0.447-0.732-0.814-0.938-0.814
                           c-0.246,0-1.264-0.854-2.242-1.874c-1.02-1.021-2.363-2.162-3.058-2.486c-0.651-0.365-1.348-0.854-1.51-1.102
                           c-0.161-0.244-0.202-3.018-0.122-6.195c0.163-6.521,0.326-6.156-3.748-7.46c-1.918-0.611-2.486-1.06-4.036-3.098
                           c-0.979-1.345-1.792-2.608-1.792-2.771c0-0.326-2.322-2.73-2.648-2.73C386.15,277.619,385.781,277.985,385.375,278.435z" />
              <path class="territory" id="Kushinagar" d="M529.673,282.511c-0.408,0.449-1.307,0.979-1.957,1.142c-0.938,0.245-1.307,0.693-1.794,2.12
                           c-0.367,1.02-0.979,2.324-1.428,2.936c-0.57,0.814-0.691,1.508-0.529,2.445c0.205,1.101-0.244,2.527-2.283,7.257l-2.525,5.907
                           l0.284,3.752c0.203,2.977,0.123,4.076-0.325,4.975c-0.896,1.71-2.854,2.484-5.665,2.2c-2.896-0.285-5.301,0.528-7.379,2.606
                           c-1.386,1.385-1.467,1.631-1.467,3.953c0.041,2.854,0.448,3.588,2.444,4.238c0.772,0.284,1.957,0.938,2.647,1.471
                           c1.183,0.978,1.183,0.978,1.468,6.602c0.163,3.141,0.163,6.195,0.04,6.85c-0.121,0.651-0.04,1.102,0.164,1.02
                           c6.154-2.483,11.534-5.299,13.044-6.808c0.938-0.938,1.915-1.711,2.119-1.711c0.65,0,6.438,6.398,8.562,9.375
                           c4.237,6.032,5.014,6.929,6.153,6.929c2.119,0,4.117-2.443,4.117-5.013c0-0.571,0.407-1.508,0.855-2.12
                           c0.813-0.979,1.06-1.06,2.771-0.813c4.894,0.651,10.639,0.692,13.451,0.041c1.59-0.365,3.586-0.651,4.483-0.651
                           c1.426,0,1.63-0.122,1.875-1.145c0.405-1.995-0.327-3.219-2.201-3.545c-1.753-0.285-3.303-1.752-3.303-3.099
                           c0-1.264-1.143-1.998-3.099-1.998c-2.202,0-2.569-0.61-1.835-3.018c1.02-3.341,1.02-4.237-0.122-6.563
                           c-0.651-1.305-1.468-2.322-1.956-2.486c-0.896-0.283-1.061-0.123-2.896,2.486c-1.429,1.998-3.628,0.938-4.198-2.119
                           c-0.245-1.264-0.285-1.305-1.103-0.73c-2.403,1.671-5.584-0.286-5.584-3.466c0-0.896,0.243-1.755,0.651-2.079
                           c1.183-0.979,0.529-3.953-1.387-6.686c-1.307-1.795-1.711-2.771-1.711-3.914c0-1.957-0.53-2.283-1.998-1.223
                           c-1.631,1.182-3.142,1.1-3.953-0.164c-0.855-1.346-0.529-3.139,1.102-5.707c0.651-1.06,1.143-2.201,1.021-2.486
                           c-0.286-0.693-3.629-2.813-5.83-3.669c-0.979-0.367-1.752-0.896-1.752-1.142c0-0.611,1.059-2.16,2.524-3.749
                           c0.692-0.735,1.145-1.632,1.063-2.039C532.034,281.574,530.569,281.492,529.673,282.511z" />
              <path class="territory" id="Barabanki" d="M326.964,284.549c-1.632,1.141-1.711,1.345-1.711,3.22c0,1.589-0.246,2.283-1.063,3.261
                           c-1.143,1.347-2.606,1.631-3.385,0.692c-0.813-0.978-4.482-2.364-5.462-2.038c-0.487,0.124-1.956,1.386-3.221,2.731
                           c-2.322,2.486-2.363,2.486-3.711,1.998c-0.729-0.245-2.443-0.611-3.79-0.734c-2.976-0.327-3.465,0.123-3.547,3.099
                           c-0.081,2.201-0.162,2.119,2.568,2.689c0.772,0.123,2.241,0.855,3.262,1.551c1.021,0.69,2.2,1.467,2.648,1.672
                           c1.142,0.569,1.224,2.566,0.203,4.156c-0.651,1.1-1.063,1.346-2.2,1.346c-1.834,0-2.282,0.732-1.021,1.67
                           c0.53,0.408,0.979,1.186,1.021,1.878c0.041,0.61,0.122,1.347,0.122,1.589c0.041,0.286,0.854,0.609,1.875,0.734
                           c2.201,0.364,3.221,1.224,2.854,2.443c-0.772,2.403-0.691,3.506,0.489,5.422c0.651,1.061,1.385,2.445,1.63,3.057
                           c0.326,0.734,0.979,1.226,1.834,1.47c0.938,0.243,1.59,0.813,2.365,2.159c0.896,1.509,1.304,1.835,2.485,1.916
                           c2.771,0.285,2.977,1.307,1.428,7.176c-1.226,4.605-1.673,8.845-1.063,9.984c0.285,0.57,0.857,0.855,1.672,0.855
                           c0.693,0,2.405,0.65,3.791,1.427c1.55,0.854,3.102,1.429,3.953,1.429c1.55,0,1.998-0.246,2.65-1.429
                           c0.69-1.183,5.177-0.979,8.069,0.367c2.689,1.265,5.138,2.241,6.112,2.362c1.063,0.162,1.915-2.485,1.794-5.665
                           c-0.082-2.363,0-2.648,1.185-3.872c2.078-2.159,2.894-5.705,1.549-6.85c-0.652-0.528-2.648-3.83-2.648-4.359
                           c0-0.162,0.365-0.773,0.773-1.307c0.569-0.731,1.345-1.061,2.977-1.265c1.306-0.203,2.937-0.772,3.83-1.385
                           c1.468-0.938,1.754-0.979,3.101-0.57c1.427,0.407,1.591,0.365,2.321-0.569c0.448-0.529,1.55-1.225,2.485-1.509l1.672-0.487
                           l-3.75-3.955c-2.079-2.159-4.687-4.77-5.788-5.787c-1.142-0.979-2.28-2.445-2.605-3.182c-0.652-1.589-2.12-3.017-4.239-4.156
                           c-1.224-0.651-1.753-0.692-3.018-0.366c-0.813,0.245-1.955,0.325-2.443,0.204c-1.469-0.366-3.465-2.241-3.465-3.221
                           c0-0.488-0.449-2.322-1.021-4.078c-0.772-2.444-1.019-4.035-1.019-6.971c0-2.079-0.164-4.32-0.367-4.972
                           c-0.203-0.653-0.529-1.916-0.652-2.813l-0.284-1.631l-0.69,0.979c-0.367,0.529-0.938,1.915-1.267,3.058
                           c-0.527,1.711-0.813,2.119-1.672,2.2c-1.59,0.204-2.894-1.142-3.791-4.035c-0.528-1.55-1.101-2.65-1.509-2.731
                           C328.962,283.367,327.902,283.855,326.964,284.549z" />
              <path class="territory" id="Kannauj"
                d="M207.737,292.986c-0.16,0.122-0.282,0.897-0.282,1.672c0,2.079-1.146,4.035-3.061,5.381
                           c-2.241,1.549-4.359,1.875-6.685,1.061c-0.979-0.365-2.365-0.651-3.06-0.651c-1.752,0-3.017-0.979-3.302-2.566
                           c-0.366-1.876-1.468-2.446-3.954-2.119c-1.752,0.244-2.119,0.448-2.565,1.548c-0.449,1.061-0.407,1.59,0.324,3.71
                           c0.447,1.385,0.979,2.648,1.143,2.854c0.691,0.771,0.326,2.937-0.856,5.3c-0.69,1.305-1.223,2.688-1.223,3.059
                           c0,1.225-1.998,3.709-2.978,3.709c-0.732,0-0.772,0.082-0.283,0.408c0.324,0.242,1.631,0.405,2.854,0.324
                           c2.446-0.082,2.608,0,7.5,3.508c3.262,2.362,4.606,2.524,6.318,0.896c1.061-1.019,1.344-1.101,3.057-0.854
                           c1.428,0.244,2.161,0.611,3.101,1.67c0.649,0.775,1.223,1.672,1.223,1.998c0,0.285,1.143,1.103,2.569,1.836
                           c1.385,0.692,3.342,1.955,4.358,2.813c1.021,0.854,2.323,1.672,2.938,1.834c0.938,0.204,1.223,0.081,1.752-0.854
                           c1.753-3.1,2.161-3.586,3.302-3.83c1.224-0.244,3.913-1.672,5.136-2.731c0.774-0.651,0.734-1.142-0.406-4.687
                           c-0.814-2.609-0.406-2.938,2.485-1.957l2.323,0.813l0.772-1.021c0.979-1.224,0.896-1.426-1.957-7.092
                           c-1.102-2.119-2.2-4.524-2.444-5.3c-0.855-2.608-2.813-4.444-5.503-5.138c-1.306-0.366-3.425-1.183-4.646-1.834
                           c-1.224-0.653-2.854-1.183-3.588-1.183c-1.06,0-1.589-0.326-2.486-1.427C208.429,292.661,208.185,292.497,207.737,292.986z" />
              <path class="territory" id="Basti" d="M433.066,302.893c-1.549,0.407-3.545,1.021-4.401,1.388l-1.55,0.689l0.815,1.347
                           c0.489,0.732,0.854,1.67,0.854,1.996c0,0.367,0.326,1.307,0.692,2.121c0.652,1.385,0.652,1.467-0.203,2.566
                           c-0.529,0.609-1.713,2.324-2.729,3.791c-1.511,2.241-2.12,2.813-3.915,3.546c-1.143,0.488-2.281,0.896-2.484,0.896
                           c-0.204,0-1.632-0.567-3.181-1.223c-1.55-0.693-3.427-1.223-4.198-1.223c-0.773,0-2.078-0.285-2.938-0.611
                           c-1.753-0.773-4.77-0.488-5.584,0.529c-0.365,0.406-0.486,1.834-0.447,4.605c0.082,3.627,0,4.115-0.938,5.502l-1.019,1.471
                           l1.101,1.588c0.651,0.938,1.794,1.917,2.771,2.363c0.938,0.408,2.896,1.59,4.399,2.607c3.914,2.689,6.034,3.71,7.868,3.79
                           c0.896,0.041,2.935,0.651,4.482,1.388c1.589,0.732,3.79,1.754,4.934,2.281c1.141,0.489,2.281,1.225,2.566,1.551
                           c0.691,0.854,4.811,2.688,5.951,2.688c0.487,0,1.671-0.244,2.566-0.569c1.957-0.691,6.931-0.488,10.026,0.407
                           c2.281,0.651,2.689,0.406,2.689-1.631c0-1.103,1.385-2.729,4.851-5.625c0.447-0.367,0.938-1.349,1.062-2.119
                           c0.245-1.226,0.082-1.672-1.101-3.101c-0.733-0.938-1.998-2.037-2.771-2.443c-0.771-0.408-1.834-1.186-2.322-1.712
                           c-1.183-1.267-2.485-5.017-2.607-7.582c-0.121-1.998-0.08-2.079,2.242-4.158c2.895-2.647,3.262-3.343,2.936-5.462
                           c-0.245-1.63-0.367-1.711-3.426-3.179c-1.711-0.815-3.586-1.634-4.156-1.794c-1.508-0.406-2.729-1.713-3.831-4.034
                           c-1.02-2.201-1.02-2.242-5.544-3.224C436.204,302.239,434.656,302.482,433.066,302.893z" />
              <path class="territory" id="561" d="M299.736,300.895c-0.162,0.285-1.792,1.184-3.668,2.08c-1.875,0.854-3.506,1.752-3.627,1.957
                           c-0.125,0.243-1.224,0.405-2.403,0.405c-1.753,0-2.324,0.164-3.101,1.021c-0.896,0.938-1.223,1.021-4.035,0.938
                           c-2.894-0.081-3.221,0-4.933,1.226c-0.979,0.73-2.12,1.834-2.526,2.443c-0.61,0.938-0.61,1.143-0.123,1.428
                           c1.062,0.569,0.733,2.362-0.69,3.588c-1.143,0.979-1.267,1.224-0.734,1.59c0.326,0.244,1.185,0.326,1.915,0.203
                           c1.469-0.244,2.568,0.568,2.568,1.957c0,1.304,0.408,1.672,2.566,2.485c2.2,0.813,2.73,1.509,3.791,4.771
                           c0.611,1.793,1.021,2.404,1.875,2.729c1.225,0.448,2.12,2.202,1.754,3.385c-0.161,0.448-0.896,0.938-1.957,1.183
                           c-0.938,0.245-1.955,0.53-2.199,0.61c-0.775,0.244-0.652,1.631,0.286,3.344c0.446,0.854,0.813,1.955,0.813,2.445
                           c0,1.264,0.407,1.385,2.896,0.731c3.343-0.896,4.851-0.772,7.011,0.608c1.06,0.652,1.917,1.349,1.917,1.511
                           c0,0.202,0.73,0.772,1.63,1.347c0.896,0.569,2.197,1.711,2.896,2.523c0.649,0.856,2.24,2.283,3.546,3.183
                           c1.266,0.854,3.181,2.241,4.236,3.06l1.877,1.426l0.896-1.426c0.732-1.185,2.771-3.101,6.808-6.318
                           c0.246-0.204,0.569-1.631,0.692-3.139c0.161-1.511,0.732-4.565,1.265-6.729c1.265-4.975,1.265-5.219-0.041-5.219
                           c-1.59,0-2.526-0.69-3.424-2.443c-0.449-0.896-1.103-1.631-1.388-1.631c-0.854,0-3.018-1.916-3.343-2.979
                           c-0.162-0.487-0.691-1.549-1.183-2.322c-1.549-2.525-1.875-3.953-1.224-5.504l0.569-1.385l-1.796-0.285
                           c-2.036-0.285-3.098-1.266-3.261-2.938c-0.04-0.652-0.487-1.589-0.938-2.037c-1.265-1.264-1.183-3.099,0.123-3.669
                           c0.568-0.284,1.507-0.487,2.079-0.487c1.102,0,2.444-2.039,1.508-2.324c-0.246-0.079-1.267-0.771-2.241-1.549
                           C304.179,300.936,300.346,299.916,299.736,300.895z" />
              <path class="territory" id="Gorakhpur" d="M471.993,304.727c0,1.144,0.529,3.019,1.102,3.83c0.041,0.082,0.609-0.08,1.264-0.326
                           c1.021-0.406,1.469-0.363,2.772,0.246c1.549,0.732,1.59,0.814,1.549,2.771c-0.041,1.143-0.082,2.566-0.123,3.262
                           c-0.082,0.651,0.123,1.997,0.408,2.936c1.021,3.304-0.854,6.521-3.182,5.463c-0.772-0.366-1.345-0.366-2.362,0
                           c-1.143,0.447-1.51,0.896-2.283,2.977c-0.773,2.119-0.896,3.303-0.854,7.621c0,4.322,0.162,5.667,1.102,8.768
                           c1.224,3.953,3.384,7.987,4.892,8.967c0.531,0.326,1.021,0.979,1.146,1.388c0.445,1.793-2.979,4.074-5.22,3.505
                           c-1.305-0.326-2.24,1.018-2.24,3.221c0.041,2.039,0.568,2.729,3.546,4.605c2.32,1.468,2.402,1.468,7.704,1.712l5.339,0.204
                           l2.363,1.834c6.727,5.218,8.396,6.031,11.372,5.259c1.632-0.407,1.997-0.366,2.937,0.284c0.611,0.448,1.672,1.182,2.405,1.672
                           l1.303,0.896l2.202-1.346c1.224-0.734,2.443-1.793,2.729-2.404c0.49-0.979,0.367-1.387-1.018-4.199
                           c-0.938-1.834-2.08-3.546-2.854-4.116l-1.306-1.021l-1.426,0.856l-1.388,0.896l-0.814-1.144c-0.938-1.347-1.752-4.076-1.996-6.768
                           c-0.285-2.813,0.57-3.709,3.302-3.342c1.958,0.244,1.997,0.244,3.751-1.672c1.957-2.08,2.607-4.117,1.793-5.666
                           c-0.325-0.611-0.448-2.159-0.366-4.319c0.081-1.876,0.081-5.3,0.04-7.623c-0.079-3.953-0.16-4.238-1.141-5.177
                           c-0.57-0.529-1.55-1.104-2.201-1.223c-1.956-0.408-2.977-1.957-3.18-4.688c-0.082-1.345-0.244-2.444-0.367-2.444
                           c-0.081,0-1.509-0.204-3.099-0.447c-2.813-0.408-3.018-0.529-5.015-2.648l-2.038-2.201h-2.525c-3.302,0-5.098-0.732-5.788-2.402
                           c-0.489-1.185-0.408-1.51,1.183-4.605c0.896-1.835,1.55-3.424,1.429-3.546c-0.122-0.123-0.896,0.53-1.754,1.426
                           c-1.428,1.673-3.426,2.526-4.361,1.875c-0.244-0.161-0.731-0.854-1.101-1.548c-0.569-1.063-1.062-1.348-3.873-2.12
                           c-1.793-0.488-3.343-0.896-3.507-0.896C472.115,303.3,471.993,303.949,471.993,304.727z" />
              <path class="territory" id="Sant Kabir Nagar"
                d="M467.918,304.357c-1.021,0.367-2.283,1.103-2.896,1.632c-0.57,0.53-1.224,0.979-1.47,0.979
                           c-0.243,0-1.225,0.896-2.118,1.997c-1.264,1.469-2.039,2.079-3.18,2.282c-2.691,0.489-3.142,1.103-3.183,4.116v2.688l-2.524,2.405
                           c-2.854,2.689-3.059,3.383-1.957,7.052c0.69,2.242,1.835,3.671,3.669,4.606c1.712,0.896,4.646,4.236,4.688,5.339
                           c0,0.528-0.203,1.753-0.445,2.771c-0.408,1.508-0.815,2.037-2.365,3.059c-2.405,1.632-3.099,2.605-3.464,4.892l-0.285,1.876
                           l2.16,1.428c2.321,1.549,8.723,5.625,11.86,7.582l1.915,1.224v-1.183c0-1.471,0.938-3.793,1.672-4.281
                           c0.326-0.204,1.469-0.365,2.527-0.406c1.264,0,2.199-0.285,2.648-0.734c0.65-0.611,0.609-0.734-0.408-1.589
                           c-1.712-1.427-3.505-4.812-4.853-9.09c-1.102-3.424-1.263-4.646-1.345-9.294c-0.082-4.811,0-5.584,0.896-7.99
                           c1.224-3.22,1.671-3.79,3.749-4.482c1.266-0.407,1.876-0.445,2.648-0.082c0.938,0.449,1.103,0.367,1.468-0.648
                           c0.326-0.814,0.326-1.591-0.082-2.938c-0.527-1.998-0.568-2.565-0.161-5.299c0.284-1.754,0.243-1.916-0.814-2.365
                           c-0.814-0.364-1.264-0.405-1.59-0.082c-0.203,0.205-0.938,0.408-1.59,0.408c-0.938,0-1.266-0.285-1.793-1.549
                           c-0.366-0.813-0.732-2.283-0.855-3.262c-0.082-0.938-0.285-1.712-0.448-1.712C469.875,303.747,468.937,304.033,467.918,304.357z" />
              <path class="territory" id="Unnao"
                d="M250.332,310.922c-0.693,0.122-1.021,0.611-1.347,1.996c-0.364,1.468-0.813,2.08-2.077,2.895
                           c-1.551,1.021-1.633,1.063-2.979,0.408c-0.733-0.367-1.672-1.061-2.038-1.59l-0.731-0.938l-1.632,1.509
                           c-0.896,0.854-2.117,1.754-2.729,2.038c-0.938,0.406-1.062,0.611-0.733,1.305c0.203,0.487,1.266,1.549,2.322,2.364
                           c2.364,1.835,2.609,2.647,2.69,8.479c0.042,3.952,0.123,4.4,1.142,5.867c0.611,0.854,1.101,1.834,1.101,2.12
                           c0,0.326,0.408,0.649,0.938,0.731c0.489,0.121,1.467,0.283,2.12,0.447c0.69,0.123,1.793,0.49,2.445,0.816
                           c0.69,0.284,1.834,0.771,2.566,1.059c1.997,0.734,2.896,2.813,3.18,7.379c0.325,5.545,0.773,6.479,5.097,10.519
                           c2.039,1.916,4.076,3.669,4.563,3.872c2.527,1.184,5.221,3.059,7.297,5.097c2.649,2.646,3.385,4.604,3.059,8.231
                           c-0.204,2.24-0.162,2.404,0.979,3.222c0.652,0.448,1.185,1.144,1.185,1.549c0,0.366,0.285,1.062,0.609,1.509
                           c0.325,0.406,0.611,1.102,0.611,1.469c0,0.854,3.058,3.182,4.156,3.182c0.813,0,2.365-1.021,4.441-2.896
                           c2.486-2.32,4.401-3.627,5.585-3.871c0.814-0.164,1.632-0.813,2.485-2.036c0.693-0.979,1.427-1.796,1.632-1.796
                           c0.202,0,0.487-0.568,0.651-1.264c0.244-1.102,0.08-1.508-1.508-3.18c-3.386-3.547-4.118-6.4-1.389-5.342
                           c0.611,0.205,1.834,0.408,2.691,0.408c0.854,0,1.711,0.164,1.834,0.406c0.121,0.203,1.224,0.693,2.402,1.02
                           c1.265,0.367,2.608,1.144,3.304,1.836c1.386,1.467,2.038,1.549,2.813,0.285c1.509-2.364,1.063-5.504-1.101-7.908
                           c-0.773-0.855-0.773-1.102-0.325-4.075c0.284-1.753,0.528-3.546,0.569-3.954c0.041-0.529-0.651-1.264-2.119-2.322
                           c-1.185-0.813-2.937-2.321-3.872-3.302c-2.486-2.569-6.317-5.585-7.501-5.911c-0.61-0.123-2.079-0.041-3.342,0.245
                           c-1.225,0.284-2.896,0.611-3.709,0.733l-1.467,0.203l-0.489-2.364c-0.244-1.347-0.732-2.771-1.062-3.181
                           c-0.326-0.447-0.61-1.508-0.61-2.363c0-1.752,0.854-2.527,3.342-2.977c1.387-0.244,1.469-0.367,1.102-1.102
                           c-0.245-0.49-0.691-0.691-1.021-0.57c-1.061,0.408-2.242-0.488-1.996-1.509c0.325-1.344-1.184-4.894-2.282-5.462
                           c-0.53-0.285-1.672-0.771-2.487-1.104c-1.304-0.527-1.549-0.813-1.793-2.157c-0.243-1.511-0.324-1.593-1.549-1.429
                           c-1.509,0.162-3.505-1.182-3.505-2.402c0-0.489,0.569-1.389,1.223-2.08c1.184-1.143,1.225-1.266,0.53-1.752
                           c-0.57-0.448-0.896-0.448-1.753,0c-0.571,0.283-1.59,0.65-2.283,0.773c-1.467,0.323-2.363,1.183-2.813,2.688
                           c-0.448,1.468-3.464,4.812-4.605,5.096c-1.55,0.367-2.444-0.123-3.831-2.161c-0.691-1.061-1.59-2.119-1.998-2.402
                           c-0.365-0.284-1.102-1.551-1.63-2.854c-0.896-2.279-2.161-3.79-3.017-3.708C251.474,310.718,250.864,310.84,250.332,310.922z" />
              <path class="territory" id="Etahwah"
                d="M160.575,314.427c-0.774,0.285-2.609,1.345-4.036,2.405c-3.587,2.73-5.992,2.648-6.972-0.246
                           c-0.406-1.225-0.651-1.426-1.958-1.549c-0.813-0.08-2.688,0.042-4.155,0.205c-1.47,0.16-3.304,0.365-4.076,0.447
                           c-2.487,0.203-2.854,0.567-2.854,2.565c0,1.632,0.163,1.958,2.241,3.913c1.264,1.186,2.73,3.059,3.262,4.198
                           c0.529,1.102,1.591,2.937,2.322,4.075c0.734,1.102,1.673,3.305,2.08,4.894c0.733,2.854,0.815,2.937,2.242,3.181
                           c0.854,0.121,2.079,0.243,2.771,0.243c2.12,0,2.363,0.733,1.388,4.036c-0.449,1.589-1.021,2.977-1.225,3.098
                           c-0.732,0.448-0.448,1.021,1.429,3.02c1.019,1.06,1.834,2.158,1.834,2.443c0,0.246,0.73,1.387,1.63,2.526
                           c0.896,1.142,1.63,2.486,1.63,3.017c0,1.998,0.69,2.937,2.323,3.222c5.258,0.815,7.296,0.979,8.07,0.528
                           c0.447-0.203,1.63-0.65,2.648-0.896c1.467-0.367,1.793-0.65,1.711-1.264c-0.081-0.407-0.204-1.51-0.245-2.405
                           c-0.082-0.938-0.407-2.12-0.732-2.647c-0.365-0.57-0.773-2.242-0.938-3.709c-0.245-2.648-0.245-2.729,1.02-3.794
                           c0.691-0.567,1.592-1.06,1.997-1.06c0.774,0,2.896-3.668,2.896-5.098c0.041-0.444,0.285-1.264,0.61-1.834
                           c0.488-0.896,0.448-1.101-0.08-1.752c-0.367-0.365-1.021-0.691-1.429-0.691c-1.387,0-1.347-1.225,0.123-2.445
                           c1.386-1.142,1.386-1.183,1.426-4.729c0.041-2.813,0.326-4.279,1.144-6.522c0.57-1.59,1.062-3.26,1.062-3.668
                           c-0.042-1.304-1.021-2.199-2.404-2.199c-0.733,0-1.712-0.204-2.202-0.489C173.293,314.427,162.737,313.693,160.575,314.427z" />
              <path class="territory" id="Kanpur Nagar" d="M230.97,317.646c-0.855,0.896-1.385,1.184-2.038,0.979c-2.894-0.814-2.688-0.938-2.039,1.468
                           c0.693,2.73,0.327,3.587-2.159,5.054l-1.916,1.146l1.672,1.467c0.938,0.775,1.714,1.712,1.714,2.038
                           c0.04,1.428,1.141,3.669,2.362,4.688c0.733,0.61,1.307,1.346,1.307,1.631c0,1.061,3.18,6.686,4.318,7.703
                           c0.651,0.57,2.201,1.591,3.427,2.242c1.223,0.65,3.219,2.117,4.399,3.181c1.792,1.713,2.12,2.198,2.12,3.505
                           c0,1.104-0.246,1.631-0.938,2.12c-0.529,0.323-1.183,1.101-1.429,1.672c-1.06,2.237-0.325,8.272,1.389,11.494
                           c0.771,1.549,0.731,2.159-0.448,3.751c-0.57,0.771-1.021,1.874-1.021,2.443c0,2.078-1.915,2.648-4.48,1.385
                           c-1.063-0.528-1.508-0.567-2.08-0.201c-0.407,0.242-1.225,0.445-1.752,0.445c-1.508,0-1.671,0.652-0.651,2.568
                           c0.855,1.59,0.855,1.794,0.284,3.18c-0.408,1.021-1.182,1.793-2.364,2.486c-1.426,0.773-1.752,1.182-1.671,1.916
                           c0.041,0.529-0.286,1.549-0.772,2.323l-0.815,1.346l1.345,0.854c1.349,0.813,3.06,1.06,6.441,0.854
                           c1.019-0.041,2.364,0.123,2.976,0.327c1.021,0.407,1.104,0.61,1.104,2.565c-0.042,1.185-0.286,2.607-0.611,3.183
                           c-0.327,0.569-0.571,1.142-0.611,1.304c0,0.122,1.021,0.733,2.242,1.307c1.426,0.65,2.404,1.386,2.73,2.037
                           c1.019,2.281,4.48,0.365,5.584-3.1c0.731-2.242,2.443-4.361,7.583-9.457c4.399-4.359,4.729-4.646,6.685-4.892
                           c1.59-0.203,2.486-0.651,4.157-2.079c1.142-0.979,2.647-1.915,3.301-2.037c0.897-0.204,1.387-0.691,1.834-1.753
                           c0.857-2.038,1.145-5.421,0.571-7.054c-0.734-2.281-5.666-6.604-9.457-8.273c-2.078-0.896-8.438-7.296-9.333-9.334
                           c-0.407-1.021-0.815-3.261-0.938-5.585c-0.282-4.771-0.978-6.274-3.058-6.972c-0.814-0.243-1.711-0.608-1.915-0.813
                           c-0.245-0.162-1.265-0.448-2.242-0.61c-2.364-0.324-3.506-1.062-4.278-2.729c-0.366-0.692-0.938-1.875-1.306-2.526
                           c-0.528-0.896-0.69-2.363-0.731-5.503c-0.041-2.364-0.203-4.646-0.407-5.096c-0.204-0.448-1.59-2.038-3.1-3.546
                           c-1.51-1.51-2.854-3.1-3.017-3.587C232.601,316.1,232.358,316.18,230.97,317.646z" />
              <path class="territory" id="Auraiya" d="M180.426,321.766c-0.896,2.607-1.142,4.033-1.1,6.398c0,2.281-0.163,3.423-0.734,4.564
                           c-0.773,1.467-0.773,1.547-0.04,2.198c1.142,1.021,1.305,2.038,0.611,3.386c-0.367,0.689-0.653,1.549-0.653,1.957
                           c0,0.404-0.53,1.834-1.223,3.179c-1.021,2.118-1.428,2.526-2.938,3.058l-1.753,0.651l0.123,2.608
                           c0.123,1.59,0.408,2.936,0.774,3.342c0.324,0.367,0.651,1.387,0.731,2.242c0.244,2.566,0.693,4.197,1.185,4.197
                           c0.243,0,1.101,0.53,1.875,1.184c2.281,1.834,5.096,1.996,8.231,0.408c0.734-0.367,2.896-0.082,4.117,0.528
                           c0.489,0.244,0.611,0.649,0.489,1.265c-0.163,0.651,0.041,1.224,0.813,1.916l1.063,0.979l1.712-1.835
                           c4.035-4.359,8.069-11.25,7.581-13.002c-0.611-2.202-0.407-4.279,0.609-5.666c1.063-1.468,3.386-3.302,4.118-3.302
                           c0.244,0,0.855-0.448,1.385-0.938l0.896-0.979l-0.814-1.875c-0.446-1.019-1.183-2.078-1.63-2.321
                           c-0.487-0.244-1.102-0.938-1.427-1.591l-0.61-1.142l2.038-0.448c1.144-0.285,2.241-0.406,2.404-0.285
                           c0.204,0.121,0.734-0.406,1.224-1.184c1.144-1.874,0.691-2.525-2.729-4.115c-1.998-0.938-2.813-1.509-3.18-2.444
                           c-0.611-1.429-1.673-2.445-2.938-2.813c-0.652-0.201-1.346,0.043-2.404,0.856c-2.24,1.671-3.871,1.509-7.012-0.692
                           c-4.439-3.141-5.421-3.587-7.621-3.628l-2.039-0.041L180.426,321.766z" />
              <path class="territory" id="Ayodhya" d="M365.404,327.104c-0.653,0.285-1.59,0.938-2.039,1.43c-0.689,0.771-1.062,0.854-2.688,0.65
                           c-1.593-0.244-2.161-0.123-3.101,0.569c-0.609,0.487-2.038,0.979-3.181,1.101c-2.894,0.367-3.179,0.733-2.118,2.527
                           c0.488,0.813,1.226,1.834,1.589,2.201c0.856,0.854,0.979,3.343,0.246,5.747c-0.45,1.509-0.408,1.672,0.487,2.403
                           c0.652,0.528,1.305,0.692,1.956,0.528c1.103-0.284,2.12,0.367,2.12,1.388c0,0.408,0.568,1.225,1.224,1.875
                           c1.021,0.979,1.223,1.508,1.223,3.019c0,2.688,0.367,3.097,2.16,2.524c0.896-0.324,2.283-0.406,3.425-0.242
                           c3.058,0.445,8.725,1.834,9.944,2.484c0.651,0.325,2.121,0.57,3.303,0.57c1.388,0,3.019,0.406,4.605,1.061
                           c1.834,0.813,3.221,1.102,5.504,1.144c3.545,0.039,4.441,0.485,6.767,3.302c1.591,1.834,2.649,2.363,5.746,2.813l1.754,0.243
                           l1.591-3.14c0.896-1.753,1.997-3.423,2.486-3.709c0.69-0.405,0.813-0.772,0.567-1.916c-0.202-1.141-0.08-1.549,0.814-2.403
                           c0.569-0.609,1.306-1.062,1.674-1.062c0.772,0,2.32,0.775,2.688,1.347c0.284,0.405,2.813-1.224,2.813-1.834
                           c0-0.162,0.242-0.326,0.567-0.326c0.448,0,0.569-0.651,0.569-2.771c-0.041-3.669,0.245-5.014,1.144-5.666
                           c0.692-0.488,0.692-0.529-0.082-0.611c-0.406,0-1.265,0-1.875,0.041c-1.142,0.082-6.03-2.443-8.15-4.237
                           c-0.651-0.528-2.364-1.55-3.79-2.241c-2.08-0.979-2.854-1.672-3.914-3.264c-0.814-1.264-1.631-2.035-2.078-2.035
                           c-0.408,0-1.509-0.366-2.404-0.855c-1.591-0.814-1.794-0.814-5.178-0.203c-3.384,0.569-8.683,2.159-9.295,2.813
                           c-0.528,0.486-1.994,0.324-4.729-0.652c-2.771-0.979-4.36-1.834-6.032-3.343c-0.569-0.489-1.55-1.021-2.201-1.185
                           c-0.65-0.162-1.549-0.366-2.038-0.446C367.031,326.615,366.095,326.777,365.404,327.104z" />
              <path class="territory" id="Kanpur Dehat"
                d="M219.476,328.123c-0.123,0.407-0.938,1.507-1.793,2.445c-1.508,1.629-1.712,1.711-3.179,1.427
                           c-0.856-0.123-1.834-0.53-2.161-0.813c-0.57-0.449-0.773-0.285-1.753,1.303c-0.814,1.388-1.345,1.834-2.039,1.793
                           c-1.957-0.16-2.16-0.04-1.06,0.938c0.567,0.489,1.386,1.753,1.753,2.854c0.69,1.834,0.69,1.955-0.041,3.262
                           c-0.449,0.732-1.632,1.753-2.69,2.322c-3.465,1.834-4.523,3.953-3.587,7.175c0.285,1.021,0.082,1.754-1.141,4.321
                           c-0.856,1.711-2.283,4.156-3.224,5.42c-0.937,1.265-1.712,2.447-1.712,2.648c0,0.164-0.529,0.773-1.182,1.346l-1.225,1.021
                           l1.062,0.938c0.855,0.855,0.979,1.184,0.733,2.607c-0.733,4.361-0.733,4.158,0.326,4.854c0.529,0.365,1.997,0.771,3.181,0.938
                           c2.729,0.285,4.034,1.346,4.034,3.221c0,1.713,0.448,1.957,3.589,1.998c3.139,0,3.829,0.65,4.604,4.115
                           c0.407,1.712,0.814,2.484,1.752,3.221c1.144,0.856,1.469,0.896,3.547,0.53c2.2-0.366,3.302-0.123,5.707,1.183
                           c0.325,0.203,1.997-3.67,1.997-4.523c0-0.773,1.468-1.631,2.282-1.307c0.938,0.367,3.832-1.303,4.239-2.443
                           c0.324-0.813,0.244-1.304-0.407-2.201c-1.59-2.24-0.774-4.115,2.038-4.688c2.079-0.407,4.522-0.325,5.014,0.164
                           c0.815,0.813,1.916,0.529,1.916-0.53c0-0.529,0.449-1.632,1.021-2.445c0.978-1.428,0.978-1.589,0.406-2.813
                           c-1.63-3.507-2.403-10.23-1.387-12.229c0.245-0.488,0.938-1.388,1.468-1.998c0.733-0.772,0.979-1.345,0.814-2.037
                           c-0.285-0.979-3.301-3.424-5.91-4.771c-3.058-1.589-4.81-3.546-6.848-7.622c-1.265-2.568-2.405-4.239-3.304-4.934
                           c-0.772-0.569-1.305-1.307-1.183-1.551c0.366-0.979-0.774-3.343-2.242-4.604C221.23,327.186,219.843,326.98,219.476,328.123z" />
              <path class="territory" id="Deoria" d="M524.74,337.05c-1.021,0.896-4.036,2.567-7.5,4.117c-5.665,2.567-6.686,3.302-5.748,4.238
                           c0.651,0.651,0.571,2.977-0.163,4.483c-0.324,0.731-1.305,2.118-2.198,3.139c-1.551,1.794-1.592,1.834-4.076,1.753l-2.487-0.041
                           v1.183c0,0.691,0.367,2.363,0.857,3.792l0.813,2.604l1.223-0.607c1.186-0.57,1.347-0.57,3.1,0.528
                           c1.551,0.979,2.201,1.793,3.668,4.647c1.918,3.788,1.998,4.971,0.531,7.01l-0.813,1.144l1.102,0.243
                           c0.65,0.122,1.468,0.326,1.834,0.447c0.405,0.082,1.835-0.406,3.181-1.142c3.058-1.631,3.872-1.388,5.543,1.833
                           c0.855,1.633,1.346,2.201,1.834,2.079c1.143-0.364,2.69,0.488,4.729,2.567c1.591,1.672,2.364,2.117,4.117,2.484
                           c2.403,0.489,5.421,0.571,7.337,0.205c1.184-0.246,1.225-0.326,0.734-1.143c-0.857-1.305-1.144-3.629-0.693-5.545
                           c0.203-0.938,0.488-1.793,0.611-1.916c0.121-0.161,1.103-0.08,2.16,0.164c2.16,0.488,3.058,0.203,5.341-1.713
                           c1.224-1.021,1.304-1.021,2.525-0.406l1.224,0.65v-5.543v-5.505h-2.935c-4.118,0-5.503-0.771-6.521-3.546
                           c-0.938-2.607-1.712-2.895-4.974-1.956c-2.689,0.774-4.158,0.448-5.544-1.346c-0.813-1.021-1.102-3.546-0.487-4.402
                           c0.162-0.202,1.344-0.651,2.646-0.938c1.266-0.284,2.322-0.571,2.322-0.652c0-0.772-7.418-10.354-9.904-12.759l-1.711-1.63
                           L524.74,337.05z" />
              <path class="territory" id="Ambedkar Nagar"
                d="M420.676,344.02c-0.692,0.449-0.855,1.307-0.979,5.057c-0.08,2.729-0.08,2.729-2.119,4.563
                           c-2.198,2.039-3.261,2.243-4.688,1.021c-0.53-0.448-1.063-0.814-1.224-0.814c-0.733,0-1.225,1.182-0.979,2.364
                           c0.204,1.101,0.081,1.467-0.978,2.444c-0.938,0.854-3.345,4.811-3.345,5.462c0,0.081,1.266,0.122,2.813,0.163
                           c3.587,0,4.729,0.689,5.057,3.058c0.487,3.587,2.118,4.563,8.684,5.218c3.789,0.408,4.033,0.489,5.503,1.915l1.508,1.47l3.872-0.205
                           c2.648-0.12,4.156-0.366,4.811-0.854c1.59-1.104,2.649-0.814,4.118,1.063c1.914,2.443,5.664,6.113,7.213,6.97l1.268,0.733v-3.873
                           c0-2.16,0.201-4.729,0.486-5.705c0.408-1.592,0.408-1.959-0.203-2.607c-0.854-0.938-0.854-1.428-0.082-2.938
                           c0.488-0.938,0.529-1.387,0.123-2.24c-0.406-0.896-0.365-1.143,0.365-1.631c0.448-0.327,0.938-0.938,1.021-1.346
                           c0.163-0.611,0.041-0.734-0.691-0.572c-0.611,0.123-1.143-0.16-1.591-0.771c-0.896-1.306-0.854-1.469,0.691-2.404
                           c0.979-0.611,2.038-0.814,4.28-0.814c3.302,0,3.709,0.326,3.017,2.404c-0.731,2.078,0.162,3.953,2.978,6.235
                           c1.386,1.103,3.18,2.813,4.034,3.791c1.142,1.388,1.794,1.834,2.647,1.834c1.714,0,2.201-0.774,1.714-2.895
                           c-0.245-0.979-0.448-2.567-0.448-3.466c0-2.813-0.449-4.199-1.388-4.482c-0.446-0.122-1.305-0.65-1.875-1.184
                           c-0.568-0.489-2.078-1.467-3.343-2.159c-3.099-1.714-8.724-5.423-10.518-6.931c-1.793-1.549-3.709-2.08-8.562-2.487
                           c-2.936-0.243-4.155-0.202-5.177,0.204c-0.733,0.326-1.957,0.57-2.688,0.57c-1.511,0-6.359-2.037-7.178-2.977
                           c-0.243-0.326-1.549-1.102-2.813-1.714c-1.263-0.569-2.648-1.224-3.015-1.468C422.101,343.572,421.407,343.572,420.676,344.02z" />
              <path class="territory" id="Sultanpur" d="M379.871,358.245c0,0.407,0.245,1.062,0.571,1.509c0.285,0.447,0.651,1.672,0.772,2.729
                           c0.283,2.162-0.487,3.549-2.729,4.729c-3.385,1.793-4.319,2.606-4.319,3.709c0,0.57,0.365,1.753,0.813,2.606
                           c0.449,0.814,0.816,1.713,0.816,1.957c0,0.979,4.563,4.646,7.58,6.033c1.266,0.569,4.605,4.482,5.586,6.563
                           c0.487,1.021,1.143,2.078,1.427,2.361c0.244,0.285,0.487,0.896,0.487,1.268c0,0.566,0.448,0.813,1.754,1.02
                           c0.938,0.164,2.688,0.773,3.912,1.347c3.02,1.387,5.504,1.143,9.375-0.938c3.181-1.712,4.646-1.712,5.097,0.081
                           c0.163,0.57,0.813,1.345,1.509,1.712c1.345,0.774,1.753,1.834,1.509,3.872l-0.164,1.386l1.308-0.771
                           c0.73-0.449,3.016-1.104,5.055-1.551c2.077-0.407,3.953-0.938,4.156-1.142c0.447-0.449-0.611-1.632-2.648-3.059
                           c-1.752-1.184-2.607-6.521-1.347-8.273c0.531-0.692,0.692-0.733,1.957-0.205c0.732,0.285,2.038,0.652,2.854,0.733
                           c1.386,0.205,1.589,0.082,1.996-0.938c0.938-2.485,1.468-3.221,2.525-3.75c1.021-0.488,1.306-0.447,2.938,0.529
                           c2.037,1.182,5.138,2.364,5.421,2.078c0.082-0.121,0.041-1.631-0.123-3.383l-0.283-3.18l-4.157,0.121l-4.197,0.123l-1.59-1.508
                           c-1.469-1.388-1.836-1.511-4.935-1.834c-6.972-0.736-8.928-1.755-9.822-5.098c-0.325-1.104-0.611-2.241-0.733-2.525
                           c-0.162-0.531-0.081-0.531-6.889-0.692c-5.828-0.123-7.215-0.61-9.416-3.261c-2.078-2.486-3.099-2.979-6.073-2.854
                           c-1.875,0.082-3.099-0.164-5.38-1.062C381.096,357.309,379.871,357.188,379.871,358.245z" />
              <path class="territory" id="Azamgarh" d="M452.428,360.813c-0.53,0.367-0.53,0.407,0,0.326c2.08-0.203,2.729,1.021,1.793,3.182
                           c-0.366,0.854-0.731,2.24-0.731,3.099c-0.041,0.813-0.287,1.713-0.529,1.957c-0.366,0.367-0.326,0.731,0.16,1.468
                           c0.49,0.733,0.572,1.387,0.285,2.688c-0.162,0.938-0.364,3.793-0.404,6.358c-0.041,3.872-0.203,4.771-0.774,5.176
                           c-0.406,0.285-1.021,0.408-1.508,0.205c-1.916-0.689-6.237-4.4-7.989-6.85c-2.771-3.872-3.14-3.546-3.14,2.936
                           c-0.041,5.91,0.896,10.764,3.628,19.158c0.813,2.405,1.672,5.91,1.916,7.785l0.486,3.344l3.101,3.06
                           c2.565,2.565,3.628,3.301,6.356,4.399c2.242,0.896,3.751,1.833,4.771,2.937c1.224,1.305,1.713,1.549,2.445,1.305
                           c3.384-1.061,5.462-0.489,7.215,2.037c0.896,1.306,1.141,1.428,3.057,1.428c1.877,0,2.202-0.122,3.221-1.428
                           c0.611-0.772,2.039-1.874,3.142-2.444c2.201-1.102,2.606-1.998,1.142-2.483c-2.403-0.693-3.18-3.222-1.468-4.403
                           c1.265-0.896,1.793-0.814,4.28,0.407c2.241,1.144,3.383,1.103,3.383-0.203c0-0.448,0.449-1.306,0.979-1.915l0.938-1.145
                           l-0.813-1.834c-0.527-1.143-0.854-2.771-0.854-4.154c-0.041-1.998,0.122-2.488,1.306-3.792c0.69-0.815,1.303-1.673,1.303-1.875
                           c0-0.245-0.771-0.408-1.752-0.408c-2.977,0-3.508-1.549-1.712-5.055c0.61-1.224,0.938-2.322,0.773-2.935
                           c-0.326-1.307,0.082-1.875,2.895-3.914c3.466-2.567,4.688-4.483,5.341-8.479c0.366-2.446,0.772-3.587,1.592-4.565l1.1-1.304
                           l-1.631-0.61c-1.834-0.733-4.074-2.242-7.582-5.055l-2.444-1.916h-5.015h-5.054l-2.121-1.428l-2.118-1.428l-0.123,1.305
                           c-0.08,0.734,0.041,2.404,0.326,3.67c0.65,3.465-0.447,5.177-3.383,5.218c-1.388,0-1.875-0.325-4.321-2.772
                           c-1.508-1.508-3.587-3.463-4.564-4.358c-1.956-1.753-3.016-4.278-2.565-6.112c0.243-0.979,0.203-1.021-1.713-1.021
                           C453.937,360.365,452.755,360.568,452.428,360.813z" />
              <path class="territory" id="Jalaun"
                d="M170.156,361.873c-1.794,0.691-2.813,0.773-6.686,0.529l-2.608-0.204l-0.896,1.714l-0.938,1.712l1.225,1.101
                           c0.651,0.651,1.63,1.916,2.161,2.854c0.854,1.429,0.938,1.916,0.609,2.854c-0.366,0.938-0.568,1.062-1.794,0.856
                           c-1.141-0.164-1.549-0.042-2.403,0.854c-0.529,0.609-0.938,1.305-0.814,1.59c0.246,0.69-1.1,1.264-2.854,1.225
                           c-0.854-0.042-1.793,0.244-2.117,0.568c-0.57,0.569-0.57,0.732,0,1.834c1.223,2.365,0.528,3.953-2.446,5.666l-1.793,1.061
                           l0.896,1.509c0.447,0.813,1.469,2.201,2.199,3.058c0.735,0.814,1.348,1.795,1.348,2.119c0,0.775-2.979,2.938-4.524,3.263
                           c-0.652,0.161-1.385,0.651-1.631,1.062c-0.53,1.02-0.041,5.258,0.609,5.463c0.245,0.12,2.445,0.366,4.853,0.569
                           c2.405,0.202,4.688,0.608,5.014,0.854c0.938,0.814,0.652,2.242-0.608,3.344c-0.897,0.814-1.104,1.306-0.979,2.119
                           c0.285,1.428,0.979,1.143,1.875-0.692c0.57-1.265,0.896-1.509,1.916-1.509c1.426,0,1.957,0.979,2.322,4.279
                           c0.124,1.104,0.488,2.444,0.772,2.938c0.814,1.305,2.896,2.117,5.503,2.24c1.956,0.082,2.485-0.082,3.587-1.02
                           c1.387-1.144,3.222-1.428,4.035-0.611c0.284,0.285,0.487,1.103,0.487,1.793c0,1.713,0.367,1.916,2.283,1.225
                           c0.896-0.326,2.648-0.814,3.913-1.102c1.998-0.406,2.444-0.406,3.261,0.123c0.653,0.406,1.224,0.527,1.875,0.285
                           c0.734-0.285,0.897-0.652,0.897-2.16c0-1.551,0.161-1.959,1.182-2.649c1.426-1.021,1.63-1.021,3.139-0.245
                           c2.405,1.225,3.425,0.325,1.956-1.752c-0.406-0.57-0.567-1.346-0.406-1.916c0.284-1.061,1.714-1.753,2.404-1.061
                           c0.286,0.283,0.774,0.121,1.589-0.57c1.348-1.143,2.038-1.223,3.914-0.571c1.104,0.367,1.429,0.328,2.364-0.405
                           c0.854-0.651,1.427-0.814,2.568-0.61c2.281,0.366,4.196,1.347,5.666,2.896c1.345,1.426,2.118,1.467,2.118,0.12
                           c0-0.979,0.732-1.468,1.347-0.854c0.609,0.61,1.916,0.569,1.916-0.082c0-0.244-0.367-1.063-0.815-1.711
                           c-1.019-1.552-1.019-2.038,0-3.06c0.692-0.693,1.144-0.772,3.221-0.529c3.344,0.326,4.524-0.406,4.524-2.854
                           c0-1.386-0.245-1.996-1.019-2.73c-1.063-1.019-2.08-3.789-1.632-4.521c0.365-0.57-0.61-1.631-2.118-2.241
                           c-0.979-0.407-1.834-0.448-3.346-0.163c-1.386,0.243-2.402,0.243-3.016-0.041c-2.607-1.184-2.896-1.509-3.627-4.32
                           c-0.938-3.342-1.508-3.871-3.995-3.586c-2.526,0.326-3.75-0.408-4.28-2.446c-0.608-2.363-0.772-2.526-3.343-2.853
                           c-4.36-0.531-5.707-2.406-4.563-6.44c0.487-1.835,0-2.729-1.549-2.729c-1.957,0-4.604-1.998-4.604-3.506
                           c0-0.979-1.266-1.47-2.445-0.938c-3.506,1.59-7.011,1.426-9.131-0.489C175.127,360.977,172.845,360.813,170.156,361.873z" />
              <path class="territory" id="Mau" d="M500.323,374.673c-2.12,0.692-3.425,2.771-4.075,6.438c-0.325,1.795-0.774,3.709-1.063,4.199
                           c-0.733,1.385-4.402,5.135-5.91,6.071c-1.142,0.693-1.305,1.021-1.142,1.916c0.122,0.733-0.163,1.794-0.814,3.14
                           c-1.388,2.729-1.347,3.059,0.407,3.059c3.221,0,3.993,1.957,1.793,4.443c-1.631,1.834-1.834,2.813-1.06,5.42
                           c0.979,3.424,1.265,3.67,4.033,3.345c2.241-0.286,2.526-0.408,5.504-3.306c1.713-1.67,3.506-3.301,3.953-3.625
                           c1.144-0.815,3.83-0.692,8.969,0.405c7.377,1.632,7.011,1.591,7.256,0.285c0.121-0.651,1.142-2.12,2.242-3.343
                           c2.402-2.648,3.016-3.749,2.647-4.729c-0.449-1.304-2.283-2.976-3.222-2.976c-2.241,0-5.096-0.896-5.707-1.835
                           c-1.183-1.834,0.57-3.749,5.666-6.113c3.018-1.387,3.873-2.607,3.181-4.482c-0.326-0.938-0.326-1.631-0.041-2.404
                           c0.326-0.896,0.205-1.468-0.609-3.098c-0.53-1.104-1.184-2.08-1.348-2.201c-0.203-0.122-1.427,0.326-2.688,1.019l-2.281,1.224
                           l-3.222-0.648c-2.977-0.609-3.303-0.609-4.604,0.04c-1.388,0.652-1.47,0.652-3.304-0.407c-1.021-0.609-2.079-1.346-2.323-1.672
                           C501.993,374.143,501.993,374.143,500.323,374.673z" />
              <path class="territory unsco" id="Fatehpur"
                d="M273.036,380.705c-0.448,0.773-1.102,1.223-2.079,1.428c-0.856,0.162-2.038,0.854-2.978,1.834
                           c-1.265,1.264-2.119,1.711-4.076,2.118c-2.403,0.488-2.566,0.61-7.46,5.585c-4.646,4.688-6.604,7.297-6.604,8.846
                           c0,0.326-0.653,1.347-1.468,2.241c-1.549,1.714-1.549,1.714,0.854,2.242c0.692,0.164,2.446,0.813,3.913,1.427
                           c2.527,1.143,2.854,1.184,5.259,0.773c1.429-0.202,2.689-0.487,2.854-0.569c0.285-0.163,4.688,0.326,7.337,0.854
                           c0.772,0.162,1.671,0.449,1.997,0.69c0.285,0.246,0.938,0.654,1.427,0.897c1.957,0.979,0.979,4.359-1.427,4.852
                           c-1.63,0.326-2.404,0.938-2.404,1.915c0,0.611,0.285,0.772,1.428,0.772c2.936,0,4.975,1.875,4.523,4.117
                           c-0.366,1.876,1.224,2.813,4.729,2.813c2.241,0,3.058,0.162,3.871,0.813c1.348,1.061,1.674,1.061,6.236-0.406
                           c4.076-1.307,5.096-1.307,6.889,0.041c0.61,0.447,2.038,0.938,3.179,1.142c2.609,0.407,3.386,0.979,3.386,2.649
                           c0,1.427,0.854,2.854,2.039,3.505c0.609,0.326,1.1,0.205,2.28-0.611c1.348-0.896,1.633-0.979,2.365-0.446
                           c1.102,0.69,1.265,1.632,0.651,3.506c-0.774,2.361,0.203,4.196,2.935,5.462c2.937,1.386,5.83,2.283,7.174,2.283
                           c1.877,0,2.69,0.854,2.405,2.606c-0.123,0.814-0.081,1.467,0.082,1.467c0.202,0,1.184-1.141,2.24-2.524
                           c1.55-2.121,1.876-2.854,1.876-4.32c0-2.119-0.814-3.832-2.364-4.934c-0.771-0.529-1.508-1.671-2.078-3.303l-0.896-2.444
                           l1.102-2.444c1.104-2.446,1.467-2.854,6.236-6.687c1.346-1.143,2.484-2.242,2.484-2.567c0-0.854-2.484-3.383-3.627-3.669
                           c-2.771-0.691-5.667-4.523-6.072-8.109l-0.162-1.713l-2.12,0.204c-1.875,0.163-2.323,0.04-4.688-1.347
                           c-2.526-1.508-4.036-3.303-4.729-5.463c-0.489-1.631-0.979-1.998-2.938-2.28c-1.794-0.245-5.545,0.325-10.476,1.711
                           c-2.977,0.854-4.441,0.733-5.707-0.448c-0.569-0.529-1.061-1.305-1.061-1.711c0-0.408-0.204-1.428-0.448-2.283
                           c-0.326-1.265-0.733-1.712-2.119-2.363c-0.979-0.407-2.648-0.772-3.831-0.772c-1.712,0-2.486-0.245-3.954-1.267
                           c-0.979-0.69-1.957-1.672-2.201-2.159c-1.468-3.263-2.363-4.892-2.729-5.015C273.893,379.605,273.405,380.053,273.036,380.705z" />
              <path class="territory" id="Ballia" d="M524.781,380.582c-0.408,0.408-0.53,0.938-0.367,1.348c1.347,3.057,0.121,5.137-4.156,7.174
                           c-1.712,0.814-3.587,1.955-4.158,2.527c-1.02,1.018-1.02,1.1-0.282,1.385c0.446,0.164,1.873,0.448,3.22,0.61
                           c2.771,0.327,4.812,1.795,5.544,4.036c0.611,1.834-0.123,3.506-2.813,6.48c-1.143,1.264-2.077,2.606-2.077,3.018
                           c0,0.404,0.487,1.018,1.141,1.385c0.611,0.366,2.445,1.794,4.116,3.221c2.445,2.037,3.751,2.771,6.851,3.914
                           c5.136,1.832,6.193,2.403,6.479,3.627c0.407,1.551-0.08,4.116-1.264,7.012c-1.103,2.688-1.021,3.303,0.487,4.646
                           c0.69,0.651,0.854,0.651,2.078,0.041c2.364-1.144,4.894-4.403,5.829-7.5c1.753-5.788,4.361-6.687,9.579-3.262
                           c1.672,1.101,3.587,2.118,4.197,2.282c1.673,0.364,4.199-1.021,6.727-3.67c2.08-2.158,2.487-2.361,4.239-2.281
                           c1.063,0.041,4.402,2.977,4.771,4.156c0.325,1.021,2.28,1.998,4.033,1.998c0.855,0,2.854-0.773,5.38-2.037
                           c2.446-1.223,4.524-2.039,5.342-2.039h1.387l-2.771-3.303c-2.937-3.545-3.912-4.197-7.459-4.646
                           c-3.629-0.49-3.994-0.732-5.342-3.751c-0.691-1.55-1.385-3.06-1.549-3.386c-0.244-0.445-1.142-0.609-3.547-0.65
                           c-2.689,0-3.586-0.203-5.38-1.102c-2.689-1.428-5.055-3.752-6.358-6.316c-1.305-2.566-3.586-4.604-7.217-6.439
                           c-1.629-0.771-3.871-2.078-5.053-2.854c-2.078-1.389-2.201-1.43-4.035-0.938c-2.119,0.529-7.297,0.284-9.741-0.447
                           c-0.979-0.284-2.444-1.346-3.792-2.69C526.45,379.768,525.84,379.564,524.781,380.582z" />
              <path class="territory" id="Jaunpur" d="M429.846,383.15c-0.366,0.367-0.651,0.938-0.651,1.225c0,1.141-1.265,2.854-2.403,3.22
                           c-1.265,0.448-2.771,0.203-4.481-0.692c-0.815-0.446-0.856-0.405-0.856,1.348c0,2.566,0.569,3.709,2.364,4.934
                           c1.996,1.305,2.689,2.688,2.037,4.034c-0.529,1.226-0.813,1.347-5.341,2.282c-4.4,0.938-5.543,1.59-5.299,3.018
                           c0.447,2.322-0.854,3.791-3.994,4.483c-0.61,0.122-1.631,0.896-2.243,1.711c-2.647,3.263-3.342,3.791-5.787,4.481
                           c-1.385,0.367-2.565,0.938-2.688,1.226c-0.081,0.244,0.081,1.347,0.405,2.442c0.692,2.324,0.733,4.443,0.082,6.318
                           c-0.527,1.63-2.566,4.688-3.872,5.91l-0.896,0.813l4.359,2.039c3.344,1.508,5.056,2.606,7.421,4.729
                           c3.423,3.097,4.563,3.587,8.764,3.587c3.179,0,3.261,0.039,4.77,2.119c1.225,1.589,2.282,2.079,6.439,2.771
                           c3.22,0.568,4.563,1.263,5.747,2.895c0.896,1.305,2.936,2.403,4.441,2.403c0.611,0,0.814-0.285,0.814-0.979
                           c0-1.386,0.651-2.936,1.672-4.034c0.854-0.896,0.854-1.59,0.164-4.481c-0.449-1.754,0.446-3.425,2.199-3.994
                           c0.813-0.285,2.241-1.021,3.221-1.673c1.711-1.184,1.793-1.184,3.301-0.61c1.186,0.488,1.958,0.528,3.345,0.244
                           c1.631-0.366,3.425-0.284,5.421,0.326c0.406,0.122,1.143,1.102,1.631,2.241l0.896,1.997l2.119-2.241
                           c2.2-2.404,3.343-2.813,4.605-1.631c0.691,0.65,0.772,0.609,1.102-0.284c0.204-0.53,0.488-2.323,0.651-3.913
                           c0.285-2.854,0.244-3.02-0.979-4.813c-1.428-2.077-2.647-2.567-4.934-1.876c-1.914,0.571-3.994-0.122-5.055-1.753
                           c-0.447-0.649-1.875-1.507-3.952-2.364c-2.73-1.101-3.914-1.916-6.81-4.687l-3.546-3.302l-0.529-3.792
                           c-0.243-2.119-0.979-5.179-1.55-6.89c-0.609-1.672-1.834-6.072-2.729-9.742l-1.672-6.687l-1.711-0.487
                           c-0.938-0.283-2.526-0.979-3.506-1.59C430.578,382.458,430.496,382.417,429.846,383.15z" />
              <path class="territory" id="Hamirpur"
                d="M226.651,385.229c-0.041,0.326-0.569,1.754-1.224,3.183c-1.467,3.343-1.386,5.177,0.325,7.338
                           c1.061,1.385,1.265,1.956,1.265,3.831s-0.163,2.361-1.061,3.22c-0.896,0.855-1.469,0.979-4.158,1.062
                           c-1.711,0.041-3.179,0.082-3.219,0.082c-0.082,0.039,0.283,0.772,0.771,1.711c1.185,2.283,0.693,3.793-1.223,3.953
                           c-0.773,0.082-1.712,0.49-2.161,0.938c-1.101,1.104-1.793,0.979-3.75-0.773c-2.976-2.647-5.136-3.301-6.848-2.037
                           c-1.021,0.772-1.306,0.813-2.978,0.365c-1.834-0.447-3.098-0.283-3.098,0.407c0,0.651-1.754,1.103-2.528,0.692
                           c-0.896-0.448-0.938,0-0.122,1.063c0.734,0.979,0.815,3.139,0.122,3.83c-0.69,0.691-2.729,0.61-4.157-0.123
                           c-1.59-0.813-2.199-0.242-2.362,2.161c-0.122,1.793-0.245,1.957-1.712,2.688c-1.51,0.732-1.673,0.732-2.813,0.121
                           c-1.671-0.979-1.834-0.896-2.16,1.185c-0.163,1.224-0.772,2.526-1.875,3.953c-1.59,2.079-1.59,2.161-1.345,4.771
                           c0.244,2.567,1.02,4.076,2.079,4.076c0.285,0,0.979,0.569,1.548,1.264c0.896,1.062,1.021,1.509,0.814,2.772
                           c-0.162,0.813-0.447,1.671-0.651,1.914c-0.366,0.488,2.365,1.386,4.239,1.386c0.528,0,1.346,0.287,1.834,0.61
                           c1.061,0.733,7.825,1.225,10.107,0.733c1.266-0.284,1.753-0.651,2.241-1.632c0.815-1.711,5.462-5.421,6.768-5.421
                           c1.225,0,2.445-0.609,3.831-1.874c1.712-1.59,2.896-1.631,4.279-0.124c1.55,1.631,2.854,2.119,3.914,1.553
                           c0.652-0.328,1.06-0.286,1.834,0.201c0.938,0.652,0.979,0.611,2.201-1.019c0.651-0.938,1.224-1.877,1.224-2.08
                           c0-0.529,1.184-0.365,2.241,0.325c1.021,0.652,1.386,2.323,0.652,2.813c-0.489,0.285,0.204,2.404,0.979,3.058
                           c0.366,0.326,0.814,0.205,1.671-0.528c2.079-1.713,3.181-1.713,5.016-0.041c0.896,0.772,2.159,1.59,2.771,1.754
                           c0.653,0.162,1.387,0.772,1.673,1.385c0.284,0.611,0.814,1.103,1.143,1.103s1.06,0.285,1.589,0.65
                           c0.979,0.611,0.979,0.611,1.427-1.142c1.183-4.604,2.08-5.911,3.627-5.422c1.021,0.325,1.957-0.164,2.609-1.305
                           c0.285-0.488,1.059-1.712,1.793-2.73l1.304-1.875l-1.019-1.183l-0.979-1.183l0.856-1.469c0.813-1.427,0.813-1.427,0.041-3.18
                           c-0.57-1.348-1.183-1.957-2.69-2.689c-1.06-0.529-2.201-1.427-2.567-1.998c-0.651-0.978-0.651-1.06,0.082-1.589
                           c0.407-0.327,1.021-0.569,1.347-0.569c0.285,0,1.712-0.854,3.18-1.875c3.668-2.607,3.505-3.67-0.896-5.586
                           c-1.386-0.609-3.14-1.222-3.871-1.345c-0.774-0.163-1.834-0.61-2.405-1.021c-0.571-0.367-1.671-0.772-2.446-0.854
                           c-1.1-0.082-1.549-0.407-1.956-1.306c-0.408-0.771-1.305-1.467-2.729-2.119c-2.527-1.102-2.937-1.914-2.038-4.157
                           c0.367-0.896,0.61-2.159,0.529-2.813l-0.122-1.142l-3.67-0.081c-4.156-0.082-6.357-0.814-7.417-2.404
                           c-0.652-1.02-0.652-1.143,0.121-2.567c0.61-1.021,0.732-1.793,0.528-2.485C226.814,385.066,226.651,384.902,226.651,385.229z" />
              <path class="territory" id="Pratapgarh"
                d="M353.255,387.676c-0.731,0.814-1.507,1.223-2.282,1.223c-1.426,0-1.793,0.979-1.021,2.854
                           c0.692,1.59,0.733,3.505,0.123,3.913c-0.283,0.162,0,0.732,0.773,1.549c3.181,3.344,2.771,5.951-0.938,5.951
                           c-2.647,0-6.235,1.916-10.107,5.381c-1.835,1.671-3.832,3.18-4.401,3.303c-0.854,0.203-1.183,0.651-1.591,2.078
                           c-0.487,1.793-0.487,1.793,1.265,4.157c1.713,2.242,2.363,3.424,4.688,7.989c1.183,2.283,2.936,3.83,5.055,4.4
                           c0.855,0.244,2.119,0.896,2.771,1.428c0.65,0.569,2.077,1.387,3.138,1.836l1.957,0.854l1.306-1.467
                           c1.508-1.631,1.875-1.713,3.464-0.734c1.103,0.611,1.266,0.611,3.019-0.041c3.18-1.223,3.75-1.915,4.278-5.136
                           c0.529-3.425,1.713-5.951,2.896-6.316c0.57-0.165,1.672,0.12,3.018,0.773c2.647,1.304,2.771,1.304,5.463,0.04
                           c1.996-0.938,6.604-1.753,8.438-1.509c1.021,0.123,1.427,0.772,1.427,2.323c0,0.979,0.284,1.428,1.348,2.038
                           c0.69,0.406,2.239,1.672,3.424,2.771c1.834,1.711,2.282,1.955,3.261,1.711c0.611-0.121,1.793-1.021,2.648-1.916
                           c3.018-3.302,3.833-6.479,2.566-10.107c-1.061-3.058-0.285-4.278,3.587-5.461c2.486-0.733,2.607-0.854,4.077-3.1
                           c1.102-1.671,3.302-3.261,4.605-3.261c1.916,0,2.936-2.405,1.508-3.468c-0.529-0.404-0.692-1.06-0.61-2.729
                           c0.081-1.916-0.042-2.199-0.813-2.566c-0.531-0.243-1.226-1.021-1.55-1.713c-0.734-1.588-0.938-1.629-2.527-0.487
                           c-1.59,1.143-5.665,2.403-7.744,2.403c-0.896,0-2.567-0.486-3.914-1.101c-2.16-1.063-2.812-1.146-9.455-1.428
                           c-3.914-0.163-7.868-0.407-8.765-0.53c-1.468-0.244-1.876-0.081-3.669,1.184c-2.242,1.631-4.32,2.688-5.299,2.688
                           c-0.367,0-1.266-0.61-1.997-1.344c-0.775-0.693-1.875-1.755-2.446-2.242l-1.062-0.979l-1.061,0.854
                           c-1.304,1.021-2.281,0.651-3.22-1.306c-0.854-1.795-3.587-5.707-4.116-5.868C354.52,386.492,353.865,386.982,353.255,387.676z" />
              <path class="territory" id="Jhansi"
                d="M145.29,404.958c-0.571,0.569-1.021,1.428-1.021,1.957c0,0.487-0.65,1.589-1.509,2.444
                           c-1.468,1.469-1.468,1.51-0.773,2.566c0.896,1.389,0.692,3.426-0.446,4.158c-0.815,0.566-0.938,0.488-1.549-0.691
                           c-0.856-1.633-1.755-1.469-2.446,0.528c-0.692,1.998-1.266,2.604-2.689,2.935c-1.672,0.367-1.794,0.855-0.487,1.918
                           c2.322,1.957,2.935,2.729,3.342,4.237c1.101,3.912,0.408,4.729-5.34,6.358c-0.856,0.244-2.609,1.386-3.995,2.646l-2.446,2.242
                           l-1.671-0.813c-1.712-0.855-2.446-0.773-4.117,0.405c-0.854,0.611-4.034-0.119-5.707-1.345l-1.141-0.813l-1.834,1.711l-1.876,1.714
                           l-1.63-0.529c-1.387-0.49-1.711-0.49-1.997,0c-0.204,0.325-0.204,0.772-0.042,1.021c0.204,0.201,0.447,1.265,0.569,2.281
                           c0.244,1.752,0.163,1.956-1.265,3.303c-0.814,0.772-2.404,1.753-3.465,2.118c-1.103,0.408-2.079,1.063-2.161,1.429
                           c-0.122,0.364-0.487,1.183-0.854,1.875c-0.365,0.65-1.02,1.875-1.427,2.688l-0.772,1.509l1.672,3.994
                           c0.896,2.243,1.997,4.525,2.443,5.139c0.447,0.609,0.814,1.306,0.814,1.591c0,0.244,0.815,1.508,1.793,2.813
                           c0.979,1.265,1.916,2.73,2.08,3.263c0.204,0.65,0.489,0.813,1.142,0.65c0.488-0.123,1.103-0.244,1.347-0.244
                           c0.245,0,0.938-0.69,1.508-1.59c0.854-1.305,1.427-1.672,3.138-2.079c1.753-0.408,2.201-0.408,3.061,0.163
                           c1.182,0.773,1.589,0.326,1.223-1.346c-0.449-2.079-2.937-3.71-5.584-3.71c-1.427,0-4.402-0.814-4.402-1.223
                           c0-0.123,1.348-0.57,2.978-0.979c1.59-0.408,3.261-0.816,3.669-0.938c0.408-0.08,0.978-0.608,1.345-1.143
                           c0.489-0.773,0.53-1.142,0.163-1.834c-0.407-0.733-0.366-1.02,0.122-1.507c0.571-0.57,0.692-0.49,1.264,0.651
                           c0.692,1.265,1.752,1.63,2.568,0.813c0.285-0.285,0.081-1.021-0.652-2.445c-0.854-1.631-0.937-2.079-0.487-2.362
                           c0.979-0.61,4.563-0.938,5.137-0.448c0.408,0.325,0.732,0.163,1.345-0.693c0.448-0.609,0.938-1.549,1.103-2.078
                           c0.202-0.771,0.528-0.938,1.55-0.813c1.182,0.123,1.305,0.245,1.305,1.55c0,1.141-0.204,1.508-1.101,1.955
                           c-1.471,0.691-1.429,1.102,0.081,1.998c0.691,0.365,1.224,0.854,1.224,1.06c0,0.164,0.854,0.693,1.956,1.185
                           c1.06,0.487,2.038,0.979,2.161,1.061c0.731,0.367,1.508-1.223,1.304-2.566c-0.163-1.021-0.041-1.673,0.448-2.16
                           c0.609-0.691,0.568-0.814-0.489-1.589c-0.611-0.448-1.711-1.104-2.404-1.511c-1.101-0.528-1.345-0.896-1.345-1.998
                           c0-2.157,0.979-3.138,3.138-3.138c1.592,0,2.039,0.204,3.223,1.468c0.771,0.774,1.386,1.875,1.386,2.404
                           c0,1.468,0.407,2.242,1.223,2.242c1.387,0,1.671-0.979,1.549-5.666l-0.122-4.564l1.347-1.223c2.688-2.405,5.014-0.693,5.299,3.831
                           c0.123,2.2,0,2.688-0.854,3.75l-1.021,1.224l2.405,2.689c1.997,2.24,2.401,2.976,2.401,4.197c0,1.225-0.202,1.551-1.06,1.876
                           c-1.468,0.568-1.997,0.527-3.058-0.366l-0.979-0.815l0.897-0.65c0.527-0.366,1.142-1.021,1.345-1.469
                           c0.771-1.428-1.712-0.979-3.75,0.652c-0.979,0.772-2.979,2.241-4.443,3.22c-2.976,2.038-3.505,2.526-3.709,3.709
                           c-0.081,0.653,0.081,0.815,0.938,0.692c1.712-0.162,2.282,0.896,1.467,2.607c-0.855,1.754-0.855,2.199-0.081,2.199
                           c0.326,0,1.63-1.549,2.895-3.505c2.486-3.75,3.467-4.646,4.975-4.646c2.08,0,3.71,3.384,2.444,4.933
                           c-0.486,0.611-2.729,1.427-4.563,1.672c-1.143,0.163-1.998,2.937-1.468,4.646c0.245,0.691,0.325,2.037,0.161,2.977
                           c-0.202,1.387-0.161,1.672,0.406,1.672c0.326,0,1.104-0.691,1.631-1.55c1.225-1.955,3.71-4.157,4.688-4.157
                           c0.407,0,1.061,0.367,1.468,0.815c1.063,1.182,1.226,0.73,0.367-1.428c-0.774-2.077-0.489-2.648,1.345-2.648
                           c0.734,0,5.789,4.32,5.381,4.646c-0.08,0.04-0.896,0.365-1.793,0.691c-1.754,0.652-2.16,1.508-1.631,3.546l0.284,1.103l0.653-0.896
                           c0.978-1.304,4.44-2.976,4.932-2.402c0.163,0.243,0.448,1.346,0.571,2.402c0.204,2.283,0.978,3.262,2.935,3.832
                           c1.672,0.53,1.997,0.204,1.631-1.468c-0.365-1.712,0.284-1.835,2.896-0.611c1.997,0.938,2.648,1.062,5.299,0.896
                           c3.669-0.243,4.646-0.938,4.646-3.222c0-0.854-0.161-1.672-0.406-1.794c-0.204-0.122-0.407-0.854-0.407-1.549
                           c0-0.73-0.286-1.672-0.612-2.078c-0.325-0.447-0.608-1.183-0.608-1.631c0-1.345-1.429-3.302-2.772-3.872
                           c-0.691-0.286-1.385-0.896-1.548-1.346c-0.326-1.143,0.611-3.181,1.467-3.181c0.408,0,1.266-0.651,1.916-1.429
                           c0.611-0.813,1.712-2.118,2.405-2.976c1.223-1.469,2.729-5.137,2.854-6.809c0-0.447,0.041-1.306,0.082-1.875
                           c0.041-0.609,0.691-1.997,1.469-3.1c2.037-2.976,2.037-4.076,0.041-5.503c-0.896-0.611-1.834-1.1-2.079-1.141
                           c-0.57,0-1.185-6.441-0.774-7.826c0.163-0.531,0.856-1.508,1.508-2.201c0.653-0.693,1.348-1.957,1.551-2.771
                           c0.365-1.752,0.04-1.834-2.937-0.771c-1.753,0.609-1.956,0.609-2.935-0.041c-0.815-0.489-1.063-1.021-1.063-2.08
                           c0-1.712-0.569-1.792-2.12-0.324c-1.1,1.062-1.386,1.103-4.399,1.021c-2.242-0.082-3.668-0.326-4.565-0.815
                           c-1.875-1.06-3.179-3.139-3.179-5.013c0-0.856-0.204-2.039-0.448-2.69l-0.449-1.142l-0.405,1.019
                           c-1.267,3.342-4.402,3.303-4.976-0.08c-0.244-1.265-0.081-1.672,0.979-2.937l1.265-1.427l-1.346-0.203
                           c-0.734-0.123-2.731-0.326-4.402-0.449c-1.671-0.121-3.383-0.326-3.75-0.447C146.594,404.021,145.903,404.348,145.29,404.958z" />
              <path class="territory" id="Ghazipur" d="M499.55,410.094c-1.917,1.877-3.71,3.549-3.954,3.711c-0.284,0.161-1.794,0.407-3.384,0.569
                           c-3.019,0.284-4.318,0.979-4.318,2.323c0,1.02-1.429,2.363-2.528,2.363c-0.527,0-1.834-0.449-2.976-1.021
                           c-1.104-0.528-2.283-1.021-2.568-1.021c-1.062,0-0.285,1.429,1.063,1.998c1.387,0.61,1.956,1.833,1.548,3.221
                           c-0.161,0.449-1.344,1.387-2.648,2.079c-1.549,0.813-2.688,1.793-3.261,2.688c-0.774,1.346-0.938,1.428-3.058,1.428h-2.201
                           l-0.325,3.14c-0.122,1.755-0.53,3.873-0.815,4.771c-0.568,1.507-0.527,1.629,0.652,2.977c0.691,0.731,1.225,1.55,1.225,1.753
                           c0,0.938,2.241,0.285,4.196-1.184c1.185-0.854,2.73-1.712,3.466-1.835c1.956-0.446,5.422,0.449,7.785,1.997
                           c2.2,1.468,3.506,1.59,4.935,0.408c0.324-0.285,1.223-0.693,1.995-0.938c1.225-0.449,1.51-0.367,2.649,0.568
                           c0.691,0.569,1.876,1.427,2.648,1.916c1.956,1.225,5.991,8.521,6.357,11.413c0.488,3.872,0.244,3.75,3.994,1.834
                           c1.835-0.979,4.729-2.771,6.399-4.034c3.423-2.607,8.561-7.745,8.561-8.603c0-1.224,2.161-3.628,4.198-4.646
                           c1.181-0.609,3.22-1.834,4.563-2.771c1.306-0.896,2.608-1.793,2.813-1.956c0.285-0.162,0.082-0.651-0.488-1.224
                           c-1.793-1.915-1.875-3.14-0.486-6.604c0.649-1.712,1.223-3.749,1.223-4.524c0-1.629-0.284-1.832-5.951-3.83
                           c-2.854-1.021-4.321-1.834-6.114-3.383c-4.319-3.668-5.136-4.076-11.087-5.341c-3.098-0.651-6.727-1.266-8.109-1.387l-2.568-0.203
                           L499.55,410.094z" />
              <path class="territory" id="Banda"
                d="M259.911,408.668c-0.856,0.326-1.793,0.486-2.079,0.367c-0.449-0.164-0.53,0.16-0.367,1.549l0.204,1.753
                           l-3.1,2.362c-1.712,1.265-3.424,2.322-3.791,2.322c-0.405,0.041,0.245,0.489,1.469,1.104c1.834,0.896,2.322,1.346,3.139,3.139
                           c1.102,2.404,1.183,2.936,0.408,4.32c-0.53,0.896-0.489,1.182,0.286,2.526l0.896,1.509l-0.938,1.224
                           c-0.488,0.69-0.896,1.426-0.896,1.67c0,0.205-0.366,0.611-0.813,0.896c-0.449,0.285-0.814,0.731-0.814,0.979
                           c0,1.184-1.469,2.283-3.18,2.322c-1.711,0.082-1.753,0.123-2.365,2.12c-0.325,1.102-0.772,3.424-0.938,5.095
                           c-0.489,4.812-1.592,5.952-4.076,4.441c-1.711-1.02-2.242-0.979-1.51,0.123c0.529,0.814,0.529,1.224,0.042,3.14
                           c-0.325,1.226-0.854,2.607-1.183,3.101c-0.73,1.1-0.488,1.426,0.979,1.426c1.507,0,3.627-2.283,3.951-4.319
                           c0.124-0.854,0.448-1.712,0.692-1.876c0.897-0.611,3.14-0.285,5.421,0.774c1.305,0.567,2.568,1.02,2.813,0.979
                           s0.65,0.162,0.854,0.448c0.652,0.813,0.938,6.274,0.449,7.703c-0.408,1.144-0.326,1.347,1.182,2.771
                           c0.855,0.855,2.037,1.672,2.608,1.794c1.712,0.449,3.179,1.875,3.709,3.628c0.449,1.551,0.449,1.713-0.407,2.322
                           c-4.604,3.262-4.81,3.507-4.646,5.3c0.162,1.468,0,1.915-0.938,2.896c-1.305,1.388-2.895,1.834-4.358,1.265
                           c-0.857-0.326-1.186-0.244-1.755,0.366c-0.609,0.693-0.609,0.896,0.447,3.018c1.509,3.1,1.957,3.465,3.507,2.568
                           c1.632-0.938,3.018-0.856,3.709,0.121c0.529,0.772,0.651,0.813,1.225,0.203c0.609-0.568,0.568-0.773-0.163-2.038l-0.815-1.385
                           l1.55-1.021c0.855-0.571,1.957-1.346,2.486-1.712c1.346-0.979,2.567-0.285,4.32,2.485c1.508,2.321,2.976,3.262,4.359,2.854
                           c1.143-0.365,0.979-0.813-1.02-2.444c-1.263-1.02-1.997-2.076-2.444-3.344c-0.365-1.059-0.65-1.956-0.65-1.995
                           c0-0.124,3.138,0.855,4.481,1.346c0.325,0.163,0.896,0.204,1.265,0.163c0.365-0.041,0.896,0.202,1.183,0.568
                           c1.264,1.508,2.813-0.406,2.038-2.483c-0.57-1.43-0.489-3.141,0.122-3.995c0.489-0.652,0.571-0.652,1.061-0.082
                           c0.284,0.326,0.61,1.387,0.732,2.28c0.204,1.39,0.53,1.878,1.712,2.65c0.815,0.489,1.793,1.304,2.161,1.794
                           c0.489,0.57,1.182,0.854,2.242,0.854c0.813,0,2.079,0.202,2.813,0.486c0.692,0.245,1.589,0.326,1.956,0.205
                           c0.571-0.205,0.571-0.407,0.204-1.182c-0.285-0.531-0.611-1.227-0.773-1.55c-0.161-0.326-1.265-1.267-2.444-2.039l-2.161-1.469
                           l0.082-3.83c0.082-3.467,0.204-3.994,1.142-5.22c0.57-0.771,1.55-1.549,2.201-1.794l1.184-0.406l-0.244-3.425
                           c-0.326-3.913,0.202-5.054,2.362-5.054c2.69,0,5.748-2.486,8.03-6.645c1.061-1.877,1.752-2.568,3.342-3.345
                           c1.062-0.57,2.405-1.02,2.977-1.02c1.103,0,2.283-1.347,2.283-2.527c0-0.366,0.365-0.896,0.814-1.142
                           c0.979-0.529,1.021-1.144,0.122-3.709c-0.611-1.631-0.611-2.2-0.203-3.344c0.771-2.199,0.608-2.566-0.652-1.388
                           c-1.428,1.388-2.323,1.388-4.238,0.082c-1.103-0.732-1.631-1.508-1.997-2.771c-0.243-0.938-0.528-1.958-0.61-2.243
                           c-0.082-0.244-0.773-0.488-1.549-0.488c-0.776,0-2.405-0.528-3.709-1.223l-2.283-1.226l-3.914,1.267
                           c-4.156,1.346-6.113,1.385-7.459,0.162c-0.447-0.407-1.507-0.611-3.301-0.611c-3.832,0-6.441-1.956-5.87-4.44
                           c0.326-1.552-0.938-2.486-3.302-2.486c-1.793,0-2.364-0.408-2.731-2.037c-0.325-1.43,1.104-3.1,3.183-3.751
                           c1.712-0.57,2.361-1.712,1.141-2.078c-0.407-0.164-1.02-0.448-1.345-0.651C267.412,408.504,262.031,407.893,259.911,408.668z" />
              <path class="territory" id="Kaushambi"
                d="M331.162,418.777c-0.652,0.488-1.509,1.183-1.835,1.549c-0.325,0.365-1.508,1.387-2.607,2.241
                           c-1.225,0.979-2.363,2.321-2.896,3.506c-0.854,1.835-0.854,1.997-0.245,3.954c0.448,1.346,1.021,2.242,1.794,2.688
                           c1.632,0.979,2.73,3.424,2.73,6.032c0,1.997-0.204,2.445-1.997,4.933c-1.103,1.47-2.936,3.548-4.077,4.565
                           c-1.67,1.508-1.996,1.996-1.629,2.445c0.243,0.324,0.896,0.568,1.426,0.568c1.511,0,3.751,1.551,4.688,3.263
                           c0.488,0.896,1.101,1.67,1.386,1.793c0.244,0.081,1.55-0.405,2.896-1.063c2.648-1.385,5.341-1.711,6.48-0.73
                           c0.528,0.445,0.651,1.019,0.528,2.443c-0.163,1.753-0.081,1.956,1.062,2.69c1.102,0.731,1.63,0.813,4.117,0.527
                           c7.541-0.854,7.499-0.854,8.273-2.402c0.528-1.063,1.183-1.631,2.729-2.241c2.039-0.815,3.669-1.835,5.136-3.182
                           c0.855-0.772,1.063-2.937,0.326-3.384c-0.771-0.448-1.997-3.547-1.997-5.097c0-0.813,0.245-2.201,0.57-3.099
                           c0.488-1.429,0.488-1.713,0-2.2c-0.286-0.326-0.733-1.469-0.938-2.569c-0.529-2.854-0.979-3.097-2.282-1.1
                           c-0.611,0.896-1.266,1.672-1.468,1.672c-0.733,0-6.316-2.771-6.85-3.384c-0.285-0.367-1.224-0.856-2.079-1.103
                           c-2.403-0.649-4.688-2.565-5.868-4.974c-1.957-3.913-5.341-9.293-5.869-9.293C332.508,417.84,331.855,418.287,331.162,418.777z" />
              <path class="territory mice" id="Prayagraj" d="M379.466,422.324c-0.773,0.161-2.241,0.69-3.263,1.141c-1.955,0.938-4.074,1.144-4.688,0.53
                           c-0.244-0.245-1.102-0.692-1.957-1.063l-1.548-0.649l-0.733,1.752c-0.449,0.979-0.896,2.771-1.062,3.994
                           c-0.162,1.224-0.569,2.647-0.896,3.182c-0.569,0.896-5.055,3.342-6.112,3.342c-0.815,0-0.611,1.956,0.324,3.222
                           c0.814,1.102,0.814,1.224,0.203,3.059c-0.938,2.771-0.813,4.32,0.57,6.479c1.753,2.813,1.468,5.91-0.611,7.012
                           c-0.448,0.203-1.386,0.773-2.037,1.265c-0.691,0.449-2.08,1.145-3.099,1.55c-2.16,0.772-2.568,1.711-2.445,5.339
                           c0.082,1.553-0.123,2.324-0.732,3.141c-1.143,1.428-0.611,3.182,0.938,3.182c1.753,0,2.526,1.265,2.771,4.482
                           c0.122,1.265,0.284,1.467,1.467,1.63c0.733,0.122,1.347,0.327,1.306,0.489c0,0.203,0,0.487,0,0.65s-0.529,0.651-1.224,1.021
                           c-1.347,0.814-1.509,1.388-0.651,2.525c0.448,0.651,1.102,0.774,4.197,0.774l3.67,0.04l2.118,1.916
                           c2.405,2.16,4.036,2.771,7.582,2.771c1.347,0,3.099,0.122,3.872,0.245l1.428,0.245l-0.164,3.505
                           c-0.162,4.482,0.49,7.541,1.875,8.604c1.184,0.979,4.239,2.159,9.092,3.546c1.915,0.528,3.75,1.101,4.076,1.183
                           c0.447,0.122,1.182-0.65,2.362-2.403c0.938-1.429,3.425-4.198,5.544-6.114c5.789-5.339,6.849-6.89,8.438-12.597
                           c1.307-4.646,1.307-4.81,0.651-6.194c-0.487-1.061-1.752-2.119-4.769-4.074c-2.979-1.916-4.28-3.018-4.729-4.036
                           c-1.223-2.486,0.082-4.811,3.629-6.479c2.568-1.225,3.75-2.526,4.158-4.646c0.326-1.835,1.304-3.791,1.834-3.791
                           c0.611,0,1.792-2.69,1.508-3.465c-0.162-0.367-0.896-0.896-1.672-1.224c-1.713-0.732-3.098-2.405-3.098-3.751
                           c0-0.611,0.527-1.51,1.264-2.2c0.693-0.651,1.101-1.184,0.896-1.184c-0.161,0-1.549-1.101-3.057-2.484
                           c-2.039-1.794-3.954-3.019-7.339-4.605c-2.525-1.184-5.298-2.282-6.194-2.404c-1.102-0.161-2.2-0.854-3.914-2.403
                           c-1.305-1.185-2.936-2.566-3.626-3.1c-0.896-0.691-1.267-1.305-1.267-2.159c0-1.144-0.08-1.183-1.711-1.144
                           C381.666,421.997,380.24,422.158,379.466,422.324z" />
              <path class="territory htrsr" id="Mahoba" d="M214.992,433.369c-0.531,0.854-4.036,2.813-5.017,2.813c-1.264,0-5.666,3.465-5.951,4.729
                           c-0.527,1.998-1.916,2.405-8.068,2.364c-4.443,0-5.748-0.162-6.318-0.651c-0.406-0.326-1.468-0.734-2.363-0.855
                           c-0.896-0.122-2.281-0.365-3.14-0.527c-1.712-0.286-2.323,0.405-2.405,2.729c-0.08,2.323-1.712,6.932-2.976,8.275
                           c-1.508,1.631-2.038,2.934-1.266,3.262c0.326,0.121,0.691,0.896,0.855,1.752c0.326,1.835,1.916,4.076,3.139,4.442
                           c0.488,0.163,1.387,0.609,1.997,1.019c1.266,0.896,1.834,0.531,2.771-1.63c0.528-1.305,0.979-1.59,1.427-0.854
                           c0.123,0.201,0.57,0.405,1.02,0.405c0.691,0,0.691,0.041-0.041,1.51c-0.446,0.854-1.752,2.566-2.895,3.791
                           c-1.549,1.63-2.322,2.895-2.854,4.604c-1.226,3.954-1.021,4.362,2.118,3.954c1.306-0.163,2.567-0.122,2.978,0.082
                           c0.731,0.367,0.731,0.447-0.082,1.182l-0.814,0.773l0.855,1.428c0.45,0.814,1.062,1.386,1.306,1.304
                           c0.244-0.041,1.63-1.915,3.059-4.073c2.362-3.628,2.688-3.953,3.87-3.953c1.225,0.041,2.12,0.854,3.508,3.261
                           c0.324,0.489,0.69,0.489,2.935,0c1.427-0.285,3.139-0.57,3.832-0.652c0.693-0.041,1.63-0.242,2.038-0.487
                           c0.938-0.447,1.467-0.284,3.628,1.102c2.567,1.631,3.505,2.078,4.442,2.078c1.305,0,1.672-0.447,2.24-2.485
                           c0.489-1.753,0.448-2.039-0.487-4.075c-0.979-2.24-1.671-5.666-1.143-5.666c0.732,0,3.14,0.979,3.791,1.51
                           c0.855,0.771,1.307,0.486,2.607-1.55l0.979-1.592h2.896c2.486,0,2.977-0.12,3.832-1.02c0.568-0.529,1.019-1.468,1.019-2.037
                           c0-1.306,1.348-2.648,2.608-2.648c2.039,0,3.547-0.488,3.343-1.103c-0.123-0.325,0.122-1.264,0.53-2.078
                           c1.468-2.895,1.752-4.239,0.979-5.055c-0.813-0.938-0.407-1.834,1.225-2.771c0.978-0.528,1.141-0.528,2.038,0.326
                           c1.223,1.143,1.752,1.143,2.077-0.041c0.529-2.038,0.123-2.445-3.545-3.669c-0.365-0.162-0.896-0.73-1.183-1.305
                           c-0.245-0.57-0.938-1.143-1.508-1.305c-0.57-0.122-1.59-0.772-2.242-1.387c-1.427-1.469-1.875-1.469-3.914-0.123
                           c-1.589,1.063-1.589,1.063-2.894,0.326c-1.591-0.938-2.649-3.546-2.039-4.974c0.651-1.387-0.244-1.103-0.979,0.326
                           c-0.896,1.753-2.363,2.606-3.464,2.037c-0.488-0.243-1.385-0.366-1.997-0.202c-1.427,0.322-2.853-0.246-4.646-1.835
                           C215.766,433.329,215.156,433.043,214.992,433.369z" />
              <path class="territory vrnsi" id="Varanasi" d="M446.519,437.037c-0.896,0.609-2.119,1.266-2.771,1.387c-1.268,0.326-1.837,1.712-1.145,2.978
                           c0.774,1.428,0.529,3.587-0.489,4.852c-1.468,1.753-1.507,2.16-1.021,7.297c0.408,4.075,0.611,4.894,1.428,5.706
                           c0.531,0.529,0.938,1.141,0.938,1.346c0,0.244,0.365,0.611,0.855,0.855c0.61,0.366,1.021,0.325,1.713-0.122
                           c1.426-0.897,2.936-1.143,3.749-0.53c0.691,0.489,0.691,0.652,0.041,3.183c-0.813,2.976-0.773,4.317,0.243,4.932
                           c0.734,0.489,1.834,0.082,3.67-1.386c0.813-0.651,1.875-0.938,4.319-1.145l3.22-0.244l2.121-2.28c1.346-1.55,2.079-2.69,2.079-3.345
                           c0-1.508,2.282-3.587,6.153-5.585c3.384-1.752,4.198-2.565,4.646-4.81c0.326-1.55-0.487-2.69-2.934-4.198
                           c-0.734-0.486-1.471-1.264-1.593-1.793c-0.121-0.528-0.487-1.184-0.813-1.468c-0.325-0.245-0.569-0.693-0.569-0.938
                           c0-0.243-1.021-1.549-2.243-2.895l-2.24-2.405l-1.469,1.712c-2.854,3.386-4.522,3.467-5.867,0.326
                           c-0.652-1.507-0.938-1.792-2.283-1.997c-0.813-0.162-2.323-0.08-3.262,0.123c-1.265,0.285-2.159,0.244-3.303-0.164
                           C448.189,435.896,448.068,435.938,446.519,437.037z" />
              <path class="territory" id="Chandauli" d="M477.131,441.276c-1.511,1.021-2.978,1.835-3.304,1.835c-1.102,0-0.65,0.732,1.225,2.039
                           c2.323,1.588,3.221,3.221,2.854,5.258c-0.45,2.605-1.591,3.994-4.564,5.503c-3.507,1.753-6.235,3.75-6.235,4.521
                           c0,0.734,1.265,1.429,2.526,1.429c0.528,0,2.079,0.65,3.424,1.468c1.306,0.854,3.14,1.916,4.036,2.405
                           c1.344,0.731,1.63,1.102,1.752,2.28c0.081,1.185-0.163,1.754-1.631,3.426c-0.979,1.102-1.711,2.321-1.631,2.688
                           c0.203,1.223-1.021,3.099-2.566,3.792l-1.468,0.731l0.244,2.485c0.201,1.793,0.079,3.06-0.326,4.279
                           c-0.528,1.509-0.528,1.998-0.041,3.628c0.326,1.021,0.568,2.487,0.568,3.181c0,1.793,1.551,3.912,3.222,4.483
                           c2.403,0.771,2.363,2.771-0.041,4.688c-1.468,1.144-1.428,1.51,0.326,2.241c0.773,0.326,1.876,0.938,2.444,1.388
                           c0.938,0.732,1.468,0.771,5.991,0.568c4.564-0.244,5.177-0.365,7.623-1.631c1.468-0.732,2.895-1.345,3.18-1.345
                           c0.732,0,0.611-0.734-0.367-2.078c-0.732-1.063-0.771-1.427-0.445-3.751c0.326-2.16,0.244-3.1-0.572-6.399
                           c-0.528-2.117-1.344-4.973-1.834-6.315c-1.468-4.075-1.468-5.422,0.082-7.948c0.734-1.224,1.631-2.729,2.078-3.342
                           c0.896-1.349,0.896-1.672,0.164-3.101c-0.285-0.608-0.449-1.672-0.367-2.361c0.162-0.979,0.531-1.431,1.754-1.957
                           c0.896-0.367,2.69-1.957,4.237-3.709c1.753-1.917,3.222-3.184,4.118-3.469c0.771-0.241,1.426-0.567,1.426-0.69
                           c0-0.162-0.203-1.467-0.447-2.938c-0.772-4.646-3.913-9.819-7.623-12.595c-1.508-1.1-2.282-1.141-3.708-0.121
                           c-0.61,0.447-1.753,0.896-2.607,1.062c-1.306,0.244-1.792,0.082-3.71-1.185c-1.956-1.304-4.646-2.242-6.439-2.283
                           C480.105,439.442,478.597,440.259,477.131,441.276z" />
              <path class="territory" id="Chitrakoot"
                d="M309.886,441.317c-0.49,0.529-0.979,1.347-1.143,1.875c-0.488,1.55-1.877,2.771-3.141,2.771
                           c-2.282,0-4.238,1.428-5.99,4.361c-0.854,1.55-2.118,3.262-2.771,3.831c-1.59,1.509-4.321,2.813-5.87,2.813h-1.304l0.285,3.709
                           c0.283,3.872,0.041,4.853-1.388,4.853c-0.365,0-1.183,0.487-1.793,1.061c-0.979,1.021-1.062,1.346-1.062,4.442v3.384l1.427,0.245
                           c1.103,0.203,1.671,0.08,2.608-0.61l1.223-0.896l1.712,1.51c1.712,1.467,1.794,1.467,2.078,0.61c0.205-0.49,0.246-1.471,0.082-2.201
                           c-0.163-0.855,0-1.794,0.408-2.609c0.938-1.792,2.976-1.792,4.48,0c1.265,1.509,1.306,1.794,0.246,3.548
                           c-0.448,0.731-0.815,1.589-0.815,1.915s-0.771,2.039-1.669,3.75c-1.145,2.079-1.754,3.831-1.835,5.056
                           c-0.081,1.266-0.569,2.606-1.43,3.993l-1.303,2.12l0.814,1.102c1.101,1.509,2.525,1.631,3.791,0.285
                           c0.528-0.57,1.304-1.02,1.711-1.02c0.449,0,1.468-0.449,2.283-1.021c1.671-1.145,2.525-1.307,2.525-0.449
                           c0,0.979,1.386,3.099,2.2,3.344c0.488,0.163,1.225-0.204,2.24-1.184c0.815-0.772,1.835-1.592,2.242-1.834
                           c0.854-0.408,1.062-0.285,5.83,3.71c1.711,1.427,1.914,1.508,2.524,0.896c0.365-0.326,0.855-1.509,1.062-2.528
                           c0.245-1.059,0.611-1.953,0.854-2.035s1.143,0.771,1.957,1.916c1.265,1.712,1.631,1.997,2.118,1.631
                           c0.733-0.651,0.733-1.957-0.041-3.264c-0.771-1.346-0.771-3.302,0-4.319c0.326-0.405,0.612-1.021,0.612-1.347
                           c0-0.324,0.772-1.793,1.711-3.262c1.266-2.037,1.712-3.138,1.753-4.522c0.041-2.362,0.938-4.894,1.672-4.894
                           c0.326,0,0.57,0.246,0.57,0.571c0,1.142,1.223,1.06,2.119-0.163c0.487-0.693,1.019-1.224,1.142-1.224
                           c0.162,0,1.102,0.527,2.08,1.224c0.979,0.651,2.2,1.223,2.688,1.223c2.199,0,2.854,1.103,1.265,2.202
                           c-0.896,0.651-0.896,0.651-0.122,1.266c1.224,0.979,3.303,1.834,4.441,1.834c0.528,0,1.388-0.367,1.916-0.775l0.979-0.772
                           l-1.304-1.631c-1.348-1.672-1.225-2.12,0.609-2.12c1.591-0.041,1.875-0.65,0.938-2.158l-0.896-1.469l1.062-0.69
                           c0.854-0.569,0.979-0.897,0.813-1.957c-0.202-0.938-0.041-1.59,0.609-2.404c0.571-0.734,0.815-1.55,0.734-2.404
                           c-0.122-1.264-0.204-1.346-1.753-1.305c-0.897,0-3.345,0.245-5.464,0.529c-3.588,0.448-3.912,0.407-4.688-0.284
                           c-0.49-0.449-1.264-1.021-1.793-1.306c-0.855-0.407-0.938-0.651-0.692-2.405c0.202-1.59,0.122-1.995-0.364-2.2
                           c-0.816-0.325-1.471-0.121-4.606,1.428c-2.978,1.51-4.32,1.348-5.341-0.609c-1.061-1.997-2.771-3.425-4.401-3.669
                           c-1.387-0.245-3.424-1.631-3.424-2.364c0-0.203,0.611-1.021,1.304-1.834c1.104-1.223,1.348-1.875,1.389-3.424l0.041-1.958
                           l-1.875-0.244c-1.875-0.244-3.426-0.772-6.236-1.996C310.74,440.136,310.987,440.095,309.886,441.317z" />
              <path class="territory" id="Mirzapur" d="M439.181,462.065c-1.958,2.118-4.158,2.647-8.233,1.874c-2.896-0.528-4.893-0.283-7.134,0.814
                           c-2.404,1.223-3.75,1.021-5.095-0.691l-1.104-1.469l-1.916,2.16c-1.833,2.12-1.915,2.12-3.138,1.63
                           c-0.692-0.284-1.916-1.263-2.729-2.118c-0.814-0.896-1.714-1.551-1.957-1.469c-0.813,0.245-0.813,2.039-0.041,3.465
                           c0.691,1.307,0.691,1.471,0.082,2.528l-0.652,1.182l1.755,1.021c1.791,1.103,3.179,2.896,3.668,4.811
                           c0.406,1.631-2.079,10.271-3.588,12.557c-0.691,1.021-3.547,4.117-6.358,6.931c-2.854,2.813-5.462,5.706-5.869,6.438l-0.732,1.306
                           l2.854-0.243c3.305-0.327,3.711,0,2.896,2.525c-0.366,1.102-0.366,1.589,0,1.915c0.367,0.365,0.814,0.042,1.997-1.306
                           c1.549-1.834,2.485-1.957,2.485-0.408c0,0.489-0.569,2.12-1.265,3.671c-1.752,4.075-1.101,5.38,2.119,4.237
                           c3.058-1.102,3.791-0.691,2.771,1.508c-0.283,0.652-0.283,1.307,0,2.038c0.408,1.104,0.612,1.184,7.055,3.019
                           c0.527,0.162,0.732-0.203,0.938-2.16c0.528-4.524,0.772-5.137,2.119-5.95c1.264-0.732,1.304-0.732,4.197,0.487l2.896,1.265
                           l0.813-1.956c3.711-8.684,5.788-13.368,6.071-13.652c0.163-0.164,0.53-0.043,0.815,0.322c0.285,0.326,0.896,0.611,1.346,0.611
                           c0.447,0,1.428,0.448,2.16,1.021c1.59,1.224,2.445,1.264,4.034,0.202c1.061-0.69,1.835-0.813,5.423-0.772l4.156,0.082l1.59-1.713
                           c1.754-1.875,2.444-1.997,5.137-0.854l1.915,0.813l1.47-1.184c0.854-0.65,1.957-1.671,2.484-2.239
                           c0.57-0.57,1.307-1.063,1.713-1.063c0.938,0,1.915,1.428,2.241,3.262c0.367,1.795,1.141,3.058,2.648,4.116l1.184,0.855l1.63-1.306
                           c1.712-1.387,1.794-2.038,0.205-2.038c-1.225,0-2.896-1.997-3.425-3.993c-1.591-6.439-1.714-7.38-1.185-8.314
                           c0.285-0.57,0.529-2.364,0.529-4.563c0-3.181,0.081-3.67,0.816-4.075c2.605-1.47,3.138-1.957,2.853-2.979
                           c-0.162-0.772,0.162-1.427,1.631-3.139c1.021-1.184,1.834-2.404,1.834-2.73c-0.042-0.813-6.767-4.852-8.069-4.852
                           c-0.61,0-1.348-0.163-1.671-0.366c-0.733-0.487-2.649,0.896-3.75,2.648c-0.979,1.59-2.2,2.08-5.788,2.323
                           c-2.037,0.161-3.019,0.405-3.669,1.019c-2.2,1.958-4.28,2.243-5.786,0.693c-1.187-1.143-1.308-2.607-0.449-5.788l0.569-2.119
                           l-1.752,0.854c-1.551,0.773-1.916,0.814-3.06,0.326c-0.691-0.285-1.549-1.062-1.876-1.673c-0.325-0.651-0.731-1.182-0.896-1.141
                           C440.933,460.272,440.076,461.087,439.181,462.065z" />
              <path class="territory" id="Sant Ravidas Nagar"
                d="M439.548,454.203c-0.243-1.957-0.364-2.12-1.347-2.12c-1.957-0.041-4.318-1.183-5.503-2.65
                           c-1.508-1.915-2.078-2.157-5.989-2.853c-3.671-0.652-5.706-1.713-6.769-3.506c-0.69-1.145-0.854-1.186-3.587-1.186
                           c-1.549,0-3.221-0.121-3.67-0.201c-0.446-0.125-1.425,0.16-2.117,0.607c-2.08,1.264-1.59,2.648,1.345,3.872
                           c2.647,1.102,2.813,4.197,0.366,6.849c-0.896,0.979-1.508,2.12-1.672,3.181c-0.162,0.896-0.771,2.321-1.427,3.221
                           c-0.488,0.684-0.747,1.073-0.822,1.32c-0.944,0.318-1.87,0.708-2.56,1.123c2.635-1.312-0.49,0.246-1.02,0.53
                           c-0.531,0.245-1.347,1.021-1.835,1.632c-0.772,1.062-0.772,1.224-0.244,2.199c0.326,0.571,1.101,1.429,1.753,1.917
                           c1.02,0.732,1.183,0.773,1.752,0.162c0.61-0.568,0.569-0.732-0.041-1.712c-0.528-0.772-0.496-3.049,1.247-3.872
                           c0.854-0.342,1.569-0.643,2.188-0.915c0.498,0.4,1.104,0.948,1.661,1.527l1.834,1.835l1.875-2.119
                           c1.589-1.834,1.997-2.079,2.936-1.834c0.569,0.122,1.387,0.813,1.793,1.507c0.814,1.429,1.103,1.429,5.34-0.08
                           c2.445-0.855,2.813-0.896,5.747-0.406c4.2,0.691,5.788,0.324,7.583-1.632C439.872,458.888,439.995,458.236,439.548,454.203z" />
              <path class="territory" id="Lalitpur"
                d="M112.274,468.14c-0.651,0.326-1.591,1.143-2.038,1.834c-0.447,0.692-1.305,1.347-1.875,1.469
                           c-0.609,0.163-1.428,0.61-1.834,1.061c-0.406,0.448-1.305,1.104-1.956,1.427c-0.691,0.327-2.039,1.267-3.017,2.12
                           c-1.712,1.468-1.753,1.589-1.916,4.321c-0.163,3.384-0.937,4.646-3.506,5.584c-1.141,0.447-2.16,1.182-2.813,2.118
                           c-1.143,1.632-2.159,2.485-5.015,4.116c-1.101,0.611-2.078,1.387-2.201,1.672c-0.122,0.326,0.651,1.469,1.834,2.647
                           c2.771,2.813,3.182,3.873,2.567,6.933c-0.57,2.771-0.244,3.749,1.508,4.646c2.324,1.224,2.938,2.16,2.938,4.563
                           c0,2.688-0.611,4.278-2.649,6.687c-1.834,2.2-2.242,3.22-2.364,5.747c-0.081,1.753,0.081,2.12,1.468,3.546
                           c1.388,1.386,1.511,1.753,1.144,2.486c-0.408,0.771-0.204,1.02,2.688,2.854c5.138,3.263,4.852,2.937,4.197,4.564
                           c-0.284,0.773-0.979,1.916-1.468,2.567l-0.938,1.224l2.486,2.771c1.346,1.51,2.69,2.771,3.017,2.771c0.57,0,2.608-2.445,2.608-3.14
                           c0-0.245,0.285-0.691,0.652-0.979c0.366-0.285,1.265-1.509,1.998-2.65c1.671-2.605,2.771-3.302,4.074-2.605
                           c1.103,0.569,5.666,5.626,7.419,8.151c1.795,2.566,3.793,4.359,5.219,4.604c0.772,0.122,1.957-0.082,3.179-0.612
                           c1.589-0.69,2.12-0.771,2.977-0.364c0.896,0.405,0.979,0.609,0.773,1.834c-0.204,1.103-0.081,1.713,0.693,2.771
                           c0.486,0.731,0.938,1.384,0.978,1.467c0.204,0.489,1.591-0.691,1.998-1.713c0.448-1.06,0.856-1.304,2.69-1.671
                           c1.834-0.326,2.321-0.652,3.098-1.834c0.896-1.388,1.916-2.813,4.117-5.747c1.957-2.568,3.709-6.563,3.831-8.724l0.124-2.039
                           l-1.631-0.406c-0.896-0.245-2.323-0.734-3.141-1.102c-2.119-0.938-3.546-3.994-1.834-3.994c0.243,0,1.225,0.731,2.12,1.631
                           c1.589,1.59,1.671,1.59,2.607,0.979c0.854-0.609,0.938-0.896,0.732-3.139c-0.204-2.12-0.528-2.896-2.283-5.422
                           c-1.141-1.631-2.158-3.425-2.321-3.994c-0.53-2.201-2.567-3.018-3.873-1.589c-1.426,1.548-4.076,3.382-4.812,3.382
                           c-0.366-0.041-1.712-1.224-3.018-2.647l-2.363-2.607l0.732-1.143c0.366-0.61,1.266-1.795,1.998-2.607
                           c1.263-1.469,1.263-1.509,1.467-6.931c0.122-3.018,0.326-5.747,0.489-6.113c0.487-1.142-1.428-2.649-3.668-2.978
                           c-2.813-0.366-4.894-1.875-5.462-3.912c-0.245-0.938-0.407-3.547-0.326-5.829c0.163-6.521-0.774-9.782-3.181-11.087
                           c-0.772-0.406-1.386-1.062-1.386-1.429c0-0.365-0.366-1.019-0.813-1.427c-0.449-0.408-1.021-1.426-1.266-2.283
                           c-0.326-0.978-0.65-1.467-1.021-1.304c-0.285,0.123-0.938-0.082-1.468-0.449C114.149,467.446,113.864,467.446,112.274,468.14z" />
              <path class="territory htrsr" id="Sonbhadra" d="M463.719,497.324c-1.306,1.143-2.607,2.038-2.896,2.038c-0.325,0-1.509-0.406-2.688-0.896l-2.16-0.896
                           l-1.589,1.834l-1.549,1.796l-4.28-0.082c-3.669-0.082-4.525,0-5.91,0.731c-1.916,1.021-3.955,0.814-5.097-0.447
                           c-0.407-0.446-1.225-0.813-1.834-0.813c-1.021,0-1.266,0.447-3.954,6.604l-2.896,6.646l2.608,0.123
                           c2.323,0.121,2.936-0.041,5.259-1.266c2.813-1.509,3.465-1.386,3.465,0.609c0,0.979,0.367,1.309,2.854,2.567
                           c1.588,0.774,2.854,1.591,2.854,1.794c0,0.204,0.814,1.264,1.834,2.404c3.06,3.384,2.322,4.852-2.079,4.4
                           c-3.668-0.365-4.236,0.123-2.525,2.241l1.265,1.59l-0.691,1.592c-0.773,1.712-0.896,3.425-0.447,7.052
                           c0.285,2.323,0.325,2.364,1.631,2.364c2.241,0,2.648,0.324,2.2,1.551c-0.244,0.567-0.979,3.546-1.631,6.603
                           c-0.938,4.116-1.225,6.236-1.103,8.438c0.164,3.384,0.041,3.464-2.525,2.159c-0.896-0.447-2.078-0.813-2.647-0.813
                           c-3.304,0,1.589,7.051,11.249,16.184c5.137,4.892,7.094,6.479,9.213,7.5l2.688,1.265l6.563-0.285
                           c8.314-0.326,11.698-1.061,13.981-2.936l1.712-1.428l0.122-4.524l0.123-4.563l1.345-0.691c1.957-0.938,2.937-1.956,2.937-2.978
                           c0-0.49,0.366-1.224,0.813-1.631c0.489-0.407,1.225-1.428,1.712-2.202c0.488-0.813,1.305-1.996,1.793-2.604
                           c1.591-1.916,3.505-8.563,3.587-12.313l0.041-3.303l1.754-1.549c0.938-0.855,1.713-1.835,1.713-2.161
                           c0-0.979-1.184-3.18-2.607-4.853c-1.145-1.346-1.388-1.996-1.593-4.481c-0.322-3.303-0.159-3.588,2.364-3.954
                           c4.936-0.774,7.949-2.567,7.949-4.769c0-0.57,0.162-1.225,0.365-1.471c0.205-0.203,0.448-1.224,0.57-2.28
                           c0.121-1.551,0.04-2.078-0.57-2.607c-0.488-0.448-0.773-1.265-0.773-2.161c0-1.102-0.448-2.079-1.63-3.708
                           c-2.567-3.467-3.139-3.954-5.341-4.688c-1.711-0.57-2.283-0.611-3.181-0.203c-0.569,0.285-1.713,0.771-2.484,1.101
                           c-0.774,0.325-2.159,0.938-3.059,1.347c-1.183,0.569-3.017,0.813-6.728,0.979l-5.095,0.245l-1.835-1.224
                           c-1.021-0.651-1.998-1.224-2.242-1.224c-0.569,0-5.421-3.872-6.316-5.016c-0.407-0.529-0.896-1.508-1.021-2.16
                           c-0.489-2.119-0.651-2.607-0.938-2.607C466.204,495.327,465.025,496.224,463.719,497.324z" />
              <path class="territory" id="Muzaffarnagar"
                d="M82.027,89.304c0.488-0.449,1.551-1.346,2.363-2.038c0.815-0.652,2.527-1.671,3.791-2.242
                           c1.509-0.693,2.283-1.264,2.283-1.712c0-0.774-2.201-2.12-5.258-3.179c-1.021-0.367-2.65-1.102-3.628-1.63
                           c-1.021-0.571-2.201-1.02-2.69-0.979c-0.446-0.003-1.955,0.73-3.26,1.626c-1.345,0.856-2.568,1.59-2.771,1.59
                           c-0.163,0-1.061,0.815-1.998,1.834c-0.896,0.979-1.997,1.916-2.402,2.038c-0.408,0.123-1.389,0.856-2.243,1.632
                           c-0.814,0.773-1.793,1.426-2.16,1.426s-1.876,0.367-3.302,0.814c-2.813,0.897-5.258,0.815-7.582-0.203
                           c-2.606-1.138-4.287-1.678-6.202-1.923l-3.332,6.504l-3.208,10.278l-1.475,2.949l-4.467,2.27l-0.71,8.956
                           c3.932,0.301,5.624,0.895,7.166,2.437c1.102,1.1,1.671,1.345,3.059,1.345c1.507,0,1.916-0.245,3.423-1.793
                           c2.161-2.324,3.181-2.65,3.914-1.223c0.772,1.385,1.875,1.997,2.201,1.182c0.162-0.448,0.854-0.611,2.403-0.611
                           c1.957,0,2.282,0.163,3.587,1.467c0.732,0.774,2.363,1.916,3.588,2.487l2.16,1.02l1.916-0.856c1.021-0.53,2.363-1.183,2.977-1.509
                           c0.569-0.326,1.427-0.57,1.834-0.57c0.408,0,0.938-0.163,1.182-0.326c0.979-0.855,7.867-2.038,13.003-2.241
                           c2.364-0.082,2.445-0.123,2.568-1.224c0.081-0.651-0.123-1.753-0.489-2.444c-0.325-0.734-0.813-2.243-1.101-3.344
                           c-0.286-1.142-0.816-2.486-1.225-3.057c-0.364-0.571-0.813-2.08-0.938-3.383c-0.163-1.305-0.489-2.896-0.815-3.465
                           c-0.285-0.611-0.771-2.12-1.06-3.344c-0.286-1.223-0.734-2.896-1.021-3.668C81.047,91.383,81.007,90.119,82.027,89.304z" />
              <path class="territory" id="Shamali"
                d="M37.833,104.976l1.226-2.452l3.212-10.289l2.906-5.674l-0.501-0.411c-0.289,0.003-0.451,0.043-0.521,0.132
                           c-0.861-0.491-1.58-0.877-2.148-1.167c-0.244-0.487-0.559-0.771-1.064-1.074c-0.212-0.129-0.391-0.226-0.562-0.308l-1.386-0.202
                           c-0.422,0.05-0.952,0.164-1.721,0.346c-4.236,0.979-4.688,1.06-5.217,0.612c-0.246-0.204-1.469-0.693-2.648-1.102
                           c-1.348-0.448-2.445-1.1-3.019-1.834c-0.979-1.386-2.16-1.752-2.813-0.978c-0.734,0.896-2.364,0.692-3.709-0.448
                           c-1.224-1.017-1.997-1.262-2.486-0.731c-0.163,0.122-0.285,0.774-0.285,1.427c0,0.653-0.449,1.997-1.019,2.935
                           c-0.938,1.63-1.021,2.038-0.857,6.196c0.082,2.608,0.407,5.218,0.815,6.277c0.608,1.793,1.508,8.724,1.468,11.168
                           c0,0.611-0.204,1.467-0.407,1.875c-0.652,1.264-0.488,2.446,0.326,2.446c0.448,0,1.1,0.367,1.508,0.815
                           c0.57,0.61,1.224,0.814,2.404,0.773c0.938-0.041,2.444,0.245,3.424,0.612c0.366,0.14,0.66,0.245,0.926,0.32
                           c0.925,1.386,1.808,1.64,1.808,1.64l1.101,0.571c0.559,0.278,2.104,0.586,3.689,0.746l0.776-9.794L37.833,104.976z" />
              <path class="territory" id="Raebarely"
                d="M336.253,393.373l1.432-3.214v-11.743l2.396-1.416l2.015-3.695v-8.984l-2.538-4v-1.768l-1.732-7.656
                           c-0.646-0.133-1.27-0.237-1.741-0.282c-0.005-0.001-1.507-0.483-2.129,1.64c0,0,0.065,0.591-1.347,0.702
                           c-0.215-0.009-0.481-0.001-0.782,0.014c-0.015-0.001-0.022,0.001-0.038,0v0.003c-0.126,0.006-0.241,0.01-0.387,0.02
                           c-1.753,0.082-2.487-0.122-4.688-1.348c-1.671-0.938-3.181-1.468-4.075-1.468c-0.938,0-1.59-0.202-1.713-0.608
                           c-0.282-0.694-0.403-0.694-1.585-0.205c-1.267,0.488-5.83,4.812-6.113,5.748c-0.449,1.347-1.836,1.588-3.589,0.69
                           c-0.896-0.446-1.671-0.69-1.753-0.61c-0.123,0.082-0.365,1.307-0.61,2.69c-0.447,2.362-0.408,2.605,0.407,3.466
                           c0.449,0.486,0.854,1.182,0.854,1.549c0,0.364,0.285,0.854,0.611,1.141c1.185,0.979,0.448,5.828-1.142,7.623
                           c-1.184,1.347-2.73,1.183-4.605-0.448c-0.896-0.772-2.402-1.589-3.344-1.834c-0.896-0.284-1.793-0.651-1.915-0.854
                           c-0.326-0.489-3.057-0.53-3.057-0.041c0,0.162,0.854,1.184,1.874,2.242c1.795,1.793,1.875,1.957,1.672,3.586
                           c-0.163,1.183-0.569,2.039-1.264,2.65c-0.571,0.486-1.062,1.018-1.062,1.182c0,0.162-0.449,0.896-1.062,1.672
                           c-0.734,0.979-1.348,1.347-2.201,1.347c-1.062,0-3.424,1.631-5.38,3.669c-0.407,0.445-1.063,0.938-1.427,1.184
                           c-0.407,0.202-0.652,0.446-0.529,0.528c0.122,0.082,1.101,0.567,2.242,1.142c1.915,0.979,2.038,1.143,2.648,3.467
                           c1.062,4.115,0.732,4.035,8.152,2.199c3.828-0.938,5.663-1.223,7.418-1.061c2.523,0.204,4.811,1.468,4.811,2.646
                           c0.041,1.063,1.793,3.914,2.688,4.362c0.448,0.203,1.389,0.854,2.119,1.386c1.185,0.814,1.633,0.896,3.508,0.691
                           c2.729-0.366,3.303,0.123,3.628,3.059c0.161,1.144,0.527,2.403,0.896,2.813c0.326,0.367,0.611,0.896,0.611,1.143
                           c0,0.569,2.362,2.362,3.669,2.729c0.567,0.164,1.71,0.938,2.524,1.714l1.509,1.467l0.245-1.467c0.324-1.632,0.731-2.08,2.24-2.488
                           c0.57-0.12,2.2-1.344,3.668-2.688l2.649-2.445c0,0,0.49-0.46,1.092-0.912l-7.561-5.349L336.253,393.373z" />
              <path class="territory" id="Amethi" d="M388.841,391.139c-0.205-0.123-0.734-1.02-1.145-1.957c-1.142-2.523-3.79-5.258-6.89-7.133
                           c-3.301-1.998-6.646-5.056-6.646-6.113c0-0.408-0.163-0.896-0.365-1.143c-0.203-0.203-0.691-1.389-1.062-2.609l-0.652-2.24
                           l1.956-1.752c1.063-0.979,2.771-2.161,3.792-2.689c1.754-0.896,1.834-1.021,1.711-2.525c-0.079-0.855-0.568-2.527-1.1-3.629
                           c-0.814-1.713-1.266-2.158-2.73-2.688c-4.646-1.755-9.944-2.526-12.637-1.916c-2.525,0.61-3.139,0.082-3.465-3.058
                           c-0.163-1.793-0.489-2.527-1.387-3.385c-0.651-0.609-1.184-1.427-1.184-1.794c0-0.487-0.243-0.651-0.938-0.528
                           c-0.53,0.123-1.51-0.244-2.405-0.854c-1.3-0.858-1.544-0.938-1.992-0.41c-0.325,0.367-0.488,1.55-0.407,2.854
                           c0.123,2.813-0.938,6.195-2.16,6.727c-0.65,0.285-1.671,0.082-4.197-0.773c-1.875-0.649-3.628-1.386-3.914-1.672
                           c-0.197-0.151-0.824-0.364-1.596-0.572l1.628,7.19v1.417l2.538,4v9.803l-2.396,4.395l-2.016,1.189v11.207l-1.533,3.43l-1.424,4.451
                           l7.228,5.112c0.438-0.158,0.985-0.385,1.723-0.71c1.632-0.691,3.547-1.222,4.481-1.222c1.063,0,1.673-0.205,1.673-0.531
                           c0-0.69-1.55-3.139-1.996-3.139c-0.204,0-0.65-0.488-1.062-1.062c-0.651-0.979-0.651-1.101,0.041-1.834
                           c0.692-0.772,0.692-0.896,0.04-2.729c-1.061-2.978-0.285-4.974,1.876-4.974c0.896,0,1.711-0.407,2.813-1.51
                           c1.47-1.427,1.549-1.427,2.525-0.813c1.103,0.733,2.978,3.262,4.361,5.909c0.979,1.834,1.02,1.834,2.2-0.082
                           c0.325-0.567,0.854-0.243,3.465,2.16c2.2,2.08,3.262,2.813,3.791,2.65c0.446-0.124,1.957-1.061,3.384-2.079
                           c2.526-1.753,2.73-1.835,4.77-1.589c1.144,0.162,4.279,0.363,6.931,0.486c4.118,0.203,4.77,0.162,4.77-0.406
                           C389.245,391.668,389.084,391.26,388.841,391.139z" />
              <path class="territory" id="Ghaziabad" d="M53.451,163.141l0.123-0.096c1.893-1.483,3.39-3.011,4.533-4.572c-0.114-1.636-0.561-6.319-1.964-7.094
                           c-0.063-0.036-0.199-0.077-0.376-0.119c-0.011-0.002-0.019-0.006-0.029-0.007c-0.637-0.147-1.869-0.319-3.18-0.444
                           c-7.011-0.733-9.009-1.142-11.251-2.364c-2.078-1.141-2.28-1.181-2.853-0.529c-0.326,0.367-1.183,1.427-1.956,2.323l-1.387,1.631
                           l0.773,0.979c0.611,0.775,0.774,1.508,0.693,3.058c-0.122,1.916-0.245,2.12-1.551,2.771c-0.773,0.366-1.998,0.692-2.729,0.733
                           c-1.386,0-4.771-1.265-5.177-1.998c-0.162-0.244-0.938-0.448-1.752-0.448c-1.143,0-1.752-0.326-2.938-1.549
                           c-2.565-2.731-3.627-1.63-2.037,2.159c0.488,1.224,1.063,2.242,1.225,2.242c0.163,0,1.182,0.693,2.281,1.59
                           c1.102,0.854,2.363,1.67,2.854,1.834c1.671,0.529,2.16,1.508,1.711,3.465c-0.569,2.649-0.244,3.302,1.794,3.302
                           c1.957,0,2.405,0.244,3.098,1.508c0.57,1.142,1.307,1.182,2.241,0.163c0.979-1.1,3.02-1.427,4.158-0.652
                           c0.53,0.367,1.876,0.612,3.099,0.612h2.16l-0.006-0.093c0.508-0.069,1.149-0.26,1.922-0.681c0.208,0.158,0.527,0.227,1.063,0.282
                           c0.75,0.08,1.263,0.352,1.293,0.665c1.896-4.469,3.932-8.247,4.088-8.536L53.451,163.141z" />
              <path class="territory" id="Hapur" d="M93.772,172.941c-0.244-0.488-0.447-1.63-0.447-2.608c-0.04-1.998-0.814-5.26-1.469-6.074
                           c-0.244-0.326-0.69-1.304-0.979-2.201c-0.286-0.896-0.857-2.324-1.266-3.139c-0.446-0.856-0.772-2.039-0.772-2.69
                           s-0.122-1.793-0.245-2.486c-0.244-1.265-0.285-1.265-2.976-1.265c-1.919,0.002-3.672,0.37-6.158,1.226
                           c-3.954,1.386-4.812,1.468-5.951,0.611c-0.408-0.326-1.345-0.611-2.079-0.611c-1.101,0-1.549,0.325-2.771,1.917
                           c-1.388,1.834-4.361,4.36-6.278,5.421c-1.103,0.569-2.079,0.284-3.301-1.02l-0.14-0.146c-1.144,1.456-2.578,2.876-4.316,4.251
                           c-0.425,0.799-2.634,5.005-4.485,9.57c0.793,1.125,2.011,2.316,3.035,2.79c0.896,0.408,1.916,1.061,2.201,1.428
                           c0.731,0.896,2.362,0.814,2.647-0.082c0.285-0.815,3.628-3.343,4.442-3.343c0.286,0,1.59-0.938,2.895-2.12
                           c2.323-2.079,2.404-2.12,3.466-1.509c1.387,0.815,2.648,0.367,3.466-1.181c1.182-2.324,2.895-3.75,4.441-3.75
                           c1.225,0,1.752,0.326,3.182,1.834c1.63,1.712,1.834,1.834,3.873,1.834c1.345,0,2.281,0.204,2.485,0.529
                           c0.161,0.286,1.143,0.774,2.118,1.061c1.021,0.285,1.834,0.815,1.957,1.183c0.163,0.651,3.263,1.957,3.669,1.549
                           C94.138,173.838,94.016,173.39,93.772,172.941z" />
              <path class="territory" id="Badaun" d="M191.557,217.946c-0.896-0.814-1.631-1.671-1.631-1.875c0-0.203-0.611-0.774-1.304-1.305
                           c-1.511-1.06-4.647-1.509-12.271-1.712c-5.256-0.203-6.805-0.447-9.251-1.507c-4.117-1.834-4.688-2.202-5.666-4.036
                           c-0.938-1.63-1.019-2.282-1.019-6.399l0.041-4.605l-1.752-1.631c-0.18-0.166-0.36-0.317-0.539-0.463
                           c-5.361-0.598-10.055-0.566-10.722,0.572c-1.136,1.938-4.034,3.894-6.591,5.62c-1.411,0.952-2.869,1.936-3.19,2.417
                           c-0.158,0.237-0.364,0.522-0.594,0.841c-0.915,1.264-2.817,3.895-2,4.713c1.362,1.362,0.951,4.041,0.343,5.509
                           c-0.215,0.521-0.57,1.204-1.193,1.267c-0.665,0.264-3.83,2.853-3.419,6.674c0.162,1.505,0.08,3.048-0.105,4.456
                           c0.149,0.134,0.287,0.266,0.409,0.393c1.916,1.834,6.155,4.279,7.5,4.279c0.408,0,0.815,0.163,0.938,0.367
                           c0.163,0.203,1.223,0.488,2.403,0.651c3.79,0.489,5.097,1.509,8.479,6.604c1.509,2.242,3.139,2.936,7.5,3.18
                           c8.313,0.447,9.905,0.979,12.311,4.158c0.896,1.141,1.103,1.875,1.103,3.75c0.041,2.037,0.163,2.363,1.182,2.975
                           c0.611,0.407,1.55,0.734,2.079,0.734c0.53,0,1.427,0.407,2.039,0.854c0.611,0.489,1.916,0.979,2.854,1.062l1.752,0.204l0.244-2.526
                           c0.163-1.428,0.284-3.425,0.284-4.484c0-2.405,0.408-2.731,5.099-4.606c4.237-1.672,5.461-2.854,4.688-4.401
                           c-0.285-0.531-0.813-1.346-1.223-1.794c-1.55-1.752-1.021-5.706,1.06-7.989c0.53-0.611,0.611-1.386,0.489-5.748
                           c-0.042-0.896,0.204-1.834,0.611-2.282C193.595,220.677,193.309,219.578,191.557,217.946z" />
              <path class="territory hrtg" id="Moradabad"
                d="M115.725,188.181c0.154,0.096,3.691,2.354,3.847,6.074c0.458,0.583,2.2,2.503,5.255,2.503h7.055
                           c0.532-0.849,2.005-2.576,5.352-2.994c3.47-0.434,4.859-5.109,4.873-5.156l0.274-0.948l0.837,0.516
                           c-0.023-0.016,0.151,0.031,0.657,0.031c0.312,0,0.752-0.018,1.353-0.078c0.291-0.98,1.102-2.966,3.002-3.546
                           c0.295-0.09,0.604-0.13,0.92-0.143c0.044-0.073,0.088-0.148,0.136-0.209c0.283-0.407,0.446-1.427,0.365-2.364l-0.082-0.857v0
                           c-0.049-2.131-0.811-3.213-0.811-3.213c0-0.408-0.814-1.467-1.834-2.404c-1.021-0.896-1.834-1.875-1.834-2.161
                           c0-0.245-0.53-1.101-1.224-1.876c-1.266-1.426-1.59-3.015-0.692-3.668c1.061-0.896,2.813-0.978,3.628-0.245
                           c1.101,1.02,2.079,0.245,2.445-1.916c0.164-1.019,0.855-2.446,1.549-3.343c1.264-1.549,1.345-2.038,1.1-5.584
                           c-0.121-1.467-0.446-2.038-1.834-3.343c-1.793-1.63-2.078-2.649-1.304-4.688c0.245-0.611,0.449-1.875,0.489-2.853
                           c0.082-1.509-0.123-1.998-1.184-3.099c-1.713-1.793-1.469-3.139,0.979-5.136c1.508-1.264,1.753-1.671,1.589-2.568
                           c-0.244-1.264,0.733-2.363,2.73-3.016c1.55-0.489,1.875-1.712,0.813-3.016l-0.732-0.897l-1.59,1.305
                           c-2.443,2.078-2.936,1.427-3.71-5.259c-0.081-0.733-0.366-1.59-0.61-1.916c-0.61-0.733-2.978-1.427-4.975-1.427
                           c-1.223,0-1.712-0.285-2.688-1.427l-1.184-1.467l-0.652,0.979c-0.326,0.53-1.185,1.183-1.834,1.467
                           c-1.795,0.734-3.548,3.832-3.873,6.727c-0.203,1.998-0.488,2.648-2.038,4.443c-1.144,1.304-2.937,2.73-4.729,3.75l-2.935,1.63
                           l-0.122,2.363c-0.082,1.753-0.326,2.568-1.021,3.303c-0.772,0.813-0.813,0.978-0.245,1.467c0.327,0.286,0.61,1.019,0.61,1.671
                           c0,0.652,0.204,1.182,0.449,1.182c0.732,0,3.627,2.568,3.627,3.221c0,0.366,0.449,1.386,1.021,2.282
                           c1.144,1.875,1.266,3.099,0.447,5.38c-0.287,0.839-0.4,1.249-0.35,1.441c-0.489,1.588-1.053,1.997-1.053,1.997l-0.072,0.048
                           c-0.463,0.049-1.019,0.133-1.7,0.265c-0.814,0.163-1.753,0.529-2.08,0.774c-0.814,0.693-4.198,1.101-4.523,0.53
                           c-0.406-0.652-3.302-0.571-3.911,0.163c-0.285,0.326-0.734,0.61-1.021,0.61c-0.61,0-1.1,3.139-0.772,4.893
                           c0.162,0.652,0.121,1.508-0.039,1.916c-0.571,1.305,0.12,4.076,1.345,5.503c0.772,0.896,0.449,5.992-0.449,7.296
                           c-0.408,0.53-0.53,1.386-0.408,2.446c0.064,0.452,0.067,0.865,0.025,1.243c1.095,0.589,2.208,1.095,3.114,1.304L115.725,188.181z" />
              <path class="territory wild" id="Sambhal" d="M146.565,188.953l-0.101,0.539l-0.544,0.069c-1.23,0.152-2.051,0.169-2.597,0.12
                           c-0.581,1.513-2.329,5.125-5.901,5.572c-3.465,0.433-4.363,2.456-4.4,2.542l-0.194,0.457l-0.499,0.008h-7.5
                           c-4.352,0-6.533-3.198-6.624-3.334l-0.126-0.189v-0.227c0-2.749-2.533-4.635-3.055-4.994c-0.952-0.241-2.058-0.731-3.14-1.301
                           c-0.768,1.095-2.275,1.28-3.884,0.138c-1.145-0.814-1.185-0.814-1.428-0.04c-0.123,0.448-0.813,1.305-1.509,1.875
                           c-1.02,0.856-1.631,1.061-2.813,0.938l-1.55-0.123l-0.325,2.648c-0.164,1.468-0.286,2.976-0.245,3.343
                           c0.122,0.938,2.323,4.32,3.791,5.789c1.631,1.671,6.398,7.052,8.029,9.089c1.469,1.875,2.566,4.279,2.566,5.666
                           c0,0.773,0.57,1.386,2.526,2.607c1.227,0.807,2.183,1.294,2.957,1.499c2.238,1.391,4.896,1.309,4.896,1.309
                           c0.406,0.253,0.954,0.526,1.687,0.865c0.823,0.366,1.822,0.952,2.723,1.581c0.097-1.051,0.118-2.149,0.004-3.211
                           c-0.337-3.133,1.284-5.462,2.28-6.571c0.516-0.575,1.502-1.499,2.247-1.713c0.406-0.604,1.129-3.309,0.173-4.265
                           c-1.722-1.722,0.424-4.689,1.844-6.652c0.218-0.301,0.413-0.57,0.562-0.794c0.462-0.693,1.61-1.486,3.599-2.829
                           c2.305-1.555,5.172-3.49,6.136-5.135c0.708-1.208,2.964-1.66,5.707-1.714c-0.878-0.287-1.602-0.622-1.917-0.937
                           c-0.608-0.611-0.73-1.143-0.527-2.202c0.389-1.545-0.131-2.817-0.446-3.404c-0.098,0.016-0.202,0.019-0.294,0.047
                           C147.043,186.509,146.57,188.929,146.565,188.953z" />
            </g>
            <g id="tooltip" visibility="hidden">
              <rect width="50" height="18" fill="#FF4800" rx="2" ry="2" />
              <text x="4" y="6" fill="#FFFFFF">Tooltip</text>
            </g>
          </svg>
        </div>
      </div>
    </div>
  </section>
  <section class="Startup container-fluid">
    <div class="container">
      <h4 class="title3">Important <span>Links</span></h4>
      <ul class="brand-items owl-carousel owl-theme">
        <li class="news-thumb">
          <div class="brand-img"><a target="_blank" href="https://kheloindia.gov.in/" title="" class="external"><img
                alt="Khelo India" title="Khelo India" src="images/khelindia.jpg"></a></div>
        </li>
        <li class="news-thumb">
          <div class="brand-img"><a target="_blank" href="https://ehrms.upsdc.gov.in/" title="" class="external"><img
                alt="Manav Sampada" title="Manav Sampada" src="images/manav.jpg"></a></div>
        </li>
        <li class="news-thumb">
          <div class="brand-img"><a target="_blank" href="https://www.india.gov.in/" title="" class="external"><img
                alt="Government of India" title="Government of India" src="images/Startup_1.jpg"></a></div>
        </li>
        <li class="news-thumb">
          <div class="brand-img"><a target="_blank" href="https://digitalindia.gov.in/" title="Digital India"
              class="external"><img alt="Digital India" title="Digital India" src="images/Startup_2.jpg"></a></div>
        </li>
        <li class="news-thumb">
          <div class="brand-img"><a target="_blank" href="https://www.mygov.in/" title="MyGov" class="external"><img
                alt="MyGov" title="MyGov" src="images/Startup_3.jpg"></a></div>
        </li>
        <li class="news-thumb">
          <div class="brand-img"><a target="_blank" href="https://www.pmindia.gov.in/en/"
              title="Prime Minister of India" class="external"><img alt="Prime Minister of India"
                title="Prime Minister of India" src="images/Startup_4.jpg"></a></div>
        </li>
        <li class="news-thumb">
          <div class="brand-img"><a target="_blank" href="https://up.gov.in/en" title="Government of Uttar Pradesh"
              class="external"><img alt="Government of Uttar Pradesh" title="Government of Uttar Pradesh"
                src="images/Startup_5.jpg"></a></div>
        </li>
        <li class="news-thumb">
          <div class="brand-img"><a target="_blank" href="https://www.makeinindia.com/" title="Make In India"
              class="external"><img alt="Make In India" title="Make In India" src="images/Startup_6.jpg"></a></div>
        </li>
        <li class="news-thumb">
          <div class="brand-img"><a target="_blank" href="https://upcmo.up.nic.in/"
              title="Chief Minister Office, Government of Uttar Pradesh, India" class="external"><img
                alt="Chief Minister Office, Government of Uttar Pradesh, India"
                title="Chief Minister Office, Government of Uttar Pradesh, India" src="images/Startup_7.jpg"></a></div>
        </li>
      </ul>
    </div>
  </section>
  <footer class="footer text-center">
    <div class="container">
      <div class="col-md-12">
        <h4 class="footer-links">Technical Helpline Number:&nbsp;+91-9230992739 &nbsp;|&nbsp;
          Email ID: <a href="mailto:up.khelsathi@gmail.com">up.khelsathi@gmail.com</a></h4>
        <!-- <h4 class="footer-links">Technical Helpline Number:&nbsp;+91-522-4150500,&nbsp; +91-7897999210,&nbsp;
          +91-7518980077 &nbsp;|&nbsp; Email ID: <a href="mailto:up.khelsathi@gmail.com">up.khelsathi@gmail.com</a></h4> -->
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <p class="copyright"> For Official Email ID: <a href="mailto:dir.sportsup@gmail.com"
              style="color:#fff;">dir.sportsup@gmail.com</a><br>
            This is the official Web Portal of Department of Sports, Government of Uttar Pradesh.<br>
            Content on this Web Portal is published and managed by Department of Sports, Government of Uttar Pradesh.
            <!--Khel Sathi is the official Portal of Department of Sports, Government of Uttar Pradesh.-->
          </p>
        </div>
        <div class="col-md-12 text-center">
          <!-- <p class="text-white mb-2">Powered by <a href="http://www.otpl.co.in/" target="_blank"><span style="
                        color: #FF7575;
                        font-weight: bold;
                        font-style: italic;
                        ">Omni</span> <span style="
                        color: #8694FF;
                        font-weight: bold;
                        ">Net </span></a> </p> -->
          <ul class="social_icons">
            <li><a href="https://www.facebook.com/sportsdirectorateup" class="external facebook"> <i
                  class="fa fa-facebook"></i></a></li>
            <li><a href="https://x.com/UPsports_Dir" class="external twitter"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/upsportsdirectorate/" class="external instagram"><i
                  class="fa fa-instagram"></i></a></li>
            <!--<li><a href="#"><i class="fa fa-linkedin"></i></a></li>-->
          </ul>
          <p class="Visitors">Visitors : <img class="statcounter" src="https://c.statcounter.com/12898415/0/201dc078/0/"
              alt="Web Analytics" referrerPolicy="no-referrer-when-downgrade"></p>
        </div>
      </div>
    </div>
  </footer>
  <!-- Modal -->
  <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> </div>
  <script src="js/jquery.js"></script>
  <script src="js/animate.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.js"></script>
  <script>
    $(document).ready(function() {
      $('#Lucknow').trigger('click');
      $('.brand-items').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplaySpeed: 1200,
        margin: 10,
        nav: true,
        responsive: {
          0: {
            items: 2
          },
          600: {
            items: 3
          },
          1000: {
            items: 6
          }
        }
      })

    });
  </script>

  <script>
    $(window).scroll(function() {
      var height = $(window).scrollTop();
      if (height > 350) {
        $(".level--1").addClass("level--current");
        $(".level__pins").addClass("level__pins--active");
      }
      if (height < 350) {
        $(".level--1").removeClass("level--current");
        $(".level__pins").removeClass("level__pins--active");
      }

    });

    // DATA SOURCE
    const stadiumData = {
      515: ["Eklavya Sports Stadium, Agra"],
      516: ["Amitabh Bachchan Sports Complex Myohal", "Madan Mohan Malviya Stadium, Prayagraj"],
      517: ["Maharani Ahilyabai Holkar Sports Stadium, Aligarh"],
      518: ["Eklavya Sports Stadium, Ambedkar Nagar"],
      519: ["Sports Stadium, Auraiya"],
      520: ["Sukhdev Pehalwan Sports Stadium, Azamgarh"],
      521: ["K.D. Singh Babu Stadium, Barabanki"],
      522: ["Sports Stadium, Badaun"],
      523: ["Baba Shahmal Sports Stadium, Baraut", "Sports Stadium, Khekrha, Baghpat", "Sports Stadium"],
      524: ["Indra Gandhi Sports Stadium Bahraich", "Indira Gandhi Sports Stadium"],
      525: ["Nehru Sports Stadium, Bijnor"],
      526: ["Veer Lorik Sports Stadium"],
      527: ["Sardar Vallabhbhai Patel Sports Stadium, Banda"],
      528: ["Sports Stadium, Balrampur"],
      529: ["Regional Sports Stadium, Bareilly"],
      530: ["Amar Shaheed Satyawan Singh, Regional Sports Stadium"],
      531: ["Sports Stadium, Bulandshahar, Tanda", "Sports Stadium, Yamunapuram, Bulandshahr"],
      532: [],
      533: ["Sports Stadium, Chitrakoot"],
      534: ["Ravindra Kishor Shahi Sports Stadium, Deoria", "Sports Stadium Bhatpar Rani under Malhana-Malhani, Deoria"],
      535: ["Pandit Govind Ballabh Pant Sports Stadium", "Aliganj Tehsil Sports Stadium, Etah"],
      536: ["Sports Stadium, Kasganj"],
      537: ["Mahatma Jyotiba Phule Sports Stadium, Etawah"],
      538: ["Daudyal Sports Stadium, Firozabad"],
      539: ["Shri Bramha Dutt Dwivedi Sports Stadium"],
      540: ["Sports Stadium, Fatehpur"],
      541: ["Dr. Bhimrao Ambedkar International Sports Complex, Ayodhya"],
      542: ["Sports Stadium, Noida"],
      543: ["Jawaharlal Nehru Sports Stadium, Gonda"],
      544: ["Nehru Sports Stadium, Ghazipur"],
      545: ["Regional Sports Stadium, Gorakhpur", "Vikas Khand Jangal Kauria Stadium, Gorakhpur"],
      546: ["Mahamaya Sports Stadium, Ghaziabad"],
      547: ["Sports Stadium, Hamirpur"],
      548: ["Sports Stadium, Hardoi"],
      549: ["Sports Stadium, Hathras"],
      550: ["Government Inter College, Jhansi"],
      551: ["Indira Stadium"],
      552: ["Sports Stadium, Amroha"],
      553: ["Indira Gandhi Sports Stadium,Siddikpur, Jaunpur"],
      554: ["Sports Stadium, Kanpur Dehat"],
      555: ["Sports Stadium, Kannauj"],
      556: ["Green Park Sports Stadium"],
      557: ["Sports Stadium, Kaushambi"],
      558: ["Sports Stadium, Kushinagar"],
      559: ["Sports Stadium, Lalitpur"],
      560: ["Lalpur Sports Stadium, Lakhimpur Kheri"],
      561: ["K.D. Singh Babu Stadium, Lucknow", "Chowk Stadium, Lucknow", "Mini Stadium Vijayant Khand, Gomti Nagar, Lucknow", "Vinay Khand Mini Sports Stadium"],
      562: ["Dr. Bhimrao Ambedkar Sports Stadium"],
      563: ["Kailash Prakash Sports Stadium"],
      564: ["Sports Stadium, Maharajganj"],
      565: ["Sports Stadium, Mahoba"],
      566: ["Sports Stadium, Mirzapur"],
      567: ["Netaji Subhash Chandra Bose Sports Stadium"],
      568: ["Pandit Jawaharlal Nehru Sports Stadium, Mainpuri"],
      569: ["Late Mohan Pehalwan Sports Stadium"],
      570: ["District Sports Office, Chaudhary Charan Singh Sports Stadium"],
      571: ["Gandhi Sports Stadium, Pilibhit"],
      572: ["Sports Stadium, Pratapgarh"],
      573: ["Shaheed-e-Azam Sports Stadium", "Sports Complex Hockey Astroturf, Rampur"],
      574: ["Motilal Nehru Sports Stadium"],
      575: ["Dr. Ambedkar Sports Stadium, Saharanpur"],
      576: ["Major Dhyan Chand Sports Stadium, Sitapur", "Subhash Chandra Bose Sports Stadium, Sitapur"],
      577: ["Major Jadunath Singh Sports Stadium"],
      578: ["Shri Kanshi Ram Ji District Sports Stadium"],
      579: ["Sports Stadium,Siddharthnagar"],
      580: ["Sports Stadium, Sonbhadra"],
      581: ["Netaji Subhash Chandra Bose Sports Stadium"],
      582: ["Pant Sports Stadium, Sultanpur"],
      583: ["Sports Stadium, Shravasti"],
      584: ["Pandit Deendayal Upadhyay Sports Stadium"],
      585: ["Dr. Sampurnanand Sports Stadium, Varanasi", "Bhim Rao Ambedkar Complex, Lalpur, Varanasi"],
      608: ["Dr. Bhimrao Ambedkar Sports Stadium, Amethi"],
      611: ["Sports Stadium, Shamli"],
      613: ["Sports Stadium, Bhadohi"],
      615: ["Indira Sports Stadium, Orai"],
    };

    // DYNAMIC MAP DATA
    $('path').click(function() {
      const dataId = $(this).attr('data-id');
      const districtName = $(this).attr('id');

      if (!dataId || !districtName) return;

      $('#district_name').text(districtName);
      const stadiums = stadiumData[dataId] || [];

      let html = '';
      if (stadiums.length > 0) {
        stadiums.forEach(function(stadium) {
          html +=
            `<li>
              <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 415.506 415.506" xml:space="preserve">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path
                    d="M383.272,110.52l0.002-0.646l-3.484-0.011l-0.086,27.448c-8.281-6.856-17.703-12.51-26.766-17.017 c-23.309-11.592-48.772-18.684-74.508-23.022l0.041-13.047c12.619-10.885,23.938,5.021,32.303-10.692 c-19.652,0.258-15.338-11.771-32.234-10.734l0.002-0.646l-3.484-0.011l-0.109,34.548c-6.285-0.999-12.58-1.838-18.861-2.541 c-35.063-3.924-70.861-3.619-105.82,1.212c-3.229,0.446-6.465,0.94-9.705,1.463l-0.109-34.682l-3.484,0.011l0.002,0.646 c-16.897-1.037-12.582,10.993-32.234,10.734c8.363,15.713,19.684-0.193,32.301,10.692l0.043,13.168 c-29.039,4.941-58.164,13.233-83.584,28.047c-5.867,3.419-11.984,7.537-17.688,12.285l-0.088-27.863l-3.484,0.011l0.002,0.646 C15.338,109.481,19.654,121.512,0,121.254c8.367,15.712,19.685-0.192,32.303,10.693l0.029,8.801 c-12.324,11.22-21.863,25.568-21.074,42.402c0.912,19.49,12.287,34.646,26.885,46.248v27.828c-5.445-4.65-9.631-9.446-12.393-13.967 c-1.525-2.488-2.686-4.849-3.545-6.978c-0.828-2.137-1.412-4.026-1.752-5.592c-0.346-1.563-0.578-2.787-0.672-3.617 c-0.111-0.833-0.168-1.263-0.168-1.263s-0.033,0.433-0.096,1.271c-0.072,0.841-0.129,2.098-0.059,3.742 c0.156,3.262,0.719,8.221,3.197,14.016c1.211,2.896,2.832,6.002,4.924,9.176c2.078,3.184,4.682,6.381,7.674,9.584 c0.918,0.976,1.891,1.945,2.889,2.91v25.319c-5.445-4.65-9.631-9.445-12.393-13.966c-1.525-2.488-2.686-4.849-3.545-6.978 c-0.828-2.136-1.412-4.026-1.752-5.592c-0.346-1.563-0.578-2.788-0.672-3.617c-0.111-0.833-0.168-1.263-0.168-1.263 s-0.033,0.433-0.096,1.271c-0.072,0.841-0.129,2.098-0.059,3.742c0.156,3.262,0.719,8.22,3.199,14.016 c1.211,2.895,2.832,6.001,4.924,9.176c2.078,3.184,4.682,6.38,7.674,9.583c0.918,0.975,1.889,1.943,2.887,2.908l0.74,0.701 c5.4,5.107,11.889,10.04,19.26,14.613c4.549,2.825,9.438,5.5,14.594,8.053c5.16,2.543,10.615,4.894,16.285,7.137 c11.363,4.416,23.65,8.211,36.555,11.218c6.445,1.538,13.053,2.835,19.764,3.979c0.332,0.057,0.666,0.107,0.998,0.163l1.918,6.39 l4.053-1.216l4.051-1.216l-14.377-47.884c44.209-11.229,87.334-11.229,131.541,0l-14.377,47.883l4.053,1.217l4.051,1.217 l1.918-6.389c0.332-0.056,0.668-0.107,0.998-0.164c6.713-1.144,13.32-2.442,19.766-3.979c12.902-3.007,25.191-6.802,36.555-11.218 c5.668-2.243,11.125-4.594,16.285-7.137c5.154-2.553,10.045-5.228,14.592-8.053c7.371-4.573,13.859-9.506,19.262-14.613l0.74-0.701 c0.998-0.964,1.969-1.933,2.885-2.908c6.031-6.369,10.244-12.928,12.615-18.751c2.439-5.813,3.068-10.751,3.188-14.023 c0.063-1.648,0.012-2.912-0.063-3.743c-0.063-0.838-0.096-1.271-0.096-1.271s-0.059,0.43-0.17,1.263 c-0.096,0.84-0.322,2.057-0.676,3.616c-0.348,1.564-0.939,3.451-1.758,5.59c-0.846,2.132-2.012,4.492-3.551,6.972 c-1.555,2.471-3.467,5.074-5.824,7.667c-1.926,2.099-4.109,4.223-6.551,6.309v-25.321c0.998-0.965,1.971-1.934,2.887-2.91 c6.029-6.369,10.244-12.929,12.613-18.752c2.439-5.813,3.068-10.751,3.188-14.023c0.063-1.648,0.012-2.913-0.063-3.743 c-0.063-0.838-0.096-1.271-0.096-1.271s-0.059,0.43-0.17,1.263c-0.096,0.84-0.322,2.057-0.676,3.616 c-0.348,1.565-0.939,3.451-1.756,5.59c-0.846,2.132-2.012,4.492-3.551,6.972c-1.557,2.471-3.467,5.074-5.824,7.667 c-1.926,2.1-4.111,4.224-6.553,6.31V229.77c14.756-11.677,26.125-26.96,27.268-46.711c-0.061-17.35-9.113-31.51-21.455-42.729 l0.025-8.384c12.619-10.885,23.938,5.019,32.303-10.693C395.852,121.512,400.168,109.481,383.272,110.52z M280.027,114.548 c16.605,3.143,32.943,7.585,48.641,13.701c14,5.455,31.211,13.355,43.342,24.885l-66.66,41.398 c-13.203-10.172-34.381-18.08-59.785-22.076L280.027,114.548z M229.93,108.653c13.213,0.727,26.494,2.042,39.658,4.104 l-34.686,58.282c-8.693-0.95-17.787-1.458-27.148-1.458c-9.363,0-18.455,0.507-27.15,1.458l-34.693-58.297 C173.648,108.351,201.9,107.111,229.93,108.653z M55.637,143.732c23.703-15.661,52.072-24.007,79.842-29.186l34.463,57.909 c-25.404,3.997-46.582,11.904-59.785,22.076l-66.695-41.421C47.25,149.625,51.412,146.522,55.637,143.732z M85.145,316.543 c-7.936-2.711-15.35-5.71-22.109-8.982c-4.535-2.154-8.732-4.49-12.617-6.872c-0.814-0.498-1.605-1.004-2.389-1.513v-24.268 c3.15,2.375,6.525,4.688,10.111,6.914c4.549,2.825,9.439,5.5,14.594,8.053c3.973,1.958,8.123,3.801,12.41,5.569V316.543z M85.145,281.943c-7.936-2.711-15.352-5.711-22.111-8.983c-4.535-2.154-8.73-4.49-12.615-6.872 c-0.816-0.497-1.605-1.004-2.389-1.513v-28.113c3.461,2.231,7,4.297,10.545,6.205c8.537,4.595,17.439,8.505,26.57,11.873V281.943z M76.422,232.545c-13.803-6.317-27.742-14.164-37.881-25.706c-4.895-5.57-11.996-16.036-10.539-24.222 c0.709-3.98,1.832-10.702,4.355-15.745c1.236-2.247,2.668-4.369,4.242-6.385l66.076,41.036c-4.676,5.438-7.244,11.331-7.244,17.49 c0,9.679,6.328,18.706,17.252,26.33C100.236,242.043,88.055,237.868,76.422,232.545z M128.746,327.655 c-11.809-2.156-23.133-4.828-33.715-7.97v-20.436c9.649,3.467,19.881,6.496,30.543,8.981c3.219,0.768,6.479,1.476,9.771,2.135 l5.803,19.328C136.967,329.063,132.828,328.379,128.746,327.655z M320.477,319.685c-10.582,3.143-21.906,5.814-33.717,7.97 c-4.08,0.724-8.221,1.408-12.402,2.039l5.803-19.328c3.293-0.659,6.553-1.367,9.772-2.135c10.664-2.485,20.896-5.515,30.545-8.981 V319.685z M320.477,285.085c-10.582,3.142-21.906,5.814-33.715,7.97c-3.631,0.644-7.309,1.256-11.021,1.828 c-45.701-11.633-90.273-11.633-135.975,0c-3.711-0.572-7.389-1.184-11.02-1.828c-11.811-2.155-23.133-4.828-33.715-7.97v-27.131 c20.076,6.438,41.053,10.423,61.723,12.957c34.283,4.202,69.221,4.148,103.496-0.104c20.242-2.512,40.645-6.456,60.227-12.713 V285.085z M367.478,299.177c-0.783,0.509-1.574,1.015-2.391,1.513c-3.885,2.382-8.08,4.717-12.615,6.872 c-6.76,3.271-14.176,6.27-22.109,8.982v-21.099c4.285-1.769,8.438-3.611,12.41-5.569c5.154-2.552,10.045-5.228,14.592-8.053 c3.588-2.226,6.963-4.54,10.113-6.914V299.177z M367.478,264.575c-0.783,0.509-1.574,1.016-2.389,1.513 c-3.885,2.382-8.08,4.717-12.615,6.872c-6.76,3.272-14.176,6.272-22.111,8.983V254.69c8.365-3.068,16.555-6.584,24.469-10.653 c4.268-2.193,8.52-4.607,12.646-7.247V264.575z M387.141,182.557c-0.145,15.047-13.639,29.256-26.842,38.099 c-17.16,11.493-36.879,19.13-57.113,24.43c10.701-7.569,16.889-16.503,16.889-26.074c0-6.158-2.566-12.052-7.242-17.49 l65.863-40.903C383.428,166.971,386.568,174.235,387.141,182.557z">
                  </path>
                </g>
              </svg>
              <strong>${stadium} </strong> <a class="btn btn-link" data-bs-toggle="modal"
                data-bs-target="#lucknow_modal"><i class="fa fa-map-pin"></i> View Map</a>
            </li>`;
        });
      }
      $('#stadium_list').html(html);
    });

    function show_map(id) {
      request = $.ajax({
        url: "ajax.php",
        type: "post",
        data: {
          stadium_id: id
        },
        success: function(data) {
          $("#modal").html(data);
          $("#modal").modal('show');
        },
      });
    }
  </script>
  <script>
    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>
  <script src="js/svg-map.js"></script>
  <!-- Modal -->
  <div class="modal fade" id="Player" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Player Registration</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-12  text-center"> <a href="application/" target="_blank">
                <div class="process_card wow hvr-float-shadow animate__fadeIn" data-animation="fadeInUp" data-delay="1s"
                  data-wow-duration="1s">
                  <div class="process_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                      viewBox="0 0 60 63">
                      <image
                        xlink:href="data:img/png;base64,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" />
                    </svg>
                  </div>
                  <div class="process_content">
                    <h4>Prize Money</h4>
                    <p>Nomination form for National/International Games Medal Winners of Uttar Pradesh</p>
                  </div>
                </div>
              </a> </div>
            <div class="col-md-6 col-sm-6 col-12  text-center"> <a href="application/" target="_blank">
                <div class="process_card wow hvr-float-shadow animate__fadeIn" data-animation="fadeInUp" data-delay="1s"
                  data-wow-duration="1s">
                  <div class="process_icon process_icon_6">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                      viewBox="0 0 60 63">
                      <image x="6" width="48" height="64"
                        xlink:href="data:img/png;base64,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" />
                    </svg>
                  </div>
                  <div class="process_content">
                    <h4>Laxman / Rani Laxmi Bai Award</h4>
                    <p>Nomination form for the Laxman/Rani Laxmi Bai Award</p>
                  </div>
                </div>
              </a> </div>
            <div class="col-md-6 col-sm-6 col-12  text-center"> <a href="application/financial-assistance"
                target="_blank">
                <div class="process_card wow hvr-float-shadow animate__fadeIn" data-animation="fadeInUp" data-delay="1s"
                  data-wow-duration="1s">
                  <div class="process_icon process_icon_2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                      viewBox="0 0 60 63">
                      <image y="2" width="59" height="59"
                        xlink:href="data:img/png;base64,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" />
                    </svg>
                  </div>
                  <div class="process_content">
                    <h4>Financial Assistance </h4>
                    <p>Application for Financial Assistance to State/National/International Level Former Sportspersons
                      of UP</p>
                  </div>
                </div>
              </a> </div>
            <div class="col-md-6 col-sm-6 col-12  text-center"> <a href="application/financial-assistance"
                target="_blank">
                <div class="process_card wow hvr-float-shadow animate__fadeIn" data-animation="fadeInUp" data-delay="1s"
                  data-wow-duration="1s">
                  <div class="process_icon process_icon_2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                      viewBox="0 0 60 63">
                      <image y="2" width="59" height="59"
                        xlink:href="data:img/png;base64,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" />
                    </svg>
                  </div>
                  <div class="process_content">
                    <h4>Monthly Pension</h4>
                    <p>Application for Monthly Pension to Former Sportspersons of UP Awarded with Padma Shri/Dhyan
                      Chand/Arjun/Dronacharya/Khel Ratna/ Padma Bhushan </p>
                  </div>
                </div>
              </a> </div>
            <div class="col-md-6 col-sm-6 col-12  text-center"> <a href="application/direct-recruitment/"
                target="_blank">
                <div class="process_card wow hvr-float-shadow animate__fadeIn" data-animation="fadeInUp" data-delay="1s"
                  data-wow-duration="1s">
                  <div class="process_icon process_icon_6">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                      viewBox="0 0 60 63">
                      <image width="64"
                        xlink:href="data:img/png;base64,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" />
                    </svg>
                  </div>
                  <div class="process_content">
                    <h4>Direct Recruitment</h4>
                    <p>Online Application Submission for Direct Recruitment of International Games Medal Winner as
                      Gazetted Officer</p>
                  </div>
                </div>
              </a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>