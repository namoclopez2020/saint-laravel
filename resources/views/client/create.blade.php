@extends('layouts.layout')

@section('title','Agregar Cliente')
    
@section('content')
    
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-md-7 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header"><text class="h3">Agregar cliente</text></div>
                <div class="card-body">
                <form action="{{ route('client.store') }}" method="post">
                    @include('client._form',['btnText' => 'Guardar'])
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function elegir_documento() {
        var doc=$('#tipo_doc').find(":selected").val();
       if(doc == 4){
           $('#numero_doc').hide();
       }else{
           $('#numero_doc').show();
       }
    }
    </script>
@endsection