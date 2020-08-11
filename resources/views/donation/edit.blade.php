@extends('layouts.app')

@section('title', 'Edit Details')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Edit Details</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('donations.update', [$donate]) }}" method="POST">
                <input type="hidden" name="_method" value="PATCH">
                @include('donation.form')

                <button type="submit" class="btn btn-primary">Save Sms</button>
            </form>
        </div>
    </div>
</div>
@endsection