@extends('layouts.app')

@section('title', 'Listado')

@section('content')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-3">
        <div>
            <p class="text-primary fw-semibold mb-1">ADMINISTRACIÓN</p>
            <h1 class="h3 mb-0">Listado de productos</h1>
        </div>
        <a href="{{ route('productos.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Nuevo producto
        </a>
    </div>

    <form method="GET" action="{{ route('productos.index') }}" class="card card-body shadow-sm mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-12 col-md-5">
                <label for="buscar" class="form-label">Buscar por nombre</label>
                <input type="search" id="buscar" name="buscar" value="{{ $buscar }}" class="form-control" placeholder="Ej. Mouse">
            </div>
            <div class="col-12 col-md-4">
                <label for="categoria" class="form-label">Categoría</label>
                <select id="categoria" name="categoria" class="form-select">
                    <option value="">Todas las categorías</option>
                    @foreach ($categorias as $cat)
                        <option value="{{ $cat }}" @selected($cat === $categoria)>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-3 d-flex gap-2">
                <button class="btn btn-primary flex-grow-1"><i class="bi bi-search"></i> Filtrar</button>
                <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">Limpiar</a>
            </div>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Categoría</th>
                        <th scope="col" class="text-end">Precio</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productos as $p)
                        <tr>
                            <td>{{ $p['id'] }}</td>
                            <td class="fw-semibold">{{ $p['nombre'] }}</td>
                            <td><span class="badge text-bg-secondary">{{ $p['categoria'] }}</span></td>
                            <td class="text-end">${{ number_format((float) $p['precio'], 2) }}</td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('productos.edit', $p['id']) }}" class="btn btn-sm btn-outline-primary" aria-label="Editar {{ $p['nombre'] }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" aria-label="Eliminar {{ $p['nombre'] }}"
                                    data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                    data-id="{{ $p['id'] }}" data-nombre="{{ $p['nombre'] }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Sin resultados</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="formEliminar" method="POST" class="modal-content">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h2 class="modal-title fs-5">Confirmar eliminación</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">¿Seguro que deseas eliminar <strong id="nombreEliminar"></strong>?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('modalEliminar').addEventListener('show.bs.modal', (event) => {
            const boton = event.relatedTarget;
            document.getElementById('nombreEliminar').textContent = boton.dataset.nombre;
            document.getElementById('formEliminar').action = `{{ url('productos') }}/${boton.dataset.id}`;
        });
    </script>
@endsection
