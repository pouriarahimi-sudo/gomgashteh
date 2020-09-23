@extends('admin.layouts.master')

@section('admin-title'){{'مدیریت کاربران'}}@endsection

@section('admin-content')
    @if (Session::has('success'))
        <div class=" mt-12 alert alert-success">{{ Session::get('success') }}</div>
    @endif

    @if(count($errors))
        <div class="alert alert-danger"style="direction: rtl;">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
    @endif

    <form action="{{route('update-personnel')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$admin->id}}">
        <input type="text" name="first_name" value="{{$admin->first_name}}">
        <input type="text" name="last_name" value="{{$admin->last_name}}">
        <input type="text" name="national_code" value="{{$admin->national_code}}">
        <input type="text" name="phone_num" value="{{$admin->phone_num}}">

            <div class="row">
                <div>
                    <label for="inputEmail4" class="ul-form__label text-right"><h4>نوع کاربر را مشخص کنید:</h4></label>
                </div>
                <div >
                    <label style="display: inline">
                        <input  type="radio" name="access_type" value="1" @if($admin->access_type=='1'){{'checked'}}@endif>
                        <span ><h5>مدیر</h5></span>
                        <span ></span>
                    </label>
                    <label style="display: inline">
                        <input  type="radio" name="access_type" value="2"@if($admin->access_type=='2'){{'checked'}}@endif>
                        <span ><h5>پشتیبان</h5></span>
                        <span></span>
                    </label>
                    <label style="display: inline">
                        <input type="radio" name="access_type" value="3"@if($admin->access_type=='3'){{'checked'}}@endif>
                        <span><h5>اپراتور</h5></span>
                        <span></span>
                    </label>
                </div>
            </div>
        <button type="submit" style="width: 50%" class="btn btn-primary m-1"> ثبت ویرایش </button>
    </form>
@endsection
