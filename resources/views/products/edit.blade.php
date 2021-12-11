@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit product</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(($errors))
                             <ul>
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    <li>{{ $error }}</li>
                                </div>
                            @endforeach
                            </ul>
                        @endif

                        <form action="{{ route('products.update', $product) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Name *</label>
                                <input type="text" name="name" class="form-control" required
                                    value="{{ old('name', $product->name) }}">
                            </div>
                            <div class="form-group">
                                <label>Description *</label>
                                <textarea name="description" class="form-control" required>

                                                                        {{ old('description', $product->description) }}
                                                                    </textarea>
                            </div>
                            <div class="form-group">
                                <label>Price *</label>
                                <input type="number" name="price" class="form-control" required
                                    value="{{ old('price', $product->price) }}">
                            </div>
                            <div class="form-group">
                                <label>Minimum amount *</label>
                                <input type="number" name="minimum_amount" class="form-control" required
                                    value="{{ old('minimum_amount', $product->minimum_amount) }}">
                            </div>

                            <div class="form-group">
                                <label>Image*</label>
                                <input type="file" name="file">
                            </div>
                            <div class="form-group">
                                @csrf
                                @method('put')
                                <input type="submit" value="Update" class="btn btn-sm btn-primary">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
