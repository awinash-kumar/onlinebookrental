@extends('master')
@section('content')
<section>
    <div class="container">
        <h2 class="text_col mt-3" style="text-align: center;">Rental Cart</h2>
        <hr style="color:white">
     
        <div class="shopping-cart mt-5">
            <div class="column-labels text_col d-flex">
                <label class="product-image text_col">Book Image</label>
                <label class="product-details text_col">Detail</label>
                <label class="product-price text_col">Rental Price</label>
                <label class="product-quantity text_col">Quantity</label>
                <label class="product-day text_col">Day</label>
                <label class="product-removal text_col">Remove</label>
                <label class="product-line-price text_col">Total</label>
            </div>
            @if(!$bookCart->isEmpty())
            @foreach($bookCart as $book)
            <input type="hidden" id="userId" value="{{ $book->user_id}}">
            <div class="product d-flex" data-id="{{ $book->id}}" data-book-id="{{ $book->book_id}}">
                <div class="product-image grow">
                    <img src="{{ url('uploads/books/'.$book->bookcart->images ) }}">
                </div>
                <div class="product-details text_col grow">
                    <div class="product-title"><span style="color: #8f8fe5;">Title: </span>{{ $book->bookcart->title }}
                    </div>
                    <p class="product-description"><span style="color: #8f8fe5;">Description:
                        </span>{{ $book->bookcart->description }}</p>
                </div>
                <div class="product-price text_col" id="rentalPrice">{{ $book->rent_price}}</div>
                <div class="product-quantity text_col">
                    <input type="number" id="quantity"  value="{{ $book->qty}}" min="0" max="5" oninput="validity.valid||(value='');" class="form-control"
                        style="padding: 4px 0px 5px 12px; text-align: center;">
                </div>
                <div class="product-day text_col">
                    <input type="number" id="day" value="{{ $book->days}}" min="0" max="10" oninput="validity.valid||(value='');" class="form-control"
                        style="padding: 4px 0px 5px 12px; text-align: center;">
                </div>
                <div class="product-removal">
                    <a class="remove-product btn btn-danger" onclick="deletebook('{{ encrypt($book->id) }}')">
                        Remove
                    </a>
                </div>
                <div class="product-line-price text_col">{{ $book->t_price}}</div>
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
                <div class=" totals-item totals-item-total col-md-4">
                    <!-- <button class="text_col btn btn-secondary btn-lg btn-block" id="checkoutButton">Continue to checkout</button> -->
                    <a href="/stripe" class="text_col btn btn-secondary btn-lg btn-block" id="">Continue to checkout</a>
                </div>
            </div>
        </div>
        <a href="/dashboard">
            <i class="fa fa-backward" style="color:white; font-size:30px;"></i>
        </a>
        @else
         <span style="color: white; font-size:30px">  {{'No Data Found!'}}</span>
        @endif
    </div>
</section>
<script>
function deletebook(rentid) {
    if (confirm('Are you sure you want to delete this add book?')) {
        // If the user confirms, redirect to the delete route
        window.location.href = '/rent/delete/' + rentid;
    } else {
        // If the user cancels, do nothing
    }
}
</script>
<script>
$(document).ready(function() {
    updateTotalPrices();
    $(".product-quantity input").on("change", function() {
        updateTotalPrices();
    });
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    function updateTotalPrices() {
        var totalPrice = 0;
        $(".product").each(function() {
            var rentalPrice = parseFloat($(this).find(".product-price").text());
            var quantity = parseInt($(this).find(".product-quantity input").val());
            var day = parseInt($(this).find(".product-day input").val());
            var bookId = $(this).data("book-id");
            var id = $(this).data("id");
            if (!isNaN(rentalPrice) && !isNaN(quantity)) {
                var lineTotal = rentalPrice * quantity * day;
                $(this).find(".product-line-price").text(lineTotal.toFixed(2));
                totalPrice += lineTotal;
                $.ajax({
                    url: '/update-rentcart', 
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        id: id,
                        bookId: bookId,
                        quantity: quantity,
                        day: day,
                        total: lineTotal
                    },
                    success: function(response) {
                    },
                    error: function(error) {
                    }
                });
            }
        });
        $("#cart-subtotal").text(totalPrice.toFixed(2));
        $("#cart-total").text(totalPrice.toFixed(2));
    }
});
</script>
<script>
$(document).ready(function() {
    updateTotalPrice();
    $(".product-day input").on("change", function() {
        updateTotalPrice();
    });
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    function updateTotalPrice() {
        var totalPrice = 0;
        $(".product").each(function() {
            var id = $(this).data("id");
            var rentalPrice = parseFloat($(this).find(".product-price").text());
            var quantity = parseInt($(this).find(".product-quantity input").val());
            var day = parseInt($(this).find(".product-day input").val());
            var bookId = $(this).data("book-id");
            if (!isNaN(rentalPrice) && !isNaN(day)) {
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
                        id: id,
                        bookId: bookId,
                        quantity: quantity,
                        day: day,
                        total: lineTotal
                    },
                    success: function(response) {
                    },
                    error: function(error) {
                    }
                });
            }
        });
        $("#cart-subtotal").text(totalPrice.toFixed(2));
        $("#cart-total").text(totalPrice.toFixed(2));
    }
});
</script>
<script>
$(document).ready(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $('#checkoutButton').on('click', function() {
        var userId = $('#userId').val();
        $.ajax({
            url: '/create-order',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                userId: userId,
            },
            success: function(response) {
                alert('Order created successfully!');
            },
            error: function(error) {
                alert('Error creating the order.');
            }
        });
    });
});
</script>
@endsection('content')