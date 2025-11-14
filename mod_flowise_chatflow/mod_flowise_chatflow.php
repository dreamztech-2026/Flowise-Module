<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_flowise_chatflow
 * 
 * @copyright   2025 Flowise
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

// Include helper file
require_once dirname(__FILE__) . '/helper.php';

// Get configuration
$config = ModFlowiseChatflowHelper::getConfig($params);

// Load the layout
require ModuleHelper::getLayoutPath('mod_flowise_chatflow', $params->get('layout', 'default'));
