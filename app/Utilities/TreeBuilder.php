<?php
namespace App\Utilities;


class TreeBuilder
{
    /**
     * Builds elements as tree by their parent_id relation
     *
     * @param array $elements
     * @param int $parentId
     * @return array
     */
    public static function buildTree(array &$elements, $parentId = 0) {
        $branch = [];
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = self::buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[$element['id']] = $element;
            }
        }
        return $branch;
    }
}
