# Flowise Joomla Module Development

This repository contains a complete Joomla module for embedding Flowise chatflows into Joomla websites.

## Project Structure

```
Flowise-Module/
├── mod_flowise_chatflow/               # Main module directory
│   ├── mod_flowise_chatflow.xml        # Module manifest (Joomla configuration)
│   ├── mod_flowise_chatflow.php        # Module entry point
│   ├── helper.php                      # Helper class with utility functions
│   ├── tmpl/
│   │   └── default.php                 # Default template/layout
│   └── language/
│       └── en-GB/
│           ├── en-GB.mod_flowise_chatflow.ini       # Frontend strings
│           └── en-GB.mod_flowise_chatflow.sys.ini   # Backend strings
├── INSTALLATION.md                     # Installation and usage guide
├── DEVELOPMENT.md                      # Development documentation
└── README.md                           # Project overview
```

## Quick Start

### Installation for Development

1. Clone or extract this repository
2. Copy the `mod_flowise_chatflow` folder to your Joomla installation:
   ```bash
   cp -r mod_flowise_chatflow /path/to/joomla/modules/
   ```

3. Install via Joomla Admin:
   - Navigate to **System > Install > Extensions**
   - Select the module folder or create a ZIP and upload

4. Configure in **Content > Site Modules > Flowise Chatflow**

### Module File Descriptions

#### `mod_flowise_chatflow.xml`
- **Purpose**: Joomla module manifest
- **Contents**:
  - Module metadata (name, author, version)
  - File declarations
  - Parameter definitions (form fields in admin)
  - Configuration schema

#### `mod_flowise_chatflow.php`
- **Purpose**: Module entry point
- **Responsibilities**:
  - Loads the helper class
  - Gets module parameters
  - Loads the template file

#### `helper.php`
- **Purpose**: Core logic and helper functions
- **Key Methods**:
  - `getConfig()` - Retrieves and validates module parameters
  - `renderChatbot()` - Generates HTML container
  - `getInitScript()` - Creates JavaScript initialization code

#### `tmpl/default.php`
- **Purpose**: Template rendering
- **Responsibilities**:
  - Outputs module HTML
  - Adds CSS styling
  - Injects initialization script

#### Language Files
- **en-GB.mod_flowise_chatflow.ini** - Frontend translations
- **en-GB.mod_flowise_chatflow.sys.ini** - Backend/system translations

## Configuration Parameters

The module accepts the following configuration parameters:

| Parameter | Type | Required | Default | Description |
|-----------|------|----------|---------|-------------|
| `flowise_url` | URL | Yes | - | Flowise server base URL |
| `chatflow_id` | Text | Yes | - | Flowise chatflow identifier |
| `chatbot_height` | Text | No | 600 | Container height (px or numeric) |
| `chatbot_width` | Text | No | 100% | Container width (px or %) |
| `theme` | Select | No | light | UI theme (light/dark) |
| `show_fullscreen_button` | Radio | No | 1 | Show fullscreen option |
| `moduleclass_sfx` | Textarea | No | - | Custom CSS classes |
| `layout` | Module Layout | No | default | Template layout selection |

## How the Module Works

### Data Flow

```
1. Module Configuration (XML)
   ↓
2. Admin Form Parameters
   ↓
3. mod_flowise_chatflow.php (Entry)
   ↓
4. helper.php::getConfig() (Validation)
   ↓
5. helper.php::renderChatbot() (HTML)
   ↓
6. helper.php::getInitScript() (JavaScript)
   ↓
7. tmpl/default.php (Render)
   ↓
8. Frontend Output
```

### Chatbot Initialization

1. Module loads parameters from Joomla configuration
2. Helper validates required parameters (URL and ID)
3. Creates iframe container with unique ID
4. JavaScript initializes iframe on page load
5. Iframe connects to: `{flowise_url}/iframe/{chatflow_id}`

## Adding Features

### Adding a New Configuration Parameter

1. **Update `mod_flowise_chatflow.xml`**:
   ```xml
   <field
       name="new_param"
       type="text"
       label="LABEL_KEY"
       description="DESC_KEY"
       default="default_value"
   />
   ```

2. **Add to language files**:
   - `en-GB.mod_flowise_chatflow.ini`
   - `en-GB.mod_flowise_chatflow.sys.ini`

3. **Update `helper.php`** getConfig() method:
   ```php
   $config['new_param'] = $params->get('new_param', 'default');
   ```

4. **Use in template** (`tmpl/default.php`):
   ```php
   echo $config['new_param'];
   ```

### Adding Language Support

1. Create directory: `language/{LANG_CODE}/`
2. Copy language files from `en-GB/`
3. Translate all strings
4. Test in Joomla language settings

## Testing

### Manual Testing Steps

1. **Test Parameter Validation**
   - Leave Flowise URL empty → should show error
   - Leave Chatflow ID empty → should show error
   - Both filled → should display chatbot

2. **Test Responsive Design**
   - Test on desktop (1920px width)
   - Test on tablet (768px width)
   - Test on mobile (320px width)

3. **Test Theme Switching**
   - Select Light theme → verify styling
   - Select Dark theme → verify styling

4. **Test in Different Positions**
   - Assign to sidebar
   - Assign to main content area
   - Verify correct rendering

### Browser Compatibility

- Chrome/Edge (Chromium)
- Firefox
- Safari
- Mobile browsers

## Security Considerations

- ✅ Uses `htmlspecialchars()` for output escaping
- ✅ Validates required parameters
- ✅ No SQL queries (no database access)
- ✅ No file operations beyond module files
- ✅ Uses Joomla's built-in functions

## Performance Notes

- Lightweight module (minimal overhead)
- Lazy loads iframe on page render
- No external dependencies
- CSS is minimal and inline
- JavaScript is non-blocking

## Common Issues & Solutions

### Chatbot Not Loading

**Check**:
1. Module is published
2. Module is assigned to correct position/menu items
3. Flowise URL and ID are correct
4. Flowise server is accessible
5. CORS is configured on Flowise

### Styling Issues

**Solutions**:
1. Clear Joomla cache
2. Check module class suffix spelling
3. Verify CSS is not conflicting with template
4. Use browser dev tools to inspect element

### JavaScript Errors

**Debug**:
1. Open browser console (F12)
2. Check for error messages
3. Verify iframe URL is correct
4. Check Flowise server logs

## Deployment

### Prepare for Release

1. Update version in `mod_flowise_chatflow.xml`
2. Update INSTALLATION.md with changes
3. Test all configurations
4. Create release notes

### Package Module

```bash
cd /path/to/Flowise-Module
zip -r mod_flowise_chatflow.zip mod_flowise_chatflow/
```

### Distribution

Upload to:
- Joomla Extensions Directory (JED)
- GitHub Releases
- Your website

## Resources

- **Joomla Documentation**: https://docs.joomla.org/
- **Module Development**: https://docs.joomla.org/Developing_an_Advanced_Module
- **Flowise**: https://github.com/FlowiseAI/Flowise
- **Joomla Community**: https://forum.joomla.org/

## License

GNU General Public License v2 or later

## Contributing

Contributions are welcome! Please:
1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

---

**Last Updated**: November 2025
