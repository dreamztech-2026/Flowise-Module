<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_flowise_chatflow
 * @layout      livechat
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
	// Add CSS for livechat widget
	$doc = Factory::getDocument();
	$css = <<<EOD
/* Flowise Livechat Widget Styling */
.mod-flowise-chatflow-livechat {
	position: fixed;
	bottom: 0;
	right: 0;
	width: 100%;
	height: 100%;
	pointer-events: none;
	z-index: 999;
}

.flowise-livechat-container {
	position: fixed;
	bottom: 20px;
	right: 20px;
	width: 380px;
	height: 600px;
	border-radius: 12px;
	box-shadow: 0 5px 40px rgba(0, 0, 0, 0.16);
	background: #fff;
	display: flex;
	flex-direction: column;
	overflow: hidden;
	pointer-events: all;
	animation: slideUp 0.3s ease-out;
	transition: all 0.3s ease;
	z-index: 1000;
}

.flowise-livechat-container.flowise-theme-dark {
	background: #1e1e1e;
	color: #fff;
}

/* Header */
.flowise-livechat-header {
	background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
	color: white;
	padding: 16px;
	display: flex;
	justify-content: space-between;
	align-items: center;
	flex-shrink: 0;
	border-radius: 12px 12px 0 0;
}

.flowise-livechat-header h3 {
	margin: 0;
	font-size: 16px;
	font-weight: 600;
	letter-spacing: 0.5px;
}

.flowise-livechat-header .close-btn {
	background: rgba(255, 255, 255, 0.2);
	border: none;
	color: white;
	cursor: pointer;
	border-radius: 4px;
	width: 32px;
	height: 32px;
	display: flex;
	align-items: center;
	justify-content: center;
	transition: background 0.2s;
	font-size: 20px;
	padding: 0;
}

.flowise-livechat-header .close-btn:hover {
	background: rgba(255, 255, 255, 0.3);
}

.flowise-livechat-header .minimize-btn {
	background: rgba(255, 255, 255, 0.2);
	border: none;
	color: white;
	cursor: pointer;
	border-radius: 4px;
	width: 32px;
	height: 32px;
	display: flex;
	align-items: center;
	justify-content: center;
	transition: background 0.2s;
	font-size: 18px;
	padding: 0;
	margin-right: 8px;
}

.flowise-livechat-header .minimize-btn:hover {
	background: rgba(255, 255, 255, 0.3);
}

/* Chat Body */
.flowise-livechat-body {
	flex: 1;
	overflow: hidden;
	display: flex;
	flex-direction: column;
}

.flowise-livechat-body iframe {
	flex: 1;
	border: none;
	width: 100%;
	height: 100%;
	border-radius: 0;
}

/* Minimized State */
.flowise-livechat-container.minimized {
	width: auto;
	height: auto;
	bottom: 20px;
	right: 20px;
}

.flowise-livechat-container.minimized .flowise-livechat-body {
	display: none;
}

.flowise-livechat-container.minimized .flowise-livechat-header {
	border-radius: 12px;
	padding: 12px 16px;
	cursor: pointer;
}

.flowise-livechat-container.minimized .flowise-livechat-header h3 {
	font-size: 14px;
}

.flowise-livechat-container.minimized .minimize-btn {
	display: none;
}

/* Badge for unread messages */
.flowise-livechat-badge {
	position: absolute;
	top: -8px;
	right: -8px;
	background: #ff4757;
	color: white;
	border-radius: 50%;
	width: 24px;
	height: 24px;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 12px;
	font-weight: bold;
	border: 2px solid white;
}

/* Toggle button (when minimized) */
.flowise-livechat-toggle {
	display: none;
	position: fixed;
	bottom: 20px;
	right: 20px;
	width: 56px;
	height: 56px;
	border-radius: 50%;
	background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
	border: none;
	color: white;
	font-size: 24px;
	cursor: pointer;
	box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
	display: flex;
	align-items: center;
	justify-content: center;
	transition: all 0.3s ease;
	z-index: 1001;
	pointer-events: all;
}

.flowise-livechat-toggle:hover {
	transform: scale(1.1);
	box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
}

.flowise-livechat-toggle.hidden {
	display: none !important;
}

/* Animations */
@keyframes slideUp {
	from {
		opacity: 0;
		transform: translateY(30px);
	}
	to {
		opacity: 1;
		transform: translateY(0);
	}
}

@keyframes pulse {
	0% {
		transform: scale(1);
	}
	50% {
		transform: scale(1.05);
	}
	100% {
		transform: scale(1);
	}
}

.flowise-livechat-toggle.pulse {
	animation: pulse 1.5s ease-in-out infinite;
}

/* Responsive Design */
@media (max-width: 768px) {
	.flowise-livechat-container {
		width: 100%;
		height: 100%;
		bottom: 0;
		right: 0;
		border-radius: 0;
		max-width: none;
		box-shadow: none;
	}

	.flowise-livechat-header {
		border-radius: 0;
	}

	.flowise-livechat-container.minimized {
		display: none;
	}

	.flowise-livechat-toggle {
		width: 48px;
		height: 48px;
		font-size: 20px;
	}
}

@media (max-width: 480px) {
	.flowise-livechat-container {
		width: 100%;
		height: 100%;
		bottom: 0;
		right: 0;
	}

	.flowise-livechat-toggle {
		width: 44px;
		height: 44px;
		bottom: 16px;
		right: 16px;
	}
}

/* Dark theme override */
.flowise-livechat-container.flowise-theme-dark .flowise-livechat-header {
	background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
	border-bottom: 1px solid #333;
}

.flowise-livechat-container.flowise-theme-dark .flowise-livechat-header .close-btn,
.flowise-livechat-container.flowise-theme-dark .flowise-livechat-header .minimize-btn {
	background: rgba(255, 255, 255, 0.1);
}

.flowise-livechat-container.flowise-theme-dark .flowise-livechat-header .close-btn:hover,
.flowise-livechat-container.flowise-theme-dark .flowise-livechat-header .minimize-btn:hover {
	background: rgba(255, 255, 255, 0.2);
}
EOD;
	
	$doc->addStyleDeclaration($css);

	// Add the class suffix if provided
	$moduleClass = trim($params->get('moduleclass_sfx', ''));
	$wrapperClass = 'mod-flowise-chatflow-livechat' . ($moduleClass ? ' ' . $moduleClass : '');
	
	// Render livechat container
	echo '<div class="' . $wrapperClass . '">';
	echo '<div id="' . 'flowise-livechat-' . md5(json_encode($config)) . '" class="flowise-livechat-container" data-flowise-url="' . htmlspecialchars($config['flowise_url']) . '" data-chatflow-id="' . htmlspecialchars($config['chatflow_id']) . '">';
	echo '<div class="flowise-livechat-header">';
	echo '<h3>' . JText::_('MOD_FLOWISE_CHATFLOW_LIVECHAT_TITLE') . '</h3>';
	echo '<div style="display: flex; gap: 8px;">';
	echo '<button class="minimize-btn" aria-label="Minimize" title="Minimize">−</button>';
	echo '<button class="close-btn" aria-label="Close" title="Close">✕</button>';
	echo '</div>';
	echo '</div>';
	echo '<div class="flowise-livechat-body"></div>';
	echo '</div>';
	echo '</div>';
	
	// Add initialization script for livechat
	$script = ModFlowiseChatflowHelper::getInitLivechatScript($config);
	$doc->addScriptDeclaration($script);
}
