@extends('layout')

@section('title', 'Početna')

@section('content')

<div class="py-5">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <h1 class="display-4 fw-bold mb-3">Dobrodošli u ASK Delta Travnik</h1>
            <p class="lead text-muted mb-4">
                Sistem za članove kluba sa prijavom i evidencijom članova.
                Javnim posjetiocima dostupna je galerija kluba.
            </p>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('gallery') }}" class="btn btn-dark btn-lg">Galerija</a>

                @auth
                    <a href="{{ route('members.index') }}" class="btn btn-primary btn-lg">Članovi</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Prijava</a>
                    <a href="{{ route('registration') }}" class="btn btn-success btn-lg">Registracija</a>
                @endauth
            </div>
        </div>

        <div class="col-lg-6 mt-4 mt-lg-0">
            <div class="card shadow border-0">
                <div class="card-body p-4">
                    <h3 class="mb-3">Pristup sistemu</h3>
                    <p class="text-muted mb-2">
                        <strong>Galerija</strong> je javno dostupna svim posjetiocima.
                    </p>
                    <p class="text-muted mb-0">
                        <strong>Članovi</strong> dostupni su samo prijavljenim članovima kluba.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-3">
    <div class="col-md-6">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <h4 class="card-title">Javna galerija</h4>
                <p class="card-text text-muted">
                    Posjetioci mogu pregledati fotografije aktivnosti, događaja i atmosfere u klubu.
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <h4 class="card-title">Evidencija članova</h4>
                <p class="card-text text-muted">
                    Samo prijavljeni članovi mogu pristupiti podacima o članstvu i upravljati evidencijom.
                </p>
            </div>
        </div>
    </div>
</div>

@endsection