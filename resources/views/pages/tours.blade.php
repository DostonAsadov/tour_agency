@extends('layouts.app')

@section('title', 'Tours - Shirin Travel Agency')

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        .tours-page {
            background: #FFFEFE;
        }

        /* ── Hero banner ── */
        .tours-hero {
            background: linear-gradient(135deg, #181E4B 0%, #14183E 100%);
            padding: 5rem 0 4rem;
            position: relative;
            overflow: hidden;
        }

        .tours-hero::before {
            content: '';
            position: absolute;
            top: -6rem;
            right: -6rem;
            width: 24rem;
            height: 24rem;
            border-radius: 50%;
            background: rgba(241, 165, 1, 0.07);
            pointer-events: none;
        }

        .tours-hero::after {
            content: '';
            position: absolute;
            bottom: -4rem;
            left: -4rem;
            width: 16rem;
            height: 16rem;
            border-radius: 50%;
            background: rgba(223, 105, 81, 0.07);
            pointer-events: none;
        }

        .tours-hero-tag {
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #F1A501;
            background: rgba(241, 165, 1, 0.12);
            border-radius: 2rem;
            padding: 0.3rem 1rem;
            margin-bottom: 1rem;
            display: inline-block;
        }

        .tours-hero h1 {
            font-family: 'Volkhov', cursive;
            font-size: 2.6rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.75rem;
        }

        .tours-hero p {
            color: rgba(255, 255, 255, 0.65);
            font-size: 0.95rem;
            margin: 0;
        }

        .tours-hero-stats {
            display: flex;
            gap: 2.5rem;
            margin-top: 2rem;
        }

        .hero-stat-num {
            font-family: 'Volkhov', cursive;
            font-size: 1.6rem;
            font-weight: 700;
            color: #F1A501;
            line-height: 1;
        }

        .hero-stat-label {
            font-size: 0.78rem;
            color: rgba(255, 255, 255, 0.5);
            font-weight: 500;
            margin-top: 0.2rem;
        }

        /* ── Filter bar ── */
        .filter-bar {
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 2rem rgba(20, 24, 62, 0.08);
            padding: 1.25rem 1.5rem;
            margin-top: -2rem;
            position: relative;
            z-index: 10;
        }

        .filter-label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #BDBDBD;
            margin-bottom: 0.5rem;
        }

        .category-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .cat-pill {
            border: 1.5px solid #EEF0F7;
            border-radius: 2rem;
            padding: 0.35rem 1rem;
            font-size: 0.82rem;
            font-weight: 600;
            color: #5E6282;
            background: #F8F9FF;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .cat-pill:hover,
        .cat-pill.active {
            background: #F1A501;
            border-color: #F1A501;
            color: #ffffff;
            text-decoration: none;
        }

        .search-input {
            border: 1.5px solid #EEF0F7;
            border-radius: 0.75rem;
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            font-size: 0.88rem;
            color: #181E4B;
            background: #F8F9FF;
            width: 100%;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search-input:focus {
            border-color: #F1A501;
            box-shadow: 0 0 0 3px rgba(241, 165, 1, 0.10);
            background: #ffffff;
        }

        .search-wrap {
            position: relative;
        }

        .search-wrap i {
            position: absolute;
            left: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            color: #BDBDBD;
            font-size: 0.85rem;
        }

        /* ── Tour card ── */
        .tour-card {
            background: #ffffff;
            border-radius: 1.25rem;
            box-shadow: 0 0.75rem 1.75rem rgba(20, 24, 62, 0.07);
            overflow: hidden;
            height: 100%;
            transition: transform 0.25s, box-shadow 0.25s;
            display: flex;
            flex-direction: column;
        }

        .tour-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1.5rem 3rem rgba(20, 24, 62, 0.13);
        }

        .tour-card-img {
            height: 200px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #EEF0F7 0%, #D8DCF0 100%);
            flex-shrink: 0;
        }

        .tour-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }

        .tour-card:hover .tour-card-img img {
            transform: scale(1.06);
        }

        .tour-card-img .no-img {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: #BDBDBD;
        }

        .tour-card-img .no-img i {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .tour-card-img .no-img span {
            font-size: 0.78rem;
            font-weight: 500;
        }

        .price-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: #F1A501;
            color: #ffffff;
            border-radius: 0.625rem;
            padding: 0.35rem 0.85rem;
            font-size: 0.85rem;
            font-weight: 700;
            box-shadow: 0 0.5rem 1rem rgba(241, 165, 1, 0.3);
        }

        .season-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: rgba(24, 30, 75, 0.75);
            color: #ffffff;
            border-radius: 0.5rem;
            padding: 0.25rem 0.65rem;
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .tour-card-body {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .tour-cats {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-bottom: 0.75rem;
        }

        .tour-cat {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #DF6951;
            background: rgba(223, 105, 81, 0.09);
            border-radius: 0.4rem;
            padding: 0.2rem 0.6rem;
        }

        .tour-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: #181E4B;
            margin-bottom: 0.6rem;
            line-height: 1.4;
        }

        .tour-desc {
            font-size: 0.85rem;
            color: #5E6282;
            line-height: 1.7;
            margin-bottom: 1rem;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .tour-meta {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            padding: 0.85rem 0;
            border-top: 1px solid #F0F4F9;
            border-bottom: 1px solid #F0F4F9;
            margin-bottom: 1rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.8rem;
            color: #5E6282;
            font-weight: 500;
        }

        .meta-item i {
            color: #F1A501;
            font-size: 0.85rem;
        }

        .btn-tour {
            display: block;
            text-align: center;
            background: linear-gradient(135deg, #F1A501 0%, #DF6951 100%);
            color: #ffffff;
            border-radius: 0.75rem;
            padding: 0.7rem 1rem;
            font-size: 0.88rem;
            font-weight: 600;
            text-decoration: none;
            transition: opacity 0.2s, transform 0.2s;
            box-shadow: 0 0.5rem 1.25rem rgba(241, 165, 1, 0.22);
        }

        .btn-tour:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            color: #ffffff;
            text-decoration: none;
        }

        /* ── Empty state ── */
        .empty-state {
            text-align: center;
            padding: 4rem 1rem;
            color: #BDBDBD;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }

        .empty-state p {
            font-size: 0.95rem;
            margin: 0;
        }

        /* ── Pagination ── */
        .pagination .page-link {
            border-radius: 0.625rem !important;
            border: 1.5px solid #EEF0F7;
            color: #5E6282;
            font-weight: 600;
            margin: 0 0.2rem;
            font-size: 0.85rem;
        }

        .pagination .page-item.active .page-link {
            background: #F1A501;
            border-color: #F1A501;
            color: #ffffff;
        }

        .pagination .page-link:hover {
            border-color: #F1A501;
            color: #F1A501;
        }

        @media (max-width: 767.98px) {
            .tours-hero h1 {
                font-size: 1.8rem;
            }

            .tours-hero-stats {
                gap: 1.5rem;
            }

            .filter-bar {
                margin-top: -1rem;
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="tours-page">

        {{-- ── HERO ── --}}
        <div class="tours-hero">
            <div class="container position-relative">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <span class="tours-hero-tag">Explore The World</span>
                        <h1>Find Your Perfect Tour</h1>
                        <p>Discover handpicked tours crafted for every traveller — from adventure seekers to relaxation
                            lovers.</p>
                        <div class="tours-hero-stats">
                            <div>
                                <div class="hero-stat-num">{{ $tours->count() }}</div>
                                <div class="hero-stat-label">Tours Available</div>
                            </div>
                            <div>
                                <div class="hero-stat-num">{{ $about->number_partners }}</div>
                                <div class="hero-stat-label">Partners</div>
                            </div>
                            <div>
                                <div class="hero-stat-num">{{$about->hotels}}</div>
                                <div class="hero-stat-label">Hotels</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── FILTER BAR ── --}}
        <div class="container">
            <div class="filter-bar">
                <div class="row align-items-center g-3">
                    <div class="col-lg-8">
                        <p class="filter-label">Filter by category</p>
                        <div class="category-pills">
                            <a href="{{ route('tours') }}" class="cat-pill {{ !request('category') ? 'active' : '' }}">
                                All Tours
                            </a>
                            @foreach($categories as $category)
                                <a href="#" class="cat-pill {{ request('category') == $category->slug ? 'active' : '' }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    {{--
                    <div class="col-lg-4">
                        <p class="filter-label">Search</p>
                        <form action="{{ route('tours') }}" method="GET">
                            @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <div class="search-wrap">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="text" name="search" class="search-input" placeholder="Search tours…"
                                    value="{{ request('search') }}">
                            </div>
                        </form>
                    </div>
                    --}}
                </div>
            </div>
        </div>

        {{-- ── TOURS GRID ── --}}
        <section class="py-5">
            <div class="container">

                {{-- Results count --}}
                @if(request('search') || request('category'))
                    <p class="mb-4" style="font-size:0.88rem; color:#5E6282; font-weight:500;">
                        Found <strong style="color:#181E4B;">{{ $tours->total() }}</strong> tours
                        @if(request('search')) for "<strong style="color:#181E4B;">{{ request('search') }}</strong>"@endif
                        @if(request('category')) in category "<strong
                        style="color:#181E4B;">{{ request('category') }}</strong>"@endif
                    </p>
                @endif

                @if($tours->count())
                    <div class="row g-4">
                        @foreach($tours as $tour)
                            <div class="col-md-6 col-lg-4">
                                <div class="tour-card">
                                    {{-- Image --}}
                                    <div class="tour-card-img">
                                        @if(isset($tour->image) && $tour->image)
                                            <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->name }}">
                                        @else
                                            <div class="no-img">
                                                <i class="fa-solid fa-image"></i>
                                                <span>No photo</span>
                                            </div>
                                        @endif
                                        <span class="price-badge">${{ number_format($tour->price, 0) }}</span>
                                        @if($tour->season)
                                            <span class="season-badge">{{ $tour->season }}</span>
                                        @endif
                                    </div>

                                    {{-- Body --}}
                                    <div class="tour-card-body">
                                        @if($tour->categories->count())
                                            <div class="tour-cats">
                                                @foreach($tour->categories as $cat)
                                                    <span class="tour-cat">{{ $cat->name }}</span>
                                                @endforeach
                                            </div>
                                        @endif

                                        <h3 class="tour-name">{{ $tour->name }}</h3>
                                        <p class="tour-desc">{{ $tour->description }}</p>

                                        <div class="tour-meta">
                                            <div class="meta-item">
                                                <i class="fa-regular fa-clock"></i>
                                                {{ $tour->duration }} days
                                            </div>
                                            <div class="meta-item">
                                                <i class="fa-solid fa-users"></i>
                                                Max {{ $tour->capacity_of_people }} people
                                            </div>
                                            @if($tour->season)
                                                <div class="meta-item">
                                                    <i class="fa-regular fa-sun"></i>
                                                    {{ $tour->season }}
                                                </div>
                                            @endif
                                        </div>

                                        <a href="{{ route('tour.show', ['id' => $tour->id]) }}" class="btn-tour">
                                            View Details <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}

                    {{--
                    @if($tours->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $tours->appends(request()->query())->links() }}
                    </div>
                    @endif
                    --}}
                @else
                    <div class="empty-state">
                        <i class="fa-solid fa-compass"></i>
                        <p>No tours found. Try a different search or category.</p>
                        <a href="{{ route('tours.index') }}" class="btn-tour d-inline-block mt-3"
                            style="width:auto; padding: 0.7rem 2rem;">
                            Show All Tours
                        </a>
                    </div>
                @endif

            </div>
        </section>

    </div>
@endsection