<?php
///**
// * Created by PhpStorm.
// * User: Algeneral
// * Date: 7/12/2018
// * Time: 1:58 PM
// */
// function join($firstTable, $secondTable, $firstKey, $secondKey)
//{
//    $firstTableData = self::FetchAllData($firstTable);
//    $ids = [];
//    foreach ($firstTableData as $datum) {
//        $ids[] = $datum[$firstKey];
//    }
//    $ids = implode(', ', $ids);
//    $secondTableData = self::FetchAllData($secondTable, $secondKey . ' in(' . $ids . ')');
//
//    foreach ($firstTableData as $key => $v) {
//        $joinedTableId = array_search($v['lang'], $secondTableData);
//        $id = self::searchForIndex($secondTableData, 'id', $v['lang']);
//        $firstTableData[$key][$secondTable . "_data"] = $secondTableData[$id];
//    }
//
//    dd($firstTableData);
//}
//
//function searchForIndex($array, $arrayKey, $val)
//{
//    foreach ($array as $key => $item) {
//        if ($item[$arrayKey] == $val)
//            return $key;
//    }
//}
//
//public static function join($tables, $keys)
//{
//    $firstTableData = self::FetchAllData($tables[0]);
//    unset($tables[0]);
//    foreach ($firstTableData as $k => $v) {
//        foreach ($tables as $k2 => $table) {
//            $firstTableData[$k][$table . '_data'] = self::FetchAllData($table, $keys[$k2] . "=" . $v[$keys[0]]);
//        }
//    }
//    dd($firstTableData);
//}