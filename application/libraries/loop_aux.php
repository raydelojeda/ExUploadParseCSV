<?php
if ($chain == '')
    $chain = $key;
else
    $chain = $chain . '_' . $key;

if($print==1)echo '<br>field_tag: ' . $chain . '_t > TAG: ' . $key .' '. '<br><br>';//var_dump($val[0]);echo '<br>';

if ($val->count() == 0 && $val != '')
{

    if ($str_fields == '')
        $str_fields = $chain . '_t:^:^:' . $val . '';
    else
        $str_fields = $str_fields . '|^|^|' . $chain . '_t:^:^:' . $val . '';

    if($print==1)echo '<br>field_tag: ' . $chain . '_t > TAG: ' . $key .' value_inside_tag:'.$val. '<br><br>';
}

$str_fields = $this->Loop_Attr($str_fields, $chain, $val);

if ($val->count())
{
    $level++;
    $arr_fields = $this->loop_tags($val, $start_tag_name, $tag_excluded, $tag_included, $chain, $str_fields, $fields, $level, $print);
    $str_fields = $arr_fields[0];
    $fields = $arr_fields[1];
    $level = $arr_fields[2];
}

$chain = $this->Delete_Last($chain);

if (in_array($key, $start_tag_name) && $level == '1')
{
    //echo 'fields: '.$level.' '.$str_fields.'<br><br><br>';
    $fields[] = $str_fields;
}