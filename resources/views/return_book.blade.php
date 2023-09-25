@extends('master')
@section('content')
<style>
.align {
    display: flex;
    justify-content: normal;
    gap: 10px;
}
</style>
<div class="container">
    <h1>Return Policy</h1>
    <div class="content">
        <div class="row">
            <div class="col-6">
                <p style=" color:#fff;">Return will be considered only if the request is made immediately after placing
                    the order. However, the cancellation request may not be entertained if the orders have been
                    communicated to
                    the vendors/merchants and they have initiated the process of shipping them.

                    Online Services does not accept Return requests for perishable items like flowers, eatables
                    etc. However, refund/replacement can be made if the customer establishes that the quality of product
                    delivered is not good.

                    In case of receipt of damaged or defective items please report the same to our Customer Service
                    team. The
                    request will, however, be entertained once the merchant has checked and determined the same at his
                    own end.
                    This should be reported within 7 days of receipt of the products.</p>

            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6">
                    <form action="{{ route('return.store', ['order_id' => $returnitems->order_id]) }}" method="post">
                    @csrf
                            <div class="mb-3">
                                <label for="" class="form-label" style="color:white;">Order
                                    Date:</label>
                                <input type="text" class="form-control" name="created_at"
                                    style="background-color: transparent;color: wheat;" id=""
                                    value="{{date('Y-m-d', strtotime($returnitems->created_at))}}"
                                    aria-describedby="emailHelp" readonly>
                            </div>
                            <div class="mb-3 align">
                                <label for="" class="form-label" style="color:white;">
                                    Quantity:</label>
                                <input type="text" class="form-control" name="qty"
                                    style="background-color: transparent;color: wheat;" id=""
                                    value="{{$returnitems->rentOrder->qty}}" aria-describedby="emailHelp" readonly>
                                <label for="" class="form-label" style="color:white;">
                                    Days:</label>
                                <input type="text" class="form-control" name="days"
                                    style="background-color: transparent;color: wheat;" id=""
                                    value="{{$returnitems->rentOrder->days}}" aria-describedby="emailHelp" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label" style="color:white;">Today
                                    Date:</label>
                                <input type="text" class="form-control"
                                    style="background-color: transparent;color:white;" name="current_date"
                                    value="{{now()->format('Y-m-d')}}" id="" readonly>
                            </div>
                            @if($daysDifference == 0)
                            <button type="submit" style="background-color: black;" class="btn btn-primary">Return
                                Now</button>
                            @else
                           
                            <a href="/return_payment/{{$returnitems->order_id}}" style="background-color: black;" class="btn btn-primary">Pay Now - ({{number_format($payAmount,2)}})</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <p style=" margin-top: 82px;text-align: center; color:black; font-size:20px;"> <strong>Contact us
                anytime between 10:00 AM & 07:00 PM on all days!</strong></p>
    </div>
</div>
<style>
.container {
    width: 100%;
    padding: 28px;
    margin-left: 40px;
}

.bg_img {
    background-image: url('https://img.freepik.com/premium-photo/blurred-bookshelf-many-old-books-book-shop-library_36051-151.jpg?w=740');
    background-repeat: no-repeat;
    background-size: cover;
}

.container h1 {
    padding: 20px 20px 30px 0px;
    font-size: 50px;
    color: #fff;
}

p {
    color: #fff;
}
</style>
@endsection('content')