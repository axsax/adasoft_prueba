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
        <div class="row row-cols-4 row-cols-md-3 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <form action="{{ route('carts.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <input type="number" name="product_id" value="{{ $product->id }}" hidden readonly
                                    required>
                                @if ($product->image)
                                    <img src="{{ $product->get_image }}" class="card-img-top">
                                @else

                                @endif
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">
                                    {{ $product->description }}
                                    {{-- <a href="{{ route('post', $post) }}">Leer más...</a> --}}
                                </p>
                                <p class="text-muted mb-0">
                                    <em>
                                        &ndash; Price: {{ $product->price }}
                                    </em>
                                </p>
                            </div>
                            @if ($product->stock != null)
                                <select class="custom-select mr-sm-2" name="quantity" required>
                                    <option selected>Choose the quantity...</option>
                                    @for ($i = $product->minimum_amount; $i <= $product->stock->quantity; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <div class="card-footer">
                                    @csrf
                                    <input type="submit" value="Add" class="btn btn-sm btn-primary">
                                </div>
                            @else
                                <span class="badge bg-danger">Withot Stock</span>
                            @endif


                        </div>
                    </form>
                </div>
            @endforeach

        </div>
    </div>


@endsection
