@extends('layouts.user')

@section('user')
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ url('public/user') }}/images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <h1 class="mb-2 bread">Feedback</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home')}}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact <i class="ion-ios-arrow-forward"></i></span></p>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section contact-section">
    <div class="container">
      <div class="row d-flex contact-info">
        <div class="col-md-3 d-flex">
            <div class="bg-light align-self-stretch box p-4 text-center">
                <h3 class="mb-4">Address</h3>
              <p>Tầng 2 & tầng 5, Tòa nhà A17,, 17 Tạ Quang Bửu, Bách Khoa, Hai Bà Trưng, Hà Nội, Việt Nam</p>
            </div>
        </div>
        <div class="col-md-3 d-flex">
            <div class="bg-light align-self-stretch box p-4 text-center">
                <h3 class="mb-4">Contact Number</h3>
              <p><a href="tel://02438684321">+842438684321</a></p>
            </div>
        </div>
        <div class="col-md-3 d-flex">
            <div class="bg-light align-self-stretch box p-4 text-center">
                <h3 class="mb-4">Email Address</h3>
              <p><a href="contact@bkacad.edu.vn">contact@bkacad.edu.vn</a></p>
            </div>
        </div>
        <div class="col-md-3 d-flex">
            <div class="bg-light align-self-stretch box p-4 text-center">
                <h3 class="mb-4">Website</h3>
              <p><a href="https://www.bkacad.com/">https://www.bkacad.com/</a></p>
            </div>
        </div>
      </div>
    </div>
  </section>
      
      <section class="ftco-section ftco-no-pt ftco-no-pb contact-section">
          <div class="container">
              <div class="row d-flex align-items-stretch no-gutters">
                  <div class="col-md-6 p-4 p-md-5 order-md-last bg-light">
                      <form action="#">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Your Name">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Your Email">
            </div>
            <div class="form-group">
              <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
            </div>
          </form>
                  </div>
                  <div class="col-md-6 d-flex align-items-stretch">
                      <div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1809.3417022379451!2d105.84638441521432!3d21.00390237481348!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac743a47ec41%3A0xe0dd0b2919d48ce9!2zSOG7jWMgdmnhu4duIENOVFQgQsOhY2ggS2hvYQ!5e0!3m2!1svi!2s!4v1631353997982!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe></div>
                  </div>
              </div>
          </div>
      </section>

@endsection