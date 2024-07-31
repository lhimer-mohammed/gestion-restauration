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
                            <i class="fa-solid fa-table-list fa-bounce"></i> Catégories
                            </h3>
                            <a href="{{route('categories.create')}}" class="btn btn-primary ml-auto animated-icon">
                            <i class="fa-solid fa-user-plus fa-bounce"></i>
                            </a>
                            </div>
                            <table class="table table-hover table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Titre</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->title}}</td>
                                    <td class="d-flex flex-row justify-content-center align-items-center">
                                    <a href="{{route('categories.edit', $category->slug)}}" class=" btn btn-warning mb-2 animated-icon ">
                                         <i class="fas fa-edit "></i>
                                    </a> &nbsp;
                                    <form  id="{{$category->id}}"  action="{{route('categories.destroy', $category->slug)}}" method="post" class="table">
                                        @csrf
                                        @method("DELETE")
                                        <button
                                        onclick="
                                        event.preventDefault();
                                        if(confirm('Voulrz vous supprimer la catégorie {{$category->title}}?'))
                                        document.getElementById({{$category->id}}).submit()
                                        "
                                        class="btn btn-danger mt-2 mr-3 animated-icon">
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
                                {{$categories->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
