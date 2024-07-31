@extends('layouts.app')
@section("content")
<style>
.animated-icon {
    transition: transform 0.3s ease;
}

.animated-icon:hover {
    transform: scale(1.2); /* توسيع الرمز */
}

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                        @include('layouts.sidebar')
                        </div>
                        <div class="col-md-8">
                        <div class="d-flex flex-row justify-content-between align-items-center border-bottom pb-1">
                            <h3 class="text-secondary">
                            <i class="fa-solid fa-user-gear fa-bounce"></i> Sérveurs
                            </h3>
                            <a href="{{route('servants.create')}}" class="btn btn-primary ml-auto animated-icon">
                            <i class="fa-solid fa-user-plus fa-bounce"></i>
                            </a>
                            </div>
                            <table class="table table-hover table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nom & Prénom</th>
                                        <th>Adresse</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($servants as $servant)
                                <tr>
                                    <td>{{$servant->id}}</td>
                                    <td>{{$servant->name}}</td>
                                    <td>
                                        @if ($servant->adress)
                                        {{$servant->adress}}
                                        @else
                                         <span class="text-danger">
                                            Non Disponible
                                         </span>
                                        @endif
                                    </td>
                                    <td class="d-flex flex-row justify-content-center align-items-center">
                                    <a href="{{route('servants.edit', $servant->id)}}" class=" btn btn-warning animated-icon ">
                                         <i class="fas fa-edit "></i> 
                                    </a> &nbsp;
                                    <form  id="{{$servant->id}}"  action="{{route('servants.destroy', $servant->id)}}" method="post" class="table">
                                        @csrf 
                                        @method("DELETE")
                                        <button 
                                        onclick="
                                        event.preventDefault();
                                        if(confirm('Voulez vous supprimer la serveur {{$servant->name}} ?'))
                                        document.getElementById({{$servant->id}}).submit()
                                        "
                                        class="btn btn-danger animated-icon">
                                            <i class="fas fa-trash ">
                                            </i>
                                        </button> 
                                    </form>&nbsp;
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                            <div class="my-3 d-flex justify-content-center align-items-center">
                                {{$servants->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
