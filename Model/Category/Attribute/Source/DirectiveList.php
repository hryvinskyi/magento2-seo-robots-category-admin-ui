<?php
/**
 * Copyright (c) 2026. All rights reserved.
 * @author: Volodymyr Hryvinskyi <mailto:volodymyr@hryvinskyi.com>
 */

declare(strict_types=1);

namespace Hryvinskyi\SeoRobotsCategoryAdminUi\Model\Category\Attribute\Source;

use Hryvinskyi\SeoRobotsApi\Api\RobotsListInterface;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class DirectiveList extends AbstractSource
{
    public function __construct(
        private readonly RobotsListInterface $robotsList
    ) {
    }

    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [];

            // Add "Use Default" option
            $this->_options[] = [
                'value' => '',
                'label' => __('Use Category Default Robots')
            ];

            // Get basic directives from API
            $basicDirectives = $this->robotsList->getBasicDirectives();

            foreach ($basicDirectives as $directive) {
                $this->_options[] = [
                    'value' => $directive,
                    'label' => strtoupper($directive)
                ];
            }
        }

        return $this->_options;
    }

    /**
     * Get options as array for UI component
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return $this->getAllOptions();
    }
}
