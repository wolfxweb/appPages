<div class="testimonial-section-widget testimonial-section-three">
    <div class="row align-items-center">
        <div class="col-8">
            <div class="section-title">
                <h4>{{$keywords["Testimonial"] ?? "Testimonial"}}</h4>
            </div>
        </div>
        <div class="col-4">
            <div class="testimonial-arrows"></div>
        </div>
    </div>
    @php
        $testimonials = !empty($vcard->user_vcard_testimonials) ? $vcard->user_vcard_testimonials()->orderBy('serial_number', 'ASC')->get() : [];
    @endphp
    @if (!empty($testimonials))
    <div class="testimonial-slider-one">
        @foreach ($testimonials as $testimonial)
        <div class="testimonial-item">
            <div class="title-thumb d-flex align-items-center">
                <div class="thumb">
                    <img class="lazy" data-src="{{asset('assets/front/img/user/testimonials/' . $testimonial->image)}}" alt="thumb">
                </div>
                <div class="title">
                    <h5>{{$testimonial->name}}</h5>
                    <ul class="rating">
                        @for ($i = 0; $i < $testimonial->rating; $i++)
                        <li><i class="fas fa-star"></i></li>
                        @endfor
                        @for ($i = 0; $i < (5 - $testimonial->rating); $i++)
                        <li><i class="far fa-star"></i></li>
                        @endfor
                    </ul>
                </div>
            </div>
            <div class="content">
                <p>{{$testimonial->comment}}</p>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>