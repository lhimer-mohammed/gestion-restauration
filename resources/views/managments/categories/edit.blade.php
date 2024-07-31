@extends('layouts.app')
@section("content")

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
                            <h3 class="text-secondary border-bottom mb-3 p-2">
                                <i class="fas fa-plus"></i> Modifiér La Catégorie: {{$category->title}}
                            </h3>
                             <form action="{{route('categories.update' , $category->slug)}}" method="post">
                             @csrf
                             @method("put")
                                <div class="form-group">
                                    <input
                                    type="text" name="title" id="title"
                                    class="form-control" value="{{$category->title}}"
                                    placeholder="Titre" >
                                </div> <br>
                                <div class="form group">
                                    <button class="btn btn-primary">
                                       Valide
                                    </button>
                                </div>
                             </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
