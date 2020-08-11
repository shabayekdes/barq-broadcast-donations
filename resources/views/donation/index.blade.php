@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <h4>{{$errors->first()}}</h4>
                </div>
            @endif
            <div class="card">
                <div class="card-header">List donates</div>

                <div class="card-body">

                    @foreach($donates as $donate)
                        <div class="row">
                            <div class="col-2">
                                {{ $donate->id }}
                            </div>
                            <div class="col-8">
                                {{ $donate->amount }}
                            </div>
                            <div class="col-2">
                                <a href="{{ route('donations.edit', [$donate]) }}" class="btn btn-primary">
                                    edit
                                </a>
                                <form action="{{ route('donations.destroy', [$donate]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">

                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    <a href="{{ route('donations.create') }}" class="btn btn-primary">Create Donation</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection