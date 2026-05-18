@extends('layouts.app')

@section('title', $tour->name . ' - Shirin Travel Agency')

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        .tour-detail-page {
            background: #F8F9FF;
        }

        /* ── Hero ── */
        .tour-hero {
            background: linear-gradient(135deg, #181E4B 0%, #14183E 100%);
            padding: 3.5rem 0 6rem;
            position: relative;
            overflow: hidden;
        }

        .tour-hero::before {
            content: '';
            position: absolute;
            top: -5rem;
            right: -5rem;
            width: 22rem;
            height: 22rem;
            border-radius: 50%;
            background: rgba(241, 165, 1, 0.07);
            pointer-events: none;
        }

        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.55);
            text-decoration: none;
            font-size: 0.85rem;
        }

        .breadcrumb-item a:hover {
            color: #F1A501;
        }

        .breadcrumb-item.active {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.85rem;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.3);
        }

        .tour-hero h1 {
            font-family: 'Volkhov', cursive;
            font-size: 2.4rem;
            font-weight: 700;
            color: #ffffff;
            margin: 1rem 0 0.75rem;
            line-height: 1.25;
        }

        .tour-hero-cats {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .hero-cat {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #F1A501;
            background: rgba(241, 165, 1, 0.15);
            border-radius: 0.4rem;
            padding: 0.25rem 0.7rem;
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .hero-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.88rem;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 500;
        }

        .hero-meta-item i {
            color: #F1A501;
        }

        /* ── Main layout ── */
        .tour-body {
            margin-top: -3.5rem;
            padding-bottom: 4rem;
        }

        /* ── Image card ── */
        .tour-img-card {
            background: #ffffff;
            border-radius: 1.25rem;
            box-shadow: 0 1rem 2.5rem rgba(20, 24, 62, 0.10);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .tour-img-card img {
            width: 100%;
            height: 380px;
            object-fit: cover;
        }

        .tour-img-placeholder {
            width: 100%;
            height: 380px;
            background: linear-gradient(135deg, #EEF0F7 0%, #D8DCF0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: #BDBDBD;
        }

        .tour-img-placeholder i {
            font-size: 3rem;
            margin-bottom: 0.75rem;
        }

        .tour-img-placeholder span {
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* ── Content card ── */
        .content-card {
            background: #ffffff;
            border-radius: 1.25rem;
            box-shadow: 0 0.5rem 1.5rem rgba(20, 24, 62, 0.07);
            padding: 2rem;
            margin-bottom: 1.5rem;
        }

        .card-heading {
            font-family: 'Volkhov', cursive;
            font-size: 1.2rem;
            font-weight: 700;
            color: #181E4B;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #F0F4F9;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .card-heading i {
            color: #F1A501;
            font-size: 1rem;
        }

        .tour-description {
            font-size: 0.93rem;
            color: #5E6282;
            line-height: 1.85;
            margin: 0;
        }

        /* ── Detail rows ── */
        .detail-row {
            display: flex;
            align-items: center;
            padding: 0.85rem 0;
            border-bottom: 1px solid #F0F4F9;
        }

        .detail-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .detail-row:first-child {
            padding-top: 0;
        }

        .detail-icon {
            width: 2.25rem;
            height: 2.25rem;
            min-width: 2.25rem;
            border-radius: 0.625rem;
            background: rgba(241, 165, 1, 0.10);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #F1A501;
            font-size: 0.85rem;
            margin-right: 0.85rem;
        }

        .detail-key {
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #BDBDBD;
            font-weight: 600;
            margin-bottom: 0.15rem;
        }

        .detail-val {
            font-size: 0.92rem;
            color: #181E4B;
            font-weight: 600;
            margin: 0;
        }

        /* ── Categories ── */
        .cats-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .cat-tag {
            border: 1.5px solid #EEF0F7;
            border-radius: 2rem;
            padding: 0.3rem 0.9rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: #5E6282;
            background: #F8F9FF;
            text-decoration: none;
            transition: all 0.2s;
        }

        .cat-tag:hover {
            background: #F1A501;
            border-color: #F1A501;
            color: #ffffff;
            text-decoration: none;
        }

        /* ── Booking sidebar card ── */
        .booking-card {
            background: linear-gradient(150deg, #181E4B 0%, #14183E 100%);
            border-radius: 1.25rem;
            box-shadow: 0 1rem 2.5rem rgba(20, 24, 62, 0.18);
            padding: 2rem;
            position: sticky;
            top: 8rem;
            color: #ffffff;
        }

        .booking-price-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: rgba(255, 255, 255, 0.45);
            font-weight: 600;
            margin-bottom: 0.3rem;
        }

        .booking-price {
            font-family: 'Volkhov', cursive;
            font-size: 2.5rem;
            font-weight: 700;
            color: #F1A501;
            line-height: 1;
            margin-bottom: 0.3rem;
        }

        .booking-price span {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.5);
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
        }

        .booking-divider {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 1.25rem 0;
        }

        .booking-meta-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.6rem 0;
            font-size: 0.85rem;
        }

        .booking-meta-key {
            color: rgba(255, 255, 255, 0.5);
            font-weight: 500;
        }

        .booking-meta-val {
            color: #ffffff;
            font-weight: 600;
        }

        .btn-book {
            display: block;
            text-align: center;
            background: linear-gradient(135deg, #F1A501 0%, #DF6951 100%);
            color: #ffffff;
            border-radius: 0.875rem;
            padding: 1rem;
            font-size: 0.95rem;
            font-weight: 700;
            text-decoration: none;
            margin-top: 1.5rem;
            transition: opacity 0.2s, transform 0.2s;
            box-shadow: 0 0.75rem 1.5rem rgba(241, 165, 1, 0.3);
        }

        .btn-book:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            color: #ffffff;
            text-decoration: none;
        }

        .btn-book-outline {
            display: block;
            text-align: center;
            border: 1.5px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.7);
            border-radius: 0.875rem;
            padding: 0.8rem;
            font-size: 0.88rem;
            font-weight: 600;
            text-decoration: none;
            margin-top: 0.75rem;
            transition: all 0.2s;
        }

        .btn-book-outline:hover {
            border-color: #F1A501;
            color: #F1A501;
            text-decoration: none;
        }

        /* ── Related tours ── */
        .related-card {
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1.5rem rgba(20, 24, 62, 0.07);
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .related-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 1rem 2rem rgba(20, 24, 62, 0.12);
        }

        .related-img {
            height: 150px;
            overflow: hidden;
            background: linear-gradient(135deg, #EEF0F7 0%, #D8DCF0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .related-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .related-img i {
            font-size: 2rem;
            color: #BDBDBD;
        }

        .related-body {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .related-name {
            font-size: 0.92rem;
            font-weight: 700;
            color: #181E4B;
            margin-bottom: 0.4rem;
            line-height: 1.4;
        }

        .related-price {
            font-size: 0.85rem;
            color: #F1A501;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .related-link {
            font-size: 0.8rem;
            font-weight: 600;
            color: #5E6282;
            text-decoration: none;
            margin-top: auto;
            transition: color 0.2s;
        }

        .related-link:hover {
            color: #F1A501;
        }

        /* ── Section heading ── */
        .section-tag {
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.13em;
            text-transform: uppercase;
            color: #DF6951;
            margin-bottom: 0.3rem;
        }

        .section-title {
            font-family: 'Volkhov', cursive;
            font-size: 1.75rem;
            font-weight: 700;
            color: #181E4B;
            margin-bottom: 2rem;
        }

        @media (max-width: 991.98px) {
            .booking-card {
                position: static;
                margin-top: 1.5rem;
            }

            .tour-hero h1 {
                font-size: 1.8rem;
            }

            .tour-img-card img,
            .tour-img-placeholder {
                height: 250px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="tour-detail-page">

        {{-- ── HERO ── --}}
        <div class="tour-hero">
            <div class="container position-relative">
                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/tours') }}">Tours</a></li>
                        <li class="breadcrumb-item active">{{ Str::limit($tour->name, 30) }}</li>
                    </ol>
                </nav>

                @if($tour->categories->count())
                    <div class="tour-hero-cats mt-3">
                        @foreach($tour->categories as $cat)
                            <span class="hero-cat">{{ $cat->name }}</span>
                        @endforeach
                    </div>
                @endif

                <h1>{{ $tour->name }}</h1>

                <div class="hero-meta">
                    <div class="hero-meta-item">
                        <i class="fa-regular fa-clock"></i> {{ $tour->duration }} days
                    </div>
                    <div class="hero-meta-item">
                        <i class="fa-solid fa-users"></i> Max {{ $tour->capacity_of_people }} people
                    </div>
                    @if($tour->season)
                        <div class="hero-meta-item">
                            <i class="fa-regular fa-sun"></i> {{ $tour->season }} season
                        </div>
                    @endif
                    <div class="hero-meta-item">
                        <i class="fa-solid fa-tag"></i> ${{ number_format($tour->price, 2) }} per person
                    </div>
                </div>
            </div>
        </div>

        {{-- ── BODY ── --}}
        <div class="tour-body">
            <div class="container">
                <div class="row g-4">

                    {{-- LEFT: Main content --}}
                    <div class="col-lg-8">

                        {{-- Tour image --}}
                        <div class="tour-img-card">
                            @if(isset($tour->image) && $tour->image)
                                <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->name }}">
                            @else
                                <div class="tour-img-placeholder">
                                    <i class="fa-solid fa-image"></i>
                                    <span>No photo available</span>
                                </div>
                            @endif
                        </div>

                        {{-- Description --}}
                        <div class="content-card">
                            <h2 class="card-heading">
                                <i class="fa-solid fa-align-left"></i> About This Tour
                            </h2>
                            <p class="tour-description">{{ $tour->description }}</p>
                        </div>

                        {{-- Tour details --}}
                        <div class="content-card">
                            <h2 class="card-heading">
                                <i class="fa-solid fa-circle-info"></i> Tour Details
                            </h2>
                            <div class="detail-row">
                                <div class="detail-icon"><i class="fa-regular fa-clock"></i></div>
                                <div>
                                    <p class="detail-key">Duration</p>
                                    <p class="detail-val">{{ $tour->duration }} {{ Str::plural('day', $tour->duration) }}
                                    </p>
                                </div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-icon"><i class="fa-solid fa-users"></i></div>
                                <div>
                                    <p class="detail-key">Group Size</p>
                                    <p class="detail-val">Up to {{ $tour->capacity_of_people }} people</p>
                                </div>
                            </div>
                            @if($tour->season)
                                <div class="detail-row">
                                    <div class="detail-icon"><i class="fa-regular fa-sun"></i></div>
                                    <div>
                                        <p class="detail-key">Best Season</p>
                                        <p class="detail-val">{{ $tour->season }}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="detail-row">
                                <div class="detail-icon"><i class="fa-solid fa-dollar-sign"></i></div>
                                <div>
                                    <p class="detail-key">Price Per Person</p>
                                    <p class="detail-val">${{ number_format($tour->price, 2) }}</p>
                                </div>
                            </div>
                            @if($tour->categories->count())
                                <div class="detail-row">
                                    <div class="detail-icon"><i class="fa-solid fa-tags"></i></div>
                                    <div>
                                        <p class="detail-key">Categories</p>
                                        <div class="cats-wrap mt-1">
                                            @foreach($tour->categories as $cat)
                                                <a href="#" class="cat-tag">{{ $cat->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>

                    {{-- RIGHT: Booking sidebar --}}
                    <div class="col-lg-4">
                        <div class="booking-card">
                            <p class="booking-price-label">Price per person</p>
                            <div class="booking-price">
                                ${{ number_format($tour->price, 0) }}
                                <span>/ person</span>
                            </div>

                            <hr class="booking-divider">

                            <div class="booking-meta-row">
                                <span class="booking-meta-key"><i class="fa-regular fa-clock me-2"></i>Duration</span>
                                <span class="booking-meta-val">{{ $tour->duration }} days</span>
                            </div>
                            <div class="booking-meta-row">
                                <span class="booking-meta-key"><i class="fa-solid fa-users me-2"></i>Group size</span>
                                <span class="booking-meta-val">Max {{ $tour->capacity_of_people }}</span>
                            </div>
                            @if($tour->season)
                                <div class="booking-meta-row">
                                    <span class="booking-meta-key"><i class="fa-regular fa-sun me-2"></i>Season</span>
                                    <span class="booking-meta-val">{{ $tour->season }}</span>
                                </div>
                            @endif

                            <a href="#" class="btn-book">
                                <i class="fa-solid fa-paper-plane me-2"></i> Book This Tour
                            </a>
                            <a href="{{ route('tours') }}" class="btn-book-outline">
                                <i class="fa-solid fa-arrow-left me-2"></i> Back to Tours
                            </a>
                        </div>
                    </div>

                </div>

                {{-- ── RELATED TOURS ── --}}

                {{--
                @if($relatedTours->count())
                <div class="mt-5">
                    <p class="section-tag">You Might Also Like</p>
                    <h2 class="section-title">Similar Tours</h2>
                    <div class="row g-4">
                        @foreach($relatedTours as $related)
                        <div class="col-sm-6 col-lg-3">
                            <div class="related-card">
                                <div class="related-img">
                                    @if(isset($related->image) && $related->image)
                                    <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}">
                                    @else
                                    <i class="fa-solid fa-image"></i>
                                    @endif
                                </div>
                                <div class="related-body">
                                    <p class="related-name">{{ $related->name }}</p>
                                    <p class="related-price">${{ number_format($related->price, 0) }} / person</p>
                                    <a href="#" class="related-link">
                                        View details <i class="fa-solid fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                --}}
            </div>
        </div>

    </div>
@endsection