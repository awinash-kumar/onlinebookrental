@extends('master')
@section('content')
<section id="sellers" class="bg_img">
    <div class="container similar-products my-4">
        <hr>
        <div style="display: flex;justify-content:space-between;align-items:center;" class="new_row">
            <p class="display-5 text_col">Books</p>
            <form autocomplete="off" siq_id="autopick_2231" action="" method="get">
                <input type="Search" class="Search" name="search"
                    style="width:100%;border-radius:20px;padding:10px 20px;border:none;" placeholder="Search...">
                
                <button type="submit" style="background-color:transparent;border:none;"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <span>
            @if(Session::has('success'))
            <p class="alert alert-info" style="margin-left: 442px; width:253px;">{{ Session::get('success') }}</p>
            @endif
        </span>
        <div class="row">
        @if(!$book->isEmpty())
            @foreach( $book as $books)
          
            <div class="col-md-3">
                <div class="similar-product shrink">
                    <img src="{{ url('uploads/books/' . $books->images ) }}" class="mt-3" alt="" width="200"
                        height="300" class="">
                    <p class="title text_col" style="margin-bottom: 0rem;">{{ $books->title}}</p>
                    <p class="price text_col" style="margin-bottom: 0rem;">${{$books->market_price}}.</p>
                    @if($books->userCart)
                    <a class="btn_sty1 btn btn-success" href="{{ route('addcart') }}" style="color:white;">Go To
                        Cart</a></button>
                    @else
                    <a class="btn_sty btn btn-primary" href="{{ route('rent.rentNow',$books->id ) }}"
                        style="color:white;">Rent Now</a></button>
                    @endif
                    <button class="btn_style btn btn-primary view-button" data-bs-toggle="modal"
                        data-bs-target="#bookModal" data-book-id="{{ $books->id }}">View Detail</button>
                </div>
            </div>
          
            @endforeach
            @else
           <span style="color: white; font-size:30px">  {{'No Data Found!'}}</span>
            @endif
        </div>
    </div>
    <div class="pagination_svg">
        {{$book->links()}}
    </div>
</section>
<!-- model for view book details -->
<div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg_img model_sty">
            <div class="modal-header">
                <h5 class="modal-title" id="bookModalLabel">Book Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="bookImage" src="" alt="Book Cover" width="200" height="250">
                <h4 id="bookTitle">Title:</h4>
                <p id="bookAuthor">Author: </p>
                <textarea id="bookDescription1" class="form-control" name="description"
                    placeholder="Enter your description here..." readonly></textarea>
                <!-- Add other book details here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn_sty btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.view-button').click(function() {
        var bookId = $(this).data('book-id');
        // Make an Ajax request to get book details
        $.ajax({
            url: '/get-book-details/' + bookId,
            method: 'GET',
            success: function(data) {
                // Populate the modal with book details
                $('#bookTitle').text('Title: ' + data.title);
                $('#bookAuthor').text('Author: ' + data.author);
                // $('#bookImage').attr('src', data.images);
                $('#bookImage').attr('src', data.cover_image_url);
                $('#bookDescription1').text(data.description);
                // Add other book details as needed
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    setTimeout(function() {
        $('.alert-info').fadeOut('slow');
    }, 1000);
});
</script>
@endsection('content')