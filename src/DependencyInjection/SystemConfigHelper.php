<?php
namespace App\DependencyInjection;

class SystemConfigHelper
{
    function getStatus($value = null): array {
        $returnValue = [
            '1' => 'Active',
            '2' => 'In-Active',
            '99' => 'Delete',
        ];
        
        if($value) {
            return isset($returnValue[$value])?$returnValue[$value]:[];
        } else {
            return $returnValue;
        }
    }

    function getJobType($value = null): array {
        $returnValue = [
            '1' => 'Full-time',
            '2' => 'Part-time',
            '3' => 'Freelance',
        ];
        
        if($value) {
            return isset($returnValue[$value])?$returnValue[$value]:[];
        } else {
            return $returnValue;
        }
    }
}

?>