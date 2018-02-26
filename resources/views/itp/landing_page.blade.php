@extends('layouts.app')

@section('content')

<header class="v-header container">
    <div class="fullscreen-video-wrap">
      <!--  https://www.videvo.net/video/typing-on-computer-white-bg/4475/ -->
      <!-- DO NOT USE THIS VIDEO, I JUST NEEDED A HOSTED VIDEO FOR THIS CODEPEN> USE THE ONE ABOVE -->
      <video src="{{ asset('program/typing.mp4') }}" autoplay="" loop="">
    </video>
    </div>
    <div class="header-overlay"></div>
    <div class="header-content text-md-center">
      <h1>Intern Training Program</h1>
      <p>A training program for aspiring students, which aims to help students who are into software development to access high value jobs from the high-demand sector.</p>
      <a class="btn btn-frst">Find Out More</a>
      <a class="btn btn-opposite">Register now!</a>

    </div>
</header>

<!-- <div class="landing-image">
  <div class="absolut-center">
    <span class="eee-bg-text" style="font-size: 50px; padding:10px; font-weight: bold;">Hire faster and effeciently.</span>
  </div>
</div> -->


  <div class="landing-cont-logos text-center">

<!--     <h4>
      Brought to you by:
    </h4> -->

          <!-- <i class="fa fa-bullhorn fa-3x"></i> -->
    <div class="row text-center justify-content-center">

      <div class="col-md-6 nexseed-logos">
        <figure>
          <a href="http://nexseed.net/" target="_blank">
            <img src="{{ asset('program/nexseed30.png')}}" class="nex-seedlogo" alt="Nexseed" style="padding-top: 5.5rem;">
          </a>
        </figure>
<!--         <h3 style="margin:0px;">Hiring Ads</h3>
        <div>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.
        </div> -->
      </div> 
      <div class="col-md-6 nexseed-logos">
        <figure>
          <a href="http://gscampcebu.fullspeedtechnologies.com/" target="_blank">
            <img src="{{ asset('program/gs.png')}}" class="gscamplogo" alt="G's Camp Cebu">
          </a>            
        </figure>
<!--         <h3 style="margin:0px;">Talent Search</h3>
        <div>
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur.
        </div> -->
      </div> 
    </div>
  </div>


<div style="transform: translateY(100px);">
  <div class="pricing-panel-a">
    <div class="container" style="color:#fff; text-align: initial!important;">

      <div class="col-md-12">
        <div class="section-title">
          Give yourself an advantage
        </div>
      </div>
      
      <div class="col-lg-6 col-md-6">
        <div class="feature-box-style-1">
          <div class="feature-icon">
            <i class="fa fa-line-chart"></i>
          </div>

          <div class="feature-title">
            Enhanced your programming skills
          </div>

          <div class="feature-desc">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate veritatis repellendus, dolores quas sed, sit hic necessitatibus adipisci id accusamus.
          </div>

        </div>
      </div>

      <div class="col-lg-6 col-md-6">
        <div class="feature-box-style-1">
          <div class="feature-icon">
            <i class="fa fa-bullhorn"></i>
          </div>

          <div class="feature-title">
            In demand programming languages
          </div>

          <div class="feature-desc">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis, repellat nobis assumenda eum explicabo ipsum enim aspernatur dolores quaerat culpa iure facere reprehenderit qui a dolorem vero, ullam, dolor eveniet.
          </div>
          
        </div>
      </div>

      <div class="col-lg-6 col-md-6">
        <div class="feature-box-style-1">
          <div class="feature-icon">
            <i class="fa fa-graduation-cap"></i>
          </div>

          <div class="feature-title">
            Get hired immediately after graduation
          </div>

          <div class="feature-desc">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim, sed, rem reprehenderit dolorem cupiditate perferendis!
          </div>
          
        </div>
      </div>

      <div class="col-lg-6 col-md-6">
        <div class="feature-box-style-1">
          <div class="feature-icon">
            <i class="fa fa-star"></i>
          </div>

          <div class="feature-title">
            Modern and Unique
          </div>

          <div class="feature-desc">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae, iusto, facilis? Optio in quaerat non possimus harum labore vero quia excepturi, dolorum deserunt porro id provident quibusdam sint consequatur sed hic ex! Porro, voluptatibus aspernatur.
          </div>
          
        </div>
      </div>

    </div>
  </div>

    <div class="course-outline">
      <div class="container-crs-outline container-crs-outline-qual">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>
              <i class="fa fa-star" aria-hidden="true"></i>
              <span style="padding-left: .5rem;">QUALIFICATIONS</span>
            </h4>
          </div>
          <ul class="list-group">
            <li class="list-group-item">
              <i class="fa fa-check-circle"></i>
              Enthusiastic to learn new technologies fast and quick.
            </li>
            <li class="list-group-item">
              <i class="fa fa-check-circle"></i>
              Knowledge in the following languages and technologies is a
              plus(Javascript,jQuery,MySQL).
            </li>
            <li class="list-group-item">
              <i class="fa fa-check-circle"></i>
              Understands the basics of HTML and CSS.
            </li>
          </ul>
        </div>        
      </div>
    </div>

    <div class="course-outline">
      <div class="container-crs-outline container-course-outline">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>
              <i class="fa fa-cog" aria-hidden="true"></i>
              <span style="padding-left: .5rem;">Course Outline:</span>
            </h4>
          </div>
          <ul class="list-group">
            <li class="list-group-item">Project Management</li>
            <li class="list-group-item">Basic Programming Concepts</li>
            <li class="list-group-item">Version Control Technology</li>
            <li class="list-group-item">Front-end Development</li>
            <li class="list-group-item">Web Servers</li>
            <li class="list-group-item">Database Management</li>
            <li class="list-group-item">Back-end Development</li>
            <li class="list-group-item">Testing</li>
          </ul>
        </div>        
      </div>
    </div>

    <div class="course-outline">
      <div class="container-crs-outline">
        <div class="panel panel-default">
          <div class="panel-heading">
              <h4>
                  <i class="fa fa-calendar" aria-hidden="true"></i>
                  <span style="padding-left: .5rem;">Schedule of Training</span>
              </h4>
          </div>

        <h3>Schedule of Training here!</h3>
        </div>        
      </div>
    </div>

    <div class="course-outline">
      <div class="container-crs-outline">
        <div class="panel panel-default">
          <div class="panel-heading">
              <h4>
                  <i class="fa fa-clipboard" aria-hidden="true"></i>
                  <span style="padding-left: .5rem;">CURRICULUM</span>
              </h4>
          </div>

        <h4>Our curriculum design is developed through a series of industry consultation. And through this, we are able to create a short course that will fill the high demand sector of the IT market.
        </h4>
        </div>        
      </div>
    </div>


    <div class="course-outline">
      <div class="container-crs-outline">
        <div class="panel panel-default">
          <div class="panel-heading">
              <h4>
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                  <span style="padding-left: .5rem;">Training Location</span>
              </h4>
          </div>

      <div style="height:500px;width:100%;">
        {!! Mapper::render() !!}
      </div>
        </div>        
      </div>
    </div>


  <section id="register" class="section overlay overlay-clr bg-cover bg4 light-text text-center">
    <div class="container">
      <h2>Register to Internship Program now!</h2>
      <p>Lorem Ipsum is simply dummy text of the printing and typesetting <br> industry. took a galley of type and scrambled it to make a type.</p>
      <br>
      <br>

      <!-- <a href="#" class="btn btn-lg btn-outline">Register</a> -->
      <a class="btn btn-reg-opposite">Register now!</a>

    </div>
  </section>



</div>

@endsection
