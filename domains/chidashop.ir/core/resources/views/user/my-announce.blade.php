@extends('user.layouts.master')

@section('user-title'){{'آگهی های من'}}@endsection

@section('user-content')

    <!-- Titlebar
================================================== -->
    <div id="titlebar" class="gradient">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>آگهی های من</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{route('index')}}">صفحه اصلی</a></li>
                            <li>آگهی های من</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Content
================================================== -->
    <div class="container padding-bottom-60">
        <div class="row">
            <div class="col-lg-12 col-md-12">

            @if(count($announce))
                @foreach($announce as $item)

                    <div class="listing-item-container list-layout">
                        <a href="" onclick="event.preventDefault(); document.getElementById('edit-my-announce_{{$item->id}}').submit()" class="listing-item">

                            <!-- Image -->
                            <div class="listing-item-image">
                                <img src="images/listing-item-01.jpg" alt="announce">
                            </div>

                            <!-- Content -->
                            <div class="listing-item-content">
                                @if($item->type == 2)
                                    <div class="listing-badge now-open">{{'پیدا شده'}}</div>
                                @elseif($item->type == 1)
                                    <div class="listing-badge now-closed">{{'گم شده'}}</div>
                                @endif
                                <div class="listing-item-inner">
                                    <h3>{{$item->title}}
                                        @if($item->status == 1)
                                            <mark style="color: green">تایید شده</mark>
                                        @elseif($item->status == 2)
                                            <mark style="color: red">رد شده</mark>
                                        @elseif($item->status == 0)
                                            <mark style="color: greenyellow">در حال بررسی</mark>
                                        @endif
                                    </h3>
                                    <span>{{$item->province->name.' - '.$item->city->name}}</span>
                                    <div class="star-rating" data-rating="3.5">
                                        <div class="rating-counter">(12 نظر) </div>
                                    </div>
                                </div>
                                <span class="like-icon"></span>

                            </div>
                        </a>

                        <form id="edit-my-announce_{{$item->id}}" action="{{route('edit-my-announce')}}" method="get" style="display: none">
                            <input type="hidden" name="announce_id" value="{{$item->id}}">
                        </form>

                    </div>


            @endforeach
            @else
                    <div class="notification error closeable">
                            <p>شما هیچ آگهی ثبت نکرده اید</p>
                    </div>
            @endif

            </div>
        </div>
    </div>

@endsection
