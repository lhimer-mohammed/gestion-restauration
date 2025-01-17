
@extends('layouts.app')
@section("content")
<link rel="stylesheet" href="{{url('style/min.css')}}">;


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
                            <i class="fa-solid fa-chair fa-bounce"></i> Tables
                            </h3>
                            <a href="{{route('tables.create')}}" class="btn btn-primary ml-auto animated-icon">
                            <i class="fa-solid fa-user-plus fa-bounce"></i>
                            </a>
                            </div>
                            <table class="table table-hover table-responsive-sm mb-6">
                                <thead>
                                
                                    <tr>
                                        <th>Id</th>
                                        <th>Nom</th>
                                        <th>Disponible</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($tables as $table)
                                <tr>
                                    <td>{{$table->id}}</td>
                                    <td>{{$table->name}}</td>
                                    <td>
                                        @if($table->status)
                                        <span class="badge badge-success">Oui</span>
                                         @else 
                                         <span class="badge badge-danger">Non</span>
                                         @endif
                                    </td>
                                    <td class="d-flex flex-row justify-content-center align-items-center">
                                    <a href="{{route('tables.edit', $table->slug)}}" class="ml-1 btn btn-warning animated-icon ">
                                         <i class="fas fa-edit "></i>
                                    </a>
                                    <form class="table" id="{{$table->id}}"  action="{{route('tables.destroy', $table->slug)}}" method="post">
                                        @csrf 
                                        @method("DELETE")
                                        <button 
                                        onclick="
                                        event.preventDefault();
                                        if(confirm('Voulrz vous supprimer la table {{$table->name}}?'))
                                        document.getElementById({{$table->id}}).submit()
                                        "
                                        class="btn btn-danger animated-icon">
                                            <i class="fas fa-trash ">
                                            </i>
                                        </button>
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                            <div class="my-3 d-flex justify-content-center align-items-center">
                                {{$tables->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

