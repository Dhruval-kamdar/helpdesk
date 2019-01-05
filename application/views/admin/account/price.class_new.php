<?php
	
	class Price {
		private $dbConnection;
		private $priceGold = -1;
		private $priceSilv = -1;
		private $pricePlat = -1;
		private $pricePall = -1;
		
    	/**  Location for overloaded data.  */
    	public $data = array();
    	public $metal = array();

		public function __construct($dbConnection) {
			$this->dbConnection = $dbConnection;
			//$this->getMetalPriceArray();
		}

		public function getMetalPriceArray() {
			error_log(">>>" . "getMetalPriceArray"); // hbe
			$data = array();
			if (false){ // unreliable
				if ($result = $this->getMetalPriceRequest()) {
					while ($row = $result->fetch_assoc()) {
						error_log(print_r($row,true));
						$row["price"] = str_replace( ',', '', $row["price"]);
						$this->data[$row["title"]] = $row;
						$data[] = $row;
					}
				}
			} else{
				$sql = $this->getPriceByMetalSQL("Gold", 1);
				$result = $this->dbConnection->query($sql);
				if ($result){
					$row = $result->fetch_assoc();
					$this->priceGold = $row["price"] = trim(str_replace( ',', '', $row["price"]));
					$this->data[$row["title"]] = $row;
					$data[] = $row;
				} else
					error_log("sql error " . $sql);

				$sql = $this->getPriceByMetalSQL("Silver", 2);
				$result = $this->dbConnection->query($sql);
				if ($result){
					$row = $result->fetch_assoc();
					$this->priceSilv = $row["price"] = trim(str_replace( ',', '', $row["price"]));
					$this->data[$row["title"]] = $row;
					$data[] = $row;
				} else
					error_log("sql error " . $sql);

				$sql = $this->getPriceByMetalSQL("Platinum", 3);
				$result = $this->dbConnection->query($sql);
				if ($result){
					$row = $result->fetch_assoc();
					$this->pricePlat = $row["price"] = trim(str_replace( ',', '', $row["price"]));
					$this->data[$row["title"]] = $row;
					$data[] = $row;
				} else
					error_log("sql error " . $sql);

				$sql = $this->getPriceByMetalSQL("Palladium", 4);
				$result = $this->dbConnection->query($sql);
				if ($result){
					$row = $result->fetch_assoc();
					$this->priceGold = $row["price"] = trim(str_replace( ',', '', $row["price"]));
					$this->data[$row["title"]] = $row;
					$data[] = $row;
				} else
					error_log("sql error " . $sql);
			}
			return $data;
		}

		private function getPriceByMetalSQL($metal, $id) {
			$sql = "select metalId AS id, \"" . $metal . "\" AS \"title\", price from price where metalId = " . $id . " ORDER BY dateUpdated DESC LIMIT 1;";
			return $sql;
		}
		
		public function getMetalPriceRequest() {
			$sql = "SELECT m.id, m.title, t1.price FROM price t1 INNER JOIN metal m ON t1.metalId = m.id WHERE t1.dateUpdated = (SELECT MAX(t2.dateUpdated) FROM price t2 WHERE t2.metalId = t1.metalId)";
/*			$sql = "SELECT m.id, m.title, t1.price
							FROM price t1
							INNER JOIN metal m ON t1.metalId = m.id
							WHERE t1.dateUpdated = (SELECT MAX(t2.dateUpdated)
	                 FROM price t2
	                 WHERE t2.metalId = t1.metalId)"; */
			//$result = $this->dbConnection->query($sql, MYSQLI_USE_RESULT);
			$result = $this->dbConnection->query($sql);
			return $result;			
		}

		public function getMetalCurrentPriceArray() {
			$data = array();
			if ($result = $this->getMetalCurrentPriceRequest()) {
				while ($row = $result->fetch_assoc()) {
					$this->data[$row["title"]] = $row;
					$data[] = $row;
				}
			}
			return $data;
		}
		
		public function getMetalCurrentPriceRequest() {
			$sql = "SELECT m.id, m.title, t1.price
							FROM currentPrice t1
							INNER JOIN metal m ON t1.metalId = m.id
							WHERE t1.dateUpdated = (SELECT MAX(t2.dateUpdated)
	                 FROM price t2
	                 WHERE t2.metalId = t1.metalId)";
			$result = $this->dbConnection->query($sql);
			return $result;			
		}

		public function testGoldPrices() {
			error_log("checking gold price: " . $this->data["Gold"]["price"]);
		}


		public function getGoldPrices() {
			$price = $this->priceGold;
			if ($this->priceGold < 0){
				error_log("price: ($price)");
				var_dump(debug_backtrace());
				die();

			}

			$this->data["Gold"]["D06"] = floor($price * (double)1.005);
			$this->data["Gold"]["D07"] = floor($price * (double)0.5);
			$this->data["Gold"]["D08"] = floor($price * 0.258);
			$this->data["Gold"]["D09"] = floor($price * 0.1035);
			$this->data["Gold"]["D10"] = floor($this->data["Gold"]["D06"] + 10);
			$this->data["Gold"]["D12"] = floor($price * 1.011);
			$this->data["Gold"]["D13"] = floor($price * 0.94);
			$this->data["Gold"]["D14"] = floor($price + 30);
			$this->data["Gold"]["D16"] = floor($price * 0.995);
			$this->data["Gold"]["D17"] = floor($price * 0.499);
			$this->data["Gold"]["D18"] = floor($price * 1.02/4);
			$this->data["Gold"]["D19"] = floor($price * 1.01/10);
			$this->data["Gold"]["D20"] = floor($price * 0.9);
			$this->data["Gold"]["D22"] = floor($price * 0.989);
			$this->data["Gold"]["D23"] = floor($price * 0.50);
			$this->data["Gold"]["D24"] = floor($price * 0.25);
			$this->data["Gold"]["D25"] = floor($price * 0.0999);

			$this->data["Gold"]["E06"] = ceil($price + 80);
			$this->data["Gold"]["E07"] = ceil($this->data["Gold"]["E06"] * 0.52);
			$this->data["Gold"]["E08"] = ceil($this->data["Gold"]["E06"] * 0.275);
			$this->data["Gold"]["E09"] = ceil($this->data["Gold"]["E06"] * .11);
			$this->data["Gold"]["E10"] = "ASK";			
			$this->data["Gold"]["E12"] = ceil($price + 110);
			$this->data["Gold"]["E13"] = floor($price * 1.05);
			$this->data["Gold"]["E14"] = "ASK";
			$this->data["Gold"]["E16"] = ceil($price + 75);
			$this->data["Gold"]["E17"] = ceil($this->data["Gold"]["E16"] * 0.5225);
			$this->data["Gold"]["E18"] = ceil($this->data["Gold"]["E16"] * 0.28);
			$this->data["Gold"]["E19"] = ceil($this->data["Gold"]["E16"] * 0.111);
			$this->data["Gold"]["E22"] = ceil($price + 95);
			$this->data["Gold"]["E23"] = ceil(($price + 95) * 0.55);
			$this->data["Gold"]["E24"] = ceil($this->data["Gold"]["E22"] * 0.28);
			$this->data["Gold"]["E25"] = ceil($price * 0.12);
			
			$this->data["Gold"]["H06"] = floor($price);
			$this->data["Gold"]["H07"] = floor($price * 0.5);
			$this->data["Gold"]["H08"] = floor($price * (1.03/4));
			$this->data["Gold"]["H09"] = floor($price * (1.03/10));
			$this->data["Gold"]["H10"] = floor($price * (1.02/20));
			
			$this->data["Gold"]["H12"] = floor($price * 1.1725);
			$this->data["Gold"]["H13"] = floor($price * 0.46);
			$this->data["Gold"]["H14"] = floor($price * 0.2314687);
			$this->data["Gold"]["H15"] = floor($price * 0.115);
			$this->data["Gold"]["H16"] = $price * 0.056625;
			$this->data["Gold"]["H17"] = $price * 0.046;
			$this->data["Gold"]["H19"] = floor($price * 0.975);
			$this->data["Gold"]["H20"] = $price * 0.643086816 * 0.97;
			$this->data["Gold"]["H21"] = $price * 0.321543408 * 0.97;
			$this->data["Gold"]["H22"] = $price * 0.160771704 * 0.96;
			$this->data["Gold"]["H23"] = $price * 0.080385852 * 0.95;
			$this->data["Gold"]["H24"] = $price * 0.030512;
			$this->data["Gold"]["H25"] = floor($price * 0.945);
			

			$this->data["Gold"]["I06"] = ceil($this->data["Gold"]["E06"] + 10);
			$this->data["Gold"]["I07"] = ceil($this->data["Gold"]["E07"] + 5);
			$this->data["Gold"]["I08"] = ceil($this->data["Gold"]["E08"] + 5);
			$this->data["Gold"]["I09"] = ceil($this->data["Gold"]["E09"] + 5);
			$this->data["Gold"]["I10"] = ceil($price * 0.087);
			
			$this->data["Gold"]["I12"] = ceil($price * 1.23);
			$this->data["Gold"]["I13"] = $price * 0.515;
			$this->data["Gold"]["I14"] = $price * 0.2575;
			$this->data["Gold"]["I15"] = $price * 0.1265312;
			$this->data["Gold"]["I16"] = $price * 0.0762812;
			$this->data["Gold"]["I17"] = $price * 0.0649687;
			$this->data["Gold"]["I19"] = ceil($price + 70);
			$this->data["Gold"]["I20"] = $price * 0.643086816 * 1.1;
			$this->data["Gold"]["I21"] = $price * 0.321543408 * 1.125;
			$this->data["Gold"]["I22"] = $price * 0.160771704 * 1.2;
			$this->data["Gold"]["I23"] = $price * 0.080385852 * 1.3;
			$this->data["Gold"]["I24"] = $price * 0.0457812;
			$this->data["Gold"]["I25"] = $this->data["Gold"]["I17"];
		}
		
		public function getSilverPrices() {
			$price = $this->priceSilv;
			if ($this->priceSilv < 0){
				error_log("price: ($price)");
				var_dump(debug_backtrace());
				die();

			}

			$this->data["Silver"]["D28"] = $price * 0.715 - 0.1 - 0.55 - 0.25;
			$this->data["Silver"]["D29"] = $price * 0.715 - 0.1 - 0.55;
			$this->data["Silver"]["D30"] = $price * 0.715 - 0.1;	
			$this->data["Silver"]["D31"] = $price * 0.295 * 0.85;
			$this->data["Silver"]["D32"] = $price * 0.78;
			$this->data["Silver"]["D33"] = $price * 0.76;
			$this->data["Silver"]["D34"] = $price - 0.75;
			$this->data["Silver"]["D35"] = $price - 0.50;
			$this->data["Silver"]["D37"] = $price * 0.7515 * 0.85;
			
			$this->data["Silver"]["E30"] = ($price + 3.75) * 0.715;
			$this->data["Silver"]["E31"] = $price * 0.295 * 1.12;
			$this->data["Silver"]["E32"] = "see case";
			$this->data["Silver"]["E33"] = ($price * .77) * 1.55;
			$this->data["Silver"]["E34"] = $price + 3.5;
			$this->data["Silver"]["E35"] = $price + 3;
			$this->data["Silver"]["E37"] = $price *0.7515 * 1.1;
			$this->data["Silver"]["E29"] = $this->data["Silver"]["E30"] + 0.25;
			$this->data["Silver"]["E28"] = $this->data["Silver"]["E29"] + 0.25;
			
			$this->data["Silver"]["H28"] = "";
			$this->data["Silver"]["H29"] = "";
			$this->data["Silver"]["H30"] = $price - 0.5;
			$this->data["Silver"]["H31"] = $price * 1.001;
			$this->data["Silver"]["H32"] = $price * 1.001;
			$this->data["Silver"]["H33"] = "";
			$this->data["Silver"]["H34"] = "";
			$this->data["Silver"]["H35"] = $price * 0.98;
			$this->data["Silver"]["H36"] = $price * 0.7;
			$this->data["Silver"]["H37"] = $price * 0.7;
			
//			$this->data["Silver"]["I28"] = $this->data["Silver"]["price"];
//			$this->data["Silver"]["I29"] = $this->data["Silver"]["price"];
			$this->data["Silver"]["I30"] = $price + 3.25;
			$this->data["Silver"]["I31"] = $price + 3.75;
			$this->data["Silver"]["I32"] = $price + 4.35;
			$this->data["Silver"]["I33"] = $this->data["Silver"]["I32"] - 0.2;
			$this->data["Silver"]["I34"] = $this->data["Silver"]["I33"] - 0.15;
			$this->data["Silver"]["I35"] = $price + 4;
			$this->data["Silver"]["I37"] = $price * 1.05;
			
		}

		public function getPlatinumPrices() {
			$price = $this->pricePlat;
			if ($this->pricePlat < 0){
				error_log("price: ($price)");
				var_dump(debug_backtrace());
				die();

			}

			$this->data["Platinum"]["D41"] = floor($price * 0.999);
			$this->data["Platinum"]["D42"] = floor($price * 0.499);
			$this->data["Platinum"]["D43"] = floor($price * 0.249);
			$this->data["Platinum"]["D44"] = floor($price * 0.0999);
			
			$this->data["Platinum"]["E41"] = ceil($price + 100);
			$this->data["Platinum"]["E42"] = $price * 0.579;
			$this->data["Platinum"]["E43"] = $price * 0.29;
			$this->data["Platinum"]["E44"] = $price * 0.12;
			
			$this->data["Platinum"]["H40"] = floor($price);
			$this->data["Platinum"]["H42"] = floor($price * 0.955);
			$this->data["Platinum"]["H43"] = floor($price * 0.955);
			$this->data["Platinum"]["H44"] = floor($price * 0.955);
			$this->data["Platinum"]["H45"] = floor($price * 0.955) * 0.96;
			
			$this->data["Platinum"]["I42"] = ceil($price + 100);
			$this->data["Platinum"]["I44"] = ceil($price + 110);
			
		}
		
		public function getPalladiumPrices() {
			$price = $this->pricePall;
			if ($this->pricePall < 0){
				error_log("price: ($price)");
				var_dump(debug_backtrace());
				die();
			}

			$this->data["Palladium"]["buy"] = floor($price - 30);

			$this->data["Palladium"]["sell"] = ceil($price + 30);
		}

		public function insertNewPrice($metalId, $price) {
			$sql = sprintf("INSERT INTO price (metalId, price, dateUpdated) VALUES (%s, '%s', now())", $metalId, $price);
			$result = $this->dbConnection->query($sql);
			$sql = sprintf("INSERT INTO currentPrice (metalId, price) VALUES (%s, '%s')", $metalId, $price);
			$result = $this->dbConnection->query($sql);
		}
		
		public function clearCurrentPrices() {
			$sql = sprintf("DELETE FROM currentPrice");
			$result = $this->dbConnection->query($sql);
		}
		
		public function setMetalID($metal, $id) {
			$this->metal[$id] = $metal;
		}
		
		public function getPrice($string){
			$nStartPos = null;
			$nEndPos = null;
			$needleOne = '<div class="banner_table">';
			$needleTwo = "<!--[if !IE]> Start Chart Box <![endif]-->";
			//$needleOne = "<!--[if !IE]> Start Current Spot Price <![endif]-->";
			//$needleTwo = "<!--[if !IE]> End Current Spot Price <![endif]-->";
			$nStartPos = strpos($string, $needleOne);
			echo $nStartPos;
			/*if($nStartPos > 0){
				$nEndPos = strpos($string, $needleTwo);
				$newString = substr($string, $nStartPos + strlen($needleOne), $nEndPos-$nStartPos-strlen($needleOne)); 				
			} else {
				return 0;
			}
			$xml = new SimpleXMLElement($newString);
			$id = -1;

			foreach($xml->div as $div){
				$id = array_search($div->span[0], $this->metal);
				
				//error_log("ID: " . $id);
				//error_log($div);
				//echo $div->span[0], " ", $div->span[2], "<br />";
				
				$this->insertNewPrice($id, str_replace( ',', '', $div->span[2]));
				$id = -1;
			}
			echo $nStartPos, "\n", $nEndPos, "\n", $newString, "\n"; */
		}

		public function extractPriceGold($remotehtml){
			$this->priceGold = $this->extractPrice($remotehtml, "Gold");
			if ($this->priceGold <= 0){
				error_log("error extracting gold price from remote html: price = [" . $this->priceGold . "]");
				die();
			}
			return $this->priceGold;
		}
		public function extractPriceSilv($remotehtml){
			$this->priceSilv = $this->extractPrice($remotehtml, "Silv");
			if ($this->priceSilv <= 0){
				error_log("error extracting silver price from remote html: price = [" . $this->priceSilv . "]");
				die();
			}
			return $this->priceSilv;
		}
		public function extractPricePlat($remotehtml){
			$this->pricePlat = $this->extractPrice($remotehtml, "Plat");
			if ($this->pricePlat <= 0){
				error_log("error extracting platinum price from remote html: price = [" . $this->pricePlat . "]");
				die();
			}
			return $this->pricePlat;
		}
		public function extractPricePall($remotehtml){
			$this->pricePall = $this->extractPrice($remotehtml, "Pall");
			if ($this->pricePall <= 0){
				error_log("error extracting palladium price from remote html: price = [" . $this->pricePall . "]");
				die();
			}
			return $this->pricePall;
		}

		public function extractPrice($string, $metal){
			$nStartPos = null;
			$nEndPos = null;
			$newString = null;
			$price = null;
			$nStartPos = strpos($string, "<div id=\"container_right_column\" class=\"col-md-2 hidden-xs hidden-sm nocontent\">");
			if($nStartPos > 0){
				$nEndPos = strpos($string, "Start Chart Box");
				$newString = substr($string, $nStartPos, $nEndPos-$nStartPos); 	
			} else {
				return 0;
			}
			//echo "I got to here ", $nEndPos, " ", __LINE__, "\n";
              //echo htmlspecialchars($newString)."<br /><br />";
			$nStartPos = strpos($newString, $metal);
			$nEndPos = strpos($newString, " </div>", $nStartPos);
			$newString = substr($newString, $nStartPos, $nEndPos - $nStartPos);
              //echo htmlspecialchars($newString)."<br /><br />"; 
			  $newVar = strip_tags($newString);
			  $newVar = preg_replace( '/\s+/', ' ', $newVar );
			  $newVar = trim($newVar);
			  $var = @split(" ",$newVar);
			  //print_r($var);
			/*$nStartPos = strpos($newString, ">");
			die();
			$nStartPos = strpos($newString, "\">", $nStartPos);
				echo "$nStartPos.. \n";
			$nEndPos = strpos($newString, "</span>", $nStartPos);
				echo "$nEndPos \n";
			$price = substr($newString,$nStartPos+2, $nEndPos - ($nStartPos + 2));
			echo "printing ".$price." break";
			$response = str_replace( ',', '', $price ); */
			return str_replace( ',', '', $var[2]);
		}
		
		public function __set($name, $value)
		{
			echo "Setting '$name' to '$value'\n";
			$this->data[$name] = $value;
		}
	}
?>