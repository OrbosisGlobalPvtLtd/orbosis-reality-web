@extends('layout')

@section('title')
    <title>{{__('user.Compare')}}</title>
@endsection

@section('meta')
    <meta name="description" content="{{__('user.Compare')}}">
    <meta name="title" content="{{__('user.Compare')}}">
@endsection

@section('frontend-content')


   <!-- Breadcrumbs -->
   <section class="breadcrumbs__content" style="background-image: url({{ asset($breadcrumb) }});">
        <!-- <div class="homec-overlay"></div> -->
        <div class="container">
            <div class="row">
                <!-- Breadcrumb-Content -->
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <ul class="breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{__('user.Home')}}</a></li>
                            <li class="active"><a href="{{ route('user.compare') }}">{{__('user.Compare')}}</a></li>
                        </ul>
                        <h2 class="breadcrumb__title m-0">{{__('user.Compare')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumbs -->

    @if(count($properties) > 0)
    <section class="compare-tabel">
        <div class="container">
            <div class="row">
                            <div class="col-lg-3 col-md-4 col-12 mg-top-30">
                                @include('user.sidebar')
                            </div>
                            <div class="col-lg-9 col-md-8 col-12 mg-top-30">
                    <div class="tabel-main">
                        <table class="homec-invoice-table">
                            <thead class="homec-invoice-table__head homec-invoice-table__head-two ">
                                <tr>
                                    <th class="homec-invoice-table__column1">
                                        <button class="option-btn">
                                            <span>{{count($properties)}}</span> Option
                                        </button>
                                    </th>
                                    @foreach($properties as $index => $property)
                                    <th class="homec-invoice-table__column2">
                                        <div class="compare-item">
                                            <div class="compare-img">
                                                <img src="{{ ($property->thumbnail_image)? asset($property->thumbnail_image) : asset($setting->default_placeholder)}}"  alt="img">

                                                    <div class="icon">
                                                        <a href="javascript:;" onclick="deleteCompare({{ $property->id }})">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </a>
                                                        <form class="d-none" action="{{ route('user.remove-compare',   $property->id) }}" method="POST" id="remove_compare-{{ $property->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>


                                            </div>

                                            <div class="compare-text">
                                                <a href="{{ route('property', $property->slug) }}">{{ html_decode($property->title) }}</a>
                                            </div>
                                        </div>
                                    </th>
                                    @endforeach
                                </tr>
                            </thead>


                            <thead class="homec-invoice-table__head">

                                <tr>
                                    <th class="homec-invoice-table__column1">{{__('user.Price')}}</th>
                                    @foreach($properties as $index => $property)
                                    <th class="homec-invoice-table__column2">{{ html_decode(num_format($property->price)) }} </th>
                                    @endforeach
                                </tr>

                            </thead>
                            <tbody class="homec-invoice-table__body">
                                <tr class="tabel-color">
                                    <td class="homec-invoice-table__column1">
                                        <p class="homec-invoice-table__text homec-invoice-table__text-two">{{__('user.Total Unit')}}
                                        </p>
                                    </td>
                                    @foreach($properties as $index => $property)
                                    <td class="homec-invoice-table__column2">
                                        <p class="homec-invoice-table__text">{{ $property->total_unit }}</p>
                                    </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="homec-invoice-table__column1">
                                        <p class="homec-invoice-table__text homec-invoice-table__text-two">{{__('user.Bedroom')}}
                                        </p>
                                    </td>
                                    @foreach($properties as $index => $property)
                                    <td class="homec-invoice-table__column2">
                                        <p class="homec-invoice-table__text">{{ $property->total_bedroom }}</p>
                                    </td>
                                    @endforeach
                                </tr>
                                <tr class="tabel-color">
                                    <td class="homec-invoice-table__column1">
                                        <p class="homec-invoice-table__text homec-invoice-table__text-two">{{__('user.BathRooms')}}
                                        </p>
                                    </td>
                                    @foreach($properties as $index => $property)
                                    <td class="homec-invoice-table__column2">
                                        <p class="homec-invoice-table__text">{{ $property->total_bathroom }}</p>
                                    </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="homec-invoice-table__column1">
                                        <p class="homec-invoice-table__text homec-invoice-table__text-two">{{__('user.Garage')}}
                                        </p>
                                    </td>
                                    @foreach($properties as $index => $property)
                                    <td class="homec-invoice-table__column2">
                                        <p class="homec-invoice-table__text">{{ $property->total_garage }}</p>
                                    </td>
                                    @endforeach
                                </tr>

                                <tr class="tabel-color">
                                    <td class="homec-invoice-table__column1">
                                        <p class="homec-invoice-table__text homec-invoice-table__text-two">{{__('user.Area(m2)')}}
                                        </p>
                                    </td>
                                    @foreach($properties as $index => $property)
                                    <td class="homec-invoice-table__column2">
                                        <p class="homec-invoice-table__text">{{ $property->total_area }}</p>
                                    </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="homec-invoice-table__column1">
                                        <p class="homec-invoice-table__text homec-invoice-table__text-two">{{__('user.Kitchens')}}
                                        </p>
                                    </td>
                                    @foreach($properties as $index => $property)
                                    <td class="homec-invoice-table__column2">
                                        <p class="homec-invoice-table__text">{{ $property->total_kitchen }}</p>
                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

<script>

"use strict";

    function deleteCompare(id){
        console.log(id);
        Swal.fire({
            title: "{{__('user.Are you realy want to delete this item ?')}}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{__('user.Yes, Delete It')}}",
            cancelButtonText: "{{__('user.Cancel')}}",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#remove_compare-"+id).submit();
            }

        })
    }
</script>

@endsection
