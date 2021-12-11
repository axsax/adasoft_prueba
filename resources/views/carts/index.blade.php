@extends('layouts.app')

@section('content')
    <div class="container">
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
        @if (Cart::content()->count() > 0)
            <div class="row row-cols-4 row-cols-md-3 g-4">
                @foreach (Cart::content() as $key => $product)
                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                @if ($product->model->get_image)
                                    <img src="{{ $product->model->get_image }}" class="card-img-top">
                                @else

                                @endif
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">
                                    {{ $product->model->description }}
                                    {{-- <a href="{{ route('post', $post) }}">Leer más...</a> --}}
                                </p>
                                <p class="text-muted mb-0">
                                    <em>
                                        &ndash; Price: {{ $product->price }}
                                    </em>

                                </p>
                            </div>


                            <form action="{{ route('carts.update', $product->model->id) }}" method="POST">
                                <div class="container">
                                    <select class="form-control custom-select mr-sm-2" name="quantity" required>
                                        <option value='{{ $product->qty }}' selected> {{ $product->qty }}</option>
                                        @if ($product->model->stock->quantity >= $product->qty)
                                            @for ($i = $product->model->minimum_amount; $i <= $product->model->stock->quantity; $i++)
                                                @if ($i != $product->qty)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endif
                                            @endfor
                                        @endif
                                    </select>
                                </div>
                                <input type="string" name="product_id" value="{{ $key }}" hidden readonly
                                    required>
                                @method('put')
                                @csrf
                                <div class="btn-group-vertical container mt-3">
                                    <button type="submit" class="btn btn-warning btn-lg btn-block">Update</button>
                                </div>
                            </form>
                            <form action="{{ route('carts.destroy', $key) }}" method="POST">
                                @csrf
                                @method('delete')
                                <div class="btn-group-vertical container mt-3">
                                    <button type="submit" class="btn btn-danger btn-lg btn-block">Delete</button>
                                </div>
                            </form>

                            <div class="card-footer">

                                <small class="text-muted"> Quantity: {{ $product->qty }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <form action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="string" name="stock" value="true" hidden readonly>
                <div class="container mt-5">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-primary" type="submit">Register purchase of
                            ${{ Cart::subtotal() }}</button>
                    </div>
                </div>
            </form>
            <form action="{{ route('shops.destroy', $key) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('delete')
                <input type="string" name="stock" value="true" hidden readonly>
                <div class="container mt-5">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-danger" type="submit">Empty cart</button>
                    </div>
                </div>
            </form>
        @else
            <div class="alert alert-danger" role="alert">
                Please add some product to the cart :)
            </div>
        @endif
    </div>





@endsection
