<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Shop homepage">
        <meta name="author" content="Tipo IT">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <title>{{ config('app.name', 'StartBootstrap shop API') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;400;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Bootstrap icons-->
        <link href="{{ asset('bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">

        <!-- Fontawesome icons -->
        <script src="{{ asset('fontawesome/js/solid.min.js') }}" defer></script>

        <script src="{{ asset('fontawesome/js/fontawesome.min.js') }}" defer></script>

        <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        </style>
    </head>

    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="fas fa-shopping-cart"></i> Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill" id="cart-sum"></span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                    @foreach($products as $product)

                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Sale badge-->
                                @if ($product->product_sale)

                                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                        Sale
                                    </div>

                                @endif
                                <!-- Product image-->
                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                                        <!-- Product name-->
                                        <p class="lead">{{ $product->product_description }}</p>
                                        <!-- Product reviews-->
                                        <div class="d-flex justify-content-center small text-warning mb-2">
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star"></div>
                                        </div>

                                        @if ($product->product_price_low > 0)

                                            <!-- Product price-->
                                            <span class="text-muted text-decoration-line-through">
                                                {{ $product->product_price }}
                                            </span>

                                            <br>

                                            <span class="text-muted">
                                                {{ $product->product_price_low }}
                                            </span>

                                        @else

                                            <!-- Product price-->
                                            <span class="text-muted">
                                                {{ $product->product_price }}
                                            </span>

                                        @endif

                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <a class="btn btn-outline-dark mt-auto" href="#" onclick="handleCart()">Add to cart</a>
                                    </div>
                                    <div class="text-center mt-2">
                                        <input type="number" name="rate" id="rate" class="form-control ratings" value="0" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>
            
                    @endforeach

                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

        <script>
        function handleCart() {

            var sum = 0;
            var totals = [];
            var total = 0;

            $('#cart-sum').html('');

            $(".ratings").each( function() {

                var a = parseInt($( this ).val());

                if ($.isNumeric(a)) {

                   totals.push(a);

                }

            });

            for (var i = 0; i < totals.length; i++) {

                total += totals[i];

            }

            $('#cart-sum').append(total);

        }
        </script>
    </body>
</html>
