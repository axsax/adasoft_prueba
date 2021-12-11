@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row row-cols-4 row-cols-md-3 g-4">
            @foreach ($products as $product)
                <div class="col">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
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
                        <div class="card-footer">
                            <small class="text-muted"> Date: {{ $product->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>


@endsection
