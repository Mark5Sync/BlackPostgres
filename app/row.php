<?php


$dd = new class {
    private $result = [];

    function row(?int &$id, ?string &$user, &...$props) {

        foreach (['id' => &$id, 'user' => &$user, ...$props] as $coll => &$prop) {
            $this->result[$coll] = &$prop;
        }

    }

    function fetchRow()  {
        foreach ($this->result as $coll => &$prop) {
            switch ($coll) {
                case 'id':
                    $prop = 555;
                    break;
                case 'user';
                    $prop = 'Иванов Иван';
                break;
                default:
                    $prop = $coll;
                break;
            }
        }
    }
};

$dd->row(id: $id, user: $user);

echo "user: $user ($id)\n";


$dd->fetchRow();


echo "user: $user ($id)\n";
