@extends('master')
@section('content')
<div class="">
    <main class="p-4 min-vh-100" style="padding-top:40px!important;">
        <div style="margin-left: 9px;">
            <form style="display:flex;gap:10px;justify-content:end;" action="" method="get">
                <input type="search" class="Search" name="search" value=""
                    style="border:none;border-radius: 4px;padding: 10px;"
                    placeholder="Search Here By Order, Transaction....." autocomplete="off">
                <button style="background: #0d6efd; color: white;" type="submit" class="btn">Search</button>
                <a class="btn btn-success " style=" margin-left: 0%; margin-top: 0%;"
                    href="{{route('paidorder.index')}}">Reset</a>
            </form>
        </div>
        @if(Session::has('success'))
        <p class="alert alert-info" style="margin-left: 442px; width:253px;">{{ Session::get('success') }}</p>
        @endif
        <table class="table table-light table-striped " style="margin-top:9px;">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Order Number</th>
                    <th scope="col">Transaction Number</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Amount(Rs)</th>
                    <th scope="col">Order Date </th>
                    <th scope="col" style="width:110px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $paidOrders as $paidOrder)
                <tr>
                    <th scope="row">{{$paidOrder->id}}</th>
                    <td>{{$paidOrder->order_number}}</td>
                    <td>{{$paidOrder->transaction_id}}</td>
                    <td>{{$paidOrder->status}}</td>
                    <td> {{ number_format($paidOrder->amount, 2)}}</td>
                    <td>{{date('Y-M-d', strtotime($paidOrder->created_at))}}</td>
                    <td>
                        <a href="{{route('paidorder.show',$paidOrder->id)}}"><i class="fa fa-eye fa_custom_eye"
                                style="color:black;font-size:22px"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</div>
@endsection('content')