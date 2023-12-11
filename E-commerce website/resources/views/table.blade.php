@extends('firstapp')
@section('title','Liste des Produits')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Liste des Produits</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>nom</th>
                        <th>prix</th>
                        <th>quantite</th>
                        <th>image</th>
                        <th>description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produits as $item)
                    <tr>
                        <td>{{$item->nom}}</td>
                        <td>{{$item->prix}}</td>
                        <td>{{$item->quantite}}</td>
                        <td>{{$item->image}}</td>
                        <td>{{$item->description}}</td>
                        <td>
                            <a href="{{route('produit.edit', $item->id)}}" class="btn btn-info btn-circle btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)" onClick="deleteProduit('{{$item->id}}')" class="btn btn-danger btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <a href="ajouterproduit" class="btn btn-facebook btn-user btn-block">
                    ajouter produit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    function deleteProduit(id) {
    if (confirm("Do you really want to delete your profile?")) {
        location.href = '/produit/delete/'+id;
    }
}
</script>
@endsection










