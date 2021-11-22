<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suites Apartment</title>

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/font-awesome.css') }}">

</head>
<body>
    
<!-- header section starts  -->

<header>

    <a href="#" class="logo"><span>Suites </span>Apartment</a>

    <nav class="navbar">
        <a href="#home">beranda</a>
        <a href="#services">pelayanan kami</a>
        <a href="#featured">produk kami</a>
        <a href="#agents">agent</a>
        <a href="#contact">kontak</a>
    </nav>

    <div class="icons">
        <div id="menu-bars" class="fa fa-bars"></div>
    </div>

</header>

<!-- header section ends -->

<!-- Awal Carousel -->
<div class="slideshow-container">
    <center>
        @foreach($dataBanner as $val)
        <div class="mySlides fade">
            <img class="image_custom" src="{{ asset('assets/images/'.$val->gambar_banner) }}">
        </div>
        @endforeach
    </center>
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<!-- AKhir Carousel -->

<!-- services section starts  -->

<section class="services" id="services">
    <h1 class="heading"> Pelayanan <span>kami</span> </h1>
    <div class="box-container">
        <div class="box">
            <img src="{{ asset('assets/images/s-1.png') }}">
            <h3>Pembelian Apartment</h3>
            <p>Pembelian Apartment yang dapat dipercayai hanya di Suites Apartment</p>
        </div>

        <div class="box">
            <img src="{{ asset('assets/images/s-2.png') }}">
            <h3>Penyewaan Apartment</h3>
            <p>Penyewaan Apartment yang dapat dipercayai hanya di Suites Apartment</p>
        </div>

        <div class="box">
            <img src="{{ asset('assets/images/s-3.png') }}">
            <h3>Penjualan Apartment</h3>
            <p>Penjualan Apartment yang dapat dipercayai hanya di Suites Apartment</p>
        </div>
    </div>
</section>

<!-- services section ends -->

<!-- featured section starts  -->

<section class="featured" id="featured">
    <h1 class="heading"> <span>Produk</span> kami </h1>
    <div class="box-container">
        @foreach($dataRoom as $xin)
        <div class="box">
            <div class="image-container">
                <img src="{{ asset('assets/img_apart/'.$xin->image) }}">
                <div class="info">
                    <h3>{{ $xin->waktu_posting }}</h3>
                    <h3>{{ $xin->nama_tipe }}</h3>
                </div>
                <div class="icons">
                    <a href="#" class="fa fa-film"><h3>1</h3></a>
                    <a href="#" class="fa fa-camera"><h3>4</h3></a>
                </div>
            </div>
            <div class="content">
                <div class="price">
                    <h3>Rp.{{ number_format($xin->harga) }}</h3>
                    <a href="#" class="fa fa-heart"></a>
                    <a href="#" class="fa fa-envelope"></a>
                    <a href="#" class="fa fa-phone"></a>
                </div>
                <div class="location">
                    <h3>{{ $xin->nama_apartment }}</h3>
                    <p>{{ $xin->alamat }}</p>
                </div>
                <div class="details">
                    <h3> <i class="fa fa-expand"></i> {{ $xin->ukuran }} </h3>
                    <h3> <i class="fa fa-bed"></i> {{ $xin->kamar_tidur }} </h3>
                    <h3> <i class="fa fa-bath"></i> {{ $xin->kamar_mandi }} </h3>
                </div>
                <div class="buttons">
                    <a href="#" class="btn">info lanjut</a>
                    <a href="#" class="btn">view details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- featured section ends -->

<!-- agents section starts  -->

<section class="agents" id="agents">

    <h1 class="heading"> agen <span>profesional</span> </h1>

    <div class="box-container">

        <div class="box">
            <a href="#" class="fa fa-envelope"></a>
            <a href="#" class="fa fa-phone"></a>
            <img src="{{ asset('assets/images/pic-1.png') }}" alt="">
            <h3>john deo</h3>
            <span>agent</span>
            <div class="share">
                <a href="#" class="fa fa-facebook-f"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-instagram"></a>
                <a href="#" class="fa fa-linkedin"></a>
            </div>
        </div>

        <div class="box">
            <a href="#" class="fa fa-envelope"></a>
            <a href="#" class="fa fa-phone"></a>
            <img src="{{ asset('assets/images/pic-2.png') }}" alt="">
            <h3>john deo</h3>
            <span>agent</span>
            <div class="share">
                <a href="#" class="fa fa-facebook-f"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-instagram"></a>
                <a href="#" class="fa fa-linkedin"></a>
            </div>
        </div>

        <div class="box">
            <a href="#" class="fa fa-envelope"></a>
            <a href="#" class="fa fa-phone"></a>
            <img src="{{ asset('assets/images/pic-3.png') }}" alt="">
            <h3>john deo</h3>
            <span>agent</span>
            <div class="share">
                <a href="#" class="fa fa-facebook-f"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-instagram"></a>
                <a href="#" class="fa fa-linkedin"></a>
            </div>
        </div>

        <div class="box">
            <a href="#" class="fa fa-envelope"></a>
            <a href="#" class="fa fa-phone"></a>
            <img src="{{ asset('assets/images/pic-4.png') }}" alt="">
            <h3>john deo</h3>
            <span>agent</span>
            <div class="share">
                <a href="#" class="fa fa-facebook-f"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-instagram"></a>
                <a href="#" class="fa fa-linkedin"></a>
            </div>
        </div>

    </div>

</section>

<!-- agents section ends -->

<!-- contact section starts  -->

<section class="contact" id="contact">

<h1 class="heading"> <span>Kontak</span> kami </h1>

<div class="icons-container">

    <div class="icons">
        <img src="{{ asset('assets/images/icon-1.png') }}" alt="">
        <h3>phone number</h3>
        <p>+123-456-7890</p>
        <p>+111-222-3333</p>
    </div>

    <div class="icons">
        <img src="{{ asset('assets/images/icon-2.png') }}" alt="">
        <h3>email address</h3>
        <p>shaikhanas@gmail.com</p>
        <p>anasshaikha@gmail.com</p>
    </div>

     <div class="icons">
        <img src="{{ asset('assets/images/icon-3.png') }}" alt="">
        <h3>office address</h3>
        <p>jogeshwari, mumbai, india - 400104</p>
    </div>

</div>

</section>


@extends('footer')