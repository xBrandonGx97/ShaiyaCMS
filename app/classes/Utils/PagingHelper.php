<?php
    namespace Classes\Utils;
	class PagingHelper{

		protected $pageIndex;
		protected $pageSize;
		protected $pageCount;
		protected $totalResults;
		protected $pageNumberArray;
		protected $currentPage;

		public $resultStart;

		protected $resultEnd;
		protected $numPageNumbersToDisplay = 20;
		protected $totalPageNumbersBeingDisplayed = 0;

		function __construct($pagingData){
			if($pagingData){
				if(!is_array($pagingData)){
	#				throw Exception('Invalid paging data.');
					throw new SystemException('Invalid paging data!',0,0,__FILE__,__LINE__);
				}

				$this->pageIndex = $pagingData['pageIndex'];
				$this->pageSize = $pagingData['pageSize'];
				$this->totalResults = $pagingData['totalResults'];

				if($this->totalResults > 0){
					$this->pageCount = ceil($this->totalResults/$this->pageSize);
				}

				$this->currentPage = $this->pageIndex+1;
				$this->resultStart = ($this->pageSize*$this->pageIndex)+1;

				if($this->resultStart+$this->pageSize < $this->totalResults){
					$this->resultEnd = ($this->currentPage*$this->pageSize);
				}
				else{
					$this->resultEnd = $this->totalResults;
				}

				// Build list of page numbers to display
				$this->pageNumberArray[1] = 1;
				for($i=$this->pageIndex,$j=$this->pageIndex+1;$this->totalPageNumbersBeingDisplayed<($this->numPageNumbersToDisplay-1) && ($i>1 || $j<$this->pageCount);$i--,$j++){
					if($j<$this->pageCount){
						$this->pageNumberArray[$j] = $j;
						$this->totalPageNumbersBeingDisplayed++;
					}
					if($i>1 && $this->totalPageNumbersBeingDisplayed < $this->numPageNumbersToDisplay-1){
						$this->pageNumberArray[$i] = $i;
						$this->totalPageNumbersBeingDisplayed++;
					}
				}

				ksort($this->pageNumberArray);
				$this->pageNumberArray[$this->pageCount] = $this->pageCount;
			}
		}
		/**
		* Getter for $resultStart
		*/
		public function getResultStart(){
			return $this->resultStart;
		}
		/**
		* Display the current page number, and the last page number, and a list of clickable page numbers.
		*/
		public function displayPageNumberOverview(){
			echo '<div class="pagination">';
			if($this->pageCount>1){
				echo '<span class="overview">Page '.$this->currentPage.' of '.$this->pageCount.' |</span>';
				foreach($this->pageNumberArray as $page){
					echo '<a class="page';
						if($page==$this->currentPage){
							echo 'selected';
						}
						echo '" href="#'.$page.'">'.$page;
					echo '</a>';
				}
			}
			$this->displayResultOverview();
			echo '</div>';
		}
		/**
		* Display the current range of results being displayed, and the total number of results.
		*/
		public function displayResultOverview(){
			echo '<span class="right">';
				echo 'Showing results '.$this->resultStart.' - '.$this->resultEnd.' of '.$this->totalResults;
			echo '</span>';
		}
	}