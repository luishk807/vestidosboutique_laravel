<div class="container">
    <div class="row vesti-footer-section-1">
        <div class="col-md-4  text-center">
            <img src="{{ asset('images/logo_white.svg') }}" class="vesti-svg vestidos-logo-b"/>
        </div>

        <div class="col-md-8  text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 footer-top-col">
                        <ul class="list-unstyled">
                            <!-- <li><a class="vestidos-simple-link-white" href="{{ route('about_page') }}">{{ __('header.about') }}</a></li> -->
                            <li><a  class="vestidos-simple-link-white" href="{{ route('viewContactPage') }}">{{ __('header.contact') }}</a></li>
                            <li><a  class="vestidos-simple-link-white" href="{{ route('terms_use') }}">{{ __('header.terms') }}</a></li>
                            <li><a  class="vestidos-simple-link-white" href="{{ route('privacy_use') }}">{{ __('header.privacy') }}</a></li>
                        </ul>

                    </div>
                    <div class="col-md-6 footer-top-col">
                        <ul class="list-unstyled">
                            <li>{{ __('general.got_question') }}</li>
                            <li>{{ trans_choice('general.form.telephone',1) }}: <a  class="vestidos-simple-link-white" href="tel:203-5848">+507 203-5848</a></li>
                            <a  class="vestidos-simple-link-white" href="https://api.whatsapp.com/send?phone=67266556&text=Hello.">
                                <img src="{{ asset('images/social-whatssap.svg') }}" class="vesti-svg vestidos-icons-social-b"/>
                                +6726-6556</a>
                            <li>{{ __('general.form.email') }}: <a href='mailto:info@vestidosboutique.com' class="vestidos-simple-link-white" >info@vestidosboutique.com</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col text-center my-3">
            &copy; {{ now()->year }} vestidosboutique.com. {{ __('general.all_right_reserved') }}.
        </div>
    </div>
    <div class="row vesti-footer-section-2">
        <div class="col-md-8 footer-bottom-col text-center">
        {{ __('header.payment') }}:
            <img src="{{ asset('images/cc-visa.svg') }}" class="vesti-svg vestidos-icons-payment"/>
            <img src="{{ asset('images/cc-master.svg') }}" class="vesti-svg vestidos-icons-payment"/>
            <img src="{{ asset('images/cc-amex.svg') }}" class="vesti-svg vestidos-icons-payment"/>
            <img src="{{ asset('images/cc-discover.svg') }}" class="vesti-svg vestidos-icons-payment"/>
        </div>

        <div class="col-md-4 footer-bottom-col text-right">
            <a href="https://www.facebook.com/vesti2/" target="_blank"><img src="{{ asset('images/social-facebook.svg') }}" class="vesti-svg vestidos-icons-social-b"/></a>
            <a href="https://www.instagram.com/vestidos_boutique/" target="_blank"><img src="{{ asset('images/social-instagram.svg') }}" class="vesti-svg vestidos-icons-social"/></a>
            <!-- <img src="{{ asset('images/social-twitter.svg') }}" class="vesti-svg vestidos-icons-social"/>
            <img src="{{ asset('images/social-pinterest.svg') }}" class="vesti-svg vestidos-icons-social"/> -->
        </div>
    </div>
</div>