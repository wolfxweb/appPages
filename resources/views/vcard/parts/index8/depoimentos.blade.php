
@if (is_array($prefs) && in_array('Testimonials', $prefs))
<!--====== Start Testimonial  ======-->
<div class="section-widget testimonial-area-four mb-25">
    <div class="row">
        <div class="col-8">
            <h3 class="widget-title">{{$keywords["Depoimentos"] ?? "Testimonial"}}</h3>
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
                    <div class="testimonial-content">
                        <p>{{$testimonial->comment}}</p>
                        <div class="author-title-thumb d-flex">
                            <div class="author-thumb">
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
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div><!--====== End Testimonial  ======-->
@endif