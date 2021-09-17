@extends('layouts.user')

@section('user')
    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image:url({{ url('public/user') }}/images/bg_1.jpg);">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
                    <div class="col-md-6 ftco-animate">
                        <h1 class="mb-4">Mục tiêu mở rộng đào tạo theo chuẩn Quốc tế</h1>
                        <p>Khảo thí chứng chỉ quốc tế và là một thành viên của Hệ thống BK-Holdings, ĐH Bách Khoa Hà Nội.</p>
                        <p><a href="{{ route('contact')}}" class="btn btn-primary px-4 py-3 mt-3">Feedback</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-item" style="background-image:url({{ url('public/user') }}/images/bg_2.jpg);">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-start"
                    data-scrollax-parent="true">
                    <div class="col-md-6 ftco-animate">
                        <h1 class="mb-4">Cisco Networking Academy Program</h1>
                        <p>cung cấp kiến thức, kỹ năng CNTT mới nhất cho sinh viên.</p>
                        <p><a href="{{ route('contact')}}" class="btn btn-primary px-4 py-3 mt-3">Contact</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_3.jpg);"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-2 d-flex">
                <div class="col-md-6 align-items-stretch d-flex">
                    <div class="img img-video d-flex align-items-center" style="background-image: url(https://i.ytimg.com/vi/vfvT_QiwNzE/sddefault.jpg);">
                        <div class="video justify-content-center">
                            <a href="https://youtu.be/vfvT_QiwNzE"
                                class="icon-video popup-vimeo d-flex justify-content-center align-items-center">
                                <span class="ion-ios-play"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 heading-section heading-section-white ftco-animate pl-lg-5 pt-md-0 pt-5">
                    <h2 class="mb-4"> Học viện công nghệ BKACAD</h2>
                    <p>Chương trình Học viện mạng Cisco (Cisco Networking Academy Program) được thành lập từ năm 1997 bởi Tập đoàn Cisco Systems có mục tiêu hợp tác với các trường Đại học, Cao đẳng trong đào tạo và nghiên cứu chuyển giao công nghệ, cung cấp kiến thức, kỹ năng CNTT mới nhất cho sinh viên. Đến nay, Chương trinh Học viện mạng Cisco đã có mặt trên 180 nước, đào tạo hơn 12.7 triệu sinh viên, hợp tác với 11,800 trường, tổ chức trên toàn thế giới.</p>
                    <p>hệ thống quản lý học tập trực tuyến, cộng đồng, đội ngũ vận hành, chuyên gia đào tạo nhằm mang lại những kiến thức, kỹ năng công nghệ mới nhất cho sinh viên.</p>
                </div>
            </div>
            <div class="row d-md-flex align-items-center justify-content-center">
                <div class="col-lg-12">
                    <div class="row d-md-flex align-items-center">
                        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="icon"><span class="flaticon-doctor"></span></div>
                                <div class="text">
                                    <strong class="number" data-number="10">0</strong>
                                    <span>Certified Teachers</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="icon"><span class="flaticon-doctor"></span></div>
                                <div class="text">
                                    <strong class="number" data-number="401">0</strong>
                                    <span>Students</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="icon"><span class="flaticon-doctor"></span></div>
                                <div class="text">
                                    <strong class="number" data-number="{{$major->count()}}">0</strong>
                                    <span>Courses</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18">
                                <div class="icon"><span class="flaticon-doctor"></span></div>
                                <div class="text">
                                    <strong class="number" data-number="50">0</strong>
                                    <span>Awards Won</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
