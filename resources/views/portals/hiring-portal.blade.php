@extends('layouts.app')

@section('content')

<style type="text/css">
  .landing-image{
    background:url("https://images.unsplash.com/photo-1448932223592-d1fc686e76ea?ixlib=rb-0.3.5&s=990bfb15aef2718e2488c1c36452afc4&auto=format&fit=crop&w=1498&q=80") center center / cover no-repeat fixed rgba(0, 0, 0, 0.7); height:450px;
    margin-top: -20px;
    position: relative;
  }

  .pricing-panel{
    min-height: 450px;
    padding-top: 10px;
    padding-bottom: 50px;
    background: #1679a3;
  }

  .bottom-image{
    height:450px;
    position: relative;
    overflow: hidden;
    text-align: center;
    background: #00ff614d;
  }

  .bottom-image .background-img{
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translateY(-50%) translateX(-50%);
    width: 100%;
    opacity: 0.3;
    min-width: 700px;
  }

  .absolut-center{
    position: absolute;
    left: 50%;
    top:50%;
    transform: translateY(-50%) translateX(-50%);
  }

  .max-width-500{
    max-width: 500px;
    width: 100%;
  }

  .price-tile{
    text-align: center;
    background: #f9f9f9;
    border: 2px solid #f5f5f5;
    padding: 40px 40px 50px;
    border-radius: 4px;
    margin-bottom: 40px;
    position: relative;
  }

  .price-tile .pricing-button{
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateY(-50%)translateX(-50%);
    border: 1px solid;
    padding: 10px 20px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 4px;
    max-width:120px;
    width: 100%;
  }

  .pricing{
    position: relative;
    display: inline-block;
    padding-left: 20px;
  }

  .price-tile .description{
    margin-top: 20px;
  }

  .pricing .currency{
    position: absolute;
    left: 0px;
    top: -20px;
    font-size: 20px;
    color: #1679a3;
  }

  .pricing-tile .dash{
    font-size: 100px;
    color:#cecece;
    margin-top: -60px;
    margin-bottom: -30px;
  }

  .pricing .price-num{
    font-size: 50px;
  }

  .register-bttn{
    padding: 10px 40px;
    border:1px solid;
    font-size: 20px;
    font-weight: bold;
    border-radius: 5px;
  }

  .eee-bg-text{
    display: inline;
    background: #eee;
  }

/*Video Hero*/

.v-header{
  height:100vh;
  display:flex;
  align-items:center;
  color:#fff;
}

.container{
  max-width:960px;
  padding-left:1rem;
  padding-right:1rem;
  margin:auto;
  text-align:center;
}

.fullscreen-video-wrap{
  position:absolute;
  top:0;
  left:0;
  width:100%;
  height:100vh;
  overflow:hidden;
}

.fullscreen-video-wrap video{
  min-height:100%;
  min-width:100%;
}

.header-overlay{
  height:100vh;
  position: absolute;
  top:0;
  left:0;
  width:100vw;
  z-index:1;
  background:#225470;
  opacity:0.85;
}

.header-content{
  z-index:2;
}

.header-content h1{
    font-weight: 900;
    font-size: 5rem;
    text-transform: uppercase;
    margin-bottom: 0;
    font-family: Roboto, sans-serif;
}

.header-content p{
    font-family: Raleway, sans-serif;
    font-size: 2rem;
    display: block;
    padding: 1rem 0 2rem 0;
}

header{
  margin:0;
  font-family: 'PT Sans', Tahoma, Geneva, Verdana, sans-serif;
  font-size:1rem;
  font-weight:normal;
  line-height:1.5;
  color:#333;
  overflow-x:hidden; 
}

.btn-frst{
    margin-left: 1.5rem;
    background: #fbc50a;
    color: #353535;
    font-size: 1.5rem;
    padding: 1rem 2rem;
    text-decoration: none;
    font-weight: 800;
    text-transform: uppercase;
    font-family: Roboto, sans-serif;
}

.btn-frst:hover{
    margin-left: 1.5rem;
    background: #fff;
    color: #0783c7;
}

.btn-opposite{
    border: solid 2px #fbc50a;
    margin-left: 1.5rem;
    background: rgba(255, 255, 255, .02);
    color: #ffffff;
    font-size: 1.5rem;
    padding: 1rem 2rem;
    text-decoration: none;
    font-weight: 800;
    text-transform: uppercase;
    font-family: Roboto, sans-serif;
}


.btn-opposite:hover{
    border: solid 2px white;
    margin-left: 1.5rem;
    background: rgba(255, 255, 255, .02);
    color: #ffffff;
}

.btn-reg-opposite{
    border: solid 2px #fbc50a;
    margin-left: 1.5rem;
    background: rgba(255, 255, 255, .02);
    color: #ffffff;
    font-size: 1.5rem;
    padding: 2rem 2rem;
    text-decoration: none;
    font-weight: 800;
    text-transform: uppercase;
    font-family: Roboto, sans-serif;
}

.btn-reg-opposite:hover{
    border: solid 2px white;
    margin-left: 1.5rem;
    background: rgba(255, 255, 255, .02);
    color: #ffffff;
}

#register h2{
    margin-top: 3rem;
    font-size: 3rem;
    font-family: Roboto,sans-serif;
    font-weight: 800;
    text-transform: uppercase;
}
#register p{
    font-size: 1.7rem;
}


#register{
  height: 300px;
  color: #fff;
  background-position: right;
  background-repeat: no-repeat;
  background: linear-gradient(rgba(22, 121, 163, .6), rgba(22, 121, 163, .6)),url("https://images.unsplash.com/photo-1482062364825-616fd23b8fc1?ixlib=rb-0.3.5&s=2d5a29bf54756acf6d32c46cdf60a63d&auto=format&fit=crop&w=1500&q=80");
  background-attachment: fixed;
}
.get-hired-p{
  font-size: 1.5rem;
  line-height: 1.7;
  margin-top: 1.5rem;
}
.get-hired-h3{
  text-transform: uppercase;
  font-size: 1.8rem;
  font-weight: 600;
  margin: 0.2rem 0 0 0;
}
.course-outline{
  background: #fff;
    max-width: 960px;
    padding-left: 1rem;
    padding-right: 1rem;
    margin: auto;
}
.container-crs-outline{
    margin: 4rem 0;
}

</style>


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


  <div style="max-width: 800px; height: 90px; margin:auto;margin-top: 25px;" class="text-center">

<!--     <h4>
      Brought to you by:
    </h4> -->

          <!-- <i class="fa fa-bullhorn fa-3x"></i> -->
    <div class="row text-center" style="margin-top: 25px">


      <div class="col-sm-6">
        <img src="{{ asset('program/nexseed.png')}}" alt="Nexseed" style="width: 230px; padding-top: 3rem;">        
<!--         <h3 style="margin:0px;">Hiring Ads</h3>
        <div>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.
        </div> -->
      </div> 
      <div class="col-sm-6">
        <img src="{{ asset('program/gs.jpg')}}" alt="G's Camp Cebu" style="width: 150px;">        
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
  <div class="pricing-panel">
<!--       <div class="container">
          <h2 class="text-center" style="color: #fff;">Program Benefits</h2>        
        <div class="row">
          <div class="col-md-6">
          <h1>aasd</h1>        
            
          </div>
          <div class="col-md-6">
          <h1>aasd</h1>        
          </div>
      </div>
    </div> -->
    <div class="container" style="color:#fff; margin-top:20px;">
      <div style="max-width: 800px; margin:auto;">
        <h2 style="font-size: 2.5rem;font-weight: 700;text-align: center;">
          Learn web development and get hired by companies
        </h2>

        <div class="row" style="margin-top: 50px;text-align: initial;">
          <div class="col-sm-4">
            <p class="fa fa-code" style="font-size: 40px; color:#d6a704;"></p>
            <h3 class="get-hired-h3">Languages company looking for</h3>
            <p class="get-hired-p">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo at, accusantium fugit ab dicta. Cupiditate enim sequi doloribus. Hic, reprehenderit.
            </p>
          </div> 
          <div class="col-sm-4">
            <p class="fa fa-search" style="font-size: 40px; color:#d6a704;"></p>
            <h3 class="get-hired-h3">Talent Search</h3>
            <p class="get-hired-p">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia commodi porro obcaecati quis, modi explicabo earum aliquam optio, accusantium saepe!
            </p>
          </div>
          <div class="col-sm-4">
            <p class="fa fa-industry" style="font-size: 40px; color:#d6a704;"></p>
            <h3 class="get-hired-h3">Get hired directly industry</h3>
            <p class="get-hired-p">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet, dolorum, repellat! Adipisci necessitatibus mollitia voluptatibus nemo, magnam facilis repellat corporis.
            </p>
          </div>             
        </div>
      </div>
    </div>
  </div>

    <div class="course-outline">
      <div class="container-crs-outline">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>
              <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" />
              QUALIFICATIONS
            </h4>
          </div>
          <ul class="list-group">
            <li class="list-group-item">
              <span class="glyphicon glyphicon-ok-circle" aria-hidden="true" />
              Enthusiastic to learn new technologies fast and quick.
            </li>
            <li class="list-group-item">
              <span class="glyphicon glyphicon-ok-circle" aria-hidden="true" />
              Knowledge in the following languages and technologies is a
              plus(Javascript,Java,MySQL).
            </li>
            <li class="list-group-item">
              <span class="glyphicon glyphicon-ok-circle" aria-hidden="true" />
              Understands the basics of HTML and CSS.
            </li>
          </ul>
        </div>        
      </div>
    </div>
  
    <div class="container">    
      <div style="padding:3rem 0;height:500px;width:100%;">
        {!! Mapper::render() !!}
      </div>
    </div>

<!--   <div class="bottom-image">
    <img class="background-img" src="https://images.unsplash.com/photo-1501228349589-c88664efb8b1?ixlib=rb-0.3.5&s=7398e0048350e751dfac951fd31933bf&auto=format&fit=crop&w=1500&q=80">
    <div class="max-width-500 absolut-center" style="color: white;">
      <h1>Get Started</h1>
      <div style="margin-top:50px;">
        <button type="button" class="register-bttn blue-bttn">Register</button>
      </div>
    </div>
  </div> -->

  <section id="register" class="section overlay overlay-clr bg-cover bg4 light-text align-center">
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
