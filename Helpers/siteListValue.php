<?php
use Modules\Architect\Entities\Tools\SiteList;

if (!function_exists('getSiteListValue')) {

    function getSiteListValue($identifier,$option) {

      $list = SiteList::where('identifier', $identifier)->first();

      if (! $list) {
          return false;
      }

      $values = collect(json_decode($list->value, true))->mapWithKeys(function ($item, $key) {
          return [$item['value'] => $item['name']];
      });

      return isset($values[$option])?$values[$option]:false ;
    }
     
    function getSiteListValuesArray($identifier) {

      $list = SiteList::where('identifier', $identifier)->first();

      if (! $list) {
          return false;
      }

      $values = collect(json_decode($list->value, true))->mapWithKeys(function ($item, $key) {
          return [$item['value'] => $item['name']];
      });

      return $values ;
    }
}
