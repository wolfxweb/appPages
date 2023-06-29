<div class="page-wrapper">
    <div class="container p-0">
        <div class="page-content page-content-two">
            @include('vcard.includes.session',[$vcard,$prefs]) 
            <div class="mb-25 p-5"></div>
        </div>
    </div>
</div>
<svg style="visibility: hidden; position: absolute;" width="0" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1">
    <defs>
        <filter id="radius"><feGaussianBlur in="SourceGraphic" stdDeviation="8" result="blur" />    
            <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 25 -10" result="goo" />
            <feComposite in="SourceGraphic" in2="goo" operator="atop"/>
        </filter>
    </defs>
</svg>