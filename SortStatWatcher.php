<?php
/**
 * Class SortStatWatcher
 * @author Theo Massard <massar_t@etna-alternance.net>
 */
abstract class SortStatWatcher
{
        /**
         * @var array $data             array to sort
         * @var string|null $name       name of the algorithm
         * @var float $start_time       time before execution of the sorting algorithm
         * @var float $end_time         time after execution of the sorting algorithm
         * @var int $access_nbr         nbr of times an element of the array is accessed
         * @var int $comparison_nbr     nbr of times elements are compared
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
         * @param array $data   array to sort
         * @param string $name  algorithm's name
         *
         * @return void
         */
        public function __construct($data, $name)
        {
                $this->data = $data;
                $this.SetName($name);
                $this->access_nbr = 0;
                $this->comparison_nbr = 0;
                return null;
        }

        abstract public function ExecSort();

        /**
         * Sets the name of the algorithm
         *
         * @param string $name  the algorithm's name
         */
        public function SetName($name)
        {
                $this->name = $name;
        }

        /**
         * Returns the algorithm's name
         *
         * @return string
         */
        public function GetName()
        {
                return $this->name;
        }

        /**
         * Return the execution time of the algorithm
         *
         * @return float
         */
        public function GetDuration()
        {
                return $this->end_time - $this->start_time;
        }

        /**
         * Wraps the abstract method ExecSort, aka the sorting algorithm.
         *
         * @return array
         */
        public function Compute()
        {
                $this->start_time = microtime(true);
                $sorted = $this->ExecSort();
                $this->end_time = microtime(true);
                return $sorted;
        }

        /**
         * Return the number of times an element of the $data array has been accessed.
         *
         * @return int
         */
        public function GetAccessNbr()
        {
                return $this->access_nbr;
        }

        /**
         * Return the number of times elements of the array have been compared.
         *
         * @return int
         */
        public function GetComparisonNbr()
        {
                return $this->comparison_nbr;
        }

        public function GetResults()
        {
                $tmp = array();
                $tmp['sort name'] = $this->GetName();
                /* TODO: Return JSON */
        }
}
?>
