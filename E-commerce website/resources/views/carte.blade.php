@extends('layouts.store')
@section('title','Carte')
@section('breadscrumb')
<a class="navbar-brand" href="{{asset('storehomepage')}}">Home Page</a>
@endsection
@section('content')
<div class="container px-4 px-lg-5 mt-5">
  <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-12">

      <div class="card card-registration card-registration-2" style="border-radius: 15px;">
        <div class="card-body p-0">
          <div class="row g-0">
            <div class="col-lg-8">
              <div class="p-5">
                <div class="d-flex justify-content-between align-items-center mb-5">
                  <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                  <h6 class="mb-0 text-muted"></h6>
                </div>
                @foreach ($cartItems as $productId => $item)
                <div class="row mb-4 d-flex justify-content-between align-items-center" id="produit_{{$productId}}">
                  <div class="col-md-2 col-lg-2 col-xl-2">
                    <img src="{{ $item['image'] }}" class="img-fluid rounded-3" alt="..">
                  </div>
                  <div class="col-md-3 col-lg-3 col-xl-3">
                    <h6 class="text-muted">{{ $item['nom'] }}</h6>
                    <h6 class="text-black mb-0">{{ $item['description'] }}</h6>
                  </div>
                  <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                    <input id="form1" min="0" name="quantity" data-id="{{$productId}}" value="{{ $item['quantite'] }}" type="number" class="qte form-control form-control-sm" />
                  </div>
                  <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                    <h6 class="mb-0"> {{ $item['prix'] }} Dinar</h6>
                  </div>
                  <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                    <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
                  </div>
                </div>
                <hr class="my-4">
                @endforeach
                <div class="pt-5">
                  <h6 class="mb-0"><a href="{{asset('storehomepage')}}" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                </div>
              </div>
            </div>
            <div class="col-lg-4 bg-grey">
              <div class="p-5">
                <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                <hr class="my-4">

                <div class="d-flex justify-content-between mb-4">
                  <h5 class="text-uppercase" id='quantity'></h5>
                  <h5 id="total_price" class="ol">{{ $totalprice }} Dt</h5>
                </div>

                <h5 class="text-uppercase mb-3">Shipping</h5>

                <div class="mb-4 pb-2">
                  <select class="select">
                    <option value="1">Standard-Delivery- €5.00</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                    <option value="4">Four</option>
                  </select>
                </div>

                <h5 class="text-uppercase mb-3">Give code</h5>

                <div class="mb-5">
                  <div class="form-outline">
                    <input type="text" id="form3Examplea2" class="form-control form-control-lg" />
                    <label class="form-label" for="form3Examplea2">Enter your code</label>
                  </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between mb-5">
                  <h5 class="text-uppercase" >Total price</h5>
                  <h5 id='totalP' class='ol'>{{ $totalprice }} Dt
                    </h5>
                </div>

                <button type="button" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Commander</button>

              </div>
            </div>
          </div>
        </div>
      </div>





    </div>
  </div>
</div>
@endsection
@section('script')
<script>
  $(document).ready(function(){
    console.log('readyyy')
      $(".qte").on('change', function() {
      console.log('input change')
      console.log($(this).val())
      console.log($(this).data('id'))
      var value = $(this).val();
      var self = this;
      //location.href = "/AddCart/"+$(this).data('id');
      $.ajax({
        url: "/Add/" + $(this).data('id')+'/'+$(this).val(),
        type: 'GET',
        success: function(result){
          console.log(result);
          var price =result.totalprice;
          var quantity = result.totalquantity; 
          console.log('price => '+price);
          console.log('quantity => '+quantity);
          $('#quantity').text(' ITEMS ' + quantity);
          $(".ol").text('Dt '+price);
          if($(self).val() == 0 ){
            //$("#produit_"+$(self).data('id')).remove();
            $(self).parent().parent().remove()
          }
        },
        error: function(error){
          console.log(error)
        }
      });
    })
    //$("input[name=quantite]")
  })



</script>
@endsection 


