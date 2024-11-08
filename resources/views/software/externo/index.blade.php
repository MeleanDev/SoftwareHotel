<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Maruma - Principal</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

   
    <link href="{{ asset('landing/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    
    <link href="{{ asset('landing/css/bootstrap.min.css') }}" rel="stylesheet">

   
    <link href="{{ asset('landing/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner-->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Cargando...</span>
            </div>
        </div>
        <!-- Spinner -->

        <!-- Header  -->
        <div class="container-fluid bg-dark px-0">
            <div class="row gx-0">
                <div class="col-lg-3 bg-dark d-none d-lg-block">
                    <a href="#" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('landing/img/logo.png') }}" width="150px"/>
                    </a>
                </div>
                <div class="col-lg-9">
                    <div class="row gx-0 bg-white d-none d-lg-flex">
                        <div class="col-lg-7 px-5 text-start">
                            <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                                <i class="fa fa-envelope text-primary me-2"></i>
                                <p class="mb-0">info@marumacrownplaza.com</p>
                            </div>
                            <div class="h-100 d-inline-flex align-items-center py-2">
                                <i class="fa fa-phone-alt text-primary me-2"></i>
                                <p class="mb-0">+0414 345 6789</p>
                            </div>
                        </div>
                        <div class="col-lg-5 px-5 text-end">
                            <div class="d-inline-flex align-items-center py-2">
                                <a class="me-3" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="me-3" href=""><i class="fab fa-twitter"></i></a>
                                <a class="me-3" href=""><i class="fab fa-linkedin-in"></i></a>
                                <a class="me-3" href=""><i class="fab fa-instagram"></i></a>
                                <a class="" href=""><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                        <a href="#" class="navbar-brand d-block d-lg-none">
                            <h1 class="m-0 text-primary text-uppercase"></h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="#" class="nav-item nav-link active">Inicio</a>
                                <a href="#Nosotros" class="nav-item nav-link">Nosotros</a>
                                <a href="#Servicios" class="nav-item nav-link">Servicios</a>
                                <a href="#" class="nav-item nav-link">Habitaciones</a>

                                <a href="contact.html" class="nav-item nav-link">Contactanos</a>
                            
                            
                            </div>
                            <a href="{{route('login')}}" class="btn btn-primary py-1 px-md-5 d-none d-sm-block">Iniciar Sesion</a>
                            <a href="{{route('register')}}" class="btn btn-light rounded-0 py-1 px-md-5 d-none d-sm-block">Registrarse </a>
                        </div>
                        
                    </nav>
                </div>
            </div>
        </div>
        <!-- Header End -->


        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100" src="{{ asset('landing/img/carousel-1.jpg') }}" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <div><img src="{{ asset('landing/img/logo.png') }}" width="200px"/></div>
                                <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Crown Plaza Maruma Hotel & Casino</h6>
                                <h1 class="display-6 text-white mb-4 animated slideInDown">Encuentra Tu Refugio en el Corazón de Maracaibo </h1>
                                <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft"> Habitaciones</a>
                                <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Reservar</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="w-100" src="{{ asset('landing/img/carousel-2.jpg') }}" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <div><img src="{{ asset('landing/img/logo.png') }}" width="200px"/></div>
                                <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Crown Plaza Maruma Hotel & Casino</h6>
                                <h1 class="display-6 text-white mb-4 animated slideInDown">Vive una experiencia de lujo en nuestras instalaciones</h1>
                                <a href="{{route('login')}}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Habitaciones</a>
                                <a href="{{route('login')}}" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Reservar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->


        <!-- Booking Start -->
        {{-- <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="bg-white shadow" style="padding: 35px;">
                    <div class="row justify-content-center g-2">
                        <div class="col-md-10">
                            <div class="row justify-content-center g-2">
                                <div class="col-md-3">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            placeholder="Check in" data-target="#date1" data-toggle="datetimepicker" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="date" id="date2" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" placeholder="Check out" data-target="#date2" data-toggle="datetimepicker"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select">
                                        <option selected>Adultos</option>
                                        <option value="1">1 persona</option>
                                        <option value="2">2 personas</option>
                                        <option value="3">3 personas</option>
                                        <option value="4">4 personas</option>
                                        <option value="5">5 personas</option>
                                        <option value="6">6 personas</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary w-100">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        
        <!-- Booking End -->


        <!-- About Start -->
        <div class="container-xxl py-5" id="Nosotros">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h6 class="section-title text-start text-primary text-uppercase">Acerca de nosotros</h6>
                        <h1 class="mb-4">Bienvenidos a <span class="text-primary text-uppercase">
                            Crowne Plaza Maruma Hotel & Casino</span></h1>
                        <p class="mb-4">En Crowne Plaza Maruma Hotel & Casino, nos enorgullece ofrecer una experiencia de lujo incomparable en el corazón de Maracaibo. Nuestro hotel combina comodidad y sofisticación en cada rincón, brindando a nuestros huéspedes un refugio exclusivo para disfrutar de momentos de relax, entretenimiento y negocios. Con instalaciones modernas, una variedad de opciones gastronómicas de clase mundial, y un casino vibrante, garantizamos una estancia única donde el servicio personalizado y la atención a los detalles son nuestra prioridad. Ven y descubre un espacio diseñado para superar todas tus expectativas.</p>
                        <div class="row g-3 pb-4">
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-hotel fa-2x text-primary mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">230</h2>
                                        <p class="mb-0">Habitaciones</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-users-cog fa-2x text-primary mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">142</h2>
                                        <p class="mb-0">Staffs</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">1336</h2>
                                        <p class="mb-0">Clientes</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-primary py-3 px-5 mt-2" href="">Explorar más</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="{{ asset('landing/img/about-1.jpg') }}" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="{{ asset('landing/img/about-2.jpg') }}">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="{{ asset('landing/img/about-3.jpg') }}">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="{{ asset('landing/img/about-4.jpg') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Room Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Nuestras Habitaciones</h6>
                    <h1 class="mb-5">Explora nuestras <span class="text-primary text-uppercase">Habitaciones</span></h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="{{ asset('landing/img/room-1.jpg') }}" alt="">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">$100/Noche</small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">Junior Suite</h5>
                                    <div class="ps-2">
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>3</small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>2</small>
                                    <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-primary rounded py-2 px-4" href="{{route('login')}}">Ver más</a>
                                    <a class="btn btn-sm btn-dark rounded py-2 px-4" href="{{route("login")}}">Reservar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="{{ asset('landing/img/room-2.jpg') }}" alt="">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">$100/Noche</small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">Executive Suite</h5>
                                    <div class="ps-2">
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>3</small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>2</small>
                                    <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-primary rounded py-2 px-4" href="{{route('login')}}">Ver más</a>
                                    <a class="btn btn-sm btn-dark rounded py-2 px-4" href="{{route("login")}}">Reservar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="{{ asset('landing/img/room-3.jpg') }}" alt="">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">$100/Noche</small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">Super Deluxe</h5>
                                    <div class="ps-2">
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>3</small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>2</small>
                                    <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-primary rounded py-2 px-4" href="{{route('login')}}">Ver más</a>
                                    <a class="btn btn-sm btn-dark rounded py-2 px-4" href="{{route("login")}}">Reservar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Room End -->


        <!-- Video Start -->
        <div class="container-xxl py-5 px-0 wow zoomIn" data-wow-delay="0.1s">
            <div class="row g-0">
                <div class="col-md-6 bg-dark d-flex align-items-center">
                    <div class="p-5">
                        <h6 class="section-title text-start text-white text-uppercase mb-3">Hospedaje de lujo</h6>
                        <h1 class="text-white mb-4">Descubre las instalaciones de lujo de nuestro hotel</h1>
                        <p class="text-white mb-4">Disfruta de una experiencia única en nuestras instalaciones de lujo, diseñadas para brindarte comodidad y elegancia en cada rincón. Relájate y déjate llevar por la atmósfera sofisticada, donde cada detalle ha sido pensado para que vivas momentos inolvidables.</p>
                        <a href="{{route('login')}}" class="btn btn-primary py-md-3 px-md-5 me-3">Reservar</a>
                       
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="video">
                        <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/watch?v=XhhBW0NhxZo"  allowfullscreen allowscriptaccess="always"
                                allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Video Start -->


        <!-- Service Start -->
        <div class="container-xxl py-5" id="Servicios">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Nuestros Servicios</h6>
                    <h1 class="mb-5">Explora Nuestros <span class="text-primary text-uppercase">Servicios</span></h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="service-item rounded" href="">
                            <div class="service-icon bg-transparent border rounded p-1">
                                <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                    <i class="fa fa-hotel fa-2x text-primary"></i>
                                </div>
                            </div>
                            <h5 class="mb-3">Habitaciones y Apartamentos</h5>
                            <p class="text-body mb-0">Disfruta de una estancia cómoda y lujosa en nuestras habitaciones y apartamentos, diseñados para ofrecer tranquilidad y comodidad a nuestros huéspedes.</p>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                        <a class="service-item rounded" href="">
                            <div class="service-icon bg-transparent border rounded p-1">
                                <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                    <i class="fa fa-utensils fa-2x text-primary"></i>
                                </div>
                            </div>
                            <h5 class="mb-3">Gastronomía y Restaurantes</h5>
                            <p class="text-body mb-0">Experimenta una variedad de platos de la mejor cocina nacional e internacional, preparados por nuestros chefs expertos para satisfacer todos los gustos.</p>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <a class="service-item rounded" href="">
                            <div class="service-icon bg-transparent border rounded p-1">
                                <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                    <i class="fa fa-spa fa-2x text-primary"></i>
                                </div>
                            </div>
                            <h5 class="mb-3">Spa y Fitness</h5>
                            <p class="text-body mb-0">Relájate en nuestro spa o mantente en forma en nuestro gimnasio, donde encontrarás servicios de primera clase para tu bienestar y salud.</p>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                        <a class="service-item rounded" href="">
                            <div class="service-icon bg-transparent border rounded p-1">
                                <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                    <i class="fa fa-swimmer fa-2x text-primary"></i>
                                </div>
                            </div>
                            <h5 class="mb-3">Deportes y Juegos</h5>
                            <p class="text-body mb-0">Disfruta de una amplia gama de actividades deportivas y juegos para toda la familia, con instalaciones diseñadas para el entretenimiento y la diversión.</p>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <a class="service-item rounded" href="">
                            <div class="service-icon bg-transparent border rounded p-1">
                                <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                    <i class="fa fa-glass-cheers fa-2x text-primary"></i>
                                </div>
                            </div>
                            <h5 class="mb-3">Eventos y Fiestas</h5>
                            <p class="text-body mb-0">Celebra tus eventos y fiestas con estilo en nuestros espacios, perfectos para crear momentos inolvidables con familiares y amigos.</p>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                        <a class="service-item rounded" href="">
                            <div class="service-icon bg-transparent border rounded p-1">
                                <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                    <i class="fa fa-dumbbell fa-2x text-primary"></i>
                                </div>
                            </div>
                            <h5 class="mb-3">Gimnasio y Yoga</h5>
                            <p class="text-body mb-0">Mantente en forma en nuestro gimnasio equipado o participa en sesiones de yoga que revitalizarán tu cuerpo y mente.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Service End -->


        <!-- Newsletter Start -->
        <div class="container newsletter mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="row justify-content-center">
                {{-- <div class="col-lg-10 border rounded p-1">
                    <div class="border rounded text-center p-1">
                        <div class="bg-white rounded text-center p-5">
                            <h4 class="mb-4">Suscribete a nuestro <span class="text-primary text-uppercase">Newsletter</span></h4>
                            <div class="position-relative mx-auto" style="max-width: 400px;">
                                <input class="form-control w-100 py-3 ps-4 pe-5" type="text" placeholder="Introduce tu email">
                                <button type="button" class="btn btn-primary py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">Enviar</button>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- Newsletter Start -->
        

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer wow fadeIn" data-wow-delay="0.1s">
            <div class="container pb-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-4 d-flex justify-content-center">
                        <div class="bg-primary rounded p-4 text-center">
                            <a href="index.html">
                                <h1 class="text-white text-uppercase mb-3">
                                    <img src="{{ asset('landing/img/logo.png') }}" width="280px"/>
                                </h1>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h6 class="section-title text-start text-primary text-uppercase mb-4">Contacto</h6>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Avenida 2, El Milagro, Maracaibo, Venezuela</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+58 261 1234567</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@marumacrownplaza.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="row gy-5 g-4">
                            <div class="col-md-6">
                                <h6 class="section-title text-start text-primary text-uppercase mb-4">Compañía</h6>
                                <a class="btn btn-link" href="">Sobre Nosotros</a>
                                <a class="btn btn-link" href="">Contáctanos</a>
                                <a class="btn btn-link" href="">Política de Privacidad</a>
                                <a class="btn btn-link" href="">Términos y Condiciones</a>
                                <a class="btn btn-link" href="">Soporte</a>
                            </div>
                            <div class="col-md-6">
                                <h6 class="section-title text-start text-primary text-uppercase mb-4">Servicios</h6>
                                <a class="btn btn-link" href="">Alimentos y Restaurantes</a>
                                <a class="btn btn-link" href="">Spa y Fitness</a>
                                <a class="btn btn-link" href="">Deportes y Juegos</a>
                                <a class="btn btn-link" href="">Eventos y Fiestas</a>
                                <a class="btn btn-link" href="">Gimnasio y Yoga</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Crown Plaza Maruma Hotel & Casino</a>, Todos los derechos reservados.
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Inicio</a>
                                <a href="">Cookies</a>
                                <a href="">Ayuda</a>
                                <a href="">Preguntas Frecuentes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('landing/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('landing/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('landing/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('landing/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('landing/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('landing/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('landing/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('landing/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('landing/js/main.js') }}"></script>
</body>

</html>