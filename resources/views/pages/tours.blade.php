@extends('layouts.app')


@section('content')
    <!-- ============================================-->
    <!-- Tours <section> begin ============================-->
    <section class="pt-5" id="destination">

        <div class="container">
            <div class="position-absolute start-100 bottom-0 translate-middle-x d-none d-xl-block ms-xl-n4"><img
                    src="assets/img/dest/shape.svg" alt="destination" /></div>
            <div class="mb-7 text-center">
                <h5 class="text-secondary">Top Selling </h5>
                <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Top Destinations</h3>
            </div>
            <div class="row">
                @foreach ($tours as $tour)
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('assets/img/dest/dest1.jpg') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $tour->name }}</h5>
                                <p class="card-text">{{ $tour->description }}</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Price: ${{ $tour->price }}</li>
                                <li class="list-group-item">Duration: {{ $tour->duration }}</li>
                                <li class="list-group-item">Capacity: {{ $tour->capacity_of_people }}</li>
                                <li class="list-group-item">Season: {{ $tour->season}}</li>
                            </ul>
                            <div class="card-body">
                                <a href="#" class="card-link">Ссылка карточки</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div><!-- end of .container-->

    </section>

@endsection