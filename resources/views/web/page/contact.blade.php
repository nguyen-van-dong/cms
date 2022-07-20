@extends('cms::web.master')

@section('title', settings('name_website').' - Contact me')

@section('content')
    <div class="w3l-contact-10" id="contact">
        <div class="form-41-mian pt-lg-4 pt-md-3 pb-md-4">
            <div class="container">
                <div class="heading">
                    <h3 class="category-title mb-3">{{ __('cms::web.contact') }}</h3>
                    <p class="mb-md-5 mb-4">{{ __('cms::web.sub_contact') }}</p>
                    @if(session()->has('success'))
                        <div class="flash-block">
                            <div class="alert alert-info">
                                {{ session()->get('success') }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-8 form-inner-cont">
                        <form action="{{ route('contact.web.contact.store-contact') }}" method="post">
                            @csrf
                            <div class="form-grids">
                                <div class="form-input">
                                    <input type="text" name="full_name" class="@error('full_name') is-invalid @enderror" placeholder="{{ __('cms::web.form.full_name') }}"
                                           value="{{ old('full_name') }}" required/>
                                    @error(('full_name'))
                                    <span class="invalid-feedback text-left">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <input type="text" name="subject" placeholder="{{ __('cms::web.form.subject') }}"
                                           value="{{ old('subject') }}" />
                                </div>
                                <div class="form-input">
                                    <input type="email" name="email" placeholder="{{ __('cms::web.form.email') }}"
                                           value="{{ old('email') }}" />
                                </div>
                                <div class="form-input">
                                    <input type="text" name="phone" class="@error('full_name') is-invalid @enderror" placeholder="{{ __('cms::web.form.phone') }}"
                                           value="{{ old('phone') }}" required/>
                                    @error(('phone'))
                                    <span class="invalid-feedback text-left">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-input">
                            <textarea name="content" placeholder="{{ __('cms::web.form.content') }}"
                                      required="">{{ old('content') }}</textarea>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-style btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-4 contacts-5-grid-main section-gap mt-lg-0 mt-5">
                        <div class="contacts-5-grid">
                            <h3 class="section-title-left mb-4"> Advertise with us</h3>
                            <div class="map-content-5">
                                <section class="tab-content">
                                    <div class="contact-type">
                                        <div class="address-grid mb-4">
                                            <h6>Address</h6>
                                            <p>{{ settings('address') }}</p>
                                        </div>
                                        <div class="address-grid mb-4">
                                            <h6>Email Address</h6>
                                            <a href="mailto:{{ settings('contact_email') }}" class="link1">{{ settings('contact_email') }}</a>
                                        </div>
                                        <div class="address-grid">
                                            <h6>Phone Number</h6>
                                            <a href="tel:+12 324-016-695" class="link1">{{ settings('contact_phone') }}</a>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //contacts-5-grid -->
        </div>
    </div>

    <div class="contacts-sub-5">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.305935303!2d-74.25986548248684!3d40.69714941932609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1563262564932!5m2!1sen!2sin"
            style="border:0" allowfullscreen></iframe>
    </div>
@stop
