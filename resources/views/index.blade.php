<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Landing Page - Smart Agriculture</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        @include('layouts.main')
        <!-- Masthead-->
        {{-- @foreach ($highlights as $highlight) --}}
        <header class="masthead" style="background-image: url('img/steven-weeks-DUPFowqI6oI-unsplash(1).jpg');">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="text-center text-white">
                            <!-- Page heading-->
                            <h1 class="mb-5">
                                    {{-- {{ $highlight->title }} --}}
                                    Selamat datang di website Smart Agriculture
                            </h1>
                            <!-- Signup form-->
                            <!-- * * * * * * * * * * * * * * *-->
                            <!-- * * SB Forms Contact Form * *-->
                            <!-- * * * * * * * * * * * * * * *-->
                            <!-- This form is pre-integrated with SB Forms.-->
                            <!-- To make this form functional, sign up at-->
                            <!-- https://startbootstrap.com/solution/contact-forms-->
                            <!-- to get an API token!-->
                            <form class="form-subscribe" id="contactForm" data-sb-form-api-token="API_TOKEN">
                                <!-- Email address input-->
                                {{-- <div class="row">
                                    <div class="col">
                                        <input class="form-control form-control-lg" id="emailAddress" type="email" placeholder="Alamat email" data-sb-validations="required,email" />
                                        <div class="invalid-feedback text-white" data-sb-feedback="emailAddress:required">Alamat email wajib diisi</div>
                                        <div class="invalid-feedback text-white" data-sb-feedback="emailAddress:email">Alamat email tidak valid</div>
                                    </div>
                                    <div class="col-auto"><button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit">Submit</button></div>
                                </div> --}}
                                <!-- Submit success message-->
                                <!-- This is what your users will see when the form-->
                                <!-- has successfully submitted-->
                                <div class="d-none" id="submitSuccessMessage">
                                    <div class="text-center mb-3">
                                        <div class="fw-bolder">Form submission successful!</div>
                                        <p>To activate this form, sign up at</p>
                                        <a class="text-white" href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                    </div>
                                </div>
                                <!-- Submit error message-->
                                <!-- This is what your users will see when there is-->
                                <!-- an error submitting the form-->
                                <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        {{-- @endforeach --}}
        
        <!-- Icons Grid-->
        
        <section class="features-icons bg-light text-center">
            <div class="container">
                <div class="row">
                    {{-- @foreach ($features as $feature)
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-layers m-auto text-primary"></i></div>
                            <h3>{{ $feature->title }}</h3>
                            <p class="lead mb-0">{{ $feature->description }}</p>
                        </div>
                    </div>
                    @endforeach --}}
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-layers m-auto text-primary"></i></div>
                            <h3>Fitur #1</h3>
                            <p class="lead mb-0">Menampilkan hasil dari alat Smart Agriculture yang terdiri dari Tanah Pintar (Smart Soil) dan Air Pintar (Smart Irrigation)</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-layers m-auto text-primary"></i></div>
                            <h3>Fitur #2</h3>
                            <p class="lead mb-0">Terdapat fitur pemetaan untuk mengetahui lokasi pengukuran alat Smart Agriculture dilakukan</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-layers m-auto text-primary"></i></div>
                            <h3>Fitur #3</h3>
                            <p class="lead mb-0">Terdapat visualisasi grafik mengenai hasil pengukuran terakhir</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Testimonials-->
        <section class="testimonials text-center bg-light">
            <div class="container">
                <h2 class="mb-5">Testimoni dari beberapa pengguna..</h2>
                <div class="row">
                    {{-- @foreach ($testimonials as $testimonial) --}}
                    {{-- <div class="col-lg-4">
                        <i class="bi bi-person-circle m-auto text-primary" style="font-size: 90px;"></i>
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <h5>Fitur #1</h5>
                            <p class="font-weight-light mb-0">Menampilkan hasil dari alat Smart Agriculture yang terdiri dari Tanah Pintar (Smart Soil) dan Air Pintar (Smart Irrigation)</p>
                        </div>
                    </div> --}}
                    {{-- @endforeach --}}
                    <div class="col-lg-4">
                        <i class="bi bi-person-circle m-auto text-primary" style="font-size: 90px;"></i>
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <h5>Pengguna #1</h5>
                            <p class="font-weight-light mb-0">Website berikut membantu proses pemetaan lahan untuk mengetahui lokasi dari pengukuran yang telah dilakukan pada alat Smart Agriculture</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <i class="bi bi-person-circle m-auto text-primary" style="font-size: 90px;"></i>
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <h5>Pengguna #2</h5>
                            <p class="font-weight-light mb-0">Website pemetaan dan kemudian menampilkan hasil pengukuran alat Smart Agriculture ini memiliki fitur yang responsif</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <i class="bi bi-person-circle m-auto text-primary" style="font-size: 90px;"></i>
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <h5>Pengguna #3</h5>
                            <p class="font-weight-light mb-0">Grafik dalam website pemetaan dan kemudian menampilkan hasil pengukuran alat Smart Agriculture ini memiliki visualisasi grafik masing-masing parameter pengukuran</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       <!-- Footer-->
        <footer class="footer bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
                        {{-- <ul class="list-inline mb-2">
                            <li class="list-inline-item"><a href="#!">About</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Contact</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Terms of Use</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Privacy Policy</a></li>
                        </ul> --}}
                        <p class="text-muted small mb-4 mb-lg-0">&copy; Smart Agriculture 2024. All Rights Reserved.</p>
                    </div>
                    <div class="col-lg-6 h-100 text-center text-lg-end my-auto">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item me-4">
                                <a href="#!"><i class="bi-facebook fs-3"></i></a>
                            </li>
                            <li class="list-inline-item me-4">
                                <a href="#!"><i class="bi-twitter fs-3"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!"><i class="bi-instagram fs-3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="/js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
