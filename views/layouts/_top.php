<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header border-end">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a
                class="nav-toggler waves-effect waves-light d-block d-md-none"
                href="javascript:void(0)"
            ><i class="ti-menu ti-close"></i
                ></a>
            <a class="navbar-brand" href="index.html">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img
                        src="../../assets/images/logos/logo-icon.png"
                        alt="homepage"
                        class="dark-logo"
                    />
                    <!-- Light Logo icon -->
                    <img
                        src="../../assets/images/logos/logo-light-icon.png"
                        alt="homepage"
                        class="light-logo"
                    />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                <!-- dark Logo text -->
                <img
                    src="../../assets/images/logos/logo-text.png"
                    alt="homepage"
                    class="dark-logo"
                />
                    <!-- Light Logo text -->
                <img
                    src="../../assets/images/logos/logo-light-text.png"
                    class="light-logo"
                    alt="homepage"
                />
              </span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a
                class="topbartoggler d-block d-md-none waves-effect waves-light"
                href="javascript:void(0)"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            ><i class="ti-more"></i
                ></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item d-none d-md-block">
                    <a
                        class="nav-link sidebartoggler waves-effect waves-light"
                        href="javascript:void(0)"
                        data-sidebartype="mini-sidebar"
                    ><i class="mdi mdi-menu fs-5"></i
                        ></a>
                </li>
                <!-- ============================================================== -->
                <!-- Messages -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle waves-effect waves-dark"
                        href=""
                        id="2"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i class="fs-5 mdi mdi-gmail"></i>
                        <div class="notify">
                            <span class="heartbit"></span>
                            <span class="point"></span>
                        </div>
                    </a>
                    <div
                        class="
                    dropdown-menu
                    mailbox
                    dropdown-menu-start dropdown-menu-animate-up
                  "
                        aria-labelledby="2"
                    >
                        <ul class="list-style-none">
                            <li>
                                <div class="border-bottom rounded-top py-3 px-4">
                                    <div class="mb-0 font-weight-medium fs-4">
                                        You have 4 new messages
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div
                                    class="message-center message-body position-relative"
                                    style="height: 230px"
                                >
                                    <!-- Message -->
                                    <a
                                        href="javascript:void(0)"
                                        class="
                            message-item
                            d-flex
                            align-items-center
                            border-bottom
                            px-3
                            py-2
                          "
                                    >
                          <span
                              class="user-img position-relative d-inline-block"
                          >
                            <img
                                src="../../assets/images/users/1.jpg"
                                alt="user"
                                class="rounded-circle w-100"
                            />
                            <span
                                class="profile-status rounded-circle online"
                            ></span>
                          </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                Pavan kumar
                                            </h5>
                                            <span
                                                class="
                                fs-2
                                text-nowrap
                                d-block
                                time
                                text-truncate
                                fw-normal
                                mt-1
                              "
                                            >Just see the my admin!</span
                                            >
                                            <span
                                                class="
                                fs-2
                                text-nowrap
                                d-block
                                subtext
                                text-muted
                              "
                                            >9:30 AM</span
                                            >
                                        </div>
                                    </a>
                                    <!-- Message -->
                                    <a
                                        href="javascript:void(0)"
                                        class="
                            message-item
                            d-flex
                            align-items-center
                            border-bottom
                            px-3
                            py-2
                          "
                                    >
                          <span
                              class="user-img position-relative d-inline-block"
                          >
                            <img
                                src="../../assets/images/users/2.jpg"
                                alt="user"
                                class="rounded-circle w-100"
                            />
                            <span
                                class="profile-status rounded-circle busy"
                            ></span>
                          </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                Sonu Nigam
                                            </h5>
                                            <span
                                                class="
                                fs-2
                                text-nowrap
                                d-block
                                time
                                text-truncate
                              "
                                            >I've sung a song! See you at</span
                                            >
                                            <span
                                                class="
                                fs-2
                                text-nowrap
                                d-block
                                subtext
                                text-muted
                              "
                                            >9:10 AM</span
                                            >
                                        </div>
                                    </a>
                                    <!-- Message -->
                                    <a
                                        href="javascript:void(0)"
                                        class="
                            message-item
                            d-flex
                            align-items-center
                            border-bottom
                            px-3
                            py-2
                          "
                                    >
                          <span
                              class="user-img position-relative d-inline-block"
                          >
                            <img
                                src="../../assets/images/users/3.jpg"
                                alt="user"
                                class="rounded-circle w-100"
                            />
                            <span
                                class="profile-status rounded-circle away"
                            ></span>
                          </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                Arijit Sinh
                                            </h5>
                                            <span
                                                class="
                                fs-2
                                text-nowrap
                                d-block
                                time
                                text-truncate
                              "
                                            >I am a singer!</span
                                            >
                                            <span
                                                class="
                                fs-2
                                text-nowrap
                                d-block
                                subtext
                                text-muted
                              "
                                            >9:08 AM</span
                                            >
                                        </div>
                                    </a>
                                    <!-- Message -->
                                    <a
                                        href="javascript:void(0)"
                                        class="
                            message-item
                            d-flex
                            align-items-center
                            border-bottom
                            px-3
                            py-2
                          "
                                    >
                          <span
                              class="user-img position-relative d-inline-block"
                          >
                            <img
                                src="../../assets/images/users/4.jpg"
                                alt="user"
                                class="rounded-circle w-100"
                            />
                            <span
                                class="profile-status rounded-circle offline"
                            ></span>
                          </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                Pavan kumar
                                            </h5>
                                            <span
                                                class="
                                fs-2
                                text-nowrap
                                d-block
                                time
                                text-truncate
                              "
                                            >Just see the my admin!</span
                                            >
                                            <span
                                                class="
                                fs-2
                                text-nowrap
                                d-block
                                subtext
                                text-muted
                              "
                                            >9:02 AM</span
                                            >
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a
                                    class="nav-link border-top text-center text-dark pt-3"
                                    href="javascript:void(0);"
                                >
                                    <b>See all e-Mails</b> <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- Comment -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle waves-effect waves-dark"
                        href=""
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i class="mdi mdi-check-circle fs-5"></i>
                        <div class="notify">
                            <span class="heartbit"></span>
                            <span class="point"></span>
                        </div>
                    </a>
                    <div
                        class="
                    dropdown-menu dropdown-menu-start
                    mailbox
                    dropdown-menu-animate-up
                  "
                    >
                        <ul class="list-style-none">
                            <li>
                                <div class="border-bottom rounded-top py-3 px-4">
                                    <div class="mb-0 font-weight-medium fs-4">
                                        Notifications
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div
                                    class="message-center notifications position-relative"
                                    style="height: 230px"
                                >
                                    <!-- Message -->
                                    <a
                                        href="javascript:void(0)"
                                        class="
                            message-item
                            d-flex
                            align-items-center
                            border-bottom
                            px-3
                            py-2
                          "
                                    >
                          <span
                              class="btn btn-light-danger text-danger btn-circle"
                          >
                            <i
                                data-feather="link"
                                class="feather-sm fill-white"
                            ></i>
                          </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                Luanch Admin
                                            </h5>
                                            <span
                                                class="
                                fs-2
                                text-nowrap
                                d-block
                                time
                                text-truncate
                                fw-normal
                                text-muted
                                mt-1
                              "
                                            >Just see the my new admin!</span
                                            >
                                            <span
                                                class="
                                fs-2
                                text-nowrap
                                d-block
                                subtext
                                text-muted
                              "
                                            >9:30 AM</span
                                            >
                                        </div>
                                    </a>
                                    <!-- Message -->
                                    <a
                                        href="javascript:void(0)"
                                        class="
                            message-item
                            d-flex
                            align-items-center
                            border-bottom
                            px-3
                            py-2
                          "
                                    >
                          <span
                              class="
                              btn btn-light-success
                              text-success
                              btn-circle
                            "
                          >
                            <i
                                data-feather="calendar"
                                class="feather-sm fill-white"
                            ></i>
                          </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                Event today
                                            </h5>
                                            <span
                                                class="
                                fs-2
                                text-nowrap
                                d-block
                                time
                                text-truncate
                                fw-normal
                                text-muted
                                mt-1
                              "
                                            >Just a reminder that you have event</span
                                            >
                                            <span
                                                class="
                                fs-2
                                text-nowrap
                                d-block
                                subtext
                                text-muted
                              "
                                            >9:10 AM</span
                                            >
                                        </div>
                                    </a>
                                    <!-- Message -->
                                    <a
                                        href="javascript:void(0)"
                                        class="
                            message-item
                            d-flex
                            align-items-center
                            border-bottom
                            px-3
                            py-2
                          "
                                    >
                          <span class="btn btn-light-info text-info btn-circle">
                            <i
                                data-feather="settings"
                                class="feather-sm fill-white"
                            ></i>
                          </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                Settings
                                            </h5>
                                            <span
                                                class="
                                fs-2
                                text-nowrap
                                d-block
                                time
                                text-truncate
                                fw-normal
                                text-muted
                                mt-1
                              "
                                            >You can customize this template as you want</span
                                            >
                                            <span
                                                class="
                                fs-2
                                text-nowrap
                                d-block
                                subtext
                                text-muted
                              "
                                            >9:08 AM</span
                                            >
                                        </div>
                                    </a>
                                    <!-- Message -->
                                    <a
                                        href="javascript:void(0)"
                                        class="
                            message-item
                            d-flex
                            align-items-center
                            border-bottom
                            px-3
                            py-2
                          "
                                    >
                          <span
                              class="
                              btn btn-light-primary
                              text-primary
                              btn-circle
                            "
                          >
                            <i
                                data-feather="users"
                                class="feather-sm fill-white"
                            ></i>
                          </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                Pavan kumar
                                            </h5>
                                            <span
                                                class="
                                fs-2
                                text-nowrap
                                d-block
                                time
                                text-truncate
                                fw-normal
                                text-muted
                                mt-1
                              "
                                            >Just see the my admin!</span
                                            >
                                            <span
                                                class="
                                fs-2
                                text-nowrap
                                d-block
                                subtext
                                text-muted
                              "
                                            >9:02 AM</span
                                            >
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a
                                    class="nav-link border-top text-center text-dark pt-3"
                                    href="javascript:void(0);"
                                >
                                    <strong>Check all notifications</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End Comment -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- mega menu -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown mega-dropdown">
                    <a
                        class="nav-link dropdown-toggle waves-effect waves-dark"
                        href="#"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                  <span class="d-none d-md-block"
                  >Mega <i class="icon-options-vertical"></i
                      ></span>
                        <span class="d-block d-md-none"
                        ><i class="mdi mdi-dialpad font-24"></i
                            ></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-animate-up">
                        <div class="mega-dropdown-menu row">
                            <div class="col-lg-3 col-xl-2 mb-4">
                                <h4 class="mb-3">CAROUSEL</h4>
                                <!-- CAROUSEL -->
                                <div
                                    id="carouselExampleControls"
                                    class="carousel slide carousel-dark"
                                    data-bs-ride="carousel"
                                >
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img
                                                class="d-block img-fluid"
                                                src="../../assets/images/big/img1.jpg"
                                                alt="First slide"
                                            />
                                        </div>
                                        <div class="carousel-item">
                                            <img
                                                class="d-block img-fluid"
                                                src="../../assets/images/big/img2.jpg"
                                                alt="Second slide"
                                            />
                                        </div>
                                        <div class="carousel-item">
                                            <img
                                                class="d-block img-fluid"
                                                src="../../assets/images/big/img3.jpg"
                                                alt="Third slide"
                                            />
                                        </div>
                                    </div>
                                    <a
                                        class="carousel-control-prev"
                                        href="#carouselExampleControls"
                                        role="button"
                                        data-bs-slide="prev"
                                    >
                          <span
                              class="carousel-control-prev-icon"
                              aria-hidden="true"
                          ></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a
                                        class="carousel-control-next"
                                        href="#carouselExampleControls"
                                        role="button"
                                        data-bs-slide="next"
                                    >
                          <span
                              class="carousel-control-next-icon"
                              aria-hidden="true"
                          ></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                </div>
                                <!-- End CAROUSEL -->
                            </div>
                            <div class="col-lg-3 mb-4">
                                <h4 class="mb-3">ACCORDION</h4>
                                <!-- Accordian -->
                                <div
                                    class="accordion accordion-flush"
                                    id="accordionFlushExample"
                                >
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button
                                                class="accordion-button collapsed"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseOne"
                                                aria-expanded="false"
                                                aria-controls="flush-collapseOne"
                                            >
                                                Accordion Item #1
                                            </button>
                                        </h2>
                                        <div
                                            id="flush-collapseOne"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="flush-headingOne"
                                            data-bs-parent="#accordionFlushExample"
                                        >
                                            <div class="accordion-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod
                                                high life accusamus terry richardson ad squid.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                            <button
                                                class="accordion-button collapsed"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseTwo"
                                                aria-expanded="false"
                                                aria-controls="flush-collapseTwo"
                                            >
                                                Accordion Item #2
                                            </button>
                                        </h2>
                                        <div
                                            id="flush-collapseTwo"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="flush-headingTwo"
                                            data-bs-parent="#accordionFlushExample"
                                        >
                                            <div class="accordion-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod
                                                high life accusamus terry richardson ad squid.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingThree">
                                            <button
                                                class="accordion-button collapsed"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseThree"
                                                aria-expanded="false"
                                                aria-controls="flush-collapseThree"
                                            >
                                                Accordion Item #3
                                            </button>
                                        </h2>
                                        <div
                                            id="flush-collapseThree"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="flush-headingThree"
                                            data-bs-parent="#accordionFlushExample"
                                        >
                                            <div class="accordion-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod
                                                high life accusamus terry richardson ad squid.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 mb-4">
                                <h4 class="mb-3">CONTACT US</h4>
                                <!-- Contact -->
                                <form>
                                    <div class="mb-3 form-floating">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="exampleInputname1"
                                            placeholder="Enter Name"
                                        />
                                        <label>Enter Name</label>
                                    </div>
                                    <div class="mb-3 form-floating">
                                        <input
                                            type="email"
                                            class="form-control"
                                            placeholder="Enter email"
                                        />
                                        <label>Enter Email address</label>
                                    </div>
                                    <div class="mb-3 form-floating">
                          <textarea
                              class="form-control"
                              id="exampleTextarea"
                              rows="3"
                              placeholder="Message"
                          ></textarea>
                                        <label>Enter Message</label>
                                    </div>
                                    <button
                                        type="submit"
                                        class="btn px-4 rounded-pill btn-info"
                                    >
                                        Submit
                                    </button>
                                </form>
                            </div>
                            <div class="col-lg-3 col-xlg-4 mb-4">
                                <h4 class="mb-3">List style</h4>
                                <!-- List style -->
                                <ul class="list-style-none">
                                    <li>
                                        <a href="#" class="font-weight-medium"
                                        ><i
                                                data-feather="check-circle"
                                                class="feather-sm text-success me-2"
                                            ></i>
                                            You can give link</a
                                        >
                                    </li>
                                    <li>
                                        <a href="#" class="font-weight-medium"
                                        ><i
                                                data-feather="check-circle"
                                                class="feather-sm text-success me-2"
                                            ></i>
                                            Give link</a
                                        >
                                    </li>
                                    <li>
                                        <a href="#" class="font-weight-medium"
                                        ><i
                                                data-feather="check-circle"
                                                class="feather-sm text-success me-2"
                                            ></i>
                                            Another Give link</a
                                        >
                                    </li>
                                    <li>
                                        <a href="#" class="font-weight-medium"
                                        ><i
                                                data-feather="check-circle"
                                                class="feather-sm text-success me-2"
                                            ></i>
                                            Forth link</a
                                        >
                                    </li>
                                    <li>
                                        <a href="#" class="font-weight-medium"
                                        ><i
                                                data-feather="check-circle"
                                                class="feather-sm text-success me-2"
                                            ></i>
                                            Another fifth link</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End mega menu -->
                <!-- ============================================================== -->
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav">
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <li class="nav-item search-box">
                    <form class="app-search d-none d-lg-block">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Search..."
                        />
                        <a href="" class="active"><i class="fa fa-search"></i></a>
                    </form>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle waves-effect waves-dark"
                        href="#"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <img
                            src="../../assets/images/users/1.jpg"
                            alt="user"
                            class="rounded-circle"
                            width="36"
                        />
                        <span class="ms-2 font-weight-medium">Steve</span
                        ><span class="fas fa-angle-down ms-2"></span>
                    </a>
                    <div
                        class="
                    dropdown-menu dropdown-menu-end
                    user-dd
                    animated
                    flipInY
                  "
                    >
                        <div
                            class="
                      d-flex
                      no-block
                      align-items-center
                      p-3
                      bg-info
                      text-white
                      mb-2
                    "
                        >
                            <div class="">
                                <img
                                    src="../../assets/images/users/1.jpg"
                                    alt="user"
                                    class="rounded-circle"
                                    width="60"
                                />
                            </div>
                            <div class="ms-2">
                                <h4 class="mb-0 text-white">Steave Jobs</h4>
                                <p class="mb-0">varun@gmail.com</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="#"
                        ><i
                                data-feather="user"
                                class="feather-sm text-info me-1 ms-1"
                            ></i>
                            My Profile</a
                        >
                        <a class="dropdown-item" href="#"
                        ><i
                                data-feather="credit-card"
                                class="feather-sm text-info me-1 ms-1"
                            ></i>
                            My Balance</a
                        >
                        <a class="dropdown-item" href="#"
                        ><i
                                data-feather="mail"
                                class="feather-sm text-success me-1 ms-1"
                            ></i>
                            Inbox</a
                        >
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"
                        ><i
                                data-feather="settings"
                                class="feather-sm text-warning me-1 ms-1"
                            ></i>
                            Account Setting</a
                        >
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"
                        ><i
                                data-feather="log-out"
                                class="feather-sm text-danger me-1 ms-1"
                            ></i>
                            Logout</a
                        >
                        <div class="dropdown-divider"></div>
                        <div class="ps-4 p-2">
                            <a href="#" class="btn d-block w-100 btn-info rounded-pill"
                            >View Profile</a
                            >
                        </div>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
