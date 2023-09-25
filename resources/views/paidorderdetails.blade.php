@extends('master')
@section('content')
<section>
    <div class="container">
        <h2 class="text_col mt-3" style="text-align: center;">Item List</h2>
        <hr style="color:white">
        <div class="shopping-cart mt-5">
            <div class="column-labels text_col d-flex">
                <label class="product-image text_col">Book Image</label>
                <label class="product-details text_col">Detail</label>
                <label class="product-price text_col">Rental Price</label>
                <label class="product-quantity text_col">Quantity</label>
                <label class="product-day text_col">Day</label>
                <label class="product-removal text_col">Return</label>
                <label class="product-line-price text_col">Total</label>
            </div>
            @foreach($orderdetail as $book)
            <input type="hidden" id="userId" value="{{ $book->user_id}}">
            <div class="product d-flex" data-book-id="{{ $book->book_id}}">
                <div class="product-image grow">
                    <img src="{{ url('uploads/books/'.$book->paidOrder->images ) }}">
                </div>
                <div class="product-details text_col grow">
                    <div class="product-title"><span style="color: #8f8fe5;">Title: </span>{{ $book->paidOrder->title }}
                    </div>
                    <p class="product-description"><span style="color: #8f8fe5;">Description:
                        </span>{{ $book->paidOrder->description }}</p>
                </div>
                <div class="product-price text_col" id="rentalPrice" readonly>{{ $book->rentOrder->rent_price}}</div>
                <div class="product-quantity text_col">
                    <input type="number" id="quantity" value="{{ $book->rentOrder->qty}}" class="form-control"
                        style="padding: 4px 0px 5px 12px; text-align: center;" readonly>
                </div>
                <div class="product-day text_col">
                    <input type="number" id="day" value="{{ $book->rentOrder->days}}" class="form-control"
                        style="padding: 4px 0px 5px 12px; text-align: center;" readonly>
                </div>
                <div class="product-remove">
                    @if($book->rentOrder->return_status == 1)
                    <img
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS1PutTDdr6XiSuJBGCHCuB7YOtaxC0Fp-7fg&usqp=CAU" width="80" style="border-radius: 50%;">
                    @else
                    <a href="{{route('return',$book->order_id)}}" class="remove-product btn btn-danger">
                        Return
                    </a>
                    @endif

                </div>
                <div class="product-line-price text_col">{{ $book->rentOrder->t_price}}</div>
            </div>
            @endforeach
            <div class="totals row" style=" display: inherit;">
                <div class="totals-item col-md-4 text_col">
                    <label class="text_col">Subtotal</label>
                    <div class="totals-value text_col" id="cart-subtotal"></div>
                </div>
                <div class="text_col totals-item totals-item-total col-md-4"
                    style="border-top:1px solid #c1c1c1;border-bottom:1px solid #c1c1c1;padding:7px;">
                    <label class="text_col">Grand Total</label>
                    <div class="totals-value text_col" id="cart-total"><b></b></div>
                </div>
            </div>
        </div>
        <a href="/dashboard">
            <i class="fa fa-backward" style="color:white; font-size:30px;"></i>
        </a>
    </div>
</section>
<script>
$(document).ready(function() {
    updateTotalPrice();
    $(".product-quantity input").on("change", function() {
        updateTotalPrice();
    });
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    function updateTotalPrice() {
        var totalPrice = 0;
        $(".product").each(function() {
            var rentalPrice = parseFloat($(this).find(".product-price").text());
            var quantity = parseInt($(this).find(".product-quantity input").val());
            var day = parseInt($(this).find(".product-day input").val());
            var bookId = $(this).data("book-id");
            if (!isNaN(rentalPrice) && !isNaN(quantity)) {
                var lineTotal = rentalPrice * quantity * day;
                $(this).find(".product-line-price").text(lineTotal.toFixed(2));
                totalPrice += lineTotal;
                $.ajax({
                    url: '/update-rentcart', // Replace with your update URL
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        bookId: bookId,
                        quantity: quantity,
                        day: day,
                        total: lineTotal
                    },
                    success: function(response) {
                        // Handle the success response (if needed)
                    },
                    error: function(error) {
                        // Handle any errors (if needed)
                    }
                });
            }
        });
        $("#cart-subtotal").text(totalPrice.toFixed(2));
        $("#cart-total").text(totalPrice.toFixed(2));
    }
});
</script>
@endsection('content')