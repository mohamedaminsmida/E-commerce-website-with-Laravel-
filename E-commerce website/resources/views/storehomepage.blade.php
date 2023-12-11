@extends('layouts.store')
@section('title','Store home page ')
@section('breadscrumb')
@section('content')
<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
    @foreach($produits as $produit)
    <div class="col mb-5">
        <div class="card h-100">
            <!-- Sale badge-->
            @if($produit->quantite == 0)
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Rupture de Stock</div>
            @endif
            <!-- Product image-->
            <img class="card-img-top" src="{{ $produit->image }}" alt="..." />
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder">{{$produit->nom}}</h5>
                    <!-- Product price-->
                    <span class="text-muted text-decoration-line-through"></span>
                   {{$produit->prix}} Dinar
                </div>
            </div>
            <!-- Product actions-->
            <form>
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('AddCart',$produit->id)}}">Add to cart</a></div>
            </div>
            </form>
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center"><a class="btn btn-outline-dark mt-auto"  href="{{route('detail',$produit->id)}}">More Details</a></div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection