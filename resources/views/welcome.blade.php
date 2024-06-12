<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>NOTAKOS | Aplikasi Manajemen Keuangan Mahasiswa Indekos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            /* body {
                font-family: 'Arial', sans-serif;
            } */

            .navbar {
                background-color: #0284C7;
            }

            .navbar-brand,
            .nav-link {
                color: white;
                font-weight: 700;
                transition: color 0.3s ease, transform 0.3s ease;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
            }

            .navbar-brand:hover,
            .nav-link:hover {
                color: #FFD700;
                transform: scale(1.1);
            }

            /* Mengubah warna link saat diaktifkan */
            .nav-link.active {
                color: #FFD700;
                font-weight: 700;
            }

            /* Memberikan efek hover yang lebih menarik */
            .nav-link::after {
                content: '';
                display: block;
                width: 0;
                height: 2px;
                background: #FFD700;
                transition: width 0.3s;
            }

            .nav-link:hover::after {
                width: 100%;
            }

            .hero-section {
                background: url('your-image-url.jpg') no-repeat center center;
                background-size: cover;
                height: 100vh;
                color: white;
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
            }

            .hero-section h1 {
                font-size: 4rem;
                text-shadow: 2px 2px 4px #000000;
            }

            .hero-section p {
                font-size: 1.5rem;
                font-weight: 500;
            }

            .btn-primary {
                background-color: #0284C7;
                border-color: #0284C7;
            }

            .btn-primary:hover {
                background-color: #005f8c;
                border-color: #005f8c;
            }

            .about-section {
                padding: 4rem 0;
                background-color: rgba(2, 132, 199, 0.1);
                text-align: center;
            }

            .about-section h3 {
                color: #0284C7;
                font-size: 2.5rem;
                margin-bottom: 1.5rem;
            }

            .about-section p {
                font-size: 1.1rem;
                color: #333;
                line-height: 1.8;
                max-width: 800px;
                margin: 0 auto;
                transition: transform 0.3s, opacity 0.3s;
            }

            .about-section p:hover {
                transform: scale(1.05);
                opacity: 0.9;
            }

            .cards-section {
                padding: 4rem 0;
                border-radius: 100px;
            }

            .cards-section .card {
                margin: 1rem;
                border: none;
                transition: transform 0.3s, box-shadow 0.3s;
            }

            .cards-section .card:hover {
                transform: translateY(-10px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }

            .card-title {
                color: #0284C7;
            }

            .card-body {
                position: relative;
                padding: 2rem;
            }

            .card-body::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(2, 132, 199, 0.1);
                z-index: -1;
                transition: opacity 0.3s;
                opacity: 0;

            }

            .card:hover .card-body::before {
                opacity: 1;
            }

            footer {
                background-color: #0284C7;
                color: white;
                padding: 2rem 0;
            }

            footer a {
                color: #ffd700;
                text-decoration: none;
            }

            footer a:hover {
                color: #fff;
            }

            footer h5 {
                margin-bottom: 1rem;
            }

            footer p {
                margin-bottom: 0.5rem;
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
            <div class="container-fluid mx-5">
                <a class="navbar-brand" href="#">NOTAKOS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#tentang">Tentang</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#fitur">Fitur</a>
                        </li>
                    </ul>
                </div>
                <button class="btn btn-outline-light ms-auto rounded-pill"
                    onclick="window.location.href='https://drive.google.com/drive/folders/1G0XmNL2M5zmMpDwGp4V0R7_lJWuBCU0_'">Unduh</button>
            </div>
        </nav>

        <section class="hero-section">
            <div class="container">
                <div style="background-color: #0284C7" class="py-1 mb-2 rounded">
                    <h1>Selamat Datang di NOTAKOS</h1>
                </div>
                <p style="color: #0284C7" class="mt-3">Aplikasi Manajemen Uang Kuliah Mahasiswa Indekos</p>
            </div>
        </section>

        <section id="tentang" class="about-section">
            <h3>Tentang</h3>
            <p>
                NOTAKOS adalah sebuah aplikasi yang bertujuan untuk
                membantu mahasiswa indekos dalam mengelola keuangan
                pribadinya dengan memanfaatkan sistem alokasi uang.
                Sehingga, mahasiswa yang menggunakan aplikasi NOTAKOS
                terbantu dalam proses pengelolaan keuangan.
            </p>
        </section>

        <section id="fitur" class="cards-section container">
            <h3 style="color: #0284C7; font-size: 2.5rem; margin-bottom: 1.5rem; text-align: center">
                Fitur
            </h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pencatatan</h5>
                            <p class="card-text">
                                Catat keuangan harianmu di NOTAKOS. Mulai dari pemasukan hingga pengeluaran, semua dapat
                                dicatat dengan mudah. Dengan begitu, kamu bisa memantau aliran keuanganmu, membuat
                                anggaran yang lebih tepat, dan memastikan tidak ada pengeluaran yang terlewat. Manajemen
                                keuangan yang baik sangat penting untuk mahasiswa kos, agar kamu bisa mengatur uang
                                dengan lebih bijak dan terhindar dari masalah keuangan.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Alokasi</h5>
                            <p class="card-text">
                                Kamu bingung dalam mengelompokkan uangmu? Tenang, NOTAKOS siap membantu. Fitur alokasi
                                kami memudahkan kamu untuk mengelompokkan uangmu. Kamu cukup mengisi persentase dari
                                setiap kebutuhanmu, namun ingat, jangan lebih dari 100%. Dengan cara ini, kamu bisa
                                lebih mudah mengatur keuangan dan memastikan semua kebutuhan terpenuhi tanpa melebihi
                                anggaran. NOTAKOS membuat manajemen keuangan menjadi lebih sederhana dan efisien.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Literatur</h5>
                            <p class="card-text">
                                Kamu butuh referensi mengenai manajemen keuangan? NOTAKOS menyediakan fitur literatur
                                yang akan membantu kamu menambah referensi dalam mengelola keuanganmu. Dengan fitur ini,
                                kamu bisa mendapatkan informasi dan tips terbaru seputar manajemen keuangan yang bisa
                                langsung diterapkan dalam kehidupan sehari-harimu. Jadi, tidak hanya mengelola keuangan
                                dengan baik, tetapi juga selalu mendapatkan pembaruan terkini untuk meningkatkan
                                pemahamanmu dalam mengatur keuangan.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Profil</h5>
                            <p class="card-text">
                                Sebagaimana fitur profil pada umumnya, NOTAKOS memberikan keleluasaan bagi penggunanya
                                untuk mengelola akun pribadinya. Namun, dalam fitur profil NOTAKOS kamu bisa menambahkan
                                akun email orang tuamu. Dengan demikian, orang tuamu akan mendapatkan notifikasi
                                rekapitulasi keuanganmu setiap bulan. Fitur ini sangat berguna untuk membantu orang
                                tuamu dalam memantau pengelolaan keuanganmu, memastikan transparansi, dan kamu bisa
                                mendapatkan masukan atau saran dari orang tuamu.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 mx-auto">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Notifikasi</h5>
                            <p class="card-text">
                                Untuk kamu yang sering lupa, NOTAKOS hadir dengan fitur notifikasi yang membantu
                                mengingatkan kamu untuk rutin mencatat keuangan setiap hari. Selain itu, orang tuamu
                                juga bisa menerima notifikasi rekapitulasi catatan keuanganmu setiap bulan. Fitur ini
                                memastikan kamu tetap konsisten dalam mencatat pengeluaran dan pemasukan, serta
                                memberikan orang tuamu gambaran tentang bagaimana kamu mengelola keuanganmu. Dengan
                                demikian, kamu bisa lebih disiplin dalam mengatur keuangan, dan orang tuamu bisa
                                memberikan dukungan dan saran yang berguna.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="text-center">
            <div class="container">
                <div class="mt-3">
                    <p>&copy; 2024 NOTAKOS. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    </body>

</html>
