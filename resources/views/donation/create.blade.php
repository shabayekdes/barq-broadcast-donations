@extends('layouts.app')

@section('title', 'Add New Donation')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Add New Donation</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('donations.store') }}" method="POST">
                @include('donation.form')

                <button type="submit" class="btn btn-primary">Add Donation</button>
            </form>
        </div>
    </div>
</div>
@endsection