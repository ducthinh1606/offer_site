<?php
include ('connect.php');

session_start();

if(!isset($_SESSION['username'])){
    header("location:login.php");
}elseif ($_SESSION['role'] == 1){

?>
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <base href="">
    <meta charset="utf-8" />
    <title>Metronic | Dashboard</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="assets/css/themes/layout/header/base/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/header/menu/dark.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/brand/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/aside/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--Pusher-->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="page-loading-enabled page-loading header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<!--begin::Page loader-->
<div class="page-loader page-loader-base">
    <div class="blockui">
        <span>Please wait...</span>
        <span>
               <div class="spinner spinner-primary"></div>
            </span>
    </div>
</div>
<!--end::Page Loader-->
<!--begin::Main-->
<!--begin::Header Mobile-->
<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
    <!--begin::Logo-->
    <a href="index.php">
        <img alt="Logo" src="assets/media/logos/logo-light.png" />
    </a>
    <!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
        <!--begin::Aside Mobile Toggle-->
        <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
            <span></span>
        </button>
        <!--end::Aside Mobile Toggle-->
        <!--begin::Topbar Mobile Toggle-->
        <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
               <span class="svg-icon svg-icon-xl">
                  <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                     </g>
                  </svg>
                   <!--end::Svg Icon-->
               </span>
        </button>
        <!--end::Topbar Mobile Toggle-->
    </div>
    <!--end::Toolbar-->
</div>
<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Aside-->
        <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
            <!--begin::Brand-->
            <div class="brand flex-column-auto" id="kt_brand">
                <!--begin::Logo-->
                <a href="index.php" class="brand-logo">
                    <img alt="Logo" src="assets/media/logos/logo-light.png" />
                </a>
                <!--end::Logo-->
                <!--begin::Toggle-->
                <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                     <span class="svg-icon svg-icon svg-icon-xl">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <polygon points="0 0 24 0 24 24 0 24" />
                              <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                              <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                           </g>
                        </svg>
                         <!--end::Svg Icon-->
                     </span>
                </button>
                <!--end::Toolbar-->
            </div>
            <!--end::Brand-->
            <!--begin::Aside Menu-->
            <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                <!--begin::Menu Container-->
                <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
                    <!--begin::Menu Nav-->
                    <ul class="menu-nav">
                        <li class="menu-item menu-item-active" aria-haspopup="true">
                            <a href="index.php" class="menu-link">
                              <span class="svg-icon menu-icon">
                                 <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                       <polygon points="0 0 24 0 24 24 0 24" />
                                       <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                       <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                 </svg>
                                  <!--end::Svg Icon-->
                              </span>
                                <span class="menu-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-section">
                            <h4 class="menu-text">Custom</h4>
                            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                        </li>
                        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                            <a href="history.php" class="menu-link menu-toggle">
                              <span class="svg-icon menu-icon">
                                 <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                       <rect x="0" y="0" width="24" height="24"/>
                                       <path d="M16.3740377,19.9389434 L22.2226499,11.1660251 C22.4524142,10.8213786 22.3592838,10.3557266 22.0146373,10.1259623 C21.8914367,10.0438285 21.7466809,10 21.5986122,10 L17,10 L17,4.47708173 C17,4.06286817 16.6642136,3.72708173 16.25,3.72708173 C15.9992351,3.72708173 15.7650616,3.85240758 15.6259623,4.06105658 L9.7773501,12.8339749 C9.54758575,13.1786214 9.64071616,13.6442734 9.98536267,13.8740377 C10.1085633,13.9561715 10.2533191,14 10.4013878,14 L15,14 L15,19.5229183 C15,19.9371318 15.3357864,20.2729183 15.75,20.2729183 C16.0007649,20.2729183 16.2349384,20.1475924 16.3740377,19.9389434 Z" fill="#000000"/>
                                       <path d="M4.5,5 L9.5,5 C10.3284271,5 11,5.67157288 11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L4.5,8 C3.67157288,8 3,7.32842712 3,6.5 C3,5.67157288 3.67157288,5 4.5,5 Z M4.5,17 L9.5,17 C10.3284271,17 11,17.6715729 11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L4.5,20 C3.67157288,20 3,19.3284271 3,18.5 C3,17.6715729 3.67157288,17 4.5,17 Z M2.5,11 L6.5,11 C7.32842712,11 8,11.6715729 8,12.5 C8,13.3284271 7.32842712,14 6.5,14 L2.5,14 C1.67157288,14 1,13.3284271 1,12.5 C1,11.6715729 1.67157288,11 2.5,11 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                 </svg>
                                  <!--end::Svg Icon-->
                              </span>
                                <span class="menu-text">Lịch Sử Trả Điểm</span>
                                <i class="menu-arrow"></i>
                            </a>
                        </li>
                        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                            <a href="account.php" class="menu-link menu-toggle">
                              <span class="svg-icon menu-icon">
                                 <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Barcode-read.svg-->
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                       <rect x="0" y="0" width="24" height="24"/>
                                       <path d="M5,2 L19,2 C20.1045695,2 21,2.8954305 21,4 L21,6 C21,7.1045695 20.1045695,8 19,8 L5,8 C3.8954305,8 3,7.1045695 3,6 L3,4 C3,2.8954305 3.8954305,2 5,2 Z M11,4 C10.4477153,4 10,4.44771525 10,5 C10,5.55228475 10.4477153,6 11,6 L16,6 C16.5522847,6 17,5.55228475 17,5 C17,4.44771525 16.5522847,4 16,4 L11,4 Z M7,6 C7.55228475,6 8,5.55228475 8,5 C8,4.44771525 7.55228475,4 7,4 C6.44771525,4 6,4.44771525 6,5 C6,5.55228475 6.44771525,6 7,6 Z" fill="#000000" opacity="0.3"/>
                                       <path d="M5,9 L19,9 C20.1045695,9 21,9.8954305 21,11 L21,13 C21,14.1045695 20.1045695,15 19,15 L5,15 C3.8954305,15 3,14.1045695 3,13 L3,11 C3,9.8954305 3.8954305,9 5,9 Z M11,11 C10.4477153,11 10,11.4477153 10,12 C10,12.5522847 10.4477153,13 11,13 L16,13 C16.5522847,13 17,12.5522847 17,12 C17,11.4477153 16.5522847,11 16,11 L11,11 Z M7,13 C7.55228475,13 8,12.5522847 8,12 C8,11.4477153 7.55228475,11 7,11 C6.44771525,11 6,11.4477153 6,12 C6,12.5522847 6.44771525,13 7,13 Z" fill="#000000"/>
                                       <path d="M5,16 L19,16 C20.1045695,16 21,16.8954305 21,18 L21,20 C21,21.1045695 20.1045695,22 19,22 L5,22 C3.8954305,22 3,21.1045695 3,20 L3,18 C3,16.8954305 3.8954305,16 5,16 Z M11,18 C10.4477153,18 10,18.4477153 10,19 C10,19.5522847 10.4477153,20 11,20 L16,20 C16.5522847,20 17,19.5522847 17,19 C17,18.4477153 16.5522847,18 16,18 L11,18 Z M7,20 C7.55228475,20 8,19.5522847 8,19 C8,18.4477153 7.55228475,18 7,18 C6.44771525,18 6,18.4477153 6,19 C6,19.5522847 6.44771525,20 7,20 Z" fill="#000000"/>
                                    </g>
                                 </svg>
                                  <!--end::Svg Icon-->
                              </span>
                                <span class="menu-text">Danh Sách Tài Khoản</span>
                                <i class="menu-arrow"></i>
                            </a>
                        </li>
                        <li class="menu-section">
                            <h4 class="menu-text">Tool</h4>
                            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                        </li>
                        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                            <a href="ssh_manager.php" class="menu-link menu-toggle">
                              <span class="svg-icon menu-icon">
                                 <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                       <rect x="0" y="0" width="24" height="24" />
                                       <path d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z" fill="#000000" fill-rule="nonzero" transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
                                       <path d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                 </svg>
                                  <!--end::Svg Icon-->
                              </span>
                                <span class="menu-text">Danh Sách SSH</span>
                                <i class="menu-arrow"></i>
                            </a>
                        </li>
                        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                            <a href="ssh247.php" class="menu-link menu-toggle">
                              <span class="svg-icon menu-icon">
                                 <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                       <rect x="0" y="0" width="24" height="24" />
                                       <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
                                       <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
                                    </g>
                                 </svg>
                                  <!--end::Svg Icon-->
                              </span>
                                <span class="menu-text">SSH 24/7</span>
                                <i class="menu-arrow"></i>
                            </a>
                        </li>
                        <li class="menu-section">
                            <h4 class="menu-text">Analyze</h4>
                            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                        </li>
                        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
                              <span class="svg-icon menu-icon">
                                 <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                       <rect x="0" y="0" width="24" height="24" />
                                       <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                       <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                    </g>
                                 </svg>
                                  <!--end::Svg Icon-->
                              </span>
                                <span class="menu-text">Thống Kê</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="member_analytics.php" class="menu-link menu-toggle">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Nhân Viên</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="app_analytics.php" class="menu-link menu-toggle">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">App</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-section">
                            <h4 class="menu-text">Management</h4>
                            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                        </li>
                        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
                              <span class="svg-icon menu-icon">
                                 <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Box2.svg-->
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                       <rect x="0" y="0" width="24" height="24" />
                                       <path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" fill="#000000" />
                                       <path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                 </svg>
                                  <!--end::Svg Icon-->
                              </span>
                                <span class="menu-text">Quản Trị Hệ Thống</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="network_manager.php" class="menu-link menu-toggle">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Quản Lý NetWork</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="app_manager.php" class="menu-link menu-toggle">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Quản Lý App</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                            <a href="member_manager.php" class="menu-link menu-toggle">
                              <span class="svg-icon menu-icon">
                                 <!--begin::Svg Icon | path:assets/media/svg/icons/Files/Pictures1.svg-->
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                       <rect x="0" y="0" width="24" height="24" />
                                       <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" fill="#000000" opacity="0.3" />
                                       <polygon fill="#000000" opacity="0.3" points="4 19 10 11 16 19" />
                                       <polygon fill="#000000" points="11 19 15 14 19 19" />
                                       <path d="M18,12 C18.8284271,12 19.5,11.3284271 19.5,10.5 C19.5,9.67157288 18.8284271,9 18,9 C17.1715729,9 16.5,9.67157288 16.5,10.5 C16.5,11.3284271 17.1715729,12 18,12 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                 </svg>
                                  <!--end::Svg Icon-->
                              </span>
                                <span class="menu-text">Quản Lý Nhân Viên</span>
                                <i class="menu-arrow"></i>
                            </a>
                        </li>
                    </ul>
                    <!--end::Menu Nav-->
                </div>
                <!--end::Menu Container-->
            </div>
            <!--end::Aside Menu-->
        </div>
        <!--end::Aside-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <!--begin::Header-->
            <div id="kt_header" class="header header-fixed">
                <!--begin::Container-->
                <div class="container-fluid d-flex align-items-stretch justify-content-between">
                    <!--begin::Header Menu Wrapper-->
                    <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                        <!--begin::Header Menu-->
                        <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                            <!--begin::Header Nav--><a href="javascript:;" class="menu-link menu-toggle"><i class="menu-arrow"></i>
                            </a>									<!--end::Header Nav-->
                        </div>
                        <!--end::Header Menu-->
                    </div>
                    <!--end::Header Menu Wrapper-->
                    <!--begin::Topbar-->
                    <div class="topbar">
                        <!--begin::Quick panel-->
                        <div class="topbar-item">
                            <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary" id="kt_quick_panel_toggle">
                              <span class="svg-icon svg-icon-xl svg-icon-primary">
                                 <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                       <rect x="0" y="0" width="24" height="24" />
                                       <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
                                       <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
                                    </g>
                                 </svg>
                              </span>
                                <span class="pulse-ring"></span>
                                <!--end::Svg Icon-->
                            </div>
                        </div>
                        <!--end::Quick panel-->
                        <!--begin::User-->
                        <div class="topbar-item">
                            <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                                <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                                <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">Saviart</span>
                                <span class="symbol symbol-35 symbol-light-success">
                              <span class="symbol-label font-size-h5 font-weight-bold">S</span>
                              </span>
                            </div>
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Topbar-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Header-->
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Subheader-->
                <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center flex-wrap mr-2">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                            <!--end::Page Title-->
                            <!--begin::Actions-->
                            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Toolbar-->
                        <!--end::Toolbar-->
                    </div>
                </div>
                <!--end::Subheader-->
                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container-fluid">
                        <!--begin::Dashboard-->
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <!--begin::Tiles Widget 11-->

                                        <?php
                                        $stmt_month = $conn->prepare("SELECT SUM(coins) as total, COUNT(id) as acc FROM `tblHistory` WHERE MONTH(datetime) = MONTH(CURDATE()) AND YEAR(DATETIME) = YEAR(CURDATE())");
                                        $stmt_month->setFetchMode(PDO::FETCH_ASSOC);
                                        $stmt_month->execute();

                                        $resultMonth = $stmt_month->fetchAll();
                                        $month = $resultMonth[0]['total'] == "" ? $month = 0 : $month = $resultMonth[0]['total']*0.001;
                                        $acc = $resultMonth[0]['acc'] == "" ? $acc = 0 : $acc = $resultMonth[0]['acc'];
                                        ?>

                                        <div class="card card-custom bg-danger gutter-b ribbon ribbon-clip ribbon-right" style="height: 150px">
                                            <div class="ribbon-target" style="top: 12px;">
                                                <span class="ribbon-inner bg-warning"></span>Month
                                            </div>
                                            <div class="card-body">
                                          <span class="svg-icon svg-icon-3x svg-icon-white ml-n2">
                                             <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                             <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                   <rect x="0" y="0" width="24" height="24" />
                                                   <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                                   <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                                                </g>
                                             </svg>
                                              <!--end::Svg Icon-->
                                          </span>
                                                <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3">$<?php echo $month ?></div>
                                                <a href="#" class="text-inverse-success font-weight-bold font-size-lg mt-1">Thu nhập</a>
                                            </div>
                                        </div>
                                        <!--end::Tiles Widget 11-->
                                    </div>
                                    <div class="col-xl-6">
                                        <!--begin::Tiles Widget 12-->
                                        <div class="card card-custom gutter-b" style="height: 150px">
                                            <div class="card-body">
                                          <span class="svg-icon svg-icon-3x svg-icon-success">
                                             <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                             <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                   <polygon points="0 0 24 0 24 24 0 24" />
                                                   <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                   <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                                </g>
                                             </svg>
                                              <!--end::Svg Icon-->
                                          </span>
                                                <div class="text-dark font-weight-bolder font-size-h2 mt-3"><?php echo $acc ?></div>
                                                <a href="#" class="text-muted text-hover-primary font-weight-bold font-size-lg mt-1">Tài Khoản</a>
                                            </div>
                                        </div>
                                        <!--end::Tiles Widget 12-->
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="card card-custom bgi-no-repeat gutter-b" style="height: 180px; background-color: #1B283F; background-position: calc(100% + 0.5rem) bottom; background-size: 25% auto; background-image: url(assets/media/svg/humans/custom-1.svg)">
                                            <!--begin::Body-->
                                            <div class="card-body d-flex align-items-center">
                                                <div class="py-2">
                                                    <h3 class="text-white font-weight-bolder mb-3">Theo Dõi Chấm Công</h3>
                                                    <p class="text-white font-size-sm">Bảng chấm công sẽ ghi lại toàn bộ khoảng thời gian
                                                        <br /> làm việc, nghỉ việc, nghĩ lễ
                                                        <br /> của nhân viên</p>
                                                    <a href="#" class="btn btn-link btn-link-warning font-weight-bold">Start Now
                                                        <span class="svg-icon svg-icon-lg svg-icon-warning">
															<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<polygon points="0 0 24 0 24 24 0 24" />
																	<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																	<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
																</g>
															</svg>
                                                            <!--end::Svg Icon-->
														</span></a>
                                                </div>

                                            </div>
                                            <!--end::Body-->
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-xl-8">
                                <!--begin::Card-->
                                <!--begin::Card-->
                                <div class="card card-custom gutter-b">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">Thống Kê Tình Hình Làm Việc Theo Ngày</h3>
                                        </div>
                                        <div class="card-toolbar">
                                            <div data-label="datepick">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <input type="text" id="dateFrom" class="form-control" placeholder="From">
                                                    </div><!-- col -->
                                                    <div class="col-4" >
                                                        <input type="text" id="dateTo" class="form-control" placeholder="To">
                                                    </div><!-- col -->


                                                    <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5" id="submit">Submit</button>



                                                </div><!-- row -->


                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="chart1" height="70" ></canvas>
                                    </div>
                                </div>
                                <!--end::Card-->
                            </div>

                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-xl-4">
                                <!--begin::Mixed Widget 14-->
                                <div class="card card-custom card-stretch gutter-b">
                                    <!--begin::Header-->
                                    <div class="card-header border-0 pt-5">
                                        <h3 class="card-title font-weight-bolder">Thống Kê Theo NetWork</h3>
                                        <div class="card-toolbar">
                                            <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                                                <li class="nav-item">
                                                    <a class="nav-link py-2 px-4 active" data-toggle="tab" href="#kt_tab_pane_1_1">Month</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_1_2">Week</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_1_3">Day</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body d-flex flex-column">
<!--                                    <span style=" position: absolute;-->
<!--                                       left: 50%;-->
<!--                                       top: 50%;-->
<!--                                       transform: translate(-50%, -100%);-->
<!--                                       font-weight: bold;" >$901</span>-->
                                        <canvas id="chartDonut"></canvas>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Mixed Widget 14-->
                            </div>
                            <div class="col-lg-8">
                                <!--begin::Advance Table Widget 4-->
                                <div class="card card-custom gutter-b">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">Thống Kê Theo App</h3>
                                        </div>
                                        <div class="card-toolbar">
                                            <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                                                <li class="nav-item">
                                                    <a class="nav-link py-2 px-4 active" data-toggle="tab" href="#kt_tab_pane_1_1">Month</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_1_2">Week</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_1_3">Day</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <canvas id="chart2" height="300" ></canvas>
                                    </div>
                                </div>
                                <!--end::Advance Table Widget 4-->
                            </div>
                        </div>
                        <!--end::Row-->

                        <!--end::Dashboard-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                <!--begin::Container-->
                <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <!--begin::Copyright-->
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted font-weight-bold mr-2">2020©</span>
                        <a href="https://www.facebook.com/blue.outtatime" target="_blank" class="text-dark-50 text-hover-primary font-weight-bold">Saviart</a>
                        <a class="text-dark-75 text-hover-primary">/</a>
                        <a href="https://www.facebook.com/sofukinez" target="_blank" class="text-dark-50 text-hover-primary font-weight-bold">Ducthinh</a>
                    </div>
                    <!--end::Copyright-->
                    <!--begin::Nav-->
                    <div class="nav nav-dark">
                        <span class="text-muted font-weight-bold mr-2">Contact</span>
                        <a href="https://www.facebook.com/tuananh221114" target="_blank" class="text-dark-50 text-hover-primary font-weight-bold">Quangpm87</a>
                    </div>
                    <!--end::Nav-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->
<!-- begin::User Panel-->
<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">User Profile</h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <div class="symbol-label" style="background-image:url('assets/media/users/saviart.jpg')"></div>
                <i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">Saviart</a>
                <div class="text-muted mt-1">Administrator</div>
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
                        <span class="navi-link p-0 pb-2">
                           <span class="navi-icon mr-1">
                              <span class="svg-icon svg-icon-lg svg-icon-primary">
                                 <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                       <rect x="0" y="0" width="24" height="24" />
                                       <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                       <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                    </g>
                                 </svg>
                                  <!--end::Svg Icon-->
                              </span>
                           </span>
                           <span class="navi-text text-muted text-hover-primary">thinh68869@gmail.com</span>
                        </span>
                    </a>
                    <a href="logout.php" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
                </div>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <!--end::Separator-->
        <!--begin::Nav-->
        <div class="navi navi-spacer-x-0 p-0">
        </div>
        <!--end::Nav-->
    </div>
    <!--end::Content-->
</div>
<!-- end::User Panel-->
<!--begin::Quick Panel-->
<div id="kt_quick_panel" class="offcanvas offcanvas-right pt-5 pb-10" style="background: #072A5A" >
    <!--begin::Header-->
    <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
        <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" >Tình Hình Đồng Bọn</a>
            </li>
        </ul>
        <div class="offcanvas-close mt-n1 pr-5" >
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content px-5" style ="background: #1e1e2d">
        <div class="tab-content">
            <!--begin::Tabpane-->
            <div class="tab-pane fade show pt-5 pr-5 mr-n5 active" id="kt_quick_panel_logs" role="tabpanel" >
                <!--begin::Section-->
                <div class="mb-10" id="result">
                    <!--begin: Item-->
                    <?php
                    $stmt_now = $conn->prepare("SELECT email, network_name, app_name, datetime, tblHistory.coins FROM tblHistory INNER JOIN tblUsers on tblUsers.id = tblHistory.tblUsers_id ORDER BY datetime DESC LIMIT 15");
                    $stmt_now->setFetchMode(PDO::FETCH_ASSOC);
                    $stmt_now->execute();
                    $resultNow = $stmt_now->fetchAll();

                    foreach ($resultNow as $row){
                    ?>

                    <div class="d-flex align-items-center flex-wrap mb-5" >
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <span  class="font-weight-bold text-success text-hover-primary font-size-sm"><?php echo $row['email'] ?></span>
                            <span class="text-muted font-size-sm"><?php echo $row['network_name'] ?></span>
                            <span class="text-muted font-size-sm"><?php echo $row['app_name'] ?></span>
                            <span class="text-muted font-size-sm"><?php echo $row['datetime'] ?></span>
                        </div>
                        <span class="btn btn-sm btn-success btn-shadow font-weight-bolder py-1 my-lg-0 my-2 text-light-50">+<?php echo $row['coins'] ?></span>
                    </div>

                    <?php }?>
                    <!--end: Item-->

                </div>
                <!--end::Section-->
            </div>
            <!--end::Tabpane-->
        </div>
    </div>
    <!--end::Content-->
</div>
<!--end::Quick Panel-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop">
         <span class="svg-icon">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
               <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <polygon points="0 0 24 0 24 24 0 24" />
                  <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                  <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
               </g>
            </svg>
             <!--end::Svg Icon-->
         </span>
</div>
<!--end::Scrolltop-->
<!--end::Demo Panel-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="assets/plugins/global/plugins.bundle.js?v=7.0.5"></script>
<script src="assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5"></script>
<script src="assets/js/scripts.bundle.js?v=7.0.5"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->
<script src="assets/plugins/custom/flot/flot.bundle.js?v=7.0.5"></script>
<!--end::Page Vendors-->
<script src="lib/chart.js/Chart.bundle.min.js"></script>
<script>
    var ctxColor1 ="#187de4";
    var ctxColor2 = "#f64e60";


    <?php

    $stmt1 = $conn->prepare("SELECT DAY(datetime) as d, MONTH(datetime) as m, SUM(coins) as total, COUNT(id) as acc FROM `tblHistory` WHERE MONTH(datetime) = MONTH(CURDATE()) AND YEAR(datetime) = YEAR(CURDATE()) GROUP BY DAY(datetime) ORDER BY datetime");
    $stmt1->setFetchMode(PDO::FETCH_ASSOC);
    $stmt1->execute();
    $resultSet1 = $stmt1->fetchAll();
    ?>

    var ctxLabel = [
        <?php
        $list=array();
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, date('m'), $d, date('Y'));
            if (date('m', $time)==date('m'))
                $list[]=date('d/m', $time);
        }
        for($i=0; $i<count($list); $i++){
            echo "'" . $list[$i] . "',";
        }
        ?>
    ]; //Ngày tháng

    <?php
    $data1 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);

    foreach ($resultSet1 as $row){

        $data1[$row['d'] - 1] = round($row['total']*0.001, 3);

    }

    $data2 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);

    foreach ($resultSet1 as $row){

        $data2[$row['d'] - 1] = $row['acc'];

    }

    ?>
    var data1 = <?php echo json_encode($data1) ?>;
    var data2 = <?php echo json_encode($data2) ?>;

    var randomScalingFactor = function () {
        return (Math.random() > 0.5 ? 1.0 : 1.0) * Math.round(Math.random() * 100);
    };

    // draws a rectangle with a rounded top
    Chart.helpers.drawRoundedTopRectangle = function (
        ctx,
        x,
        y,
        width,
        height,
        radius
    ) {
        ctx.beginPath();
        ctx.moveTo(x + radius, y);
        // top right corner
        ctx.lineTo(x + width - radius, y);
        ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
        // bottom right	corner
        ctx.lineTo(x + width, y + height);
        // bottom left corner
        ctx.lineTo(x, y + height);
        // top left
        ctx.lineTo(x, y + radius);
        ctx.quadraticCurveTo(x, y, x + radius, y);
        ctx.closePath();
    };

    Chart.elements.RoundedTopRectangle = Chart.elements.Rectangle.extend({
        draw: function () {
            var ctx = this._chart.ctx;
            var vm = this._view;
            var left, right, top, bottom, signX, signY, borderSkipped;
            var borderWidth = vm.borderWidth;

            if (!vm.horizontal) {
                // bar
                left = vm.x - vm.width / 2;
                right = vm.x + vm.width / 2;
                top = vm.y;
                bottom = vm.base;
                signX = 1;
                signY = bottom > top ? 1 : -1;
                borderSkipped = vm.borderSkipped || "bottom";
            } else {
                // horizontal bar
                left = vm.base;
                right = vm.x;
                top = vm.y - vm.height / 2;
                bottom = vm.y + vm.height / 2;
                signX = right > left ? 1 : -1;
                signY = 1;
                borderSkipped = vm.borderSkipped || "left";
            }

            // Canvas doesn't allow us to stroke inside the width so we can
            // adjust the sizes to fit if we're setting a stroke on the line
            if (borderWidth) {
                // borderWidth shold be less than bar width and bar height.
                var barSize = Math.min(Math.abs(left - right), Math.abs(top - bottom));
                borderWidth = borderWidth > barSize ? barSize : borderWidth;
                var halfStroke = borderWidth / 2;
                // Adjust borderWidth when bar top position is near vm.base(zero).
                var borderLeft =
                    left + (borderSkipped !== "left" ? halfStroke * signX : 0);
                var borderRight =
                    right + (borderSkipped !== "right" ? -halfStroke * signX : 0);
                var borderTop = top + (borderSkipped !== "top" ? halfStroke * signY : 0);
                var borderBottom =
                    bottom + (borderSkipped !== "bottom" ? -halfStroke * signY : 0);
                // not become a vertical line?
                if (borderLeft !== borderRight) {
                    top = borderTop;
                    bottom = borderBottom;
                }
                // not become a horizontal line?
                if (borderTop !== borderBottom) {
                    left = borderLeft;
                    right = borderRight;
                }
            }

            // calculate the bar width and roundess
            var barWidth = Math.abs(left - right);
            var roundness = this._chart.config.options.barRoundness || 0.5;
            var radius = barWidth * roundness * 1;

            // keep track of the original top of the bar
            var prevTop = top;

            // move the top down so there is room to draw the rounded top
            top = prevTop + radius;
            var barRadius = top - prevTop;

            ctx.beginPath();
            ctx.fillStyle = vm.backgroundColor;
            ctx.strokeStyle = vm.borderColor;
            ctx.lineWidth = borderWidth;

            // draw the rounded top rectangle
            Chart.helpers.drawRoundedTopRectangle(
                ctx,
                left,
                top - barRadius + 1,
                barWidth,
                bottom - prevTop,
                barRadius
            );

            ctx.fill();
            if (borderWidth) {
                ctx.stroke();
            }

            // restore the original top value so tooltips and scales still work
            top = prevTop;
        }
    });

    Chart.defaults.roundedBar = Chart.helpers.clone(Chart.defaults.bar);

    Chart.controllers.roundedBar = Chart.controllers.bar.extend({
        dataElementType: Chart.elements.RoundedTopRectangle
    });




    var barDataset = {
        type: "roundedBar",
        label: "Thu Nhập",
        yAxisID: "y-axis-1",
        data: data1,
        backgroundColor: ctxColor1,
        borderColor: ctxColor1,
        borderWidth: .5,

    };
    //data thu nhập

    var dataset = [];
    dataset.push(barDataset);
    //đẩy data vào mảng dataset


    var lineDataset = {
        type: "line",
        label: "Account",
        yAxisID: "y-axis-2",
        data: data2,
        backgroundColor: ctxColor2,
        borderColor: ctxColor2,
        fill: false,
        borderWidth: 2,
    };
    //data số tài khoản

    dataset.push(lineDataset);

    //đẩy data vào mảng dataset

    console.log(dataset);
    //in console ra mảng để kiểm tra cho dễ

    var ctx1 = document.getElementById("chart1").getContext("2d");
    new Chart(ctx1, {
        type: "roundedBar",
        data: {
            labels: ctxLabel,
            datasets: dataset,
        },
        options: {
            legend: {
                display: false,
            },
            scales: {
                yAxes: [
                    {
                        id: "y-axis-1",
                        position: "left",
                        type: "linear",
                        ticks: {
                            beginAtZero: true,
                        },
                    },
                    {
                        id: "y-axis-2",
                        gridLines: {
                            color: "rgba(0, 0, 0, 0)",
                        },
                        position: "right",
                        type: "linear",
                        ticks: {
                            beginAtZero: true,
                        },
                    },
                ],
                xAxes: [
                    {
                        gridLines: {
                            display: true,
                        },
                        scaleLabel: {
                            display: true,
                        },
                    },
                ],
            },
        },
    });

    Chart.draw();
    function test() {
        var from = document.getElementById("dateFrom").value;
        var to = document.getElementById("dateTo").value;
        $.ajax({
            type: "post",
            url: "ajax/test_ajax.php",
            data: {
                'from' : from,
                'to' : to
            },
            success: function (data) {
                var barDataset = {
                    type: "roundedBar",
                    label: "Thu Nhập",
                    yAxisID: "y-axis-1",
                    data: data1,
                    backgroundColor: ctxColor1,
                    borderColor: ctxColor1,
                    borderWidth: .5,

                };
                //data thu nhập

                var dataset = [];
                dataset.push(barDataset);
            }
        });
        return ctxLabel;
    }


    $("#submit").click(function () {
        ctxLabel = test();
        alert(ctxLabel);
    });

</script>

<?php
$count = 0;
$name_count = 0;

$name = [];
$ctxapp_other = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];

$stmt_getname = $conn->prepare("SELECT DISTINCT app_name FROM `tblApps`");
$stmt_getname->setFetchMode(PDO::FETCH_ASSOC);
$stmt_getname->execute();
$resultGetname = $stmt_getname->fetchAll();

foreach ($resultGetname as $row){
    array_push($name, $row['app_name']);
}


$stmt2 = $conn->prepare("SELECT app_name, DAY(datetime) as d, MONTH(datetime) as m, SUM(coins) as total, COUNT(tblHistory.id) as acc FROM `tblHistory` INNER JOIN tblApps on tblHistory.tblApps_id = tblApps.id WHERE MONTH(datetime) = MONTH(CURDATE()) AND YEAR(datetime) = YEAR(CURDATE()) GROUP BY DAY(datetime), tblApps_id");
$stmt2->setFetchMode(PDO::FETCH_ASSOC);
$stmt2->execute();
$resultSet2 = $stmt2->fetchAll();

foreach ($resultGetname as $row){
    $ctxapp[$name_count] = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];

    foreach ($resultSet2 as $row1){
        if ($row1['app_name'] == $name[$name_count]){
            $ctxapp[$name_count][$row1['d'] - 1] = round($row1['total']*0.001, 3);
        }
    }
    $name_count++;
}
?>

<script>
    var ctxColor0 = "#f77eb9";
    var ctxColor1 = "#7ebcff";
    var ctxColor2 = "#7ee5e5";
    var ctxColor3 = "#fdbd88";
    var ctxColor4 = "#F62217";
    var ctxColor5 = "#BDB76B";
    var ctxColor6 = "#4B0082";
    var ctxColor7 = "#00FF00";
    var ctxColor8 = "#008B8B";
    var ctxColor9 = "#0000CD";


    var ctxLabel = [
        <?php
        $list=array();
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, date('m'), $d, date('Y'));
            if (date('m', $time)==date('m'))
                $list[]=date('d/m', $time);
        }
        for($i=0; $i<count($list); $i++){
            echo "'" . $list[$i] . "',";
        }
        ?>
    ]; //Ngày tháng

    var ctx3 = document.getElementById("chart2").getContext("2d");
    new Chart(ctx3, {
        type: "bar",
        data: {
            labels: ctxLabel,
            datasets: [
                <?php
                foreach ($resultGetname as $row){
                        echo "{";
                        echo "data:" . json_encode($ctxapp[$count]) . ",";
                        echo "label: '" . $row['app_name'] . "',";
                        echo "backgroundColor: ctxColor" . $count . ",";
                        echo "},";
                        $count++;
                }
                ?>
            ],
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: true,
                labels: {
                    display: false,
                },
            },
            scales: {
                yAxes: [
                    {
                        stacked: true,
                        gridLines: {
                            color: "#e5e9f2",
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 10,
                            fontColor: "#182b49",
                        },
                    },
                ],
                xAxes: [
                    {
                        stacked: true,
                        gridLines: {
                            display: false,
                        },
                        barPercentage: 0.6,
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11,
                            fontColor: "#182b49",
                        },
                    },
                ],
            },
        },
    });
</script>
<script>
    /** PIE CHART **/

        <?php

        $stmt_network = $conn->prepare("SELECT network_name, SUM(coins) as total FROM `tblHistory` WHERE MONTH(datetime) = MONTH(CURDATE()) AND YEAR(DATETIME) = YEAR(CURDATE()) GROUP BY network_name");
        $stmt_network->setFetchMode(PDO::FETCH_ASSOC);
        $stmt_network->execute();

        $resultNetwork = $stmt_network->fetchAll();
        $i = 0;
        $labels = [];
        $data = [];
        $network = [];
        $color = ["#f77eb9", "#7ebcff", "#7ee5e5", "#fdbd88", "#F62217", "#BDB76B", "#4B0082", "#00FF00", "#008B8B", "#0000CD"];

        foreach ($resultNetwork as $row){
            array_push($labels, $row['network_name']);
        }

        foreach ($resultNetwork as $row){
            $network[$i] = round($row['total']*0.001, 3);
            $i++;
        }

        for($i = 0; $i < count($network); $i++){
            array_push($data, $network[$i]);
        }
        ?>

    var ctx = document.getElementById("chartDonut");
    var myChart = new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: <?php echo json_encode($labels)?>,
            datasets: [
                {
                    label: "",
                    data: <?php echo json_encode($data) ?>,
                    backgroundColor: <?php echo json_encode($color) ?>,
                }
            ]
        },
        options: {
            tooltips: {
                enabled: true,
                mode: "single",
                callbacks: {
                    label: function (tooltipItems, data) {
                        return (
                            data.labels[tooltipItems.index] +
                            data.datasets[tooltipItems.datasetIndex].label +
                            ": " +
                            "$" +
                            data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index]
                        );
                    }
                }
            },
            legend: {
                position: "bottom"
            }

        }
    });

</script>
<script>
    $(function(){

        var dateFormat = 'mm/dd/yy',
            from = $('#dateFrom')
                .datepicker({
                    defaultDate: '+1w',
                    numberOfMonths: 1
                })
                .on('change', function() {
                    to.datepicker('option','minDate', getDate( this ) );
                }),
            to = $('#dateTo').datepicker({
                defaultDate: '+1w',
                numberOfMonths: 1
            })
                .on('change', function() {
                    from.datepicker('option','maxDate', getDate( this ) );
                });

        function getDate( element ) {
            var date;
            try {
                date = $.datepicker.parseDate( dateFormat, element.value );
            } catch( error ) {
                date = null;
            }

            return date;
        }

    });
</script>
<script>

</script>

<!--real time-->
<script>

    var pusher = new Pusher('bb65a66741157850c668', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        $.ajax({url: "ajaxHistory.php", success: function(result){
                $("#result").html(result);
            }});
    });
</script>
</body>
<!--end::Body-->
</html>

<?php }else{
    echo "<script language='javascript'>";
    echo "if(!alert('Vui lòng truy cập bằng tài khoản Admin')){
    window.location.replace('logout.php');
}";
    echo "</script>";
} ?>