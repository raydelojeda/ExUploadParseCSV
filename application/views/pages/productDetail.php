<link rel="stylesheet" href="<?php echo base_url('assets/plugins/owlcarousel/owl.carousel.min.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/owlcarousel/owl.theme.default.min.css')?>">


<script src="<?php echo base_url('assets/plugins/owlcarousel/owl.carousel.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/owlcarousel/jquery.mousewheel.min.js')?>"></script>


<div class="row">

    <div class="col-lg-6 col-md-12">
        <!-- Card -->
        <div class="card1">
            <img class="card-img-top img-responsive" id="productPreview" src="<?php echo base_url('assets/images/big/img1.jpg')?>">
            <div class="card-body pl-0 pr-0">
                <div class="owl-carousel">
                    <div>
                        <img class="img-responsive slideImg" src="<?php echo base_url('assets/images/big/img1.jpg')?>" style="max-width: 200px;">
                    </div>
                    <div>
                        <img class="img-responsive slideImg" src="<?php echo base_url('assets/images/big/img2.jpg')?>" style="max-width: 200px;">
                    </div>
                    <div>
                        <img class="img-responsive slideImg" src="<?php echo base_url('assets/images/big/img3.jpg')?>" style="max-width: 200px;">
                    </div>
                    <div>
                        <img class="img-responsive slideImg" src="<?php echo base_url('assets/images/big/img4.jpg')?>" style="max-width: 200px;">
                    </div>
                    <div>
                        <img class="img-responsive slideImg" src="<?php echo base_url('assets/images/big/img5.jpg')?>" style="max-width: 200px;">
                    </div>
                    <div>
                        <img class="img-responsive slideImg" src="<?php echo base_url('assets/images/big/img6.jpg')?>" style="max-width: 200px;">
                    </div>
                </div>
            </div>
        </div>
        <!-- Card -->
    </div>

    <div class="col-lg-6 col-md-12">
        <div class="card1">
            <div class="card-body1">
                <div class="row">
                    <div class="col-6"><h1 class="text-info1">Product Name</h1><span class="label label-rounded label-info">New</span></div>
                    <div class="col-6"><span class="display-6 text-info float-right">24 USD</span></div>
                </div>


                <hr class="mb-2">


                <p class="card-text mt-2 text-justify">
                    Todos nuestros clientes particulares (que no son compañías o profesionales) tienen un derecho de devolución de 14 días naturales desde la recepción del mismo.
                    El cliente tiene que enviar el artículo con su embalaje original y protegido con un embalaje adicional para garantizar su recepción en perfecto estado. En caso de que el artículo devuelto no llegue en perfecto estado o con todos sus accesorios, BCIE SARL...
                </p>


                <div style="width: 135px;">
                    <div class="form-group">
                        <div class="input-group ">
                            <span class="input-group-btn input-group-prepend">
                                <button class="btn waves-effect waves-light btn-rounded btn-outline-secondary1" type="button" id="btnQtyDown">-</button>
                            </span>
                                <input id="txtQty" type="text" value="1" name="txtQty" class="form-control" style="text-align: center;">
                            <span class="input-group-btn input-group-append">
                                <button class="btn waves-effect waves-light btn-rounded btn-outline-secondary1" type="button" id="btnQtyUp">+</button>
                            </span>
                        </div>
                    </div>
                </div>

                <p class="d-inline-flex">
                    <button type="button" class="btn waves-effect waves-light btn-info mr-5">Add To Cart</button>
                    <button type="button" class="btn btn-light btn-circle"><i class="fa fa-heart"></i> </button>
                </p>

            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-12">
        <div class="card1">
            <div class="card-body1">

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Description</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Questions</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Reviews</span></a> </li>
                </ul>

                <div class="tab-content tabcontent-border">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="card1">
                            <div class="card-body collapse show">
                                <h4 class="card-title">Special title treatment</h4>
                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane  p-3" id="profile" role="tabpanel">
                        <?php $this->load->view('pages/questions');?>
                    </div>
                    <div class="tab-pane p-3" id="messages" role="tabpanel">
                        <?php $this->load->view('pages/reviews');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function()
    {
        let owl = $('.owl-carousel');

        owl.owlCarousel({
            loop: true,
            nav: false,
            margin: 10,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                960: {
                    items: 5
                },
                1200: {
                    items: 6
                }
            }
        });

        owl.on('mousewheel', '.owl-stage', function(e) {
            if (e.deltaY > 0) {
                owl.trigger('next.owl');
            } else {
                owl.trigger('prev.owl');
            }
            e.preventDefault();
        });

        $('.slideImg').on('click', function ()
        {
            let selected = $(this).attr('src');

            $('#productPreview').attr('src', selected);
        });

        $('#btnQtyUp').on('click', function ()
        {
            let qty = parseInt($('#txtQty').val());
            $('#txtQty').val(qty + 1);
        });

        $('#btnQtyDown').on('click', function ()
        {
            let qty = parseInt($('#txtQty').val());

            if(qty > 1)
                $('#txtQty').val(qty - 1);
        });


    })

</script>