@extends('layouts.app')
@section("content")
<link rel="stylesheet" href="{{url('style/min.css')}}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex flex-row justify-content-between align-items-center border-bottom pb-1">
                                <h3 class="text-secondary">
                                    <i class="fas fa-bars"></i> Reports
                                </h3>
                                <a href="{{route('home')}}" class="btn btn-outline-secondary ml-auto">
                                    <i class=" fas fa-chevron-left fa-x2"></i>
                                </a>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3 shadow mx-auto p-2">
                                            <form action="{{route("reports.generate")}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="date" name="from"  placeholder="Date Début" class="form-control">
                                            </div>
                                                <div class="form-group">
                                                <input type="date" name="to" placeholder="Date Fin" class="form-control">
                                            </div>
                                                <div class=" form-group">
                                                    <button class="btn btn-primary">
                                                        Afficher le Rapport
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h3 class="text-secondary my-2 font-weight-bold">
                                Rapport de {{ $startDate }} à {{ $endDate }}
                            </h3 >
                            <table class="table table-hover table-responsive-sm mb-6">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Menus</th>
                                        <th>Table</th>
                                        <th>Sérveur</th>
                                        <th>Quantité</th>
                                        <th>Total</th>
                                        <th>Type de paiement</th>
                                        <th>Etat de paiement</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
