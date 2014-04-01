<?php
class SpModelo
{
    public function set(array $data)
    {
        foreach ($data as $k => $v) {
            $this->$k = $v;
        }
    }
}