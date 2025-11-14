<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_flowise_chatflow
 * 
 * @copyright   2025 Flowise
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

// Get the config from parent module
if ($config === false)
{
	echo '<div class="alert alert-danger">';
	echo JText::_('MOD_FLOWISE_CHATFLOW_CONFIG_ERROR');
	echo '</div>';
}
else
{
	// Add CSS
	$doc = Factory::getDocument();
	$css = <<<EOD
.flowise-chatbot-container {
	display: flex;
	flex-direction: column;
	background: #fff;
	border-radius: 4px;
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
}

.flowise-chatbot-container.flowise-theme-dark {
	background: #1e1e1e;
	color: #fff;
}

.flowise-chatbot-container iframe {
	flex: 1;
}

@media (max-width: 768px) {
	.flowise-chatbot-container {
		height: auto !important;
		min-height: 500px;
	}
}
EOD;
	
	$doc->addStyleDeclaration($css);

	// Add the class suffix if provided
	$moduleClass = trim($params->get('moduleclass_sfx', ''));
	$wrapperClass = 'mod-flowise-chatflow' . ($moduleClass ? ' ' . $moduleClass : '');
	
	// Render chatbot container
	echo '<div class="' . $wrapperClass . '">';
	echo ModFlowiseChatflowHelper::renderChatbot($config);
	echo '</div>';
	
	// Add initialization script
	$script = ModFlowiseChatflowHelper::getInitScript($config);
	$doc->addScriptDeclaration($script);
}
