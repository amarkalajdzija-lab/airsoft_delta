@extends('layout')

@section('title', 'Galerija')

@section('content')

@use('Illuminate\Support\Facades\Storage')

<div class="container py-5">

    <!-- NASLOV -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">Galerija kluba</h1>
    </div>

    <!-- PORUKE -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- UPLOAD DUGME -->
    @auth
    <div class="text-end mb-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
            + Dodaj sliku
        </button>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="uploadModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Dodaj sliku</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Naziv</label>
                            <input type="text" name="title" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Slika</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                        <button class="btn btn-success">Upload</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @endauth

    <!-- GALERIJA -->
    <div class="row g-4">
    @forelse($images as $item)
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <a href="{{ Storage::url($item->image) }}" class="glightbox" data-gallery="gallery1">
    <img 
        src="{{ Storage::url($item->image) }}" 
        class="card-img-top"
        style="height:250px; object-fit:cover;"
    >
</a>

                <div class="card-body">
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <p class="text-muted">Fotografija iz aktivnosti kluba</p>
                    @auth
<form action="{{ route('gallery.destroy', $item->id) }}" method="POST"
    onsubmit="return confirm('Obrisati sliku?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-sm mt-2">Obriši</button>
</form>
@endauth
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                Nema slika u galeriji.
            </div>
        </div>
    @endforelse
</div>

<script>
    const lightbox = GLightbox({
        selector: '.glightbox'
    });
</script>

@endsection