<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from portotheme.com/html/porto_ecommerce/demo-5/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Aug 2019 14:49:25 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title')</title>
{{--    <link rel="icon" type="image/x-icon" href="{{ url('/frontend') }}/assets/images/icons/favicon.ico">--}}
    <link rel="stylesheet" href="{{ url('/frontend') }}/assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
</head>
<body>
<div class="container mx-auto">
    <div class="flex justify-between items-center py-4 bg-blue-900">
        <div class="flex-shrink-0 ml-10 cursor-pointer">
            <i class="fas fa-drafting-compass fa-2x text-orange-500"></i>
            <span class="ml-1 text-3xl text-blue-200 font-semibold">WebCraft</span>
        </div>
        <i class="fas fa-bars fa-2x visible md:invisible mr-10 md:mr-0 text-blue-200 cursor-pointer"></i>
        <ul class="hidden md:flex overflow-x-hidden mr-10 font-semibold">
            <li class="mr-6 p-1 border-b-2 border-orange-500">
                <a class="text-blue-200 cursor-default" href="#">Home</a>
            </li>
            <li class="mr-6 p-1">
                <a class="text-white hover:text-blue-300" href="#">Services</a>
            </li>
            <li class="mr-6 p-1">
                <a class="text-white hover:text-blue-300" href="#">Projects</a>
            </li>
            <li class="mr-6 p-1">
                <a class="text-white hover:text-blue-300" href="#">Team</a>
            </li>
            <li class="mr-6 p-1">
                <a class="text-white hover:text-blue-300" href="#">About</a>
            </li>
            <li class="mr-6 p-1">
                <a class="text-white hover:text-blue-300" href="#">Contacts</a>
            </li>
        </ul>
    </div>
