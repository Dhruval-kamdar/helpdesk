<?php
	//session_start();
        error_reporting(E_ALL);
	include('common-files_new.php');
	include("class/price.class_new.php");
	error_log("hello world");
	$priceClass = new Price($dbCon);
	$priceClass->getPrice($string);

//$tmpdata = $priceClass->getMetalPriceArray();
//$priceClass->testGoldPrices();
//$prices = $priceClass->getMetalCurrentPriceArray();
//$priceClass->testGoldPrices();

//$priceClass->getGoldPrices();
//$priceClass->getSilverPrices();
//$priceClass->getPlatinumPrices();
//$priceClass->getPalladiumPrices();

function display_price($price, $decimal = 0) {
	if(is_string($price)) {
		return $price;
	} else {
		//error_log("not a string: $price - " . gettype($price));
		return number_format($price, 2, '.', ',');
	}
}

	$title = ('Gold Spot Price & Silver Pirces | Chula Vista Coins San Diego');
	$description = ('Precious Metal Spot Prices by Chula Vista Coins San Diego, your local Gold, Silver & Precious Metals Dealer. Visit us for up to the minute metal prices.');
	$keywords = ('Gold Coins, Precious Metals, Silver Coins, Gold Bullion, Silver Bullion, San Diego, United States, Chula Vista Coins San Diego, Precious Metals San Diego');
	
	$headerlinks = <<<EOD
	
	<link rel="canonical" href="https://www.chulavistacoins.com$uriAddy" />
	
	<style type="text/css">
		a {
			color:#000000;
		}
		a:hover {
			color:#0088cc;
		}
	</style>
	
EOD;

	include ('common-head.php');
?>
	<body>
		<div class="body">
		<!-- common-header-start -->
		<?php include ('common-header.php'); ?>
			<?php              
				$metalstring = NULL;
				error_log("trying to get metal data");
				try {
					$curl = curl_init();
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_URL, 'https://online.kitco.com/sell/gold-silver.html');
					$metalstring = curl_exec($curl);
                                      //  print_r($metalstring);exit;
					curl_close($curl);
                                        
				}
				catch (Exception $e) {
    				error_log("get spot data error via curl" . $e->getMessage());
				}
				if (!$metalstring){
                                    
					try {
						error_log("retrying...");
 						$metalstring = file_get_contents('https://online.kitco.com/sell/gold-silver.html');
 					}	
					catch (Exception $e) {
    					error_log("get spot data error via file_get_contents" . $e->getMessage());
					}
				}
				if ($metalstring){
                                    
					error_log("read the metal data page OK.");
					echo $gold = $priceClass->extractPriceGold($metalstring);
                                        echo 'ssxs';exit;
					echo $silver = $priceClass->extractPriceSilv($metalstring);
					$platinum = $priceClass->extractPricePlat($metalstring);
					$palladium = $priceClass->extractPricePall($metalstring);

					$priceClass->getGoldPrices();
					$priceClass->getSilverPrices();
					$priceClass->getPlatinumPrices();
					$priceClass->getPalladiumPrices();
                                        

				} else{
					error_log("utterly failed to get spot prices");
				}
	 		?>
		<!-- common-header-end-->
			<div role="main" class="main">
				<section class="page-top">
					<div class="container">
						<div class="row">
							<div class="span12">
								<ul class="breadcrumb">
									<li><a href="/">Home</a> <span class="divider">/</span></li>
									<li class="active">Portfolio</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="span12">
							<?php $headers->header16($dbCon); ?>
							</div>
						</div>
					</div>
				</section>
				<div class="container">
							<h4 class="spaced">Buy &amp; Sell Prices</h4>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>
											Spot Prices
										</th>
										<th>
										</th>
									</tr>
									<tr>
										<th>
										</th>
										<th>
										</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="black bgcolor5">
											<a href="#gold" style="color:#000;">Gold</a>
										</th>
										<th class="width" id="goldSpotPrice">
											<?php 
												echo display_price($gold);
												// echo display_price($priceClass->data["Gold"]["price"]);
											?>
										</th>
									</tr>
									<tr>
										<th class="black bgcolor2">
											<a href="#silver" style="color:#fff;">Silver</a>
										</th>
										<th class="width" id="silverSpotPrice">
											<?php 
												echo display_price($silver);
												// echo display_price($priceClass->data["Silver"]["price"], 2);
											?>
										</th>
									</tr>
									<tr>
										<th class="black bgcolor3">
											<a href="#platinum" style="color:#fff;">Platinum</a>
										</th>
										<th class="width" id="platinumSpotPrice">
											<?php 
												echo display_price($platinum);
												// echo display_price($priceClass->data["Platinum"]["price"]);
											?>
										</th>
									</tr>
									<tr>
										<th class="black bgcolor4">
											<a href="#palladium" style="color:#fff;">Palladium</a>
										</th>
										<th class="width" id="palladiumSpotPrice">
											<?php 
												echo display_price($palladium);
												//echo display_price($priceClass->data["Palladium"]["price"]);
											?>
										</th>
									</tr>
								</tbody>
							</table>

							<table class="table table-bordered">
								<tbody>
									<tr>
										<th class="bgcolor5">
											<a name="gold" style="color:#000;">Gold</a>
										</th>
										<th class="bgcolor5">
											Buy
										</th>
										<th class="bgcolor5">
											Sell
										</th>
										<th class="bgcolor5">
											
										</th>
										<th class="bgcolor5">
											Buy
										</th>
										<th class="bgcolor5">
											Sell
										</th>
									</tr>
									<tr>
										<td>
											
										</td>
										<td class="width">
											
										</td>
										<td class="width">
											
										</td>
										<td>
											
										</td>
										<td class="width">
											
										</td>
										<td class="width">
											
										</td>
									</tr>
									<tr>
										<th class="black bgcolor1">
										<a href="product-inventory.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_American_Gold_Eagle">American Gold Eagle (PFT)</a>
										</th>
										<th>
											
										</th>
										<th>
											
										</th>
										<th class="black bgcolor1">
										<a href="product-inventory.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_Chinese_Gold_Panda">Chinese Gold Panda (IOP)</a>
										</th>
										<th>
											
										</th>
										<th>
											
										</th>
									</tr>
									<tr>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold%20Bullion&subCat=2017_American_Gold_Eagle&id=2344&itemId=GB2344011317">1 Ounce 2017</a>
										</td>
										<td class="black">
											<?php 
												if (empty($priceClass->data["Gold"]["D06"])){ error_log("database error"); die();}
												echo display_price($priceClass->data["Gold"]["D06"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["E06"]);
											?>
										</td>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_Chinese_Gold_Panda&id=2328&itemId=GB2328011317">1 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H06"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I06"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_American_Gold_Eagle&id=2343&itemId=GB2343011317">1/2 Ounce 2017</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["D07"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["E07"]);
											?>
										</td>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_Chinese_Gold_Panda&id=2327&itemId=GB2327011317">1/2 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H07"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I07"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_American_Gold_Eagle&id=2342&itemId=GB2342011317">1/4 Ounce 2017</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["D08"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["E08"]);
											?>
										</td>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_Chinese_Gold_Panda&id=2326&itemId=GB2326011217">1/4 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H08"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I08"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_American_Gold_Eagle&id=2341&itemId=GB2341011317">1/10 Ounce 2017</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["D09"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["E09"]);
											?>
										</td>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_Chinese_Gold_Panda&id=2325&itemId=GB2324011217">1/10 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H09"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I09"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											<a href="#">Proof (w/b&p) 1 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["D10"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo "ASK";
											?>
										</td>
										<td>
											<a href="#">1/20 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H10"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I10"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
									</tr>
									<tr>
										<th class="black bgcolor1">
											<a href="product-inventory.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_American_Gold_Buffalo">American Gold Buffalo</a>
										</th>
										<th class="green">
											Buy
										</th>
										<th class="green">
											Sell
										</th>
										<th class="black bgcolor1">
											<a href="product-inventory.php?itemType=bullion&catName=50_Gold_Bullion&subCat=50_Dollar_Mexican_Peso">Mexican Gold Pesos</a>
										</th>
										<th class="green">
											Buy
										</th>
										<th class="green">
											Sell
										</th>
									</tr>
									<tr>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_American_Gold_Buffalo&id=2340&itemId=GB2340011317">1 Ounce 2017 + $30</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["D12"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["E12"]);
											?>											
										</td>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=50_Gold_Bullion&subCat=50_Dollar_Mexican_Peso&id=978&itemId=5GB66092116">50 Peso</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H12"]);
											?>	
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I12"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											without original plastic
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["D13"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["E13"]);
											?>											
										</td>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Mexican_Pesos&subCat=20_Gold_Mexican_Peso&id=2345&itemId=5GB2345040217">20 Peso</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H13"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I13"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											Proof (w/b&p) 1 Ounce
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["D14"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo "ASK";
											?>
										</td>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Mexican_Pesos&subCat=10_Mexican_Gold_Peso&id=2346&itemId=5GB2346040317">10 Peso</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H14"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I14"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Mexican_Pesos&subCat=5_Gold_Mexican_Peso&id=2347&itemId=5GB2347040317">5 Peso</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H15"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I15"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Mexican_Pesos&subCat=2.5_Gold_Mexican_Peso&id=2348&itemId=5GB2348040317">2 1/2 Peso</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H16"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I16"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Mexican_Pesos&subCat=2_Gold_Mexican_Peso&id=2349&itemId=5GB2349040317">2 Peso</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H17"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I17"], 2);
											?>
										</td>
									</tr>
									<tr>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
									</tr>
									<tr>
										<th class="black bgcolor1">
											<a href="product-inventory.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_Canadian_Gold_Maple_Leaf">Canadian Gold Maple</a>
										</th>
										<th class="green">
											Buy
										</th>
										<th class="green">
											Sell
										</th>
										<th class="black bgcolor1">
											<a href="product-inventory.php?itemType=bullion&catName=Gold_Bullion&subCat=Recognized_Gold_Bars">Recognized Bar (9999)</a>
										</th>
										<th class="green">
											Buy
										</th>
										<th class="green">
											Sell
										</th>
									</tr>
									<tr>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_Canadian_Gold_Maple_Leaf&id=2336&itemId=GB2336011317">1 Ounce PFT (9999)</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["D16"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["E16"]);
											?>
										</td>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=Recognized_Gold_Bars&id=979&itemId=GB67092716">1 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H19"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I19"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_Canadian_Gold_Maple_Leaf&id=2335&itemId=GB2335011317">1/2 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["D17"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["E17"]);
											?>
										</td>
										<td>
											20 Gram
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H20"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I20"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_Canadian_Gold_Maple_Leaf&id=2334&itemId=GB2334011317">1/4 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["D18"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["E18"]);
											?>
										</td>
										<td>
											10 Gram
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H21"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I21"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_Canadian_Gold_Maple_Leaf&id=2333&itemId=GB2333011317">1/10 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["D19"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["E19"]);
											?>
										</td>
										<td>
											5 Gram
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H22"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I22"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											<a href="">1 Ounce (Damaged)/(999)</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["D20"]);
											?>
										</td>
										<td>
											
										</td>
										<td>
											2.5 Gram
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H23"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I23"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											1 Gram
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["H24"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["I24"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
									</tr>
									<tr>
										<th class="black bgcolor1">
											<a href="product-inventory.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_Gold_Krugerrand">South African Krugerrand</a>
										</th>
										<th class="green">
											Buy
										</th>
										<th class="green">
											Sell
										</th>
										<th class="black">
											
										</th>
										<th class="green">
											
										</th>
										<th class="green">
											
										</th>
									</tr>
									<tr>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_Gold_Krugerrand&id=2332&itemId=GB2332011317">1 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["D22"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["E22"]);
											?>
										</td>
										<td>
											
										</td>
										<td class="black">
										
										</td>
										<td class="black">
										
										</td>
									</tr>
									<tr>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_Gold_Krugerrand&id=2331&itemId=GB2331011317">1/2 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["D23"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["E23"]);
											?>
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
									</tr>
									<tr>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_Gold_Krugerrand&id=2330&itemId=GB2330011317">1/4 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["D24"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["E24"]);
											?>
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
									</tr>
									<tr>
										<td>
											<a href="product-for-sale.php?itemType=bullion&catName=Gold_Bullion&subCat=2017_Gold_Krugerrand&id=2329&itemId=GB2329011317">1/10 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["D25"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Gold"]["E25"]);
											?>
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="width2 bgcolor4">
											<a name="silver" style="color:#fff;">Silver</a>
										</th>
										<th class="bgcolor4" style="color:#fff;">
											Buy
										</th>
										<th class="bgcolor4" style="color:#fff;">
											Sell
										</th>
										<th class="bgcolor4">
											
										</th>
										<th class="bgcolor4" style="color:#fff;">
											Buy
										</th>
										<th class="bgcolor4" style="color:#fff;">
											Sell
										</th>
									</tr>
									<tr>
										<td>
											
										</td>
										<td class="width">
											
										</td>
										<td class="width">
											
										</td>
										<td>
											
										</td>
										<td class="width">
											
										</td>
										<td class="width">
											
										</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="red">
											90% Junk Silver $1-$99 FV
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["D28"], 2);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["E28"], 2);
											?>											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
									</tr>
									<tr>
										<td>
											90% JS $100-$999 FV
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["D29"], 2);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["E29"], 2);
											?>
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
									</tr>
									<tr>
										<td>
											90% JS $1000+ FV
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["D30"], 2);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["E30"], 2);
											?>											
										</td>
										<td class="red">
											LP  American Silver Eagle
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["H30"], 2);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["I30"], 2);
											?>
										</td>
									</tr>
									<tr>
										<td>
											40% Junk Silver
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["D31"], 2);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["E31"], 2);
											?>
										</td>
										<td class="red">
											BU American Silver Eagle
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["H31"], 2);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["I31"], 2);
											?>
										</td>
									</tr>
									<tr>
										<td>
											VF+ Morgan & Peace
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["D32"], 2);
											?>
										</td>
										<td class="black">
											<?php 
												echo $priceClass->data["Silver"]["E32"];
											?>
										</td>
										<td>
											2017 American Silver Eagle
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["H32"], 2);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["I32"], 2);
											?>
										</td>
									</tr>
									<tr>
										<td class="red">
											Cull Morgan & Peace
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["D33"], 2);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["E33"]);
											?>
										</td>
										<td>
											2017 ASE 100+
										</td>
										<td>

										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["I33"], 2);
											?>
										</td>
									</tr>
									<tr>
										<td class="red">
											.999 1oz Silver Rnds
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["D34"], 2);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["E34"], 2);
											?>											
										</td>
										<td>
											2017 ASE 500+
										</td>
										<td>

										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["I34"], 2);
											?>
										</td>
									</tr>
									<tr>
										<td>
											100oz+ 1oz Rnds/bars
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["D35"], 2);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["E35"], 2);
											?>
										</td>
										<td>
											BU Maple/Philharmonic/Onza
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["H35"], 2);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["I35"], 2);
											?>
										</td>
									</tr>
									<tr>
										<td class="red">
											.999 1oz Silver Bars
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["D34"], 2);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["E34"], 2);
											?>											
										</td>
										<td>
											Sterling Coin/Bar
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["H36"], 2);
											?>
										</td>
										<td>

										</td>
									</tr>
									<tr>
										<td>
											Maria Theresa Thaler
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["D37"], 2);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["E37"], 2);
											?>
										</td>
										<td>
											Odd Weight/Scrap
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["H37"], 2);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Silver"]["I37"], 2);
											?>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="width2 bgcolor3">
											<a name="platinum" style="color:#fff;">Platinum</a>
										</th>
										<th class="bgcolor3" style="color:#fff;">
											Buy
										</th>
										<th class="bgcolor3" style="color:#fff;">
											Sell
										</th>
										<th class="bgcolor3" style="color:#fff;">
											
										</th>
										<th class="bgcolor3" style="color:#fff;">
											Buy
										</th>
										<th class="bgcolor3" style="color:#fff;">
											Sell
										</th>
									</tr>
									<tr>
										<td>
											
										</td>
										<td class="width">
											
										</td>
										<td class="width">
											
										</td>
										<td>
											
										</td>
										<td class="width">
											
										</td>
										<td class="width">
											
										</td>
									</tr>
									<tr>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<th class="black bgblue">
											APE Proof (w/b&p) 1 Ounce
										</th>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Platinum"]["H40"], 2);
											?>
										</td>
										<td class="black">
											ASK
										</td>
									</tr>
									<tr>
										<th class="black bgblue">
											<a href="https://chulavistacoins.com/product-inventory.php?itemType=bullion&catName=Platinum_Bullion&subCat=2016_American_Platinum_Eagle">American Platinum Eagle</a>
										</th>
										<td>
											
										</td>
										<td>
											
										</td>
										<th class="black bgblue">
											Hallmarked 1 Ounce
										</th>
										<td>

										</td>
										<td>
										</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<a href="https://chulavistacoins.com/product-for-sale.php?itemType=bullion&catName=Platinum_Bullion&subCat=2016_American_Platinum_Eagle&id=924&itemId=PB68101416">1 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Platinum"]["D41"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Platinum"]["E41"]);
											?>
										</td>
										<td>
											<a href="https://chulavistacoins.com/product-for-sale.php?itemType=bullion&catName=Platinum_Bullion&subCat=Platinum_Coins_Bars&id=981&itemId=PB73101516">Recognized bars</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Platinum"]["H42"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Platinum"]["I42"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											<a href="https://chulavistacoins.com/product-for-sale.php?itemType=bullion&catName=Platinum_Bullion&subCat=2016_American_Platinum_Eagle&id=926&itemId=PB69101416">1/2 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Platinum"]["D42"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Platinum"]["E42"], 2);
											?>
										</td>
										<td>
											<a href="https://chulavistacoins.com/product-for-sale.php?itemType=bullion&catName=Platinum_Bullion&subCat=Platinum_Coins_Bars&id=986&itemId=PB74101516">Noble (Isle of Man)</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Platinum"]["H43"]);
											?>
										</td>
										<td>

										</td>
									</tr>
									<tr>
										<td>
											<a href="https://chulavistacoins.com/product-for-sale.php?itemType=bullion&catName=Platinum_Bullion&subCat=2016_American_Platinum_Eagle&id=927&itemId=PB70101416">1/4 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Platinum"]["D43"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Platinum"]["E43"], 2);
											?>
										</td>
										<td>
											<a href="https://chulavistacoins.com/product-for-sale.php?itemType=bullion&catName=Platinum_Bullion&subCat=Platinum_Coins_Bars&id=987&itemId=PB75101516">Maple</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Platinum"]["H44"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Platinum"]["I44"]);
											?>
										</td>
									</tr>
									<tr>
										<td>
											<a href="https://chulavistacoins.com/product-for-sale.php?itemType=bullion&catName=Platinum_Bullion&subCat=2016_American_Platinum_Eagle&id=928&itemId=PB71101416">1/10 Ounce</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Platinum"]["D44"]);
											?>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Platinum"]["E44"], 2);
											?>
										</td>
										<td>
											<a href="https://chulavistacoins.com/product-for-sale.php?itemType=bullion&catName=Platinum_Bullion&subCat=Platinum_Coins_Bars&id=932&itemId=PB76101516">Generic</a>
										</td>
										<td class="black">
											<?php 
												echo display_price($priceClass->data["Platinum"]["H45"], 2);
											?>
										</td>
										<td>
											
										</td>
									</tr>
									<tr>
										<td>
											Better Date Sets
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="green bgcolor2">
											<a name="palladium" style="color:#fff;">Palladium</a>
										</th>
										<th class="bgcolor2" style="color:#fff;">
											Buy
										</th>
										<th class="bgcolor2" style="color:#fff;">
											Sell
										</th>
									</tr>
									<tr>
										<td class="bgcolor2">
											
										</td>
										<td class="width bgcolor2">
											
										</td>
										<td class="width bgcolor2">
											
										</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="black blue">
											Rec. Bars/Coins (.9999)
										</th>
											
										<th>
											
										</th>
										<th>
											
										</th>
									</tr>
									<tr>
										<td>
											1 Ounce
										</td>
										<td>
											<?php 
												echo display_price($priceClass->data["Palladium"]["buy"]);
											?>
										</td>
										<td>
											<?php 
												echo display_price($priceClass->data["Palladium"]["sell"]);
											?>
										</td>
									</tr>
								</tbody>
							</table>
				</div>
				</div>
				<!-- common-footer-start-->
		</div>
					<?php include ('common-footer.php'); ?>

		<!-- Libs -->

		<?php  include ('common-js-scripts.php'); ?>
		
		<!-- Current Page Scripts -->
		<script src="js/views/view.home.js"></script>

		<!-- Theme Initializer -->
		<script src="js/theme.js"></script>

<script>
	var tid = setInterval (function () {
		if(document.readyState == 'complete') return;
		clearInterval(tid);
	$('li#1.active').removeClass('active'),$('li#3').addClass('active');
	});
</script>
	</body>
</html>

