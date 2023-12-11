@extends('firstapp')
@section('title','Edit produit')
@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit product</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <div>
                                    <form method="POST" action="{{ route('produit.edit.post', $produit->id) }}">

                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" id="nom" value="{{@$produit->nom}}" placeholder="Nom produit" name="nom">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control form-control-user" id="prix" value="{{@$produit->prix}}" placeholder="prix" name="prix">
                                                @error('prix')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control form-control-user" id="quantite" value="{{@$produit->quantite}}" placeholder="quantité" name="quantite">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" id="image" value="{{@$produit->image}}" placeholder="L'url de limage de votre produit" name="image">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control form-control-user" id="description" placeholder="description" value="{{@$produit->description}}" name="description">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Edit
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
