# Joomla Flowise Chatflow Module

A Joomla module to easily embed Flowise chatflow into your Joomla website.

## Features

- 🤖 Easy embedding of Flowise chatflows
- ⚙️ Configurable URL and Chatflow ID
- 📐 Customizable height and width
- 🎨 Light and dark theme support
- 📱 Responsive design
- 🔒 Secure parameter handling
- 🌐 Multi-language support (currently English)

## Installation

### Prerequisites

- Joomla 4.0 or higher
- A running Flowise instance
- Access to Flowise Server URL and Chatflow ID

### Steps

1. **Download the module**
   - The module files are located in `/mod_flowise_chatflow/` directory

2. **Package the module** (if installing via ZIP)
   ```bash
   cd /workspaces/Flowise-Module
   zip -r mod_flowise_chatflow.zip mod_flowise_chatflow/
   ```

3. **Install in Joomla**
   - Go to **System > Install > Extensions**
   - Upload the `mod_flowise_chatflow.zip` file
   - Or extract directly to `/modules/mod_flowise_chatflow/`

4. **Enable the module**
   - Go to **Content > Site Modules**
   - Find "Flowise Chatflow" module
   - Click to configure it

## Configuration

### Module Settings

Once installed, configure the following parameters:

#### Basic Settings

1. **Flowise Server URL** (Required)
   - Example: `https://flowise.example.com`
   - Do NOT include a trailing slash
   - Must be the base URL of your Flowise instance

2. **Chatflow ID** (Required)
   - The unique identifier of your chatflow
   - Found in Flowise dashboard
   - Example: `abc123def456`

3. **Chatbot Height**
   - Default: `600px`
   - Can be specified as pixel value (e.g., `600`) or with unit (e.g., `600px`)
   - Automatically converts numeric values to pixels

4. **Chatbot Width**
   - Default: `100%`
   - Can be percentage (e.g., `100%`) or pixel value (e.g., `400px`)

5. **Theme**
   - **Light** (default) - White background
   - **Dark** - Dark background

6. **Show Fullscreen Button**
   - Enable/Disable fullscreen capability for the chatbot

#### Advanced Settings

- **Layout** - Choose custom layout if available
- **Module Class Suffix** - Add custom CSS classes for styling

## Module File Structure

```
mod_flowise_chatflow/
├── mod_flowise_chatflow.xml      # Module manifest
├── mod_flowise_chatflow.php       # Module entry point
├── helper.php                     # Helper functions
├── tmpl/
│   └── default.php                # Default template
└── language/
    └── en-GB/
        ├── en-GB.mod_flowise_chatflow.ini       # Frontend language
        └── en-GB.mod_flowise_chatflow.sys.ini   # Backend language
```

## Usage

### Basic Setup

1. Create a new module instance of "Flowise Chatflow"
2. Set your Flowise Server URL
3. Enter your Chatflow ID
4. Assign the module to desired menu items or positions
5. Publish the module

### Example Configuration

```
Flowise Server URL: https://chat.example.com
Chatflow ID: d1c2e3f4-a5b6-7890-cdef-1234567890ab
Chatbot Height: 600
Chatbot Width: 100%
Theme: Light
Show Fullscreen Button: Yes
```

### How It Works

The module:
1. Accepts the Flowise server URL and chatflow ID as parameters
2. Validates that both required parameters are provided
3. Creates an iframe pointing to: `{flowise_url}/iframe/{chatflow_id}`
4. Applies responsive styling and theming
5. Loads the chatbot dynamically when the page is rendered

## Customization

### Custom CSS Classes

Add custom CSS classes in the "Module Class Suffix" field. The module applies:

- `.mod-flowise-chatflow` - Main wrapper class
- `.flowise-chatbot-container` - Chatbot container
- `.flowise-theme-light` / `.flowise-theme-dark` - Theme classes

### Custom Styling

Add CSS in your template's stylesheet:

```css
.mod-flowise-chatflow .flowise-chatbot-container {
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.mod-flowise-chatflow.custom-class {
    padding: 20px;
    background: #f5f5f5;
}
```

### Responsive Design

The module is responsive and adapts to:
- Desktop (full height and width as configured)
- Tablet (100% width with adjusted height)
- Mobile (minimum height 500px, full width)

## Troubleshooting

### Chatbot not appearing

1. **Check Configuration**
   - Verify Flowise Server URL is correct
   - Ensure Chatflow ID matches your chatflow
   - Remove trailing slash from URL

2. **Check Browser Console**
   - Open Developer Tools (F12)
   - Check Console tab for errors
   - Look for CORS or network errors

3. **Flowise Server Issues**
   - Verify Flowise instance is running
   - Check if server is accessible from your domain
   - Ensure CORS is properly configured on Flowise

4. **Module Not Published**
   - Ensure module is in Published state
   - Check module assignment to correct position/menu items

### CORS Errors

If you see CORS (Cross-Origin Resource Sharing) errors:

1. Configure CORS on your Flowise server
2. Add your Joomla domain to allowed origins
3. Consult Flowise documentation for CORS setup

## Security Notes

- All URLs and IDs are properly escaped using `htmlspecialchars()`
- The module validates required parameters
- No sensitive data is stored in module parameters
- Use HTTPS for both Joomla and Flowise for secure communication

## Language Support

Currently supported:
- English (en-GB)

To add more languages:
1. Create folder: `language/{LANG_CODE}/`
2. Copy language files and translate strings
3. Update XML manifest if needed

## Version History

### v1.0.0 (November 2025)
- Initial release
- Flowise URL and Chatflow ID configuration
- Height and width customization
- Light/Dark theme support
- Full Joomla 4 compatibility

## Support & Contributing

For issues, feature requests, or contributions:
- GitHub: https://github.com/dreamztech-2026/Flowise-Module

## License

GNU General Public License v2 or later

## Credits

Created for Flowise integration with Joomla

---

**Note**: This module requires an active Flowise instance. For more information about Flowise, visit: https://github.com/FlowiseAI/Flowise
