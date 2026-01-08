<section id="hero" class="hero section dark-background">

    <img src="assets/img/hero-bg.webp" alt="" data-aos="fade-in">

    <div class="container">
        <h2 data-aos="fade-up" data-aos-delay="100">Empowering Today,<br>Supporting Financial Growth Tomorrow</h2>
        <p data-aos="fade-up" data-aos-delay="200">We are a trusted financial team providing secure and transparent loan
            solutions.</p>
        <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">

            @auth
                @switch(auth()->user()->usertype)
                    @case('admin')
                        <a href="{{ route('admin.index') }}" class="btn-get-started">
                            Dashboard
                        </a>
                    @break

                    @case('staff')
                        <a href="{{ route('admin.staff') }}" class="btn-get-started">
                            Staff Dashboard
                        </a>
                    @break

                    @case('loan_officer')
                        <a href="{{ route('admin.loan_officer') }}" class="btn-get-started">
                            Loan Office
                        </a>
                    @break

                    @default
                        <a href="{{ route('dashboard') }}" class="btn-get-started">
                            Apply Loan
                        </a>
                @endswitch
            @else
                <a href="{{ route('login') }}" class="btn-get-started">
                    Apply Loan
                </a>
            @endauth

        </div>


    </div>

</section>
