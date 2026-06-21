<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>تصليح وصيانة الخزانات | أبو محمد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&family=Cairo:wght@300;400;600;700;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="./Style/style.css">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand"><i class="fa-solid fa-droplet me-2"></i> تصليح وصيانه الخزانات</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav me-auto gap-1">
                    <li class="nav-item"><a class="nav-link" href="/#about">من نحن</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#why">لماذا نحن</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#works">أعمالنا</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('blog.index') }}">مقالنا</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#contact">تواصل معنا</a></li>
                </ul>
                <div class="d-flex gap-2 mt-2 mt-lg-0">
                    <a href="tel:65607075" class="btn-call c-blue" style="padding:9px 20px;font-size:0.9rem;">
                        <i class="fa-solid fa-phone"></i> 65607075
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section id="hero">
        <div class="hero-bg"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge"><i class="fa-solid fa-star me-1"></i> خدمات متخصصة في جميع أنحاء الكويت</div>
                <h1 class="hero-title">
                    <span class="c1">أبو محمد</span> لتصليح<br />
                    وصيانة <span class="c2">الخزانات</span>
                </h1>
                <p class="hero-sub fs-4 fw-bold">
                    خبرة واسعة في صيانة جميع أنواع الخزانات وتركيب مبردات خزانات النشاط
                    نخدمك في جميع أنحاء الكويت على مدار الساعة
                </p>
                <div class="hero-btns">
                    <a href="tel:65607075" class="btn-call c-blue">
                        <i class="fa-solid fa-phone-volume"></i> 65607075
                    </a>
                    <a href="tel:99109049" class="btn-call c-gold">
                        <i class="fa-solid fa-phone"></i> 99109049
                    </a>
                </div>
            </div>
        </div>

    </section>

    <section class="py-5" style="background-color: var(--bg-dark); min-height: 100vh;">
        <div class="container">

            <div class="row mb-5 text-center">
                <div class="col-12">
                    <h2 class="display-5 fw-bold" style="color: var(--white);">
                        أحدث <span style="color: var(--accent);">التبرعات</span>
                    </h2>
                    <div class="mx-auto mt-2" style="width: 60px; height: 4px; background-color: var(--accent2);"></div>
                </div>
            </div>

            <div class="row g-4">
                @forelse($blogs as $item)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm transition-hover"
                            style="background-color: var(--bg-card); border: 1px solid rgba(255,255,255,0.05) !important;">

                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top"
                                    alt="{{ $item->title }}" style="height: 220px; object-fit: cover;">
                                <span class="badge position-absolute top-0 end-0 m-3"
                                    style="background-color: var(--accent2); color: var(--bg-dark);">
                                    جديد
                                </span>
                            </div>

                            <div class="card-body d-flex flex-column text-end">
                                <h5 class="card-title fw-bold mb-3" style="color: var(--text-light);">
                                    {{ $item->title }}
                                </h5>
                                <p class="card-text mb-4" style="color: var(--text-muted); font-size: 0.95rem;">
                                    {{ Str::limit(strip_tags($item->content), 100) }} </p>

                                <div class="mt-auto d-flex justify-content-between align-items-center flex-row-reverse">
                                    <a href="{{ route('blog.show', $item->id) }}" class="btn px-4 fw-bold"
                                        style="background-color: var(--primary); color: var(--white); border: 1px solid var(--accent);">
                                        تفاصيل
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p style="color: var(--text-muted);">لا توجد بيانات لعرضها حالياً.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    <style>
        .transition-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .transition-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 119, 182, 0.3) !important;
            border-color: var(--accent) !important;
        }

        /* لجعل المحاذاة متناسقة مع اللغة العربية */
        .card-title,
        .card-text {
            direction: rtl;
        }
    </style>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <p>جميع الحقوق محفوظة &copy; 2025 — <span>أبو محمد لصيانة الخزانات</span> | الكويت</p>
            <p style="margin-top: 10px; font-size: 0.85rem; opacity: 0.8;">
                تم التصميم بواسطة
                <a href="https://www.facebook.com/profile.php?id=100090592885243&locale=ar_AR" target="_blank"
                    style="color: var(--accent); text-decoration: none; font-weight: 700; transition: 0.3s;">
                    GMTWEB
                </a>
            </p>
        </div>
    </footer>

    <button id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">
        <i class="fa-solid fa-chevron-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./main.js"></script>
</body>

</html>
