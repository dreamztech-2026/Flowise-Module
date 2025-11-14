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

class ModFlowiseChatflowHelper
{
	/**
	 * Get module parameters and prepare chatbot configuration
	 *
	 * @param object $params Module parameters
	 * @return array Prepared configuration array
	 */
	public static function getConfig($params)
	{
		$config = array(
			'flowise_url' => $params->get('flowise_url', ''),
			'chatflow_id' => $params->get('chatflow_id', ''),
			'chatbot_height' => $params->get('chatbot_height', '600'),
			'chatbot_width' => $params->get('chatbot_width', '100%'),
			'theme' => $params->get('theme', 'light'),
			'show_fullscreen_button' => $params->get('show_fullscreen_button', 1),
		);

		// Validate required parameters
		if (empty($config['flowise_url']) || empty($config['chatflow_id']))
		{
			return false;
		}

		// Ensure flowise_url ends without a trailing slash
		$config['flowise_url'] = rtrim($config['flowise_url'], '/');

		// Normalize height value (add 'px' if it's numeric)
		if (is_numeric($config['chatbot_height']))
		{
			$config['chatbot_height'] .= 'px';
		}

		// Build the embed script URL
		$config['embed_url'] = $config['flowise_url'] . '/api/v1/prediction/' . $config['chatflow_id'];

		return $config;
	}

	/**
	 * Generate the HTML/CSS for the chatbot container
	 *
	 * @param array $config Configuration array
	 * @return string HTML content
	 */
	public static function renderChatbot($config)
	{
		if ($config === false)
		{
			return '<div class="alert alert-danger">' . JText::_('MOD_FLOWISE_CHATFLOW_CONFIG_ERROR') . '</div>';
		}

		$html = '';
		
		// Create container with unique ID
		$containerId = 'flowise-chatbot-' . md5(json_encode($config));
		
		$html .= '<div id="' . $containerId . '" class="flowise-chatbot-container" ';
		$html .= 'data-flowise-url="' . htmlspecialchars($config['flowise_url']) . '" ';
		$html .= 'data-chatflow-id="' . htmlspecialchars($config['chatflow_id']) . '" ';
		$html .= 'style="height: ' . htmlspecialchars($config['chatbot_height']) . '; width: ' . htmlspecialchars($config['chatbot_width']) . '; border: 1px solid #ddd; border-radius: 4px; overflow: hidden;">';
		$html .= '</div>';

		return $html;
	}

	/**
	 * Generate the JavaScript code to initialize the chatbot
	 *
	 * @param array $config Configuration array
	 * @return string JavaScript code
	 */
	public static function getInitScript($config)
	{
		if ($config === false)
		{
			return '';
		}

		$containerId = 'flowise-chatbot-' . md5(json_encode($config));
		$flowise_url = $config['flowise_url'];
		$chatflow_id = $config['chatflow_id'];
		$theme = $config['theme'];
		$showFullscreen = (int) $config['show_fullscreen_button'];

		// Generate unique variable names to avoid conflicts
		$varName = str_replace('-', '_', $containerId);

		$script = <<<EOD
(function() {
	// Wait for DOM to be ready
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initFlowiseChatbot);
	} else {
		initFlowiseChatbot();
	}

	function initFlowiseChatbot() {
		var container = document.getElementById('$containerId');
		if (!container) return;

		// Create iframe element
		var iframe = document.createElement('iframe');
		iframe.src = '$flowise_url/iframe/$chatflow_id';
		iframe.style.width = '100%';
		iframe.style.height = '100%';
		iframe.style.border = 'none';
		iframe.style.borderRadius = '4px';
		iframe.frameBorder = '0';
		iframe.allow = 'microphone; camera';
		
		// Clear container and append iframe
		container.innerHTML = '';
		container.appendChild(iframe);

		// Add CSS class for theming
		container.classList.add('flowise-theme-' + '$theme');
	}
})();
EOD;

		return $script;
	}

	/**
	 * Generate the JavaScript code to initialize the livechat widget
	 *
	 * @param array $config Configuration array
	 * @return string JavaScript code
	 */
	public static function getInitLivechatScript($config)
	{
		if ($config === false)
		{
			return '';
		}

		$containerId = 'flowise-livechat-' . md5(json_encode($config));
		$flowise_url = $config['flowise_url'];
		$chatflow_id = $config['chatflow_id'];
		$theme = $config['theme'];

		$script = <<<EOD
(function() {
	// Wait for DOM to be ready
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initFlowiseLivechat);
	} else {
		initFlowiseLivechat();
	}

	function initFlowiseLivechat() {
		var container = document.getElementById('$containerId');
		var bodyDiv = container.querySelector('.flowise-livechat-body');
		if (!container || !bodyDiv) return;

		// Create iframe element
		var iframe = document.createElement('iframe');
		iframe.src = '$flowise_url/iframe/$chatflow_id';
		iframe.style.width = '100%';
		iframe.style.height = '100%';
		iframe.style.border = 'none';
		iframe.frameBorder = '0';
		iframe.allow = 'microphone; camera';
		
		// Clear and append iframe to body
		bodyDiv.innerHTML = '';
		bodyDiv.appendChild(iframe);

		// Add CSS class for theming
		container.classList.add('flowise-theme-' + '$theme');

		// Setup event listeners
		setupLivechatControls(container);
	}

	function setupLivechatControls(container) {
		var minimizeBtn = container.querySelector('.minimize-btn');
		var closeBtn = container.querySelector('.close-btn');
		var isMinimized = false;

		// Minimize button handler
		if (minimizeBtn) {
			minimizeBtn.addEventListener('click', function(e) {
				e.stopPropagation();
				isMinimized = !isMinimized;
				
				if (isMinimized) {
					container.classList.add('minimized');
					minimizeBtn.textContent = '+';
					minimizeBtn.setAttribute('title', 'Expand');
				} else {
					container.classList.remove('minimized');
					minimizeBtn.textContent = '−';
					minimizeBtn.setAttribute('title', 'Minimize');
				}
			});
		}

		// Close button handler
		if (closeBtn) {
			closeBtn.addEventListener('click', function(e) {
				e.stopPropagation();
				container.style.display = 'none';
			});
		}

		// Restore on header click when minimized
		var header = container.querySelector('.flowise-livechat-header');
		if (header) {
			header.addEventListener('click', function() {
				if (isMinimized) {
					container.classList.remove('minimized');
					minimizeBtn.textContent = '−';
					minimizeBtn.setAttribute('title', 'Minimize');
					isMinimized = false;
				}
			});
		}
	}
})();
EOD;

		return $script;
	}
}
