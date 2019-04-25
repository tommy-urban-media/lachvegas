<?php


class CSVReader {

    protected $_file;
    protected $_data;
    protected $_headers;

    public function __construct($file = '') {
        $this->_file = $file;
    }

    public function readAll() {

        $file = fopen($this->_file, 'r');
        while (!feof($file)) {
            $this->_data[] = fgetcsv($file,null,';');
        }
        
        /*
        while (($line = fgetcsv($file, 10000, ","))  !== FALSE) {
            if (is_array($line) && count($line) === 1) {
                if (strlen($line[0]) >= 1) {
                    $this->_data[] = $line[0];
                }
            }
        }
        */
        fclose($file);
    
    }

    public function prepareData() {

        $headers = $this->_data[0];

        unset($this->_data[0]);

        for ($i=1; $i<count($this->_data)-1; $i++) {
			// $data = $this->splitLine($this->_data[$i]);
            $array = new stdClass();

            for ($j=0; $j<count($headers)-1; $j++) {
                $array->{$headers[$j]} = $this->_data[$i][$j];
            }

            $this->_data[$i] = $array;
        }
    }

    public function getData() {
        $this->prepareData();
        return $this->_data;
    }


    private function splitLine($line, $delimiter = ';') {
		return explode($delimiter, $line);
	}

}