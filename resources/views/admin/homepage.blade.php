@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Homepage')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Homepage')}}</h1>
          </div>

          @include('template-part.admin_lang_switcer')


          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.update-homepage') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="lang_code" value="{{ admin_lang() }}"> 

                            <h5>{{__('admin.Location')}}</h5>
                            <hr>
                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="location_title" class="form-control" value="{{ $homepage->location_title }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <input type="text" name="location_description" class="form-control" value="{{ $homepage->location_description }}">
                            </div>


                            @if (admin_lang() === 'en')
                            <div class="form-group">
                                <div class="control-label">{{__('admin.Visibility')}}</div>
                                <label class="mt-2">
                                  <input {{ $homepage->show_location == 'enable' ? 'checked' : '' }} type="checkbox" name="location_status" class="custom-switch-input">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description">{{__('admin.Please enable or disable this section')}}</span>
                                </label>
                            </div>
                            @endif

                            <h5>{{__('admin.Featured Property')}}</h5>
                            <hr>
                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="property_title" class="form-control" value="{{ $homepage->property_title }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <input type="text" name="property_description" class="form-control" value="{{ $homepage->property_description }}">
                            </div>

                            @if (admin_lang() === 'en')
                            <div class="form-group">
                                <label for="">{{__('admin.Item')}}</label>
                                <input type="text" name="property_item" class="form-control" value="{{ $homepage->property_item }}">
                            </div>


                            <div class="form-group">
                                <div class="control-label">{{__('admin.Visibility')}}</div>
                                <label class="mt-2">
                                  <input {{ $homepage->show_property == 'enable' ? 'checked' : '' }} type="checkbox" name="property_status" class="custom-switch-input">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description">{{__('admin.Please enable or disable this section')}}</span>
                                </label>
                            </div>
                            @endif

                            <h5>{{__('admin.Urgent Property')}}</h5>
                            <hr>
                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="urgent_property_title" class="form-control" value="{{ $homepage->urgent_property_title }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <input type="text" name="urgent_property_description" class="form-control" value="{{ $homepage->urgent_property_description }}">
                            </div>

                            @if (admin_lang() === 'en')
                            <div class="form-group">
                                <label for="">{{__('admin.Item')}}</label>
                                <input type="text" name="urgent_property_item" class="form-control" value="{{ $homepage->urgent_property_item }}">
                            </div>


                            <div class="form-group">
                                <div class="control-label">{{__('admin.Visibility')}}</div>
                                <label class="mt-2">
                                  <input {{ $homepage->show_urgent_property == 'enable' ? 'checked' : '' }} type="checkbox" name="urgent_property_status" class="custom-switch-input">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description">{{__('admin.Please enable or disable this section')}}</span>
                                </label>
                            </div>

                            @endif

                            <h5>{{__('admin.Why Choose Us')}}</h5>
                            <hr>
                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="why_choose_title" class="form-control" value="{{ $homepage->why_choose_title }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <input type="text" name="why_choose_description" class="form-control" value="{{ $homepage->why_choose_description }}">
                            </div>

                            @if (admin_lang() === 'en')
                            <div class="form-group">
                                <div class="control-label">{{__('admin.Visibility')}}</div>
                                <label class="mt-2">
                                  <input {{ $homepage->show_why_choose_us == 'enable' ? 'checked' : '' }} type="checkbox" name="why_choose_us_status" class="custom-switch-input">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description">{{__('admin.Please enable or disable this section')}}</span>
                                </label>
                            </div>

                            @endif

                            <h5>{{__('admin.Agent')}}</h5>
                            <hr>

                            @if (admin_lang() === 'en')
                            <div class="form-group">
                                <label for="">{{__('admin.Existing Background')}}</label>
                                <div>
                                    <img src="{{ ($homepage->home2_agent_bg)? asset($homepage->home2_agent_bg) : asset($setting->default_placeholder)}}" class="w_300" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Background Image')}}</label>
                                <input type="file" name="home2_agent_bg" class="form-control-file">
                            </div>

                            @endif

                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="agent_title" class="form-control" value="{{ $homepage->agent_title }}">
                            </div>



                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <input type="text" name="agent_description" class="form-control" value="{{ $homepage->agent_description }}">
                            </div>


                            @if (admin_lang() === 'en')
                            <div class="form-group">
                                <label for="">{{__('admin.Item')}}</label>
                                <input type="text" name="agent_item" class="form-control" value="{{ $homepage->agent_item }}">
                            </div>


                            <div class="form-group">
                                <div class="control-label">{{__('admin.Visibility')}}</div>
                                <label class="mt-2">
                                  <input {{ $homepage->show_agent == 'enable' ? 'checked' : '' }} type="checkbox" name="agent_status" class="custom-switch-input">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description">{{__('admin.Please enable or disable this section')}}</span>
                                </label>
                            </div>

                            @endif


                            <h5>{{__('admin.Testimonial')}}</h5>
                            <hr>

                            @if (admin_lang() === 'en')
                            <div class="form-group">
                                <label for="">{{__('admin.Existing Background')}}</label>
                                <div>
                                    <img src="{{ asset($homepage->testimonial_bg) }}" class="w_300" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Background Image')}}</label>
                                <input type="file" name="testimonial_bg" class="form-control-file">
                            </div>

                            @endif

                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="testimonial_title" class="form-control" value="{{ $homepage->testimonial_title }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <input type="text" name="testimonial_description" class="form-control" value="{{ $homepage->testimonial_description }}">
                            </div>


                            @if (admin_lang() === 'en')

                            <div class="form-group">
                                <label for="">{{__('admin.Item')}}</label>
                                <input type="text" name="testimonial_item" class="form-control" value="{{ $homepage->testimonial_item }}">
                            </div>

                            <div class="form-group">
                                <div class="control-label">{{__('admin.Visibility')}}</div>
                                <label class="mt-2">
                                  <input {{ $homepage->show_testimonial == 'enable' ? 'checked' : '' }} type="checkbox" name="testimonial_status" class="custom-switch-input">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description">{{__('admin.Please enable or disable this section')}}</span>
                                </label>
                            </div>

                            @endif


                            <h5>{{__('admin.Blog')}}</h5>
                            <hr>

                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="blog_title" class="form-control" value="{{ $homepage->blog_title }}">
                            </div>



                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <input type="text" name="blog_description" class="form-control" value="{{ $homepage->blog_description }}">
                            </div>

                            @if (admin_lang() === 'en')
                            <div class="form-group">
                                <label for="">{{__('admin.Item')}}</label>
                                <input type="text" name="blog_item" class="form-control" value="{{ $homepage->blog_item }}">
                            </div>


                            <div class="form-group">
                                <div class="control-label">{{__('admin.Visibility')}}</div>
                                <label class="mt-2">
                                  <input {{ $homepage->show_blog == 'enable' ? 'checked' : '' }} type="checkbox" name="blog_status" class="custom-switch-input">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description">{{__('admin.Please enable or disable this section')}}</span>
                                </label>
                            </div>
                            @endif


                            <h5>{{__('admin.Pricing Plan')}}</h5>
                            <hr>

                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="pricing_plan_title" class="form-control" value="{{ $homepage->pricing_plan_title }}">
                            </div>



                            <div class="form-group">
                                <label for="">{{__('admin.Description')}}</label>
                                <input type="text" name="pricing_plan_description" class="form-control" value="{{ $homepage->pricing_plan_description }}">
                            </div>



                            @if (admin_lang() === 'en')
                            <div class="form-group">
                                <div class="control-label">{{__('admin.Visibility')}}</div>
                                <label class="mt-2">
                                  <input {{ $homepage->show_pricing_plan == 'enable' ? 'checked' : '' }} type="checkbox" name="pricing_plan_status" class="custom-switch-input">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description">{{__('admin.Please enable or disable this section')}}</span>
                                </label>
                            </div>

                 



                            <h5>{{__('admin.Category')}}</h5>
                            <hr>

                            <div class="form-group">
                                <label for="">{{__('admin.Item')}}</label>
                                <input type="text" name="category_item" class="form-control" value="{{ $homepage->category_item }}">
                            </div>


                            <div class="form-group">
                                <div class="control-label">{{__('admin.Visibility')}}</div>
                                <label class="mt-2">
                                  <input {{ $homepage->show_category == 'enable' ? 'checked' : '' }} type="checkbox" name="category_status" class="custom-switch-input">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description">{{__('admin.Please enable or disable this section')}}</span>
                                </label>
                            </div>

                            @endif

                            <h5>{{__('admin.Partner')}}</h5>
                            <hr>

                            <div class="form-group">
                                <label for="">{{__('admin.Title')}}</label>
                                <input type="text" name="partner_title" class="form-control" value="{{ $homepage->partner_title }}">
                            </div>

                            @if (admin_lang() === 'en')
                            <div class="form-group">
                                <label for="">{{__('admin.Item')}}</label>
                                <input type="text" name="partner_item" class="form-control" value="{{ $homepage->partner_item }}">
                            </div>


                            <div class="form-group">
                                <div class="control-label">{{__('admin.Visibility')}}</div>
                                <label class="mt-2">
                                  <input {{ $homepage->show_partner == 'enable' ? 'checked' : '' }} type="checkbox" name="partner_status" class="custom-switch-input">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description">{{__('admin.Please enable or disable this section')}}</span>
                                </label>
                            </div>

                            <hr>

                            <div class="form-group">
                                <div class="control-label">{{__('admin.About Us Visibility')}}</div>
                                <label class="mt-2">
                                  <input {{ $homepage->show_about_us == 'enable' ? 'checked' : '' }} type="checkbox" name="about_us_status" class="custom-switch-input">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description">{{__('admin.Please enable or disable this section')}}</span>
                                </label>
                            </div>

                            <div class="form-group">
                                <div class="control-label">{{__('admin.FAQ Visibility')}}</div>
                                <label class="mt-2">
                                  <input {{ $homepage->show_faq == 'enable' ? 'checked' : '' }} type="checkbox" name="faq_status" class="custom-switch-input">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description">{{__('admin.Please enable or disable this section')}}</span>
                                </label>
                            </div>

                            <div class="form-group">
                                <div class="control-label">{{__('admin.Mobile App Visibility')}}</div>
                                <label class="mt-2">
                                  <input {{ $homepage->show_mobile_app == 'enable' ? 'checked' : '' }} type="checkbox" name="mobile_app_status" class="custom-switch-input">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description">{{__('admin.Please enable or disable this section')}}</span>
                                </label>
                            </div>

                            <div class="form-group">
                                <div class="control-label">{{__('admin.Counter Visibility')}}</div>
                                <label class="mt-2">
                                  <input {{ $homepage->show_counter == 'enable' ? 'checked' : '' }} type="checkbox" name="counter_status" class="custom-switch-input">
                                  <span class="custom-switch-indicator"></span>
                                  <span class="custom-switch-description">{{__('admin.Please enable or disable this section')}}</span>
                                </label>
                            </div>

                            @endif

                            <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

@endsection
