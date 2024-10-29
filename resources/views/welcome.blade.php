<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud con Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center p-3 bg-primary text-white">Crud de Productos</h1>
    @if (session("success"))
    <div class="alert alert-succes">{{session("success")}}</div>
    @endif
    @if (session("incorrecto"))
    <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif
    <!-- Modal -->
    <div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar productos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('crud.registro')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="productName" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Descripción</label>
                            <textarea class="form-control" id="productDescription" name="descripcion" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Precio</label>
                            <input type="number" step="0.01" class="form-control" id="productPrice" name="precio" required>
                        </div>
                        <div class="mb-3">
                            <label for="productCategory" class="form-label">Categoría</label>
                            <input type="text" class="form-control" id="productCategory" name="categoria">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="container my-4 p-5 bg-light rounded shadow">
        <button class="btn btn-primary btn-small" data-bs-toggle="modal" data-bs-target="#modalRegistro">Agregar producto</button>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Datos as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->descripcion }}</td>
                        <td>${{ number_format($item->precio, 2) }}</td>
                        <td>{{ $item->categoria }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->id }}">
                                <i class="bi bi-pencil-square"></i> <!-- Icono de actualización -->
                            </button>
                            <form action="{{ route('crud.eliminar', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                    <i class="bi bi-trash"></i> <!-- Icono de eliminación -->
                                </button>
                            </form>
                        </td>


                        <!-- Modal -->
                        <div class="modal fade" id="modalEditar{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar productos</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="editProductForm" action="{{ route('crud.modificar', $item->id) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="productName" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="productName" name="nombre" value="{{$item->nombre}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="productDescription" class="form-label">Descripción</label>
                                                <textarea class="form-control" id="productDescription" name="descripcion" rows="3">{{ $item->descripcion }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="productPrice" class="form-label">Precio</label>
                                                <input type="number" step="0.01" class="form-control" id="productPrice" value="{{$item->precio}}" name="precio" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="productCategory" class="form-label">Categoría</label>
                                                <input type="text" class="form-control" id="productCategory" value="{{$item->categoria}}" name="categoria">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>