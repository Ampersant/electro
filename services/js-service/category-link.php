

<?php   			
require_once $_SERVER['DOCUMENT_ROOT'] . '/electro/services/product-service/index.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/electro/services/product-service/category.php';

    $cat_id = $_GET['cat_id'];

    if ($cat_id == "all") {
        $res = get_all_prod_new();
    }else{
        $res = get_all_prod_new_by_category($cat_id);
    }
    ?>
    <div id="slicknav1" class="products-slick" data-nav="#slick-nav-1">
										<!-- product -->
										<?php 
												foreach ($res as $key => $value) { ?> 
													<div class="product">
														<div class="product-img">
															<img src="./img/product01.png" alt="">
															<div class="product-label">
																<?php
																if (!is_null($value['discount_price'])) { ?>
																	<span class="sale"><?= count_discount_percent($value['id']) ?></span>
																<?php	} 
																
																 if ($value['new']) { ?>
																	<span class="new">NEW</span>
																<?php }?> 
															</div>
														</div>
														<div class="product-body">
															<p class="product-category"><?= get_category_name_by_id($value['category_id'])  ?></p>
															<h3 class="product-name"><a href="#"><?= $value['name'] ?></a></h3>
															<?php if (!is_null($value['discount_price'])) { ?>
																<h4 class="product-price">$<?= $value['discount_price'] ?>
																<del class="product-old-price">$<?= $value['price'] ?></del></h4>
																<?php	}else { ?>
																	<h4 class="product-price">$<?= $value['price'] ?>
																	<?php } ?>
															 
															<div class="product-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
															</div>
															<div class="product-btns">
																<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
																<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
																<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
															</div>
														</div>
														<div class="add-to-cart">
															<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
														</div>
													</div>
												<?php }
										?> 
										<!-- /product -->

										
									</div>
<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>


