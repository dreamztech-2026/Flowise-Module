# Flowise Joomla Module - Quick Reference

## File Structure

```
mod_flowise_chatflow/
├── mod_flowise_chatflow.xml           ← Module manifest (configuration schema)
├── mod_flowise_chatflow.php           ← Module entry point (loads config & template)
├── helper.php                         ← Helper class (getConfig, renderChatbot, getInitScript)
├── tmpl/
│   └── default.php                    ← Template (renders module output)
└── language/
    └── en-GB/
        ├── en-GB.mod_flowise_chatflow.ini       ← Frontend translations
        └── en-GB.mod_flowise_chatflow.sys.ini   ← Backend translations
```

## Installation

```bash
# Option 1: Direct copy
cp -r mod_flowise_chatflow /path/to/joomla/modules/

# Option 2: ZIP upload
zip -r mod_flowise_chatflow.zip mod_flowise_chatflow/
# Then upload via Joomla Admin > System > Install > Extensions
```

## Core Components

### `mod_flowise_chatflow.xml`
- Module metadata (name, version, author)
- File declarations
- Parameter definitions for admin form

### `mod_flowise_chatflow.php`
```php
// Includes helper
// Gets config from params
// Loads template
```

### `helper.php` - Main Logic
```php
ModFlowiseChatflowHelper::getConfig($params)      // Get & validate config
ModFlowiseChatflowHelper::renderChatbot($config)  // Generate HTML
ModFlowiseChatflowHelper::getInitScript($config)  // Generate JS
```

### `tmpl/default.php` - Display
- Outputs module HTML
- Adds CSS styling
- Injects JavaScript

## Configuration Parameters

| Parameter | Type | Required | Example |
|-----------|------|----------|---------|
| flowise_url | URL | ✓ | https://chat.example.com |
| chatflow_id | Text | ✓ | abc123def456 |
| chatbot_height | Text | - | 600 or 600px |
| chatbot_width | Text | - | 100% or 400px |
| theme | Select | - | light or dark |
| show_fullscreen_button | Radio | - | 0 or 1 |

## Translation Keys (Language Files)

```ini
MOD_FLOWISE_CHATFLOW                    # Module name
MOD_FLOWISE_CHATFLOW_DESC               # Module description
MOD_FLOWISE_CHATFLOW_SETTINGS           # Fieldset label
MOD_FLOWISE_CHATFLOW_URL_LABEL          # Parameter label
MOD_FLOWISE_CHATFLOW_URL_DESC           # Parameter description
MOD_FLOWISE_CHATFLOW_ID_LABEL
MOD_FLOWISE_CHATFLOW_ID_DESC
MOD_FLOWISE_CHATFLOW_HEIGHT_LABEL
MOD_FLOWISE_CHATFLOW_HEIGHT_DESC
MOD_FLOWISE_CHATFLOW_WIDTH_LABEL
MOD_FLOWISE_CHATFLOW_WIDTH_DESC
MOD_FLOWISE_CHATFLOW_THEME_LABEL
MOD_FLOWISE_CHATFLOW_THEME_DESC
MOD_FLOWISE_CHATFLOW_THEME_LIGHT
MOD_FLOWISE_CHATFLOW_THEME_DARK
MOD_FLOWISE_CHATFLOW_FULLSCREEN_LABEL
MOD_FLOWISE_CHATFLOW_FULLSCREEN_DESC
MOD_FLOWISE_CHATFLOW_CONFIG_ERROR
```

## Common Tasks

### Add New Configuration Field

1. **In `mod_flowise_chatflow.xml`**:
   ```xml
   <field name="my_option" type="text" label="MY_LABEL" />
   ```

2. **In language files**:
   ```ini
   MY_LABEL="My Option Label"
   ```

3. **In `helper.php` getConfig()**:
   ```php
   $config['my_option'] = $params->get('my_option', 'default_value');
   ```

4. **In `tmpl/default.php`**:
   ```php
   echo $config['my_option'];
   ```

### Add Language Translation

1. Create: `language/{LANG_CODE}/`
2. Copy `.ini` files
3. Translate all strings

### Debug Issues

```php
// Add to tmpl/default.php for debugging
echo '<pre>';
print_r($config);
echo '</pre>';
```

## Security Checklist

- ✅ Use `htmlspecialchars()` for output
- ✅ Validate required parameters
- ✅ No `eval()` or dynamic code execution
- ✅ No unescaped user input
- ✅ Use Joomla's built-in functions

## Performance Tips

- Module is lightweight
- Minimal CSS/JS overhead
- Lazy-loads iframe on render
- No external dependencies

## Testing Checklist

- [ ] Module installs without errors
- [ ] Configuration form displays correctly
- [ ] Chatbot loads with valid URL/ID
- [ ] Error message shows with invalid config
- [ ] Responsive on mobile/tablet
- [ ] Light and dark themes work
- [ ] Works on desktop browsers
- [ ] CORS not causing issues

## Deployment

1. Update version in `mod_flowise_chatflow.xml`
2. Test thoroughly
3. Create ZIP:
   ```bash
   zip -r mod_flowise_chatflow.zip mod_flowise_chatflow/
   ```
4. Upload to distribution channels

## Useful Links

- **Joomla Modules**: https://docs.joomla.org/Developing_a_Module
- **Flowise**: https://github.com/FlowiseAI/Flowise
- **This Module**: https://github.com/dreamztech-2026/Flowise-Module

## Support

- See INSTALLATION.md for setup help
- See DEVELOPMENT.md for technical details
- Check browser console (F12) for errors
- Review Flowise documentation for embed options
