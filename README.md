# Flowise Joomla Module

A complete, production-ready Joomla module to embed Flowise chatflow into your Joomla website.

## 🚀 Features

- **Easy Integration**: Simple configuration of Flowise server URL and chatflow ID
- **Customizable**: Adjust height, width, and appearance to match your site
- **Theme Support**: Light and dark theme options
- **Responsive**: Mobile-friendly design that adapts to all screen sizes
- **Secure**: Proper escaping and validation of all parameters
- **Joomla Native**: Built with Joomla 4 best practices
- **Multi-language**: Translation-ready architecture

## 📋 Requirements

- **Joomla**: 4.0 or higher
- **PHP**: 7.4 or higher
- **Flowise**: Active instance with chatflow configured

## 📦 Installation

### Quick Start

1. **Download** or extract the module
2. **Navigate** to Joomla Admin > System > Install > Extensions
3. **Upload** the `mod_flowise_chatflow` folder or create a ZIP
4. **Configure** your Flowise URL and Chatflow ID
5. **Publish** and assign to desired positions

For detailed instructions, see [INSTALLATION.md](INSTALLATION.md)

## ⚙️ Configuration

### Required Settings

1. **Flowise Server URL**: The base URL of your Flowise instance
   - Example: `https://flowise.example.com`
   
2. **Chatflow ID**: The unique identifier of your chatflow
   - Example: `abc123def456`

### Optional Settings

- **Height**: Chatbot container height (default: 600px)
- **Width**: Chatbot container width (default: 100%)
- **Theme**: Choose between Light or Dark theme
- **Fullscreen Button**: Enable/disable fullscreen capability

## 🎯 Usage

1. Go to **Content > Site Modules** in Joomla Admin
2. Create a new module of type "Flowise Chatflow"
3. Set your configuration:
   - Flowise Server URL: `https://your-flowise-instance.com`
   - Chatflow ID: `your-chatflow-id`
4. Configure display settings (height, width, theme)
5. Assign to menu items or module positions
6. Save and publish

The chatbot will appear on your website in the configured position.

## 📁 Project Structure

```
mod_flowise_chatflow/
├── mod_flowise_chatflow.xml    # Module manifest & configuration
├── mod_flowise_chatflow.php    # Module entry point
├── helper.php                  # Helper functions & logic
├── tmpl/
│   └── default.php             # Template/view
└── language/
    └── en-GB/
        ├── en-GB.mod_flowise_chatflow.ini
        └── en-GB.mod_flowise_chatflow.sys.ini
```

## 🔧 Technical Details

### How It Works

1. Module loads Flowise configuration from Joomla settings
2. Helper class validates and prepares configuration
3. Creates iframe pointing to Flowise embed URL
4. JavaScript initializes iframe on page load
5. Responsive CSS ensures proper display on all devices

### Security

- All output is properly escaped
- Required parameters are validated
- No database access
- HTTPS communication recommended

## 🎨 Customization

### Add Custom CSS

Use the **Module Class Suffix** field to add custom classes:

```css
.mod-flowise-chatflow.my-custom-class {
    padding: 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
```

### Create Custom Layout

1. Copy `tmpl/default.php` to your template
2. Modify as needed
3. Select custom layout in module settings

For more details, see [DEVELOPMENT.md](DEVELOPMENT.md)

## 🐛 Troubleshooting

### Chatbot not appearing?

1. **Verify configuration**: Check Flowise URL and Chatflow ID
2. **Check browser console**: Look for errors (F12)
3. **Test Flowise access**: Ensure server is accessible
4. **CORS issues**: Configure CORS on Flowise if needed
5. **Module assignment**: Confirm module is assigned and published

### Module administration empty?

- Clear Joomla cache
- Verify module folder structure
- Check file permissions

## 📚 Documentation

- [Installation Guide](INSTALLATION.md) - Detailed setup and configuration
- [Development Guide](DEVELOPMENT.md) - For developers and contributors

## 🤝 Contributing

Found an issue or have a feature request? 

- Create an issue on GitHub
- Submit a pull request with improvements
- Help translate to other languages

## 📄 License

GNU General Public License v2 or later

## 🔗 Links

- **Flowise GitHub**: https://github.com/FlowiseAI/Flowise
- **Joomla Docs**: https://docs.joomla.org/
- **This Project**: https://github.com/dreamztech-2026/Flowise-Module

## 💡 Tips

- Use HTTPS for both Joomla and Flowise for secure communication
- Test in multiple browsers for compatibility
- Use browser dev tools to debug any styling issues
- Keep Flowise and Joomla updated for best compatibility

---

**Version**: 1.0.0  
**Last Updated**: November 2025  
**Maintained By**: Flowise Module Contributors
