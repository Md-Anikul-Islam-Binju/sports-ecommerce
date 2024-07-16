@extends('user.app')
@section('content')
    <!-- Contact Us Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6">
                    <div
                        class="info-item d-flex flex-column justify-content-center align-items-center theme_ws_box"
                    >
                        <i class="bi bi-map"></i>
                        <h3>Our Address</h3>
                        <p>South Mugda, Mugda Para, Dhaka.</p>
                    </div>
                </div>
                <!-- End Info Item -->

                <div class="col-lg-3 col-md-6">
                    <div
                        class="info-item d-flex flex-column justify-content-center align-items-center theme_ws_box"
                    >
                        <i class="bi bi-envelope"></i>
                        <h3>Email Us</h3>
                        <p>info.wingsapprels.com</p>
                    </div>
                </div>
                <!-- End Info Item -->

                <div class="col-lg-3 col-md-6">
                    <div
                        class="info-item d-flex flex-column justify-content-center align-items-center theme_ws_box"
                    >
                        <i class="bi bi-telephone"></i>
                        <h3>Call Us</h3>
                        <p>+88 01619426800</p>
                    </div>
                </div>
                <!-- End Info Item -->
            </div>

            <div class="row gy-4 mt-1">
                <div class="col-lg-6">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.5682139080172!2d90.42933582560366!3d23.727108689669635!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b838069903af%3A0x9161fc3529f27343!2sSouth%20Mugdapara%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1718861443650!5m2!1sen!2sbd"
                        frameborder="0"
                        style="border: 0; width: 100%; height: 384px"
                        allowfullscreen
                    ></iframe>
                </div>
                <!-- End Google Maps -->
                <div class="col-lg-6">
                    <form method="post" action="{{route('user.contact.store')}}" class="php-email-form">
                    @csrf
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    id="name"
                                    placeholder="Your Name"
                                    required
                                />
                            </div>
                            <div class="col-lg-6 form-group">
                                <input
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    id="email"
                                    placeholder="Your Email"
                                    required
                                />
                            </div>
                        </div>
                        <div class="form-group">
                            <input
                                type="text"
                                class="form-control"
                                name="subject"
                                id="subject"
                                placeholder="Subject"
                                required
                            />
                        </div>
                        <div class="form-group">
                            <textarea
                                class="form-control"
                                name="message"
                                rows="5"
                                placeholder="Message"
                                required
                            ></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">
                                Your message has been sent. Thank you!
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
                <!-- End Contact Form -->
            </div>
        </div>
    </section>
@endsection
