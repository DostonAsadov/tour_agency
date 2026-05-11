@extends('layouts.app')

@section('title', 'About Us - Shirin Travel Agency')

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        /* ── General ── */
        .about-page {
            background: #FFFEFE;
            overflow: hidden;
        }

        /* ── Hero ── */
        .about-hero {
            position: relative;
            height: 420px;
            overflow: hidden;
        }

        .about-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .about-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(24, 30, 75, 0.45) 0%, rgba(24, 30, 75, 0.75) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            padding: 0 1rem;
        }

        .about-hero-tag {
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #F1A501;
            background: rgba(241, 165, 1, 0.15);
            border-radius: 2rem;
            padding: 0.3rem 1rem;
            margin-bottom: 1rem;
            display: inline-block;
        }

        .about-hero h1 {
            font-family: 'Volkhov', cursive;
            font-size: 2.8rem;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
            text-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
        }

        .about-hero p {
            color: rgba(255, 255, 255, 0.75);
            font-size: 1rem;
            margin-top: 0.75rem;
            margin-bottom: 0;
        }

        /* ── Section label ── */
        .section-tag {
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.13em;
            text-transform: uppercase;
            color: #DF6951;
            margin-bottom: 0.4rem;
        }

        .section-title {
            font-family: 'Volkhov', cursive;
            font-size: 2rem;
            font-weight: 700;
            color: #181E4B;
            margin-bottom: 0.5rem;
        }

        .section-sub {
            color: #5E6282;
            font-size: 0.93rem;
            line-height: 1.8;
            font-weight: 500;
        }

        /* ── Company info card ── */
        .info-card {
            background: #ffffff;
            border-radius: 1.25rem;
            box-shadow: 0 1.5rem 3rem rgba(20, 24, 62, 0.09);
            padding: 2.5rem;
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #F0F4F9;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 2.5rem;
            height: 2.5rem;
            min-width: 2.5rem;
            border-radius: 0.75rem;
            background: rgba(241, 165, 1, 0.10);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #F1A501;
            font-size: 0.95rem;
        }

        .info-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #BDBDBD;
            font-weight: 600;
            margin-bottom: 0.2rem;
        }

        .info-value {
            font-size: 0.93rem;
            color: #181E4B;
            font-weight: 600;
            margin: 0;
        }

        .info-value a {
            color: #F1A501;
            text-decoration: none;
        }

        .info-value a:hover {
            text-decoration: underline;
        }

        /* ── Stats ── */
        .stat-card {
            background: #ffffff;
            border-radius: 1.25rem;
            box-shadow: 0 1rem 2rem rgba(20, 24, 62, 0.07);
            padding: 2rem 1.5rem;
            text-align: center;
            transition: transform 0.25s, box-shadow 0.25s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 1.5rem 3rem rgba(20, 24, 62, 0.12);
        }

        .stat-num {
            font-family: 'Volkhov', cursive;
            font-size: 2.4rem;
            font-weight: 700;
            color: #F1A501;
            line-height: 1;
            margin-bottom: 0.4rem;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #5E6282;
            font-weight: 500;
        }

        .stat-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.875rem;
            background: rgba(241, 165, 1, 0.10);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #F1A501;
            font-size: 1.1rem;
            margin: 0 auto 1rem;
        }

        /* ── Director card ── */
        .director-card {
            background: linear-gradient(150deg, #181E4B 0%, #14183E 100%);
            border-radius: 1.5rem;
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
            color: #ffffff;
        }

        .director-card::before {
            content: '';
            position: absolute;
            top: -5rem;
            right: -5rem;
            width: 16rem;
            height: 16rem;
            border-radius: 50%;
            background: rgba(241, 165, 1, 0.08);
            pointer-events: none;
        }

        .director-avatar {
            width: 5rem;
            height: 5rem;
            border-radius: 50%;
            background: rgba(241, 165, 1, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Volkhov', cursive;
            font-size: 1.75rem;
            font-weight: 700;
            color: #F1A501;
            margin-bottom: 1.25rem;
            border: 2px solid rgba(241, 165, 1, 0.3);
        }

        .director-name {
            font-family: 'Volkhov', cursive;
            font-size: 1.4rem;
            color: #ffffff;
            margin-bottom: 0.2rem;
        }

        .director-role {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #F1A501;
            font-weight: 600;
            margin-bottom: 1.25rem;
        }

        .director-quote {
            font-size: 0.93rem;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.8;
            font-style: italic;
            border-left: 3px solid #F1A501;
            padding-left: 1rem;
            margin: 0;
        }

        /* ── Services ── */
        .service-item {
            background: #ffffff;
            border-radius: 1.25rem;
            box-shadow: 0 1rem 2rem rgba(20, 24, 62, 0.07);
            padding: 2rem 1.5rem;
            transition: transform 0.25s, box-shadow 0.25s;
            height: 100%;
        }

        .service-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 1.5rem 3rem rgba(20, 24, 62, 0.12);
        }

        .service-icon {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 1.25rem;
        }

        .service-icon.orange {
            background: rgba(241, 165, 1, 0.12);
            color: #F1A501;
        }

        .service-icon.red {
            background: rgba(223, 105, 81, 0.12);
            color: #DF6951;
        }

        .service-icon.blue {
            background: rgba(116, 125, 239, 0.12);
            color: #747DEF;
        }

        .service-icon.green {
            background: rgba(121, 185, 60, 0.12);
            color: #79B93C;
        }

        .service-title {
            font-size: 1rem;
            font-weight: 700;
            color: #181E4B;
            margin-bottom: 0.5rem;
        }

        .service-desc {
            font-size: 0.875rem;
            color: #5E6282;
            line-height: 1.7;
            margin: 0;
        }

        /* ── Partners ── */
        .partner-card {
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1.5rem rgba(20, 24, 62, 0.06);
            padding: 1.5rem 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100px;
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .partner-card:hover {
            box-shadow: 0 1rem 2rem rgba(20, 24, 62, 0.12);
            transform: translateY(-3px);
        }

        .partner-card img {
            max-height: 50px;
            max-width: 130px;
            object-fit: contain;
            filter: grayscale(100%) opacity(0.6);
            transition: filter 0.2s;
        }

        .partner-card:hover img {
            filter: grayscale(0%) opacity(1);
        }

        /* ── bg blob ── */
        .bg-blob {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        @media (max-width: 767.98px) {
            .about-hero {
                height: 280px;
            }

            .about-hero h1 {
                font-size: 1.8rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .director-card {
                padding: 2rem 1.5rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="about-page">

        {{-- ── HERO ── --}}
        <div class="about-hero">
            <img src="{{ asset('assets/img/about/hero.jpg') }}"
                onerror="this.src='https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1400&q=80'"
                alt="Beautiful travel destination">
            <div class="about-hero-overlay">
                <span class="about-hero-tag">Who We Are</span>
                <h1>About {{ $about->company_name }}</h1>
                <p>Your trusted partner for unforgettable journeys around the world</p>
            </div>
        </div>

        {{-- ── COMPANY INFO + DIRECTOR ── --}}
        <section class="py-6 position-relative">
            <div class="bg-blob" style="width:28rem;height:28rem;background:rgba(241,165,1,0.05);top:-6rem;right:-8rem;">
            </div>
            <div class="container position-relative">
                <div class="row align-items-start g-4">

                    {{-- Company info --}}
                    <div class="col-lg-7">
                        <p class="section-tag">Our Company</p>
                        <h2 class="section-title">{{ $about->company_name }} Agency</h2>
                        <p class="section-sub mb-4">
                            Founded with a passion for exploration, Shirin Travel Agency has been
                            crafting memorable travel experiences since 2010. We believe that every
                            journey should be seamless, enriching, and perfectly tailored to you.
                        </p>

                        <div class="info-card">
                            <div class="info-row">
                                <div class="info-icon"><i class="fa-solid fa-building"></i></div>
                                <div>
                                    <p class="info-label">Company</p>
                                    <p class="info-value">{{ $about->company_name }}Agency</p>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                                <div>
                                    <p class="info-label">Address</p>
                                    <p class="info-value">{{ $about->address }}</p>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon"><i class="fa-solid fa-envelope"></i></div>
                                <div>
                                    <p class="info-label">Email</p>
                                    <p class="info-value">
                                        <a href="#">{{ $about->email }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                                <div>
                                    <p class="info-label">Phone</p>
                                    <p class="info-value">
                                        <a href="#">{{ $about->phone }}</a>
                                        <a href="#">{{ $about->phone2 }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon"><i class="fa-solid fa-clock"></i></div>
                                <div>
                                    <p class="info-label">Working Hours</p>
                                    <p class="info-value">Mon – Sat: 9:00 – 18:00</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Director --}}
                    <div class="col-lg-5">
                        <p class="section-tag">Leadership</p>
                        <h2 class="section-title">Our Director</h2>
                        <p class="section-sub mb-4">The vision behind every journey we craft.</p>

                        <div class="director-card">
                            <div class="director-avatar">AT</div>
                            <p class="director-name">Aziz Toshmatov</p>
                            <p class="director-role">Founder & Director</p>
                            <p class="director-quote">
                                "Travel is not just a destination — it is a transformation.
                                At Shirin Travel, we don't just plan trips, we create lifelong memories
                                for every traveller who trusts us with their journey."
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- ── STATS ── --}}
        <section class="py-5 position-relative" style="background: #F8F9FF;">
            <div class="bg-blob" style="width:20rem;height:20rem;background:rgba(223,105,81,0.05);bottom:-4rem;left:-6rem;">
            </div>
            <div class="container position-relative">
                <div class="text-center mb-5">
                    <p class="section-tag">Our Results</p>
                    <h2 class="section-title">Company in Numbers</h2>
                </div>
                <div class="row g-4">
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                            <div class="stat-num">{{ $about->travelers }}</div>
                            <div class="stat-label">Happy Travellers</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fa-solid fa-hotel"></i></div>
                            <div class="stat-num">{{$about->hotels}}</div>
                            <div class="stat-label">Hotels</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fa-solid fa-calendar-check"></i></div>
                            <div class="stat-num">{{ $about->experience_years }}</div>
                            <div class="stat-label">Years Experience</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fa-solid fa-star"></i></div>
                            <div class="stat-num">4.9</div>
                            <div class="stat-label">Average Rating</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ── SERVICES ── --}}
        <section class="py-6">
            <div class="container">
                <div class="text-center mb-5">
                    <p class="section-tag">What We Offer</p>
                    <h2 class="section-title">Our Services</h2>
                    <p class="section-sub mx-auto" style="max-width:520px;">
                        From flight bookings to full-package tours, we handle every detail
                        so you can focus on the experience.
                    </p>
                </div>
                <div class="row g-4">
                    <div class="col-sm-6 col-lg-3">
                        <div class="service-item">
                            <div class="service-icon orange">
                                <i class="fa-solid fa-plane"></i>
                            </div>
                            <p class="service-title">Flight Booking</p>
                            <p class="service-desc">Best fares across all major airlines — economy, business, and first
                                class.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="service-item">
                            <div class="service-icon red">
                                <i class="fa-solid fa-hotel"></i>
                            </div>
                            <p class="service-title">Hotel Reservations</p>
                            <p class="service-desc">Carefully selected hotels from budget-friendly to luxury 5-star resorts.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="service-item">
                            <div class="service-icon blue">
                                <i class="fa-solid fa-map-location-dot"></i>
                            </div>
                            <p class="service-title">Tour Packages</p>
                            <p class="service-desc">Ready-made and custom tour packages for individuals, families, and
                                groups.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="service-item">
                            <div class="service-icon green">
                                <i class="fa-solid fa-passport"></i>
                            </div>
                            <p class="service-title">Visa Assistance</p>
                            <p class="service-desc">Full support for visa applications — documents, appointments, and
                                guidance.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ── PARTNERS ── --}}
        <section class="py-6" style="background: #F8F9FF;">
            <div class="container">
                <div class="text-center mb-5">
                    <p class="section-tag">Trusted By</p>
                    <h2 class="section-title">Our Partners</h2>
                    <p class="section-sub">We work with the world's leading travel and hospitality brands.</p>
                </div>
                <div class="row g-4 justify-content-center align-items-center">
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="partner-card">
                            <img src="{{ asset('assets/img/partner/1.png') }}"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='block'"
                                alt=" Partner 1">
                            <span style="display:none;font-weight:700;color:#BDBDBD;font-size:0.9rem;">Partner 1</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="partner-card">
                            <img src="{{ asset('assets/img/partner/2.png') }}"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='block'"
                                alt=" Partner 2">
                            <span style="display:none;font-weight:700;color:#BDBDBD;font-size:0.9rem;">Partner 2</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="partner-card">
                            <img src="{{ asset('assets/img/partner/3.png') }}"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='block'"
                                alt=" Partner 3">
                            <span style="display:none;font-weight:700;color:#BDBDBD;font-size:0.9rem;">Partner 3</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="partner-card">
                            <img src="{{ asset('assets/img/partner/4.png') }}"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='block'"
                                alt=" Partner 4">
                            <span style="display:none;font-weight:700;color:#BDBDBD;font-size:0.9rem;">Partner 4</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="partner-card">
                            <img src="{{ asset('assets/img/partner/5.png') }}"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='block'"
                                alt=" Partner 5">
                            <span style="display:none;font-weight:700;color:#BDBDBD;font-size:0.9rem;">Partner 5</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection