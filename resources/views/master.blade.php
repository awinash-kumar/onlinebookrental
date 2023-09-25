<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Online Book Rental System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
    .bg_img {
        background-image: url('https://img.freepik.com/free-photo/brown-concrete-textured-wall_53876-94014.jpg?w=740&t=st=1694435319~exp=1694435919~hmac=68ae7c94efd163028eb2e460940233b2643b22f648b59dfd473c0b0db527b8c1'
            );
        background-repeat: no-repeat;
        background-size: cover;
        opacity: 1;
        /* background-image: url('https://img.freepik.com/free-photo/young-beautiful-woman-with-glasses-holding-notebook-looking-bookshelf_1153-8935.jpg?w=740&t=st=1695107543~exp=1695108143~hmac=d121b95fff5d92a9876c6d89e777cc722630cc500d6e314c322ec068d0e2a672'
            ); */
    }

    .model_sty {
        width: 60%;
        margin: 2px 153px;
        text-align: center;
        color: white;
    }

    .text_col {
        color: white;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: "Poppins", sans-serif;
    }

    .container {
        max-width: 1200px;
        width: 90%;
        margin: 0 auto;
    }

    /* //........top text ........// */
    :root {
        /* //....... Color ........// */
        --primary-color: #ff3c78;
        --light-black: rgba(0, 0, 0, 0.89);
        --black: #000;
        --white: #fff;
        --grey: #aaa;
    }

    .ct-section {
        display: flex;
        align-items: center;
        margin-right: 56px;
        gap: 27px;
    }

    .ct-section i {
        font-size: 25px;
    }

    /* //........top text ........// */
    .top-txt {
        background-color: var(--black);
    }

    .head {
        display: flex;
        justify-content: space-between;
        color: rgba(255, 255, 255, 0.945);
        padding: 10px 0;
        font-size: 14px;
    }

    .head a {
        text-decoration: none;
        color: rgba(255, 255, 255, 0.945);
        margin: 0 10px;
    }

    /* //........ Navbar ........// */
    .navbar input[type="checkbox"],
    .navbar .hamburger-lines {
        display: none;
    }

    .navbar {
        box-shadow: 0 5px 4px rgb(146 161 176 / 15%);
        position: sticky;
        top: 0;
        background: var(--white);
        color: var(--black);
        z-index: 100;
    }

    .navbar-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 64px;
    }

    .books_logo {
        margin-left: 1rem;
    }

    .menu-items {
        order: 2;
        display: flex;
        margin-right: 3rem;
        margin: 0;
    }

    .menu-items li {
        list-style: none;
        margin-left: 1.5rem;
        font-size: 1.2rem;
    }

    .navbar-container ul a {
        text-decoration: none;
        color: var(--black);
        font-size: 18px;
        position: relative;
    }

    .navbar-container ul a:after {
        content: "";
        position: absolute;
        background: var(--primary-color);
        height: 3px;
        width: 0;
        left: 0;
        bottom: -10px;
        transition: 0.3s;
    }

    .navbar-container ul a:hover:after {
        width: 100%;
    }

    /* /// hover */
    .btn_sty {
        padding: 5px 11px;
        margin-top: 5px;
        font-size: 14px;
        cursor: pointer;
        text-transform: uppercase;
        background-color: #8f4646;
        color: var(--white);
        border: none;
        border-radius: 15px;
        font-weight: 500;
        border: 1px solid #8f4646;
        transition: 0.5s;
    }

    .btn_sty1 {
        padding: 5px 11px;
        margin-top: 5px;
        font-size: 14px;
        cursor: pointer;
        text-transform: uppercase;
        background-color: green;
        color: var(--white);
        border: none;
        border-radius: 15px;
        font-weight: 500;
        border: 1px solid #8f4646;
        transition: 0.5s;
    }

    textarea {
        height: 100px;
        padding-top: 15px;
        resize: none;
    }

    .btn_style {
        padding: 5px 11px;
        margin-top: 5px;
        font-size: 14px;
        cursor: pointer;
        text-transform: uppercase;
        background-color: #938484;
        color: var(--white);
        border: none;
        border-radius: 15px;
        font-weight: 500;
        border: 1px solid #8f4646;
        transition: 0.5s;
    }

    a {
        text-decoration: none;
    }

    .shrink img {
        transition: 1s ease;
    }

    .shrink img:hover {
        -webkit-transform: scale(0.8);
        -ms-transform: scale(0.8);
        transform: scale(0.8);
        transition: 1s ease;
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

    @media (max-width: 768px) {
        .navbar {
            opacity: 0.95;
        }

        .navbar-container input[type="checkbox"],
        .navbar-container .hamburger-lines {
            display: block;
        }

        .navbar-container {
            display: block;
            position: relative;
            height: 64px;
        }

        .navbar-container input[type="checkbox"] {
            position: absolute;
            display: block;
            height: 32px;
            width: 30px;
            top: 20px;
            left: 20px;
            z-index: 5;
            opacity: 0;
            cursor: pointer;
        }

        .navbar-container .hamburger-lines {
            display: block;
            height: 28px;
            width: 35px;
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .navbar-container .hamburger-lines .line {
            display: block;
            height: 4px;
            width: 100%;
            border-radius: 10px;
            background: #333;
        }

        .navbar-container .hamburger-lines .line1 {
            transform-origin: 0% 0%;
            transition: transform 0.3s ease-in-out;
        }

        .navbar-container .hamburger-lines .line2 {
            transition: transform 0.2s ease-in-out;
        }

        .navbar-container .hamburger-lines .line3 {
            transform-origin: 0% 100%;
            transition: transform 0.3s ease-in-out;
        }

        .navbar .menu-items {
            padding-top: 100px;
            background: #fff;
            height: 100vh;
            max-width: 100%;
            transform: translate(-150%);
            display: flex;
            flex-direction: column;
            text-align: center;
            transition: transform 0.5s ease-in-out;
            overflow: scroll;
        }

        .navbar .menu-items li {
            margin-bottom: 2rem;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .menu-items li,
        .navbar img {
            margin: 0;
        }

        .navbar .menu-items li:nth-child(1) {
            margin-top: 1.5rem;
        }

        .navbar-container .logo img {
            position: absolute;
            top: 10px;
            right: 15px;
            margin-top: 8px;
        }

        .navbar-container input[type="checkbox"]:checked~.menu-items {
            transform: translateX(0);
        }

        .navbar-container input[type="checkbox"]:checked~.hamburger-lines .line1 {
            transform: rotate(45deg);
        }

        .navbar-container input[type="checkbox"]:checked~.hamburger-lines .line2 {
            transform: scaleY(0);
        }

        .navbar-container input[type="checkbox"]:checked~.hamburger-lines .line3 {
            transform: rotate(-45deg);
        }

        .navbar-container input[type="checkbox"]:checked~.home_page img {
            display: none;
            background: #fff;
        }
    }

    @media (max-width: 500px) {
        .navbar-container input[type="checkbox"]:checked~.navbar-container img {
            display: none;
        }
    }

    .content:hover::after {
        opacity: 1;
    }

    /* search */
    .new_row input {
        width: 100%;
        color: white;
        padding: 10px 20px;
        border: none;
        background: transparent;
    }

    .new_row input::placeholder {
        color: white;
    }

    .new_row form {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #725c549e;
        box-shadow: rgb(179 173 173 / 35%) 0px 5px 15px;
        border-radius: 20px;
        color: white;
    }

    .new_row form:focus-visible {
        outline: 1px solid white;
    }

    .new_row .fa-search {
        color: white;
        padding-right: 15px;
    }

    .new_row input:focus-visible {
        outline: none;
    }

    /* search */
    /* //........ Footer ...... // */
    footer {
        width: 100%;
        background: var(--black);
        margin-top: 20px;
    }

    .footer-container .content_1 img {
        height: 60px;
        width: 70px;
    }

    .footer-container {
        display: flex;
        justify-content: space-between;
        padding: 30px 0;
    }

    .footer-container h4 {
        color: var(--white);
        font-weight: 500;
        letter-spacing: 1px;
        margin-bottom: 25px;
        font-size: 18px;
    }

    .footer-container a {
        display: block;
        text-decoration: none;
        color: var(--grey);
        margin-bottom: 15px;
        font-size: 14px;
    }

    .footer-container .content_1 p,
    .footer-container .content_4 p {
        color: var(--grey);
        margin: 25px 0;
        font-size: 14px;
    }

    .footer-container .content_4 input[type="email"] {
        background-color: var(--black);
        border: none;
        color: var(--white);
        outline: none;
        padding: 15px 0;
    }

    .footer-container .content_4 .f-mail {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .f-design {
        width: 100%;
        color: var(--white);
        text-align: center;
    }

    .f-design .f-design-txt {
        border-top: 1px solid var(--grey);
        padding: 25px 0;
        font-size: 14px;
        color: var(--grey);
    }

    /* //........ contact ...... // */
    .contact {
        margin-top: 45px;
    }

    .pagination_svg svg {
        width: 20px;
        height: 20px;
    }

    .pagination_svg {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .pagination_svg p {
        display: none;
    }

    .pagination_svg>nav>div>a {
        display: none;
    }

    .pagination_svg>nav>div>span {
        display: none;
    }

    /* //....... Media Queries For Contact .......// */
    @media (max-width: 500px) {
        .form {
            display: flex;
            flex-direction: column;
        }

        .form .form-details button {
            margin-left: 0;
        }

        .form .form-details input[type="text"],
        .form .form-details input[type="email"],
        .form .form-details textarea {
            width: 100%;
            margin-left: 0;
        }

        .form .form-details input[type="text"] {
            margin-bottom: 0px;
        }
    }

    @media(min-width: 501px) and (max-width: 768px) {
        .form {
            display: flex;
            flex-direction: column;
        }

        .form .form-details button {
            margin-left: 0;
        }

        .form .form-details input[type="text"],
        .form .form-details input[type="email"],
        .form .form-details textarea {
            width: 100%;
            margin-left: 0;
        }

        .form .form-details input[type="text"] {
            margin-bottom: 0px;
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
</head>
{{ View::make('header') }}
@yield('content')
{{ View::make('footer') }}

<body class="bg_img">
</body>

</html>