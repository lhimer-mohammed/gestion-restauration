
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
                             <i class="fa-solid fa-clipboard-list fa-bounce"></i>  Menus
                            </h3>
                            <a href="{{route('menus.create')}}" class="btn btn-primary ml-auto animated-icon">
                            <i class="fa-solid fa-user-plus fa-bounce"></i>
                            </a>
                            </div>
                            <table class="table table-hover table-responsive-sm mb-6">
                                <thead>

                                    <tr>
                                        <th>Id</th>
                                        <th>Titre</th>
                                        <th>Description</th>
                                        <th>Prix</th>
                                        <th>Catégorie</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($menus as $menu)
                                    <tr>
                                        <td>{{$menu->id}}</td>
                                        <td>{{$menu->title}}</td>
                                        <td>{{substr($menu->description,0,100)}}</td>
                                        <td>{{$menu->price}} DH</td>
                                        <td>
                                            @if($menu->category)
                                                {{$menu->category->title}}
                                            @else
                                                No Category
                                            @endif
                                        </td>
                                        <td>
                                            <img src="{{asset('images/menus/'.$menu->image)}}" alt="{{$menu->title}}" class="fluid" width="60" height="60">
                                        </td>

                                        <td class="d-flex flex-row justify-content-center align-items-center">
                                            <a href="{{route('menus.edit', $menu->slug)}}" class="ml-1 btn btn-warning animated-icon">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form class="table" id="{{$menu->id}}"  action="{{route('menus.destroy', $menu->slug)}}" method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button
                                                    onclick="
                                                    event.preventDefault();
                                                    if(confirm('Voulez-vous supprimer le menu {{$menu->title}}?'))
                                                        document.getElementById({{$menu->id}}).submit()
                                                    "
                                                    class="btn btn-danger animated-icon">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach

                            </tbody>
                            </table>
                            <div class="my-3 d-flex justify-content-center align-items-center">
                                {{$menus->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

