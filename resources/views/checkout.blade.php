@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Checkout</h2></div>

                <div class="card-body">
                   <div>
                       <checkout default_stripe_public_key={{env('STRIPE_KEY')}}></checkout>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
