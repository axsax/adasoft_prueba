@extends('layouts.app')

@section('content')

    <div class="container text-center ">

        <div class="card mt-2"
            style="margin: 0 auto;
                                                                                                                                                                                                                                                                                                                                                            float: none;
                                                                                                                                                                                                                                                                                                                                                        margin-bottom: 10px; ">
            <div class="card-body">
                <h5 class="card-title">Purchase Summary</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $invoice->user->name }}</h6>
                <p class="card-text">The purchase made on the day {{ $invoice->created_at }} had a total of
                    ${{ $invoice->total }}</p>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Created At</th>
                    <th colspan="1">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $details)
                    <tr>
                        <th>{{ $details->product->name }}</th>
                        <td>{{ $details->quantity }}</td>
                        <td>{{ $details->subtotal }}</td>
                        <td>{{ $details->created_at }}</td>
                        <td><a href="{{ route('products.show', $details->product) }}" class="btn btn-info btn-sm">Watch</a>
                        </td>
                        <td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <script>
        function printWindow() {
            console.log("object");
            $('#lightboxFrame')[0].contentWindow.print();
            window.print();
        }
    </script>
@endsection
