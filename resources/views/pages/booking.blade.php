@extends('layouts.app')

{{-- Стили только для booking --}}

@section('title', 'Booking - Shirin Travel')

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        /* ── Page offset for fixed navbar ── */
        .booking-page {
            padding-top: 0;
            padding-bottom: 5rem;
            background-color: #FFFEFE;
            position: relative;
            overflow: hidden;
        }

        /* ── Decorative background shapes ── */
        .booking-page::before {
            content: '';
            position: absolute;
            top: 8rem;
            right: -6rem;
            width: 22rem;
            height: 22rem;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(241, 165, 1, 0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .booking-page::after {
            content: '';
            position: absolute;
            bottom: 4rem;
            left: -5rem;
            width: 18rem;
            height: 18rem;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(223, 105, 81, 0.07) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ── Section heading ── */
        .booking-heading-tag {
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #DF6951;
            margin-bottom: 0.5rem;
        }

        .booking-heading-title {
            font-family: 'Volkhov', cursive;
            font-size: 2.4rem;
            font-weight: 700;
            color: #181E4B;
            margin-bottom: 0.75rem;
        }

        .booking-heading-sub {
            color: #5E6282;
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* ── Main card wrapper ── */
        .booking-card {
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 2rem 4rem rgba(20, 24, 62, 0.10);
            border: none;
        }

        /* ── Left: Form side ── */
        .form-side {
            background: #ffffff;
            padding: 3rem 2.5rem;
        }

        .form-side h3 {
            font-family: 'Volkhov', cursive;
            font-size: 1.5rem;
            color: #181E4B;
            margin-bottom: 0.3rem;
        }

        .form-side .form-subtitle {
            font-size: 0.875rem;
            color: #5E6282;
            margin-bottom: 2rem;
        }

        /* ── Input fields ── */
        .booking-input {
            border: 1.5px solid #EEF0F7;
            border-radius: 0.75rem;
            padding: 0.85rem 1rem 0.85rem 3rem !important;
            font-size: 0.9rem;
            color: #181E4B;
            background: #F8F9FF;
            width: 100%;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none;
        }

        .booking-input::placeholder {
            color: #BDBDBD;
        }

        .booking-input:focus {
            border-color: #F1A501;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(241, 165, 1, 0.10) !important;
        }

        .booking-input.is-invalid {
            border-color: #DF6951;
        }

        .input-icon-wrap {
            position: relative;
            margin-bottom: 1.25rem;
        }

        .input-icon-wrap .field-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #F1A501;
            font-size: 0.95rem;
        }

        .input-icon-wrap textarea.booking-input {
            padding-top: 1rem;
        }

        .input-icon-wrap .field-icon.top-icon {
            top: 1.1rem;
            transform: none;
        }

        /* ── Submit button ── */
        .btn-booking {
            background: linear-gradient(135deg, #F1A501 0%, #DF6951 100%);
            color: #ffffff;
            border: none;
            border-radius: 0.75rem;
            padding: 0.9rem 2.5rem;
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            width: 100%;
            transition: opacity 0.2s, transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 0.75rem 1.5rem rgba(241, 165, 1, 0.25);
            cursor: pointer;
        }

        .btn-booking:hover {
            opacity: 0.92;
            transform: translateY(-2px);
            box-shadow: 0 1rem 2rem rgba(241, 165, 1, 0.30);
        }

        .btn-booking:active {
            transform: translateY(0);
        }

        /* ── Alert messages ── */
        .form-alert {
            display: none;
            border-radius: 0.75rem;
            padding: 0.9rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.25rem;
        }

        .form-alert.success {
            background: rgba(121, 185, 60, 0.1);
            color: #79B93C;
            border: 1px solid rgba(121, 185, 60, 0.2);
        }

        .form-alert.error {
            background: rgba(223, 105, 81, 0.1);
            color: #DF6951;
            border: 1px solid rgba(223, 105, 81, 0.2);
        }

        /* ── Right: Info side ── */
        .info-side {
            background: linear-gradient(160deg, #181E4B 0%, #14183E 60%, #0f1232 100%);
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .info-side::before {
            content: '';
            position: absolute;
            top: -4rem;
            right: -4rem;
            width: 16rem;
            height: 16rem;
            border-radius: 50%;
            background: rgba(241, 165, 1, 0.08);
            pointer-events: none;
        }

        .info-side::after {
            content: '';
            position: absolute;
            bottom: -3rem;
            left: -3rem;
            width: 12rem;
            height: 12rem;
            border-radius: 50%;
            background: rgba(223, 105, 81, 0.08);
            pointer-events: none;
        }

        .info-side h3 {
            font-family: 'Volkhov', cursive;
            font-size: 1.5rem;
            color: #ffffff;
            margin-bottom: 0.3rem;
        }

        .info-side .info-subtitle {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.55);
            margin-bottom: 2.5rem;
        }

        /* ── Contact info items ── */
        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 1.1rem;
            margin-bottom: 1.75rem;
        }

        .contact-item:last-of-type {
            margin-bottom: 0;
        }

        .contact-icon-box {
            width: 2.75rem;
            height: 2.75rem;
            min-width: 2.75rem;
            border-radius: 0.75rem;
            background: rgba(241, 165, 1, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #F1A501;
            font-size: 1rem;
            transition: background 0.2s, transform 0.2s;
        }

        .contact-item:hover .contact-icon-box {
            background: rgba(241, 165, 1, 0.28);
            transform: scale(1.07);
        }

        .contact-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255, 255, 255, 0.4);
            font-weight: 600;
            margin-bottom: 0.15rem;
        }

        .contact-value {
            font-size: 0.9rem;
            color: #ffffff;
            font-weight: 500;
            margin: 0;
        }

        .contact-value a {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.2s;
        }

        .contact-value a:hover {
            color: #F1A501;
            text-decoration: none;
        }

        /* ── Divider in info side ── */
        .info-divider {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 2rem 0;
        }

        /* ── Social icons ── */
        .social-heading {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255, 255, 255, 0.4);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .social-links {
            display: flex;
            gap: 0.75rem;
        }

        .social-btn {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.625rem;
            background: rgba(255, 255, 255, 0.07);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.875rem;
            text-decoration: none;
            transition: background 0.2s, color 0.2s, transform 0.2s;
        }

        .social-btn:hover {
            background: #F1A501;
            color: #ffffff;
            transform: translateY(-3px);
            text-decoration: none;
        }

        /* ── Decorative dot badge ── */
        .dot-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.78rem;
            font-weight: 600;
            color: #F1A501;
            background: rgba(241, 165, 1, 0.10);
            border-radius: 2rem;
            padding: 0.3rem 0.9rem;
            margin-bottom: 1rem;
        }

        .dot-badge::before {
            content: '';
            width: 0.45rem;
            height: 0.45rem;
            border-radius: 50%;
            background: #F1A501;
        }

        /* ── Responsive ── */
        @media (max-width: 767.98px) {
            .booking-heading-title {
                font-size: 1.75rem;
            }

            .form-side,
            .info-side {
                padding: 2rem 1.5rem;
            }

            .booking-card {
                border-radius: 1rem;
            }
        }
    </style>

@endpush

@section('content')

    <section class="booking-page">
        <div class="container">

            {{-- Section heading --}}
            <div class="text-center mb-5">
                <div class="dot-badge mx-auto">Book Your Trip</div>
                <h2 class="booking-heading-title">Get In Touch With Us</h2>
                <p class="booking-heading-sub">
                    Have questions or ready to plan your next adventure?<br>
                    We're here to help you every step of the way.
                </p>
            </div>

            {{-- Main card --}}
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="booking-card row g-0">

                        {{-- LEFT: Form --}}
                        <div class="col-md-6 form-side">
                            <h3>Send a Message</h3>
                            <p class="form-subtitle">Fill out the form and we'll get back to you shortly.</p>

                            {{-- Alerts --}}
                            <div id="alert-success" class="form-alert success">
                                <i class="fa-solid fa-circle-check me-2"></i>
                                Your message was sent successfully. We'll be in touch!
                            </div>
                            <div id="alert-error" class="form-alert error">
                                <i class="fa-solid fa-circle-exclamation me-2"></i>
                                Something went wrong. Please try again.
                            </div>

                            <form action="{{ route('booking.store') }}" method="POST" id="bookingForm" novalidate>
                                @csrf

                                @if(session('success'))
                                    <div class="alert">{{ session('success') }}</div>
                                @endif

                                <div class="input-icon-wrap">
                                    <i class="fa-regular fa-user field-icon"></i>
                                    <input type="text" class="booking-input" id="name" name="name"
                                        placeholder="Your full name" required>
                                </div>

                                <div class="input-icon-wrap">
                                    <i class="fa-regular fa-envelope field-icon"></i>
                                    <input type="email" class="booking-input" id="email" name="email"
                                        placeholder="Email address" required>
                                </div>

                                <div class="input-icon-wrap">
                                    <i class="fa-regular fa-compass field-icon"></i>
                                    <input type="text" class="booking-input" id="destination" name="destination"
                                        placeholder="Desired destination">
                                </div>

                                <div class="input-icon-wrap">
                                    <i class="fa-regular fa-calendar field-icon top-icon"></i>
                                    <textarea class="booking-input" id="message" name="message" rows="4"
                                        placeholder="Tell us about your trip — dates, guests, preferences…"
                                        required></textarea>
                                </div>

                                <button type="submit" class="btn-booking">
                                    <i class="fa-solid fa-paper-plane me-2"></i>
                                    Send Message
                                </button>
                            </form>
                        </div>

                        {{-- RIGHT: Contact info --}}
                        <div class="col-md-6 info-side">
                            <h3>Contact Information</h3>
                            <p class="info-subtitle">We're open for any suggestion or just to have a chat.</p>

                            <div class="contact-item">
                                <div class="contact-icon-box">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div>
                                    <p class="contact-label">Address</p>
                                    <p class="contact-value">198 West 21th Street, Suite 721<br>New York NY 10016</p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon-box">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div>
                                    <p class="contact-label">Phone</p>
                                    <p class="contact-value">
                                        <a href="tel:+12352355988">+1 235 2355 98</a>
                                    </p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon-box">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div>
                                    <p class="contact-label">Email</p>
                                    <p class="contact-value">
                                        <a href="mailto:info@jadoo.co">info@jadoo.co</a>
                                    </p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon-box">
                                    <i class="fa-solid fa-globe"></i>
                                </div>
                                <div>
                                    <p class="contact-label">Website</p>
                                    <p class="contact-value">
                                        <a href="#">www.jadoo.co</a>
                                    </p>
                                </div>
                            </div>

                            <hr class="info-divider">

                            <p class="social-heading">Follow us</p>
                            <div class="social-links">
                                <a href="#!" class="social-btn"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#!" class="social-btn"><i class="fa-brands fa-instagram"></i></a>
                                <a href="#!" class="social-btn"><i class="fa-brands fa-x-twitter"></i></a>
                                <a href="#!" class="social-btn"><i class="fa-brands fa-youtube"></i></a>
                            </div>
                        </div>

                    </div>{{-- /booking-card --}}
                </div>
            </div>

        </div>
    </section>

@endsection

{{-- JS только для booking --}}