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
                                <i class="fas fa-plus"></i> Mofifier le menu {{$menu->title}}
                            </h3>
                            <form action="{{route('menus.update',$menu->slug)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <input type="text" name="title" id="title" class="form-control" value="{{$menu->title}}" placeholder="Titre"><br>
                                </div>
                                <div class="form-group">
                                    <textarea name="description" id="Description" rows="5" cols="30" class="form-control" placeholder="Description">{{$menu->description}}</textarea><br>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" name="price"  class="form-control" placeholder="Prix" value="{{$menu->price}}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="my-2">
                                    <img src="{{asset('images/menus/'.$menu->image)}}" alt="{{$menu->title}}" width="200" height="200" class="img-fluid" >
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Image</span>
                                    </div>
                                    <input type="file" name="image"  class="form-control" placeholder="Prix">
                                    <div class="input-group-append">
                                        <span class="input-group-text">2mg max</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select name="category_id" class="form-control">
                                        <option value=""selected disabled>Choisir une catégorie</option>
                                        @foreach ($categories as $category )
                                            <option {{$category->id === $menu->category->id ? "selected" : ""}}
                                             value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Image</span>
                                    </div>
                                    <div class="custom-file">
                                        <label class="input-group-text input-group-append">2mg max</label>
                                        <input type="file" name="image" class="custom-file-label ">
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <button class="btn btn-primary">Valide</button>
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
