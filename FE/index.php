<?php
// khai bao
include_once('../BE/model/product_db.php');
include_once('../BE/model/protypes_db.php');

$productDB = new Product_DB();
$protypeDB = new Protypes_DB();

// Tim san pham theo tu khoa
$keyword =  isset($_GET['keyword']) ? $_GET['keyword'] : "";
// tim theo loai san pham
$type_id = isset($_GET["type_id"]) ? $_GET["type_id"] : 1000001;
// trả về loại sản phẩm đầu tiên nếu không có loại nào
$limit = 10;
// lấy đường dẫn đến file hiện hành
$url = $_SERVER['PHP_SELF'] . "?type_id=$type_id";
//------------------------------------------------------------------
//---------------------------DANH SACH------------------------------
//------------------------------------------------------------------
// danh sach san pham tim theo tu khoa va theo loai san pham
$listSearchByName = $productDB->searchByName($keyword, $type_id);

// danh sach loai san pham
$protypeList = $protypeDB->getList();

// danh sach san pham moi nhat theo loai san pham 
$productNews = $productDB->selectNewsLimit($limit, $type_id);
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('header.php') ?>

<body>
	<?php require_once('body_header.php'); ?>

	<?php //require_once('body_navigation.php') 
	?>

	<!-- SECTION -->

	<!-- /SECTION -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<!-- section title -->
				<?php require_once('sectiontitles.php') ?>
				<!-- /section title -->

				<!-- Products tab & slick -->
				<div class="col-md-12">
					<div class="row">
						<div class="products-tabs">
							<!-- tab -->
							<!-- ../FE/index.php?type_id={$value["type_id"]}#tab{$value["type_id"]} -->
							<div class="tab-pane active">
								<div class="products-slick" data-nav="#slick-nav-1">
									<!-- product -->
									<?php
									foreach ($productNews as $key => $value) {
										echo "<div class='product'>
										<div class='product-img'>
											<img src='./img/{$value['pro_image']}' alt=''>
										</div>
										<div class='product-body'>
											<p class='product-category'>{$value['type_name']}</p>
											<h3 class='product-name'><a href='#'>{$value['name']}</a></h3>
											<h4 class='product-price'>$ {$value['price']} <del class='product-old-price'>$ {$value['price']}</del></h4>
										</div>
										<div class='add-to-cart'>
											<button class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> add to cart</button>
										</div>
									</div>";
									}
									?>
									<!-- /product -->


								</div>
								<div id="slick-nav-1" class="products-slick-nav"></div>
							</div>
							<!-- /tab -->
						</div>
					</div>
				</div>
				<!-- Products tab & slick -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- FOOTER -->
	<?php require_once('footer.php') ?>
</body>

</html>