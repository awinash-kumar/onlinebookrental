<style>
.border-left {
    border-left: 2px solid var(--primary) !important;
}

.sidebar {
    top: 0;
    left: 0;
    z-index: 100;
    overflow-y: auto;
}

.overlay {
    background-color: rgb(0 0 0 / 45%);
    z-index: 99;
}

.grow img {
    transition: 1s ease;
}

.grow img:hover {
    -webkit-transform: scale(1.2);
    -ms-transform: scale(1.2);
    transform: scale(1.2);
    transition: 1s ease;
}

/* sidebar for small screens */
@media screen and (max-width: 767px) {
    .sidebar {
        max-width: 18rem;
        transform: translateX(-100%);
        transition: transform 0.4s ease-out;
    }

    .sidebar.active {
        transform: translateX(0);
    }
}
</style>
<style>
.product-image {
    float: left;
    width: 20%;
}

.product-details {
    float: left;
    width: 37%;
}

.product-price {
    float: left;
    width: 12%;
}

.product-quantity {
    float: left;
    width: 10%;
}

.product-day {
    float: left;
    width: 10%;
}

.product-removal {
    float: left;
    width: 9%;
}

.product-line-price {
    float: left;
    width: 12%;
    text-align: right;
}

/* This is used as the traditional .clearfix class */
.group:before,
.shopping-cart:before,
.column-labels:before,
.product:before,
.totals-item:before,
.group:after,
.shopping-cart:after,
.column-labels:after,
.product:after,
.totals-item:after {
    content: '';
    display: table;
}

.group:after,
.shopping-cart:after,
.column-labels:after,
.product:after,
.totals-item:after {
    clear: both;
}

.group,
.shopping-cart,
.column-labels,
.product,
.totals-item {
    zoom: 1;
}

/* Apply clearfix in a few places */
/* Apply dollar signs */
.product .product-price:before,
.product .product-line-price:before,
.totals-value:before {
    content: '$';
}

h1 {
    font-weight: 100;
}

label {
    color: #402923;
    font-weight: 600;
}

/* Column headers */
.column-labels label {
    padding-bottom: 15px;
    margin-bottom: 15px;
    border-bottom: 1px solid #eee;
}

/* Product entries */
.product {
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}

.product .product-image img {
    width: 100px;
}

.product .product-details .product-title {
    margin-right: 20px;
    font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
}

.product .product-details .product-description {
    margin: 5px 20px 5px 0;
    line-height: 1.4em;
}

.product .product-quantity input {
    width: 40px;
}

.product .product-day input {
    width: 40px;
}

.product .remove-product {
    border: 0;
    padding: 4px 15px;
    /* background-color: #402923; */
    color: #fff;
    font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
    font-size: 14px;
    border-radius: 3px;
}

.product .remove-product:hover {
    background-color: #402923;
}

/* Totals section */
.totals .totals-item {
    float: right;
    clear: both;
    margin-bottom: 10px;
    margin-right: auto;
}

.totals .totals-item label {
    float: left;
    clear: both;
    text-align: right;
}

.totals .totals-item .totals-value {
    float: right;
    width: 21%;
    text-align: right;
}

.totals .totals-item-total {
    font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
}

/* Make adjustments for tablet */
@media screen and (max-width: 650px) {
    .shopping-cart {
        margin: 0;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .column-labels {
        display: none;
    }

    .product-image {
        float: right;
        width: auto;
    }

    .product-image img {
        margin: 0 0 10px 10px;
    }

    .product-details {
        float: none;
        margin-bottom: 10px;
        width: auto;
    }

    .product-price {
        clear: both;
        width: 70px;
    }

    .product-quantity {
        width: 100px;
    }

    .product-quantity input {
        margin-left: 20px;
    }

    .product-quantity:before {
        content: 'x';
    }

    .product-day {
        width: 100px;
    }

    .product-day input {
        margin-left: 20px;
    }

    .product-day:before {
        content: 'x';
    }

    .product-removal {
        width: auto;
    }

    .product-line-price {
        float: right;
        width: 70px;
    }

    .text_col {
        color: white;
    }
}

/* Make more adjustments for phone */
@media screen and (max-width: 350px) {
    .product-removal {
        float: right;
    }

    .product-line-price {
        float: right;
        clear: left;
        width: auto;
        margin-top: 10px;
    }

    .product .product-line-price:before {
        content: 'Item Total: $';
    }

    .totals .totals-item label {
        width: 60%;
    }

    .totals .totals-item .totals-value {
        width: 40%;
    }
}
</style>
<x-app-layout>
    <!-- overlay -->
    <div id="sidebar-overlay" class="overlay w-100 vh-100 position-fixed d-none"></div>
    <!-- sidebar -->
    <div class="col-md-3 col-lg-2 px-0 position-fixed h-100 bg-white shadow-sm sidebar" id="sidebar">
        <h1 class="bi bi-bootstrap text-primary d-flex my-4 justify-content-center"></h1>
        <div class="list-group rounded-0" style="padding-top:70px;">
            <a href="{{route('dashboard')}}"
                class="list-group-item  sidebar-item list-group-item-action  border-0 d-flex align-items-center">
                <span class="bi bi-border-all"></span>
                <span class="ml-2">Dashboard</span>
            </a>
            <a href="{{route('custmer.index')}}"
                class="list-group-item list-group-item-action border-0 align-items-center sidebar-item">
                <span class="bi bi-box"></span>
                <span class="ml-2">User List</span>
            </a>
            <a href="{{route('book.index')}}"
                class="list-group-item list-group-item-action border-0 align-items-center sidebar-item">
                <span class="bi bi-box"></span>
                <span class="ml-2">Book List</span>
            </a>
            <a href="{{route('order.index')}}"
                class="list-group-item list-group-item-action active border-0 align-items-center sidebar-item">
                <span class="bi bi-box"></span>
                <span class="ml-2">Order List</span>
            </a>
        </div>
    </div>
    <div class="col-md-9 col-lg-10 ml-md-auto px-0 ms-md-auto">
        <div class="container">
            <h1 class="text_col mt-3" style="text-align: center;"><strong>Order Details</strong></h1>
            <div class="shopping-cart mt-5">
                <div class="column-labels text_col d-flex">
                    <label class="product-image text_col">Book Image</label>
                    <label class="product-details text_col">Detail</label>
                    <label class="product-price text_col">Rental Price</label>
                    <label class="product-quantity text_col">Quantity</label>
                    <label class="product-day text_col">Day</label>
                    <label class="product-line-price text_col">Total</label>
                </div>
                @foreach($orderdetail as $book)
                <input type="hidden" id="userId" value="{{ $book->user_id}}">
                <div class="product d-flex" data-book-id="{{ $book->book_id}}">
                    <div class="product-image grow">
                        <img src="{{ url('uploads/books/'.$book->paidOrder->images ) }}">
                    </div>
                    <div class="product-details text_col grow">
                        <div class="product-title"><span style="color: #8f8fe5;">Title:
                            </span>{{ $book->paidOrder->title }}
                        </div>
                        <p class="product-description"><span style="color: #8f8fe5;">Description:
                            </span>{{ $book->paidOrder->description }}</p>
                    </div>
                    <div class="product-price text_col" id="rentalPrice">{{ $book->rentpaidOrder->rent_price}}</div>
                    <div class="product-quantity text_col">
                        <input type="number" id="quantity" value="{{ $book->rentpaidOrder->qty}}" class="form-control"
                            style="padding: 4px 0px 5px 12px; text-align: center;" readonly>
                    </div>
                    <div class="product-day text_col">
                        <input type="number" id="quantity" value="{{ $book->rentpaidOrder->days}}" class="form-control"
                            style="padding: 4px 0px 5px 12px; text-align: center;" readonly>
                    </div>
                    <div class="product-line-price text_col">{{ $book->rentpaidOrder->t_price}}</div>
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
            <a href="/order">
                <i class="fa fa-backward" style="color:white; font-size:30px;"></i>
            </a>
        </div>
    </div>
</x-app-layout>
<script>
$(document).ready(function() {
    $(".sidebar-item").click(function() {
        $(".sidebar-item").removeClass("active");
        $(this).addClass("active");
    });
});
</script>
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
                    url: '/update-rentcart', 
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