@extends('layouts.user')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Gallery</div>
    </div>
    <div class="container mb-4">
        @foreach ($galleries as $gallery)
            <div class="row">
                <div class="col-lg-12 text-center my-2">
                    <h3 class="py-2 font-weight-bold text-primary text-uppercase">{{ $gallery->title }}</h3>
                    <p>{{ $gallery->description }}</p>
                </div>
            </div>
            <div class="portfolio-item row">
                @foreach ($gallery->photos as $value)
                    <div class="item col-lg-4 col-md-4 col-6 col-sm">
                        <a href="{{ Storage::drive('google')->url($gallery->title . '/' . $value->photo) }}"
                            class="fancylight popup-btn" data-fancybox-group="light">
                            <img class="img-fluid"
                                src="{{ Storage::drive('google')->url($gallery->title . '/' . $value->photo) }}"
                                title="{{ $value->description }}">
                        </a>
                    </div>
                @endforeach
                {{-- <img class="img-fluid"
                            src="{{ Storage::drive('google')->url($value->title . '/' . $value->photos->photo) }}"
                            title="{{ $value->description }}"> --}}
            </div>
        @endforeach
    </div>
@endsection


@section('scripts')
    <script>
        $('.portfolio-menu ul li').click(function() {
            $('.portfolio-menu ul li').removeClass('active');
            $(this).addClass('active');

            var selector = $(this).attr('data-filter');
            $('.portfolio-item').isotope({
                filter: selector
            });
            return false;
        });
        $(document).ready(function() {
            var popup_btn = $('.popup-btn');
            popup_btn.magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                },
                image: {
                    titleSrc: function(item) {
                        return item.el.find('img').attr('title');
                    }
                }
            });
        });
    </script>
@endsection
