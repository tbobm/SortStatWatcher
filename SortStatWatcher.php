<?php
/**
 * Class SortStatWatcher
 * @author Theo Massard <massar_t@etna-alternance.net>
 *
 * Base class that allows you to easily aggregate
 * informations about a sorting algorithm.
 *
 * You simply have to extend the SortStatWatcher, and
 * implement the ExecSort() method.
 *
 * Then, every time you do an action, call the following
 *
 *      action    | method to call
 * ---------------:---------------
 * Access a value | IncrAccess()
 * Compare values | IncrCompare()
 *
 * Finally, collect the informations about your script using
 * the GetResults() method.
 *
 * It will contain the number of times the data has been accessed,
 * and compared, and give you the duration of the sort.
 *
 * See README.md and Example.php for more informations.
 */
abstract class SortStatWatcher
{
        /**
         * @var array           $data           array to sort
         * @var string|null     $name           name of the algorithm
         * @var float           $start_time     time before execution
         * @var float           $end_time       time after execution
         * @var int             $access_nbr     nbr of times an element of the array is accessed
         * @var int             $comparison_nbr nbr of times elements are compared
         */
        protected $data;
        protected $name;
        protected $start_time;
        protected $end_time;
        protected $access_nbr;
        protected $comparison_nbr;

        /**
         * Class constructor.
         * 
         * @param array         $data   array to sort
         * @param string        $name   algorithm's name
         *
         * @return null
         */
        public function __construct($data, $name)
        {
                $this->data = $data;
                $this->name = $name;
                $this->access_nbr = 0;
                $this->comparison_nbr = 0;
                return (null);
        }

	/**
	 * Actual sort to implement and test.
	 * 
	 * The data to be sorted is stored in $this->data
	 *
	 *
	 * @return null
	 */
        abstract public function ExecSort();

        /**
         * Set the name of the algorithm
         *
         * @param string $name  the algorithm name
         */
        public function SetName($name)
        {
                $this->name = $name;
        }

        /**
         * Return the algorithm name
         *
         * @return string
         */
        public function GetSortName()
        {
                return ($this->name);
        }

        /**
         * Return the execution time of the algorithm
         *
         * @return float
         */
        public function GetDuration()
        {
                return ($this->end_time - $this->start_time);
        }

        /**
         * Increment the $access_nbr counter.
         *
         * @return null
         */
        public function IncrAccess($times)
        {
                if ($times > 0)
                        $this->access_nbr += $times;
        }

        /**
         * Increment the $comparison_nbr counter.
         *
         * @return null
         */
        public function IncrCompare()
        {
                ++$this->comparison_nbr;
        }

        /**
         * Wraps the abstract method ExecSort - the sorting algorithm.
         *
         * @return array
         */
        public function Compute()
        {
                $this->start_time = microtime(true);
                $sorted = $this->ExecSort();
                $this->end_time = microtime(true);
                return ($sorted);
        }

        /**
         * Return the number of times an element of the $data array has been accessed.
         *
         * @return int
         */
        public function GetAccessNbr()
        {
                return ($this->access_nbr);
        }

        /**
         * Return the number of times elements of the array have been compared.
         *
         * @return int
         */
        public function GetComparisonNbr()
        {
                return ($this->comparison_nbr);
        }

        /**
         * Return every information needed as a dictionnary
         *
         * @return array
         */
        public function GetResults()
        {
                $tmp = array();
                $tmp['name'] = $this->GetSortName();
                $tmp['duration'] = $this->GetDuration();
                $tmp['access_nbr'] = $this->GetAccessNbr();
                $tmp['comp_nbr'] = $this->GetComparisonNbr();
                return ($tmp);
        }
}
?>
