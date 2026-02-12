GHOST TO MARKDOWN CONVERSION SUMMARY
=====================================

Successfully converted 41 published posts from your Ghost export.

WHAT WAS CONVERTED:
- Only published posts (status='published')
- Skipped pages and drafts
- HTML content converted to Markdown
- All frontmatter fields mapped according to your template

FRONTMATTER STRUCTURE:
Each .md file includes:
- extends: _layouts.post
- section: content
- title: Post title (properly quoted)
- subtitle: (left empty)
- date: Publication date (YYYY-MM-DD format)
- description: Custom excerpt from Ghost (properly quoted)
- categories: Tags from Ghost (lowercase)
- cover-image: "assets/img/a-huge-dweeb.jpeg"
- featured: true/false

FIXES APPLIED:
✓ All description fields are now properly quoted (fixes YAML parsing errors)
✓ All __GHOST_URL__ placeholders replaced with: assets/img/a-huge-dweeb.jpeg
✓ Special characters (like colons) in descriptions are now escaped
✓ All YAML frontmatter is now valid and should parse correctly

FILES CREATED: 41 markdown files

READY TO USE:
These files should now work with Jigsaw without YAML parsing errors.
