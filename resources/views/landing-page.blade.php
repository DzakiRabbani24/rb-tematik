<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        

        <div class="container mt-4">
            @section('title', 'Home')
            
            <!-- Hero Section -->
            <section class="hero-section">
                <div class="container mx-auto">
                    <h1 class="hero-title">Welcome to RB Tematik</h1>
                    <p class="hero-subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora, aperiam.</p>
                    <a href="#" class="hero-btn hero-btn-primary">Learn More</a>
                    <a href="login" class="hero-btn hero-btn-secondary">Login</a>
                </div>
            </section>

            <!-- Services Section -->
            <section class="py-16">
                <div class="container mx-auto px-4">
                    <h2 class="text-3xl font-bold text-center text-shadow mb-12">Our Services</h2>
                    <div class="services-container">
                        <!-- First Column -->
                        <div class="column">
                            <div class="service-card">
                                <h3 class="text-xl font-semibold mb-4">Service 1</h3>
                                <p class="text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim dolore quaerat quasi, eius esse autem dolorum nisi rerum laudantium reiciendis illo odio dolor, labore deleniti!</p>
                            </div>
                            <div class="service-card">
                                <h3 class="text-xl font-semibold mb-4">Service 2</h3>
                                <p class="text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim dolore quaerat quasi, eius esse autem dolorum nisi rerum laudantium reiciendis illo odio dolor, labore deleniti!</p>
                            </div>
                            <div class="service-card">
                                <h3 class="text-xl font-semibold mb-4">Service 3</h3>
                                <p class="text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim dolore quaerat quasi, eius esse autem dolorum nisi rerum laudantium reiciendis illo odio dolor, labore deleniti!</p>
                            </div>
                        </div>
                        <!-- Second Column -->
                        <div class="column">
                            <div class="service-card">
                                <h3 class="text-xl font-semibold mb-4">Service 4</h3>
                                <p class="text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim dolore quaerat quasi, eius esse autem dolorum nisi rerum laudantium reiciendis illo odio dolor, labore deleniti!</p>
                            </div>
                            <div class="service-card">
                                <h3 class="text-xl font-semibold mb-4">Service 5</h3>
                                <p class="text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim dolore quaerat quasi, eius esse autem dolorum nisi rerum laudantium reiciendis illo odio dolor, labore deleniti!</p>
                            </div>
                            <div class="service-card">
                                <h3 class="text-xl font-semibold mb-4">Service 6</h3>
                                <p class="text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim dolore quaerat quasi, eius esse autem dolorum nisi rerum laudantium reiciendis illo odio dolor, labore deleniti!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- News Section -->
            <section class="py-16">
                <div class="container mx-auto px-4">
                    <h2 class="text-3xl font-bold text-center text-shadow mb-12">Latest News</h2>
                    <div class="news-section">
                        <div class="news-grid">
                            <div class="news-card">
                                <img src="images/news-example.jpg" alt="News Image 1">
                                <h3 class="news-title">News Title 1</h3>
                                <p class="news-paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim dolore quaerat quasi, eius esse autem dolorum nisi rerum laudantium reiciendis illo odio dolor, labore deleniti!</p>
                            </div>
                            <div class="news-card">
                                <img src="images/news-example.jpg" alt="News Image 2">
                                <h3 class="news-title">News Title 2</h3>
                                <p class="news-paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim dolore quaerat quasi, eius esse autem dolorum nisi rerum laudantium reiciendis illo odio dolor, labore deleniti!</p>
                            </div>
                            <div class="news-card">
                                <img src="images/news-example.jpg" alt="News Image 3">
                                <h3 class="news-title">News Title 3</h3>
                                <p class="news-paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim dolore quaerat quasi, eius esse autem dolorum nisi rerum laudantium reiciendis illo odio dolor, labore deleniti!</p>
                            </div>
                            <div class="news-card">
                                <img src="images/news-example.jpg" alt="News Image 4">
                                <h3 class="news-title">News Title 4</h3>
                                <p class="news-paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim dolore quaerat quasi, eius esse autem dolorum nisi rerum laudantium reiciendis illo odio dolor, labore deleniti!</p>
                            </div>
                            <div class="news-card">
                                <img src="images/news-example.jpg" alt="News Image 5">
                                <h3 class="news-title">News Title 5</h3>
                                <p class="news-paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim dolore quaerat quasi, eius esse autem dolorum nisi rerum laudantium reiciendis illo odio dolor, labore deleniti!</p>
                            </div>
                            <div class="news-card">
                                <img src="images/news-example.jpg" alt="News Image 6">
                                <h3 class="news-title">News Title 6</h3>
                                <p class="news-paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim dolore quaerat quasi, eius esse autem dolorum nisi rerum laudantium reiciendis illo odio dolor, labore deleniti!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <!-- Footer -->
            <footer>
                <div class="container mx-auto px-4 text-center">
                    <p>&copy; 2024 SmartID. All rights reserved.</p>
                </div>
            </footer>            

            <!-- Back to Top Button -->
            <button class="back-to-top">↑</button>

            <script>
                // Smooth scrolling for internal links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();
                        document.querySelector(this.getAttribute('href')).scrollIntoView({
                            behavior: 'smooth'
                        });
                    });
                });

                // Back to top button functionality
                const backToTopButton = document.querySelector('.back-to-top');

                backToTopButton.addEventListener('click', () => {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });

                window.addEventListener('scroll', () => {
                    if (window.scrollY > 200) {
                        backToTopButton.classList.add('visible');
                    } else {
                        backToTopButton.classList.remove('visible');
                    }
                });
            </script>
        </body>

        <style>
        /* General Styling */
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(to right, #FF6F61, #FF3D39); /* Gradient background */
            color: white;
            padding: 80px 20px;
            text-align: center;
            border-radius: 30px; /* Radius sudut melengkung */
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .hero-btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            margin: 0 10px;
            transition: background-color 0.3s;
        }

        .hero-btn-primary {
            background-color: #FF6F61;
            color: white;
        }

        .hero-btn-primary:hover {
            background-color: #FF3D39;
        }

        .hero-btn-secondary {
            background-color: #4A90E2;
            color: white;
        }

        .hero-btn-secondary:hover {
            background-color: #357ABD;
        }

        /* Text Shadow */
        .text-shadow {
            color: #333; /* Warna teks */
            font-size: 3rem; /* Sesuaikan dengan ukuran yang diinginkan */
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3); /* Efek bayangan */
        }

        /* Services Section */
        .services-container {
            display: flex;
            gap: 1rem; /* Space between the columns */
        }

        /* Service Card */
        .service-card {
            background-color: white;
            border: 1px solid #e0e0e0; /* Light grey border */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Shadow effect */
            padding: 1rem;
            margin-bottom: 1rem; /* Space between boxes */
        }

        /* News Section */
        .news-section {
            padding: 1rem;
            border: 1px solid #e0e0e0; /* Light grey border */
            border-radius: 8px; /* Rounded corners */
            background-color: #fff; /* Background color to ensure visibility */
        }

        /* News Card */
        .news-card {
            background-color: white;
            border: 1px solid #e0e0e0; /* Light grey border */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Shadow effect */
            padding: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .news-grid {
                grid-template-columns: repeat(2, 1fr); /* 2 columns on medium screens */
            }
        }

        @media (max-width: 768px) {
            .news-grid {
                grid-template-columns: 1fr; /* 1 column on small screens */
            }
        }

        /* News Grid */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 columns */
            gap: 1rem; /* Space between news items */
        }

        /* Image in News Card */
        .news-card img {
            width: 100%; /* Full width of the card */
            height: auto; /* Maintain aspect ratio */
            border-radius: 8px; /* Rounded corners for image */
            margin-bottom: 1rem; /* Space between image and title */
        }

        /* News Title */
        .news-title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        /* News Paragraph */
        .news-paragraph {
            font-size: 0.875rem; /* Slightly smaller text */
            text-align: justify; /* Align text to both sides */
        }

        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #FF6F61;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .back-to-top.visible {
            opacity: 1;
        }
        </style>

        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('scripts') <!-- Tempat untuk script tambahan -->
</body>
</html>