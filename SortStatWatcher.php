<?php
namespace SortStatWatcher;

/**
 * Class SortStatWatcher
 * @author Theo Massard <massar_t@etna-alternance.net>
 */
abstract class SortStatWatcher
{
        private $data;
        private $name;
        private $start_time;
        private $end_time;
        private $access_nbr;
        private $comparison_nbr;
        /**
                * Constructor.
                * will prepare stats (Sortname, etc)
         *
         * @return void
         */
        public function __construct($data)
        {
                $this->data = $data;
                return null;
        }

        abstract public function ExecSort();

        public function SetName($name)
        {
                $this->name = $name;
        }

        public function GetName()
        {
                return $this->name;
        }

        public function GetDuration()
        {
                return $this->end_time - $this->start_time;
        }

        public function Compute()
        {
                $this->start_time = microtime(true);
                $this->ExecSort();
                $this->end_time = microtime(true);
        }

        public function GetAccessNbr()
        {
                return $this->access_nbr;
        }

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
