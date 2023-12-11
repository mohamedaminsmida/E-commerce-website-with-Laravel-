@extends('layouts.store')
@section('title','Detail Produit')
@section('breadscrumb')
<a class="navbar-brand" href="{{asset('storehomepage')}}">Back Home Page</a>
@endsection
@section('content')
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{$produit->image}}" alt="..." /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">SKU: BST-498</div>
                        <h1 class="display-5 fw-bolder">{{$produit->nom}}</h1>
                        <div class="fs-5 mb-5">
                            <span>{{$produit->prix}} Dinar</span>
                        </div>
                        <p class="lead">{{$produit->description}}</p>
                        <div class="d-flex">                            
                            <a class="btn btn-outline-dark mt-auto" href="{{route('AddCart',$produit->id)}}">Add to cart</a>
                        </div>
                    </div>
                </div>
        <!-- Related items section-->
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Related products</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach($allproduit as $prod)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{$prod->image}}" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4"> 
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{$prod->nom}}</h5>
                                    <!-- Product price-->
                                    {{$prod->prix}} Dinar
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('detail',$prod->id)}}">View Details</a></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                <div>
            </div>
        </section>
@endsection