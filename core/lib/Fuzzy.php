<?php
	class Fuzzy {

		// usage : //very similar to the fuzzySearch function in lib/functions (compare both)
		// $fuzzy = new Fuzzy();

		// $query = 'crot';
	 	// echo '<br> query ==> '.$query.'<br>';

		// echo "<pre>"; print_r($fuzzy->search($rows, $query, 0)); echo "</pre>" ; // ['foobar']
		// echo "<pre>"; print_r($fuzzy->search($rows, $query, 1)); echo "</pre>" ; // ['foobar', 'fooba']
		// echo "<pre>"; print_r($fuzzy->search($rows, $query, 2)); echo "</pre>" ; // ['foobar', 'fooba', 'foob']
		// echo "<pre>"; print_r($fuzzy->search($rows, $query, 3)); echo "</pre>" ; // ['foobar', 'fooba', 'foob', 'foo']
	

	    /**
	     * Perform a fuzzy string searching.
	     *
	     * @param array $rows
	     * @param string $query
	     * @param integer $threshold
	     * @return array
	     */
	    public function search(array $rows, $query, $threshold = 3)
	    {
	        $matched = [];

	        foreach($rows as $row)
	        {
	            $distance = $this->calculateDistance($query, $row);

	            if ($threshold >= $distance)
	            {
	                $matched[] = [$distance, $row];
	            }
	        }

	        return $this->transformResult($this->sortMatchedStrings($matched));
	    }

	    /**
	     * Calculate the Levenshtein distance between two strings.
	     *
	     * @param string $one
	     * @param string $two
	     * @return int
	     */
	    protected function calculateDistance($one, $two)
	    {
	        return levenshtein($one, $two);
	    }

	    /**
	     * Sort the matched strings.
	     *
	     * @param array $matched
	     * @return array
	     */
	    protected function sortMatchedStrings(array $matched)
	    {
	        usort($matched, function(array $left, array $right)
	        {
	            return ($left[0] - $right[0]);
	        });

	        return $matched;
	    }

	    /**
	     * Transform a given array of matches.
	     *
	     * @param array $matched
	     * @return array
	     */
	    protected function transformResult(array $matched)
	    {
	        $iterator = function(array $element)
	        {
	            return $element[1];
	        };

	        return array_map($iterator, $matched);
	    }

	}
?>