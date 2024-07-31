@extends('layouts.app')
@section("content")
</div>
<div class="container">
    <form id="add-sale" action="{{route("sales.store")}}" method="post">
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <a href="/home" class="btn btn-outline-secondary">
                                {{-- <i class="fa fa-chevron-left"></i> --}}
                                {{-- <script src="https://cdn.lordicon.com/lordicon.js"></script>
                                <lord-icon
                                    src="https://cdn.lordicon.com/tfwhvbiq.json"
                                    trigger="hover"
                                    style="width:50px;height:50px">
                                </lord-icon> --}}
                                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                                <lord-icon
                                    src="https://cdn.lordicon.com/epietrpn.json"
                                    trigger="hover"
                                    style="width:30px;height:30px">
                                </lord-icon>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="my-2 col-md-3">
                       <h3 class="text-muted border-bottom">
                        {{Carbon\Carbon::now()}}
                       </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <a href="{{route("sales.index")}}" class="btn btn-outline-secondary float-right">
                               Toutes les ventes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($tables as $table)
                                <div class="col-md-3">
                                    <div class="card p-2 mb-2 d-flex flex-column justify-content-center align-items-center list-group-item-action">
                                        <div class="align-self-end">
                                            <input type="checkbox" name="table_id[]" id="table" value="{{$table->id}}">
                                        </div>
                                        <i class="fa fa-chair fa-5x"></i>
                                        <span class="mt-2 text-muted font-weight-bold">
                                            {{$table->name}}
                                        </span>
                                        <div class=" d-flex flex-column justify-content-between align-items-center">
                                            <a href="{{ route('tables.edit', ['table' => $table->slug]) }}" class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                        </div>
                                        <hr>
                                        @foreach ($table->sales as $sale)
                                            @if ($sale->created_at >= Carbon\Carbon::today())
                                                <div style="border : dashed pink" class="mb-2 mt-2 shadow w-100" id="{{$sale->id}}">
                                                    <div class="card">
                                                        <div class="card-body  d-flex flex-column justify-content-center align-items-center">
                                                            @foreach ($sale->menus()->where("sales_id",$sale->id)->get() as $menu)
                                                            <h5 class="font-weight-bold mt-2">
                                                                {{$menu->title}}
                                                            </h5>
                                                            <span class="text-muted">
                                                                {{$menu->price}} DH
                                                            </span>
                                                 @endforeach
                                                            <h5 class="font-weight-bold mt-2">
                                                                <span class="badge badge-danger">
                                                                   Sérveur :  {{$sale->servant->name}}
                                                                </span>
                                                            </h5>
                                                            <h5 class="font-weight-bold mt-2">
                                                                <span class="badge badge-dark">
                                                                   Qté :  {{$sale->quantity}}
                                                                </span>
                                                            </h5>
                                                            <h5 class="font-weight-bold mt-2">
                                                                <span class="badge badge-dark">
                                                                   Prix :  {{$sale->total_price}} DH
                                                                </span>
                                                            </h5>
                                                            <h5 class="font-weight-bold mt-2">
                                                                <span class="badge badge-dark">
                                                                   Total :  {{$sale->total_received}} DH
                                                                </span>
                                                            </h5>
                                                            <h5 class="font-weight-bold mt-2">
                                                                <span class="badge badge-dark">
                                                                   Reste :  {{$sale->change}} DH
                                                                </span>
                                                            </h5>
                                                            <h5 class="font-weight-bold mt-2">
                                                                <span class="badge badge-dark">
                                                                   Type de paiement :  {{$sale->payment_type === "cash" ? "Espéce" : "Caerte bancaire"}}
                                                                </span>
                                                            </h5>
                                                            <h5 class="font-weight-bold mt-2">
                                                                <span class="badge badge-dark">
                                                                    Etat de paiement :  {{$sale->payment_status === "paid" ? "Payé" : " Impayé"}}
                                                                </span>
                                                            </h5>
                                                            <hr>
                                                            <div class="  d-flex flex-column justify-content-center align-items-center">
                                                                <span class="font-weight-bold">
                                                                    Restaurant Messri
                                                                </span>
                                                                <span>
                                                                    Sidi_Boujida Fes
                                                                </span>
                                                                <span>
                                                                    0650138690
                                                                </span>
                                                            </div>
                                                    </div>
                                                    </div>

                                                </div>
                                                <div class="mt-2 d-flex justify-content-center" onclick="print({{ $sale->id }}); return false;">

                                                    <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-sm btn-warning mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" target="_blank" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-print"></i>
                                                    </a>

                                                </div>
                                                
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-md-12 card p-3">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    @foreach ($categories as $category)
                    <li class="nav-item">

                        <a href="#{{ $category->slug }}" class="nav-link mr-1 "
                           id="{{$category->slug}}-tab"
                           data-toggle="pill"
                           role="tab"
                           aria-controls="{{ $category->slug }}"
                           aria-selected="true" >
                            {{$category->title}}
                        </a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="pills-tabcontent">
                    @foreach ($categories as $category)
                        <div class="tab-pane fade"

                            id="{{ $category->slug }}"
                            role="tabpanel"
                            aria-labelledby="pills-home-tab"
                            >
                            <div class="row">
                                @foreach ($category->menus as $menu)
                                    <div class="col-md-4 mb-2">
                                        <div class="card h-100">
                                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                                <div class="align-self-end">
                                                    <input type="checkbox" name="menu_id[]" id="menu_id" value="{{ $menu->id }}">

                                                </div>
                                                <img src="{{asset("images/menus/".$menu->image)}}" alt="{{$menu->title}}" class="img-fluid rounded-circle" width="100" height="100">
                                                <h5 class="font-weight-bold mt-2">
                                                    {{$menu->title}}
                                                </h5>
                                                <h5 class="text-muted">
                                                    {{$menu->price}} DH
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="form group">
                            <select name="servant_id"  class="form-control">
                                <option value="" selected disabled>
                                    Sérveur
                                </option>
                                @foreach ($servants as $servant)
                                    <option value="{{$servant->id}}">
                                        {{ $servant->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div> <br>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Qté</span>
                            </div>
                            <input type="number" name="quantity"  class="form-control" placeholder="Qté">

                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="total_price"  class="form-control" placeholder="Prix">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>

                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="total_received"  class="form-control" placeholder="Total">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="change"  class="form-control" placeholder="Reste">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        <div class="form group mb-3">
                        <select name="payment_type"   class="form-control">
                            <option value="" selected disabled>
                                Type de paiement
                            </option>

                                <option value="cash">
                                    Espéce
                                </option>
                                <option value="card">
                                    Carte bancaire
                                </option>

                        </select>
                    </div>
                    <div class="form group mb-3">
                         <select name="payment_status"   class="form-control">
                         <option value="" selected disabled>
                             Etat de paiement
                         </option>

                           <option value="paid">
                              Payé
                              </option>
                             <option value="unpaid">
                                Impayé
                                </option>
                               </select>
                            </div>
                            <div class="form-group">
                        <button onclick="event.preventDefault(); document.getElementById('add-sale').submit();" class="btn btn-primary">
                            Valider
                        </button>
                    </div>
                 </div>



                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section("javascript")
<script>
    function print(el){
        const page = document.body.innerHTML;
        const content = document.getElementById(el).innerHTML;
        document.body.innerHTML = content ;
        window.print();
        document.body.innerHTML = page;
    }
</script>

@endsection

