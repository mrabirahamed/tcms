<?php

class searchModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function getWords() {
        $word = $this->query("select * from " . DbPREFIX . "dict");
        return $word->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWord($q) {
        $word = $this->query("select * from " . DbPREFIX . "dict where word LIKE '%$q%' OR r_word LIKE '%$q%' OR meaning LIKE '%$q%'");
        return $word->fetchAll(PDO::FETCH_ASSOC);

    }

}