@if (is_array($prefs) && in_array('Testimonials', $prefs))
<!--====== Start Testimonial  ======-->
<div class="section-widget testimonial-area-six mb-25">
    @php
        $testimonials = !empty($vcard->user_vcard_testimonials) ? $vcard->user_vcard_testimonials()->orderBy('serial_number', 'ASC')->get() : [];
    @endphp
    @if (!empty($testimonials))
    <div class="testimonial-slider-three">
        @foreach ($testimonials as $testimonial)
            <div class="testimonial-item m-2">
                <div class="testimonial-content text-center">
                    <div class="author-title-thumb">
                        <div class="author-thumb d-inline-flex">
                            <img data-src="{{asset('assets/front/img/user/testimonials/' . $testimonial->image)}}" class="lazy" alt="">
                        </div>
                        <div class="author-title">
                            <h3>{{$testimonial->name}}</h3>
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
                    <p>{{$testimonial->comment}}</p>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div><!--====== End Testimonial  ======-->
@endif