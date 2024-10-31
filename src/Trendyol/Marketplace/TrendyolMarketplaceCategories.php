<?php

	namespace Hasokeyk\Trendyol\Marketplace;

	class TrendyolMarketplaceCategories{

		public  $supplierId;
		public  $username;
		public  $password;
		private $trendyol;

		function __construct($trendyol){
			$this->supplierId = $trendyol->supplierId;
			$this->username   = $trendyol->username;
			$this->password   = $trendyol->password;
			$this->trendyol   = $trendyol;
		}

		private function request(){
			return $this->trendyol->request;
		}

		private function product(){
			return new TrendyolMarketplaceProducts($this->trendyol);
		}

		public function get_categories(){
			$url    = 'https://api.trendyol.com/sapigw/product-categories';
			$result = $this->request()->get($url);
			return $result;
		}


		public function get_category_info($category_id = null){
			$url    = 'https://api.trendyol.com/sapigw/product-categories/'.$category_id.'/attributes';
			$result = $this->request()->get($url);
			return $result;
		}

		public function get_category_attr($category_id = null, $attr_id = null){
			$get_category_info = $this->get_category_info($category_id);
			if(isset($get_category_info->body->categoryAttributes)){
				foreach($get_category_info->body->categoryAttributes as $attr){
					if($attr->attribute->id == $attr_id){
						return $attr;
					}
				}
			}
			return false;
		}

		public function get_product_parent_cat_list($barcode = null){
			$product        = $this->product()->get_my_product($barcode);
			$product_cat_id = $product->body->content[0]->pimCategoryId;
			$all_cat        = $this->get_categories();
			return $this->find_parent_categories($all_cat->body->categories, $product_cat_id);
		}

		public function search_category_attr_values($category_id = null, $attr_id = null, $search_text = null, $key = 'name'){
			$all_values        = null;
			$get_category_info = $this->get_category_info($category_id);
			foreach($get_category_info->body->categoryAttributes as $a_id => $attr){
				if($attr->attribute->id == $attr_id){
					$attr_values   = $get_category_info->body->categoryAttributes[$a_id]->attributeValues;
					$search_result = $this->array_search_cat_in_attr_value($attr_values, $search_text, $key);
					if($search_result != null){
						$all_values = $search_result;
					}
					break;
				}
			}

			return $all_values;
		}

		private function array_search_cat_in_attr_value(array $arr, string $patron, $key = 'name'): array{
			$patron = strstr('%', $patron) ? $patron : $patron.'%';
			return array_filter($arr, static function($value) use ($patron, $key): bool{
				return 1 === preg_match(sprintf('/^%s$/i', preg_replace('/(^%)|(%$)/', '.*', $patron)), $value->{$key});
			});
		}

		public $trendyol_array_search_result = null;

		public function trendyol_array_search($data = [], $key = null, $value = null){
			if(isset($data) and $data != null){

				foreach($data as $category){

					if(gettype($category) == 'array'){
						if(isset($category[$key]) and ($category[$key] == $value or $this->calculateSimilarityScore($category[$key], $value) > 80)){
							$this->trendyol_array_search_result = $category;
						}

						if(isset($category['Nodes']) and $category['Nodes'] != null){
							$this->trendyol_array_search($category['Nodes'], $key, $value);
						}
					}
					else if(gettype($category) == 'object'){
						if(isset($category->{$key}) and ($category->{$key} == $value or $this->calculateSimilarityScore($category->{$key}, $value) > 80)){
							$this->trendyol_array_search_result = $category;
						}

						if(isset($category->subCategories) and $category->subCategories != null){
							$this->trendyol_array_search($category->subCategories, $key, $value);
						}
					}
				}
			}
			else{
				return 2;
			}
			return $this->trendyol_array_search_result;
		}

		private function calculateSimilarityScore($string1, $string2){

			$string1 = str_replace(['\u0026', '&'], ['&', ' ve '], htmlspecialchars_decode($string1));
			$string2 = str_replace(['\u0026', '&'], ['&', ' ve '], htmlspecialchars_decode($string2));

			$levenshteinDistance = levenshtein($string1, $string2);
			$maxLength           = max(strlen($string1), strlen($string2));

			$similarityScore = 100 * (1 - $levenshteinDistance / $maxLength);

			return $similarityScore;
		}


		function find_parent_categories($categories, $category_id){
			foreach($categories as $category){
				if($category->id == $category_id){
					$breadcrumb[] = [
						'id'   => $category->id,
						'name' => $category->name
					];
					$parentId     = $category->parentId;
					while($parentId > 0){
						$parentCategory = $this->find_category_by_id($categories, $parentId);
						if($parentCategory){
							array_unshift($breadcrumb, ['id' => $parentCategory->id, 'name' => $parentCategory->name]);
							$parentId = $parentCategory->parentId;
						}
						else{
							break;
						}
					}
					return $breadcrumb;
				}
				if(!empty($category->subCategories)){
					$breadcrumb = $this->find_parent_categories($category->subCategories, $category_id);
					if(!empty($breadcrumb)){
						array_unshift($breadcrumb, ['id' => $category->id, 'name' => $category->name]);
						return $breadcrumb;
					}
				}
			}
			return [];
		}

		function find_category_by_id($categories, $category_id){
			foreach($categories as $category){
				if($category->id == $category_id){
					return $category;
				}
			}
			return null;
		}

	}