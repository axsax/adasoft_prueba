@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Products <a href="{{ route('products.create') }}"
                            class="btn btn-sm btn-primary float-right">Create</a> </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors)
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger" role="alert">
                                        <li>{{ $error }}</li>
                                    </div>
                                @endforeach
                            </ul>
                        @endif
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Minimum Amount</th>
                                    <th colspan="3">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->minimum_amount }}</td>
                                        <td><a href="{{ route('products.show', $product) }}"
                                                class="btn btn-info btn-sm">Watch</a></td>
                                        <td>
                                        <td><a href="{{ route('products.edit', $product) }}"
                                                class="btn btn-primary btn-sm">Editar</a></td>
                                        <td>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input type="submit" value="Eliminar" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Esta seguroo de eliminar?')">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
