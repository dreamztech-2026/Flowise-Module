# Flowise Joomla Module - Livechat Layout

## Overview

The livechat layout provides a modern, floating chatbot widget positioned in the bottom-right corner of your webpage, similar to popular live chat solutions like Zendesk, Intercom, or Drift.

## Features

✨ **Visual Design**
- Fixed position in bottom-right corner
- Modern gradient header with customizable colors
- Smooth animations and transitions
- Professional shadow and rounded corners
- Light and dark theme support

🎯 **Functionality**
- Minimize/expand button for space-saving
- Close button to hide the widget
- Responsive design (full-screen on mobile)
- Iframe-based Flowise chatflow integration
- Clean, user-friendly interface

📱 **Responsive Behavior**
- Desktop: 380px wide fixed widget
- Tablet: Full-width with adjusted positioning
- Mobile: Full-screen overlay

## Installation & Setup

### 1. Choose Livechat Layout

In your Joomla module configuration:
1. Go to **Content > Site Modules > Flowise Chatflow**
2. In the **Advanced** tab, set **Layout** to `livechat`
3. Save and publish

### 2. Configure Module

**Required Settings:**
- Flowise Server URL: `https://your-flowise-instance.com`
- Chatflow ID: `your-chatflow-id`

**Optional Settings:**
- **Theme**: Choose Light or Dark
- **Show Fullscreen Button**: Enable/disable fullscreen mode
- **Module Class Suffix**: Add custom CSS classes

## Layout Components

### Header
- **Title**: "Chat with us" (translatable)
- **Minimize Button**: Collapses the widget to header only
- **Close Button**: Hides the entire widget

### Body
- Contains the Flowise iframe
- Expandable height based on content
- Scrollable if content exceeds container

### Styling

The livechat layout includes:
- **Primary Color**: Purple gradient (#667eea to #764ba2)
- **Dark Mode**: Darkened variants for accessibility
- **Mobile Optimization**: Full-screen on small devices
- **Animations**: Smooth slide-up entrance

## Customization

### Change Header Title

Edit the language file:
```ini
MOD_FLOWISE_CHATFLOW_LIVECHAT_TITLE="Your Custom Title"
```

### Customize Colors

Add custom CSS class in module settings:
```css
.my-custom-livechat .flowise-livechat-header {
	background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
}
```

### Adjust Widget Size

Add to your template's CSS:
```css
.flowise-livechat-container {
	width: 420px !important;  /* Default: 380px */
	height: 700px !important; /* Default: 600px */
}
```

### Position Widget Elsewhere

```css
.flowise-livechat-container {
	bottom: auto;
	top: 20px;
	right: 20px;
}
```

## JavaScript Control

The livechat includes built-in event handlers:

```javascript
// Users can minimize/expand the widget
// Click minimize button (−) to collapse
// Click the header to expand when minimized
// Click close button (✕) to hide the entire widget
```

### Custom JavaScript Integration

```javascript
// Get the container
var container = document.querySelector('.flowise-livechat-container');

// Toggle minimized state
container.classList.toggle('minimized');

// Hide the widget
container.style.display = 'none';

// Show the widget
container.style.display = 'flex';
```

## CSS Classes Reference

| Class | Purpose |
|-------|---------|
| `.mod-flowise-chatflow-livechat` | Main wrapper |
| `.flowise-livechat-container` | Widget container |
| `.flowise-livechat-header` | Header section |
| `.flowise-livechat-body` | Chat area |
| `.flowise-theme-light` | Light theme |
| `.flowise-theme-dark` | Dark theme |
| `.minimized` | Minimized state |

## Responsive Breakpoints

### Desktop (> 768px)
- Widget: 380px × 600px
- Position: Bottom-right corner
- Fully visible

### Tablet (480px - 768px)
- Widget: 100% width
- Height: 100% with adjusted positioning
- Full-screen appearance

### Mobile (< 480px)
- Widget: Full screen
- No fixed positioning
- Optimized for touch

## Best Practices

✅ **Do**
- Test on multiple devices
- Use a readable font size
- Ensure adequate contrast in dark mode
- Test with slow internet connections
- Monitor widget performance

❌ **Don't**
- Overload with custom CSS
- Hide the close button (accessibility)
- Use in a fixed header/footer (conflict)
- Set excessive z-index values
- Load multiple chat instances

## Troubleshooting

### Widget appears off-screen
- Check z-index conflicts with other fixed elements
- Clear browser cache
- Check CSS media queries

### Minimize/Close buttons not working
- Open browser console (F12) for errors
- Verify JavaScript is enabled
- Check for JavaScript conflicts

### Widget looks broken on mobile
- Clear mobile browser cache
- Test in incognito/private mode
- Check viewport meta tag in template

### iframe not loading
- Verify Flowise URL is correct
- Check CORS configuration
- Test Flowise server accessibility

## CSS File Location

The livechat styling is defined in:
- `mod_flowise_chatflow/tmpl/livechat.css` (standalone file)
- Or inline in `mod_flowise_chatflow/tmpl/livechat.php` (template file)

## Performance Tips

- Livechat adds minimal overhead (~10KB CSS + JS)
- Iframe lazy-loads when page is ready
- No external dependencies
- Optimized animations (GPU-accelerated)

## Browser Support

✅ Chrome/Chromium (v90+)
✅ Firefox (v88+)
✅ Safari (v14+)
✅ Edge (v90+)
✅ Mobile Safari
✅ Chrome Android

## Future Enhancements

Possible improvements:
- Unread message badge
- Animation effects
- Custom position selection
- Floating button mode
- Sound notifications
- Conversation history

## Support

For issues or feature requests:
- Check INSTALLATION.md for general help
- See DEVELOPMENT.md for technical details
- Review browser console for errors
- Visit Flowise documentation

---

**Layout Version**: 1.0.0
**Last Updated**: November 2025
