@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit stock</div>

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
                       

                        <form action="{{ route('stocks.update', $stock) }}" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Product *</label>
                                <select name="product_id" class="form-select" readonly>
                                    <option selected value="{{ old('id', $product['id']) }}">{{ $product['name'] }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Quantity*</label>
                                <input type="number" name="quantity" class="form-control" required
                                    value="{{ old('quantity', $stock->quantity) }}">
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
